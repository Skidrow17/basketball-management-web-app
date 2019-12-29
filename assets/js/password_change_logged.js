$(document).ready(function() {
    console.log("Prodyna");
    $("#passwrod_change_request").click(function() {
        $.ajax({
            type: "POST",
            url: "php/jquery/passwordRecover.php",
            success: function(result) {
                $.snackbar({
                    content: result
                });
            }
        });
    });
});