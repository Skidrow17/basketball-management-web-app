$(document).ready(function() {
    var number_of_pages = 0;
    var current_page = 0;
    var current_category = -1;
    var current_game = -1;

    $("#team_category").change(function() {
        var category = $(this).val();
        var post_id = "id=" + category;

        $.ajax({
            type: "POST",
            url: "php/jquery/getMatch_By_Category.php",
            data: post_id,
            success: function(result) {
				autologout(result);
                $("#matches").html(result);
                getNumberOfPages(-1);
                getRestrictionsByGame(-1);
            }
        });
    });

    $("#matches").change(function() {
        matchId = $(this).val();
        getReferee(matchId);
        getJudges(matchId);
        getNumberOfPages(matchId);
		getFloatingMessage(matchId);
		$("#news").show();
        getRestrictionsByGame(matchId);
    });

    $("#previous").click(function() {
        if (current_page != 0) {
            current_page = current_page - 1;
            var post =
                "id=" +
                current_game +
                "&current_page=" +
                current_page +
                "&categoryId=" +
                current_category;
            $.ajax({
                type: "POST",
                url: "php/jquery/getRestrictions_By_Game.php",
                data: post,
                success: function(result) {
					autologout(result);
                    $("#current").text(current_page);
                    $("#table").html(result);
                }
            });
        }
    });

    $("#next").click(function() {
        if (current_page < number_of_pages - 1) {
            current_page = current_page + 1;

            var post =
                "id=" +
                current_game +
                "&current_page=" +
                current_page +
                "&categoryId=" +
                current_category;

            $.ajax({
                type: "POST",
                url: "php/jquery/getRestrictions_By_Game.php",
                data: post,
                success: function(result) {
					autologout(result);
                    $("#current").text(current_page);
                    $("#table").html(result);
                }
            });
        }
    });

    $("#max").click(function() {
        if (number_of_pages != 0) current_page = Math.ceil(number_of_pages - 1);
        $("#current").text(current_page);

        var post =
            "id=" +
            current_game +
            "&current_page=" +
            current_page +
            "&categoryId=" +
            current_category;

        $.ajax({
            type: "POST",
            url: "php/jquery/getRestrictions_By_Game.php",
            data: post,
            success: function(result) {
				autologout(result);
                $("#current").text(current_page);
                $("#table").html(result);
            }
        });
    });

    $("#min").click(function() {
        current_page = parseInt(0);
        $("#current").text(current_page);
        var post =
            "id=" +
            current_game +
            "&current_page=" +
            current_page +
            "&categoryId=" +
            current_category;

        $.ajax({
            type: "POST",
            url: "php/jquery/getRestrictions_By_Game.php",
            data: post,
            success: function(result) {
				autologout(result);
                $("#current").text(current_page);
                $("#table").html(result);
            }
        });
    });

    $("#table").on("click", ".btn", function() {
        var restrictionId = $(this).val();

        var post = "id=" + restrictionId;
        $.ajax({
            type: "POST",
            url: "php/delete/delete_restriction.php",
            data: post,
            success: function(result) {
				autologout(result);
			}
        });

        getReferee(current_game);
        getJudges(current_game);
        getNumberOfPages(current_game);
        getRestrictionsByGame(current_game);
    });

    function getReferee(matchId) {
        var category = $("#team_category").val();
        current_category = category;
        current_game = matchId;
        var postParams = "id=" + category + "&game_id=" + current_game;
        current_page = 0;

        $.ajax({
            type: "POST",
            url: "php/jquery/getReferee_By_Category.php",
            data: postParams,
            success: function(result) {
				autologout(result);
                $("#referee1").html(result);
                $("#referee2").html(result);
                $("#previous").fadeIn(4000);
                $("#tableta").show();
                $("#show_page").fadeIn(4000);
                $("#next").fadeIn(4000);
            }
        });
    }

    function getJudges(matchId) {
        var category = $("#team_category").val();
        current_category = category;
        current_game = matchId;
        var postParams = "id=" + category + "&game_id=" + current_game;
        current_page = 0;

        $.ajax({
            type: "POST",
            url: "php/jquery/getJudge_By_Category.php",
            data: postParams,
            success: function(result) {
				autologout(result);
                $("#judge1").html(result);
                $("#judge2").html(result);
            }
        });
    }

    function getNumberOfPages(matchId) {
        var post_id = "id=" + matchId + "&categoryId=" + current_category;
        //alert(post_id);

        $.ajax({
            type: "POST",
            url: "php/jquery/getN_O_Restrictions_By_Game.php",
            data: post_id,
            success: function(result) {
				autologout(result);
                number_of_pages = result;
                $("#current").text(0);
                if (number_of_pages != 0)
                    $("#max").text(Math.ceil(number_of_pages) - 1);
                else $("#max").text(0);
            }
        });
    }
	
	function getFloatingMessage(matchId) {
        var category = $("#team_category").val();
        current_category = category;
        current_game = matchId;
        var postParams = "id=" + category + "&game_id=" + current_game;
        current_page = 0;

        $.ajax({
            type: "POST",
            url: "php/jquery/getFloatingMessage.php",
            data: postParams,
            success: function(result) {
				autologout(result);
                $("#news h3").text(result);
            }
        });
    }

    function getRestrictionsByGame(matchId) {
        var post_id =
            "id=" +
            matchId +
            "&current_page=" +
            current_page +
            "&categoryId=" +
            current_category;
        $.ajax({
            type: "POST",
            url: "php/jquery/getRestrictions_By_Game.php",
            data: post_id,
            success: function(result) {
				autologout(result);
                if (result.length != 175) {
                    $("#pagination_buttons").show();
                    $("#table").fadeOut(500);
                    $("#table").html(result);
                    $("#table").fadeIn(500);
                } else {
                    $("#table").fadeOut(2000);
                    $("#pagination_buttons").fadeOut(2000);
                }
            }
        });
    }

    var r1;
    var r2;
	
	var j1;
	var j2;



    $("#referee1").change(function() {
        r1 = $("#referee1").val();
        hideAndShowReferee();
    });

    $("#referee2").change(function() {
        r2 = $("#referee2").val();
        hideAndShowReferee();
    });

    $("#judge1").change(function() {
        j1 = $("#judge1").val();
        hideAndShowJudge();
    });

    $("#judge2").change(function() {
        j2 = $("#judge2").val();
		hideAndShowJudge();
    });
	
	
	
	function hideAndShowReferee(){
		$("#referee1 option").show();
		$("#referee2 option").show();
        $("#referee1 option[value='" + r2 + "']").hide();
        $("#referee2 option[value='" + r1 + "']").hide();
	}
	
	function hideAndShowJudge(){
		$("#judge1 option").show();
		$("#judge2 option").show();
        $("#judge1 option[value='" + j2 + "']").hide();
        $("#judge2 option[value='" + j1 + "']").hide();
	}

});