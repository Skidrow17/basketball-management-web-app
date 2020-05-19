<?php

//Access: Authorized User
//Purpose: retrieves the number of total announcemets created from the user
session_start();
require_once '../connect_db.php';
require '../useful_functions.php';

if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $uid = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "Select count(*) as n_o_a from announcement where user_id=:uid";
        $run = $dbh->prepare($sql);
        $run->bindParam(':uid', $uid, PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo $row['n_o_a'];
        }
    } else {
        session_destroy();
		header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}