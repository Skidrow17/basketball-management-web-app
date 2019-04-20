<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();


if(isset($_POST['submit']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true && $_SESSION['profession']==='Admin')
{
	
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$team_category=filter_var($_POST['team_category'], FILTER_SANITIZE_NUMBER_INT);
	
	
	$sql="INSERT INTO `team`(`name`, `category`) VALUES 
	(?,?)";
	$run = $dbh->prepare($sql);
	$run ->execute([$name,$team_category]);
	
	if( $run->rowCount()>0)
	{
		$_SESSION['server_response']='Eπιτυχία';
		header('Location: ../../add_general_info.php?id=4');
		die();
	}
	else
	{   
		$_SESSION['server_response']='Αποτυχία';
		header('Location: ../../add_general_info.php?id=4');
		die();
	}
	
}
else
{
	session_destroy();
	$_SESSION['server_response']='Login απο άλλη συσκευή';
	header('Location: ../../index.php');
}
}
else
{	
	header('Location: ../../add_general_info.php?id=4');
	die();
}


?>

