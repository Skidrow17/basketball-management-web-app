<?php

//Access: Authorized User
//Purpose: set score to owned messages

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['user_id'])){

	$team_score_1 = filter_var($_GET["team_score_1"], FILTER_SANITIZE_NUMBER_INT);
	$team_score_2 = filter_var($_GET["team_score_2"], FILTER_SANITIZE_NUMBER_INT);
	$state = filter_var($_GET["state"], FILTER_SANITIZE_NUMBER_INT);
	$match_id = filter_var($_GET["match_id"], FILTER_SANITIZE_NUMBER_INT);

	if (security_check($_GET['safe_key'], $_GET['user_id']) == true) {
		update_last_seen_time($_GET['user_id']);
		$sql = "UPDATE game SET team_score_1 = :team_score_1, team_score_2 = :team_score_2, state=:state WHERE id = :match_id";
		$run = $dbh->prepare($sql);
		$run->bindParam(':team_score_1',$team_score_1,PDO::PARAM_INT);
		$run->bindParam(':team_score_2',$team_score_2,PDO::PARAM_INT);
		$run->bindParam(':state',$state,PDO::PARAM_INT);
		$run->bindParam(':match_id',$match_id,PDO::PARAM_INT);
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