<?php
    function delTree($dir)
    { 
        $files = array_diff(scandir($dir), array('.', '..')); 

        foreach ($files as $file) { 
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
        }

        return rmdir($dir); 
    }
	
	$user=$_COOKIE['site_username'];
	$sciezka=$_GET['id'];
	
	
	delTree($sciezka);
	
	header("Location:panel.php");	
?>