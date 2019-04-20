<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();


if(isset($_POST['restriction_id']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
	
	$id = filter_var($_POST['restriction_id'], FILTER_SANITIZE_NUMBER_INT);
	$uid = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);

	    $sql = 'DELETE FROM restriction WHERE id = :id and user_id=:uid';
        $stmt =$dbh->prepare($sql);
        $stmt->bindValue(':id', $id);
		$stmt->bindValue(':uid',$uid);
        $stmt->execute();


		
	if( $stmt->rowCount()>0)
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
	header('Location: ../../index.php?server_response=Login απο άλλη συσκευή');
	die();
}
}
else
{
		header('Location: ../../add_restriction.php');
		die();
}



?>

