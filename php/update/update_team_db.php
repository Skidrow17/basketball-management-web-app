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
        $sql = "UPDATE team SET name=:name, category = :category, team_group = :team_group where id = :id";
        $run = $dbh->prepare($sql);
        $run->bindParam(':name', $name, PDO::PARAM_STR);
        $run->bindParam(':category', $category, PDO::PARAM_INT);       
        $run->bindParam(':team_group', $team_group, PDO::PARAM_INT);
        $run->bindParam(':id', $id, PDO::PARAM_INT);  
        $run->execute();
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
}