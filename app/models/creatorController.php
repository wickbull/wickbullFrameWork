<?php 

	namespace App\Models;

	use App\Models\Config;

	class CreatorController 
	{
		
		private static $controller;
		private static $method;
		private static $class;

	    public static function findController( $controller ) 
	    {

	    	if ( !empty( $controller ) )
	    	{

	    		self::$class = $controller;

	    		if ( Config::config( 'controller_autocreator' )->get() == TRUE )
		    	{

		    		if ( !file_exists( $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $controller . '.controller.php' ) )
		    		{

		    			fopen( $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . $controller . '.controller.php' , "w" );

		    			
		    			self::$controller = Config::error( 'creating_controller' )->get();
	        			return new static;

		    		}
		    		else
		    		{

		    			self::$controller = NULL;
		    			return new static;

		    		}

		    	}

	    	}
	    	else if ( empty( $controller ) )
	    	{ 

	    		self::$controller = Config::error( 'missing_controller' )->get();
	        	return new static;	
	    		 

	    	}

	    }

	    public static function findMethod( $method ) 
	    {


	    	if ( Config::config( 'controller_autocreator' )->get() == TRUE )
		    {

		        if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . self::$class . '.controller.php' ) )
		        {


		        	if ( class_exists( self::$class , false ) == FALSE )
		        	{

		        		include $_SERVER['DOCUMENT_ROOT'] . '/app/models/classFile.php';

		        	}

		        	if ( method_exists( self::$class , $method ) == FALSE )
		        	{

		        		include $_SERVER['DOCUMENT_ROOT'] . '/app/models/method.php';

		        	}

		        }

	    	}	

	        self::$method = $method;
	        return new static;

	    }

	    public static function status()
	    {

	    	if( self::$controller != NULL )
	    		echo self::$controller;

	    	if( self::$method != NULL )
	    		echo self::$method;

	    }

	}