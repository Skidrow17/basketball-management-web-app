<?php
require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['user_id'])){
	if (security_check($_GET['safe_key'], $_GET['user_id']) == true) {
		$sql = "UPDATE game SET team_score_1=?, team_score_2=? WHERE id=?";
		$run = $dbh->prepare($sql);
		$run->execute([$_GET['team_score_1'], $_GET['team_score_2'], $_GET['match_id']]);

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