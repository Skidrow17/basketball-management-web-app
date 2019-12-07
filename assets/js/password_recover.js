$(document).ready(function() {
  
	$("#password1,#password2").keyup(function(){
	
	
		if($('#password1').val().length >= 5){
		   if(($("#password1").val() === $("#password2").val())){
			$("#progress").text("Οι κωδικοί ταιριάζουν");
			  $(":submit").attr("disabled", false);
		   }else{
			$("#progress").text("Οι κωδικοί δεν ταιριάζουν");
			  $(":submit").attr("disabled", true);
		   }
		}else{
			$("#progress").text("Ο κωδικός πρέπει να είναι μεγαλύτερος απο 5 χαρακτήρες");
			  $(":submit").attr("disabled", true);
		}
		
	});
	
});

