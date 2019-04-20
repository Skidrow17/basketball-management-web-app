<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();


if(isset($_POST['aid']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
	
	$aid = filter_var($_POST['aid'], FILTER_SANITIZE_NUMBER_INT);
	$uid = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);

		if($_SESSION['profession']==='Admin')
		{
	    $sql = 'DELETE FROM announcement WHERE id = :id';
		$stmt =$dbh->prepare($sql);
        $stmt->bindValue(':id', $aid);
        $stmt->execute();
		
		}
		else
		{
		$sql = 'DELETE FROM announcement WHERE id = :id and user_id=:uid';
		$stmt =$dbh->prepare($sql);
        $stmt->bindValue(':id', $aid);
		$stmt->bindValue(':uid', $uid);
        $stmt->execute();
		}
	
		
    if($stmt->rowCount()>0)
	{
		echo "Eπιτυχία Διαγραφής";
	}
	else
	{
		echo "Αποτυχία Διαγραφής";
	}
		
		
		
}
else
{
	session_destroy();
	header('Location: ../../index.php?server_response=Login απο άλλη συσκευή');
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

