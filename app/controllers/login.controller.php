<?php 

	use App\Models\Controller;
	use App\Models\Page;
	use App\Models\Config;

	class login extends Controller
	{


		public static function index( $info = array() )
		{
			
			if( empty( $_SESSION['user'] ) ) :

				echo '<center><div style="background:#A2FFAB">It is <b>"login::index()"</b> !</div></center>';
				
				return Page::view( '/login' , [ 'sitekey' => Config::config('sitekeyReCaptcha')->get() ] );

			else :

				return Page::redirect( '/home' );

			endif;

		}


		public static function index_login( $info = array() )
		{

			if( empty( $_SESSION['user'] ) )
			{

				echo '<center><div style="background:#A2FFAB">It is <b>"login::index_login()"</b> !</div></center>';

				include 'recaptchalib.php';

				$secret = Config::config('secretkeyReCaptcha')->get();
				 
				$response = null;
				 
				$reCaptcha = new ReCaptcha($secret);

				// if submitted check response
				if ( !empty( $_POST["g-recaptcha-response"] ) ) 
				{
					$response = $reCaptcha->verifyResponse(
				        $_SERVER["REMOTE_ADDR"],
				        $_POST["g-recaptcha-response"]
				    );
				}

				if ($response != null && $response->success) 
				{

					$errors = array();

			        $error = array(

			            'empty_login'       => 'Вы неверно ввели логин, или поле пустое!',
			            'empty_password'    => 'Вы неверно ввели пароль, или поле пустое!',
			            'login_empty'       => 'Пользователь не зарегистрирован!'

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

			        if( empty( $user ) or empty( $user->login ) ) $errors[] = $error['login_empty'];

			        if( empty( $password ) or password_verify( $password , $user->password ) == FALSE ) $errors[] = $error['empty_password'];

			        if( empty( $errors ) )
			        {

			        	$_SESSION['user'] = $user;

			        	$user->phpsessid = $_COOKIE['PHPSESSID'];
			        	$user->ip = $_SERVER['REMOTE_ADDR'];

			        	R::store( $user );

			        	
			            // dump(session()->get('user')); // session()->get('user')->login;
			            return Page::redirect('/home'); // or return redirect()->action('HomeController@index');

			        }
			        else 
			        {
			        	return Page::redirect('/login');
			        }

				}
				else 
		        {
		        	return Page::redirect('/login');
		        }

			}
			else
			{
				return Page::redirect( '/home' );
			}

		}

	}