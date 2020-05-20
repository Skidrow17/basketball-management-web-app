<?php
 
//Access: Admin & Authorized User
//Purpose: logout helper that unregister the cookies

session_start();
require 'language.php';

if(isset($_COOKIE['uname'])||isset($_COOKIE['pwd'])):
      setcookie('uname','',time()-7000000,'/','',true,true);
	  setcookie('pwd','',time()-7000000,'/','',true,true);
	  setcookie('safe_key','',time()-7000000,'/','',true,true);
endif;
$_SESSION['server_response'] = $successfulLogout;
header('location:../index.php');
session_destroy();
die();

?>