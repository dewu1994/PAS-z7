<!DOCTYPE html>
<html>
<head>
<title>Damian Wierzbiński - Chmura</title>
<meta charset="utf-8" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<style>
.text-right {
  float: right;
}
body {
  background: #16a085;
}
</style>
</head>
<body>
<div class="container">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="http://aplikacjedamwie.hekko24.pl">Powrót</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Główna</a></li>
      <li><a href="panel.php">Panel użytkownika</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
	<?php
	// sprawdzanie, czy użytkownik jest zalogowany
	if(isset($_COOKIE['site_username']) AND isset($_COOKIE['loggedin'])){
	?>	
	  <li><a href="#">Witaj <?php echo $_COOKIE['site_username']; ?></a></li>
	  <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Wyloguj</a></li>
	<?php	
	}else{
	?>
      <li><a href="register.html"><span class="glyphicon glyphicon-user"></span> Zarejestruj</a></li>
      <li><a href="login.html"><span class="glyphicon glyphicon-log-in"></span> Zaloguj</a></li>
	<?php 
	}
	?>
    </ul>
  </div>
</nav>
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-primary"> 
	     <div class="panel-heading">Witaj <?php echo $_COOKIE['site_username']; ?>!</div>
		 <div class="panel-body">
		    Witamy w naszej chmurze
		 </div>
      </div>
    </div>

  </div>
</div>
</body>
</html>
