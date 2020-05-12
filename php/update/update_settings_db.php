<?php

//Access: Authorized User & Admin
//Purpose: updates settings like langueage and polling time

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['language']) && isset($_POST['pollingTime'])
	&& isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $language = filter_var($_POST['language'], FILTER_SANITIZE_STRING);
        $pollingTime = filter_var($_POST['pollingTime'], FILTER_SANITIZE_NUMBER_INT);
        $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $profile_pic = "";
        if(isset($_FILES['profile_pic'])){
            $profile_pic = $_FILES['profile_pic']['name'];
        }
        
        if (empty($profile_pic)) {
            $sql = "UPDATE user SET polling_time = ?,language = ? where id = ?";
            $run = $dbh->prepare($sql);
            $run->execute([$pollingTime, $language, $user_id]);
        }else{
            $pic_name = $_FILES['profile_pic']['name'];
            $temp_name = $_FILES['profile_pic']['tmp_name'];
            $url_location = "assets/img/users/";
            if (isset($pic_name)) {
                if (!empty($pic_name)) {
                    $location = '../../assets/img/users/';
                    if (move_uploaded_file($temp_name, $location . $pic_name)) {
                        echo 'File uploaded successfully';
                    }
                }
            } else {
                echo 'You should select a file to upload !!';
            }
            $sql = "UPDATE user SET polling_time = ?,language = ?,profile_pic = ? where id = ?";
            $run = $dbh->prepare($sql);
            $run->execute([$pollingTime, $language, $url_location.$pic_name, $user_id]);
        }

        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = $success;
            header('Location: ../login.php');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../login.php');
            die();
        }
    } else {
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
}
?>

