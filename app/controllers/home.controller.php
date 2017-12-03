<?php 

	use App\Models\Controller;
	use App\Models\Page;

	class home extends Controller
	{


		public static function index( $info = array() )
		{
			// var_dump($_SESSION['user']);
			
			if( !empty( $_SESSION['user'] ) ) 
			{

				echo '<center><div style="background:#A2FFAB">It is <b>"home::index()"</b> !</div></center>';
				
				return Page::view( '/home' );
			}
			elseif( empty( $_SESSION['user'] ) ) 
			{

				return Page::redirect( '/' );

			}

		}

	}