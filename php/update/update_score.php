<?php
require_once '../connect_db.php';
require '../useful_functions.php';
session_start();
if (isset($_POST['game_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $team_score_1 = filter_var($_POST['team_score_1'], FILTER_SANITIZE_NUMBER_INT);
        $team_score_2 = filter_var($_POST['team_score_2'], FILTER_SANITIZE_NUMBER_INT);
        $state = filter_var($_POST['state'], FILTER_SANITIZE_NUMBER_INT);
        $game_id = filter_var($_POST['game_id'], FILTER_SANITIZE_NUMBER_INT);
        $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "UPDATE game SET team_score_1=?, team_score_2=? , state=? WHERE  id=? AND id IN (SELECT HP.game_id from human_power HP where HP.user_id=?)";
        $run = $dbh->prepare($sql);
        $run->execute([$team_score_1, $team_score_2, $state, $game_id, $user_id]);
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = 'Το σκόρ ανανεώθηκε με επιτυχία';
            header('Location: ../../match.php');
            die();
        } else {
            $_SESSION['server_response'] = 'Το σκόρ δεν ανανεώθηκε';
            header('Location: ../../match.php');
            die();
        }
    } else {
        $_SESSION['server_response'] = 'Login απο άλλη συσκευή';
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../match.php');
    die();
}
?>

