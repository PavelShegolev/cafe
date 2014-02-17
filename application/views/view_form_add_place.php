<div id='position_add_place'>
	<form action="/place/add_place" method="post" enctype="multipart/form-data" id="form_admin" <!--onSubmit="return check_filds_admin();"-->
		<h2>Добавить заведение</h2>
		<label for='name'>
			Название заведения:<input type='text' name='name' value='<?php echo $this->name?>'>
		</label><br>
			
		<label for='image_file'>
			Фотография:<input type='file' name='image_file'>
		</label><br>
		
		<label for='description'>
			Описание:<br><textarea cols='30' rows='5' name='description'><?php echo $this->description?></textarea>
		</label><br>
		
		<label for='address'>
			Адресс:<br><input type='text' name='address' value= '<?php echo $this->address?>'>
		</label><br>
		
		<label for='phone'>
			Номер телефона:<br><input type='tel' name='phone' value= '<?php echo $this->phone?>'>
		</label><br>
		
		<label for='time_job'>
			Время работы:<br><input type='text' name='time_job' value= '<?php echo $this->time_job?>'>
		</label><br>
		
		<label for='type_place'>
			Тип заведения:<br>
				<select name='type_place'>
					<option <?php if($this->type_place == bar) echo 'selected';?> value='1'>Бар</option>
					<option <?php if($this->type_place == restaurant) echo 'selected';?> value='2'>Ресторан</option>
					<option <?php if($this->type_place == cafe) echo 'selected';?> value='3'>Кафе</option>
				</select>
		</label>
			<input type="submit" value='Создать'>
	</form>

</div>