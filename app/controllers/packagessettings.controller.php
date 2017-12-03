<?php 

	use App\Models\Controller;
	use App\Models\Page;

	class packagessettings extends Controller
	{


		public static function index( $info = array() )
		{
			
			echo '<center><div style="background:#A2FFAB">It is <b>"packagessettings::index()"</b> !</div></center>';

			return Page::view( '/index' );

		}

	}