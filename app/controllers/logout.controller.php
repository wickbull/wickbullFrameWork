<?php

	use App\Models\Controller;
	use App\Models\Page;

	class logout extends Controller
	{

		public static function index( $info = array() )
		{

			echo '<center><div style="background:#A2FFAB">It is <b>"logout::index()"</b> !</div></center>';
			
			unset( $_COOKIE['PHPSESSID'] );
			
			session_destroy();

			// return header('Location: /login');
			exit(Page::redirect('/login')); 


		}

	}