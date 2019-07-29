<?php
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../select_boxes.php';
session_start();
if (isset($_POST['game_id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sql = "SELECT * 
				FROM game 
				WHERE id = :tid";
        $run = $dbh->prepare($sql);
        $run->bindParam(':tid', $_POST['game_id'], PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            $splitTimeStamp = explode(" ", $row['date_time']);
            $date = $splitTimeStamp[0];
            $time = $splitTimeStamp[1];
            echo '
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">Ομάδα 1</small><select id="team1" name="team1" class="form-control" required>';
            echo getTeamById($row['team_id_1'], $_POST['category_id']);
            echo '</select></div>
                <div class="col"><small class="form-text text-muted">Ομάδα 2</small><select id="team2" name="team2" class="form-control" required>';
            echo getTeamById($row['team_id_2'], $_POST['category_id']);
            echo '</select></div>
           </div>
			<div class="form-row">
				<div class="col"><small class="form-text text-muted">Ημερομηνία&nbsp;</small><input name="date" value=' . $date . ' class="form-control" type="date" required></div>
				<div class="col"><small class="form-text text-muted">Ώρα</small><input name="time" class="form-control" value=' . $time . ' type="time" required></div>
			</div>
			<div class="form-row">
				<div class="col"><small class="form-text text-muted">Πλήθος Διαιτητών</small><input name="referee_num" class="form-control" value=' . $row['required_referees'] . ' min="0" max="2" type="number" required></div>
				<div class="col"><small class="form-text text-muted">Πλήθος Κρητών<br></small><input name="judge_num" class="form-control" value=' . $row['required_judges'] . '  min="0" max="2" type="number" required></div>
			</div>
			<div class="form-row">
			<div class="col"><small class="form-text text-muted">Γήπεδο</small>';
            echo getCourt($row['court_id']);
            echo '</div>
			<div
            class="col"><small class="form-text text-muted">Επιπεδο Παιχνιδιού</small>';
            echo getRate($row['rate']);
            echo '</div>
			</div><button class="btn btn-primary btn-block" name="submit" type="submit" style="background-color:rgb(220,64,29);">Ανανέωση</button></form> ';
        }
    } else {
        session_destroy();
		echo 401;
    }
}
?>

