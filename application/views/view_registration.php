<div id='parent_window'>
	<div class='popup_window_registration'>
		<div style="cursor: pointer;" align='right' onclick="close_popup();">
			<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAG7AAABuwBHnU4NQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAPnSURBVEiJ1ZX9S1tXGMe/zz1XXXKjSUHWrUKiRgqymVGLq7Z2VitFIy2mZasaXTeZozDo1v66P8FuZbAJ7ToGraXSoX35YR1UV8YmWlvj2KsvtZoivqammsSYe0/u2Q9qq/Zm+2Vl7MDhHA4Pn89zngfOISEEnueQniv9PxU4iayNRN/sJdqVKCaPyNlI1JFP5EhoEEI8M7MB68eK8v3vx4+L8w7H+D6gcHPMq4Cz2Wb7ub+qSjRbLL4dgMOIRZub7CSy1irK1XdOnSo1ZWdDm59H15kz/ssTE7WdQvQAwE6inBqrtb3S43ExRYE6N4vO774duLQY8fiE8K/nbRBsgGdlQVdVCFVdkZw9+/DK1FRNGAgctlrbq6qr8+RUM8A1gKvQgwF0dt3ytS1rh7ujTyXyelsJcL6uoaHUlJkJPRZ7IqDkZJR4vXZqvdAWikVDbs+hV5IsJoDHQEJDfH4K3D+KEhPPnwEurKAMBCPA6Z6bNwvKsrIcUkoKdFUFuArSNCSbklD+dp0dXAXpcYhoCNron+D+UWBpATIDHkqYGYzjdMISAUApUWG9PaOtrLHRwVKSAa4CXAPxVRlXwecmsdxzGxSLgDGAScBoHLNfPUbT5aC48bcCAChPoqJ37S+1vVFba5eSk0Crdaa4Cm3kN2i/9IFRHNIq/D7H3Ll5NF0KiOubWYYCAKg0U9F7jhfbit88aifBQVyD6vsRun9oJWsGgDEMaxQ4Ny01XQzErhlxZKNDAFhKQmCZL4VkfRkS4tAnhiBPD4PMMiAzEGMgWUY0IsIRxmcScQxvUGqlnKaM1A63250nKQpEKAi15xZA4gl4ZWUgJuPuIh/7cizivTKx2POPgj02cp6w2zoqqtwuyawAXIN67zYQDa+DrkjAnu77guqDlsFZb/vYQm/CEu2xkfMjZ3p7hdvtIrMCxDn04AwkXQMp5o3g1ezXhLutadlMMbVWb0/3XhsO3DEU7N9iaq7YV/yalJoGiDggCAgFwBQzSJYxGOaBiEbhgq1K5jM3kRl2p6U6fw3pnwAoXmNueE27Y+JkV//AANQISCJIFIfEY5AsCoY0mmt5EGxqGX5UdzfEx5iiQLIokBQzmEUBUxT4HqsjfY/CJxKWqGsy6t+/bYtHMvdePbC3aIdYWoBkfgGDi+psy+D8+1//EbgOAG/lbvUyi6W1yJGevdaXvsmFkS/6x2su3hv3bWiq0RPrzrI5bnhc/dGTZWLg2OvTx1zbDm2OOerKKOz+oPy++LRe9H5YOVy/MyffiGUoEELAnfuy47MDuT805NsPJoo54src9fmRgp8SwQ3/g397/P8//b8AmD8v2lMA0jMAAAAASUVORK5CYII=' alt='закрыть' title= 'закрыть'>
		</div>
		<form action="/users/registration" method="get" id="reg_form" class="register_form" <!--onSubmit="return check_filds_register();"-->>

				<h2>Регистрация</h2>
				<div>(*)обязательные поля для заполнения.</div>
				<label for='nick_name'>
					Ваше имя:<br><input type="text" name="nick_name" maxlength="50" onclick="close_nick_message_r()" value='<?php echo $this->nick;?>' ><sup>*</sup><span id='empty_nick_r'>Заполните поле Имя</span><span id='message_incorrect_nick_r'>Вводить можно только русские, латинские буквы и цифры</span><br>
				</label>
				
				<label for='login'>
					Логин:<br><input type="text" name="login" maxlength="50" onclick="close_login_message_r()"><sup>*</sup><span id='empty_login_r'>Заполните поле логин</span><span id='message_incorrect_login_r'>Вводить можно только латинские буквы и цифры</span><br>
				</label>
				
				<label for='password'>
					Пароль:<br><input type="password" name="password" maxlength="255" onclick="close_password_message_r()"><sup>*</sup><span id='empty_password_r'>Заполните поле пароль</span><span id='message_incorrect_password_r'>Вводить можно только латинские буквы и цифры</span><br>
				</label>
				
				<label for='email'>
					e-mail:<br><input type="text" name="email" maxlength="50" onclick="close_password_email_r()" value='<?php echo $this->email;?>'></span><span id='message_incorrect_email_r'>Введите email адрес правильно</span><br>
				</label>
				
				<label for='age'>
					Ваш возвраст:<br><input type="text" name="age" maxlength="50" onclick="close_age_message_r()" value='<?php echo $this->age?>'><span id='message_incorrect_age_r'>Вводить можно только цифры</span><br>
				</label>
				
				<label for='mail'>
					Ваш пол:<br><input type="radio" name="gender" value="Мужской" <?php if($this->gender == male) echo 'checked';?>>Мужской
									<input type="radio" name="gender" value="Женский" <?php if($this->gender == female) echo 'checked';?>>Женский
				</label><br>
					
				<input type='submit' name="s" value="  Зарегистрироваться  " id="submit1">
		</form>
    
	</div>
</div>