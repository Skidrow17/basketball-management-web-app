<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();


if(isset($_POST['message_id'])&&isset($_POST['current_category']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
	$mid = filter_var($_POST['message_id'], FILTER_SANITIZE_NUMBER_INT);
	$uid = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
	$cid = filter_var($_POST['current_category'], FILTER_SANITIZE_NUMBER_INT);
	$state=1;
	$sql="";
	
	if($cid==1)
	{
		$sql="UPDATE message SET receiver_delete=? WHERE id=? AND receiver_id=?";
	}
	elseif($cid==2)
	{
		$sql="UPDATE message SET sender_delete=? WHERE id=? AND sender_id=?";
	}
	
	$run =$dbh->prepare($sql);
	$run->execute([$state,$mid,$uid]);
	
	if($run->rowCount()>0)
	{
		echo "Επιτυχής Διαγραφή";
	}
	else
	{
		echo "Ανεπιτυχής Διαγραφή";
	}
	
	
}
else
{

		session_destroy();
		header('Location: ../../index?server_response.php=Login απο άλλη συσκευή');
		die();
}
}
else
{
	header('Location: ../../home_admin.php');
	die();
}


?>

