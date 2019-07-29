<?php

if (isset($_GET['password']) && isset($_GET['username'])) {
	require 'connect_db.php';
	require 'useful_functions.php';

	$safe_key = randomString(15);
	$fetch = array();
	$password = $_GET['password'];
	$username = preg_replace("/[^a-zA-Z0-9]+/", "", $_GET['username']);

	$sql = "SELECT U.id,U.username,U.password,U.name,U.surname,U.email,U.phone,U.profile_pic,U.active,U_C.name as profession FROM user U , user_categories U_C where U.profession=U_C.id AND username=:username";
	$run = $dbh->prepare($sql);
	$run->bindParam(':username', $username, PDO::PARAM_STR);
	$run->execute();

	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		if ((password_verify($password, $row['password'])) || (preg_replace('/[^\p{L}\p{N}\s]/u', '', $row['password']) === preg_replace('/[^\p{L}\p{N}\s]/u', '', $password))) {
			$sql = "INSERT INTO login_history (user_id,safe_key,device_name,ip)VALUES (:id,:safe_key,:device_name,:ip)";
			$res = $dbh->prepare($sql);
			$res->bindParam(':safe_key', $safe_key, PDO::PARAM_STR);
			$res->bindParam(':id', $row['id'], PDO::PARAM_INT);
			$res->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
			$res->bindParam(':device_name', $_GET['device_name'], PDO::PARAM_STR);
			$res->execute();

			$fetch['login_info']['nom'] = getNumberOfMessages($username);
			$fetch['login_info']['noa'] = getNumberOfAnnouncements();
			$fetch['login_info']['sk'] = $safe_key;
			$fetch['login_info']['li'] = getLastId();
			$fetch['user'][] = $row;
		}
	}

	echo json_encode($fetch);
}