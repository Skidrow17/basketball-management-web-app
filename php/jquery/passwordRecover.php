<?php

//Access: Everyone
//Purpose: recovery password email sent

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';
$url = "https://zafora.ece.uowm.gr/~ictest00909/EKA/password_recover.php?code=";


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
			$sql = "UPDATE user SET password_recovery_url = ? where id = ?";
			$mod = $dbh->prepare($sql);
			$mod->execute([$recover_encode,$row['id']]);
			recovery_email_send($row['email'],$url.$recover_encode);
		}else{
			if(!isset($_SESSION['language'])){
				echo "Αποστολή αίτησης αλλαγής κωδικού πρόσβασης στο ηλεκτρονικό ταχυδρομείο";
			}else{
				echo $please_check_email;
			}
		}
		$userExists = true;
	}
	
	if(!$userExists){
		echo 'Μη έγκυρο όνομα χρήστη';
	}
  
}
?>