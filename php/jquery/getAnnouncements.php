<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();

if(isset($_POST['current_page']))
{
if((security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true))
{	
$page=$_POST['current_page'];
	
$sql="SELECT U.name,U.surname,A.title,A.text,A.date_time from announcement A , user U where A.user_id=U.id order by date_time desc limit :cp,1 ";

$run = $dbh->prepare($sql);
$run->bindParam(':cp', $page, PDO::PARAM_INT);
$run ->execute();
	
	$run ->execute();
	while($row=$run->fetch(PDO::FETCH_ASSOC)){

   echo "<div class='container'>
                 <div style='word-wrap:break-word' class='col-xl-12'><h3 style='font-stretch: expanded;resize:none;font-family: 'Impact', Charcoal, sans-serif;' class='text-center text-secondary'>"; echo $row['title']; echo "</h3></div>
                 <div style='word-wrap:break-word' class='col-xl-12'><hr><small class='form-text text-muted'>Συντάκτης : ";echo $row['name'];echo " "; echo $row['surname']; echo "</small><small class='form-text text-muted'>Ημερομηνία : ";echo $row['date_time']; echo "</small></div>
                 <div style='word-wrap:break-word' class='col-xl-12'><hr><textarea style='resize:none;' rows='10' class='form-control' style='color:rgb(0,0,0);'readonly> ";echo $row['text']; echo"</textarea></div>
			     </div>";
	
			
	}
}
else
{
	echo 'error';
	session_destroy();
}
}
else
{
		if($_SESSION['profession']==='Admin')
		{
			header('Location: ../../admin_announcements.php');
			die();
		}
		else
		{
			header('Location: ../../announcements.php');
			die();
		}
}

	





?>

