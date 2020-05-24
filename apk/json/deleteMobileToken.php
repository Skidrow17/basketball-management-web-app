<?php

//Access: Authorized User & Admin
//Purpose: deletes firebase mobile token

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
	$empty_mobile_token = '';
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		update_last_seen_time($_GET['id']);
		$sql = "UPDATE user SET mobile_token=:mobile_token WHERE id=:id";
		$run = $dbh->prepare($sql);
		$run->bindParam(':mobile_token',$empty_mobile_token,PDO::PARAM_STR);
		$run->bindParam(':id',$id,PDO::PARAM_INT);
		$run->execute();

		if ($run->rowCount() > 0) {
			$fetch['ERROR']['error_code'] = "200";
		} else {
			$fetch['ERROR']['error_code'] = "201";
		}
		echo json_encode($fetch);
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}
