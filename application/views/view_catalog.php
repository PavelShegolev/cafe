<div id='catalog_pos'>
	<div class="catalog">
		<h2>Бары</h2>
		<ul>
			<?php
				foreach($data as $row){
					if($row['type_'] == 1){
						echo "<li><a href='/place/places/".$row['name_no_space']."'>".$row['name']."</a><br></li>";
					}
				}
			?>
		</ul>

		<h2>Рестораны</h2>
		<ul>
			<?php
				foreach($data as $row){
					if($row['type_'] == 2){
						echo "<li><a href='/place/places/".$row['name_no_space']."'>".$row['name']."</a><br></li>";
					}
				}
			?>
		</ul>

		<h2>Кафе</h2>
		<ul>
			<?php
				foreach($data as $row){
					if($row['type_'] == 3){
						echo "<li><a href='/place/places/".$row['name_no_space']."'>".$row['name']."</a><br></li>";
					}
				}
			?>
		</ul>
	</div>
</div>
