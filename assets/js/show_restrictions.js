var number_of_pages = 0;
var current_page = 0;
var current_category = 0;
var default_date = get_current_date();


$(document).ready(function() {
  myFunction(default_date);
  n_o_p(default_date);

  document.getElementById("date").addEventListener("change", function() {
    var inputDate = this.value;
    default_date = inputDate;
    myFunction(default_date);
    n_o_p(default_date); 
  });

  document.getElementById("date").value = default_date;

  $("#export").click(function() {
    $("#here").tableToCSV();
  });

  $("#export_all").click(function() {
    window.location.href = "php/csv_export.php?id=1&date_from="+default_date;
    return false;
  });

  $("#max").click(function() {
    if (number_of_pages != 0) current_page = Math.ceil(number_of_pages - 1);
    $("#current").text(current_page);
    var post = "current_page=" + current_page;

    myFunction(default_date);
  });

  $("#min").click(function() {
    current_page = parseInt(0);
    $("#current").text(current_page);
    var post = "current_page=" + current_page;

    myFunction(default_date);
  });

  $("#previous").click(function() {
    if (current_page != 0) {
      current_page = current_page - 1;
      $("#current").text(current_page);
      var post = "current_page=" + current_page;

      myFunction(default_date);
    }
  });

  $("#next").click(function() {
    if (current_page < number_of_pages - 1) {
      current_page = current_page + 1;
      $("#current").text(current_page);
      var post = "current_page=" + current_page;

      myFunction(default_date);
    }
  });
});

function myFunction(inputdate) {
  var post_id = "current_page=" + current_page+"&date_from="+inputdate;;

  $.ajax({
    type: "POST",
    url: "php/jquery/getRestrictions.php",
    data: post_id,
    success: function(result) {
	  autologout(result);
      $("#here").html(result);
    }
  });
}

function n_o_p(inputdate) {
  $.ajax({
    type: "POST",
    url: "php/jquery/getN_O_Restrictions.php",
    data: 'date_from='+inputdate,
    success: function(result) {
	  autologout(result);
      number_of_pages = result;
      $("#current").text(0);
      if (number_of_pages != 0) $("#max").text(Math.ceil(number_of_pages) - 1);
      else $("#max").text(0);
    }
  });
}
