<?php
  class Log_error{
		static function write($msg){
			$msg_= date('d-m-Y h:m:s') . ' ';
			$msg_.= 'Text error:'.$msg;
			$handle= fopen('../logs/log_error.txt','a');
			fwrite($handle,$msg_."\r\n");
			fclose($handle);
		}
	}
?>