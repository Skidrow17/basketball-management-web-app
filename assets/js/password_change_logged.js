$(document).ready(function() {
    $("#password_change_request").click(function() {
        $.ajax({
            type: "POST",
            url: "php/jquery/passwordRecover.php",
            success: function(result) {
                $.snackbar({
                    content: result
                });
                $('#password_change_request').attr('disabled', 'disabled');
            }
        });
    });
});