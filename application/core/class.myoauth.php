<?php
	class MyOAuth{
		public $params= array();
		public $url_token;
		public $data;
		function __construct(){
			$this->data = $_GET;
		}
		
		private function build_url_token($oauth_provider){
			if($oauth_provider === 'facebook'){
				$redirect_uri= 'http://'.external_host.'/users/login_oauth/facebook/';
				$client_id= facebook_client_id;
				$client_secret= facebook_client_secret;
				$auth_token= facebook_auth_token;
				
			}
			if($oauth_provider === 'vk'){
				$redirect_uri= 'http://'.external_host.'/users/login_oauth/vk/';
				$client_id= vk_client_id;
				$client_secret= vk_client_secret;
				$auth_token= vk_auth_token;
			}
			$params= array('client_id' => $client_id,
										'redirect_uri'  => $redirect_uri,
										'client_secret' => $client_secret,
										'code'          => $this->data['code']);
			return $auth_token.'?'.urldecode(http_build_query($params));
		}
		
		public function GetUserIformation($acces_token, $oauth_provider){
			$params = array('access_token' => $acces_token);
			if($oauth_provider === 'facebook'){
				$params = array('access_token' => $acces_token);
				$url= facebook_user_url.'?'.urldecode(http_build_query($params));
			}
			if($oauth_provider === 'vk'){
				$params = array('access_token' => $acces_token,
												'fields' => 'uid,birthdate,sex,screen_name');
				$url= vk_url.'?'.urldecode(http_build_query($params));
			}
		
			$curl= curl_init($url);
			curl_setopt($curl, CURLOPT_HEADER, 1);
			curl_setopt($curl, CURLOPT_NOBODY, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_HTTPGET, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$result= curl_exec($curl);
			if($oauth_provider === 'vk')
				$result= $this->Get_Attributes_vk($result);
			if($oauth_provider === 'facebook')
				$result= $this->Get_Attributes($result);
			return $result;
		}
		
		public function get_token($oauth_provider){
			$curl= curl_init($this->build_url_token($oauth_provider));
			curl_setopt($curl, CURLOPT_HEADER, 1);
			curl_setopt($curl, CURLOPT_NOBODY, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_HTTPGET, 1);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$result= curl_exec($curl);
			$pos_access_token= strpos($result,'access_token')+13;
			if($result[$pos_access_token]==':')
				$pos_access_token+=2;
			$result= substr($result,$pos_access_token,strlen($result) - $pos_access_token);
			$pos_expires= strpos($result,'expires')-2;
			if($result[$pos_expires]==',')
				$pos_expires-=2;
			$acces_token= substr($result,0,$pos_expires+1);
			return $acces_token;
		}
		
		public function Get_Attributes($data){
			$json_str= substr($data,strpos($data,'{'),strlen($data) - strpos('{',$data));
			$result= json_decode($json_str, true);
			return $result;
		}
		
		public function Get_Attributes_vk($data){
			$json_str= substr($data,strpos($data,'{'),strlen($data) - strpos('{',$data));
			$result= json_decode($json_str, true);
			return $result;
		}
		
		public function get_auth_url($oauth_provider){
			if($oauth_provider == 'facebook')
				return facebook_auth_url.'?'.urldecode(http_build_query($this->params));
			if($oauth_provider == 'vk')
				return vk_auth_url.'?'.urldecode(http_build_query($this->params));
		}
		
	}
?>