<?php 

	namespace App\Controllers\Undinamic;

	use App\Models\Controller;
	use App\Models\Language;
	use App\Models\Page;
	use R;

	class Head extends Controller
	{

		public static function head( $info = array() )
		{



			if( !empty( $_SESSION['user']['login'] ) ) :

				$user = R::findOne( 'users', ' login = ? ', [ $_SESSION['user']['login'] ] );
				$status = R::findOne( 'userstatus', ' parent = ? ', [ $_SESSION['user']['id'] ] );
				$balance = R::findOne( 'userbalance', ' parent = ? ', [ $_SESSION['user']['id'] ] );

				if( !empty( $user ) and $user->phpsessid != $_COOKIE['PHPSESSID'] ) :

					$user->phpsessid = NULL;

		        	R::store( $user );

					return Page::redirect( '/logout' );
					
				endif;

			endif;

			if( empty( $balance ) ) $balance = 0;
			else $balance = $balance->balance;

			$statusUserArr = [
				'user',
				'resseler',
				'admin',
				'banned'
			];


			if( !empty( $status->status ) )
			{
				foreach ($statusUserArr as $key => $value) 
				{
					if( $key == $status->status )
					{
						$status = $value;
						break;
					}
				}
			}
			elseif( empty( $status->status ) ) 
			{
				$status = 'user';
			}

			// var_dump($status);

				Page::view( '/static/header' , [ 
					'active' => $info['BROWSER']['URL'],
					'status' => $status,
					'balance' => $balance,
				] );


		}

	}