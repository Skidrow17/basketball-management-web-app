<?php

require_once '../connect_db.php';
require '../useful_functions.php';
require '../select_boxes.php';
session_start();

if(isset($_POST['current_page']))
{	
if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
		
	$page=$_POST['current_page'];
	
	  
$sql="SELECT 
		home.name AS team_id_1, 
		away.name AS team_id_2,r.id,r.team_score_1,r.team_score_2,r.date_time,c.latitude,c.longitude
		FROM 
		game AS r
		JOIN team AS home 
		ON r.team_id_1 = home.id
		JOIN team AS away 
		ON r.team_id_2 = away.id , court c , human_power HP where C.id=r.court_id AND HP.game_id=r.id AND HP.user_id=:id order by date_time desc limit :page,1";
		
	$run = $dbh->prepare($sql);
    $run->bindParam(':id',$_SESSION['user_id'], PDO::PARAM_INT);
	$run->bindParam(':page',$page, PDO::PARAM_INT);
	$run ->execute();
	
	$run ->execute();
	while($row=$run->fetch(PDO::FETCH_ASSOC)){

   $converted = date('d M Y h.i.s A', strtotime($row['date_time']));
$reversed = date('d-m-Y H.i.s', strtotime($converted));
		
		
	
		
                  echo " 				  
				  
				  <div class='form-row'>
				    <div class='col'> <li class='list-group-item' style='text-align: center;color:#000000;background-color:#ffffff;'>".$reversed."</div>
			    </div>
				  
				  <div class='form-row'>
                <div class='col'>
                    <hr>
                </div>
				</div>
				 
				  <div class='form-row'>
				
				   <div class='col'> <li class='list-group-item' style='color:#ffffff;background-color:#dc6e56;'>Ομάδα 1 : ".$row['team_id_1']."</div>
				
					</div>
					
					<div class='form-row'>
				   <div class='col'> <li class='list-group-item' style='color:#ffffff;background-color:#dc6e56;'>Σκόρ 1 : ".$row['team_score_1']."</div>
				  <div class='col'> <li class='list-group-item' style='color:#000000;background-color:#ffffff;'>Σκόρ 2 : ".$row['team_score_2']."</div>
					</div>
					
					
					<div class='form-row'>
				  <div class='col'> <li class='list-group-item' style='color:#000000;background-color:#ffffff;'>Ομάδα 2 : ".$row['team_id_2']."</div>
					</div>
					
			   <div class='form-row'>
                <div class='col'>
                    <hr>
                </div>
				</div>
				
				
				<div class='form-row'>
				  <div class='col'> <li class='list-group-item' style='color:#000000;background-color:#ffffff;'>";echo getHuman_Power_By_Game1($row['id']);echo"</div>
				</div>
				
				 
				
				
            </div>
					
                    ";
                
				
				
				

				
				  echo "
				  <div class='form-row'>
				 <div class='col'><button class='btn btn-primary col' id='location' name='button' value='".$row['id']."' type='button'>Τοποθεσία</button></div>
				  <div class='col'><button class='btn btn-primary col' id='score' name='button' value='".$row['id']."' type='button'>Αλλαγή Σκόρ</button></div>
				  </div>
				  ";     
			
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

