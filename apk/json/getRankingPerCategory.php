<?php

//Access: Everyone
//Purpose: retrieves all ranking per category

require_once '../../php/connect_db.php';
require 'useful_functions.php';
$fetch = array();

$cid = filter_var($_GET["cid"], FILTER_SANITIZE_NUMBER_INT);		
$gid = filter_var($_GET["gid"], FILTER_SANITIZE_NUMBER_INT);		

$sql = "Select id,name,wins,loses,total_games,points from team where category = :cid AND team_group = :gid AND active = 0 ORDER BY points DESC";
$run = $dbh->prepare($sql);
$run->bindParam(':cid', $cid, PDO::PARAM_INT);
$run->bindParam(':gid',	$gid, PDO::PARAM_INT);
$run->execute();
if ($run->rowCount() > 0) {
	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		$fetch['Team_Details'][] = $row;
		$fetch['ERROR']['error_code'] = "200";
	}
} else {
	$fetch['ERROR']['error_code'] = "204";
}
echo json_encode($fetch);
