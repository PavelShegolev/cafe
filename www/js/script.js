function display_map(){
		document.getElementById('map').style.display='inline-block';	
}
function check_fild_email(){
	var email= form_recovery.email.value;
	 return checkemail(email);
}
function checkemail(string){
	var pattern=/^[0-9a-z_]+@[0-9a-z_]+\.[a-z]/i;
	if(!pattern.test(string)){
		document.getElementById('correct_email').style.display='inline-block';	
		return false;
	}else{
		return true;
	}
}
function close_age_message_r(){
	document.getElementById('message_incorrect_age_r').style.display='none';
}
function close_mail_message_r(){
	document.getElementById('message_incorrect_email_r').style.display='none';
}
function close_nick_message_r(){
	document.getElementById('message_incorrect_nick_r').style.display='none';
	document.getElementById('empty_nick_r').style.display='none';
}
function close_login_message_r(){
	document.getElementById('message_incorrect_login_r').style.display='none';
	document.getElementById('empty_login_r').style.display='none';
}
function close_password_message_r(){
	document.getElementById('message_incorrect_password_r').style.display='none';
	document.getElementById('empty_password_r').style.display='none';
}

function close_email_message(){
	document.getElementById('correct_email').style.display='none';
}
function close_login_message(){
	document.getElementById('message_incorrect_login').style.display='none';
	document.getElementById('empty_login').style.display='none';
}
function close_password_message(){
	document.getElementById('message_incorrect_password').style.display='none';
	document.getElementById('empty_password').style.display='none';
}
function close_popup(){
	document.getElementById('parent_window').style.display='none';
}
count= 5;
block_button_= false;
function block_button(){
	return !block_button_;
}
function message_block_logging(){
	block_button_= true;
	document.getElementById('time_block').innerHTML='Использованно максимальное число попыток входа в систему. Следующая через: '+count+' cекунд.';
	if(count > 0){
		count=count - 1;
		setTimeout(message_block_logging,1000);
	}else{
		block_button_= false;
		document.getElementById('time_block').innerHTML='Теперь можно повторить попытку';
	}
}
function addSmile(smile){
	var text= panel.text_comment.value;
	var after_text= text+smile;
	panel.text_comment.value= after_text;
}

function check_fild_search(){
	var text= form_search.text_search.value;
	var pattern=/^[0-9a-zа-яё\s\-]*$/i;
	if(!pattern.test(text) || text == ''){
		alert('Строка поиска может состоять только из латинских, русских букв и цифр.');
		return false;
	}else{
		return true;
	}
}
function check_filds_admin(){
	var name= form_admin.name.value;
	var description= form_admin.description.value;
	var	address= form_admin.address.value;
	var phone= form_admin.phone.value;
	var time_job= form_admin.time_job.value;
	
	if(empty_admin_filds())
		return false;
	if(check_nam(name))
		return false;
	if(check_description(description))
	 	return false;  
	if(check_address(address))
		return false;
	if(check_phone(phone))
		return false;
	if(check_time_job(time_job))
		return false;
	return true;
}

function check_address(string){
	var pattern=/^[0-9a-zа-яёА-ЯЁ\s\.\-\;\,\/]*$/i;
	if(!pattern.test(string)){
		alert('Адресс может состоять только из латинских, русских букв и цифр.');
		return true;
	}else{
		return false;
	}
}

function check_description(string){
	var pattern=/^[0-9a-zа-яёА-ЯЁA-Z\s\.\-\;\,]*$/i;
	if(!pattern.test(string)){
		alert('Описание может состоять только из латинских, русских букв и цифр.');
		return true;
	}else{
		return false;
	}
}

function check_nam(string){
	var pattern=/^[0-9a-zа-яёА-ЯЁA-Z\s]*$/i;
	if(!pattern.test(string)){
		alert('Имя может состоять только из латинских, русских букв и цифр.');
		return true;
	}else{
		return false;
	}
}

function check_phone(string){
	var pattern=/^[0-9\-]*$/i;
	if(!pattern.test(string)){
		alert("Поле номер телефона может состоять только из цифр и занаков '-'");
		return true;
	}else{
		return false;
	}
}

