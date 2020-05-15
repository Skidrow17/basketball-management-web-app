<?php

//Access: Everyone
//Purpose: Retrieves all match categories

require_once '../../php/connect_db.php';

$json_array = array();

$sql = "SELECT * FROM team_categories WHERE active = 0";

$run = $dbh->prepare($sql);
$run->execute();
$fetch = array();
if ($run->rowCount() > 0) {
	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		$fetch['Categories'][] = $row;
		$fetch['ERROR']['error_code'] = "200";
	}
} else {
	$fetch['ERROR']['error_code'] = "204";
}

echo json_encode($fetch);