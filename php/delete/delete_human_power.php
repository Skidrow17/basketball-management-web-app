<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();


if(isset($_POST['game_id']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true && $_SESSION['profession']==='Admin')
{
	
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$game_id = filter_var($_POST['game_id'], FILTER_SANITIZE_NUMBER_INT);
	
	    $sql = 'DELETE FROM human_power WHERE user_id = :uid and game_id=:gid';
        $stmt =$dbh->prepare($sql);
        $stmt->bindValue(':uid', $id, PDO::PARAM_INT);
		$stmt->bindValue(':gid', $game_id, PDO::PARAM_INT);
        $stmt->execute();
		
		
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
	header('Location: ../../index.php?server_response.php=Login απο άλλη συσκευή');
	die();
}
}
else
{
		header('Location: ../../match_referee_update.php');
		die();
}




?>

