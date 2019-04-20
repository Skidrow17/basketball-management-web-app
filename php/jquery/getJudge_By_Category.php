<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();

if(isset($_POST['id']))
{	
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
	
	$sql="SELECT U.id , U.name,U.surname from user U,playable_categories PC where U.id=PC.user_id AND U.profession=3 AND PC.team_categories_id=:td  order by U.rate desc";
	$run = $dbh->prepare($sql);
    $run->bindParam(':td',$_POST['id'], PDO::PARAM_INT);
	$run ->execute();
	
	echo "<option selected>Επιλέξτε Κριτή</option>";
	while($row=$run->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';  
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

