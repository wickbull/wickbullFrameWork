<?php 

	namespace App\Models;

	use App\Models\Config;

	class Language
	{

		private static $language;

		public static function lang( $word = array() )
	    {

	    	if ( empty( $word ) ) exit( Config::error( 'missing_word' )->get() );
	    	
	    	else if ( empty( $_SESSION['language'] ) and Config::config( 'turn_default_lang' )->get() == TRUE and !empty( Config::config( 'default_lang' )->get() ) )
	    	{

	    		$_SESSION['language'] = Config::config( 'default_lang' )->get();

	    		if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/config/language/' . Config::config( 'default_lang' )->get() . '/' . Config::config( 'default_lang' )->get() . '.lang.php' ) )
	    		{

	    			$file = require $_SERVER['DOCUMENT_ROOT'] . '/config/language/' . Config::config( 'default_lang' )->get() . '/' . Config::config( 'default_lang' )->get() . '.lang.php';

	    			if ( empty( $file[$word] ) and $word != 'ALL' )
	    			{

	    				self::$language = 'Language::lang(\'' . $word . '\')->get();';
	    				return new static;

	    			} 
	    			else if ( !empty( $file[$word] ) and $word != 'ALL' )
	    			{

	    				self::$language = $file[$word];
	    				return new static;

	    			}
	    			else if ( $word == 'ALL' )
	    			{

	    				self::$language = $file;
	    				return new static;

	    			}

	    		}

	    	}

	    	else if ( !empty( $_SESSION['language'] ) )
	    	{

	    		if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . '/config/language/' . Config::config( 'default_lang' )->get() . '/' . Config::config( 'default_lang' )->get() . '.lang.php' ) )
	    		{

	    			$file = require $_SERVER['DOCUMENT_ROOT'] . '/config/language/' . Config::config( 'default_lang' )->get() . '/' . Config::config( 'default_lang' )->get() . '.lang.php';

	    			if ( empty( $file[$word] ) and $word != 'ALL' )
	    			{

	    				self::$language = 'Language::lang(\'' . $word . '\')->get();';
	    				return new static;

	    			} 
	    			else if ( !empty( $file[$word] ) and $word != 'ALL' )
	    			{

	    				self::$language = $file[$word];
	    				return new static;

	    			}
	    			else if ( $word == 'ALL' )
	    			{

	    				self::$language = $file;
	    				return new static;
	    				
	    			}

	    		}

	    	}
		    

	    }

		public static function get()
	    {

	       return self::$language;

	    }

	}