<?php 

	use App\Models\Controller;
	use App\Models\Page;

	class iptvsettings extends Controller
	{


		public static function index( $info = array() )
		{
			
			echo '<center><div style="background:#A2FFAB">It is <b>"iptvsettings::index()"</b> !</div></center>';

			return Page::view( '/index' );

		}

	}