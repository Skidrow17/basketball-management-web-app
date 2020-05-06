<?php

//Access: Admin
//Purpose: updates team information

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['team_name']) && isset($_POST['team_category2']) && isset($_POST['teams'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $name = filter_var($_POST['team_name'], FILTER_SANITIZE_STRING);
        $category = filter_var($_POST['team_category2'], FILTER_SANITIZE_NUMBER_INT);
        $id = filter_var($_POST['teams'], FILTER_SANITIZE_NUMBER_INT);
        $team_group = filter_var($_POST['team_group'], FILTER_SANITIZE_NUMBER_INT);

        $sql = "UPDATE team SET name=?,category=?,team_group = ? where id = ?";
        $run = $dbh->prepare($sql);
        echo $sql;
        $run->execute([$name, $category, $team_group, $id]);
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = $success;
            header('Location: ../../update_general_info.php?id=4');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../../update_general_info.php?id=4');
            die();
        }
    } else {
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../update_general_info.php?id=4');
    die();
}
?>

