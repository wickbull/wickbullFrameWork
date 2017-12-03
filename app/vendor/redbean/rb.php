<?php 

	use App\Models\Config;

	function connect()
	{

		session_start();

		class_alias('\RedBeanPHP\R','\R');
		return R::setup( 'mysql:host=' . Config::db('localhost')->get() . '; dbname=' . Config::db('database')->get() . '', Config::db('user')->get() , Config::db('password')->get() );

	}

	connect();