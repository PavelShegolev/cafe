<div id='search'>
	<div id='search_result'>
  
  <?php if($this->data['data'] !== false and $this->data['data'] !== null): ?>
    <?php
      foreach($this->data['data'] as $row){
        if(news == $row['source']){
          $data= $row;
          include 'view_search_result_news.php';
        }elseif(place == $row['source']){
          $data= $row;
          include 'view_search_result_place.php';
       }
      }
    ?>
 
    <?php
        if($this->count_page > 1){
          echo 'Страница:'; 
          for($i=1; $i <= $this->count_page; $i++){
            echo ' <a href=/search?page='.$i.'&text_search='.$this->text_search.'>'.$i.'</a>';
          }
        }
    ?>

    <? endif; ?>
    
	</div>
</div>