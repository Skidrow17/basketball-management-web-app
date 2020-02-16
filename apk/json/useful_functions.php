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

function sent_mail($mail,$recoveryKey)
{
	require_once '../../PHPMailer/PHPMailerAutoload.php';

//echo $mail;
$strmail = (string)$mail;


$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.mail.yahoo.fr';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'ekasdymannouncements@yahoo.com';          // SMTP username
$mail->Password = 'diplomaThesis12345'; // SMTP password
$mail->SMTPSecure = 'ssl';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                 // TCP port to connect to
$mail->setFrom('ekasdymannouncements@yahoo.com', 'EKASDYM');
$mail->addReplyTo('ekasdymannouncements@yahoo.com', 'EKASDYM');
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

$mail->Subject = 'EKASDYM';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    //echo 'ok ';
}
}


?>
