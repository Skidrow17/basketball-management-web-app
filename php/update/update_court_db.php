<?php

//Access: Admin
//Purpose: updates already imported court

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $latitude = filter_var($_POST['latitude'], FILTER_SANITIZE_STRING);
        $longitude = filter_var($_POST['longitude'], FILTER_SANITIZE_STRING);
        $location = filter_var($_POST['living_place'], FILTER_SANITIZE_NUMBER_INT);
        $id = filter_var($_POST['court'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "UPDATE court SET name = :name, longitude = :longitude, latitude = :latitude, city = :location where id = :id";
        $run = $dbh->prepare($sql);
        $run->bindParam(':name', $name, PDO::PARAM_STR);
        $run->bindParam(':longitude', $longitude, PDO::PARAM_STR);
        $run->bindParam(':latitude', $latitude, PDO::PARAM_STR);
        $run->bindParam(':location', $location, PDO::PARAM_INT);
        $run->bindParam(':id', $id, PDO::PARAM_INT);
        $run->execute();
        echo $location;
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = $success;
            header('Location: ../../court_update.php');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../../court_update.php');
            die();
        }
    } else {
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../court_update.php');
    die();
}
?>