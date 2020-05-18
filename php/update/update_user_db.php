<?php

//Access: Admin
//Purpose: updates user information

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $driving_licence = filter_var($_POST['driving_licence'], FILTER_SANITIZE_NUMBER_INT);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $profession = filter_var($_POST['user_category'], FILTER_SANITIZE_NUMBER_INT);
        $active = filter_var($_POST['state'], FILTER_SANITIZE_NUMBER_INT);
        $rate = filter_var($_POST['rate'], FILTER_SANITIZE_NUMBER_INT);
        $living_place = filter_var($_POST['living_place'], FILTER_SANITIZE_NUMBER_INT);
        $profile_pic = $_FILES['profile_pic']['name'];
        $run = 0;
		
		if(isset($_POST['playable_categories']))
			$playable_categories = $_POST['playable_categories'];
		else
			$playable_categories = [];

			
        if (empty($profile_pic)) {
            if ($password !== '') {
                $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE user SET username=:username, password=:hashed_pass, name=:name, surname=:surname, email=:email, phone=:phone, driving_licence=:driving_licence, profession=:profession, active=:active, rate=:rate, living_place=:living_place where id = :id";
                $run = $dbh->prepare($sql);
                $run->bindParam(':username', $username, PDO::PARAM_STR);
                $run->bindParam(':hashed_pass', $hashed_pass, PDO::PARAM_STR);
                $run->bindParam(':name', $name, PDO::PARAM_STR);
                $run->bindParam(':surname', $surname, PDO::PARAM_STR); 
                $run->bindParam(':email', $email, PDO::PARAM_STR);
                $run->bindParam(':phone', $phone, PDO::PARAM_STR); 
                $run->bindParam(':driving_licence', $driving_licence, PDO::PARAM_INT);
                $run->bindParam(':profession', $profession, PDO::PARAM_INT); 
                $run->bindParam(':active', $active, PDO::PARAM_INT);
                $run->bindParam(':rate', $rate, PDO::PARAM_INT); 
                $run->bindParam(':living_place', $living_place, PDO::PARAM_INT);
                $run->bindParam(':id', $id, PDO::PARAM_INT); 
                $run->execute();
            } else {
                $sql = "UPDATE user SET username=:username, name=:name, surname=:surname, email=:email, phone=:phone, driving_licence=:driving_licence, profession=:profession, active=:active, rate=:rate, living_place=:living_place where id = :id";
                $run = $dbh->prepare($sql);
                $run->bindParam(':username', $username, PDO::PARAM_STR);
                $run->bindParam(':name', $name, PDO::PARAM_STR);
                $run->bindParam(':surname', $surname, PDO::PARAM_STR); 
                $run->bindParam(':email', $email, PDO::PARAM_STR);
                $run->bindParam(':phone', $phone, PDO::PARAM_STR); 
                $run->bindParam(':driving_licence', $driving_licence, PDO::PARAM_INT);
                $run->bindParam(':profession', $profession, PDO::PARAM_INT); 
                $run->bindParam(':active', $active, PDO::PARAM_INT);
                $run->bindParam(':rate', $rate, PDO::PARAM_INT); 
                $run->bindParam(':living_place', $living_place, PDO::PARAM_INT);
                $run->bindParam(':id', $id, PDO::PARAM_INT); 
                $run->execute();
            }
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
            $profile_img = $url_location . $pic_name;
            if ($password !== '') {
                $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE user SET profile_pic=:profile_pic, username=:username, password=:hashed_pass, name=:name, surname=:surname, email=:email, phone=:phone, driving_licence=:driving_licence, profession=:profession, active=:active, rate=:rate, living_place=:living_place where id = :id";
                $run = $dbh->prepare($sql);
                $run->bindParam(':profile_pic', $profile_img, PDO::PARAM_STR);
                $run->bindParam(':username', $username, PDO::PARAM_STR);
                $run->bindParam(':hashed_pass', $hashed_pass, PDO::PARAM_STR);
                $run->bindParam(':name', $name, PDO::PARAM_STR);
                $run->bindParam(':surname', $surname, PDO::PARAM_STR); 
                $run->bindParam(':email', $email, PDO::PARAM_STR);
                $run->bindParam(':phone', $phone, PDO::PARAM_STR); 
                $run->bindParam(':driving_licence', $driving_licence, PDO::PARAM_INT);
                $run->bindParam(':profession', $profession, PDO::PARAM_INT); 
                $run->bindParam(':active', $active, PDO::PARAM_INT);
                $run->bindParam(':rate', $rate, PDO::PARAM_INT); 
                $run->bindParam(':living_place', $living_place, PDO::PARAM_INT);
                $run->bindParam(':id', $id, PDO::PARAM_INT); 
                $run->execute();
            } else {
                $sql = "UPDATE user SET profile_pic=:profile_pic, username=:username, name=:name, surname=:surname, email=:email, phone=:phone, driving_licence=:driving_licence, profession=:profession, active=:active, rate=:rate, living_place=:living_place where id = :id";
                $run = $dbh->prepare($sql);
                $run->bindParam(':profile_pic', $profile_img, PDO::PARAM_STR);
                $run->bindParam(':username', $username, PDO::PARAM_STR);
                $run->bindParam(':name', $name, PDO::PARAM_STR);
                $run->bindParam(':surname', $surname, PDO::PARAM_STR); 
                $run->bindParam(':email', $email, PDO::PARAM_STR);
                $run->bindParam(':phone', $phone, PDO::PARAM_STR); 
                $run->bindParam(':driving_licence', $driving_licence, PDO::PARAM_INT);
                $run->bindParam(':profession', $profession, PDO::PARAM_INT); 
                $run->bindParam(':active', $active, PDO::PARAM_INT);
                $run->bindParam(':rate', $rate, PDO::PARAM_INT); 
                $run->bindParam(':living_place', $living_place, PDO::PARAM_INT);
                $run->bindParam(':id', $id, PDO::PARAM_INT); 
                $run->execute();
            }
        }
        $flag = 0;
        // Katigories pou borei na pexeis
        if (!empty($playable_categories)) {
            $sql = "DELETE FROM playable_categories WHERE user_id =:id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $flag = 1;
            for ($i = 0;$i < count($playable_categories);$i++) {
                $sql = "INSERT INTO `playable_categories`(`user_id`, `team_categories_id`) VALUES (:id, :team_categories_id)";
                $run = $dbh->prepare($sql);
                $run->bindParam(':id', $id, PDO::PARAM_INT);
                $run->bindParam(':team_categories_id', $playable_categories[$i], PDO::PARAM_INT);
                $run->execute();
            }
        }else {
			$sql = "DELETE FROM playable_categories WHERE user_id =:id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $flag = 1;
		}
		
        if ($run->rowCount() > 0 || $flag == 1) {
            $_SESSION['server_response'] = $success;
            header('Location: ../../user_update.php');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../../user_update.php');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../user_update.php');
    die();
}