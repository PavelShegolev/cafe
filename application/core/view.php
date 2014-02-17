<?php
  class View{
    
    private $data= array();
  
    public function __set($name, $value){
      $this->data[$name]= $value;
    }
    
    public function __get($name){
      return $this->data[$name];
    }
    
 		public function load($content_view, $view_template){
			include '../../'.host.'/application/views/'.$view_template;
		}
  
		public function generate($content_view, $view_template, $data= null){
			include '../../'.host.'/application/views/'.$view_template;
		}
    
		public function generate_content($view_template, $data= null){
			include '../../'.host.'/application/views/'.$view_template;
		}
	}
?>