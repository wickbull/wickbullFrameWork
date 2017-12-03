<?php 
	
	namespace App\Models;

	use App\Models\Config;

	class Page
	{

		public static function view( $page , $var = [] )
		{
			if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/static/views' . $page . '.php' ) )
			{
				foreach ($var as $key => $value) 
				{
					${$key} = $value;
				}
				require $_SERVER['DOCUMENT_ROOT'] . '/static/views' . $page . '.php';
			} 
			else exit( Config::error( 'wrong_way_view' )->get() );
		}

		public static function redirect( $page )
		{
			header( 'Location:' . $page );
		}

		public static function timeRedirect( $page , $time )
		{
			header( 'Refresh: ' . $time . '; ' . $page );
		}

	}