<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['title']) && isset($_POST['text']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
        $sql = "INSERT INTO `announcement`(`user_id`,`title`, `text`) VALUES (?,?,?)";
        $run = $dbh->prepare($sql);
        $run->execute([$user_id, $title, $text]);
        if ($run->rowCount() > 0) {
            if ($_SESSION['profession'] === 'Admin') {
                $_SESSION['server_response'] = $success;
                header('Location: ../../admin_announcements.php');
                die();
            } else {
                $_SESSION['server_response'] = $success;
                header('Location: ../../announcements.php');
                die();
            }
        } else {
            if ($_SESSION['profession'] === 'Admin') {
                $_SESSION['server_response'] = $fail;
                header('Location: ../../admin_announcements.php');
                die();
            } else {
                $_SESSION['server_response'] = $fail;
                header('Location: ../../announcements.php');
                die();
            }
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    if ($_SESSION['profession'] === 'Admin') {
        header('Location: ../../admin_announcements.php');
        die();
    } else {
        header('Location: ../../announcements.php');
        die();
    }
}