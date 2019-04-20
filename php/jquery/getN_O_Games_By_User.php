<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();

if(isset($_SESSION['safe_key'])&&isset($_SESSION['user_id']))
{	
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
	$user_id = filter_var($_SESSION['user_id'],FILTER_SANITIZE_NUMBER_INT);	
	
	$sql="Select count(*) as n_o_r from game g,team T,human_power HP where g.id=HP.game_id AND HP.user_id=:uid AND g.team_id_1=T.id";
	$run = $dbh->prepare($sql);
	$run->bindParam(':uid',$user_id, PDO::PARAM_INT);
	$run ->execute();
	while($row=$run->fetch(PDO::FETCH_ASSOC)){

    echo $row['n_o_r'];
	
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

