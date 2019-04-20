<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();

if(isset($_POST['cid']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
	
	//$sql="SELECT G.id from game G,team T where G.team_id_1=T.id AND T.category=:td";
	
	
	$sql="Select id,name from team where category=:cid and active = 0";
	
	$run = $dbh->prepare($sql);
    $run->bindParam(':cid',$_POST['cid'], PDO::PARAM_INT);
	$run ->execute();
	echo "<option selected value=''>Επιλέξτε Ομάδα</option>";
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

