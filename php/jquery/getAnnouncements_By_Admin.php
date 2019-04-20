<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();



if(isset($_POST['current_page']))
{	
if((security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)&&$_SESSION['profession']==='Admin')
{

$page=$_POST['current_page'];
	
 
$sql="SELECT U.name,U.surname,A.id,A.title,A.text,A.date_time from announcement A , user U where U.id=A.user_id order by A.date_time desc limit :cp,1 ";

$run = $dbh->prepare($sql);
$run->bindParam(':cp', $page, PDO::PARAM_INT);
$run ->execute();
	
	$run ->execute();
	while($row=$run->fetch(PDO::FETCH_ASSOC)){

   echo "
   
   <div style='background-color:#FFF7C8;  border: 1px solid #888; '>
					    
						
					
   <div class='container'>
                 <div style='word-wrap:break-word' class='col-xl-12'><h3 id='u_title' style='font-stretch: expanded;resize:none;font-family: 'Impact', Charcoal, sans-serif;' class='text-center text-secondary'>"; echo $row['title']; echo "</h3></div>
                 <div style='word-wrap:break-word' class='col-xl-12'><hr><small class='form-text text-muted'>Συντάκτης : ";echo $row['name'];echo " "; echo $row['surname']; echo "</small><small class='form-text text-muted'>Ημερομηνία : ";echo $row['date_time']; echo "</small></div>
                 <div style='word-wrap:break-word' class='col-xl-12'><hr><textarea id='message' style='resize:none;' rows='7' class='form-control' style='color:rgb(0,0,0);'readonly>";echo $row['text']; echo"</textarea></div>
			     </div>
				 
				 
				 
		</div>		 
				<div class='form-row'>
				 <div class='col'><div class='form-group'><button id='back1' class='btn btn-primary btn-block' type='button'>Πίσω</button></div></div>
				 <div class='col'><div class='form-group'><button id='delete' value=".$row['id']." class='btn btn-primary btn-block' type='button'>Διαγραφή</button></div></div>
			
				 
				 " ;
				 
	
			
	}
}
else
{
	session_destroy();
}
}
else
{
		
			header('Location: ../../admin_announcements.php');
			die();
		
}
	





?>

