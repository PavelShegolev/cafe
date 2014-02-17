<?php
	class Controller_search extends Controller{
		public function __construct(){
		parent::__construct();
		$this->model= new Model_search();
	}

		public function action_index(){
			$data= $this->model->search_text();
      if($data !== false and $data !== null){
        $this->view->count_page= $data['info']['count_page'];
        $this->view->text_search= $data['info']['text_search'];
      }
      $this->view->data= $data;
      $this->view->load('view_search_result.php', 'view_template.php');
		}
		
	}
?>