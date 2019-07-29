var number_of_pages = 0;
var current_page = 0;
var current_category = 0;

$(document).ready(function() {
    n_o_g();
    var post_id = "current_page=0";
    getAnnoucements(post_id);

    $("#previous").click(function() {
        if (current_page != 0) {
            current_page = current_page - 1;
            var post = "current_page=" + current_page;
            $("#current").text(current_page);
            getAnnoucements(post);
        }
    });

    $("#next").click(function() {
        if (current_page < number_of_pages - 1) {
            current_page = current_page + 1;
            var post = "current_page=" + current_page;
            $("#current").text(current_page);
            getAnnoucements(post);
        }
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
        url: "php/jquery/getAnnouncements.php",
        data: post_id,
        success: function(result) {
            autologout(result);
            spinnerActivation();
            $("#here").html(result);
        }
    });
}

function n_o_g() {
    $.ajax({
        url: "php/jquery/getN_O_Announcements.php",
        success: function(result) {
            spinnerActivation();
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