
<form action='users/password_recovery/send_email' method='post' class='password_recovery' id='form_recovery' onSubmit="return check_fild_email();" >
	<h2>Восстановление пароля</h2>
	<label for='email'>Укажите свой email адрес на который мы вышлем ваш пароль.</label><br>
	<input type='text' name='email' onclick="close_email_message()">
	<span id='correct_email'>Введите email адрес правильно</span>
	<input type='submit' value='отправить'><br>
</form>
