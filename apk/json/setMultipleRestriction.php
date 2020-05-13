<?php

//Access: Authorized User & Admin
//Purpose: import mulitple restrictions

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['user_id'])){
	
	
	$match_week = date("W", strtotime(date("Y/m/d")));
	$match_year = date("Y", strtotime(date("Y/m/d")));
	$comment = filter_var($_GET["comment"], FILTER_SANITIZE_STRING);
	$sql = "SELECT COUNT(*) as nor FROM human_power HP,game G WHERE G.Id = HP.game_id AND Week(G.date_time,1) = ? AND Year(G.date_time) = ?";
	$run = $dbh->prepare($sql);
	$run->execute([$match_week,$match_year]);
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
		$time_from = "00:00:00";
		$time_to = "23:59:59";
		$number_of_restrictions_imported = 0;
		$parts = explode("/", $_GET["date"]);
		$timezone = date_default_timezone_get();
		$now = date('m/d/Y h:i:s a', time());
		$user_id = filter_var($_GET["user_id"], FILTER_SANITIZE_NUMBER_INT);

		for ($i = 0; $i < sizeof($parts); $i++) {
			$sql = "INSERT INTO `restriction`(`user_id`, `date`, `time_from` , `time_to`, `comment`) VALUES (:user_id,:date,:time_from,:time_to,:comment)";
			$run = $dbh->prepare($sql);
			$run->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$run->bindParam(':date', $parts[$i], PDO::PARAM_STR);
			$run->bindParam(':time_from', $time_from, PDO::PARAM_STR);
			$run->bindParam(':time_to', $time_to, PDO::PARAM_STR);
			$run->bindParam(':comment',$comment, PDO::PARAM_STR);
			$run->execute();

			if ($run->rowCount() > 0) {
				$number_of_restrictions_imported = $number_of_restrictions_imported + 1;
			}
		}

		$total_number_of_restrictions = sizeof($parts) - 1;

		if ($total_number_of_restrictions == $number_of_restrictions_imported) {
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