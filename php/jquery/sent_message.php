<?php

//Access: Authorized User & Admin
//Purpose: sent message between the users

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

echo $_POST['receiver_id']. ' ' .$_POST['text'];

if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sender_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $receiver_id = filter_var($_POST["receiver_id"], FILTER_SANITIZE_NUMBER_INT);
        $text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
        $sql = "INSERT INTO `message`(`sender_id`, `receiver_id`, `text_message`) VALUES (:sender_id, :receiver_id, :text)";
        $run = $dbh->prepare($sql);
        $run->bindParam(':sender_id', $sender_id, PDO::PARAM_INT);
        $run->bindParam(':receiver_id', $receiver_id, PDO::PARAM_INT);
        $run->bindParam(':text', $text, PDO::PARAM_STR);
        $run->execute();

        $sql = "SELECT id,name,surname,mobile_token FROM user WHERE id IN (:receiver_id,:sender_id)";
        $result = $dbh->prepare($sql);
        $result->bindParam(':receiver_id', $receiver_id, PDO::PARAM_INT);
        $result->bindParam(':sender_id', $sender_id, PDO::PARAM_INT);
        $result->execute();
        $sender_name = "";
        $receiver_token = "";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if($row["id"] == $sender_id){
                $sender_name = $row["name"]." ".$row["surname"];
            }else{
                $receiver_token = $row["mobile_token"];
            }
        }
        sentPushNotification($sender_name."/".$sender_id,$receiver_token,$text);
    }
}