<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['message']) && isset($_POST['title']) && isset($_POST['aid'])
&& isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['aid'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "UPDATE announcement SET title=?,text=? where id = ? AND user_id=?";
        $run = $dbh->prepare($sql);
        $run->execute([$title, $message, $id, $_SESSION['user_id']]);
        if ($run->rowCount() > 0) {
            echo $success;
        } else {
            echo $fail;
        }
    } else {
        session_destroy();
		echo 401;
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
?>

