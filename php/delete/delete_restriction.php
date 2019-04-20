<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();


if(isset($_POST['id']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true && $_SESSION['profession']==='Admin')
{
	
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$user_id=-1;
	
	$time_from = "";
	$time_to = "";
	$date = "";
	
	
		$sql = 'select * from restriction where id = :id';
        $run =$dbh->prepare($sql);
        $run->bindValue(':id', $id);
        $run->execute();
		while($row=$run->fetch(PDO::FETCH_ASSOC)){
		$user_id=$row['user_id'];
		$time_from = $row['time_from'];
		$time_to = $row['time_to'];
		$date = $row['date'];
		}
	
	    $sql = 'DELETE FROM restriction WHERE id = :id';
        $stmt =$dbh->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
		
		
	if($stmt->rowCount()>0)
	{
		echo "Eπιτυχία Διαγραφής";
	}
	else
	{
		echo "Αποτυχία Διαγραφής";
	}

	
	$message_sent = 'Διαγραφή Κωλύματος Από '.$time_from.' Μέχρι '.$time_to.' Στις '.$date;
		
	$sql="INSERT INTO `message`(`sender_id`, `receiver_id`, `text_message`) VALUES 
	(?,?,?)";
	$run = $dbh->prepare($sql);
	$run ->execute([$_SESSION['user_id'],$user_id,$message_sent]);
	
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
		header('Location: ../../match_referee.php');
		die();
}




?>

