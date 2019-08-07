<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sender_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $receiver_id = filter_var($_POST["receiver_id"], FILTER_SANITIZE_NUMBER_INT);
        $text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
        $sql = "INSERT INTO `message`(`sender_id`, `receiver_id`, `text_message`) VALUES 
				(?,?,?)";
        $run = $dbh->prepare($sql);
        $run->execute([$sender_id, $receiver_id, $text]);
        if ($run->rowCount() > 0) {
            if ($_SESSION['profession'] === 'Admin') {
                $_SESSION['server_response'] = $success;
                header('Location: ../../admin_messages.php');
                die();
            } else {
                $_SESSION['server_response'] = $success;
                header('Location: ../../messages.php');
                die();
            }
        } else {
            if ($_SESSION['profession'] === 'Admin') {
                $_SESSION['server_response'] = $fail;
                header('Location: ../../admin_messages.php');
                die();
            } else {
                $_SESSION['server_response'] = $fail;
                header('Location: ../../messages.php');
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
        header('Location: ../../admin_messages.php');
        die();
    } else {
        header('Location: ../../messages.php');
        die();
    }
}
?>

