<?php

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
