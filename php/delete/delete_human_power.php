<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['game_id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $game_id = filter_var($_POST['game_id'], FILTER_SANITIZE_NUMBER_INT);
        $sql = 'DELETE FROM human_power WHERE user_id = :uid and game_id=:gid';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':uid', $id, PDO::PARAM_INT);
        $stmt->bindValue(':gid', $game_id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo $deleteSuccessful;
        } else {
            echo $deleteUnsuccessful;
        }
    } else {
        session_destroy();
		echo 401;
    }
}