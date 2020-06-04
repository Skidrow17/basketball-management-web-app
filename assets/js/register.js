$(document).ready(function () {

    $('#name,#surname,#username').on('keypress', function (event) {
        var regex = new RegExp("^[a-zA-Zα-ωΑ-Ω]+$");
        var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
        if (!regex.test(key)) {
           event.preventDefault();
           return false;
        }
    });


    $("#submit").on("click", function (event) {
        var form = $('#user_form')[0];

        if(form.checkValidity()) {
            //stop submit the form, we will post it manually.
            event.preventDefault();

            // Create an FormData object
            var data = new FormData(form);

            // If you want to add an extra field for the FormData
            data.append("CustomField", "This is some extra data, testing");
            
            // disabled the submit button
            $("#submit").prop("disabled", true);

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "./php/insert/insert_user.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function (data) {
                    $("#result").text(data);
                    autologout(data);
                    $.snackbar({ content: data });
                    $("#submit").prop("disabled", false);
                },
                error: function (e) {
                    $("#result").text(e.responseText);
                    $.snackbar({ content: e });
                    $("#submit").prop("disabled", false);
                }
            });
        }else {
            console.log("invalid form");
        }
    });        
});