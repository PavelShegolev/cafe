<?php if($data == false): ?>
<div align='center'>
<?php
    $warnings= MessageCollector::get_message('warning');
    if($warnings){
      foreach($warnings as $row){
        echo $row.'<br>';
      }
    }else{
      $errors= MessageCollector::get_message('error');
      if($errors){
        foreach($errors as $row){
          echo $row.'<br>';
        }
      }
    }
?>
</div>
<? else: ?>
  <h1 id='pos_header_place'><?php echo $data['name']?></h1>

  <div id='image_place_pos'>
    <img id='image_place' src=/place/image/<?php echo $data['image'].'?path_image='.$data['path_image'].$data['hash_image'];?>>
  </div>

	<div id='pos_inf_place'>
		<dl class="inf_place">
			<dt>Название заведения:</dt>
				<dd><?php echo $data['name']?></dd>
			<dt>Адрес:</dt>
				<dd><?php echo $data['address']?></dd>
			<dt>Телефон:</dt>
				<dd><?php echo $data['phone']?></dd>
			<dt>Время работы:</dt><dd><?php echo $data['time_job']?></dd>
		</dl>
	</div>

	<div id='pos_description'>
		<p id="_description"><?php echo $data['description'];?></p>
	</div id='pos_description'>
<? endif; ?>

