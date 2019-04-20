<?php

require_once 'connect_db.php';
require 'useful_functions.php';
$fetch = array();

if(security_check($_GET['safe_key'],$_GET['id'])==true)
{
	$sql="SELECT 
		home.name AS team_id_1, 
		away.name AS team_id_2,r.id,r.team_score_1,r.team_score_2,r.date_time,c.latitude,c.longitude
		FROM 
		game AS r
		JOIN team AS home 
		ON r.team_id_1 = home.id
		JOIN team AS away 
		ON r.team_id_2 = away.id , court c , human_power HP where C.id=r.court_id AND HP.game_id=r.id AND HP.user_id=:uid";
		
	$run = $dbh->prepare($sql);
	$run->bindParam(':uid', $_GET['id'], PDO::PARAM_INT);
	$run ->execute();
	
	
	if ($run->rowCount() > 0)
	{

	while($row=$run->fetch(PDO::FETCH_ASSOC)){
		$fetch['Match_Details'][]=$row;
		$fetch['ERROR']['error_code']="200";
	}
	}
	else
	{
		$fetch['ERROR']['error_code']="204";
	}
	echo json_encode($fetch);
}
else
{
	$fetch['ERROR']['error_code']="403";
	echo json_encode($fetch);
}



?>

