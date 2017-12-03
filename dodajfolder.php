<?php
if(isset($_POST['folder'])){
	if (!file_exists($_SERVER['DOCUMENT_ROOT']."/z7/pliki/".$_POST['folder'])) {
    mkdir($_SERVER['DOCUMENT_ROOT']."/z7/pliki/".$_POST['folder'], 0777, true);
	}	
	header("Location:panel.php");		
}

?>