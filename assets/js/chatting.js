$(document).ready(function(){
    var contact_id = 0;
    searchData('');
    //setInterval(updateScroll, 1000);

    $('#action_menu_btn').click(function(){
        var post = "contact_id=" + contact_id;
        $.ajax({
            type: "POST",
            url: "php/jquery/getChats.php",
            data: post,
            success: function(result) {
                $(".messages_add").html(result);
            }
        });
    });


    $('#button_send').click(function(){

        if($('#text_send').val().length !== 0 && contact_id !== 0){
            var d = new Date($.now());
            var current_date = d.getDate()+"-"+(d.getMonth() + 1)+"-"+d.getFullYear()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
            $(".messages_add").append(`<div class="d-flex justify-content-end mb-4">
                                        <div class="msg_cotainer_send">
                                            `+$('#text_send').val()+`
                                            <span class="msg_time_send">`+current_date+`</span>
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
            $.ajax({
                type: "POST",
                url: "php/jquery/getChats.php",
                data: post,
                success: function(result) {
                    $(".messages_add").html(result);
                }
            });
        }
    });


    $("#search_id").unbind().keyup(function(e) {
    var value = $(this).val();
        searchData(value);
    });

    $(".contacts_add").on("click", "#contact_id", function() {
        contact_id = $(this).val();
        var post = "contact_id=" + contact_id;
        $.ajax({
            type: "POST",
            url: "php/jquery/getChats.php",
            data: post,
            success: function(result) {
                $(".messages_add").html(result);
            }
        });
        
        $('.scrolled_bottom').scrollTop($('ul li').last().position().top + $('ul li').last().height());

        $.ajax({
            type: "POST",
            url: "php/jquery/getContactInfo.php",
            data: post,
            success: function(result) {
                $(".contact_info").html(result);
            }
        });

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


function updateScroll(){
    var element = document.getElementById("scrolled_bottom");
    element.scrollTop = element.scrollHeight;
}