<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();

if(isset($_SESSION['safe_key'])&&isset($_SESSION['user_id']))
{	
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
	
	$sql="Select count(*) as n_o_a from announcement";
	$run = $dbh->prepare($sql);
	$run ->execute();
	while($row=$run->fetch(PDO::FETCH_ASSOC)){

    echo $row['n_o_a'];
	
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

