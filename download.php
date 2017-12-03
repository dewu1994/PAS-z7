<?php
$filename = basename($_GET['file']);
$pathh = $_GET['path'];
$pathh = str_replace('./pliki/','',$pathh); 
$path = $_SERVER['DOCUMENT_ROOT'].'/z7/pliki/'.$pathh;
$download_file =  $path.'/'.$filename;

if(!empty($filename)){
    //sprawdzenie, czy dany plik istnieje
    if(file_exists($download_file))
    {
      header('Content-Disposition: attachment; filename=' . $filename);  
      readfile($download_file); 
      exit;
    }
    else
    {
      echo 'Podany plik nie istnieje w tej lokalizacji';
    }
 }