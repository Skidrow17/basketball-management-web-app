<?php

//Access: Admin
//Purpose: deletes match

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['match_id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $id = filter_var($_POST['match_id'], FILTER_SANITIZE_NUMBER_INT);

        $sql = 'DELETE FROM human_power WHERE game_id = :id';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $sql = "DELETE FROM game WHERE id = :id";
        $run = $dbh->prepare($sql);
        $run->bindParam(':id', $id, PDO::PARAM_INT);
        $run->execute();

        if ($run->rowCount() > 0) {
            echo $deleteSuccessful;
        } else {
            echo $deleteUnsuccessful;
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}