$(document).ready(function() {
    $("#team_category").change(function() {
        var category = $(this).val();
        var post_id = "cid=" + category;

        $.ajax({
            type: "POST",
            url: "php/jquery/getTeam_By_Category.php",
            data: post_id,
            success: function(result) {
				autologout(result);
                $("#team1").html(result);
                $("#team2").html(result);
            }
        });
    });

    var r1;
    var r2;

    $("#team1").change(function() {
        r1 = $("#team1").val();
        hideAndShow();
    });

    $("#team2").change(function() {
        r2 = $("#team2").val();
        hideAndShow();
    });

    $('#time').timepicker({ format: 'HH:mm' }); 

    function hideAndShow() {
        $("#team1 option").show();
        $("#team2 option").show();
        $("#team1 option[value='" + r2 + "']").hide();
        $("#team2 option[value='" + r1 + "']").hide();
    }

});