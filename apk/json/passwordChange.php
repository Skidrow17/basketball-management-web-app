<?php

//Access: Authorized User & Admin
//Purpose: password change 

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';

$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		update_last_seen_time($_GET['id']);
		$passwordReoveryCode = filter_var($_GET['recovery_code'], FILTER_SANITIZE_STRING);
		$hashedPassword =  password_hash($_GET['password'], PASSWORD_DEFAULT);
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
			$sql = "UPDATE user SET password = :hashedPassword,password_recovery_url=:nullPasswordRecoveryUrl where id = :userId";
			$run = $dbh->prepare($sql);
			$run->bindParam(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
			$run->bindParam(':nullPasswordRecoveryUrl', $nullPasswordRecoveryUrl, PDO::PARAM_STR);
			$run->bindParam(':userId', $userId, PDO::PARAM_INT);
			$run->execute();
			$fetch['ERROR']['error_code'] = "200";
		}else{
			$fetch['ERROR']['error_code'] = "406";
		}
	}else{
		$fetch['ERROR']['error_code'] = "403";
	}
}

echo json_encode($fetch);