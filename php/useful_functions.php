<?php
 
//Access: Admin & Authorized User
//Purpose: containss useful function 

define( 'API_ACCESS_KEY', 'AAAApMEIeNU:APA91bEfkVs_--4jAPOVgmaoB3FL6mz1EDLyMki3ftV3mpazrF4PNsnC1UWL25jWHos0rydUNxO48ro9lFNRWYO0MMizo3yZxiriiDj69GbIzBdCv2NYMzQdPZ5Jyx_6jL3mK_6UIFG8');
define( 'EMAIL', 'ekasdymannouncements@yahoo.com');
define( 'PASSWORD', 'diplomaThesis12345');
define( 'ORGANIZATION','EKASDYM');

function update_last_seen_time($user_id) {
  require 'connect_db.php';
  $sql = "UPDATE login_history SET logout_date_time = :logout_datetime WHERE id = :log_out_id";
  $res = $dbh->prepare($sql);
  $log_out_id = getLastLoginHistoryId($user_id);
  $logout_datetime = date('Y-m-d H:i:s');
  $res->bindParam(':log_out_id', $log_out_id, PDO::PARAM_INT);
  $res->bindParam(':logout_datetime', $logout_datetime, PDO::PARAM_STR);
  $res->execute();
}
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
function randomNumber($length) {
	$str = "";
	$characters = array_merge(range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
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
			 NOT IN (SELECT id FROM human_power HP,game G 
			 WHERE G.id = HP.game_id
			 AND get_current_referee_by_game(G.id) = G.required_referees 
			 AND get_current_judge_by_game(G.id) = G.required_judges)";
			 
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

function sent_mail($mail,$username,$password)
{
	require_once '../../PHPMailer/PHPMailerAutoload.php';
  $url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '/../../';
  $strmail = (string)$mail;

  $mail = new PHPMailer;

  $mail->isSMTP();                                   // Set mailer to use SMTP
  $mail->Host = 'smtp.mail.yahoo.fr';                    // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                            // Enable SMTP authentication
  $mail->Username = EMAIL;          // SMTP username
  $mail->Password = PASSWORD; // SMTP password
  $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                 // TCP port to connect to
  $mail->setFrom(EMAIL, ORGANIZATION);
  $mail->addReplyTo(EMAIL, ORGANIZATION);
  $mail->addAddress($strmail);   // Add a recipient

  $mail->isHTML(true);  // Set email format to HTML

  $bodyContent = '<!DOCTYPE html>
  <html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body {
    font-family: Arial;
  }

  .coupon {
    border: 5px dotted #bbb;
    width: 80%;
    border-radius: 15px;
    margin: 0 auto;
    max-width: 600px;
  }

  .container {
    padding: 2px 16px;
    background-color: #f1f1f1;
  }

  .promo {
    background: #ccc;
    padding: 3px;
  }

  .expire {
    color: red;
  }
  </style>
  </head>
  <body>

  <div class="coupon">
    <div class="container">
      <h3><b>User Details</b></h3>
    </div>
    <div class="container">
    <p>Url: <span class="promo">'.$url.'</span></p>
      <p>Username: <span class="promo">'.$username.'</span></p>
      <p class="expire">Password:'.$password.'</p>
    </div>
  </div>

  </body>
  </html> 
  ';

  $mail->Subject = ORGANIZATION;
  $mail->Body    = $bodyContent;

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'ok ';
  }
}

function recovery_email_send_mobile($mail,$recoveryKey)
{
	require_once '../../PHPMailer/PHPMailerAutoload.php';
  $strmail = (string)$mail;
  $mail = new PHPMailer;
  $mail->isSMTP();                                   // Set mailer to use SMTP
  $mail->Host = 'smtp.mail.yahoo.fr';                    // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                            // Enable SMTP authentication
  $mail->Username = EMAIL;          // SMTP username
  $mail->Password = PASSWORD; // SMTP password
  $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                 // TCP port to connect to
  $mail->setFrom(EMAIL, ORGANIZATION);
  $mail->addReplyTo(EMAIL, ORGANIZATION);
  $mail->addAddress($strmail);   // Add a recipient

  $mail->isHTML(true);  // Set email format to HTML

  $bodyContent = '<!DOCTYPE html>
  <html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body {
    font-family: Arial;
  }

  .coupon {
    border: 5px dotted #bbb;
    width: 80%;
    border-radius: 15px;
    margin: 0 auto;
    max-width: 600px;
  }

  .container {
    padding: 2px 16px;
    background-color: #f1f1f1;
  }

  .promo {
    background: #ccc;
    padding: 3px;
  }

  .expire {
    color: red;
  }
  </style>
  </head>
  <body>

  <div class="coupon">
    <div class="container">
      <h3><b>User Details</b></h3>
    </div>
    <div class="container">
      <p>Recovery Key: <span class="promo">'.$recoveryKey.'</span></p>
    </div>
  </div>

  </body>
  </html> 
  ';

  $mail->Subject = ORGANIZATION;
  $mail->Body    = $bodyContent;

  if(!$mail->send()) {
      //echo 'Message could not be sent.';
      //echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      //echo 'ok ';
  }
}

function recovery_email_send($mail,$recovery_url)
{
  require_once '../../PHPMailer/PHPMailerAutoload.php';
  include 'language.php';

  //echo $mail;
  $strmail = (string)$mail;


  $mail = new PHPMailer;

  $mail->isSMTP();                                   // Set mailer to use SMTP
  $mail->Host = 'smtp.mail.yahoo.fr';                    // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                            // Enable SMTP authentication
  $mail->Username = EMAIL;          // SMTP username
  $mail->Password = PASSWORD; // SMTP password
  $mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                 // TCP port to connect to
  $mail->setFrom(EMAIL, ORGANIZATION);
  $mail->addReplyTo(EMAIL, ORGANIZATION);
  $mail->addAddress($strmail);   // Add a recipient

  $mail->isHTML(true);  // Set email format to HTML

  $bodyContent = '<!DOCTYPE html>
  <html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
  body {
    font-family: Arial;
  }

  .coupon {
    border: 5px dotted #bbb;
    width: 80%;
    border-radius: 15px;
    margin: 0 auto;
    max-width: 600px;
  }

  .container {
    padding: 2px 16px;
    background-color: #f1f1f1;
  }

  .promo {
    background: #ccc;
    padding: 3px;
  }

  .expire {
    color: red;
  }
  </style>
  </head>
  <body>

  <div class="coupon">
    <div class="container">
      <h3><b>Password Recover</b></h3>
    </div>
    <div class="container">
      <p>Press The Link: <a href="'.$recovery_url.'">Verify</a></p>
    
    </div>
  </div>

  </body>
  </html> 
  ';

  $mail->Subject = ORGANIZATION;
  $mail->Body    = $bodyContent;

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo $request_sent.' : '.$strmail;
  }

}

function sentPushNotification($sender_name,$receiver_token,$message) {
  $msg = array
  (
    'message' 	=> $message,
    'title'		=> $sender_name,
    'subtitle'	=> '',
    'tickerText'=> '',
    'vibrate'	=> 1,
    'sound'		=> 1,
    'largeIcon'	=> 'large_icon',
    'smallIcon'	=> 'small_icon'
  );

  $fields = array
  (
    'to' 	=> $receiver_token,
    'data'	=> $msg
  );
  
  $headers = array
  (
    'Authorization: key=' . API_ACCESS_KEY,
    'Content-Type: application/json'
  );
  
  $ch = curl_init();
  curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
  curl_setopt( $ch,CURLOPT_POST, true );
  curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
  curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, true );
  curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
  $result = curl_exec($ch );
  curl_close( $ch );
}

?>
