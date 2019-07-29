function autologout(response) {	
	if(response == 401) {
		window.location.replace("./php/auto_logout.php");
		wait(2000);
	}
}