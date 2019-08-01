$(document).ready(function() {
  var number_of_pages = 0;
  var current_page = 0;
  var current_category = -1;
  var current_game = -1;

  $("#tableta").hide();
  var current_category = -1;

  $("#team_category").change(function() {
    var category = $(this).val();
    var post_id = "id=" + category;

    $.ajax({
      type: "POST",
      url: "php/jquery/getMatch_By_Category_Match_Update.php",
      data: post_id,
      success: function(result) {
		autologout(result);
		$(".pagination").show();
        $("#matches").html(result);
      }
    });
  });

  $("#matches").change(function() {
    var game = $(this).val();
    var post_id = "game_id=" + game;
    current_game = game;
    getNOPHumanPower(post_id);
  });

  $("#matches").change(function() {
    current_game = $(this).val();
    var post_id = "game_id=" + current_game + "&current_page=" + current_page;
    current_page = 0;
    $("#tableta").show();
	getHumanPower(post_id);
  });

  $("#previous").click(function() {
    if (current_page != 0) {
      current_page = current_page - 1;
	   $("#current").text(current_page);
      var post = "game_id=" + current_game + "&current_page=" + current_page;
	  getHumanPower(post);
    }
  });

  $("#next").click(function() {
    if (current_page < number_of_pages - 1) {
      current_page = current_page + 1;
	   $("#current").text(current_page);
      var post = "game_id=" + current_game + "&current_page=" + current_page;
	  getHumanPower(post);
    }
  });
  
  $("#max").click(function() {
    if (number_of_pages != 0) current_page = Math.ceil(number_of_pages - 1);
    $("#current").text(current_page);
    var post = "game_id="+current_game+"&current_page=" + current_page;
	getHumanPower(post);
  });

  $("#min").click(function() {
    current_page = parseInt(0);
    $("#current").text(current_page);
    var post = "game_id="+current_game+"&current_page=" + current_page;
	getHumanPower(post);
  });

  $("#table").on("click", ".btn", function() {
    var btn = $(this).val();

    var post = "id=" + btn + "&game_id=" + current_game;
    $.ajax({
      type: "POST",
      url: "php/delete/delete_human_power.php",
      data: post,
      success: function(result) {
		autologout(result);
        var post_id = "id=" + current_game + "&current_page=0";
        $.snackbar({ content: result });
		getNOPHumanPower(post_id);
        var post = "game_id=" + current_game + "&current_page=" + current_page;
        getHumanPower(post);
      }
    });
  });
  
  
  function getNOPHumanPower(params){
	$.ajax({
	  type: "POST",
	  url: "php/jquery/getN_O_Human_Power_By_Game.php",
	  data: params,
	  success: function(result) {
		autologout(result);
		number_of_pages = result;
		if (number_of_pages != 0) $("#max").text(Math.ceil(number_of_pages) - 1);
        else $("#max").text(0);
	  }
	});
  }
  
  function getHumanPower(params){
	  $.ajax({
        type: "POST",
        url: "php/jquery/getHuman_Power_By_Game.php",
        data: params,
        success: function(result) {
		  autologout(result);
          $("#table").html(result);
        }
      });
  }
});
