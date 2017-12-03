<?php 
		
	// тут головне щоб post або get метод був в кінці, все остальне може бути де завгодно!

	use App\Core\Route;

	// POST
		Route::controller( 'indexController' )->method( 'index' )->post( '/index' );

		Route::controller( 'register' )->method( 'index' )->post( '/register' );
			Route::controller( 'register' )->method( 'index' )->form( '_register' )->staticView( TRUE )->post( '/register' );

		Route::controller( 'login' )->method( 'index' )->post( '/login' );
			Route::controller( 'login' )->method( 'index' )->form( '_login' )->staticView( TRUE )->post( '/login' );

		Route::controller( 'home' )->method( 'index' )->post( '/home' );
		Route::controller( 'packages' )->method( 'index' )->post( '/packages' );
		Route::controller( 'balance' )->method( 'index' )->post( '/balance' );
		Route::controller( 'iptv' )->method( 'index' )->post( '/iptv' );
		Route::controller( 'settings' )->method( 'index' )->post( '/settings' );
		Route::controller( 'logout' )->method( 'index' )->post( '/logout' );


		// Admin & Resseler
		Route::controller( 'users' )->method( 'index' )->post( '/users' );
			Route::controller( 'users' )->method( 'edit' )->var( '/id' )->get( '/users/edit' );
				Route::controller( 'users' )->method( 'edit' )->form( '_check' )->var( '/id' )->staticView( TRUE )->get( '/users/edit' );
			
			Route::controller( 'users' )->method( 'add' )->post( '/users/add' );
				Route::controller( 'users' )->method( 'add' )->form( '_user' )->staticView( TRUE )->post( '/users/add' );
				
		// Admin
		Route::controller( 'resserlers' )->method( 'index' )->post( '/resserlers' );
		Route::controller( 'services' )->method( 'index' )->post( '/services' );
		Route::controller( 'events' )->method( 'index' )->post( '/events' );
		Route::controller( 'packagessettings' )->method( 'index' )->post( '/packagessettings' );
		Route::controller( 'iptvsettings' )->method( 'index' )->post( '/iptvsettings' );

		// API
		Route::controller( 'interkassa' )->method( 'index' )->post( '/api/interkassa/get/post/balance' );
		// POST -> form( 'nameButton' )->staticView(TRUE); обов*язково вписувати value="назва метода після _ ! staticView тільки використовувати з form"
		
		

	// GET
		Route::controller( 'index' )->method( 'conf' )->var( '/var1' )->get( '/get' );
		// GET -> form( 'nameButton' ); обов*язково вписувати value="назва метода після _ !"
		Route::controller( 'index' )->method( 'conf' )->var( '/var1' )->staticView( TRUE )->form('submit')->get( '/get' );


	// WITHOUT VIEWS

		// POST WITHOUT VIEWS
			Route::staticView( TRUE )->controller( 'IndexPostControllerStaticOff' )->method( 'xindex' )->post( '/indexx' );

		// GET WITHOUT VIEWS
			Route::staticView( TRUE )->controller( 'GetIndexControllerStaticOff' )->method( 'xindex' )->var( '/var1' )->get( '/iex/off' );

