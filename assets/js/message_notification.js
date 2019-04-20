var intervalID = window.setInterval(returnwasset, 5000);
var buzzer = $('#buzzer')[0];  

        function returnwasset(){
            $.ajax({
                type: "POST",
                url: "php/message_notification.php",
             
                success: function(response){
					
					if(response==2)
					{
						window.location.replace("./php/auto_logout.php");
						
					}
					else if(response!=1)
					{
						$(function() {
						$.snackbar({content: response}); });
						buzzer.play();
					}
					
                }
            });
        }