<div id='create_news'>

  <form action='/news/add_news' method='post'>
    <h1>Создать новость</h1>
    <label for='title'>Заголовок</label>
    <input type='text' name='title' value='<?php echo $this->title?>'><br>
    <label for='text_news'>Текст новости</label><br>
    <textarea cols='30' rows='5' name='text_news'><?php echo $this->text_news?></textarea><br>
    <input type='submit' value='Создать'><br>
  </form>
  <br>
  
</div>
