<!DOCTYPE html>
<html lang="en">
<head>
<title>Panel użytkownika - CRM</title>
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
      <a class="navbar-brand">Chmura - Panel użytkownika</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
		<li><a href="#">Witaj <?php echo $_COOKIE['site_username']; ?></a></li>
		<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Wyloguj</a></li>	  
    </ul>
  </div>
</nav>
<?php
	//sprawdzenie, czy użytkownik jest zalogowany
	if($_COOKIE['site_username']=="")
		header("Location:login.html");
	include("config.php"); 

	$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name)
	or die ("Nie mozna połączyć się z bazą danych z powodu: ".mysqli_error());
	
	$result = mysqli_query($link, "SELECT * FROM logi WHERE login='".$_COOKIE['site_username']."' ORDER BY id_logowania DESC LIMIT 1,1"); 
	$rekord = mysqli_fetch_array($result);
	

		
?>
  <div class="row">
    <div class="col-md-9">	  
		<?php
			if($rekord['nieudane']==1){ ?>
				<div class="panel panel-primary"> 
					<div class="panel-heading">Wykryto nieudaną próbę logowania</div>
					<div class="panel-body">
						Ostatnia nieudana próba logowania nastąpiła <?= $rekord['data']; ?>
					</div>
			  </div>
			<?php }
		?>	
		<div class="panel panel-primary">
	    <div class="panel-heading">Twoje pliki</div>
		<div class="panel-body">
			<a href="#"><img src='images/rsz_folder.png'><?= $_COOKIE['site_username']; ?></a> 
			<a style='margin-left:20px;' href='dodajfolder.php'><img src='images/rsz_add_folder.png'> Dodaj folder</a> 
			<a style='margin-left:20px;' href='odbierz.php'><img src='images/rsz_upload.png'> Dodaj plik do folderu</a><br/>

			<?php
			$listDirCount = 0;

			function listDir($path = ".") {
				global $listDirCount;
				
				$folders = array();
				$files = array();
				
				// Open the given path
				if ($handle = opendir($path)) {
					// Loop through its contents adding folder paths or files to separate arrays
					// Make sure not to include "." or ".." in the listing.
					
					while (false !== ($file = readdir($handle))) {
						if ($file != "." && $file != "..") {
							if (is_dir($path . "/" . $file)) {	
								$folders[] = $path . "/" . $file;
							}
							else { $files[] = $file; }
						}
					}
					
					// Once we build the folder array, get a new number, create a clickable link for the folder, 
					// and then construct a div tag which will contain the next list of folders/files.
					// The link will trigger our javascript above to toggle the div's display on and off.
					
					for ($i = 0; $i < count($folders); $i++) {
						$listDirCount++;
						$nazwa=$folders[$i];
						// Here is the folder name, so you can add icons and such to this line
						echo "<a href=\"javascript:void(0)\" onclick=\"showSubs($listDirCount)\"><img style='margin-left:15px;' src='images/rsz_folder.png'>" . basename($folders[$i]) . "</a>
							<a style='margin-left:20px;' href='dodajfolder.php?id=$nazwa'><img src='images/rsz_add_folder.png'> Dodaj podfolder</a>
							<a style='margin-left:20px;' href='odbierz.php?id=$nazwa'><img src='images/rsz_upload.png'> Dodaj plik do folderu</a>							
							<a style='margin-left:20px;' href='delete2.php?id=$nazwa'><img src='images/rsz_delete_folder.png'> Usuń folder</a><br/>\n";
						
						echo '<div id="folder' . $listDirCount . '" style="margin-left: 15px; margin-right: 10px; display: none;">';
						listDir($folders[$i]);
						echo '</div>';
					}
					
					// Here we just loop and print the file names. Add icons here for files if you like.
					for ($i = 0; $i < count($files); $i++) {
						echo "{$files[$i]} <a href='download.php?path=$path&file=".$files[$i]."'><img src='images/rsz_download.png'></a><a href='delete.php?path=$path&file=".$files[$i]."'><img src='images/rsz_delete.png'></a><br/>\n";
					}
					
					// Finally close the directory.
					closedir($handle);
				}
			}
			$log=$_COOKIE['site_username'];
			listDir("./pliki/$log");
			?>
		 </div>
	<script>
		function showSubs(topicid) {
			var subs = document.getElementById("folder" + topicid);
			
			if (subs.style.display == "none") {
				subs.style.display = "block";
			}
			else {
				subs.style.display = "none";
			}
		}
	</script>
      </div>
	  	  <div class="panel panel-primary"> 
	     <div class="panel-heading">Ostatnie nieprawidłowe logowania</div>
		 <div class="panel-body">
		 <TABLE BORDER=1 width="100%" ><TR style="font-weight:bold;"><TD width="100">Data</TD><TD width="100">Adres IP</TD></TR></TABLE>
		 <?php
			// wyświetlenie ostatnich logowań danego użytkownika
			$logowania = mysqli_query ($link, "SELECT * FROM logi WHERE (login='".$_COOKIE['site_username']."' AND nieudane=1) ORDER BY id_logowania DESC LIMIT 3");
		
			while ($wiersz = mysqli_fetch_array ($logowania))
			{
				$data = $wiersz [1];
				$ip = $wiersz [3];
				echo '<TABLE BORDER=1 width="100%"><TR><TD width="100">'.$data.'</TD><TD width="100">'.$ip.'</TD></TABLE>';
			}
		?>
		 </div>
      </div>
    </div>

  </div>
</div>
</body>
</html>