function check_time_job(string){
	var pattern=/^[0-9\:\.\-\,\s]*$/i;
	if(!pattern.test(string)){
		alert("Поле время может состоять только из цифр и занаков '-',':'.");
		return true;
	}else{
		return false;
	}
}

function empty_admin_filds(){
	if(form_admin.name.value == '' || form_admin.description.value == '' 
		 || form_admin.address.value == '' || form_admin.phone.value == ''
		 || form_admin.time_job.value == '' || form_admin.image_file.value == ''){
		alert('Все поля должны быть заполнены.');
		return true;
	}
		return false;
}
function check_filds_login(){
	var login= form_login.login.value;
	var	password= form_login.password.value;
	
	if (empty_login_filds()){
		return false;
	}else{
		if(check_login(login) && check(password)){
			return true;
		}else{
			if(!check_login(login))
				document.getElementById('message_incorrect_login').style.display='inline-block';
			if(!check(password))
				document.getElementById('message_incorrect_password').style.display='inline-block';
			return false;
		}
	}
}

function empty_login_filds(){
	if(form_login.login.value == ''){
		document.getElementById('empty_login').style.display='inline-block';
		return true;
	}
	if(form_login.password.value == ''){
		document.getElementById('empty_password').style.display='inline-block';	
		return true;
	}
	return false;
	//if(form_login.login.value == '' || form_login.password.value == ''){
	//	alert('Поля логин и/или пароль не должены быть пустыми');
	//	return true;
	//}
	//	return false;
}

function check_filds_register(){
	//close_nick_message();
	//close_login_message();
	//close_password_message();
	var nick_name= reg_form.nick_name.value;
	var	login= reg_form.login.value;
	var password= reg_form.password.value;
	var	email= reg_form.email.value;
	var age= reg_form.age.value;
	
	if (empty_register_filds()){
		return false;
	}else{
		if(check(login) && check(password) && check_age(age) && check_nick(nick_name) && check_email(email)){
			return true;
		}else{
			if(!check(login)){
				document.getElementById('message_incorrect_login_r').style.display='inline-block';
				return false;
			}
			if(!check(password)){
				document.getElementById('message_incorrect_password_r').style.display='inline-block';
				return false;
			}
			if(!check_age(age)){
				document.getElementById('message_incorrect_age_r').style.display='inline-block';
				return false;
			}
			if(!check_nick(nick_name)){
				document.getElementById('message_incorrect_nick_r').style.display='inline-block';
				return false;
			}
			if(!check_email(email)){
				document.getElementById('message_incorrect_email_r').style.display='inline-block';
				return false;
			}
			return false;
		}
	}
}

function empty_register_filds(){
	if(reg_form.nick_name.value == ''){
		document.getElementById('empty_nick_r').style.display='inline-block';
		return true;
	}
	if(reg_form.login.value == ''){
		document.getElementById('empty_login_r').style.display='inline-block';
		return true;
	}
	if(reg_form.password.value == ''){
		document.getElementById('empty_password_r').style.display='inline-block';	
		return true;
	}
	return false;
}

function check_email(string){
	if(string == '')
		return true;
	var pattern=/^[0-9a-z_]+@[0-9a-z_]+\.[a-z^\s]*$/i;
	if(pattern.test(string)){
		return true;
	}else{
		return false;
	}
}

function check_nick(string){
	var pattern=/^[a-zA-Aа-яА-Я0-9^\s]*$/i;
	if(pattern.test(string)){
		return true;
	}else{
		return false;
	}
}

function check_name(string){
	var pattern=/^[0-9a-zа-я]/i;
	if(!pattern.test(string)){
		alert('Имя может состоять только из латинских, русских букв и цифр.');
		return true;
	}else{
		return false;
	}
}

function check_age(string){
	if(string == '')
		return true;
		var pattern=/^[\d]$/i;
	if(pattern.test(string)){
		return true;
	}else{
		return false;
	}
	
}

function check(string){
	var pattern=/^[a-zA-A0-9^\s]*$/i;
	if( pattern.test(string)){
		return true;
	}else{
		return false;
	}
}

function check_login(string){
	var pattern=/^[\.\@\-a-zA-A0-9^\s]*$/i;
	if( pattern.test(string)){
		return true;
	}else{
		return false;
	}
}


