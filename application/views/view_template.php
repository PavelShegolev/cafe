
<!DOCTYPE html>
	<head>
		<link rel="stylesheet" type="text/css" href="/css/template_style.css">
		<title>Отзывы кафе/бары/рестораны города Томск</title>
		<script src='/js/script.js' rel='text/jvascript'></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	</head>
	
	<body>
	<div id="image_head"></div>
		<div class='left'></div>
		<header>
			<nav>
				<div class="menu_position">
					<ul class="menu">
						<li><a href="/main_page">Главная</a></li>
						<li><a href="/place/catalog">Каталог заведений</a></li>
						<li><a href="/news">Новости</a></li>
					</ul>
				</div>
        
				<div id='pos_search'>
          <form action='/search' method='get' class='search_panel' onSubmit='return check_fild_search();'>
            <input type='text' name='text_search' class='edit' placeholder='Введите текст для поиска'>
            <input type='image' name='image1' src='data:image/png;base64,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' title='Поиск' alt='Поиск'>
          </form>
				</div>
			</nav>	
		</header><br>
			<div id='pos'>
				<div class='user_panel'>
						<?php
						@session_start();
						if(!is_null($_SESSION['nick_name'])){//переделать
							echo "<dl><dt>Вы вошли как:<dt><dd>".$_SESSION['nick_name']."</dd></dl>";
							echo "<a href='/users/logout'>Выйти</a>";
							echo '<a href="/users/personal_cabinet">Личный кабинет</a>';
						}else{
              echo '<a href="/users/login">Войти</a>
                    <a href="/users/form_registration">Регистрация</a>';
						}
						?>
				</div>
		</div>
		
		<?php include '../../'.host.'/application/views/'.$content_view?>
    
    <?php include '../../'.host.'/application/views/display_messages.php'?><!-- вывод сообщений -->
		
	</body>
</html>