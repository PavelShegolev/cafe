<div align='center'>
  <?php
    $messages= MessageCollector::get_message(success);
    if($messages){
      foreach($messages as $row){
          echo $row.'<br>';
      }
    }
    
    $messages= MessageCollector::get_message(warning);
    if($messages){
      foreach($messages as $row){
        echo $row.'<br>';
      }
    }
    
    $messages= MessageCollector::get_message(error);
    if($messages){
      foreach($messages as $row){
        echo $row.'<br>'; 
      }   
    }
  ?>
</div>