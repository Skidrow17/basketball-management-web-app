<?php

//Access: Everyone
//Purpose: retrieves all matches 

require_once '../../php/connect_db.php';

$json_array = array();

$sql = "SELECT distinct
		home.name AS team_id_1, 
		away.name AS team_id_2,r.id,r.team_score_1,r.team_score_2,DATE_FORMAT(r.date_time, '%d/%m/%Y %H:%i') as date_time,c.latitude,c.longitude,r.state
		FROM 
		game AS r
		JOIN team AS home 
		ON r.team_id_1 = home.id
		JOIN team AS away 
		ON r.team_id_2 = away.id , court c , team t where yearweek(r.date_time,1) = yearweek(curdate(),1) 
		AND r.team_id_1=t.id AND t.category=:id And C.id=r.court_id order by date_time desc ";
		
$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);		
$run = $dbh->prepare($sql);
$run->bindParam(':id', $id, PDO::PARAM_INT);
$run->execute();
$fetch = array();
if ($run->rowCount() > 0) {
	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		$fetch['Match_Details'][] = $row;
		$fetch['ERROR']['error_code'] = "200";
	}
} else {
	$fetch['ERROR']['error_code'] = "204";
}

echo json_encode($fetch);