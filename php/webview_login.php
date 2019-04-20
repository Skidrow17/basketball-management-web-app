<?php

require 'connect_db.php';
require 'useful_functions.php';
session_start();

if (isset($_POST['password'])&&isset($_POST['username'])&&isset($_POST['safe_key'])) {
	
$username = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['username']);		
$password = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['password']);	
$safe_key = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['safe_key']);


$sql="SELECT U.id,U.username,U.password,U.name,U.surname,U.email,U.phone,U.profile_pic,U.active,U_C.name as profession FROM user U , user_categories U_C where U.profession=U_C.id AND U.username=:username";
$run = $dbh->prepare($sql);
$run->bindParam(':username', $username, PDO::PARAM_STR);
$run ->execute();


if ($run->rowCount() > 0)
{
	
while($row=$run->fetch(PDO::FETCH_ASSOC)){
	
	if(( preg_replace('/[^\p{L}\p{N}\s]/u', '', $row['password']) === preg_replace('/[^\p{L}\p{N}\s]/u', '', $password )))
	{
 
	$_SESSION['user_id']=$row['id'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['name'] = $row['name'];
	$_SESSION['surname'] = $row['surname'];
	$_SESSION['profile_pic'] = $row['profile_pic'];
	$_SESSION['safe_key'] = $safe_key;
	$_SESSION['profession'] = $row['profession'];
	$_SESSION['N_O_M']=getNumberOfMessages($row['username']);
	$_SESSION['L_L_H']=getLastLoginHistoryId($row['id']);
  
	header('Location: ../home_admin.php');

	}
 }
}
}


?>
