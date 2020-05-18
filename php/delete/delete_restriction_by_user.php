<?php

//Access: Authorizes User
//Purpose: Deletes the restrictions imported from user

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['restriction_id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $id = filter_var($_POST['restriction_id'], FILTER_SANITIZE_NUMBER_INT);
        $uid = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $sql = 'DELETE FROM restriction WHERE id = :id and user_id=:uid';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':uid', $uid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo $deleteSuccessful;
        } else {
            echo $deleteUnsuccessful;
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}
?>

