var number_of_pages = 0;
var current_page = 0;
var current_category = 0;

$(document).ready(function() {
	var post_id = "current_page=0";
    n_o_g();
    getAnnoucements(post_id);

    $("#previous").click(function() {
        if (current_page != 0) {
            current_page = current_page - 1;
            $("#current").text(current_page);
            var post = "current_page=" + current_page;
            getAnnoucements(post);
        }
    });
	
    $("#next").click(function() {
        if (current_page < number_of_pages - 1) {
            current_page = current_page + 1;
            $("#current").text(current_page);
            var post = "current_page=" + current_page;
			getAnnoucements(post);
        }
    });

    $("#here").on("click", "#delete", function() {
        var btn = $(this).val();
        var post_id = "aid=" + btn;
        $.ajax({
            type: "POST",
            url: "php/delete/delete_announcement.php",
            data: post_id,
            success: function(result) {
                autologout(result);
                $.snackbar({
                    content: result
                });
                n_o_g();
				current_page = 0;
                var post = "current_page=0";
				getAnnoucements(post);
            }
        });
    });

    $("#here").on("click", "#modify", function() {
        var btn = $(this).val();
        var message = $("#message").val();
        var title = $("#u_title").text();
        var post_id = "aid=" + btn + "&message=" + message + "&title=" + title;

        $.ajax({
            type: "POST",
            url: "php/update/update_announcement.php",
            data: post_id,
            success: function(result) {
                autologout(result);
                $.snackbar({
                    content: result
                });
                var post = "current_page=" + current_page;
				getAnnoucements(post);
            }
        });
    });

    $("#max").click(function() {
        current_page = Math.ceil(number_of_pages - 1);
        $("#current").text(current_page);
        var post = "current_page=" + current_page;
		getAnnoucements(post);
    });

    $("#min").click(function() {
        current_page = parseInt(0);
        $("#current").text(current_page);
        var post = "current_page=" + current_page;
		getAnnoucements(post);
    });
});

function getAnnoucements(post_id) {
	$("#spinnerPanel").show();
    $.ajax({
        type: "POST",
        url: "php/jquery/getAnnouncements_By_User.php",
        data: post_id,
        success: function(result) {
			autologout(result);
			if(number_of_pages != 0){
				spinnerActivation();
				$("#here").html(result);
			}else {
				console.log(number_of_pages);
				$("#noData").fadeIn(1000);
				$("#spinnerPanel").hide();
			}
        }
    });
}

function n_o_g() {
    $.ajax({
        url: "php/jquery/getN_O_Announcements_By_User.php",
        success: function(result) {
            autologout(result);
            number_of_pages = result;
            $("#current").text(0);
            $("#max").text(Math.ceil(number_of_pages - 1));
        }
    });
}

function spinnerActivation() {
    $("#announcementPanel").fadeIn(1000);
    $("#spinnerPanel").hide();
}