<?php 

$controllerFile = fopen( $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . self::$class . '.controller.php' , "a" );

$text = 
'<?php 

	use App\Models\Controller;
	use App\Models\Page;

	class ' . self::$class . ' extends Controller
	{

	}
';

fwrite( $controllerFile , $text );
fclose ( $controllerFile );