<?php 

	namespace App\Models;

	use App\Models\Config;

	class Uri
	{


		public static function urlArray()
		{

			$uri = $_SERVER['REQUEST_URI'];
			
			if ( $uri != '/' ) $urlArray = explode( '/', $uri );
			else if ( $uri == '/' ) $urlArray = explode( '/', Config::config( 'index' )->get() );

			foreach ( $urlArray as $key => $value ) if ( $value != '' ) $url[] = $value;

			if ( !empty( $url ) ) return $url;

		}

		public static function urlFromRouting( $routerURL )
		{

			$urlArray = explode( '/' , $routerURL );
			
			foreach ( $urlArray as $key => $value ) if ( $value != '' ) $url[] = $value;
			
			if ( !empty( $url ) ) return $url;

		}

		public static function url( $urlFromBrowser = array() , $urlFromRouting = array() )
		{
			
			$BOOL = is_array( $urlFromBrowser ) ? 'TRUE' : 'FALSE';

			if ( $BOOL == 'TRUE' )
			{

				$countRouting = count( $urlFromRouting );

				for( $i = 0 ; $i <= $countRouting - 1 ; $i++ ) if ( !empty( $urlFromBrowser[$i] ) ) $urlArray[$i] = $urlFromBrowser[$i];

				$urlArrayCount = count( $urlArray );
				

				if ( $urlArrayCount == $countRouting )
				{

					$arrayBrowser = $urlFromBrowser;

					if ( !empty( $arrayBrowser ) )
					{
						$ISARRAY = is_array( $arrayBrowser ) ? 'TRUE' : 'FALSE';

						if( $ISARRAY == 'TRUE' )
						{

							for ( $i = 0 ; $i <= $urlArrayCount - 1 ; $i++ ) unset( $arrayBrowser[$i] );

							foreach ( $arrayBrowser as $key => $value ) $varUrl[] = $value;

						}
						else if ( $ISARRAY == 'FALSE' )
						{

							$varUrl = $arrayBrowser;

						}
						

						if ( empty( $varUrl ) ) $varUrl = NULL;

						

					}

					$urlBrowserString = implode( '/' , $urlArray );
					$urlRoutingString = implode( '/' , $urlFromRouting );

					$urlBrowser = '/' . $urlBrowserString;
					$urlRouting = '/' . $urlRoutingString;

				}

			}

			else if ( $BOOL == 'FALSE' )
			{

			 	$urlRouting = $urlFromBrowser;
			 	$varUrl = NULL;

			}

			

			if ( !empty( $urlBrowser ) and !empty( $urlRouting ) )
			{

				if( $urlBrowser == $urlRouting ) return array( 'URL' => $urlRouting , 'VAR' => $varUrl );

			}

			else if ( !empty( $urlRouting ) and $urlRouting == Config::config( 'index' )->get() ) 
				return array( 'URL' => $urlRouting , 'VAR' => $varUrl );

		}

	}