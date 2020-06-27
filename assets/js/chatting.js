
var firebase_contact = 0;
var firebase_message = '';
messaging.onMessage(function(payload) {
    console.log("Message received. ",payload);
    firebase_contact = payload.data.title.split("/");

    if(contact_id == firebase_contact[1] && contact_id != 0){
        console.log();
        var post = "contact_id=" + contact_id;
        getChattingMessages(post);
    }
    $("#scrolled_bottom").animate({ scrollTop: 113000 }, 1000);

});




$(document).ready(function(){
    var chatts_or_contacts = 1;
    searchChats('');

    if(contact_id !== 0){
        post = "contact_id=" + contact_id;
        getChattingMessages(post);
        $("#scrolled_bottom").animate({ scrollTop: 113000 }, 1000);
    }

    $('#chats').css('background-color','rgb(247, 211, 173)');

    $('#action_menu_btn').click(function(){
        var post = "contact_id=" + contact_id;
        getChattingMessages(post);
        $("#scrolled_bottom").animate({ scrollTop: 113000 }, 1000);
    });


    $('#button_send').click(function(){

        if($('#text_send').val().length !== 0 && contact_id !== 0){
            $(".messages_add").append(`<div class="d-flex justify-content-end mb-4">
                                        <div class="msg_cotainer_send">
                                            `+$('#text_send').val()+`
                                            <span class="msg_time_send"></span>
                                        </div>
                                    </div>`);

            var post = "receiver_id=" + contact_id+"&text="+$('#text_send').val();
            $.ajax({
                type: "POST",
                url: "php/jquery/sent_message.php",
                data: post,
                success: function(result) {
                    $("#text_send").val("");
                }
            });

            post = "contact_id=" + contact_id;
            getChattingMessages(post);
            $("#scrolled_bottom").animate({ scrollTop: 113000 }, 1000);
        }
        
    });


    $("#search_id").unbind().keyup(function(e) {
    var value = $(this).val();
        if(chatts_or_contacts === 0){
            searchData(value);
        }
        else{
            searchChats(value);
        }
    });

    $(".contacts_add").on("click", "#contact_id", function() {
        contact_id = $(this).val();
        var post = "contact_id=" + contact_id;
        getChattingMessages(post);

        $.ajax({
            type: "POST",
            url: "php/jquery/getContactInfo.php",
            data: post,
            success: function(result) {
                $(".contact_info").html(result);
            }
        });
        $("#scrolled_bottom").animate({ scrollTop: 113000 }, 1000);
    });


    $('#contacts').click(function(){
        $('#chats').css('background-color','white');
        $('#contacts').css('background-color','rgb(247, 211, 173)');
        chatts_or_contacts = 0;
        searchData('');
    });

    $('#chats').click(function(){
        $('#chats').css('background-color','rgb(247, 211, 173)');
        $('#contacts').css('background-color','white');
        chatts_or_contacts = 1;
        searchChats('');
    });

    

});





function searchData(val) {			
    var post = "search=%" + val + "%";
    $.ajax({
      type: "POST",
      url: "php/jquery/dynamic_contacts.php",
      data: post,
      success: function(result) {
        $(".contacts_add").html(result);
      }
    });
}

function searchChats(val) {			
    var post = "search=%" + val + "%";
    $.ajax({
      type: "POST",
      url: "php/jquery/getUserChats.php",
      data: post,
      success: function(result) {
        $(".contacts_add").html(result);
      }
    });
}

function getChattingMessages(post){
    $.ajax({
        type: "POST",
        url: "php/jquery/getChats.php",
        data: post,
        success: function(result) {
            $(".messages_add").html(result);
        }
    })
}
