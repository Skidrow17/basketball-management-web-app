<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $counter = 0;
        $id = filter_var($_POST['matches'], FILTER_SANITIZE_NUMBER_INT);
        $human_power = $_POST['human_power'];
        if (!empty($human_power)) {
            for ($i = 0;$i < count($human_power);$i++) {
                $sql = "INSERT INTO `human_power`(`game_id`, `user_id`) VALUES (?,?)";
                $r = $dbh->prepare($sql);
                $r->execute([$id, $human_power[$i]]);
                if ($r->rowCount() > 0) $counter = $counter + 1;
            }
			
			$sql = "Select date_time from game where id=:gid";
			$run = $dbh->prepare($sql);
			$run->bindParam(':gid',$id, PDO::PARAM_INT);
			$run->execute();
			$date = '';
			while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
				$datefromdb = strtotime($row["date_time"]);
				$date = date('Y/m/d', $datefromdb);
			}
			$match_week = date("W", strtotime($date));
			$match_year = date("Y", strtotime($date));
			$sql = "UPDATE restriction SET deletable = 1 WHERE WEEK(date,1)=? AND YEAR(date)=?";
			$stmt = $dbh->prepare($sql);
			$stmt->execute([$match_week, $match_year]);
        }
        if ($counter > 0) {
            $_SESSION['server_response'] = $success;
            header('Location: ../../match_referee.php');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../../match_referee.php');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../match_referee.php');
    die();
}