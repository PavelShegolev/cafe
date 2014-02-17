<?php
	class MyOpenID{
		private $identity;
		private $return_to;
		private $server;
		private $xrds_server;
		public $data;
		public $required;
		public $optional;
		
		
	  function __construct($identity, $return_to){
			$this->data = $_GET;
			$this->identity= $identity;
			$this->return_to= $return_to;
		}
		
		private function send_http_query(){
			$curl= curl_init($this->identity);
			curl_setopt($curl, CURLOPT_HEADER, 1);
			curl_setopt($curl, CURLOPT_NOBODY, 1);	
			//curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
			$result= curl_exec($curl);
			//var_dump($result);
			return $result;
		}
		
		private function get_servises($url_xrds){
			$curl= curl_init(trim($url_xrds));
			curl_setopt($curl, CURLOPT_HEADER, 1);
			curl_setopt($curl, CURLOPT_NOBODY, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($curl, CURLOPT_HTTPGET, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			
			$result= curl_exec($curl);
			return $result;
		}
		
		private function get_server($header){
			 $pos_uri= strpos($header,'<URI>');
			 $rest_=  substr($header,$pos_uri+5,strlen($header)-strlen($pos_uri));
			
			 $pos_uri= strpos($rest_,'</URI>');
			 $rest_=  trim(substr($rest_,0,$pos_uri));
			 
			return $rest_;
		}
		
		private function get_XRDS($header){
			$search_str= 'X-XRDS-Location:';
			$xrds_pos_begin= strpos($header,$search_str) + strlen($search_str);
			$result= substr($header,$xrds_pos_begin,strlen($header)-strlen($xrds_pos_begin));
			$xrds_pos_end= strstr($rest,';');
			if($xrds_pos_end)
				$result= substr($result,$xrds_pos_begin,strlen($resutl)-strlen($xrds_pos_end));
			$this->xrds_server= $result;
			return $result;
		}
		
		private function  Attribute_Exchange(){
			$attribute= array();
			$required= array();
			$optional= array();
			$attribute['openid.ns.ax']= 'http://openid.net/srv/ax/1.0';
			$attribute['openid.ax.mode']= 'fetch_request';
			foreach($this->required as $value){
				$type= strtr($value,'/','_');
				$required[]= $type;
				$attribute['openid.ax.type.'.$type]= 'http://axschema.org/'.$value;
			}
			foreach($this->optional as $value){
				$type= strtr($value,'/','_');
				$optional[]= $type;
				$attribute['openid.ax.type.'.$type]= 'http://axschema.org/'.$value;
			}
			
			$attribute['openid.ax.required']= implode(',', $required);
			$attribute['openid.ax.if_available']= implode(',', $optional);

			return $attribute;
		}
		
		private function server_url(){
			if($this->identity == google)
				$server_xrds= 'http://www.google.com/accounts/o8/id';
			else{
				$header= $this->send_http_query();
				$server_xrds= $this->get_XRDS($header);
			}
			$server= $this->get_servises($server_xrds);
			return $this->get_server($server);
		}
		
		private function build_url($attributes,$server){
			$attributes['openid.identity']= 'http://specs.openid.net/auth/2.0/identifier_select';
			$attributes['openid.claimed_id']= 'http://specs.openid.net/auth/2.0/identifier_select';
			$attributes['openid.ns']= 'http://specs.openid.net/auth/2.0';
      $attributes['openid.mode']= 'checkid_setup';
      $attributes['openid.return_to']= $this->return_to;
      $attributes['openid.realm']= $this->return_to;
			return $server.'?'.http_build_query($attributes, '', '&');
		}
		
		public function get_authentication_url(){
			$server= $this->server_url();
			$attributes= $this->Attribute_Exchange();
			return $this->build_url($attributes,$server);
		}
		
		 function Get_Attributes(){
			foreach($this->optional as $value){
				$t= strtr($value,'/','_');
				$attributes[$t]= $this->data['openid_ax_value_'.$t.'_1'];
			}
			foreach($this->required as $value){
				$t= strtr($value,'/','_');
				$attributes[$t]= $this->data['openid_ax_value_'.$t.'_1'];
				if(!is_null($this->data['openid_ext1_value_'.$t]))
					$attributes[$t]= $this->data['openid_ext1_value_'.$t];
			}
			return $attributes;
		}
}
?>