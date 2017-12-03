<?php 

	namespace App\Models;

	use App\Models\Config;
	use App\Controllers\Undinamic\Head;
	use App\Controllers\Undinamic\Foot;
	use App\Models\Page;

	class Controller
	{

		public static function controllers( $info )
		{

			if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $info['CONTROLLER'] . '.controller.php' ) )
			{
				
				include $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $info['CONTROLLER'] . '.controller.php';
				
				$class = $info['CONTROLLER'];
				$method = $info['METHOD'];
				$type = $info['TYPE'];

				if ( class_exists( $class , false ) )
				{

					$controller = new $class();

					if ( class_exists( $class , false ) == TRUE )
					{

						if ( $type == 'GET' and !empty( $info['ROUTER'] ) ) 
						{ 

							include $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/undinamic/header.controller.php';
							include $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/undinamic/footer.controller.php';

							if ( method_exists( $controller , $method ) == TRUE )
							{

								if ( $info['VISUAL_TYPE'] == TRUE )
								{

									$controller::$method( $info );

								}
								else
								{

									Head::head( $info );
									$controller::$method( $info );
									Foot::foot( $info );

								}

							}
							

						}
						else if ( $type == 'POST' ) 
						{ 

							include $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/undinamic/header.controller.php';
							include $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/undinamic/footer.controller.php';

							if ( method_exists( $controller , $method ) == TRUE )
							{

								if ( $info['VISUAL_TYPE'] == TRUE )
								{

									$controller::$method( $info ); 
									// return Page::redirect( $info['BROWSER']['URL'] );

								}
								else
								{

									Head::head( $info );
									$controller::$method( $info ); 
									Foot::foot( $info );
									// return Page::redirect( $info['BROWSER']['URL'] );

								}

							}
							
						}

					}	

				}
				
			}

			return $info;

		}

	}