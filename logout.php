<?php
unset($_COOKIE['loggedin']);
unset($_COOKIE['site_username']);
setcookie("loggedin", "FALSE", time()-3600);
setcookie("site_username", "", time()-3600);
header("Location:index.php");
?>