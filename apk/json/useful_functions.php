<?php


function getLastId() {
	
 require 'connect_db.php';
 
 $sql="SELECT id from login_history order by id desc limit 1";
 $lid = $dbh->prepare($sql); 
 $lid->execute(); 
 
 while($r=$lid->fetch(PDO::FETCH_ASSOC)){
  $last_id=$r['id'];
 }
 return $last_id;
 
}


function getNumberOfMessages($username) {
	
require 'connect_db.php';

$sql2 = "SELECT count(*) FROM message M,user U WHERE U.id=M.receiver_id AND username=:username"; 
$result = $dbh->prepare($sql2); 
$result->bindParam(':username', $username, PDO::PARAM_STR);
$result->execute(); 
$nom = $result->fetchColumn(); 

return $nom;
 
}

function getNumberOfMatches($user_id) {
	
require 'connect_db.php';

$sql="SELECT 
		count(*)
		FROM 
		game AS r
		JOIN team AS home 
		ON r.team_id_1 = home.id
		JOIN team AS away 
		ON r.team_id_2 = away.id , court c , human_power HP where C.id=r.court_id AND HP.game_id=r.id AND HP.user_id=:user_id";
		
$result = $dbh->prepare($sql2); 
$result->bindParam(':user_id', $user_id, PDO::PARAM_STR);
$result->execute(); 
$nom = $result->fetchColumn(); 

return $nom;
 
}

function getNumberOfAnnouncements() {
	
require 'connect_db.php';

$sql3 = "SELECT count(*) FROM announcement"; 
$result = $dbh->prepare($sql3); 
$result->execute(); 
$noa = $result->fetchColumn(); 

return $noa;
 
}


function randomString($length) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}



function security_check($safe_key,$user_id) {
	
 require 'connect_db.php';
 
 $last_safe_key="";
 
 $sql="SELECT safe_key from login_history where user_id=:id order by login_date_time desc limit 1";
 $result = $dbh->prepare($sql); 
 $result->bindParam(':id', $user_id, PDO::PARAM_INT);
 $result ->execute(); 
 while($row=$result->fetch(PDO::FETCH_ASSOC))
 {
  $last_safe_key=$row["safe_key"];
 }
 
 if($last_safe_key === $safe_key)
 {
 return true;
 }
}


function getVersionOfApk() {
	
require 'connect_db.php';

$sql3 = "SELECT version_number FROM apk_version order by release_date desc limit 1 "; 
$result = $dbh->prepare($sql3); 
$result->execute(); 
$version_number = $result->fetchColumn(); 

return $version_number;
 
}


?>
