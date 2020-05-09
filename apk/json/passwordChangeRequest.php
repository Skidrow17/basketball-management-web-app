<?php

//Access: Authorized User & Admin
//Purpose: password change request

require_once 'connect_db.php';
require_once 'useful_functions.php';

$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	
	$uid = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
	$sql = "SELECT id,email,password_recovery_url FROM user where id = :id";
	$run = $dbh->prepare($sql);
	$run->bindParam(':id', $uid, PDO::PARAM_STR);
	$run->execute();
	$recover_encode = randomNumber(6);
	$userExists = false;
	$fetch = array();

	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {	
		if(empty($row["password_recovery_url"]!="")){
			$sql = "UPDATE user SET password_recovery_url = ? where id = ?";
			$mod = $dbh->prepare($sql);
			$mod->execute([$recover_encode,$row['id']]);
			sent_mail($row['email'],$recover_encode);
			$fetch['ERROR']['error_code'] = "200";
		}else{
			$fetch['ERROR']['error_code'] = "206";
		}
	}
}else{
	$fetch['ERROR']['error_code'] = "403";
}

echo json_encode($fetch);