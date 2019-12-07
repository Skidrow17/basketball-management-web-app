<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        if (strtotime($_POST["time_to"]) <= strtotime($_POST['time_from'])) header('Location: ../../add_restriction?server_response=Λανθασμένος Χρόνος');
        $newDate = str_replace("/", "-", $_POST['date']);
        $sql = "INSERT INTO `restriction`(`user_id`, `date`, `time_from` , `time_to` ) VALUES (:user_id,:date,:time_from,:time_to)";
        $run = $dbh->prepare($sql);
        $run->bindParam(':user_id', $_SESSION["user_id"], PDO::PARAM_INT);
        $run->bindParam(':date', $newDate, PDO::PARAM_STR);
        $run->bindParam(':time_from', $_POST["time_from"], PDO::PARAM_STR);
        $run->bindParam(':time_to', $_POST["time_to"], PDO::PARAM_STR);
        $run->execute();
        $_SESSION['server_response'] = $success;
        header('Location: ../../add_restriction.php');
        die();
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../add_restriction.php');
    die();
}