<?php

require_once 'connect_db.php';
require 'useful_functions.php';
session_start();



if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true && $_SESSION['profession']=='Admin')
{

if($_GET['id']==1)
{
$sql="Select * from restriction";
$filename = 'restriction-'.date('d.m.Y').'.csv';
}
else if($_GET['id']==3)
{
$sql="Select * from login_history";	
$filename = 'login_history-'.date('d.m.Y').'.csv';
}
else if($_GET['id']==2)
{
$sql="Select * from user_update_history";	
$filename = 'user_update_history-'.date('d.m.Y').'.csv';
}


header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="'.$filename.'"');

try {
    $run = $dbh->prepare($sql);
    $run->execute();
    $output = fopen('php://output', 'w');
    $header = true;
    while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
        if ($header) {
            fputcsv($output, array_keys($row));
            $header = false;
        }
        fputcsv($output, $row);
    }
    fclose($output);
} catch (PDOException $e) {
    
}

	
	
}
else
{

		session_destroy();
		header('Location: ../index.php?server_response=Login απο άλλη συσκευή');
}


?>

