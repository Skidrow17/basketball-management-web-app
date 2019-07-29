<?php

require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if (security_check($_GET['safe_key'], $_GET['id']) == true) {
	$sql = "Select R.id,R.time_to,R.time_from,R.date from restriction R where R.user_id=:uid AND R.deletable=0 order by R.date desc";
	$run = $dbh->prepare($sql);
	$run->bindParam(':uid', $_GET['id'], PDO::PARAM_INT);
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