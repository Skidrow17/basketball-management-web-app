<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();

if(isset($_POST['game_id']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true&&$_SESSION['profession']==='Admin')
{
	
	$gid = filter_var($_POST['game_id'],FILTER_SANITIZE_NUMBER_INT);
	
	$sql="SELECT c.latitude,c.longitude FROM court c, game g where c.id=g.court_id and g.id=:gid";
	
		
	$run = $dbh->prepare($sql);
	$run->bindParam(':gid',$gid, PDO::PARAM_INT);
	$run ->execute();
	
	
	while($row=$run->fetch(PDO::FETCH_ASSOC)){

		$fetch=$row;
	}
	
	echo json_encode($fetch);

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

