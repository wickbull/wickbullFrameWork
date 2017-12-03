<?php 

// видалення останньої строки
$file = file( $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . self::$class . '.controller.php' );
array_pop($file);
// перезбираєм строку
$str = implode('', $file);
file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . self::$class . '.controller.php' , $str );
// створення метода в файлі контроллері
$methodFile = fopen( $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' . self::$class . '.controller.php' , "a" );

$text = 
'
		public static function ' . $method . '( $info = array() )
		{
			
			echo \'<center><div style="background:#A2FFAB">It is <b>"' . self::$class . '::' . $method . '()"</b> !</div></center>\';

			return Page::view( \'/index\' );

		}

	}';


fwrite( $methodFile , $text );
fclose ( $methodFile );