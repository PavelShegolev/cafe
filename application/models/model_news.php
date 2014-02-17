<?php
	class Model_News extends Model implements Iinfo{
		public function __construct(){
			parent::connect();
		}

    private function Indexation($text){
      //--------внесение данных в таблицу поиска-------//
      $id_news= $this->GetLastId();
      $indx= new Indexation($id_news['id'],2,$text);
      $result= $indx->create_index();
      return $result;
    }
        
    private function DeleteLastNews(){
      $query= 'delete from news where id='.$this->GetLastId();
      parent::set_query($query);
    }
  
		private function redcution_news($data){
			$temp;
			$result;
			foreach($data as $row){
				$temp['text_news']= $row['text_news'].'...<a href=/news/full_news/'.$row['header'].'>подробнее</a>';
				$temp['title']= $row['title'];
				$result[]= $temp;
			}
			return $result;
		}
		
		public function Get_Data_onid($ids){
			$query="select title,header, SUBSTRING(text_news,1,250) as text_news from news where id in(".$ids.")";
			$data= parent::get_rows($query);
			$result= $this->Processing_Data($data);
			return $result;
		}
		
		public function Processing_Data($data){
			foreach($data as $row){
				$temp_arr['url']= '/news/full_news/'.$row['header'];
				$temp_arr['name']= $row['title'];
				$temp_arr['description']= $row['text_news'];
        $temp_arr['source']= 'News';
				$result[]= $temp_arr;
			}
			return $result;
		}
    
    public function GetLastId(){
      $query= 'select id from news order by id desc limit 1';
      return parent::get_row($query);
    }
    
    private function check($value){
      return parent::$link->real_escape_string($value);
    }
    
    private function check_fields(){
      $result= true;
      if(empty($_POST['title'])){
        MessageCollector::set_message('Поле заголовок не должен быть пустым', warning);
        $result= false;
      }
      if(empty($_POST['text_news'])){
        MessageCollector::set_message('Поле текст новости не должен быть пустым', warning);
        $result= false;
      }
      return $result;
    }
    
    private function translit($str) 
    {
      $str=  trim(mb_strtolower($str, 'UTF-8'));
      $tr = array("а"=>"a","б"=>"b","в"=>"v","г"=>"g",
                  "д"=>"d","е"=>"e","ж"=>"j", "з"=>"z",
                  "и"=>"i","й"=>"y","к"=>"k","л"=>"l",
                  "м"=>"m","н"=>"n","о"=>"o","п"=>"p",
                  "р"=>"r","с"=>"s","т"=>"t","у"=>"u",
                  "ф"=>"f","х"=>"h","ц"=>"ts","ч"=>"ch",
                  "ш"=>"sh","щ"=>"sh","ъ"=>"y","ы"=>"yi",
                  "ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya"," "=>"-"
                 );
      return strtr($str,$tr);
    }
    
    
    public function AddNews(){
      if(!$this->check_fields()){
        return false;
      }
      $title= $this->check($_POST['title']);
      $text_news= $this->check($_POST['text_news']);
      $header= $this->translit($title);
      $query= "insert into news(title,header,text_news) values('".$title."','".$header."','".$text_news."')";
      if(!parent::set_query($query)){
        MessageCollector::set_message(E_CREATE_NEWS, error);
        return false;
      }else{
        if(!$this->Indexation($text)){
          MessageCollector::set_message(E_CREATE_NEWS, error);
          $this->DeleteLastNews();
          return false;
        }
      }
      return true;
    }
		
		public function get_catalog_news(){
			$query="select title, header, SUBSTRING(text_news,1,50) as text_news from news";
			$result= parent::get_rows($query);
			$result= $this->redcution_news($result);
			return $result;
		}
		
		public function get_data_full_news($header){
			$header= $this->check($header);
			$query="select title,text_news from news where header='".$header."'";
			$result= parent::get_rows($query);
			return $result;
		}
		
    public function get_type_access(){
			session_start();
			return $_SESSION['type_a'];
		}
    
	}
?>