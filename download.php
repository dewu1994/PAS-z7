<?php
$filename = basename($_GET['file']);
$pathh = $_GET['path'];
$pathh = str_replace('./pliki/','',$pathh);
// Specify file path.
$path = $_SERVER['DOCUMENT_ROOT'].'/z7/pliki/'.$pathh;
$download_file =  $path.'/'.$filename;

if(!empty($filename)){
    // Check file is exists on given path.
    if(file_exists($download_file))
    {
      header('Content-Disposition: attachment; filename=' . $filename);  
      readfile($download_file); 
      exit;
    }
    else
    {
      echo 'File does not exists on given path';
    }
 }