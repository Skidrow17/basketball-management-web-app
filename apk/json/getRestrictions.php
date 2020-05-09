<?php

//Access: Authorized User
//Purpose: gets all restrictions with the ability to delete

require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);		
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		$sql = "Select R.id,R.time_to,R.time_from,R.date from restriction R where R.user_id=:uid AND R.deletable = 0 order by R.date desc";
		$run = $dbh->prepare($sql);
		$run->bindParam(':uid', $id, PDO::PARAM_INT);
		$run->execute();

		if ($run->rowCount() > 0) {
			while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
				$fetch['Received_Messages'][] = $row;
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