var number_of_pages = 0;
var current_page = 0;
var current_category = 0;

$(document).ready(function() {
  myFunction();
  n_o_p();

  $("#export").click(function() {
    $("#here").tableToCSV();
  });

  $("#export_all").click(function() {
    window.location.href = "php/csv_export.php?id=3";
    return false;
  });

  $("#max").click(function() {
    if (number_of_pages != 0) current_page = Math.ceil(number_of_pages - 1);
    $("#current").text(current_page);
    var post = "current_page=" + current_page;

    myFunction();
  });

  $("#min").click(function() {
    current_page = parseInt(0);
    $("#current").text(current_page);
    var post = "current_page=" + current_page;

    myFunction();
  });

  $("#previous").click(function() {
    if (current_page != 0) {
      current_page = current_page - 1;
      $("#current").text(current_page);
      var post = "current_page=" + current_page;
      myFunction();
    }
  });

  $("#next").click(function() {
    if (current_page < number_of_pages - 1) {
      current_page = current_page + 1;
      $("#current").text(current_page);
      var post = "current_page=" + current_page;

      myFunction();
    }
  });
});

function myFunction() {
  var post_id = "current_page=" + current_page;

  $.ajax({
    type: "POST",
    url: "php/jquery/getUserLogin_History.php",
    data: post_id,
    success: function(result) {
	  autologout(result);
    if(result.length != 229){
		  spinnerActivation();
		  $("#here").html(result);
	  }else {
		  $("#noData").fadeIn(1000);
		  $("#spinnerPanel").hide();
	  }    
	}
  });
}


function n_o_p() {
  $.ajax({
    url: "php/jquery/getN_O_UserLogin_History.php",
    success: function(result) {
	  autologout(result);
      number_of_pages = result;
      $("#current").text(0);
      if (number_of_pages != 0) $("#max").text(Math.ceil(number_of_pages) - 1);
      else $("#max").text(0);
    }
  });
}

function spinnerActivation() {
    $("#showHistory").fadeIn(1000);
    $("#spinnerPanel").hide();
}
