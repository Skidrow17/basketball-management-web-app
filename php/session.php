<?php
 
//Access: Authorized User
//Purpose: Starts session

session_start();

if (!isset($_SESSION['username'])) {
    if (isset($_COOKIE['uname']) == true && isset($_COOKIE['pwd']) == true) {
        header('location: ./php/login.php');
        die();
    } else {
        $_SESSION["server_response"] = 'Κάνε Login';
        header('location: ./index.php');
        die();
    }
} else {
    if ($_SESSION['profession'] === 'Admin') {
        $_SESSION["server_response"] = 'Μόνο για απλούς χρήστες';
        header('location: ./index.php');
        die();
    }
    if (isset($_COOKIE['uname']) == false) {
        $_SESSION["server_response"] = 'Time out';
        header('location: ./index.php');
        die();
    }
}
