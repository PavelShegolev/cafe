<?php
	class Factory{
	
		static function get_obj($type){
			if(file_exists('../application/models/model_'.$type.'.php')){
				$model_file = strtolower($type).'.php';
				include "../application/models/model_".$model_file;
				$class_name= 'Model_'.$type;
				return new $class_name;
			}	
		}
		
	}
?>