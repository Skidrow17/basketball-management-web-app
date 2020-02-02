<?php

require_once 'connect_db.php';

$json_array = array();

$sql = "SELECT DISTINCT C.id as categoryId, C.name as categoryName, G.id as groupId, G.name as groupName FROM team_categories C,team_groups G,team T WHERE C.Id = T.category AND G.Id = T.team_group AND T.active = 0 ORDER BY C.id ASC,G.id ASC";
$run = $dbh->prepare($sql);
$run->execute();

if ($run->rowCount() > 0) {
	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		$fetch['Category_Group'][] = $row;
		$fetch['ERROR']['error_code'] = "200";
	}
} else {
	$fetch['ERROR']['error_code'] = "204";
}
echo json_encode($fetch);