<?php

//Access: Authorizes User & Admin
//Purpose: imports new announcement + sent notification

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['title']) && isset($_POST['text']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
        $sql = "INSERT INTO `announcement`(`user_id`,`title`, `text`) VALUES (:user_id, :title, :text)";
        $run = $dbh->prepare($sql);
        $run->bindParam(':user_id',$user_id,PDO::PARAM_INT);
        $run->bindParam(':title',$title,PDO::PARAM_STR);
        $run->bindParam(':text',$text,PDO::PARAM_STR);
        $run->execute();


        $sql = "SELECT mobile_token,active FROM user WHERE id != :sender_id";
        $result = $dbh->prepare($sql);
        $result->bindParam(':sender_id', $user_id, PDO::PARAM_INT);
        $result->execute();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if(strlen($row["mobile_token"]) == 152 && $row['active'] == 0){
                sentPushNotification($title."/"."0",$row['mobile_token'],$text);
            }
        }

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
}