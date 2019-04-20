<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();

if(isset($_POST['game_id']))
{	
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
	
	$gid=$_POST['game_id'];
	
	 echo ' <tr>
      <th>Όνομα</th>
      <th>Επίθετο</th>
	  <th>Ιδιοτητα</th>
	  <th></th>';
	  
	$page=$_POST['current_page']*3;
	  
	$sql="Select U.id ,U.name ,U.surname,uc.name as prof from user U,human_power hp,user_categories uc where U.id=hp.user_id  AND hp.game_id=:gid AND uc.id=U.profession order by U.profession asc limit :page,3";
	$run = $dbh->prepare($sql);
	$run->bindParam(':gid',$gid, PDO::PARAM_INT);
	$run->bindParam(':page',$page, PDO::PARAM_INT);
	
	$run ->execute();
	while($row=$run->fetch(PDO::FETCH_ASSOC)){

   echo'<tr>
        <td>'.$row['name'].'</td>
        <td>'.$row['surname'].'</td>
		<td>'.$row['prof'].'</td>
	    <td><button value='.$row['id'].' id="delete_btn" type="button" name="delete_btn" class="btn"><i class="fa fa-trash"></i></button></td>
    </tr>';
			
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

