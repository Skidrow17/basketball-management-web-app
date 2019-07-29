<?php
require_once '../connect_db.php';
require '../useful_functions.php';
session_start();
if (isset($_POST['submit'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $match_id = filter_var($_POST['matches'], FILTER_SANITIZE_NUMBER_INT);
        $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
        $time = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
        $team_id_1 = filter_var($_POST['team1'], FILTER_SANITIZE_NUMBER_INT);
        $team_id_2 = filter_var($_POST['team2'], FILTER_SANITIZE_NUMBER_INT);
        $court_id = filter_var($_POST['court'], FILTER_SANITIZE_NUMBER_INT);
        $referee_num = filter_var($_POST['referee_num'], FILTER_SANITIZE_NUMBER_INT);
        $judge_num = filter_var($_POST['judge_num'], FILTER_SANITIZE_NUMBER_INT);
        $rate = filter_var($_POST['rate'], FILTER_SANITIZE_NUMBER_INT);
        $combinedDT = date('Y-m-d H:i:s', strtotime("$date $time"));
        $sql = "UPDATE game SET team_id_1=?,team_id_2=?,court_id=?,date_time=?,rate=?,required_referees=?,required_judges=? where id = ?";
        $run = $dbh->prepare($sql);
        $run->execute([$team_id_1, $team_id_2, $court_id, $combinedDT, $rate, $referee_num, $judge_num, $match_id]);
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = 'Ανανεώθηκε με επιτυχία';
            header('Location: ../../match_update.php');
            die();
        } else {
            $_SESSION['server_response'] = 'Δεν Ανανεώθηκε';
            header('Location: ../../match_update.php');
            die();
        }
    } else {
        $_SESSION['server_response'] = 'Login απο άλλη συσκευή';
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../match_update.php');
    die();
}
?>

