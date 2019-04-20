<?php

require_once 'connect_db.php';


$json_array = array();

$sql="SELECT distinct
    home.name AS team_id_1, 
    away.name AS team_id_2,r.id,r.team_score_1,r.team_score_2,r.date_time,c.latitude,c.longitude
FROM 
    game AS r
  JOIN team AS home 
    ON r.team_id_1 = home.id
  JOIN team AS away 
    ON r.team_id_2 = away.id , court c , team t where r.team_id_1=t.id AND t.category=:id And C.id=r.court_id order by date_time desc ";

$run = $dbh->prepare($sql);
$run->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$run ->execute();
$fetch = array();

while($row=$run->fetch(PDO::FETCH_ASSOC)){
 $fetch['Match_Details'][]=$row;
}

echo json_encode($fetch);

?>

