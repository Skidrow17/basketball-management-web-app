<?php

require_once 'connect_db.php';
require 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		$sql = "Select id,name,wins,loses,total_games,points from team where category =:cid";
		$run = $dbh->prepare($sql);
		$run->bindParam(':cid', $_GET['cid'], PDO::PARAM_INT);
		$run->execute();
		if ($run->rowCount() > 0) {
			while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
				$fetch['Match_Details'][] = $row;
				$fetch['ERROR']['error_code'] = "200";
			}
		} else {
			$fetch['ERROR']['error_code'] = "204";
		}
		echo json_encode($fetch);
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}