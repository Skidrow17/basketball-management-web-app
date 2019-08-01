$(document).ready(function() {
    var global_category = -1;
	var current_category = -1;
    var r1;
    var r2;

    $("#tableta").hide();
    $("#team_category").change(function() {
        var category = $(this).val();
        global_category = category;
        var post_id = "id=" + category;

        $.ajax({
            type: "POST",
            url: "php/jquery/getMatch_By_Category_Match_Update.php",
            data: post_id,
            success: function(result) {
                $("#matches").html(result);
            }
        });
    });

    $("#matches").change(function() {
        current_game = $(this).val();
        var post_id = "game_id=" + current_game + "&category_id=" + global_category;
        current_page = 0;

        $.ajax({
            type: "POST",
            url: "getMatch_By_Match_id.php",
            data: post_id,
            success: function(result) {
                $("#tableta").html(result);
                $("#tableta").show();
                r1 = $("#team1").val();
                r2 = $("#team2").val();
                hideAndShow();
            }
        });
    });

    $("#tableta").on("change", "#team1", function() {
        r1 = $("#team1").val();
        hideAndShow();
    });

    $("#tableta").on("change", "#team2", function() {
        r2 = $("#team2").val();
        hideAndShow();
    });

    function hideAndShow() {
        $("#team1 option").show();
        $("#team2 option").show();
        $("#team1 option[value='" + r2 + "']").hide();
        $("#team2 option[value='" + r1 + "']").hide();
    }
});