<?php 

	namespace App\Models;
	
	use App\Models\Config;
	use App\Models\Uri;
	use App\Models\Variables;

	class Router
	{
		
		private static $url;
	    private static $var;
	    private static $controller;
	    private static $method;
	    private static $type;

	    public static function url( $url ) 
	    {
	    	
	    	$urlArrayFromBrowser = Uri::urlArray();
	        $urlArrayFromRouting = Uri::urlFromRouting( $url );
	        
	        $urlArr = Uri::url( $urlArrayFromBrowser , $urlArrayFromRouting );
	        
	        self::$url = $urlArr;
	        return new static;

	    }

	    public static function var( $variable ) 
	    {

	    	$variableArray = explode( '/' , $variable );

	    	foreach ($variableArray as $key => $variables) 
	    	{

	    		if ( !empty( $variables ) ) $varArray[] = $variables;

	    	}

	    	$countVarUrl = count(self::$url['VAR']);
	    	$countVarRouting = count( $varArray );

	    	if ( $countVarUrl == $countVarRouting )
	    	{

	    		foreach ($varArray as $key => $value) 
	    		{

	    			$var[$value] = self::$url['VAR'][$key]; 

	    		}
	    		
	    		self::$var = $var;
	        	return new static;

	    	}
	    	else 
	    	{

	    		self::$var = NULL;
	    		return new static;

	    	}

	    }

	    public static function visualType( $type ) 
	    {

	        self::$type = $type;
	        return new static;

	    }

	    public static function controller( $controller ) 
	    {

	        self::$controller = $controller;
	        return new static;

	    }

	    public static function method( $method ) 
	    {

	        self::$method = $method;
	        return new static;

	    }

	    public static function post()
	    {

	    	if ( self::$url != NULL and self::$url['VAR'] == NULL and self::$var == NULL )
	    		return array( 'BROWSER' => self::$url , 'VISUAL_TYPE' => self::$type , 'TYPE' => 'POST' , 'CONTROLLER' => self::$controller, 'METHOD' => self::$method );

	    }

	    public static function formPost()
	    {

	    	if ( self::$url != NULL and self::$url['VAR'] == NULL and self::$var == NULL and !empty( $_POST ) ) 
	    	{
	    		return array( 'BROWSER' => self::$url , '$_POST' => $_POST , 'VISUAL_TYPE' => self::$type , 'TYPE' => 'POST' , 'CONTROLLER' => self::$controller, 'METHOD' => self::$method );
	    	}

	    }

	    public static function formGet()
	    {

	    	if ( self::$url != NULL and self::$var != NULL and !empty( $_POST ) ) 
	    	{
	    		return array( 'BROWSER' => self::$url , 'ROUTER' => array( 'URL' => self::$url['URL'] , 'VAR' => self::$var ) , '$_POST' => $_POST , 'VISUAL_TYPE' => self::$type , 'TYPE' => 'GET' , 'CONTROLLER' => self::$controller , 'METHOD' => self::$method );
	    	}

	    }

	    public static function get()
	    {
	    	
	    	if ( self::$url != NULL and self::$var != NULL )
	    		return array( 'BROWSER' => self::$url , 'ROUTER' => array( 'URL' => self::$url['URL'] , 'VAR' => self::$var ) , 'VISUAL_TYPE' => self::$type , 'TYPE' => 'GET' , 'CONTROLLER' => self::$controller , 'METHOD' => self::$method );

	    } 

	}