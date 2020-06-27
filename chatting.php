<?php 

//Access: Admin
//Purpose: Add basketball Court

require_once('php/session_admin.php');
require_once('php/language.php');
require_once('http_to_https.php');
require_once('php/useful_functions.php');
require_once('php/select_boxes.php');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - <?php echo $chats; ?></title>
  <?php include('head.php'); ?>
  <link href="assets/css/personal_chat.css" rel="stylesheet"> 

</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>
	
	<?php include('admin_nav_bar.php'); ?>
	<?php include('chatting_component.php');?>
  	<?php include('footer.php'); ?>
	  

	<script> var contact_id = <?php if(isset($_SESSION['contact_id'])){ echo $_SESSION['contact_id'];}else{echo 0;}unset($_SESSION["contact_id"]);?></script>
  	<script src="assets/js/chatting.js"></script>

</body>

</html>