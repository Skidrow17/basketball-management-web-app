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

$(document).ready(function() {
  
  $('#txtHint').on('keypress','#name,#surname,#username', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9ά-ωΑ-ώ]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
  });

});
