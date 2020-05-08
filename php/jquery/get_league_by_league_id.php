<?php

//Access: Authorized User & Admin
//Purpose: shows the ranking of selected league

session_start();
require_once '../connect_db.php';
require_once '../select_boxes.php';
require_once '../useful_functions.php';
require_once('../language.php');

if (isset($_POST['cid']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
		echo $_POST["gid"];
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
			echo "<td id = 'team_id' style='display:none;'>" . $row['id'] . "</td>";
			echo "<td id = 'name' >" . $row['name'] . "</td>";
			echo "<td id = 'total_games' contenteditable>" . $row['total_games'] . "</td>";
			echo "<td id = 'wins' contenteditable>" . $row['wins'] . "</td>";
			echo "<td id = 'loses' contenteditable>" . $row['loses'] . "</td>";
			echo "<td id = 'points' contenteditable>" . $row['points'] . "</td>";
			echo "</tr>";
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
    }
}
?>