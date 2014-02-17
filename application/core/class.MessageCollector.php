<?php
  class MessageCollector{
    private $messages= array();
    private  static $instance;
    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
    
    private function set($message, $type){
      if(!empty($message)){
        $this->messages[][$type]= $message;
      }
    }
    
    private function get($type){
      $result= array();
      foreach($this->messages as $key => $value){
        if(isset($value[$type])){
          $result[]= $value[$type];
          unset($this->messages[$key][$type]);
        }
      }
      return $result;
    }
        
    private static function getInstance(){
      if(!isset(self::$instance)){
        self::$instance= new MessageCollector();
      }
      return self::$instance;
    }
    
    public static function set_message($message, $type= 'warning'){
      self::getInstance()->set($message, $type);
    }

    public static function get_message($type= 'warning'){
      return self::getInstance()->get($type);
    }

  }

?>