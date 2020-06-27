<?php 

//Access: Admin & Authorized User
//Purpose: Add basketball Court

require_once('php/language.php');
require_once('http_to_https.php');
require_once('php/useful_functions.php');
require_once('php/select_boxes.php');
?>



<div class="container-fluid h-100 mobile_view">
	<div class="row justify-content-center h-100">
	<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
		<div class="card-header">
		<div class='form-row' style = 'margin-bottom:10px;'>
			<div class="col">
				<button class="btn btn-light btn-block" id='chats'  type="button"><?php echo $chats; ?></button>
			</div>
			<div class="col">
				<button class="btn btn-light btn-block" id='contacts'  type="button"><?php echo $contacts; ?></button>
			</div>
		</div>
		<div class="input-group">
			<input type="text" id = 'search_id' placeholder=<?php echo '"'.$searchContacts.'"'; ?> class="form-control search">
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
			<textarea id="text_send" class="form-control type_msg" style = "color:white;"   placeholder=<?php echo '"'.$type_message.'"'; ?>></textarea>
			<div class="input-group-append">
				<span class="input-group-text send_btn" id = 'button_send'><i class="fa fa-location-arrow"></i></span>
			</div>
			</div>
		</div>
		</div>
	</div>
	</div>
</div>

<script> 
	var polling_time = <?php echo $_SESSION['polling_mins'];?>;
	console.log(polling_time);
</script>
