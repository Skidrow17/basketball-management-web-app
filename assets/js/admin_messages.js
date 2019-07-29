var number_of_pages = 0;
var current_page = 0;
var current_category = 0;
var type1 = "";
$("#apear2").hide();

$(document).ready(function() {
	
  if($("#receiver_id").val()==null)
	  autologout(401);
  
  console.log($("#receiver_id").val());
  
  $("#incomming,#outgoing").click(function() {
    var category = $(this).val();
    current_category = category;

    if (category == 1) {
      n_o_p("getN_O_Incomming_Messages_By_User.php");
      myFunction("getIncomming_Messages_By_User.php");
      type1 = "getIncomming_Messages_By_User.php";
    } else if (category == 2) {
      n_o_p("getN_O_Outgoing_Messages_By_User.php");
      myFunction("getOutgoing_Messages_By_User.php");
      type1 = "getOutgoing_Messages_By_User.php";
    }

    $("#hide").hide();
    team_category.innerText = $(this).text();
    $("#apear")
      .delay(1000)
      .show();
    $("#next").show();
    $("#previous").show();
  });

  $("#back").click(function() {
    $("#apear").hide();
    $("#hide").show();
    current_page = 0;
  });

  $("#back2").click(function() {
    $("#apear2").hide();
    $("#apear").show();
  });

  $("#back3").click(function() {
    $("#sent").hide();
    $("#hide").show();
  });

  $("#back2").click(function() {
    var post = "current_page=" + current_page;

    $.ajax({
      type: "POST",
      url: "php/jquery/" + type1,
      data: post,
      success: function(result) {
		autologout(result);
        $("#table").html(result);
      }
    });
  });

  $("#previous").click(function() {
    if (current_page != 0) {
      current_page = current_page - 1;
      $("#current").text(current_page);
      var post = "current_page=" + current_page;

      $.ajax({
        type: "POST",
        url: "php/jquery/" + type1,
        data: post,
        success: function(result) {
		  autologout(result);
          $("#table").html(result);
        }
      });
    }
  });

  $("#next").click(function() {
    if (current_page < number_of_pages - 1) {
      current_page = current_page + 1;
      $("#current").text(current_page);
      var post = "current_page=" + current_page;

      $.ajax({
        type: "POST",
        url: "php/jquery/" + type1,
        data: post,
        success: function(result) {
		  autologout(result);
          $("#table").html(result);
        }
      });
    }
  });

  $("#table").on("click", "#delete_btn", function() {
    var btn = $(this).val();

    getMessage(btn);
  });

  $("#table").on("click", "#message_delete", function() {
    var mid = $(this).val();

    var post = "message_id=" + mid + "&current_category=" + current_category;

    $.ajax({
      type: "POST",
      url: "php/update/update_message.php",
      data: post,
      success: function(result) {
		autologout(result);
        $.snackbar({ content: result });
      }
    });

    if (current_category == 1) {
      n_o_p("getN_O_Incomming_Messages_By_User.php");
      myFunction("getIncomming_Messages_By_User.php");
      type1 = "getIncomming_Messages_By_User.php";
    } else if (current_category == 2) {
      n_o_p("getN_O_Outgoing_Messages_By_User.php");
      myFunction("getOutgoing_Messages_By_User.php");
      type1 = "getOutgoing_Messages_By_User.php";
    }
  });

  $("#max").click(function() {
    if (number_of_pages != 0) current_page = Math.ceil(number_of_pages - 1);
    $("#current").text(current_page);
    var post = "current_page=" + current_page;

    $.ajax({
      type: "POST",
      url: "php/jquery/" + type1,
      data: post,
      success: function(result) {
		autologout(result);
        $("#table").html(result);
      }
    });
  });

  $("#min").click(function() {
    current_page = parseInt(0);
    $("#current").text(current_page);
    var post = "current_page=" + current_page;

    $.ajax({
      type: "POST",
      url: "php/jquery/" + type1,
      data: post,
      success: function(result) {
		autologout(result);
        $("#table").html(result);
      }
    });
  });

  $("#sent_message").click(function() {
    $("#hide").hide();
    $("#sent").show();
  });
});

function myFunction(type) {
  var post_id = "current_page=0";

  $.ajax({
    type: "POST",
    url: "php/jquery/" + type,
    data: post_id,
    success: function(result) {
	  autologout(result);
      $("#table").html(result);
    }
  });
}

function n_o_p(type) {
  $.ajax({
    url: "php/jquery/" + type,
    success: function(result) {
	  autologout(result);
      number_of_pages = result;
      $("#current").text(0);
      if (number_of_pages != 0) $("#max").text(Math.ceil(number_of_pages) - 1);
      else $("#max").text(0);
    }
  });
}

function getMessage(message_id) {
  var post_id = "s_o_r=" + current_category + "&message_id=" + message_id;

  $.ajax({
    type: "POST",
    url: "php/jquery/getMessage_By_ID.php",
    data: post_id,
    success: function(result) {
	  autologout(result);
      $("#hide").hide();
      $("#apear").hide();
      $("#apear2").show();
      $("#here").html(result);
    }
  });
}
