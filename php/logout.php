<?php
session_start();
require 'language.php';

if(isset($_COOKIE['uname'])||isset($_COOKIE['pwd'])):
      setcookie('uname','',time()-7000000,'/');
	  setcookie('pwd','',time()-7000000,'/');
	  setcookie('safe_key','',time()-7000000,'/');
endif;
$_SESSION['server_response'] = $successfulLogout;
header('location:../index.php');
die();
?>