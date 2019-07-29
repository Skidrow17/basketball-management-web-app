<?php
require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_POST['id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sql = "Select date_time from game where id=:gid";
        $run = $dbh->prepare($sql);
        $run->bindParam(':gid', $_POST['id'], PDO::PARAM_INT);
        $run->execute();
        $date = 0;
        $game_start_time = 0;
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            $splitTimeStamp = explode(" ", $row['date_time']);
            $date = $splitTimeStamp[0];
            $game_start_time = $splitTimeStamp[1];
        }
        $timestamp = strtotime($game_start_time) + 60 * 60 * 2;
        $game_end_time = date('H:m:s', $timestamp);
        $page = $_POST['current_page'] * 3;
        echo '<tr>
		  <th>Όνομα</th>
		  <th>Επίθετο</th>
		  <th>Ημερομηνία</th>
		  <th>Πλήθος Κωλυμάτων</th>
		  <th>Ώρα Έναρξης</th>
		  <th>Ώρα Λήξης</th>
		  <th></th>';
        $sql = "SELECT R.id ,U.name ,get_number_of_restrictions(U.id) as n_o_r,U.surname,R.time_to,R.time_from,R.date 
				FROM user U,restriction R , playable_categories PC 
				WHERE PC.user_id = U.id AND PC.team_categories_id = :categoryId AND U.id=R.user_id 
				AND R.time_to>:game_start_time AND R.time_from < :game_end_time AND R.date=:date order by n_o_r desc limit :page,3";
        $run = $dbh->prepare($sql);
        $run->bindParam(':game_start_time', $game_start_time, PDO::PARAM_STR);
        $run->bindParam(':game_end_time', $game_end_time, PDO::PARAM_STR);
        $run->bindParam(':date', $date, PDO::PARAM_STR);
        $run->bindParam(':page', $page, PDO::PARAM_INT);
        $run->bindParam(':categoryId', $_POST['categoryId'], PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>
			<td>' . $row['name'] . '</td>
			<td>' . $row['surname'] . '</td>
			<td>' . $row['date'] . '</td>
			<td>' . $row['n_o_r'] . '</td>
			<td>' . $row['time_from'] . '</td>
			<td>' . $row['time_to'] . '</td>
			<td><button value=' . $row['id'] . ' id="delete_btn" type="button" name="delete_btn" class="btn"><i class="fa fa-trash"></i></button></td>
			</tr>';
        }
    } else {
        session_destroy();
        echo 401;
    }
}
?>

