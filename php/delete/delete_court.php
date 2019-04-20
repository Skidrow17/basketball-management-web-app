<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();


if(isset($_POST['court_id']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true&&$_SESSION['profession']==='Admin')
{
	
	$id=filter_var($_POST['court_id'], FILTER_SANITIZE_NUMBER_INT);
	
	$sql="UPDATE court SET active=1 where id = ?";	
	$run =$dbh->prepare($sql);
    $run->execute([$id]);
	
	
	if($run->rowCount()>0)
	{
		if($id!=="")
		$_SESSION['server_response']='Διαγράφηκε με επιτυχία';	
		else
		$_SESSION['server_response']='Επιλέξτε Γήπεδο';
	
	}
	else
	{
		$_SESSION['server_response']='Δεν Διαγράφηκε';
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
		header('Location: ../../court_update.php');
		die();
}


?>

