function autologout(response) {	
	if(response == 401 || response == 'HTTP/1.0 401 Unauthorized') {
		window.location.replace("./php/auto_logout.php");
		wait(2000);
	}
}