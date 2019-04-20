$(document).ready(function(){

    $("#city").change(function(){ 
	   $("#city_name").val($("#city option:selected").text());
    });
	
  
    $("#team_category").change(function(){ 
	 $("#team_category_name").val($("#team_category option:selected").text());
    });
	
	
    $("#user_category").change(function(){ 
	  $("#user_category_name").val($("#user_category option:selected").text());
    });
	



$('#team_category').change(function(){
	$("#team_category2").val($(this).val());
});



$("#team_category").change(function(){
      var category = $(this).val();
	  var post_id = 'cid='+ category;
	 
      $.ajax({ 
        type: "POST", 
        url: "php/jquery/getTeam_By_Category.php",
        data: post_id,
        success: function(result){ 
          $("#teams").html(result); 
		  
        }
      });

    });
	
	
$("#teams").change(function(){
      
	 $("#team_name").val($("#teams option:selected").text());
	 
    });

});

