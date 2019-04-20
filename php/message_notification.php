<?php

require_once 'connect_db.php';
require_once 'useful_functions.php';
session_start();


if(isset($_SESSION['safe_key'])&&isset($_SESSION['safe_key']))
{
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{	
if(isset($_SESSION['username'])&&isset($_SESSION['N_O_M']))
{
	if(getNumberOfMessages($_SESSION['username'])==$_SESSION['N_O_M'])
	{
	     echo 1;
	}
	else
	{
		$sql="SELECT U.name,U.surname,M.text_message FROM user U, message M 
		where 
		U.id=M.sender_id AND  
		receiver_id=:id ORDER BY date_time desc LIMIT 1" ;
		$run = $dbh->prepare($sql);
		$run->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
		$run ->execute();
		
		while($row=$run->fetch(PDO::FETCH_ASSOC))
		{
			echo $row['name'];
			echo " ";
			echo $row['surname'];
			echo "<br>";
			echo $row['text_message'];
		}
		
		$_SESSION['N_O_M']=getNumberOfMessages($_SESSION['username']);
	}
	
	$sql = "UPDATE login_history SET logout_date_time=? WHERE id=?";
	$stmt= $dbh->prepare($sql);
	$stmt->execute([date('Y/m/d H:i:s'),$_SESSION['L_L_H']]);
	
}
else
{
	 echo 1;
}
}
else
{
	echo 2;
}
}
else
{
  echo 1;
}	



	
?>

