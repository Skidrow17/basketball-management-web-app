<?php

//Access: Authorized User & Admin
//Purpose: change password after recovery request

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST["submit"]) && isset($_POST["password1"])) {
   
        $passwordReoveryCode = filter_var($_POST['submit'], FILTER_SANITIZE_STRING);
		$hashedPassword =  password_hash($_POST['password1'], PASSWORD_DEFAULT);
		$userId = -1;
		$nullPasswordRecoveryUrl = "";
		
		$sql = "SELECT id FROM user WHERE password_recovery_url=:pru";
		$run = $dbh->prepare($sql);
		$run->bindParam(':pru', $passwordReoveryCode, PDO::PARAM_STR);
        $run->execute();
		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            $userId = $row["id"];
        }
		
		if($userId != -1){
			$sql = "UPDATE user SET password = :hashedPassword, password_recovery_url = :nullPasswordRecoveryUrl where id = :userId";
			$run = $dbh->prepare($sql);
			$run->bindParam(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
			$run->bindParam(':nullPasswordRecoveryUrl', $nullPasswordRecoveryUrl, PDO::PARAM_STR);
			$run->bindParam(':userId', $userId, PDO::PARAM_INT);
			$run->execute();
			$_SESSION['server_response'] = "Ο κωδικός πρόσβασής σας άλλαξε με επιτυχία";
			header('Location: ../../index.php');
			die();
		}else{
			$_SESSION['server_response'] = "Η αίτηση αλλαγής κωδικού έχει λήξει";
			header('Location: ../../password_recover.php');
			die();
		}
}
?>

