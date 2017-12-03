<?php 

include("config.php"); 

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name)
or die ("Nie mozna połączyć się z bazą danych z powodu: ".mysqli_error());


// sprawdzanie, czy konto o podanym loginie już nie istnieje
//$check = "SELECT id_uzytkownika FROM users WHERE login = '".$_POST['username']."'";
$qry = mysqli_query($link, "SELECT id_uzytkownika FROM users WHERE login = '".$_POST['username']."'");
$num_rows = mysqli_num_rows($qry); 
if ($num_rows != 0) { 
echo "Przepraszamy, login $username jest już zajęty.<br>";
echo "<a href=register.html>Spróbuj ponownie</a>";
exit; 
} else {
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
		
		// sprawdzenie, czy podano identyczne hasła
		if ($password1!=$password2)
		{
			echo "Podane hasła nie są identyczne!<br>";
			echo "<a href=register.html>Spróbuj ponownie</a>";
			exit;
		}
// dodanie użytkownika do bazy danych
$insert = mysqli_query($link, "INSERT INTO users VALUES ('NULL',
'".$_POST['username']."',
'".$_POST['password1']."',
'0',
'NULL')");

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
