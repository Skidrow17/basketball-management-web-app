<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $sql = "INSERT INTO `team_categories`(`name`) VALUES (?)";
        $run = $dbh->prepare($sql);
        $run->execute([$name]);
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = $success;
            header('Location: ../../add_general_info.php?id=2');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../../add_general_info.php?id=2');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../add_general_info.php?id=2');
    die();
}
?>

