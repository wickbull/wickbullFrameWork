<?php 

	

	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/config.php';

	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/language.php';

	require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/vendor/redbean/rb.php';

	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/vendor/ckeditor/index.php';

	
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/uri.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/view.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/creatorController.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/controller.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/route.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/router/router.php';

	use App\Models\Config;
	use App\Core\Route;
	// use App\Vendor\ORM\Orm;
	

	Route::start(); // запускаем маршрутизатор