<?php
  abstract class Controller{
		public static $view;
	
		function __construct(){
			$this->view = new View();
		}
		
   	public abstract function action_index();
	}
?>