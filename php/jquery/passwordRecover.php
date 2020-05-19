<?php

//Access: Everyone
//Purpose: recovery password email sent

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if(isset($_SERVER['HTTP_HOST']) && isset( $_SERVER['REQUEST_URI'])){
	$url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '/../../../password_recover.php?code=';
}

if (isset($_POST['username']) || isset($_SESSION['username'])) {
	
	$uname = "";
	if(isset($_POST['username'])){
		$uname = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	}else{
		$uname = filter_var($_SESSION['username'], FILTER_SANITIZE_STRING);
	}
	$sql = "SELECT id,email,password_recovery_url FROM user where username = :uname";
	$run = $dbh->prepare($sql);
	$run->bindParam(':uname', $uname, PDO::PARAM_STR);
	$run->execute();
	$recover_encode = randomString(20);
	$userExists = false;
	
	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		
		if(empty($row["password_recovery_url"]!="")){
			$sql = "UPDATE user SET password_recovery_url = :recover_encode where id = :user_id";
			$mod = $dbh->prepare($sql);
			$mod->bindParam(':recover_encode', $recover_encode, PDO::PARAM_STR);
			$mod->bindParam(':user_id', $row['id'], PDO::PARAM_INT);
			$mod->execute();
			recovery_email_send($row['email'],$url.$recover_encode);
		}else{
			if(!isset($_SESSION['language'])){
				echo $password_change_request;
			}else{
		 		echo $please_check_email;
			}
		}
		$userExists = true;
	}
	
	if(!$userExists){
		echo $non_valid_username;
	}
}