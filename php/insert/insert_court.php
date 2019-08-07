<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $longitude = filter_var($_POST['longitude'], FILTER_SANITIZE_STRING);
        $latitude = filter_var($_POST['latitude'], FILTER_SANITIZE_STRING);
        $city = filter_var($_POST['city'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "INSERT INTO `court`(`name`, `longitude`, `latitude`,`city`) VALUES 
				(?,?,?,?)";
        $run = $dbh->prepare($sql);
        $run->execute([$name, $longitude, $latitude, $city]);
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = $success;
            header('Location: ../../court.php');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../../court.php');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
    }
} else {
    header('Location: ../../court.php');
    die();
}
?>

