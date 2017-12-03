<?php 
	
	namespace App\Controllers\Undinamic;

	use App\Models\Controller;
	use App\Models\Page;

	class Foot extends Controller
	{

		public static function foot( $var = array() )
		{

			Page::view('/static/footer');

		}

	}