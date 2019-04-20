function snak_fun() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}

$(document).ready(function(){
  
  $('.claimedRight').each(function (f) {

      var newstr = $(this).text().substring(0,70);
      $(this).text(newstr);

    });
})