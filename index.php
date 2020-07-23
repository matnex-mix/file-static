<?php

if( !empty($_GET['f']) ){

	$f = __DIR__.'/storage/'.$_GET['f'];

	if( !file_exists($f) ){
		http_response_code(404);
		die('404: File Not Found');
	}

	$file = file_get_contents($f);
	$mime = mime_content_type($f);

	header("Content-Type: $mime");
	die( $file );

}

if( !empty($_FILES['file']['tmp_name']) ){

	$e = pathinfo($_FILES['file']['name'])['extension'];
	$f = Date('YmdHis').".$e";
	if( @move_uploaded_file($_FILES['file']['tmp_name'], __DIR__."/storage/".$f) ){
		die($f);
	} else {
		die('error');
	}

}

http_response_code(503);
die('error');