$(document).ready(function() {

	var group = 0;
	var category = 0;

	$("#team_category").change(function() {
		if($(this).val() != ''){
			category = $(this).val();
			group = 0;
			var post_id = "cid=" + category+"&gid="+group;
			$.ajax({
			type: "POST",
			url: "php/jquery/getGroups.php",
			data: post_id,
			success: function(result) {
				autologout(result);
				if(result != 0){
					$("#groups").html(result);
					$("#ranking_table").html('');
					$("#group_text").show();
					$("#submit").hide();
				}else{
					$("#groups").html(result);
					$("#group_text").hide();
					showTable(post_id);
				}
			}
			});
		}else{
			$("#submit").hide();
			$("#ranking_table").html('');
		}
	});

	$("#groups").on("change", "#group", function() {
		group = $(this).val();
		if(group != ''){
			var post_id = "cid=" + category +"&gid="+group;
			showTable(post_id);
		}else{
			$("#submit").hide();
			$("#ranking_table").html('');
		}
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

function showTable(post_id) {
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
}


function testCharacter(event) {
	var myVal = event.target.textContent.length;
	if (myVal < 3 && ((event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 13)) {
		return true;
	} else {
		return false;
	}
}
