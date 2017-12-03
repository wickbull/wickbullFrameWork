<?php 

	use App\Models\Controller;
	use App\Models\Page;

	class indexController extends Controller
	{


		public static function index( $info = array() )
		{
			
			if( empty( $_SESSION['user'] ) ) :

				echo '<center><div style="background:#A2FFAB">It is <b>"indexController::index()"</b> !</div></center>';

				return Page::view('/index',[ 'active' => $info['BROWSER']['URL'] , 'active2' => $info['BROWSER']['URL'] ]);

			elseif( !empty( $_SESSION['user'] ) ) :

				return Page::redirect( '/home' );

			endif;


		}

	}