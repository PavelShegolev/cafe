<div id='comments_position'>
	<?php include 'comments.php'?>
</div>
<div id='panel_position'>
	<form action='/place/add_comment' method='post' id='panel'>
		<textarea cols='60' rows='5' name='text_comment' placeholder='Оставьте свой комментарий'required spellcheck=true></textarea><br>
		<a href='#' onclick="addSmile('[angrys]'); return false;"><img src='/images/smile/220.gif' alt='злые'><a/>
		<a href='#' onclick="addSmile('[user]'); return false;"><img src='/images/smile/424.gif' alt='пользователь'><a/>
		<a href='#' onclick="addSmile('[angry]'); return false;"><img src='/images/smile/angry.gif' alt='злой'><a/>
		<a href='#' onclick="addSmile('[bann]'); return false;"><img src='/images/smile/bann.gif' alt='bann'><a/>
		<a href='#' onclick="addSmile('[cowboy]'); return false;"><img src='/images/smile/cowboy.gif' alt='ковбой'><a/>
		<a href='#' onclick="addSmile('[dark]'); return false;"><img src='/images/smile/dark1.gif' alt='ко-тер'><a/>
		<a href='#' onclick="addSmile('[djedays]'); return false;"><img src='/images/smile/emporerslightning.gif' alt='джедай'><a/>
		<a href='#' onclick="addSmile('[fyte_djed]'); return false;"><img src='/images/smile/LSVADER.gif' alt='бой джедаев'><a/>
		<a href='#' onclick="addSmile('[sleep]'); return false;"><img src='/images/smile/sleep2.gif' alt='сон'><a/>
		<a href='#' onclick="addSmile('[spam]'); return false;"><img src='/images/smile/spam.gif' alt='спам'><a/>
		<br><input type='submit' value='Отправить'>
	</form>
</div>