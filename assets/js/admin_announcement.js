    var number_of_pages = 0 ;
	var current_page = 0;
	var current_category = 0;
	
$(document).ready(function(){
	
	

	var x = 0;
	var url1='';
	var url2='';
	
	$("#add,#show,#show_all").click(function(){
		x = $(this).val();
		
	if(x==2)
	{
	url1='getAnnouncements_By_User.php';
    url2='getN_O_Announcements_By_User.php';
	myFunction(url1);
	n_o_g(url2);
	}
	else if(x==3)
	{
     url1='getAnnouncements_By_Admin.php';
	 url2='getN_O_Announcements.php';
	 myFunction(url1);
	 n_o_g(url2);
	}
	
		
	});
	
	
	
	
	
	
	 $("#previous").click(function(){ 
      
	  if(current_page!=0)
	  {
	  current_page=current_page-1;
	   $('#current').text(current_page);
	  var post = "current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/"+url1,
        data: post,
        success: function(result){ 
          $("#here").html(result); 
        }
      });
	 
	  }
       
    });
	
	
	$("#next").click(function(){ 
      
	  if(current_page<number_of_pages-1)
	  {
	  current_page=current_page+1;
	   $('#current').text(current_page);
	   var post = "current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/"+url1,
        data: post,
        success: function(result){ 
  
          $("#here").html(result); 
	
        }
      });
	
    }
});



$('#here').on('click','#delete',function(){ 
  var btn = $(this).val();
  
	var post_id = "aid="+btn;
	
	$.ajax({ 
        type: "POST", 
        url: "php/delete/delete_announcement.php",
        data: post_id,
        success: function(result){ 
		// alert(result);
		 

$.snackbar({content: result});
		 n_o_g(url2);
         myFunction(url1);
        }
      });
	
	
});



$('#here').on('click','#modify',function(){ 
  var btn = $(this).val();
  
  var message =$('#message').val();
  var title =$('#u_title').text();
  
  
	var post_id = "aid="+btn+"&message="+message+"&title="+title;

		//alert(message);
		//alert(title);
		
$.ajax({ 
        type: "POST", 
        url: "php/update/update_announcement.php",
        data: post_id,
        success: function(result){ 
		 $.snackbar({content: result});
         
		 
	  var post = "current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/"+url1,
        data: post,
        success: function(result){ 
          $("#here").html(result); 
        }
      });
		 
        }
});

		 
});


$("#max").click(function(){ 
      
	  current_page=Math.ceil(number_of_pages-1);
	  $('#current').text(current_page);
	   var post = "current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
       url: "php/jquery/"+url1,
        data: post,
        success: function(result){ 
         
          $("#here").html(result); 
		
    
        }
      });
 });	

 
 
$("#min").click(function(){ 
      
	  current_page=parseInt(0);
	  $('#current').text(current_page);
	   var post = "current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
         url: "php/jquery/"+url1,
        data: post,
        success: function(result){ 
         
          $("#here").html(result); 
		
        }
      });
 });	

 
 $("#show").click(function(){ 
      $("#menu").hide();
	  $("#show_announcement").show();
	 
 });


 $("#show_all").click(function(){ 
      $("#menu").hide();
	  $("#show_announcement").show();
 });	 


  
 $("#add").click(function(){ 
      $("#menu").hide();
	  $("#add_announcement").show();
	 
 });	
 
  $("#back").click(function(){ 
	  $("#add_announcement").hide();
	  $("#menu").show();
	 
 });	
 
 $('#here').on('click','#back1',function(){ 
      $("#show_announcement").hide();
	  $("#menu").show();
	  current_page=0;
	 
 });	

 



});
	
	
function myFunction(ur) {
	
	
	var post_id = "current_page=0";
	
	
	
	$.ajax({ 
        type: "POST", 
        url: "php/jquery/"+ur,
        data: post_id,
        success: function(result){ 
		
          $("#here").html(result); 
		
        }
      });

    
}


function n_o_g(ur) {
	$.ajax({ 
        url: "php/jquery/"+ur,
        success: function(result){ 
		number_of_pages = result;
		  $('#current').text(0);
		  $('#max').text(Math.ceil(number_of_pages-1));
       //alert(result);
        }
      });

}