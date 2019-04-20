<?php

require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();

$f="00:00:00";
$t="23:59:59";
$x=0;

$parts=explode(", ",$_POST["dates"]);

echo $_POST["dates"];
	
$timezone = date_default_timezone_get();
$now = date('m/d/Y h:i:s a', time());

if(isset($_POST['submit']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{

	for($i=0;$i<sizeof($parts);$i++)
	{
		$newDate = str_replace("/","-",$parts[$i]);
		
		$sql="INSERT INTO `restriction`(`user_id`, `date`, `time_from` , `time_to` ) VALUES (:user_id,:date,:time_from,:time_to)";
		$run =$dbh->prepare($sql);
		$run->bindParam(':user_id', $_SESSION["user_id"], PDO::PARAM_INT);       
		$run->bindParam(':date',$newDate, PDO::PARAM_STR);    
		$run->bindParam(':time_from',$f, PDO::PARAM_STR);
		$run->bindParam(':time_to',$t, PDO::PARAM_STR);
		$run ->execute();

		if($run->rowCount()>0)
		{
			$x=$x+1;
		}

	}

	$y=sizeof($parts)-1;
	$_SESSION['server_response']='Τα κωλύματα προστέθηκαν με επιτυχία';
    header('Location: ../../add_restriction.php');
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
	header('Location: ../../add_restriction.php');
	die();
}


?>

