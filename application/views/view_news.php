<div id='news_position'>
	<div id='news'>
		<?php
			if(!is_null($data)){
				foreach($data as $row){
					echo '<h2>'.$row['title'].'</h2><br>'.$row['text_news'].'<br>';
				}
			}
		?>
	</div>
</div>