<?php

require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {

		$sql = "SELECT U.id,U.name,U.surname,U.profile_pic,UC.name as profession from user U,human_power HP,user_categories UC where HP.user_id = U.id AND HP.game_id = :gid AND UC.id = U.profession  order by name asc";
		$run = $dbh->prepare($sql);

		$run->bindParam(':gid', $_GET['gid'], PDO::PARAM_INT);
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
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}