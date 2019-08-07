function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	  autologout(this.responseText);
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "php/jquery/get_user_by_user_id.php?q=" + str, true);
  xmlhttp.send();
}
