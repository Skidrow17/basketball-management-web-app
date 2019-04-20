    var number_of_pages = 0 ;
	var current_page = 0;
	var current_category = 0;
	
$(document).ready(function(){
	
	
		n_o_g();
		myFunction();
		
	 $("#restriction").click(function(){
		
		$('#hide').hide();
		$('#single').show();
	 }); 

	$("#multiple_restriction").click(function(){
		$('#hide').hide();
		$('#multiple').show();
	
	 });	 

    $("#back").click(function(){
        $('#single').hide();
		$('#hide').show();
		
    });	 
	
	$("#back2").click(function(){
		$('#multiple').hide();
		$('#hide').show();
		
    });	 
		
		
		
	 $("#previous").click(function(){ 
      
	  if(current_page!=0)
	  {
	  current_page=current_page-1;
	   $('#current').text(current_page);
	  var post = "current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getRestrictions_By_User.php",
        data: post,
        success: function(result){ 
          $("#table").html(result); 
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
        url: "php/jquery/getRestrictions_By_User.php",
        data: post,
        success: function(result){ 
          $("#table").html(result); 
        }
      });
	
    }
});

$("#max").click(function(){ 
      
	  if(number_of_pages!=0)
	  current_page=Math.ceil(number_of_pages-1);
	  $('#current').text(current_page);
	   var post = "current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getRestrictions_By_User",
        data: post,
        success: function(result){ 
          $("#table").html(result); 
        }
      });
 });	

 
 
$("#min").click(function(){ 
      
	  current_page=parseInt(0);
	  $('#current').text(current_page);
	   var post = "current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getRestrictions_By_User",
        data: post,
        success: function(result){ 
          $("#table").html(result); 
        }
      });
 });	

 
 $('#table').on('click','#delete_btn',function(){ 
  var rid = $(this).val();

   var post = "restriction_id="+rid;
  
		$.ajax({ 
        type: "POST", 
        url: "php/delete/delete_restriction_by_user.php",
        data: post,
        success: function(result){ 
          $.snackbar({content: result});
		  n_o_g();
		  myFunction();
        }
      });
	  
});
 
 


});
	
	
function myFunction() {
	
	
	var post_id = "current_page=0";
	
	$.ajax({ 
        type: "POST", 
        url: "php/jquery/getRestrictions_By_User.php",
        data: post_id,
        success: function(result){ 
		//alert(result);
		
          $("#table").html(result); 
        }
      });

    
}


function n_o_g() {
	$.ajax({ 
        url: "php/jquery/getN_O_Restrictions_By_User.php",
        success: function(result){ 
		number_of_pages = result;
		$('#min').text(0);
		$('#current').text(0);
		if(number_of_pages!=0)
		$('#max').text(Math.ceil(number_of_pages)-1);
		else
		$('#max').text(0); 
        }
       // alert(result);
        
      });

}