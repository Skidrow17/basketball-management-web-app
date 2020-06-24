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
	<title>ΕΚΑΣΔΥΜ - <?php echo $restriction_history; ?></title>
  <?php include('head.php'); ?>
  <link href="assets/css/personal_chat.css" rel="stylesheet"> 

</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>
	
	<?php include('admin_nav_bar.php'); ?>

  	<div class="container-fluid h-100 mobile_view">
		<div class="row justify-content-center h-100">
		<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
			<div class="card-header">
			<div class="input-group">
				<input type="text" id = 'search_id' placeholder="Search..." name="" class="form-control search">
				<div class="input-group-prepend">
				<span class="input-group-text search_btn"><i class="fa fa-search"></i></span>
				</div>
			</div>
			</div>
			<div class="card-body contacts_body contacts_add">
			<!-- contacts are droped here with ajax -->
			</div>
			<div class="card-footer"></div>
		</div></div>
		<div class="col-md-8 col-xl-6 chat">
			<div class="card">
			<div class="card-header msg_head">
				<div class="d-flex bd-highlight contact_info">
				<!-- contact info -->
				<div class="img_cont">
				</div>
				<div class="user_info">
				</div>
				</div>
				<span id="action_menu_btn"><i class="fa fa-refresh"></i></span>
			</div>
			<div id = 'scrolled_bottom' class="card-body msg_card_body messages_add">
				<!-- text message are droped here with ajax -->
			</div>
			<div class="card-footer">
				<div class="input-group">
				<textarea id="text_send" class="form-control type_msg" style = "color:white;"   placeholder="Type your message..."></textarea>
				<div class="input-group-append">
					<span class="input-group-text send_btn" id = 'button_send'><i class="fa fa-location-arrow"></i></span>
				</div>
				</div>
			</div>
			</div>
		</div>
		</div>
  	</div>

  <?php include('index_footer.php'); ?>
  <script src="assets/js/chatting.js"></script>

</body>

</html>