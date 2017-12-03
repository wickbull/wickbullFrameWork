<?php 

	use App\Models\Controller;
	use App\Models\Page;
	use App\Models\Config;

	class balance extends Controller
	{


		public static function index( $info = array() )
		{

			if( !empty( $_SESSION['user'] ) ) :

				// echo '<center><div style="background:#A2FFAB">It is <b>"balance::index()"</b> !</div></center>';
				// $user = R::findAll( 'userbalance', 'ORDER BY parent DESC LIMIT 4 parent = ?', [ $_SESSION['user']['id'] ] );

				// $transactions = R::find( 'usertransactions', 'ORDER BY parent LIKE ? DESC LIMIT 4', [ $_SESSION['user']['id'] ] );

				// var_dump($transactions);

				
				$transactions = R::findAll( 'usertransactions' , ' WHERE parent LIKE ? ORDER BY id DESC LIMIT 10', [ $_SESSION['user']['id'] ] );
				// $usertransactions = R::findAll( 'usertransactions' , ' ORDER BY title DESC LIMIT 10 ' );

				return Page::view( '/balance' , [ 
					'transactions' => $transactions,
					'ik_co_id' => Config::config('interkassa_ik_co_id')->get(),
					'ik_sign' => Config::config('interkassa_ik_sign')->get()
				] );

			else :

				return Page::redirect( '/' );

			endif;

		}

	}