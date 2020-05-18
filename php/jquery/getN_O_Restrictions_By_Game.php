<?php

//Access: Admin
//Purpose: retrieves number of the restrictions by game

require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_POST['id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])){
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sql = "Select date_time from game where id=:gid";
        $run = $dbh->prepare($sql);
        $run->bindParam(':gid', $_POST['id'], PDO::PARAM_INT);
        $run->execute();
        $date = 0;
        $game_start_time = 0;
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            $splitTimeStamp = explode(" ", $row['date_time']);
            $date = $splitTimeStamp[0];
            $game_start_time = $splitTimeStamp[1];
        }
        $timestamp = strtotime($game_start_time) + 60 * 80;
        $game_end_time = date('H:m:s', $timestamp);
        $sql = "SELECT count(*) as n_o_r 
				FROM user U,restriction R , playable_categories PC where PC.user_id = U.id 
				AND PC.team_categories_id = :categoryId AND U.id=R.user_id AND R.time_to>:game_start_time 
				AND R.time_from < :game_end_time AND R.date=:date";
        $run = $dbh->prepare($sql);
        $run->bindParam(':game_start_time', $game_start_time, PDO::PARAM_STR);
        $run->bindParam(':game_end_time', $game_end_time, PDO::PARAM_STR);
        $run->bindParam(':date', $date, PDO::PARAM_STR);
        $run->bindParam(':categoryId', $_POST['categoryId'], PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo $row['n_o_r'] / 3;
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}
?>

