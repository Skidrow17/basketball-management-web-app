<?php

//Access: Authorized User
//Purpose: button management of the user 

session_start();
require 'useful_functions.php';
require 'language.php';

if(isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])){
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        if ($_POST["button"] == 1) {
            header('Location:../announcements.php');
            die();
        } else if ($_POST["button"] == 2) {
            header('Location:../messages.php');
            die();
        } else if ($_POST["button"] == 5) {
            header('Location:../add_restriction.php');
            die();
        } else if ($_POST["button"] == 6) {
            header('Location:../match.php');
            die();
        } else if ($_POST["button"] == 7) {
            header('Location:../weekly_matches.php');
            die();
        }else {
            session_destroy();
            header('Location: ../index.php?server_response=Login απο άλλη συσκευή');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../index.php');
        die();
    }
}
?>