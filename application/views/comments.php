<?php if($data === false):?>
  <?php 
    $errors= MessageCollector::get_message('error');
     if($errors){
      foreach($errors as $row){
        echo $row.'<br>';
      }
    }
  ?>
<?php else: ?>
	<?php function text_add_smile($text){
        $smiles=array ('[angrys]'=>'<img src="/images/smile/220.gif">',
                       '[user]'=>'<img src="/images/smile/424.gif">',
                       '[angry]'=>'<img src="/images/smile/angry.gif">',
                       '[bann]'=>'<img src="/images/smile/bann.gif">',
                       '[cowboy]'=>'<img src="/images/smile/cowboy.gif" >',
                       '[cowboy]'=>'<img src="/images/smile/cowboy.gif" >',
                       '[dark]'=>'<img src="/images/smile/dark1.gif">',
                       '[djedays]'=>'<img src="/images/smile/emporerslightning.gif">',
                       '[fyte_djed]'=>'<img src="/images/smile/LSVADER.gif">',
                       '[sleep]'=>'<img src="/images/smile/sleep2.gif">',
                       '[spam]'=>'<img src="/images/smile/spam.gif">',
                      );
        $text= strtr($text,$smiles);
        return $text;
      }
      
      if(!is_null($data)){
        foreach($data as $row){
            echo "<div class='comments'>".
            $row['nick_name'].' написал:<br>'.
            text_add_smile($row['info']).'<br>'.
            $row['date_'].' в '.
            $row['time_'].'<br>'.
            "</div><br>";
        }
      }
  ?>
<?php endif; ?>