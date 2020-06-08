<?php

//Access: Everyone
//Purpose: shows the ranking of selected league

session_start();
require_once '../connect_db.php';
require_once '../select_boxes.php';
require_once '../useful_functions.php';
require_once('../language.php');

if(isset($_POST["cid"]) && isset($_POST["gid"])){
	$sql = "Select id,name,wins,loses,total_games,points from team where category =:cid AND team_group =:gid AND active = 0 order by points desc";
	$run = $dbh->prepare($sql);
	$run->bindParam(':cid', $_POST["cid"], PDO::PARAM_INT);
	$run->bindParam(':gid', $_POST["gid"], PDO::PARAM_INT);
	$run->execute();
	$counter = 0;

	echo'<tr>
		<th>'.$name.'</th>
		<th>'.$total_games.'</th>
		<th>'.$wins.'</th>
		<th>'.$loses.'</th>
		<th>'.$points.'</th>';
		
	while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr>";
		echo "<td onkeypress = 'return testCharacter(event);' data-maxlength = '3' id = 'team_id' style='display:none;'>" . $row['id'] . "</td>";
		echo "<td onkeypress = 'return testCharacter(event);' data-maxlength = '3' id = 'name' >" . $row['name'] . "</td>";
		echo "<td onkeypress = 'return testCharacter(event);' data-maxlength = '3' id = 'total_games'>" . $row['total_games'] . "</td>";
		echo "<td onkeypress = 'return testCharacter(event);' data-maxlength = '3' id = 'wins' contenteditable>" . $row['wins'] . "</td>";
		echo "<td onkeypress = 'return testCharacter(event);' data-maxlength = '3' id = 'loses' contenteditable>" . $row['loses'] . "</td>";
		echo "<td onkeypress = 'return testCharacter(event);' data-maxlength = '3' id = 'points' contenteditable>" . $row['points'] . "</td>";
		echo "</tr>";
	}
}