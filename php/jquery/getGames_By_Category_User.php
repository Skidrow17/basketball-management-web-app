<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../select_boxes.php';
require_once '../language.php';

if (isset($_POST['current_page']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $page = $_POST['current_page'] * 4;
		echo '<tr>
		<th>'; echo $team; echo' 1</th>
		<th>'; echo $team; echo' 2</th>
		<th>'; echo $score; echo' 1</th>
		<th>'; echo $score; echo' 2</th>
		<th>'; echo $date; echo'</th>
		<th>'; echo $location; echo'</th>
		<th>'; echo $referees; echo'</th>
		<th>'; echo $judges; echo'</th>
		';
        $sql = "SELECT distinct
				home.name AS team_id_1, 
				away.name AS team_id_2,r.id,r.team_score_1,r.team_score_2,r.date_time,ci.name as city,c.latitude,c.longitude
				FROM 
				game AS r
				JOIN team AS home 
				ON r.team_id_1 = home.id
				JOIN team AS away 
				ON r.team_id_2 = away.id , court c , team t,city ci,human_power hp 
				WHERE r.id=hp.game_id AND hp.user_id=:uid 
				AND c.city=ci.id AND r.team_id_1=t.id AND t.category=:id And C.id=r.court_id order by id desc limit :cp,4 ";
        $run = $dbh->prepare($sql);
        $run->bindParam(':id', $_POST['cid'], PDO::PARAM_INT);
        $run->bindParam(':uid', $_SESSION['user_id'], PDO::PARAM_INT);
        $run->bindParam(':cp', $page, PDO::PARAM_INT);
        $run->execute();
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>
			<td>' . $row['team_id_1'] . '</td>
			<td>' . $row['team_id_2'] . '</td>
			<td>' . $row['team_score_1'] . '</td>
			<td>' . $row['team_score_2'] . '</td>
			<td>' . $row['date_time'] . '</td>
			<td>' . $row['city'] . '</td>
			<td>';
            echo getHuman_Power_By_Game($row['id'], 2);
            echo '</td>
			<td>';
            echo getHuman_Power_By_Game($row['id'], 3);
            echo '</td>
			</tr>';
        }
    } else {
        session_destroy();
		header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
    }
}
?>

