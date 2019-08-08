<?php

require_once 'connect_db.php';
require 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['user_id'])){
	if (security_check($_GET['safe_key'], $_GET['user_id']) == true) {
		$sql = "INSERT INTO `restriction`(`user_id`, `date`, `time_from` , `time_to` ) VALUES (:user_id,:date,:time_from,:time_to)";
		$run = $dbh->prepare($sql);
		$run->bindParam(':user_id', $_GET["user_id"], PDO::PARAM_INT);
		$run->bindParam(':date', $_GET["date"], PDO::PARAM_STR);
		$run->bindParam(':time_from', $_GET["time"], PDO::PARAM_STR);
		$run->bindParam(':time_to', $_GET["time2"], PDO::PARAM_STR);
		$run->execute();

		if ($run->rowCount() > 0) {
			$fetch['insert_message'] = "Επιτυχία";
			$fetch['ERROR']['error_code'] = "200";
		} else {
			$fetch['insert_message'] = "Αποτυχία";
			$fetch['ERROR']['error_code'] = "200";
		}
		echo json_encode($fetch);
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}