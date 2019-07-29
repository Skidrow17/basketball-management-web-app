$(document).ready(function() {
  $("#delete_category").click(function() {
    var category = $("#team_category").val();
    var post_id = "team_category=" + category;
    if (confirm("Είσται σίγουρος;")) {
      $.ajax({
        type: "POST",
        url: "php/delete/delete_category.php",
        data: post_id,
        success: function(result) {
		  autologout(result);
          $.snackbar({ content: result });
          location.reload();
        }
      });
    }
  });

  $("#delete_city").click(function() {
    var category = $("#city").val();
    var post_id = "city_id=" + category;
    if (confirm("Είσται σίγουρος;")) {
      $.ajax({
        type: "POST",
        url: "php/delete/delete_city.php",
        data: post_id,
        success: function(result) {
		  autologout(result);
          location.reload();
        }
      });
    }
  });

  $("#delete_user_category").click(function() {
    var category = $("#user_category").val();
    var post_id = "user_id=" + category;

    if (confirm("Είσται σίγουρος;")) {
      $.ajax({
        type: "POST",
        url: "php/delete/delete_user_category.php",
        data: post_id,
        success: function(result) {
		  autologout(result);
          location.reload();
        }
      });
    }
  });

  $("#delete_team").click(function() {
    if (confirm("Είσται σίγουρος;")) {
      var category = $("#teams").val();
      var post_id = "team_id=" + category;

      $.ajax({
        type: "POST",
        url: "php/delete/delete_team.php",
        data: post_id,
        success: function(result) {
		  autologout(result);
          location.reload();
        }
      });
    }
  });
});
