<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Dodaj folder - CRM</title>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<style>
.text-center {
  text-align: center;
}
body {
  margin-top: 100px;
  background: #16a085;
}
</style>
</head>
<body>
  <div class="row">
    <div class="col-md-9">
	  <div class="panel panel-primary"> 
	     <div class="panel-heading">Twoje pliki</div>
		 <div class="panel-body">
<?php
if(isset($_POST['folder'])){
	$user=$_COOKIE['site_username'];
	if(isset($_GET['id'])){
		$folder=$_GET['id'];
		$folder=str_replace('./pliki/','',$folder);
		$sciezka=$folder;
	}else{
		$sciezka=$user;
	}
	if (!file_exists($_SERVER['DOCUMENT_ROOT']."/z7/pliki/$sciezka/".$_POST['folder'])) {
	
    mkdir($_SERVER['DOCUMENT_ROOT']."/z7/pliki/$sciezka/".$_POST['folder'], 0777, true);
	}	
	header("Location:panel.php");		
}else{
?>
<form method="POST"> 
			<input type="text" name="folder"/> 
			<input type="submit" value="Utwórz folder"/>
</form>
<?php	
}
?>
</div>
		</div>
	</div>
</div>
</body>
</html>