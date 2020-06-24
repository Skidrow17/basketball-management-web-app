
<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<?php include('head.php'); ?>
		<link href="assets/css/personal_chat.css" rel="stylesheet"> 
	</head>
	<!--Coded With Love By Mutiullah Samim-->
	<body>
		<div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="input-group">
							<input type="text" id = 'search_id' placeholder="Search..." name="" class="form-control search">
							<div class="input-group-prepend">
								<span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
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
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Chat with Khalid</span>
									<p>1767 Messages</p>
								</div>
							</div>
							<span id="action_menu_btn"><i class="fas fa-refresh"></i></span>
						</div>
						<div id = 'scrolled_bottom' class="card-body msg_card_body messages_add">
							<!-- text message are droped here with ajax -->
						</div>
						<div class="card-footer">
							<div class="input-group">
								<textarea id="text_send" class="form-control type_msg" placeholder="Type your message..."></textarea>
								<div class="input-group-append">
									<span class="input-group-text send_btn" id = 'button_send'><i class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php include('index_footer.php'); ?>
	<script>
		$(document).ready(function(){
			searchData('');

			$('#action_menu_btn').click(function(){
				$.ajax({
					type: "POST",
					url: "php/jquery/getChats.php",
					success: function(result) {
						$(".messages_add").html(result);
					}
				});
			});


			$('#button_send').click(function(){
				
				$(".messages_add").append(`<div class="d-flex justify-content-end mb-4">
					<div class="img_cont_msg">
					</div>
					<div class="msg_cotainer_send">
						`+$('#text_send').val()+`
						<span class="msg_time_send">8:40 AM, Today</span>
					</div>
				</div>`);

				$("#text_send").val("");

				$.ajax({
					type: "POST",
					url: "php/jquery/getChats.php",
					success: function(result) {
						console.log($('#text_send').val());
					}
				});
			});

		
			$("#search_id").unbind().keyup(function(e) {
			var value = $(this).val();
				searchData(value);
			});

		});


		function searchData(val) {			
			var post = "search=%" + val + "%";
			$.ajax({
			  type: "POST",
			  url: "php/jquery/dynamic_contacts.php",
			  data: post,
			  success: function(result) {
				$(".contacts_add").html(result);
			  }
			});
		  }


		function updateScroll(){
			var element = document.getElementById("scrolled_bottom");
			element.scrollTop = element.scrollHeight;
		}

		  
	  </script>
	  
</html>
