<?php
class Controller_Users extends Controller{
	public function __construct(){
		$this->model= new Model_Users();
		parent::__construct();
	}
	
	public function action_index(){
		$this->view->generate('view_login.php', 'view_template.php');
	}
	
  public function action_login(){
		$this->view->generate('view_login.php', 'view_template.php');
	}
  
	public function action_form_registration(){
		$this->view->generate('view_registration.php', 'view_template.php');
	}
	
	public function action_password_recovery(){
		$this->view->generate('view_password_recovery.php','view_template.php');
	}
	
	public function action_send_email(){
		$result= $this->model->check_email_recovery();
		$this->view->generate('view_password_recovery.php','view_template.php',$result);
	}
	
	public function action_registration(){
		$result= $this->model->registration_user();
    if(!$result){
      $this->view->nick= $_GET['nick_name'];
      $this->view->email= $_GET['email'];
      $this->view->age= $_GET['age'];
      $this->view->gender= $_GET['gender'];
    }else{
      MessageCollector::set_message('Вы успешно зарегистрировались.','success');
    }
		$this->view->load('view_registration.php', 'view_template.php');
	}
	
	public function action_authorization(){
		$result = $this->model->check_user();
    
		if($result['login'] == "incorrect_login"){
      $this->view->count_logging= $result['count_logging'];
      $this->view->old_login= $result['old_login'];
      $this->view->data= $result;
      $this->view->login= $result['login'];
			$this->view->load('view_login.php', 'view_template.php');
    }
		else{
    	$this->action_personal_cabinet();
    }
	}
  
  public function action_personal_cabinet(){
    if($this->model->get_type_access() == user)
      $this->view->load('view_user_personal_cabinet.php','view_template.php');
      
		if($this->model->get_type_access() == admin)
			$this->view->load('view_admin_personal_cabinet.php','view_template.php');
  }
	
	public function action_login_openid($openid_provider){
		$result= $this->model->openid($openid_provider);
		if(!$result)
			$this->view->generate('view_user_personal_cabinet.php', 'view_template.php',$result);
		else
			$this->view->generate('view_result_auth.php', 'view_template.php',$result);
	}
	
	public function action_login_oauth($oauth_provider){
		$result= $this->model->oauth($oauth_provider);
		if(!$result)
			$this->view->generate('view_user_personal_cabinet.php', 'view_template.php',$result);
		else
			$this->view->generate('view_result_auth.php', 'view_template.php',$result);
	}
	
	public function action_logout(){
		$this->model->logout();
		$this->view->generate('view_login.php', 'view_template.php');
	}

}
?>