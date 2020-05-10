var intervalID = window.setInterval(returnwasset, 5000);
var buzzer = $("#buzzer")[0];

function returnwasset() {
  if(Math.floor(Date.now() > pollingTime)){
	  $.ajax({
		type: "POST",
		url: "php/message_notification.php",
		success: function(response) {
		  var jsonObj = JSON.parse(response);
		  if (jsonObj.code == 2) {
			window.location.replace("./php/auto_logout.php");
		  } else if (jsonObj.code != 1) {
			  buzzer.play();
			  pollingTime = jsonObj.polling_time;
			$(function() {
			  $.snackbar({ content: jsonObj.code });
			});
		  }else{
			  pollingTime = jsonObj.polling_time;
		  }
		}
	  });
  }
}
