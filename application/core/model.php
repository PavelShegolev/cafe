<?php
	abstract class Model{
		static public $link;
    
		public function connect(){
      $db_error= new DBException;
			@self::$link= new mysqli(host,user,password,db);
			if(self::$link->connect_error){
        $db_error[]= self::$link->connect_error;
			}
      if($db_error->current()){
          throw $db_error;
      }
		}
		
		public function set_query($query){
			self::$link->query($query);
			if(self::$link->error){
        Log_error::write(self::$link->error);
				return false;
			}else
				return true;
		}
		
		public function get_row($query){
			$result= self::$link->query($query);
			if(self::$link->error){
        Log_error::write(self::$link->error);
				return false;
      }else{
        return $result->fetch_assoc();
      }
		}
		
		public function get_rows($query){
      $result= self::$link->query($query);
      $mas;
      if(self::$link->error){
        Log_error::write(self::$link->error);
				return false;
      }else{
        while($row= $result->fetch_assoc())
				$mas[]=$row;
      }
      return $mas;
    }
				
	}
?>