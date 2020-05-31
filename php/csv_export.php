<?php

//Access: Admin
//Purpose: export history table information in csv format

session_start();
require_once 'connect_db.php';
require 'useful_functions.php';
require_once 'language.php';


if(isset($_SESSION['safe_key']) && isset($_SESSION['user_id']) && isset($_SESSION['profession'])){
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] == 'Admin') {
        if ($_GET['id'] == 1) {
            $sql = "Select U.name,U.surname,R.time_from,R.time_to,R.date,R.register_timestamp,R.deletable,R.comment from restriction R, user U WHERE u.Id = R.user_id AND register_timestamp > :date_from";
            $filename = 'restriction-' . date('d.m.Y') . '.csv';
        } else if ($_GET['id'] == 3) {
            $sql = "SELECT U.name,U.surname,LH.login_date_time,LH.logout_date_time,LH.safe_key,LH.device_name,LH.ip 
                    FROM login_history LH,User u 
                    WHERE u.Id = LH.user_id AND login_date_time > :date_from 
                    ORDER BY LH.login_date_time desc";
            $filename = 'login_history-' . date('d.m.Y') . '.csv';
        } else if ($_GET['id'] == 2) {
            $sql = "SELECT H.name,H.surname,H.username,H.password,H.name,H.surname,H.email,H.phone,if(H.driving_licence = 0, '".$yes."', '".$no."') as driving_licence,C.name as city_name,P.name as user_category,H.profile_pic,if(H.active = 0, '".$active."', '".$inactive."') as active,R.name as user_rate,H.update_time
                    FROM user_update_history H,rate R,city C,user_categories P
                    WHERE H.rate = R.id AND C.id = H.living_place AND P.id = H.profession AND update_time > :date_from";
            $filename = 'user_update_history-' . date('d.m.Y') . '.csv';
        } else if ($_GET['id'] == 4){
            $sql = "SELECT u.name AS user_name,u.surname,home.name as home_team,away.name as away_team,g.date_time,team_score_1,team_score_2,c.name AS court_name FROM user u,human_power hp,court c,game g JOIN team AS home ON g.team_id_1 = home.id JOIN team AS away ON g.team_id_2 = away.id where hp.game_id = g.id and hp.user_id = u.id and g.court_id = c.id and g.date_time > :date_from  ORDER BY G.date_time";
            $filename = 'user_match_history-' . date('d.m.Y') . '.csv';
        }
        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        try {
            $run = $dbh->prepare($sql);
            $run->bindParam(':date_from',$_GET['date_from'],PDO::PARAM_STR);
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
        }
        catch(PDOException $e) {
        }
    } else {
        session_destroy();
        header('Location: ../index.php?server_response=Login απο άλλη συσκευή');
        die();
    }
}