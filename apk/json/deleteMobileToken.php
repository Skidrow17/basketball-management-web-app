<?php

//Access: Authorized User & Admin
//Purpose: deletes firebase mobile token

require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){

	$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		$sql = "UPDATE user SET mobile_token=? WHERE id=?";
		$run = $dbh->prepare($sql);
		$run->execute(["", $id]);

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
