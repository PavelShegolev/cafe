<?php
	class Model_Users extends Model{
		private $login;
		private $password;
		
		function __construct(){
			parent::connect();
		}
		
		private function count_logging(){
			session_start();
			if(is_null($_SESSION['count_logging'])){
				$_SESSION['count_logging']= 1;
			}else{
				$_SESSION['count_logging']+= 1;
			}
			return $_SESSION['count_logging'];
		}
		
		private function get_user_info(){
    	$this->login= $this->check($_POST['login']);
			$this->password= $this->check($_POST['password']);
      $query= "select users.id_users, users.nick_name, Type_Access.type_a  from users join Type_Access on(Type_Access.id=users.type_access) where (users.login='".$this->login."' or email='".$this->login."') and users.password='".$this->password."'";
      $result["old_login"]= $this->login;
      $inf= parent::get_row($query);
      if(!$inf){
        MessageCollector::set_message(E_AUTH_USER, error);
        return false;
      }
			if(is_null($inf)){
				$result["count_logging"]= $this->count_logging();
				$result["login"]= "incorrect_login";
				return 	$result;
			}
			return $inf;
		}
		
		private function time_logging(){
			session_start();
			if(is_null($_SESSION['time_logging'])){
				$_SESSION['time_logging']= time();
				return true;
			}
			else{
				if(time() - $_SESSION['time_logging'] >= 5){
					$_SESSION['time_logging']= time();
					$_SESSION['count_logging']= 0;
					return true;
				}else
					return false;
			}
		}
		
		private function authorize_user($user_info){
			session_start();
			$_SESSION['count_logging']= 0;
			$_SESSION['id_users']= $user_info['id_users'];
			$_SESSION['nick_name']= $user_info['nick_name'];
			$_SESSION['type_a']= $user_info['type_a'];
		}
		
		private function send_email($email,$password){
			$massage= "Вы зарегистрировались на ресурсе cafetomsk.ru\nВаш логин:".$email."\nПароль:".$password;
			$result= mail($email, 'Уведомление', $massage);
			if($result)
				$result= "<br>Вы успешно зарегистрировались.<br> Информация о логине и пароле отправлена на ваш email";
			else{
				$result= 'По каким-то причинам регистрация не работает, администрация уже занимается этим вопросом';
				Log_error::write("can't sand to email:".$email);
			}
			return $result;
		}
		
		private function registration_new_user($user_data, $no_email= false){
			$nick= $user_data['namePerson_friendly'];
			$email= $user_data['contact_email'];
			if($no_email)
				$login= $user_data['username'];
			else
				$login= $user_data['contact_email'];
			$birthDate= $user_data['birthDate'];
			$gender= $user_data['person_gender'];
			$password= rand(10000,99999);
			$query="insert into users(nick_name,login,password,email,age,mail,type_access) values('".$nick."','".
			$login."','".$password."','".$email."','".$birthDate."','".$gender."',1)";
			if(parent::set_query($query)){
				$id= parent::get_row("select users_id from users where email='".$email."'");
				if(!is_null($id)){
					$user_info['id_users']= $id;
					if($no_email)
						$user_info['nick_name']= $login;
					else
						$user_info['nick_name']= $email;
					$user_info['type_a']="user";
					if(!$no_email)
						$result= $this->send_email($email,$password);
					$this->authorize_user($user_info);
				}else
					$result= 'В данный момент авторизация не работает';
			}
			else
				$result= 'В данный момент регистрация не работает';
			return $result;
		}
		
		private function registration_new_user_vk($user_data){
			$login= $user_data['login'];
			$gender= $user_data['gender'];
			$password= rand(10000,99999);
			$query="insert into users(login,password,mail,type_access) values('".$login."','".$password."','".$gender."',1)";
			if(parent::set_query($query)){
				$id= parent::get_row("select users_id from users where login='".$login."'");
				if(!is_null($id)){
					$user_info['id_users']= $id;
					$user_info['nick_name']= $login;
					$user_info['type_a']="user";
					$this->authorize_user($user_info);
				}else
					$result= 'В данный момент авторизация не работает';
			}
			else
				$result= 'В данный момент регистрация не работает';
			return $result;

		}
		
		private function check_email($email){
			$query= "select id_users from users where email='".$email."'";
			$id= parent::get_row($query);
			return $id['id_users'];
		}
		
		private function check_login($login){
			$query= "select id_users from users where login='".$login."'";
			$id= parent::get_row($query);
			return $id['id_users'];
		}
		
    public function get_type_access(){
			session_start();
			return $_SESSION['type_a'];
		}
    
		public function check_email_recovery(){
			$email= parent::$link->real_escape_string($_POST['email']);
			$query= "select password from users where email='".$email."'";
			$password= parent::get_row($query);
			if($query === false)
				$result= 'Такого email не существует.';
			else
				$result= $this->send_email_recovery($email,$password['password']);
			return $result;
		}
		
		private function send_email_recovery($email,$password){
			$message= "Ваш пароль:".$password."\nС уважением администрация cafetomsk.ru";
			$result= mail($email, 'Восстановление пароля', $message);
			if($result)
				$result= 'Пароль успешно отослан на ваш email.';
			else{
				$result= 'По каким-то причинам восстановление пароля не работает, администрация уже занимается етим вопросом';
				Log_error::write("can't sand to email:".$email);
			}
			return $result;
		}
    
    private function search_equal_login($login){
			$query= "select id_users from users where login='".$login."' or email = '".$login."'";
			return parent::get_row($query);
		}
    
    private function check_($str){
      return preg_match('/[^0-9a-zA-Z]/', $str) ? true : false;
    }
    
    private function check_fields_reg(){
      $result= true;
      $login= $_GET['login'];
      $nick_name= $_GET['nick_name'];
      $password= $_GET['password'];
      if(empty($login)){
        MessageCollector::set_message('Поле логин не должен быть пустым.', warning);
        $result= false;
      }else{
        if($this->check_($login)){
          MessageCollector::set_message('Поле логин должен состоять только из латинских букв и цифр.', warning);
          $result= false;
        }
      }
      if(empty($nick_name)){
        MessageCollector::set_message('Поле имя не должен быть пустым.', warning);
        $result= false;
      }
      if(empty($password)){
        MessageCollector::set_message('Поле пароль не должен быть пустым.', warning);
        $result= false;
      }else{
        if($this->check_($password)){
          MessageCollector::set_message('Поле пароль должен состоять только из латинских букв и цифр.', warning);
          $result= false;
        }
      }
      return $result;
    }
    
    private function check($str){
      return parent::$link->real_escape_string($str);
    }
	
		public function registration_user(){
      if(!$this->check_fields_reg()){
        return false;
      }
			$login= $this->check($_GET['login']);
      $equal_login= $this->search_equal_login($login);
      if($equal_login === false){
        MessageCollector::set_message(E_CREATE_USER, error);
        return false;
      }
      if(!empty($equal_login)){
        MessageCollector::set_message('Пользователь с таким логином уже существует.', warning);
        return false;
      }
      $nick= $this->check($_GET['nick_name']);
      $password= $this->check($_GET['password']);
      $email= $this->check($_GET['email']);
      $age= $this->check($_GET['age']);
      $gender= $this->check($_GET['gender']);
      $query="insert into users(nick_name,login,password,email,age,mail,type_access) values('".$nick."','".$login."','".$password."','".$email."','".$age."','".$gender."',1)";
      if(!parent::set_query($query)){
        MessageCollector::set_message(E_CREATE_USER, error);
        return false;
      }

			return true;
		}

		public function check_user(){
			$user_info= $this->get_user_info();
      if($user_info === false){
        MessageCollector::set_message(E_AUTH_USER, error);
        return false;
      }
			if($this->count_logging() > 2 and $this->time_logging()==false or $user_info['login'] == "incorrect_login"){
				return $user_info;
      }else{
				$this->authorize_user($user_info);
      }
      return true;
		}
		
		public function openid($openid_provider){
			$openid_provider= parent::$link->real_escape_string($openid_provider);
			if($openid_provider == 'yandex'){//добавить константу
				$openid_provider= yandex;
      }elseif($openid_provider == 'google'){
				$openid_provider= google;
      }
			$openid= new MyOpenID($openid_provider,'http://'.external_host.'/users/login_openid/');
			$openid->required= array('contact/email');
			$openid->optional= array('namePerson/friendly','birthDate','person/gender');
			if(empty($openid->data))
				header('Location:'.$openid->get_authentication_url());
			else
				$attributes= $openid->Get_Attributes();
				if(!is_null($attributes['contact_email'])){
					$attributes['namePerson_friendly']= $this->check($attributes['namePerson_friendly']);
					$attributes['contact_email']= $this->check($attributes['contact_email']);
					$attributes['birthDate']= $this->check($attributes['birthDate']);
					$attributes['person_gender']= $this->check($attributes['person_gender']);
					$id= $this->check_email($attributes['contact_email']);
					if(is_null($id)){
						$result= $this->registration_new_user($attributes);
					}else{
						$user_info['id_users']= $id;
						$user_info['nick_name']= $attributes['contact_email'];
						$user_info['type_a']= "user";
						$result= $this->authorize_user($user_info);
					}
				}else
					$result= 'email не задан';
			return $result;
		}
		
		
		public function oauth($oauth_provider){
			$oauth_provider= parent::$link->real_escape_string($oauth_provider);
			if($oauth_provider === 'facebook'){
				$redirect_uri= 'http://'.external_host.'/users/login_oauth/facebook/';
				$client_id= facebook_client_id;
			}
			if($oauth_provider === 'vk'){
				$redirect_uri= 'http://'.external_host.'/users/login_oauth/vk/';
				$client_id= vk_client_id;
			}
			$oauth= new MyOAuth();
			$oauth->params= array('client_id' => $client_id,
														'redirect_uri'  => $redirect_uri,
													  'response_type' => 'code',
														'scope' => 'email,user_birthday');
														
			if(empty($oauth->data))
				header('Location:http://'.$oauth->get_auth_url($oauth_provider));
			else{
				$token= $oauth->get_token($oauth_provider);
				$data= $oauth->GetUserIformation($token, $oauth_provider);
				if($oauth_provider === 'vk' and !is_null($data['response'][0]['uid'])){
					//авторизовать пользователя по uid
					$attributes['login']= parent::$link->real_escape_string($data['response'][0]['uid']);
					$attributes['birthday']= parent::$link->real_escape_string($data['birthday']);//получить зн.дня р.
					$attributes['gender']= parent::$link->real_escape_string($data['response'][0]['sex']);
					$id= $this->check_login($data['login']);
					if(is_null($id))
						$result= $this->registration_new_user_vk($attributes);
					else{
						$user_info['id_users']= $id;
						$user_info['nick_name']= $attributes['login'];
						$user_info['type_a']= "user";
						$result= $this->authorize_user($user_info);
					}
				}else

				if(!is_null($data['email']) or !is_null($data['name'])){
					$empty_email= empty($data['email']);
					$attributes['username']= parent::$link->real_escape_string($data['name']);
					$attributes['contact_email']= parent::$link->real_escape_string($data['email']);
					$attributes['birthDate']= parent::$link->real_escape_string($data['birthday']);
					$attributes['person_gender']= parent::$link->real_escape_string($data['gender']);
					if($empty_email){
						$id= $this->check_login($attributes['username']);
						if(is_null($id))
							$result= $this->registration_new_user($attributes,true);
						else{
							$user_info['id_users']= $id;
							$user_info['nick_name']= $attributes['username'];
							$user_info['type_a']= "user";
							$result= $this->authorize_user($user_info);
						}
					}else{
						$id= $this->check_email($attributes['contact_email']);
						if(is_null($id)){
							$result= $this->registration_new_user($attributes);
						}else{
							$user_info['id_users']= $id;
							$user_info['nick_name']= $attributes['contact_email'];
							$user_info['type_a']= "user";
							$result= $this->authorize_user($user_info);
						}
					}
					}else
						$result= 'email не задан';
					
				return $result;
			}
		}
		
		public function logout(){
		  session_start();
			unset($_SESSION['id_users']);
			unset($_SESSION['nick_name']);
		  unset($_SESSION['type_a']);
		}
 
	}
?>