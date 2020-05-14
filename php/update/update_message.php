<?php

//Access: Authorized User & Admin
//Purpose: deactivates the message from one side but not delete from system

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['message_id']) && isset($_POST['current_category']) 
 && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $mid = filter_var($_POST['message_id'], FILTER_SANITIZE_NUMBER_INT);
        $uid = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $cid = filter_var($_POST['current_category'], FILTER_SANITIZE_NUMBER_INT);
        $state = 1;
        $sql = "";
        if ($cid == 1) {
            $sql = "UPDATE message SET receiver_delete = :state WHERE id = :mid AND receiver_id = :uid";
        } elseif ($cid == 2) {
            $sql = "UPDATE message SET sender_delete = :state WHERE id = :mid AND sender_id = :uid";
        }
        $run = $dbh->prepare($sql);
        $run->bindParam(':state', $state, PDO::PARAM_INT);
        $run->bindParam(':mid', $mid, PDO::PARAM_INT);
        $run->bindParam(':uid', $uid, PDO::PARAM_INT);
        $run->execute();
        if ($run->rowCount() > 0) {
            echo $success;
        } else {
            echo $fail;
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
    }
}
?>

