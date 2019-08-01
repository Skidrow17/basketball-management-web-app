<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';

if (isset($_POST['current_page']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $page = $_POST['current_page'] * 7;
        $date = date('Y/m/d', time());
        $date = new DateTime($date);
        $current_week = $date->format("W");
        echo '<tr>
		  <th>Ημερομηνία</th>
		  <th>Ώρα Έναρξης</th>
		  <th>Ώρα Λήξης</th>
		  <th>Ώρα Καταχώρισης</th>
		  <th>Διαγραφή</th>
		  ';
        $sql = "Select R.id,R.time_to,R.time_from,R.date,R.register_timestamp from restriction R where R.user_id=:uid order by R.date desc limit :page,7";
        $run = $dbh->prepare($sql);
        $run->bindParam(':page', $page, PDO::PARAM_INT);
        $run->bindParam(':uid', $_SESSION['user_id'], PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>
			<td>' . $row['date'] . '</td>
			<td>' . $row['time_from'] . '</td>
			<td>' . $row['time_to'] . '</td>
			<td>' . $row['register_timestamp'] . '</td>';
            $date = new DateTime($row['date']);
            $restriction_date = $date->format("W");
            if ($restriction_date == $current_week) echo '<td><button value=' . $row['id'] . ' id="delete_btn" type="button" name="delete_btn" class="btn"><i class="fa fa-trash"></i></button></td>';
            else echo '<td><button value="-404" id="delete_btn" type="button" name="delete_btn" class="btn"><i class="fa fa-times-circle"></i></button></td>';
            echo '</tr>';
        }
    } else {
        session_destroy();
		echo 401;
    }
}
?>

