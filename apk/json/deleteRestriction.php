<?php

require_once 'connect_db.php';
require 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['user_id'])){
	$restriction_id = filter_var($_GET["restriction_id"], FILTER_SANITIZE_NUMBER_INT);
	if (security_check($_GET['safe_key'], $_GET['user_id']) == true) {
		$sql = 'delete from restriction WHERE id =:id and deletable=0';

		$run = $dbh->prepare($sql);
		$run->bindValue(':id', $restriction_id);
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