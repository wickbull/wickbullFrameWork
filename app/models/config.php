<?php 

	namespace App\Models;

	class Config
	{

		public static $config;

		public static function config( $arg = array() ) 
	    {

	        if ( empty( $arg ) ) 
	        	$errors[] = '<div style="background:#FFA2A2"><center>ERROR: there is no one argument in model config(->!<-)</center></div>';
	    	
	    	else if ( !file_exists( $_SERVER['DOCUMENT_ROOT'] . '/config/config.php' ) ) 
	    		$errors[] = '<div style="background:#FFA2A2"><center>ERROR: there is no config file config.php</center></div>';

		    if( empty( $errors ) )
		    {

		    	$file = require $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

		        self::$config = $file[ $arg ];

		        return new static;

		    }
	    	else exit( array_shift( $errors ) );

	    }


	    


	   	public static function db( $arg = array() ) 
	    {

	    	if ( empty( $arg ) ) 
	    		$errors[] = '<div style="background:#FFA2A2"><center>ERROR: there is no one argument in model db(->!<-)</center></div>';

	    	else if ( !file_exists( $_SERVER['DOCUMENT_ROOT'] . '/config/db.php' ) ) 
	    		$errors[] = '<div style="background:#FFA2A2"><center>ERROR: there is no config file db.php</center></div>';


		    if( empty( $errors ) )
		    {

		    	$file = require $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';

		        self::$config = $file[ $arg ];

		        return new static;

		    }
	    	else exit( array_shift( $errors ) );
	        

	    }

	    public static function error( $arg = array() ) 
	    {

	    	if ( empty( $arg ) ) 
	    		$errors[] = '<div style="background:#FFA2A2"><center>ERROR: there is no one argument in model error(->!<-)</center></div>';

	    	else if ( !file_exists( $_SERVER['DOCUMENT_ROOT'] . '/config/error.php' ) ) 
	    		$errors[] = '<div style="background:#FFA2A2"><center>ERROR: there is no config file error.php</center></div>';


		    if( empty( $errors ) )
		    {

		    	$file = require $_SERVER['DOCUMENT_ROOT'] . '/config/error.php';

		        self::$config = $file[ $arg ];

		        return new static;

		    }
	    	else exit( array_shift( $errors ) );
	        

	    }

		public static function get()
	    {

	       return self::$config;

	    } 

	}

	