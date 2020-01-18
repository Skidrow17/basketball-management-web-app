<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $team1 = filter_var($_POST['team1'], FILTER_SANITIZE_STRING);
        $team2 = filter_var($_POST['team2'], FILTER_SANITIZE_STRING);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
        $time = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
        $court = filter_var($_POST['court'], FILTER_SANITIZE_NUMBER_INT);
        $rate = filter_var($_POST['rate'], FILTER_SANITIZE_NUMBER_INT);
        $referee_num = filter_var($_POST['referee_num'], FILTER_SANITIZE_NUMBER_INT);
        $judge_num = filter_var($_POST['judge_num'], FILTER_SANITIZE_NUMBER_INT);
        $team_category = filter_var($_POST['team_category'], FILTER_SANITIZE_NUMBER_INT);
        $dateTime = $date . ' ' . $time;
        if ($team1 != $team2) {
            $sql = "INSERT INTO `game`(`team_id_1`, `team_id_2`,`court_id`,`date_time`,`rate`,`required_referees`,`required_judges`) VALUES 
					(?,?,?,?,?,?,?)";
            $run = $dbh->prepare($sql);
            $run->execute([$team1, $team2, $court, $dateTime, $rate, $referee_num, $judge_num]);
            if ($run->rowCount() > 0) {
                $_SESSION['server_response'] = $success;
                header('Location: ../../add_match.php');
                die();
            } else {
                $_SESSION['server_response'] = $fail;
                header('Location: ../../add_match.php');
                die();
            }
        } else {
            $_SESSION['server_response'] = $chooseSameTeam;
            header('Location: ../../add_match.php');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../add_match.php');
    die();
}