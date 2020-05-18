<?php

//Access: Admin
//Purpose: update teams category

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['team_category_name']) && isset($_POST['team_category'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $name = filter_var($_POST['team_category_name'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['team_category'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "UPDATE team_categories SET name = :name where id = :id";
        $run = $dbh->prepare($sql);
        $run->bindParam(':name', $name, PDO::PARAM_STR);
        $run->bindParam(':id', $id, PDO::PARAM_INT);
        $run->execute();
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = $success;
            header('Location: ../../update_general_info.php?id=2');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../../update_general_info.php?id=2');
            die();
        }
    } else {
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../update_general_info.php?id=2');
    die();
}
?>