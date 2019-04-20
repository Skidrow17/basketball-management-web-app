
var number_of_pages = 0 ;
	var current_page = 0;
	var current_category = 0;
		

$(document).ready(function(){
		
	
		myFunction();
		n_o_p();
		
		
		
		
		
	$("#export").click(function(){
        $("#here").tableToCSV();
      });
		
		$('#export_all').click(function() {
    window.location.href = 'php/csv_export.php?id=2';
    return false;
});
		
		
		
		$("#max").click(function(){ 
      
	  if(number_of_pages!=0)
	  current_page=Math.ceil(number_of_pages-1);
	  $('#current').text(current_page);
	   var post = "current_page="+current_page;
	  
	   myFunction();
 });	

 
 
$("#min").click(function(){ 
      
	  current_page=parseInt(0);
	  $('#current').text(current_page);
	   var post = "current_page="+current_page;
	  
	   myFunction();
 });
		
		
	
	 $("#previous").click(function(){ 
      
	  if(current_page!=0)
	  {
	  current_page=current_page-1;
	  $('#current').text(current_page);
	  var post = "current_page="+current_page;
	  
	  myFunction();
	 
	  }
       
    });
	
	
	$("#next").click(function(){ 
	
	  if(current_page<number_of_pages-1)
	  {
	  current_page=current_page+1;
	  $('#current').text(current_page);
	   var post = "current_page="+current_page;
	  
	  myFunction();
	
    }
});

	
		
		
		
		
});

function myFunction() {
	
	
	var post_id ="current_page="+current_page;
	
	$.ajax({ 
        type: "POST", 
        url: "php/jquery/getUser_Update_History.php",
        data: post_id,
        success: function(result){ 
          $("#here").html(result); 
        }
      });

    
}


function n_o_p() {
	
	$.ajax({ 
        url: "php/jquery/getN_O_User_Update.php",
        success: function(result){ 
		number_of_pages = result;
		$('#current').text(0);
		if(number_of_pages!=0)
		$('#max').text(Math.ceil(number_of_pages)-1);
		else
		$('#max').text(0); 
        }
      });

}
