<?php
$max_rozmiar = 1000000;
if (is_uploaded_file($_FILES['plik']['tmp_name'])){
	if ($_FILES['plik']['size'] > $max_rozmiar) {
		echo "Przekroczenie rozmiaru $max_rozmiar B"; 
	}
	else{
	echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
	if (isset($_FILES['plik']['type'])) {
		echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; 
	}
	if (!file_exists($_SERVER['DOCUMENT_ROOT']."/z7/pliki/".$_COOKIE['site_username'])) {
    mkdir($_SERVER['DOCUMENT_ROOT']."/z7/pliki/".$_COOKIE['site_username'], 0777, true);
	}
	move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/z7/pliki/".$_COOKIE['site_username']."/".$_FILES['plik']['name']);
	header("Location:panel.php");
	}	
}
else {
	echo 'Błąd przy przesyłaniu danych!';
}
?>