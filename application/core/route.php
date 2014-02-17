<?php
	abstract class Route{

  	static function start(){
      try{
        $e_route= new RouteException;
        $controller_name = 'Main_page';
        $action_name = 'index';
        
        $routes= $_SERVER['REQUEST_URI'];
        $GET_ex_param= strpos($routes,'?');
        if($GET_ex_param){
          $routes= substr($routes,0,$GET_ex_param);
        }
        
        $routes = explode('/',$routes);
        
        if (!empty($routes[1])){	
          $controller_name = $routes[1];
        }
        
        if(!empty($routes[2])) {
          $action_name = $routes[2];
        }
        
        if(!empty($routes[3])) {
          $params = $routes[3];
        }
        
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;
      
        $model_file = strtolower($model_name).'.php';
        $model_path = '../../'.host.'/application/models/'.$model_file;
        if(file_exists($model_path)){
          include $model_path;
        }
        
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = '../../'.host.'/application/controllers/'.$controller_file;
        if(file_exists($controller_path)){
          include $controller_path;
        }else{
          $e_route[]= "file not exist ".$controller_path;
        }
        
        if($e_route->current()){
          throw $e_route;
        }
        
        $controller = new $controller_name;
        $action = $action_name;
        if(method_exists($controller, $action)){
          $controller->$action($params);
        }else{
          $e_route[]= 'method' .$action.'not exist in class';
        }
        
        if($e_route->current()){
          throw $e_route;
        }
        
      }catch(RouteException $errors){
        foreach($errors as $error){
          Log_error::write($error);
        }
        Route::ErrorPage(404);
      }
      catch(DBException $errors){
        foreach($errors as $error){
          Log_error::write($error);
        }
        Route::ErrorPage(500);
      }
		}
  
		static function ErrorPage($code_error){
      switch($code_error){ 
        case 401:{
          $host = 'http://'.$_SERVER['HTTP_HOST'].'/page_error_'.$code_error;
          header('HTTP/1.1 401 Unauthorized');
          header('Location:'.$host);
        }
        case 404:{
          $host = 'http://'.$_SERVER['HTTP_HOST'].'/page_error_'.$code_error;
          header('HTTP/1.1 404 Not Found');
          header('Location:'.$host);
        }
        case 500:{
          $host = 'http://'.$_SERVER['HTTP_HOST'].'/page_error_'.$code_error;
          header('HTTP/1.1 500 Internal Server Error');
          header('Location:'.$host);
        }
      }
		}
    
	}
?>