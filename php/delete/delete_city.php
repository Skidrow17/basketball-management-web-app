<?php

//Access: Admin
//Purpose: deletes the city

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['city_id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $id = filter_var($_POST['city_id'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "UPDATE city SET active=1 where id = :id";
        $run = $dbh->prepare($sql);
        $run->bindParam(':id', $id, PDO::PARAM_INT);
        $run->execute();
        if ($run->rowCount() > 0) {
            if ($id !== "") $_SESSION['server_response'] = $deleteSuccessful;
            else $_SESSION['server_response'] = $chooseCity;
        } else {
            $_SESSION['server_response'] = $deleteUnsuccessful;
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
    }
}