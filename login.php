<?php

include("config.php"); 

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name)
or die ("Nie mozna połączyć się z bazą danych z powodu: ".mysqli_error());

// pobieranie informacji o adresie IP
$ip = $_SERVER['REMOTE_ADDR'];
$login=$_POST['username']; 
$pass=$_POST['password']; 

$result = mysqli_query($link, "SELECT * FROM users WHERE login='$login'"); 
$rekord = mysqli_fetch_array($result); 
if(!$rekord)
{ 
echo "Niepoprawny login lub hasło.<br />";
echo "<a href=login.html>Spróbuj ponownie</a>";
}
//sprawdzanie, czy konto nie jest zablokowane
else if (strtotime($rekord['blok'])<time())
{ 
if($rekord['haslo']==$pass) // czy hasło zgadza się z BD
{
	$link->query("INSERT INTO logi VALUES (NULL, CURRENT_TIMESTAMP, '$login', '".$ip."', '0')");
	$link->query("UPDATE users SET nieudane=0 WHERE login='$login'");
	
	setcookie("loggedin", "TRUE", time()+(3600 * 2));
	setcookie("site_username", $_POST['username']);
	
	header("Location:panel.php");
}
else
{
	$nieudane = $rekord [3];
	if($nieudane<3){
		$link->query("UPDATE users SET nieudane=nieudane+1 WHERE login='$login'");
		$link->query("INSERT INTO logi VALUES (NULL, CURRENT_TIMESTAMP, '$login', '".$ip."', '1')");
		
		echo "Niepoprawny login lub hasło.<br />";
		echo "<a href=login.html>Spróbuj ponownie</a>";
	}
	else{
		$link->query("UPDATE users SET blok=(CURRENT_TIMESTAMP + INTERVAL 5 MINUTE) WHERE login='$login'");
		echo "Twoje konto zastało tymczasowo zablokowane ze względu na zbyt dużą ilość nieprawidłowych prób logowania<br>"; 
		echo "Wróć do <a href=index.php>strony głównej</a>.";
	}	
}
}
else{
	echo "Twoje konto zastało tymczasowo zablokowane ze względu na zbyt dużą ilość nieprawidłowych prób logowania<br>"; 
	echo "Wróć do <a href=index.php>strony głównej</a>.";
}
?>
