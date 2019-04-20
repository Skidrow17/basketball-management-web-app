<?php

require_once '../connect_db.php';
require '../useful_functions.php';
session_start();


	
	$cid=$_POST['cid'];
	
	$sql="Select count(*) as n_o_r from game g,team T where g.team_id_1=T.id AND T.category=:cid";
	$run = $dbh->prepare($sql);
	$run->bindParam(':cid',$cid, PDO::PARAM_INT);
	$run ->execute();
	while($row=$run->fetch(PDO::FETCH_ASSOC)){

    echo $row['n_o_r']/4;
	
	}


?>

