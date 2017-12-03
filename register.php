<?php 

include("config.php"); 

$link = mysql_connect($db_host, $db_user, $db_pass)
or die ("Nie można połączyć się z bazą z powodu: ".mysql_error());

mysql_select_db($db_name)
or die ("Nie można wybrać bazy danych z powodu: ".mysql_error());

// sprawdzanie, czy konto o podanym loginie już nie istnieje
$check = "select id_uzytkownika from users where login = '".$_POST['username']."';";
$qry = mysql_query($check) or die ("Nie można dopasować danych z powodu: ".mysql_error());
$num_rows = mysql_num_rows($qry); 
if ($num_rows != 0) { 
echo "Przepraszamy, login $username jest już zajęty.<br>";
echo "<a href=register.html>Spróbuj ponownie</a>";
exit; 
} else {
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
		
		// sprawdzenie, czy hasło posiada odpowiednią długość	
		if ((strlen($password1)<6) || (strlen($password1)>20))
		{
			echo "Hasło musi posiadać od 6 do 20 znaków!<br>";
			echo "<a href=register.html>Spróbuj ponownie</a>";
			exit;
		}
		// sprawdzenie, czy podano identyczne hasła
		if ($password1!=$password2)
		{
			echo "Podane hasła nie są identyczne!<br>";
			echo "<a href=register.html>Spróbuj ponownie</a>";
			exit;
		}
// dodanie użytkownika do bazy danych
$insert = mysql_query("insert into users values ('NULL',
'".$_POST['username']."',
'".$_POST['password1']."',
'0',
'NULL')")
or die("Nie można wprowadzić danych z powodu: ".mysql_error());

if(isset($_POST['username'])){
	if (!file_exists($_SERVER['DOCUMENT_ROOT']."/z7/pliki/".$_POST['username'])) {
    mkdir($_SERVER['DOCUMENT_ROOT']."/z7/pliki/".$_POST['username'], 0777, true);
	}	
	header("Location:panel.php");		
}

echo "Twoje konto zostało założone!<br>"; 
echo "Teraz możesz się <a href='login.html'>zalogować</a>"; 
}

?>
