	<div id='parent_window'>
		<div class='popup_window'>
			<div style="cursor: pointer;" align='right' onclick="close_popup();">
				<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAG7AAABuwBHnU4NQAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAPnSURBVEiJ1ZX9S1tXGMe/zz1XXXKjSUHWrUKiRgqymVGLq7Z2VitFIy2mZasaXTeZozDo1v66P8FuZbAJ7ToGraXSoX35YR1UV8YmWlvj2KsvtZoivqammsSYe0/u2Q9qq/Zm+2Vl7MDhHA4Pn89zngfOISEEnueQniv9PxU4iayNRN/sJdqVKCaPyNlI1JFP5EhoEEI8M7MB68eK8v3vx4+L8w7H+D6gcHPMq4Cz2Wb7ub+qSjRbLL4dgMOIRZub7CSy1irK1XdOnSo1ZWdDm59H15kz/ssTE7WdQvQAwE6inBqrtb3S43ExRYE6N4vO774duLQY8fiE8K/nbRBsgGdlQVdVCFVdkZw9+/DK1FRNGAgctlrbq6qr8+RUM8A1gKvQgwF0dt3ytS1rh7ujTyXyelsJcL6uoaHUlJkJPRZ7IqDkZJR4vXZqvdAWikVDbs+hV5IsJoDHQEJDfH4K3D+KEhPPnwEurKAMBCPA6Z6bNwvKsrIcUkoKdFUFuArSNCSbklD+dp0dXAXpcYhoCNron+D+UWBpATIDHkqYGYzjdMISAUApUWG9PaOtrLHRwVKSAa4CXAPxVRlXwecmsdxzGxSLgDGAScBoHLNfPUbT5aC48bcCAChPoqJ37S+1vVFba5eSk0Crdaa4Cm3kN2i/9IFRHNIq/D7H3Ll5NF0KiOubWYYCAKg0U9F7jhfbit88aifBQVyD6vsRun9oJWsGgDEMaxQ4Ny01XQzErhlxZKNDAFhKQmCZL4VkfRkS4tAnhiBPD4PMMiAzEGMgWUY0IsIRxmcScQxvUGqlnKaM1A63250nKQpEKAi15xZA4gl4ZWUgJuPuIh/7cizivTKx2POPgj02cp6w2zoqqtwuyawAXIN67zYQDa+DrkjAnu77guqDlsFZb/vYQm/CEu2xkfMjZ3p7hdvtIrMCxDn04AwkXQMp5o3g1ezXhLutadlMMbVWb0/3XhsO3DEU7N9iaq7YV/yalJoGiDggCAgFwBQzSJYxGOaBiEbhgq1K5jM3kRl2p6U6fw3pnwAoXmNueE27Y+JkV//AANQISCJIFIfEY5AsCoY0mmt5EGxqGX5UdzfEx5iiQLIokBQzmEUBUxT4HqsjfY/CJxKWqGsy6t+/bYtHMvdePbC3aIdYWoBkfgGDi+psy+D8+1//EbgOAG/lbvUyi6W1yJGevdaXvsmFkS/6x2su3hv3bWiq0RPrzrI5bnhc/dGTZWLg2OvTx1zbDm2OOerKKOz+oPy++LRe9H5YOVy/MyffiGUoEELAnfuy47MDuT805NsPJoo54src9fmRgp8SwQ3/g397/P8//b8AmD8v2lMA0jMAAAAASUVORK5CYII=' alt='закрыть' title= 'закрыть'>
			</div>
			<h2>Авторизация</h2>

				<label>Войдите с помощью:</label>
				<a href='/users/login_openid/yandex'><img src='/images/yandex1.png' alt='яндекс' title='Войти с помощью яндекс'></a>
				<a href='/users/login_openid/google'><img src='/images/google.png' alt='google' title='Войти с помощью google'></a>
				<a href='/users/login_oauth/facebook'><img src='/images/facebook.png' alt='facebook' title='Войти с помощью facebook'></a>
				<a href='/users/login_oauth/vk'><img src='/images/vk.png' alt='vk.com' title='Войти с помощью вконтакте'></a>
			<hr width='520'>
			<form action="/users/authorization" method="post" id="form_login" onSubmit="return check_filds_login();">
				<label for='login'>Логин или email:</label><a href='/users/form_registration'id='reg'>Зарегистрироваться</a><br>
				<input type='text' name='login' id='edit_login' onclick="close_login_message()" value='<?php echo $this->old_login?>'><span id='empty_login'>Заполните поле логин</span><span id='message_incorrect_login'>Вводить можно только латинские буквы,цифры и символы("@","-",".")</span>
				<?php  if($this->login == 'incorrect_login')  
									echo "<span id='login_error_massage'>Неверный логин</span>"; ?>
				<br>
				<label for='password'>Пароль:</label><a href='/users/password_recovery'id='pas'>Вспомнить пароль</a><br>
				<input type='password' name='password' id='edit_password' onclick='close_password_message();'><span id='empty_password'>Заполните поле пароль</span><span id='message_incorrect_password'>Вводить можно только латинские буквы и цифры</span>
				<?php  if($this->password == 'incorrect_password')
								 echo "<span id='pass_error_massage'>Неверный пароль</span>";?><br>
				<input type="submit" value='Войти' id='button_login' onclick="return block_button();"> 
			</form>
			<div id='time_block'></div>
			<?php
				if($this->count_logging > 2)
					echo"<script type='text/javascript'>message_block_logging();</script>";
				if($this->data===true)
					echo"<script type='text/javascript'>close_popup();</script>";
			?>
		</div>
	</div>