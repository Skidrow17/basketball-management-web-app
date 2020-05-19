<?php

//Access: Authorizes User & Admin
//Purpose: updates score of assigned 

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['game_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $team_score_1 = filter_var($_POST['team_score_1'], FILTER_SANITIZE_NUMBER_INT);
        $team_score_2 = filter_var($_POST['team_score_2'], FILTER_SANITIZE_NUMBER_INT);
        $state = filter_var($_POST['state'], FILTER_SANITIZE_NUMBER_INT);
        $game_id = filter_var($_POST['game_id'], FILTER_SANITIZE_NUMBER_INT);
        $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "UPDATE game SET team_score_1 = :team_score_1, team_score_2 = :team_score_2 , state = :state WHERE id=:game_id AND id IN (SELECT HP.game_id from human_power HP where HP.user_id = :user_id)";
        $run = $dbh->prepare($sql);
        $run->bindParam(':team_score_1', $team_score_1, PDO::PARAM_INT);
        $run->bindParam(':team_score_2', $team_score_2, PDO::PARAM_INT);
        $run->bindParam(':state', $state, PDO::PARAM_INT);
        $run->bindParam(':game_id', $game_id, PDO::PARAM_INT);
        $run->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $run->execute();
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = $success;
            header('Location: ../../match.php');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../../match.php');
            die();
        }
    } else {
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
}