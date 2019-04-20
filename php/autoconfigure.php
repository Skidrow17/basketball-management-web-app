<?php

require_once 'connect_db.php';
require 'useful_functions.php';
session_start();



    $referee = array();
	
	$sql="select U.id ,U.rate,T_C.id as cat_id,U.driving_licence from user U , playable_categories P_C , team_categories T_C where U.profession=2 AND U.id=P_C.user_id AND P_C.team_categories_id=T_C.id AND U.active=0";
	$run = $dbh->prepare($sql);
	$run ->execute();
	

	while($row=$run->fetch(PDO::FETCH_ASSOC)){
	$referee[]=array($row['id'],$row['rate'],$row['cat_id'],$row['driving_licence']);
	}
	
	
	
	$judges = array();
	
	$sql="select U.id ,U.rate,T_C.id as cat_id,U.driving_licence from user U , playable_categories P_C , team_categories T_C where U.profession=3 AND U.id=P_C.user_id AND P_C.team_categories_id=T_C.id AND U.active=0";
	$run = $dbh->prepare($sql);
	$run ->execute();
	

	while($row=$run->fetch(PDO::FETCH_ASSOC)){
	$judges[]=array($row['id'],$row['rate'],$row['cat_id'],$row['driving_licence']);
	}
	
	
	

	
	$games = array();
	
	$sql="select G.id,T_C.id as cat_id,C.city,G.required_referees,G.required_judges,G.date_time from game G,team T,team_categories T_C,court C where C.id=G.court_id And G.team_id_1=T.id And T_C.id=T.category AND week(G.date_time - INTERVAL 1 DAY)=week(now() - INTERVAL 1 DAY) order by G.rate desc";
	$run = $dbh->prepare($sql);
	$run ->execute();

	while($row=$run->fetch(PDO::FETCH_ASSOC)){
	$games[]=array($row['id'],$row['cat_id'],$row['city'],$row['required_referees'],$row['required_judges'],$row['date_time']);
	}
	
	
	
	$restriction = array();
	
	$sql="select user_id,date,time_from,time_to from restriction where week(date - INTERVAL 1 DAY)=week(now() - INTERVAL 1 DAY)";
	$run = $dbh->prepare($sql);
	$run ->execute();

	while($row=$run->fetch(PDO::FETCH_ASSOC)){
	$restriction[]=array($row['user_id'],$row['date'],$row['time_from'],$row['time_to']);
	}
	
	

//shuffle($referee);
array_multisort(array_column($referee, 1), SORT_DESC,array_column($referee, 2),SORT_ASC, $referee);
array_multisort(array_column($judges, 1), SORT_DESC,array_column($judges, 2),SORT_ASC, $judges);

 echo "-------------------------------------------------------------------------------------------------";
 echo "<br>";
 echo "Dietites";
 echo "<br>";
 echo "-------------------------------------------------------------------------------------------------";
 echo "<br>";

 for ($x = 0; $x < count($referee); $x++) {
 
  echo "id = ";
  echo $referee[$x][0];
  echo " ";
  echo "rate = ";
  echo $referee[$x][1];
  echo " ";
  echo "katigoria = ";
  echo $referee[$x][2];
  echo " ";
  echo "driving_licence = ";
  echo $referee[$x][3];
  echo " ";
  echo "<br>";
 
 }
 
 echo "-------------------------------------------------------------------------------------------------";
 echo "<br>";
 echo "Krites";
 echo "<br>";
 echo "-------------------------------------------------------------------------------------------------";
 echo "<br>";
 
  for ($x = 0; $x < count($judges); $x++) {
 
  echo "id = ";
  echo $judges[$x][0];
  echo " ";
  echo "rate = ";
  echo $judges[$x][1];
  echo " ";
  echo "katigoria = ";
  echo $judges[$x][2];
  echo " ";
  echo "driving_licence = ";
  echo $judges[$x][3];
  echo " ";
  echo "<br>";
 
 }
	
	

$referee_per_game = array();	
 
// 
for ($x = 0; $x < count($games); $x++) {
 //$games[$x][3]
 // posus dietites apetei to pexnidi
		
	 for ($y = 0; $y < count($referee); $y++) {
		if($games[$x][1]===$referee[$y][2] && restriction_check($restriction,$referee[$y][0],$games[$x][5])==true)
		{
		  
		  //elegxei posus dietites exei  valei idi sto game kai to sigrini me ton arithmo pou apetite
		  if(referee_per_game($referee_per_game,$games[$x][0])==$games[$x][3])
		  {
			  break;
		  }
		  else
		  {
	         $referee_per_game[]=array($games[$x][0],$referee[$y][0]);
		     delete_user($referee,$referee[$y][0]);
		     $y--;
		  }
		}
	 }
}
 
 echo "-------------------------------------------------------------------------------------------------";
 echo "<br>";

 for ($x = 0; $x < count($referee); $x++) {
 
  echo "id = ";
  echo $referee[$x][0];
  echo " ";
  echo "rate = ";
  echo $referee[$x][1];
  echo " ";
  echo "katigoria = ";
  echo $referee[$x][2];
  echo " ";
  echo "driving_licence = ";
  echo $referee[$x][3];
  echo " ";
  echo "<br>";
 
 }
 
 echo "-------------------------------------------------------------------------------------------------";
 echo "<br>";
 
  for ($x = 0; $x < count($referee_per_game); $x++) {
 
  echo "game id = ";
  echo $referee_per_game[$x][0];
  echo " ";
  echo "refere id = ";
  echo $referee_per_game[$x][1];

  echo "<br>";
 
 }
 
 




function delete_user(&$ref,$user_id) {

  for($i = 0; $i < count($ref); $i++)
  {
	  if($ref[$i][0]==$user_id)
	  {
	     array_splice($ref, $i, 1);
		 $i--;
	  }
  }

  return $ref;
}




function restriction_check(&$restrict,$user_id,$game_date)
{
	
	 $split=explode(" ",$game_date);
	 $timestamp = strtotime($split[1]) + 60*60*2;
     $game_end_time = date('H:m:s', $timestamp);
	 
	 for ($c = 0; $c < count($restrict); $c++) {
		if($restrict[$c][0]==$user_id && strtotime($split[0]) == strtotime($restrict[$c][1]))
		{
				//echo $restrict[$c][3] . " < " . $split[1] . " || " . $restrict[$c][2] . " > " . $game_end_time;
				if($restrict[$c][3]<=$split[1] || $restrict[$c][2]>=$game_end_time)
				return true;
				else
				return false;
		}
	 }
	return true;
}


function referee_per_game(&$current_referee,$game_id) {

  $counter = 0;
  for($i = 0; $i < count($current_referee); $i++)
  {
	  if($current_referee[$i][0]==$game_id)
	  {
	    $counter++;
	  }
  }

  return $counter;
}






?>

