<?phpheader("Content-type: text/html; charset=utf-8");  $NUMBERING_ENTITIES = array('1'=> 'Place', '2' => 'News');  define('warning','warning');  define('error','error');  define('success','success');  define('bar',1);  define('restaurant',2);  define('cafe',3);  define('E_CREATE_PLACE','При создании заведения произошла ошибка.');  define('E_CREATE_NEWS','При создании новости произошла ошибка.');  define('E_CREATE_USER','При регистрации произошла ошибка.');  define('E_AUTH_USER','При авторизации произошла ошибка.');  define('admin','admin'); // define('user','user');  define('male','Мужской');  define('female','Женский');  define('news','News');  define('place','Place');  define('STEP_PAGINATION',5);  define('host','localhost');  //define('host','78.139.197.27');	define('external_host','localhost');//'78.139.197.27'	define('user','pavel');	define('password','12345');	define('db','dbcafe');	define('google','http://www.google.com/');	define('facebook_client_id','268980116589541');	define('facebook_client_secret','d1e88e60a183b77aa0dd6a4b02518c69');	define('facebook_auth_url','www.facebook.com/dialog/oauth');	define('facebook_auth_token','https://graph.facebook.com/oauth/access_token');	define('facebook_user_url','https://graph.facebook.com/me');	define('vk_auth_token','https://oauth.vk.com/access_token');	define('vk_client_id','4053585');//4061819HL1qhIdrjag7WEKJ3O3b	//define('vk_client_id','4061819');	define('vk_client_secret','fywu571Xw1QCFtJRkJ7T');	//define('vk_client_secret','HL1qhIdrjag7WEKJ3O3b');	define('vk_auth_url','oauth.vk.com/authorize');	define('vk_url','https://api.vk.com/method/users.get');	?>