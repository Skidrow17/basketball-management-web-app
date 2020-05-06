<?php
session_start();
require 'language.php';

if(isset($_COOKIE['uname'])||isset($_COOKIE['pwd'])):
    
	setcookie('uname', '', [
		'expires' => time() - 7000000,
		'path' => '/',
		'secure' => true,
		'samesite' => 'None',
		'httponly' => true,
	]);
	
	setcookie('pwd', '', [
		'expires' => time() - 7000000,
		'path' => '/',
		'secure' => true,
		'samesite' => 'None',
		'httponly' => true,
	]);

	setcookie('safe_key', '', [
		'expires' => time() - 7000000,
		'path' => '/',
		'secure' => true,
		'samesite' => 'None',
		'httponly' => true,
	]);
	
	
endif;
$_SESSION['server_response'] = $successfulLogout;
header('location:../index.php');
die();
?>