<?php 

	function ckeditor( $var )
	{

		echo '
			<script>
                CKEDITOR.replace( ' . $var . ' );
            </script>';

	}