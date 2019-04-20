<?php

require_once 'connect_db.php';


$json_array = array();

$sql="SELECT * from team_categories ";

$run = $dbh->prepare($sql);
$run ->execute();

$fetch = array();

while($row=$run->fetch(PDO::FETCH_ASSOC)){
 $fetch['Categories'][]=$row;
}

echo json_encode($fetch);

?>

