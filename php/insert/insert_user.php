<?php

//Access: Admin
//Purpose: import new user on the system

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if ( isset($_SESSION['safe_key']) && isset($_SESSION['user_id']) && isset($_SESSION['profession'])){
    
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin'){
        
        $user_check = "SELECT id FROM user WHERE username = :username";
        $run = $dbh->prepare($user_check);
        $run->bindParam(':username', $_POST['username'], PDO::PARAM_INT);
        $run->execute();
        
        if ($run->rowCount() > 0) {
            echo $username_in_user;
            return;
        }

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
					VALUES (:username, :password, :name, :surname, :email, :phone, :driving_licence, :living_place, :profession, :rate, :password_recovery)";
            $run = $dbh->prepare($sql);
            $run->bindParam(':username', $username, PDO::PARAM_STR);
            $run->bindParam(':password', $password, PDO::PARAM_STR);
            $run->bindParam(':name', $name, PDO::PARAM_STR);
            $run->bindParam(':surname', $surname, PDO::PARAM_STR); 
            $run->bindParam(':email', $email, PDO::PARAM_STR);
            $run->bindParam(':phone', $phone, PDO::PARAM_STR); 
            $run->bindParam(':driving_licence', $driving_licence, PDO::PARAM_INT);
            $run->bindParam(':living_place', $living_place, PDO::PARAM_INT);
            $run->bindParam(':profession', $profession, PDO::PARAM_INT);
            $run->bindParam(':rate', $rate, PDO::PARAM_INT);  
            $run->bindParam(':password_recovery', $password_recovery, PDO::PARAM_STR); 
            $run->execute();
            print_r($dbh->errorInfo());
        } else {
            $pic_name = $_FILES['profile_pic']['name'];
            $temp_name = $_FILES['profile_pic']['tmp_name'];
            $url_location = "assets/img/users/";
            if (isset($pic_name)) {
                if (!empty($pic_name)) {
                    $location = '../../assets/img/users/';
                }
            }
            $sql = "INSERT INTO `user`(`username`, `password`, `name`,`surname`,`email`,`phone`,`driving_licence`,`living_place`,`profile_pic`,`profession`,`rate`,`active`,`password_recovery_url`) 
					VALUES (:username, :password, :name, :surname, :email, :phone, :driving_licence, :living_place, :profile_pic, :profession, :rate, :active, :password_recovery_url)";
			$profile_img = $url_location . $pic_name;
            $run = $dbh->prepare($sql);
            $run->bindParam(':username', $username, PDO::PARAM_STR);
            $run->bindParam(':password', $password, PDO::PARAM_STR);
            $run->bindParam(':name', $name, PDO::PARAM_STR);
            $run->bindParam(':surname', $surname, PDO::PARAM_STR); 
            $run->bindParam(':email', $email, PDO::PARAM_STR);
            $run->bindParam(':phone', $phone, PDO::PARAM_STR); 
            $run->bindParam(':driving_licence', $driving_licence, PDO::PARAM_INT);
            $run->bindParam(':living_place', $living_place, PDO::PARAM_INT);
            $run->bindParam(':profile_pic', $profile_img, PDO::PARAM_STR);
            $run->bindParam(':profession', $profession, PDO::PARAM_INT);
            $run->bindParam(':rate', $rate, PDO::PARAM_INT);  
            $run->bindParam(':active', $active, PDO::PARAM_INT);  
            $run->bindParam(':password_recovery_url', $password_recovery, PDO::PARAM_STR); 
            $run->execute();
			
		}
        $sql = "select id from user order by id desc limit 1";
        $run1 = $dbh->prepare($sql);
        $run1->execute();
        $id = $run1->fetchColumn();
        if (!empty($playable_categories)) {
            for ($i = 0;$i < count($playable_categories);$i++) {
                $sql = "INSERT INTO `playable_categories`(`user_id`, `team_categories_id`) 
						VALUES (:user_id,:team_categories_id)";
                $run = $dbh->prepare($sql);
                $run->bindParam(':user_id', $id, PDO::PARAM_INT);
                $run->bindParam(':team_categories_id', $playable_categories[$i], PDO::PARAM_INT);
                $run->execute();
            }
        }
        if ($run->rowCount() > 0) {
            sent_mail($email,$username,$_POST['password']);
            echo $success;
        } else {
            echo $fail;
        }
    } else {
        session_destroy();
        echo $loggedInFromAnotherDevice;
    }
}