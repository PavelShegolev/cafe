 <?php
	class Model_search extends Model{
		private $temp_arr= array();
		private $incorrect_layout;
		public function __construct(){
			parent::connect();
		}
    
	  private function stemming($text){//выделяем корень слова
			$temp= array();
			$stemmer = new Lingua_Stem_Ru();  
			$text= explode(' ', $text);
			foreach($text as $word)
				$temp[]=  $stemmer->stem_word($word); 
			$text= implode(' ',$temp);
			return $text;
		}
    
		private function light_finding_text($data, $text_search){
			$text_search= explode(' ',$text_search);
			setlocale(LC_ALL, 'ru_RU.CP1251', 'rus_RUS.CP1251', 'Russian_Russia.1251');
			foreach($text_search as $word){
				$i=0;
				foreach($data as $row){
					$row['description']= str_ireplace($word,"<b>".$word."</b>",$row['description']);
					$data[$i++]['description']= $row['description'];
				}
			}
			return $data;
		}

		private function get_list_ids($data){
		$result= array();
		foreach($data as $row){
      $type = $row['source'];
			if(isset($result[$type])) {
				$result[$type].= ','.$row['source_id'];
			} else
				$result[$type] = $row['source_id'];
		}
			return $result;
		}
		
		private function build_result($data){
			$data_result= array();
      $numbering= $GLOBALS["NUMBERING_ENTITIES"];
			$data= $this->get_list_ids($data);
			foreach($data as $key=>$value){
				unset($data[$key]);
				$data[$numbering[$key]]= $value;
			}
			foreach($data as $class_name=>$ids){
				$obj= Factory::get_obj($class_name);
				$temp= $obj->Get_Data_onid($ids);
				$data_result= array_merge($data_result, $temp);
			}
			
      return $data_result;
    }
    
    private function check($value){
      return parent::$link->real_escape_string($value);
    }
		
		public function search_text(){
      $text_search= $this->check($_GET['text_search']);
      $begin_row= 0;
      $end_row= STEP_PAGINATION;
   
      if(isset($_GET['page'])){
        $page_number= $this->check($_GET['page']);
        $begin_row= ($page_number > 1) ? ($page_number*$end_row -$end_row) : 0; 
        $end_row*= $page_number;
      }
			$text= $this->stemming($text_search);
			$query="SELECT DISTINCT SQL_CALC_FOUND_ROWS source,source_id from search WHERE MATCH (text_word_index) AGAINST ('".$text_search."') limit ".$begin_row.', '.$end_row;
			$result= parent::get_rows($query);   
      $found_rows= parent::get_row("SELECT FOUND_ROWS()");
			$found_rows= $found_rows['FOUND_ROWS()'];
      if($result === false){
        MessageCollector::set_message('Произошла ошибка',error);
        return false;
      }
			if($result === null){
        MessageCollector::set_message('Искомая комбинация слов нигде не встречается.',success);
        return null;
			}else{  
				$result= $this->build_result($result);
        //подсветка найденных слов
        $result= $this->light_finding_text($result, $_GET['text_search']);
			}
			$result['info']['text_search']= str_replace(' ','_',($_GET['text_search']));
			$result['info']['count_page']= ceil($found_rows/5);

			return $result;
		}
		
	}
?>