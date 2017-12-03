<?php
	$filename = basename($_GET['file']);
	$pathh = $_GET['path'];
	$pathh = str_replace('./pliki/','',$pathh);
	$path = $_SERVER['DOCUMENT_ROOT'].'/z7/pliki/'.$pathh;	
	unlink($path.'/'.$filename);
	
	header("Location:panel.php");		
?>