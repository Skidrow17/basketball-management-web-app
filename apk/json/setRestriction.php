<?php

//Access: Authorized User
//Purpose: import new restriction

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['user_id'])){
	
	update_last_seen_time($_GET['user_id']);
	$match_week = date("W", strtotime($_GET['date']));
	$match_year = date("Y", strtotime($_GET['date']));
	$comment = filter_var($_GET["comment"], FILTER_SANITIZE_STRING);
	$sql = "SELECT COUNT(*) as nor FROM human_power HP,game G WHERE G.Id = HP.game_id AND Week(G.date_time,1) = :match_week AND Year(G.date_time) = :match_year";
	$run = $dbh->prepare($sql);
	$run->bindParam(':match_week', $match_week, PDO::PARAM_STR);
	$run->bindParam(':match_year', $match_year, PDO::PARAM_STR);
	$run->execute();
	$restrictions_closed = false;
	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
	  if($row['nor'] != 0){
		  $restrictions_closed = true;
	  }
	}
	
	if($restrictions_closed){
	   $fetch['ERROR']['error_code'] = "202";
	   echo json_encode($fetch);
	}else if (security_check($_GET['safe_key'], $_GET['user_id']) == true) {
		$sql = "INSERT INTO `restriction`(`user_id`, `date`, `time_from` , `time_to`,`comment` ) VALUES (:user_id,:date,:time_from,:time_to,:comment)";
		$run = $dbh->prepare($sql);
		$run->bindParam(':user_id', $_GET["user_id"], PDO::PARAM_INT);
		$run->bindParam(':date', $_GET["date"], PDO::PARAM_STR);
		$run->bindParam(':time_from', $_GET["time"], PDO::PARAM_STR);
		$run->bindParam(':time_to', $_GET["time2"], PDO::PARAM_STR);
		$run->bindParam(':comment',$comment, PDO::PARAM_STR);
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