<?php 
	
	return array(

		'web' => 'SolarP+us',

		'languages' => array( 'ua' , 'ru' , 'pl' , 'uk'  ),

		'fromDB' => R::findAll( $_SESSION['language'] , 'uri LIKE ?' , [$_SERVER['REQUEST_URI']] ),

		// HEADER
		'langImg' => '/Public/Img/icons/flags/ua.gif',
		'lang' => 'Українська',
		'toChooseLang' => array( 
								'ru' => 'Русский' , 
								'pl' => 'Polski' , 
								'uk' => 'English' ),
		'auth' => 'Авторизація',
		'register' => 'Реєстрація',
		'logout' => 'Вихід',
		'admin' => 'Адмін панель',
		
		// CATALOG
		'home' => 'Головна',
		'catalog' => 'Каталог',
		'sunPanels' => 'Сонячні панелі',
		'invertors' => 'Інвертори',
		'cablesConnectors' => 'Кабелі і конектори',
		'mountingStructures' => 'Монтажні конструкції',
		'accessories' => 'Комплектуючі',

		// REGISTER
		'ERROR:login' => '<center style="background:#FF6767"><b>Поле "Логін" пусте! Будь ласка введіть данні!</b></center>',
		'ERROR:email' => '<center style="background:#FF6767"><b>Поле "Пошта" пусте! Будь ласка введіть данні!</b></center>',
		'ERROR:name' => '<center style="background:#FF6767"><b>Поле "Ім\'я" пусте! Будь ласка введіть данні!</b></center>',
		'ERROR:phone' => '<center style="background:#FF6767"><b>Поле "Мобільний номер" пусте! Будь ласка введіть данні!</b></center>',
		'ERROR:password' => '<center style="background:#FF6767"><b>Поле "Пароль" пусте! Будь ласка введіть данні!</b></center>',
		'ERROR:password_2' => '<center style="background:#FF6767"><b>Поле "Повторний пароль" пусте! Будь ласка введіть данні!</b></center>',
		'ERROR:passwords' => '<center style="background:#FF6767"><b>Паролі не співпадають!</b></center>',
		'ERROR:injectionLogin' => '<center style="background:#FF6767"><b>Такий логін існує!</b></center>',
		'ERROR:injectionEmail' => '<center style="background:#FF6767"><b>Така пошта існує!</b></center>',

		'login' => 'Логін',
		'email' => 'Пошта',
		'name' => 'Ім\'я',
		'phone' => 'Мобільний номер',
		'password' => 'Пароль',
		'password_2' => 'Повторіть пароль',
		'reklama' => 'Реклама',
			
		// LOGIN
		'ERROR:loginFail' => '<center style="background:#FF6767">Такого логіна не існує!</b></center>',
		'ERROR:passwordFail' => '<center style="background:#FF6767">Неправильний пароль!</b></center>',
		'cookie' => ' не виходити з системи',

		// ADMIN
		'catalogCategories' => 'Категорії в каталозі',
		'callCalled' => 'Викликані дзвінки',
		'messages' => 'Зворотній зв\'язок',
		'users' => 'Користувачі',
		'addModerator' => 'Додати модератора',
		'createModerator' => 'Створити модератора',
			// /admin/categories
			'btn:addCategorie' => 'Додати категорію',
			'btn:add' => 'Додати',
			'btn:addProduct' => 'Добавити продукт',
			'btn:look' => 'Дивитись',
			'btn:delete' => 'Видалити',
			'btn:edit' => 'Редагувати',
			'btn:addFirm' => 'Додати бренд',
			'btn:tarif' => 'Зелений тариф',

	);