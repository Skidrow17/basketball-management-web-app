 $(document).ready(function(){

  

  $("#team_category").change(function(){
      var category = $(this).val();
	  var post_id = 'cid='+ category;
	 
      $.ajax({ 
        type: "POST", 
        url: "php/jquery/getTeam_By_Category.php",
        data: post_id,
        success: function(result){ 
          $("#team1").html(result); 
		  $("#team2").html(result); 
        }
      });

    });


  
 
  
  $("#team1").change(function(){
	 var id = $( "#team1" ).val();
	   $('option[disabled]').prop('disabled', false);
	   $("#team2 option[value='"+id+"']").prop('disabled',true);
  });
  
  
  $("#team2").change(function(){
	 var id = $( "#team2" ).val();
	  $('option[disabled]').prop('disabled', false);
	   $("#team1 option[value='"+id+"']").prop('disabled',true);
  });
  
 
/*
  $("select").change(function() {   
  $('option[disabled]').prop('disabled', false);
    $("select").not(this).find("option[value="+ $(this).val() + "]").attr('disabled', true);
  });
  */
  
  
 
}); 