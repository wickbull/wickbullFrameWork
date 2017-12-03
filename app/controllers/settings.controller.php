<?php 

	use App\Models\Controller;
	use App\Models\Page;

	class settings extends Controller
	{


		public static function index( $info = array() )
		{

			if( !empty( $_SESSION['user'] ) ) :
			
				echo '<center><div style="background:#A2FFAB">It is <b>"settings::index()"</b> !</div></center>';

				return Page::view( '/index' );

			else :

				return Page::redirect( '/' );

			endif;

		}

	}