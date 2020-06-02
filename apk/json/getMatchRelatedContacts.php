<?php

//Access: Authorized User & Admin
//Purpose: retrieves contactes related to matches

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['gid'])){
	$gid = filter_var($_GET["gid"], FILTER_SANITIZE_NUMBER_INT);		
	$sql = "SELECT U.id,U.name,U.surname,U.profile_pic,UC.name as profession from user U,human_power HP,user_categories UC where HP.user_id = U.id AND HP.game_id = :gid AND UC.id = U.profession  order by name asc";
	$run = $dbh->prepare($sql);

	$run->bindParam(':gid', $gid, PDO::PARAM_INT);
	$run->execute();

	if ($run->rowCount() > 0) {
		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			$fetch['contacts'][] = $row;
			$fetch['ERROR']['error_code'] = "200";
		}
	} else {
		$fetch['ERROR']['error_code'] = "204";
	}
	echo json_encode($fetch);
}