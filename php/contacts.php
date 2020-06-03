<?php

//Access: Authorized User & Admin
//Purpose: display all contacts in the system

require_once 'connect_db.php';
if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $user_id = $_SESSION['user_id'];
        $sql2 = "SELECT id,name,surname FROM `user` WHERE active = 0 AND Id != :user_id order by surname";
        $run = $dbh->prepare($sql2);
        $run->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch()) {
            echo "<option class='dropdown-item' role='presentation' value=" . $row['id'] . " > " . $row['surname'] . " " . $row['name'] . "</option>";
        }
    } else {
        session_destroy();
    }
}
?>