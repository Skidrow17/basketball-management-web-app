<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();


if(isset($_POST['message'])&&isset($_POST['title'])&&isset($_POST['aid']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
	
	
	$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
	$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
	$id=filter_var($_POST['aid'], FILTER_SANITIZE_NUMBER_INT);
	$sql="UPDATE announcement SET title=?,text=? where id = ? AND user_id=?";	
	$run =$dbh->prepare($sql);
	$run->execute([$title,$message,$id,$_SESSION['user_id']]);

	if($run->rowCount()>0)
	{
		echo "Eπιτυχία Τροποποίησης";
	}
	else
	{
		echo "Αποτυχία Τροποποίησης";
	}
		
}
else
{
	$_SESSION['server_response']='Login απο άλλη συσκευή';
	header('Location: ../../index.php');
	die();
}
}
else
{
	if($_SESSION['profession']==='Admin')
	{
	header('Location: ../../admin_announcements.php');
	die();
	}
	else
	{
	header('Location: ../../announcements.php');
	die();	
	}
}


?>

