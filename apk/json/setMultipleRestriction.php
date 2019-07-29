<?php

require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

$f = "00:00:00";
$t = "23:59:59";
$x = 0;
$parts = explode("/", $_GET["date"]);
$timezone = date_default_timezone_get();
$now = date('m/d/Y h:i:s a', time());
if (security_check($_GET['safe_key'], $_GET['user_id']) == true) {
	$user_id = filter_var($_GET["user_id"], FILTER_SANITIZE_NUMBER_INT);

	for ($i = 0; $i < sizeof($parts); $i++) {
		$sql = "INSERT INTO `restriction`(`user_id`, `date`, `time_from` , `time_to` ) VALUES (:user_id,:date,:time_from,:time_to)";
		$run = $dbh->prepare($sql);
		$run->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$run->bindParam(':date', $parts[$i], PDO::PARAM_STR);
		$run->bindParam(':time_from', $f, PDO::PARAM_STR);
		$run->bindParam(':time_to', $t, PDO::PARAM_STR);
		$run->execute();

		if ($run->rowCount() > 0) {
			$x = $x + 1;
		}
	}

	$y = sizeof($parts) - 1;

	if ($x == $y) {
		$fetch['insert_message'] = $x . "/" . $y . " Επιτυχία";
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