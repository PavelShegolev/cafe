<?php
class Controller_news extends Controller{
	public function __construct(){
		parent::__construct();
		$this->model= new Model_News();
	}
	
	public function action_index(){
		$data= $this->model->get_catalog_news();
		$this->view->generate('view_news.php', 'view_template.php',$data);
	}
	
	public function action_full_news($header){
		$data= $this->model->get_data_full_news($header);
		$this->view->generate('view_news.php', 'view_template.php',$data);
	}
		
	public function action_form_add_news(){
    if($this->model->get_type_access() == admin)
      $this->view->generate('view_form_add_news.php', 'view_template.php');
    else
      Route::ErrorPage(401);
	}

  public function action_add_news(){
    if($this->model->get_type_access() == admin){
      $result= $this->model->AddNews();
      if(!$result){
        $this->view->title= $_POST['title'];
        $this->view->text_news= $_POST['text_news'];
      }else{
        MessageCollector::set_message('Новость успешно создана.','success');
      }
      $this->view->load('view_form_add_news.php', 'view_template.php');
    }else
      Route::ErrorPage(401);
	}
  
}
?>