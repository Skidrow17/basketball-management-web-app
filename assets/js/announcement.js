    var number_of_pages = 0 ;
	var current_page = 0;
	var current_category = 0;
	
$(document).ready(function(){
	
	
		n_o_g();
		myFunction();
		
	 $("#previous").click(function(){ 
      
	  if(current_page!=0)
	  {
	  current_page=current_page-1;
	  
	  var post = "current_page="+current_page;
	   $('#current').text(current_page);
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getAnnouncements.php",
        data: post,
        success: function(result){ 
          if(result!='error')
          $("#here").html(result); 
		else
		   location.reload(); 
        }
      });
	 
	  }
       
    });
	
	
	$("#next").click(function(){ 
      
	  if(current_page<number_of_pages-1)
	  {
	  current_page=current_page+1;
	  
	   var post = "current_page="+current_page;
	   $('#current').text(current_page);
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getAnnouncements.php",
        data: post,
        success: function(result){ 
          if(result!='error')
          $("#here").html(result); 
		else
		   location.reload();
        }
      });
	
    }
});




$("#max").click(function(){ 
      
	  current_page=Math.ceil(number_of_pages-1);
	  $('#current').text(current_page);
	   var post = "current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getAnnouncements.php",
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
        url: "php/jquery/getAnnouncements.php",
        data: post,
        success: function(result){ 
          if(result!='error')
			$("#here").html(result); 
		  else
		   location.reload();
        }
      });
 });	

});
	
	
function myFunction() {
	
	
	var post_id = "current_page=0";
	
	$.ajax({ 
        type: "POST", 
        url: "php/jquery/getAnnouncements.php",
        data: post_id,
        success: function(result){ 
		//alert(result);
		
		if(result!='error')
          $("#here").html(result); 
		else
		   location.reload();

        }
      });

    
}


function n_o_g() {
	$.ajax({ 
        url: "php/jquery/getN_O_Announcements.php",
        success: function(result){ 
		number_of_pages = result;
		
		 $('#current').text(0);
		  $('#max').text(Math.ceil(number_of_pages-1));
       //alert(result);
        }
      });

}