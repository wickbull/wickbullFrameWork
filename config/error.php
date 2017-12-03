<?php 
	
	return array(
			'404' => '<center><div style="background:#FFA2A2"><b>ERROR: 404 - NOT FOUND!</b></div></center>',
			'failed_method' => '<center><div style="background:#FFA2A2"><b>ERROR: Method \'index\' has been declared!</b></div></center>',
			'missing_controller' => '<center><div style="background:#FFA2A2"><b>ERROR: Contoller is missed!</div></center>',
			'creating_controller' => '<center><div style="background:#A2FFAB"><b>SUCCESS: Contoller is created! Please reload page!</div></center>',
			'missing_word' => '<div style="background:#FFA2A2"><center>ERROR: Language::lang(\'argument here is missed!\') </center></div>',
			'empty_word' => '<div style="background:#FFA2A2"><center>ERROR: Language::lang(\'not found argument here!\') </center></div>',
			'wrong_way_view' => '<div style="background:#FFA2A2"><center>ERROR: Page::view( \' wrong way! \' , [$arg] ); </center></div>'
		);