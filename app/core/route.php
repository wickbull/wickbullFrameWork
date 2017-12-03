<?php 

	namespace App\Core;

	require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/routing.php';

	use App\Models\Router;
	use App\Models\Config;
	use App\Models\CreatorController;
	use App\Models\Controller;
	use App\Models\Page;
	
	class Route
	{

		private static $router;
		private static $var;
		private static $method;
		private static $controller;
		private static $type;
		private static $button;



		public static function var( $var )
		{

			if ( !empty( $var ) )
			{

				self::$var = $var;
				return new static;

			}

		}

		public static function form( $button )
		{

			if ( !empty( $button ) )
			{

				self::$button = $button;
				return new static;

			}

		}

		public static function staticView( $type )
		{

			if ( !empty( $type ) and $type == TRUE and isset( $_POST[self::$button] ) )
			{
				
				self::$type = $type;
				return new static;

			}
			else if ( !empty( $type ) or $type == FALSE )
			{

				self::$type = NULL;
				return new static;

			}

		}

		public static function method( $method )
		{
			
			if ( Config::config( 'method_declare' )->get() == TRUE )
			{

				if ( $method != Config::config( 'method_name_declare' )->get() )
				{

					if ( !empty( $method ) )
					{

						self::$method = $method;
						return new static;

					}

				}
				else if ( $method == Config::config( 'method_name_declare' )->get() ) 
					exit( Config::error( 'failed_method' )->get() );

			}
			else if ( Config::config( 'method_declare' )->get() == FALSE )
			{

				if ( !empty( $method ) )
					{

						self::$method = $method;
						return new static;

					}

			}

		}

		public static function controller( $controller )
		{

			if ( !empty( $controller ) )
			{

				self::$controller = $controller;
				return new static;

			}

		}

		

		

		public static function post( $url )
		{

			if ( isset( $_POST[self::$button] ) and !empty( $url ) )
			{

				$router = Router::url( $url )
								->visualType( self::$type )
								->controller( self::$controller )
								->method( self::$method . $_POST[ self::$button ] )
								->formPost();
				
				if( !empty( $router['BROWSER']['URL'] ) and empty( $router['BROWSER']['VAR'] ) )
				{

					self::$router = $router;
			        return new static;
					
				}

			}
			else if ( !isset( $_POST[self::$button] ) and !empty( $url ) )
			{

				$router = Router::url( $url )
								->visualType( self::$type )
								->controller( self::$controller )
								->method( self::$method )
								->post();
				
				if( !empty( $router['BROWSER']['URL'] ) and empty( $router['BROWSER']['VAR'] ) )
				{

					self::$router = $router;
			        return new static;
					
				}

			}

		}

		

		public static function get( $url )
		{

			if ( isset( $_POST[self::$button] ) and !empty( $url ) )
			{

				$router = Router::url( $url )
								->var( self::$var )
								->visualType( self::$type )
								->controller( self::$controller )
								->method( self::$method . '_' . $_POST[ self::$button ] )
								->formGet();
				
				if( !empty( $router['BROWSER']['URL'] ) and !empty( $router['BROWSER']['VAR'] ) )
				{

					self::$router = $router;
			        return new static;

				}

			}
			else if ( !isset( $_POST[self::$button] ) and !empty( $url ) )
			{

				$router = Router::url( $url )
								->var( self::$var )
								->visualType( self::$type )
								->controller( self::$controller )
								->method( self::$method )
								->get();
				
				if( !empty( $router['BROWSER']['URL'] ) and !empty( $router['BROWSER']['VAR'] ) )
				{

					self::$router = $router;
			        return new static;

				}

			}

		}

		public static function start()
		{

			if ( !empty( self::$router ) )
			{
				
				if ( Config::config( 'dump_router' )->get() == TRUE )
				{ 
					var_dump( 'TURN OFF THIS IN CONFIG FILE "dump_router" => FALSE' );
					var_dump( self::$router );

				}

				Controller::controllers( self::$router );

				if( Config::config( 'controller_autocreator' )->get() == TRUE )
				{
					CreatorController::findController( self::$router['CONTROLLER'] )
									->findMethod( self::$router['METHOD'] )
									->status();
				}
				

			} 

			else if ( empty( self::$router ) ) exit( Config::error( '404' )->get() );
			
		}

	}

	