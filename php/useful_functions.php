<?php
function getLastId() {
    require 'connect_db.php';
    $sql = "SELECT id from login_history order by id desc limit 1";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    while ($r = $lid->fetch(PDO::FETCH_ASSOC)) {
        $last_id = $r['id'];
    }
    return $last_id;
}
function getLastLoginHistoryId($user_id) {
    require 'connect_db.php';
    $sql = "SELECT id from login_history where user_id=:id order by id desc limit 1";
    $lid = $dbh->prepare($sql);
    $lid->bindParam(':id', $user_id, PDO::PARAM_STR);
    $lid->execute();
    $last_id = 0;
    while ($r = $lid->fetch(PDO::FETCH_ASSOC)) {
        $last_id = $r['id'];
    }
    return $last_id;
}
function notification($message) {
    echo "<script>";
    echo "$(function() {";
    echo "$.snackbar({content: '" . $message . "'});";
    echo "});";
    echo "</script>";
}
function getNumberOfMatches($user_id) {
    require 'connect_db.php';
    $sql2 = "SELECT 
		count(*)
		FROM 
		game r, court c , human_power HP where C.id=r.court_id AND HP.game_id=r.id AND HP.user_id=:user_id";
    $result = $dbh->prepare($sql2);
    $result->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $result->execute();
    $nom = $result->fetchColumn();
    return $nom;
}
function getNumberOfAllMatches() {
    require 'connect_db.php';
    $sql2 = "SELECT 
		count(*)
		FROM 
		game";
    $result = $dbh->prepare($sql2);
    $result->execute();
    $nom = $result->fetchColumn();
    return $nom;
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
function getNumberOfAllMessages() {
    require 'connect_db.php';
    $sql2 = "SELECT count(*) FROM message";
    $result = $dbh->prepare($sql2);
    $result->execute();
    $nom = $result->fetchColumn();
    return $nom;
}
function getNumberOfRestrictions() {
    require 'connect_db.php';
    $sql2 = "SELECT count(*) FROM restriction";
    $result = $dbh->prepare($sql2);
    $result->execute();
    $nor = $result->fetchColumn();
    return $nor;
}
function getNumberOfUsers() {
    require 'connect_db.php';
    $sql2 = "SELECT count(*) FROM user";
    $result = $dbh->prepare($sql2);
    $result->execute();
    $nou = $result->fetchColumn();
    return $nou;
}
function getNumberOfSentMessages($username) {
    require 'connect_db.php';
    $sql2 = "SELECT count(*) FROM message M,user U WHERE U.id=M.sender_id AND username=:username";
    $result = $dbh->prepare($sql2);
    $result->bindParam(':username', $username, PDO::PARAM_STR);
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
    $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
    $max = count($characters) - 1;
    for ($i = 0;$i < $length;$i++) {
        $rand = mt_rand(0, $max);
        $str.= $characters[$rand];
    }
    return $str;
}
function security_check($safe_key, $user_id) {
    require 'connect_db.php';
    $last_safe_key = "";
    $sql = "SELECT safe_key from login_history where user_id=:id order by login_date_time desc limit 1";
    $result = $dbh->prepare($sql);
    $result->bindParam(':id', $user_id, PDO::PARAM_INT);
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $last_safe_key = $row["safe_key"];
    }
    if ($last_safe_key === $safe_key) {
        return true;
    }
}
function getVersionOfApk() {
    require 'connect_db.php';
    $sql3 = "SELECT version_number 
			 FROM apk_version 
			 ORDER BY release_date desc limit 1 ";
    $result = $dbh->prepare($sql3);
    $result->execute();
    $version_number = $result->fetchColumn();
    return $version_number;
}
function getNumberOfCurrentMatches() {
    require 'connect_db.php';
    $sql2 = "SELECT count(*)
			 FROM
			 game 
			 WHERE YEARWEEK(date_time,1) = YEARWEEK(NOW(),1)";
    $result = $dbh->prepare($sql2);
    $result->execute();
    $nom = $result->fetchColumn();
    return $nom;
}

function getReadyToPlayGames() {
    require 'connect_db.php';
    $sql2 = "SELECT count(*)
			 FROM
			 game 
			 WHERE YEARWEEK(date_time,1) = YEARWEEK(NOW(),1) 
			 AND id 
			 IN (SELECT id FROM human_power HP,game G 
			 WHERE G.id = HP.game_id
			 AND get_current_referee_by_game(G.id) != G.required_referees 
			 OR get_current_judge_by_game(G.id) != G.required_judges)";
    $result = $dbh->prepare($sql2);
    $result->execute();
    $nom = $result->fetchColumn();
    return $nom;
}

function getLocale(){
	echo   '<script type="text/javascript">
				function localeJS() {
					var userLang = navigator.language || navigator.userLanguage;
					return userLang;
				}
			</script>';
	return '<script>localeJS();</script>';
}
?>
