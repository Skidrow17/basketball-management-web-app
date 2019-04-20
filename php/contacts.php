<?php

require_once 'connect_db.php';

if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{	
$sql2 = "SELECT id,name,surname FROM `user` order by id";
$run = $dbh->prepare($sql2);
$run ->execute();


while($row = $run->fetch())  
{
	echo "<option class='dropdown-item' role='presentation' value=" . $row['id'] . " > ". $row['name'] . " " . $row['surname'] . "</option>";
}
}
else
{
	session_destroy();
	header('Location: ../../index.php?server_response=Login απο άλλη συσκευή');
	die();
}

?>