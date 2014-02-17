<?php
	class Controller_page_error_401 extends Controller{
		public function action_index(){
			$this->view->generate_content('view_page_error_401.php');
		}
	}
?>