<?php

	use App\Models\Controller;
	use App\Models\Page;

	class users extends Controller
	{


		public static function index( $info = array() )
		{
			
			// echo '<center><div style="background:#A2FFAB">It is <b>"users::index()"</b> !</div></center>';
			
			if( !empty( $_SESSION['user'] ) )
			{

				$status = R::findOne( 'userstatus', ' parent = ? ', [ $_SESSION['user']['id'] ] );

				$users = R::findAll( 'users' );

				$resseler = R::findOne( 'resseler', ' resseler = ? ', [ $_SESSION['user']['id'] ] );

				$ban = ['Нет','Да'];

				if( $status->status == 0 ) exit( Page::redirect( '/' ) );
				elseif( $status->status == 1 )
				{ 
					
					if( !empty( $users ) )
					{
						foreach ( $users as $key => $user ) 
						{

							$resseler = R::findOne( 'resseler', ' user = ? ', [ $key ] );
							$userstat = R::findOne( 'userstatus', ' parent = ? ', [ $user->id ] );

							if( !empty( $resseler ) and $resseler->resseler == $_SESSION['user']['id'] and $userstat->status != 1 and $userstat->status != 2 )
							{

								$balance = R::findOne( 'userbalance', ' parent = ? ', [ $user->id ] );
								$userstatus = R::findOne( 'userstatus', ' parent = ? ', [ $user->id ] );
								

								$client[] = [ 
									'login' => $user->login,
									'email' => $user->email,
									'ip' => $user->ip,
									'date_time' => $user->iso_date_time,
									'balance' => $balance->balance,
									'last_time_bye' => 'NULL',
									'ban' => $ban[$userstatus->banned],
									'banned' => $userstatus->banned,
									'how_ban' => 'NULL',
									'packages' => '0',
									'id' => $key,
								];

							}
							
							
						}

						if( empty( $client ) )
						{
							$client[] = [ 
								'login' => 'NULL',
								'email' => 'NULL',
								'ip' => 'NULL',
								'date_time' => 'NULL',
								'balance' => 'NULL',
								'last_time_bye' => 'NULL',
								'ban' => 'NULL',
								'banned' => 'NULL',
								'how_ban' => 'NULL',
								'packages' => NULL,
								'id' => NULL,
							];
						}
						
					}

				}
				elseif( $status->status == 2 )
				{ 

					if( !empty( $users ) )
					{

						foreach ( $users as $key => $user ) 
						{

							$balance = R::findOne( 'userbalance', ' parent = ? ', [ $user->id ] );
							$userstatus = R::findOne( 'userstatus', ' parent = ? ', [ $user->id ] );

							if( !empty( $userstatus ) and $userstatus->status != 2 )
							{

								$client[] = [ 
									'login' => $user->login,
									'email' => $user->email,
									'ip' => $user->ip,
									'date_time' => $user->iso_date_time,
									'balance' => $balance->balance,
									'last_time_bye' => 'NULL',
									'ban' => $ban[$userstatus->banned],
									'banned' => $userstatus->banned,
									'how_ban' => 'NULL',
									'packages' => '0',
									'id' => $key,
								];

							}
							
						}

						if ( empty( $client ) )
						{

							$client[] = [ 
								'login' => 'NULL',
								'email' => 'NULL',
								'ip' => 'NULL',
								'date_time' => 'NULL',
								'balance' => 'NULL',
								'last_time_bye' => 'NULL',
								'ban' => 'NULL',
								'banned' => 'NULL',
								'how_ban' => 'NULL',
								'packages' => NULL,
								'id' => NULL,
							];

						}
					}

				}
				else exit( Page::redirect( '/' ) );
				


				$statusUserArr = [
					'user',
					'resseler',
					'admin'
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

				return Page::view( '/users' , [ 
					'status' => $status,
					'client' => $client,
				] );

			}
			else return Page::redirect('logout');
				

		}


		public static function edit( $info = array() )
		{
			
			echo '<center><div style="background:#A2FFAB">It is <b>"users::edit()"</b> !</div></center>';

			if( !empty( $_SESSION['user'] ) )
			{

				$user = R::findOne( 'users', ' id = ? ', [ $info['ROUTER']['VAR']['id'] ] );
				$adminstatus = R::findOne( 'userstatus', ' parent = ? ', [ $_SESSION['user']['id'] ] );
				$userstatus = R::findOne( 'userstatus', ' parent = ? ', [ $info['ROUTER']['VAR']['id'] ] );
				$user_resseler = R::findOne( 'resseler', ' user = ? ', [ $info['ROUTER']['VAR']['id'] ] );
				$userunhashad = R::findOne( 'userunhashad', ' id = ? ', [ $info['ROUTER']['VAR']['id'] ] );
				$userbalance = R::findOne( 'userbalance', ' parent = ? ', [ $info['ROUTER']['VAR']['id'] ] );

				$adminstatus = $adminstatus->status;
				if( !empty( $user_resseler->resseler ) ) $user_resseler = $user_resseler->resseler;
				$user_password = $userunhashad->password;
				$userbalance = $userbalance->balance;

				if( !empty($adminstatus) and $adminstatus == 1 and $userstatus->status != 2 and $userstatus->status != 1 and !empty( $user_resseler ) and $user_resseler == $_SESSION['user']['id'] )
				{

					if( !empty( $user_resseler->resseler ) )
					{
						$login_resseler = R::findOne( 'users', ' id = ? ', [ $user_resseler->resseler ] );
						$login_resseler = $login_resseler->login;
					}
					else $login_resseler = NULL;

					if( $userstatus->banned == TRUE )
					{
						$status = 'Забанен';
						$bannedCheck = 'checked';
						$time = $userstatus->banned_date_time;
					}
					else
					{
						$status = 'NULL';
						$bannedCheck = NULL;
						$time = 'NULL';
					}

					$admin = 1;

					return Page::view( '/users/editResseler' , [ 
						'client' => $user , 
						'admin' => $admin,
						'client_password' => $user_password , 
						'userbalance' => $userbalance,
						'resseler' => $login_resseler,
						'status' => $status,
						'time' => $time,
						'bannedCheck' => $bannedCheck,
						'resselerCheck' => NULL,
					] );

				}
				elseif( !empty($adminstatus) and $adminstatus == 2 and $userstatus->status != 2 )
				{

					if( !empty( $user_resseler->resseler ) )
					{
						$login_resseler = R::findOne( 'users', ' id = ? ', [ $user_resseler->resseler ] );
						$login_resseler = $login_resseler->login;
					}
					else $login_resseler = NULL;

					if( $userstatus->banned == TRUE )
					{
						$status = 'Забанен';
						$bannedCheck = 'checked';
						$time = $userstatus->banned_date_time;
					}
					else
					{
						$status = 'NULL';
						$bannedCheck = NULL;
						$time = 'NULL';
					}

					if( $userstatus->status == 1 )
					{
						$resselerCheck = 'checked';
					}
					else
					{
						$resselerCheck = NULL;
					}

					$admin = 2;

					return Page::view( '/users/editResseler' , [ 
						'client_password'	=> $user_password , 
						'resselerCheck'		=> $resselerCheck,
						'bannedCheck'		=> $bannedCheck,
						'userbalance'		=> $userbalance,
						'user_minus'		=> $userstatus->resseler_minus,
						'resseler'			=> $login_resseler,
						'persent'			=> $userstatus->resseler_bonus_persent,
						'client'			=> $user ,
						'status'			=> $status,
						'admin'				=> $admin,
						'time'				=> $time,
					] );

				}
				else exit('<center><div style="background:#FFA2A2"><b>ERROR: 404 - NOT FOUND!</b></div></center>');

			}
			else exit('<center><div style="background:#FFA2A2"><b>ERROR: 404 - NOT FOUND!</b></div></center>');

		}


		public static function edit__check( $info = array() )
		{
			
			echo '<center><div style="background:#A2FFAB">It is <b>"users::edit__check()"</b> !</div></center>';

			$adminstatuss = R::findOne( 'userstatus', ' parent = ? ', [ $_SESSION['user']['id'] ] );
			$userstatus = R::findOne( 'userstatus', ' parent = ? ', [ $info['ROUTER']['VAR']['id'] ] );

			$adminstatus = $adminstatuss->status;

			if( !empty( $_SESSION['user'] ) and $_SESSION['user']['phpsessid'] == $_COOKIE['PHPSESSID'] and !empty( $adminstatus ) and $adminstatus == 1 and !empty( $_POST ) )
			{

				if( !empty( $_POST['ban'] ) and $_POST['ban'] == 'on' )
				{
					$userstatus->banned = TRUE;
					$userstatus->banned_date_time = R::isoDateTime();
				}
				elseif( empty($_POST['ban'] ) )
				{
					$userstatus->banned = FALSE;
					$userstatus->banned_date_time = FALSE;
				}

				if( !empty( $_POST['addBalance'] ) )
				{
					$userbalance = R::findOne( 'userbalance', ' parent = ? ', [ $info['ROUTER']['VAR']['id'] ] );
					$resselerbalance = R::findOne( 'userbalance', ' parent = ? ', [ $_SESSION['user']['id'] ] );
					
					$resseler_minus = $adminstatuss->resseler_minus;

					if( $resselerbalance->balance < 0 ) 
					{ 
						$minusRES = $resselerbalance->balance - $resseler_minus;
						// $minusRES = $minusRES - 3;
					}
					else 
					{
						$minusRES = $resselerbalance->balance - $resseler_minus;
						// $minusRES = $minusRES - 3;
					}
					var_dump( $minusRES );
					if ( $minusRES >= $_POST['addBalance'] )
					{

						$addBalance = trim( $_POST['addBalance'] );
			            $addBalance = strip_tags( $addBalance ); 
			            $addBalance = htmlspecialchars( $addBalance , ENT_QUOTES ); 
			            $addBalance = stripslashes( $addBalance ); 
						
						if( $adminstatuss->resseler_bonus_persent == 0 )
						{
							$resselerbalPOST = $_POST['addBalance'];
						}
						else 
						{
							$pay = ( $adminstatuss->resseler_bonus_persent/100 )*$_POST['addBalance'];
							$resselerbalPOST = $_POST['addBalance'] - $pay;
						}

						$resselerbal = $resselerbalance->balance - $resselerbalPOST;

						$userbal = $_POST['addBalance'] + $userbalance->balance;

						$userbalance->balance = $userbal;
						$resselerbalance->balance = $resselerbal;

						R::store( $resselerbalance );
						R::store( $userbalance );

					}

				}

				return Page::redirect('/users/edit/' . $info['ROUTER']['VAR']['id'] );

			}
			elseif( !empty( $_SESSION['user'] ) and $_SESSION['user']['phpsessid'] == $_COOKIE['PHPSESSID'] and !empty( $adminstatus ) and $adminstatus == 2 )
			{

				if( !empty( $_POST['ban'] ) and $_POST['ban'] == 'on' )
				{
					$userstatus->banned = TRUE;
					$userstatus->banned_date_time = R::isoDateTime();
				}
				elseif( empty($_POST['ban'] ) )
				{
					$userstatus->banned = FALSE;
					$userstatus->banned_date_time = FALSE;
				}

				if( !empty( $_POST['resseler'] ) and $_POST['resseler'] == 'on' )
				{
					$userstatus->status = 1;
				}
				elseif( empty( $_POST['resseler'] ) )
				{
					$userstatus->status = 0;
				}

				if( !empty( $_POST['addBalance'] ) )
				{
					$userbalance = R::findOne( 'userbalance', ' parent = ? ', [ $info['ROUTER']['VAR']['id'] ] );
					$addBalance = trim( $_POST['addBalance'] );
		            $addBalance = strip_tags( $addBalance ); 
		            $addBalance = htmlspecialchars( $addBalance , ENT_QUOTES ); 
		            $addBalance = stripslashes( $addBalance ); 
					
					$balance = $userbalance->balance + $addBalance;
					$userbalance->balance = $balance;
					R::store( $userbalance );
				}

				if( !empty( $_POST['persent'] ) )
				{
					$persent = trim( $_POST['persent'] );
		            $persent = strip_tags( $persent ); 
		            $persent = htmlspecialchars( $persent , ENT_QUOTES );
		            $persent = stripslashes( $persent ); 
					$userstatus->resseler_bonus_persent = $persent;
				}
				elseif( empty( $_POST['persent'] ) ) 
				{
					$userstatus->resseler_bonus_persent = 0;
				}

				if( !empty( $_POST['resselerMinus'] ) )
				{
					$resseler_minus = trim( $_POST['resselerMinus'] );
		            $resseler_minus = strip_tags( $resseler_minus ); 
		            $resseler_minus = htmlspecialchars( $resseler_minus , ENT_QUOTES );
		            $resseler_minus = stripslashes( $resseler_minus ); 
					if( $resseler_minus < 0 ) $resseler_minus =  -1 * $resseler_minus;
					$userstatus->resseler_minus = -$resseler_minus;
				}
				elseif( empty( $_POST['resselerMinus'] ) )
				{
					$userstatus->resseler_minus = 0;
				}
				

				R::store( $userstatus );

				return Page::redirect('/users/edit/' . $info['ROUTER']['VAR']['id'] );

			}
			else Page::redirect('/users/edit/' . $info['ROUTER']['VAR']['id'] );

		}


		public static function add( $info = array() )
		{

			if( !empty( $_SESSION['user'] ) )
			{

				echo '<center><div style="background:#A2FFAB">It is <b>"users::add()"</b> !</div></center>';

				return Page::view( '/users/addUser' );

			}
			else return Page::redirect('logout');
			
			

		}


		public static function add_user( $info = array() )
		{
			
			echo '<center><div style="background:#A2FFAB">It is <b>"users::add_user()"</b> !</div></center>';
			
			$errors = array();

	        $error = array(
	            'empty_login'       => 'Поле пустое! Введите логин!',
	            'empty_password'    => 'Поле пустое! Введите пароль!',
	            'login_exist'       => 'Пользователь на этот логин уже зарегистрирован!'
	        );

			if( !empty( $_POST['login'] ) ) 
	        {

	            $login = trim( $_POST['login'] );
	            $login = strip_tags( $login ); 
	            $login = htmlspecialchars( $login , ENT_QUOTES ); 
	            $login = stripslashes( $login ); 

	            if ( strlen( $login ) == '0' ) $errors[] = $error['empty_login'];

	        }

	        if( !empty( $_POST['password'] ) ) 
	        {

	            $password = trim( $_POST['password'] );
	            $password = strip_tags( $password ); 
	            $password = htmlspecialchars( $password , ENT_QUOTES ); 
	            $password = stripslashes( $password ); 

	            if ( strlen( $password ) == '0' ) $errors[] = $error['empty_password'];

	        }

	        $user  = R::findOne( 'users', ' login = ? ', [ $login ] );

	        if( !empty( $user ) and $user->login == $login ) $errors[] = $error['login_exist'];

	        if( empty( $errors ) )
	        {

	        	$users = R::dispense('users');
				$users->email = $_SESSION['user']['email'];
				$users->login = $login;
				$users->password = password_hash( $password , PASSWORD_DEFAULT );
				$users->ip = $_SERVER['REMOTE_ADDR'];
				$users->isoDateTime = R::isoDateTime();
				$id = R::store( $users );

				$unhashed_users = R::dispense('userunhashad');
				$unhashed_users->email = $_SESSION['user']['email'];
				$unhashed_users->login = $login;
				$unhashed_users->password = $password;
				$unhashed_users->isoDateTime = R::isoDateTime();
				R::store( $unhashed_users );

				$resseler = R::dispense('resseler');
				$resseler->resseler = $_SESSION['user']['id'];
				$resseler->user = $id;
				$resseler->isoDateTime = R::isoDateTime();
				R::store( $resseler );

				$user_status = R::dispense('userstatus');
				$user_status->parent = $id;
				$user_status->status = FALSE;
				$user_status->resseler_bonus_persent = 0;
				$user_status->resseler_minus = 0;
				$user_status->banned = FALSE;
				$user_status->banned_date_time = FALSE;
				$user_status->isoDateTime = R::isoDateTime();
				R::store( $user_status );

	            $user_balance = R::dispense('userbalance');
				$user_balance->parent = $id;
				$user_balance->balance = 0;
				$user_balance->isoDateTime = R::isoDateTime();
				R::store( $user_balance );

	            return Page::redirect('/users');

			}
			else
			{
				return Page::redirect('/users/add');
			}

			// var_dump($_POST);
		}

	}