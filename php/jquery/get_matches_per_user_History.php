<?php

//Access: Admin
//Purpose: Retrieves all logic history of all users in the system

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['current_page']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $page = $_POST['current_page'] * 7;
        $sql = "SELECT u.name AS user_name,u.surname,home.name as home_team,away.name as away_team,g.date_time,team_score_1,team_score_2,c.name AS court_name FROM user u,human_power hp,court c,game g JOIN team AS home ON g.team_id_1 = home.id JOIN team AS away ON g.team_id_2 = away.id where hp.game_id = g.id and hp.user_id = u.id and g.court_id = c.id and g.date_time > :date_from ORDER BY g.date_time desc limit :page,7";
        $run = $dbh->prepare($sql);
        $run->bindParam(':page', $page, PDO::PARAM_INT);
        $run->bindParam(':date_from',$_POST['date_from'],PDO::PARAM_STR);
        $run->execute();
		echo "<table id='here'>";
		echo'<tr>
			<th>';echo $name; echo'</th>
			<th>';echo $surname; echo'</th>
            <th>';echo $team.' 1'; echo'</th>
            <th>';echo $team.' 2'; echo'</th>
            <th>';echo $date; echo'</th>
            <th>';echo $score.' 1'; echo'</th>
            <th>';echo $score.' 2'; echo'</th>
            <th>';echo $court; echo'</th>
           </tr>';			
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['user_name'] . "</td>";
            echo "<td>" . $row['surname'] . "</td>";
            echo "<td>" . $row['home_team'] . "</td>";
            echo "<td>" . $row['away_team'] . "</td>";
            echo "<td>" . $row['date_time'] . "</td>";
            echo "<td>" . $row['team_score_1'] . "</td>";
            echo "<td>" . $row['team_score_2'] . "</td>";
            echo "<td>" . $row['court_name'] . "</td>";
            echo "</tr>";
        }
		echo "</table>";
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}
?>

