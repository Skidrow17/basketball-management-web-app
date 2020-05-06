<?php
session_start();
require 'language.php';

if(isset($_COOKIE['uname'])||isset($_COOKIE['pwd'])):
      setcookie('uname','',time()-7000000,'/',null,true,true);
	  setcookie('pwd','',time()-7000000,'/',null,true,true);
	  setcookie('safe_key','',time()-7000000,'/',null,true,true);
endif;
$_SESSION['server_response'] = $successfulLogout;
header('location:../index.php');
die();
?>