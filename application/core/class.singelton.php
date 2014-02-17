<?php
  class Singelton{
    protected  static $instance= array();
    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
    
    public static function getInstance(){
      $class_name= get_called_class();
      if(!isset(self::$instance[$class_name])){
        self::$instance[$class_name]= new $class_name();
      }
      return self::$instance[$class_name];
    }
    
  }
?>