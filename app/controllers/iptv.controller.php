<?php 

	use App\Models\Controller;
	use App\Models\Page;

	class iptv extends Controller
	{


		public static function index( $info = array() )
		{
			
			if( !empty( $_SESSION['user'] ) ) :

				echo '<center><div style="background:#A2FFAB">It is <b>"iptv::index()"</b> !</div></center>';

				return Page::view( '/iptv' );

			else :

				return Page::redirect( '/' );

			endif;

		}

	}