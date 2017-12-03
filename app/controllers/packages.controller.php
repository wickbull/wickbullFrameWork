<?php 

	use App\Models\Controller;
	use App\Models\Page;

	class packages extends Controller
	{


		public static function index( $info = array() )
		{

			if( !empty( $_SESSION['user'] ) ) :
			
				echo '<center><div style="background:#A2FFAB">It is <b>"packages::index()"</b> !</div></center>';

				return Page::view( '/packages' );

			else :

				return Page::redirect( '/' );

			endif;

		}

	}