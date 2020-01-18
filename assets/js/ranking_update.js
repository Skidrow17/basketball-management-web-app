$(document).ready(function() {
	
	$("#team_category").change(function() {
	var category = $(this).val();
	var post_id = "cid=" + category;

	$.ajax({
	  type: "POST",
	  url: "php/jquery/get_league_by_league_id.php",
	  data: post_id,
	  success: function(result) {
		autologout(result);
		$("#ranking_table").html(result);
		$("#submit").show();
	  }
	});
	});

	$( "#submit" ).click(function() {
		var ranking_table = $('#ranking_table tr').get().map(function(row) {
				return $(row).find('td').get().map(function(cell) {
				return $(cell).html();
			});
		});

		$.ajax({
			url: "php/update/update_ranking.php",
			type: "POST",
			data: JSON.stringify(ranking_table),
			success: function(result){
			  autologout(result);
			  $.snackbar({ content: result });
			}
		   });
		});

});
