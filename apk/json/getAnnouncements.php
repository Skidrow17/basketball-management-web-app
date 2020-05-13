<?php

//Access: Authorized User & Admin
//Purpose: gets all announcements

require_once '../../php/connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		$sql = "SELECT A.id,A.title,A.text,DATE_FORMAT(A.date_time, '%d/%m/%Y %H:%i') as date_time,U.name,U.surname from announcement A,user U where U.id=A.user_id order by A.date_time desc";
		$run = $dbh->prepare($sql);
		$run->execute();

		if ($run->rowCount() > 0) {
			while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
				$fetch['announcements'][] = $row;
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