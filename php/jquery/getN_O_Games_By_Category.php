<?php

//Access: Admin
//Purpose: retrieves the number of matches by category of all users in the system
session_start();
require_once '../connect_db.php';
require '../useful_functions.php';

if(isset($_POST['cid'])){
    $cid = $_POST['cid'];
    $sql = "Select count(*) as n_o_r from game g,team T where g.team_id_1=T.id AND T.category=:cid AND yearweek(g.date_time,1) = yearweek(curdate(),1)";
    $run = $dbh->prepare($sql);
    $run->bindParam(':cid', $cid, PDO::PARAM_INT);
    $run->execute();
    while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
        echo $row['n_o_r'] / 4;
    }
}