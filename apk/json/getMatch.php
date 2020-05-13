<?php

//Access: Authorized User & Admin
//Purpose: get match details

require_once '../../php/connect_db.php';
require '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);		
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		$sql = "SELECT 
				home.name AS team_id_1, 
				away.name AS team_id_2,r.id,r.state,r.team_score_1,r.team_score_2,DATE_FORMAT(r.date_time, '%d/%m/%Y %H:%i') as date_time,c.latitude,c.longitude
				FROM 
				game AS r
				JOIN team AS home 
				ON r.team_id_1 = home.id
				JOIN team AS away 
				ON r.team_id_2 = away.id , court c , human_power HP where yearweek(r.date_time,1) = yearweek(curdate(),1) AND C.id=r.court_id AND HP.game_id=r.id AND HP.user_id=:uid";
		$run = $dbh->prepare($sql);
		$run->bindParam(':uid', $id, PDO::PARAM_INT);
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