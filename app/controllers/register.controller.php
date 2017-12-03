<?php 

	use App\Models\Controller;
	use App\Models\Page;
	use App\Models\Config;
	// use R;

	class register extends Controller
	{


		public static function index( $info = array() )
		{
			
			if( empty( $_SESSION['user'] ) ) :

				echo '<center><div style="background:#A2FFAB">It is <b>"register::index()"</b> !</div></center>';

				return Page::view( '/register' , [ 'sitekey' => Config::config('sitekeyReCaptcha')->get() ] );

			else :

				return Page::redirect( '/home' );

			endif;

		}


		public static function index_register( $info = array() )
		{

			if( empty( $_SESSION['user'] ) )
			{
			
				echo '<center><div style="background:#A2FFAB">It is <b>"register::index_register()"</b> !</div></center>';
				
				include 'recaptchalib.php';

				$secret = Config::config('secretkeyReCaptcha')->get();
				 
				$response = null;
				 
				$reCaptcha = new ReCaptcha($secret);

				// if submitted check response
				if ( !empty( $_POST["g-recaptcha-response"] ) ) {
					$response = $reCaptcha->verifyResponse(
				        $_SERVER["REMOTE_ADDR"],
				        $_POST["g-recaptcha-response"]
				    );
				}



				if ($response != null && $response->success) 
				{

					$errors = array();

			        $error = array(
			            'empty_email'       => 'Поле пустое! Введите почту!',
			            'empty_login'       => 'Поле пустое! Введите логин!',
			            'empty_password'    => 'Поле пустое! Введите пароль!',
			            'email_exist'       => 'Пользователь на эту почту уже зарегистрирован!',
			            'login_exist'       => 'Пользователь на этот логин уже зарегистрирован!'
			        );

			        if( !empty( $_POST['email'] ) ) 
			        {

			            $email = trim( $_POST['email'] ); 
			            $email = strip_tags( $email );  
			            $email = htmlspecialchars( $email , ENT_QUOTES ); 
			            $email = stripslashes( $email ); 

			            if ( strlen( $email ) == '0' ) $errors[] = $error['empty_email'];

			        }

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

			        $user  = R::findOne( 'users', ' email = ? ', [ $email ] );

			        if( !empty( $user ) and $user->email == $email ) $errors[] = $error['email_exist'];
			       
			        if( !empty( $user ) and $user->login == $login ) $errors[] = $error['login_exist'];

			        if( empty( $errors ) )
			        {

			        	$users = R::dispense('users');
						$users->email = $email;
						$users->login = $login;
						$users->password = password_hash( $password , PASSWORD_DEFAULT );
						$users->phpsessid = $_COOKIE['PHPSESSID'];
						$users->ip = $_SERVER['REMOTE_ADDR'];
						$users->isoDateTime = R::isoDateTime();
						// $users->activate = Config::config( 'activate_user' )->get();
						$id = R::store( $users );

						$unhashed_users = R::dispense('userunhashad');
						$unhashed_users->email = $email;
						$unhashed_users->login = $login;
						$unhashed_users->password = $password;
						$unhashed_users->isoDateTime = R::isoDateTime();
						// $unhashed_users->activate = Config::config( 'activate_user' )->get();
						R::store( $unhashed_users );

						$user_status = R::dispense('userstatus');
						$user_status->parent = $id;
						$user_status->status = FALSE;
						$user_status->resseler_bonus_persent = 0.00000000;
						$user_status->resseler_minus = 0;
						$user_status->banned = FALSE;
						$user_status->banned_date_time = FALSE;
						$user_status->isoDateTime = R::isoDateTime();
						R::store( $user_status );

						$per  = R::findOne( 'userstatus', ' id = ? ', [ $id ] );
						$per->resseler_bonus_persent = 0;
						R::store( $per );

			            $user_balance = R::dispense('userbalance');
						$user_balance->parent = $id;
						$user_balance->balance = 0.00000001;
						$user_balance->isoDateTime = R::isoDateTime();
						R::store( $user_balance );

						$bal  = R::findOne( 'userbalance', ' id = ? ', [ $id ] );
						$bal->balance = 0.00000000;
						R::store( $bal );

						$user  = R::findOne( 'users', ' id = ? ', [ $id ] );

			           	$_SESSION['user'] = $user;

			            // Mail::send('mail.sent', ['buy' => '<br>категорія = kat<br>продукт = prod<br>кількість = kilk'], function ($m) use ($user) {
			            //     $m->from( '$user->email', $user->login );
			            //     $m->to('admin@gmail.com', 'Admin')->subject('Нове замовлення!');
			            // });
			            // Mail::to($user->email)->send(new OrderShipped($user));
			            
			            return Page::redirect('/home');

					}
					else
					{
						return Page::redirect('/register');
					}

			    } 
			}
			else
			{
				return Page::redirect( '/home' );
			}

		}

	}