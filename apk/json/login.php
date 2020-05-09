<?php

//Access: Authorized User & Admin
//Purpose: login helper

if (isset($_GET['password']) && isset($_GET['username'])) {
	require 'connect_db.php';
	require 'useful_functions.php';

	$safe_key = randomString(15);
	$fetch = array();
	$password = $_GET['password'];
	$username = preg_replace("/[^a-zA-Z0-9]+/", "", $_GET['username']);

	$sql = "SELECT get_number_of_received_messages_by_user(U.id) as nom,get_number_of_announcements() as noa, U.polling_time,U.id,U.username,U.password,U.name,U.surname,U.email,U.phone,U.profile_pic,U.active,U_C.name as profession FROM user U , user_categories U_C where U.profession=U_C.id AND username=:username";
	$run = $dbh->prepare($sql);
	$run->bindParam(':username', $username, PDO::PARAM_STR);
	$run->execute();

	if ($run->rowCount() > 0) {
		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			if ((password_verify($password, $row['password'])) || (preg_replace('/[^\p{L}\p{N}\s]/u', '', $row['password']) === preg_replace('/[^\p{L}\p{N}\s]/u', '', $password))) {
				
				$sql = "UPDATE user SET mobile_token=:mobile_token where id = :id";
				$res = $dbh->prepare($sql);
				$res->bindParam(':mobile_token', $_GET['mobile_token'], PDO::PARAM_STR);
				$res->bindParam(':id', $row['id'], PDO::PARAM_INT);
				$res->execute();
				
				if(isset($_GET['safe_key']) && isset($_GET['id'])){
					if (security_check($_GET['safe_key'], $_GET['id']) == false) {
						$sql = "INSERT INTO login_history (user_id,safe_key,device_name,ip) VALUES (:id,:safe_key,:device_name,:ip)";
						$res = $dbh->prepare($sql);
						$res->bindParam(':safe_key', $safe_key, PDO::PARAM_STR);
						$res->bindParam(':id', $row['id'], PDO::PARAM_INT);
						$res->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
						$res->bindParam(':device_name', $_GET['device_name'], PDO::PARAM_STR);
						$res->execute();
						$fetch['safe_key']['key'] = $safe_key;
					}else{
						$fetch['safe_key']['key'] = $_GET['safe_key'];
					}
					
				}else{
					$sql = "INSERT INTO login_history (user_id,safe_key,device_name,ip) VALUES (:id,:safe_key,:device_name,:ip)";
					$res = $dbh->prepare($sql);
					$res->bindParam(':safe_key', $safe_key, PDO::PARAM_STR);
					$res->bindParam(':id', $row['id'], PDO::PARAM_INT);
					$res->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
					$res->bindParam(':device_name', $_GET['device_name'], PDO::PARAM_STR);
					$res->execute();

					$fetch['safe_key']['key'] = $safe_key;
				}
				$fetch['ERROR']['error_code'] = "200";
				$fetch['user'] = $row;
			}else{
				$fetch['ERROR']['error_code'] = "402";
			}
		}
	}else {
		$fetch['ERROR']['error_code'] = "401";
	}

	echo json_encode($fetch);
}