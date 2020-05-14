<?php

//Access: Admin
//Purpose: import team on the system

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $team_category = filter_var($_POST['team_category'], FILTER_SANITIZE_NUMBER_INT);
        $team_group = filter_var($_POST['team_group'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "INSERT INTO `team`(`name`, `category` , `team_group`) VALUES (:name, :team_category, :team_group)";
        $run = $dbh->prepare($sql);
        $run->bindParam(':name', $name, PDO::PARAM_STR);
        $run->bindParam(':team_category', $team_category, PDO::PARAM_INT);
        $run->bindParam(':team_group', $team_group, PDO::PARAM_INT);
        $run->execute();
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = $success;
            header('Location: ../../add_general_info.php?id=4');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../../add_general_info.php?id=4');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
    }
} else {
    header('Location: ../../add_general_info.php?id=4');
    die();
}