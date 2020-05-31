<?php

//Access: Everyone
//Purpose: Retrieves weekly matches 

session_start();
require_once '../connect_db.php';
require '../useful_functions.php';
require '../select_boxes.php';
require_once '../language.php';

if(isset($_POST['current_page'])){
    $page = $_POST['current_page'] * 4;
    echo '<tr>
        <th>'; echo $state; echo'</th>
        <th>'; echo $team; echo' 1</th>
        <th>'; echo $team; echo' 2</th>
        <th>'; echo $score; echo' 1</th>
        <th>'; echo $score; echo' 2</th>
        <th>'; echo $date; echo'</th>
        <th>'; echo $location; echo'</th>
        <th>'; echo $referees; echo'</th>
        <th>'; echo $judges; echo'</th>
        ';
    $sql = "SELECT distinct
    home.name AS team_id_1, 
    away.name AS team_id_2,r.id,r.state,r.team_score_1,r.team_score_2,r.date_time,ci.name as city,c.latitude,c.longitude
    FROM 
    game AS r
    JOIN team AS home 
    ON r.team_id_1 = home.id
    JOIN team AS away 
    ON r.team_id_2 = away.id , court c , team t,city ci where yearweek(r.date_time,1) = yearweek(curdate(),1) AND c.city=ci.id AND r.team_id_1=t.id AND t.category=:id And C.id=r.court_id order by id desc limit :cp,4 ";
    $run = $dbh->prepare($sql);
    $run->bindParam(':id', $_POST['cid'], PDO::PARAM_INT);
    $run->bindParam(':cp', $page, PDO::PARAM_INT);
    $run->execute();
    $run->execute();
    while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        if($row['state'] == 0 || $row['state'] > 5){
            echo '<td>Άγνωστο</td>';
        }else if($row['state'] == 5){
            echo '<td>Τελικός</td>';
        }
        else{
            echo '<td>'.$row['state'].'η περίοδος</td>';
        }
        echo '<td>' . $row['team_id_1'] . '</td>
                <td>' . $row['team_id_2'] . '</td>
                <td>' . $row['team_score_1'] . '</td>
                <td>' . $row['team_score_2'] . '</td>
                <td>' . $row['date_time'] . '</td>
                <td>' . $row['city'] . '</td>
                <td>';
                echo getHuman_Power_By_Game($row['id'], 2);
                echo '</td>
                <td>';
                echo getHuman_Power_By_Game($row['id'], 3);
                echo '</td>
    </tr>';
    }
}