<?php
	class Controller_Place extends Controller{
		public function __construct(){
			parent::__construct();
			$this->model= new Model_Place();
		}
		
		public function action_places($name_place = ''){
			$data= $this->model->get_data_place($name_place);
			$this->view->generate('view_place.php','view_template.php',$data);
      if($data != null and $data != false){
        $data= $this->model->get_data_comments($data['id']);
        $this->view->generate_content('view_comments.php',$data);
      }
		}

		public function action_image($name_image = ''){
			$this->model->get_image($name_image);
		}
		
		public function action_add_comment(){
			session_start();
			if(!is_null($_SESSION['id_users'])){
				$this->model->add_comment();
			}else{
        Route::ErrorPage(401);
      }
			$this->action_places($_SESSION['name_place']);
		}
    
    public function action_catalog(){
			$data= $this->model->get_data_catalog();
			$this->view->generate('view_catalog.php','view_template.php',$data);
		}
		
    public function action_add_place(){
      $result= $this->model->AddPlace();
      if(!$result){
        $this->view->name= $_POST['name'];
        $this->view->description= $_POST['description'];
        $this->view->address= $_POST['address'];
        $this->view->phone= $_POST['phone'];
        $this->view->time_job= $_POST['time_job'];
        $this->view->type_place= $_POST['type_place'];
      }else{
        MessageCollector::set_message('Заведение успешно создано','success');
      }
      $this->view->load('view_form_add_place.php', 'view_template.php');
    }
		
    public function action_form_add_place(){
      if($this->model->get_type_access() == admin)
        $this->view->load('view_form_add_place.php', 'view_template.php');
      else
        Route::ErrorPage(401);
    }
    
		public  function action_index(){}
	}
?>