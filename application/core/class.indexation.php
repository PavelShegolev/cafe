<?php
	class Indexation extends Model{
		private $source_id;
		private $source;
		private $data;
		
		function __construct($source_id, $source, $data){
			$this->source_id= $source_id;
			$this->source= $source;
			$this->data= $data;
		}
		
		public function create_index(){
			$words_index= $this->processing_text($this->data);
			return $this->InsertTable($this->source_id, $this->source, $words_index);
		}
		
		private function processing_text($text){
			$temp= array();
			$text= $this->ToLower($text);//перевод строк в нижний региср
			$text= strtolower($text);					
			$text= preg_replace("#[\,\:\;\!\.\-\(\)]#i", " ", $text);//удаляем спец символы
			$text= explode(' ', $text);
			foreach($text as $word){ //удаляем короткие слова (меньше 3-х символов)
				if(strlen($word) >= 3)
					$temp[]= $word;
			}
			$text= implode(' ',$temp);
			$text= $this->deleteStopWords($text);
			$text= $this->stemming($text);
			return $text;
		}

		private function InsertTable($source_id, $source, $text_word_index){
			$query= "insert into search(source_id, source, text_word_index) values(".$source_id.",'".$source."','".$text_word_index."')";
			return parent::set_query($query);
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
		
		private function deleteStopWords($words){ //удаляем стоп-слова
			$reg = "/\s(без|более|был|были|было|быть|вас|вам|ведь|вдоль|весь|вместо|вне|вниз|внизу|внутри|вокруг|вот|все|всегда|всего|всех|где|давай|давать|даже|для|достаточно|его|если|есть|ещё|исключением|здесь|или|иметь|как|кто|когда|кроме|кто|либо|мне|может|мои|мой|навсегда|над|надо|наш|него|неё|нет|них|однако|она|они|оно|отчего|очень|под|после|потому|потому|почти|при|про|снова|так|также|такие|такой|там|тем|того|тоже|той|только|том|тут|уже|хотя|чего|чей|чем|что|чтобы|чьё|чья|эта|эти|это)\s/"; 
			$words = preg_replace($reg,' ',$words); 
			return $words;
		}
		
		private function ToLower($text){
			return strtr($text, 'ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁ', 'йцукенгшщзхъфывапролджэячсмитьбюё');
		}
		
		
	}
?>