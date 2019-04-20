<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();

if(isset($_POST['game_id']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true && $_SESSION['profession']==='Admin')
{
		
	$sql="Select count(*) as n_o_r from human_power hp where hp.game_id=:gid";
	$run = $dbh->prepare($sql);
	$run->bindParam(':gid',$_POST['game_id'], PDO::PARAM_INT);
	$run ->execute();
	while($row=$run->fetch(PDO::FETCH_ASSOC)){

    echo $row['n_o_r']/3;
	
	}

	
}
else
{
	session_destroy();
}
}
else
{
	header('Location: ../../home_admin.php');
	die();
}




?>

