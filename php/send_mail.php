<?php

require_once 'PHPMailer/PHPMailerAutoload.php';
	
	
function sent_mail($mail,$username,$password)
{

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
	<p>Url: <span class="promo">https://zafora.ece.uowm.gr/~ictest00909/EKA/</span></p>
    <p>Username: <span class="promo">'.$username.'</span></p>
    <p class="expire">Password:'.$password.'</p>
  </div>
</div>

</body>
</html> 
';

$mail->Subject = 'EKASDYM';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'ok ';
}

}

?>
 

		