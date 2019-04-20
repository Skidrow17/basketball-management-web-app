<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();


if(isset($_POST['id']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true&&$_SESSION['profession']==='Admin')
{
	
	
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
	$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	$phone=filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
	$driving_licence=filter_var($_POST['driving_licence'], FILTER_SANITIZE_NUMBER_INT);
	$phone=filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
	$id=filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$profession=filter_var($_POST['user_category'], FILTER_SANITIZE_NUMBER_INT);
	$active=filter_var($_POST['state'], FILTER_SANITIZE_NUMBER_INT);
	$rate=filter_var($_POST['rate'], FILTER_SANITIZE_NUMBER_INT);
	$living_place=filter_var($_POST['living_place'], FILTER_SANITIZE_NUMBER_INT);
	$profile_pic=$_FILES['profile_pic']['name'];
	$run=0;
	

	$playable_categories = $_POST['playable_categories'];


		
	if(empty($profile_pic))	
	{
		if($password!=='')
		{
			$hashed_pass =  password_hash($password, PASSWORD_DEFAULT);
			$sql="UPDATE user SET username=?, password=? , name=? , surname=?,email=?,phone=?,driving_licence=?,profession=?,active=?,rate=?,living_place=? where id = ?";	
			$run =$dbh->prepare($sql);
			$run->execute([$username,$hashed_pass,$name,$surname,$email,$phone,$driving_licence,$profession,$active,$rate,$living_place,$id]);
		}
		else
		{
			$sql="UPDATE user SET username=?, name=? , surname=?,email=?,phone=?,driving_licence=?,profession=?,active=?,rate=?,living_place=? where id = ?";	
			$run =$dbh->prepare($sql);
			$run->execute([$username,$name,$surname,$email,$phone,$driving_licence,$profession,$active,$rate,$living_place,$id]);
		}
	}
	else
	{
		
	
    $pic_name   = $_FILES['profile_pic']['name'];  
    $temp_name  = $_FILES['profile_pic']['tmp_name'];  
	$url_location="assets/img/users/";
    if(isset($pic_name)){
        if(!empty($pic_name)){      
            $location = '../../assets/img/users/';      
            if(move_uploaded_file($temp_name, $location.$pic_name)){
                echo 'File uploaded successfully';
            }
        }       
    }  else {
        echo 'You should select a file to upload !!';
    }


		if($password!=='')
		{
			$hashed_pass =  password_hash($password, PASSWORD_DEFAULT);
			$sql="UPDATE user SET profile_pic=?, username=?, password=? , name=? , surname=?,email=?,phone=?,driving_licence=?,profession=?,active=?,rate=?,living_place=? where id = ?";	
			$run =$dbh->prepare($sql);
			$run->execute([$url_location.$pic_name,$username,$hashed_pass,$name,$surname,$email,$phone,$driving_licence,$profession,$active,$rate,$living_place,$id]);
		}
		else
		{
			$sql="UPDATE user SET  profile_pic=?, username=?, name=? , surname=?,email=?,phone=?,driving_licence=?,profession=?,active=?,rate=?,living_place=? where id = ?";	
			$run =$dbh->prepare($sql);
			$run->execute([$url_location.$pic_name,$username,$name,$surname,$email,$phone,$driving_licence,$profession,$active,$rate,$living_place,$id]);
		}

	}
	
	
	
	
	
	
	
	$flag=0;
	// Katigories pou borei na pexei
    if(!empty($playable_categories)) 
    {
		
	$sql = "DELETE FROM playable_categories WHERE user_id =:id";
    $stmt = $dbh->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);   
	$stmt->execute();
	$flag=1;

	
    for($i=0; $i < count($playable_categories); $i++)
    {
  
	$sql="INSERT INTO `playable_categories`(`user_id`, `team_categories_id`) VALUES (?,?)";
	$r = $dbh->prepare($sql);
	$r->execute([$id,$playable_categories[$i]]);
	
	}
    }
	
	
	
	if($run->rowCount()>0 || $flag==1)
	{
		$_SESSION['server_response']='Ανανεώθηκε με επιτυχία';
		header('Location: ../../user_update.php');
		die();
	}
	else
	{
		$_SESSION['server_response']='Δεν Ανανεώθηκε';
		header('Location: ../../user_update.php');
		die();
	}
	
	
}
else
{
	    session_destroy();
		$_SESSION['server_response']='Login απο άλλη συσκευή';
		header('Location: ../../index.php');
		die();
}
}
else
{
	header('Location: ../../user_update.php');
	die();
}



?>

