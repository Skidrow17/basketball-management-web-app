<?php

//Access: Admin
//Purpose: import new user on the system

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $driving_licence = filter_var($_POST['driving_licence'], FILTER_SANITIZE_NUMBER_INT);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $profession = filter_var($_POST['user_category'], FILTER_SANITIZE_NUMBER_INT);
        $rate = filter_var($_POST['rate'], FILTER_SANITIZE_NUMBER_INT);
        $living_place = filter_var($_POST['city'], FILTER_SANITIZE_NUMBER_INT);
        $profile_pic = $_FILES['profile_pic']['name'];
		$active = 0;
		$password_recovery = '';
        
		if(isset($_POST['playable_categories']))
			$playable_categories = $_POST['playable_categories'];
		else
			$playable_categories = [];

		
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        if (empty($profile_pic)) {
            $sql = "INSERT INTO `user`(`username`, `password`, `name`,`surname`,`email`,`phone`,`driving_licence`,`living_place`,`profession`,`rate`,`password_recovery_url`) 
					VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $run = $dbh->prepare($sql);
            $run->execute([$username, $password, $name, $surname, $email, $phone, $driving_licence, $living_place, $profession, $rate,$password_recovery]);
        } else {
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
            $sql = "INSERT INTO `user`(`username`, `password`, `name`,`surname`,`email`,`phone`,`driving_licence`,`living_place`,`profile_pic`,`profession`,`rate`,`active`,`password_recovery_url`) 
					VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
			
            $run = $dbh->prepare($sql);
            $run->execute([$username, $password, $name, $surname, $email, $phone, $driving_licence, $living_place, $url_location . $pic_name, $profession, $rate, $active ,$password_recovery]);
			
		}
        $sql = "select id from user order by id desc limit 1";
        $run1 = $dbh->prepare($sql);
        $run1->execute();
        $id = $run1->fetchColumn();
        if (!empty($playable_categories)) {
            for ($i = 0;$i < count($playable_categories);$i++) {
                $sql = "INSERT INTO `playable_categories`(`user_id`, `team_categories_id`) 
						VALUES (?,?)";
                $r = $dbh->prepare($sql);
                $r->execute([$id, $playable_categories[$i]]);
            }
        }
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = $success;
			sent_mail($email,$username,$_POST['password']);
            header('Location: ../../register.php');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
			header('Location: ../../register.php');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../register.php');
    die();
}