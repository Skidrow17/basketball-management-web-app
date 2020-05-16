<?php

//Access: Authorized User & Admin
//Purpose: retrives all the contacts

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){

	$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);		

	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		update_last_seen_time($_GET['id']);
		$sql = "SELECT DATE_FORMAT(get_last_login_by_user(U.id), '%d/%m/%Y %H:%i') as last_login,UC.name as profession,U.id,U.name,U.surname,U.profile_pic,U.phone from user U,user_categories UC where U.id!=:id AND UC.id = U.profession AND U.active = 0 order by name asc";
		$run = $dbh->prepare($sql);
		$run->bindParam(':id', $id, PDO::PARAM_INT);
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