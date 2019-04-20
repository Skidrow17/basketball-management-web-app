 $(document).ready(function(){

 
 $("#tableta").hide();

 var number_of_pages = 0;
 var current_page=0;
 var current_category=-1;
 var current_game=-1;


  
    $("#team_category").change(function(){ 
      var category = $(this).val(); 
	  var post_id = 'id='+ category;
	 
      $.ajax({ 
        type: "POST", 
        url: "php/jquery/getMatch_By_Category.php", 
        data: post_id, 
        success: function(result){ 
		 
          $("#matches").html(result);
		  
		 //		 alert(result);
        }
      });

    });
	
	
	 $("#matches").change(function(){ 
      var category = $("#team_category").val();
	  current_category=category;
	  current_game = $(this).val();
	  var post_id = 'id='+ category+"&game_id="+current_game;
	  current_page=0;
	  
	
      $.ajax({ 
        type: "POST", 
        url: "php/jquery/getReferee_By_Category.php", 
        data: post_id, 
        success: function(result){ 
          $("#referee1").html(result); 
		  $("#referee2").html(result);
		  $("#referee3").html(result);
		  $("#referee4").html(result);
		  $("#previous").fadeIn(4000);
		  $("#tableta").show();
		  $("#show_page").fadeIn(4000);
          $("#next").fadeIn(4000);
		  
		 
        }
      });

    });
	
	
	
	  $("#matches").change(function(){ 
      var category = $(this).val(); 
	  var post_id = 'id='+ category;
	   
      $.ajax({ 
        type: "POST", 
        url: "php/jquery/getJudge_By_Category.php", 
        data: post_id, 
        success: function(result){ 
		  
		  $("#judge1").html(result); 
		  $("#judge2").html(result);
		  $("#judge3").html(result);
		  $("#judge4").html(result);
		  
        }
      });
	
	 });
	 
	 
	$("#matches").change(function(){
      var category = $(this).val(); 
	  var post_id = 'id='+ category;
	   //alert(post_id);
     

      $.ajax({ 
        type: "POST", 
        url: "php/jquery/getN_O_Restrictions_By_Game.php", 
        data: post_id, 
        success: function(result){ 
			//alert(result);
			number_of_pages=result;
			
		$('#current').text(0);
		if(number_of_pages!=0)
		$('#max').text(Math.ceil(number_of_pages)-1);
		else
		$('#max').text(0); 
			
        }
      });

    });




	
	 $("#matches").change(function(){ 
      var category = $(this).val(); 
	  var post_id = 'id='+ category+"&current_page="+current_page;
	 
      $.ajax({
        type: "POST", 
        url: "php/jquery/getRestrictions_By_Game.php",
        data: post_id, 
        success: function(result){ 
		  if(result.length!=175){
		  $('#pagination_buttons').show();
		  $('#table').fadeOut(1000);
          $("#table").html(result); 
          $('#table').fadeIn(1000);
		  }
		  else
		  {
			$('#table').fadeOut(2000);
			$('#pagination_buttons').fadeOut(2000);
		  }
        }
      });

    });
	 
	 
	 
	 
	  $("#submit").click(function(){ 

	/*	if(($( "#referee1" ).val()==$( "#referee2" ).val())||($( "#referee1" ).val()==$( "#referee3" ).val())||($( "#referee1" ).val()==$( "#referee4" ).val())||($( "#referee2" ).val()==$( "#referee3" ).val())||($( "#referee2" ).val()==$( "#referee4" ).val())||($( "#referee3" ).val()==$( "#referee4" ).val()))
		{
			alert("same");
		}*/
	
      });
	
	
	
	
	 $("#previous").click(function(){ 
      
	  if(current_page!=0)
	  {
	  current_page=current_page-1;
	  
	  var post = "id="+current_game+"&current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getRestrictions_By_Game.php",
        data: post,
        success: function(result){ 
		  $('#current').text(current_page);
          $("#table").html(result); 
        }
      });
	  
	  
	 // alert(number_of_pages);
	//  alert(current_page);
	  }
       
    });
	
	
	$("#next").click(function(){ 
      
	  if(current_page<number_of_pages-1)
	  {
	  current_page=current_page+1;
	  
	   var post = "id="+current_game+"&current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getRestrictions_By_Game.php",
        data: post,
        success: function(result){ 
		  $('#current').text(current_page);
          $("#table").html(result); 
        }
      });
	  
	  
	  
	  //alert(number_of_pages);
	  //alert(current_page);
	  }
    });
	
	
$("#max").click(function(){ 
      
	  if(number_of_pages!=0)
	  current_page=Math.ceil(number_of_pages-1);
	  $('#current').text(current_page);

	  var post = "id="+current_game+"&current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getRestrictions_By_Game.php",
        data: post,
        success: function(result){ 
		  $('#current').text(current_page);
          $("#table").html(result); 
        }
      });
	 
});	

 
 
$("#min").click(function(){ 
      
	  current_page=parseInt(0);
	  $('#current').text(current_page);
	   var post = "id="+current_game+"&current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getRestrictions_By_Game.php",
        data: post,
        success: function(result){ 
		  $('#current').text(current_page);
          $("#table").html(result); 
        }
      });
	  
});
	
	

 
 
 
  $('#table').on('click','.btn',function(){ 
  var btn = $(this).val();
		//alert(btn);
		
		var post = "id="+btn;
		$.ajax({ 
        type: "POST", 
        url: "php/delete/delete_restriction.php",
        data: post,
        success: function(result){ 
		//alert(result);
		var post_id="id="+current_game+"&current_page=0";
		 $.snackbar({content: result});
    
	  $.ajax({ 
        type: "POST",
        url: "php/jquery/getN_O_Restrictions_By_Game.php",
        data: post_id,
        success: function(result){ 
			
			number_of_pages=result;
        }
      });
	  
	  var post_id="id="+current_game+"&current_page=0";
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getRestrictions_By_Game.php", 
        data: post_id, 
        success: function(result){ 
		  if(result.length!=175){
		  $('#pagination_buttons').show();
		  $('#table').fadeOut(1000);
          $("#table").html(result); 
          $('#table').fadeIn(1000);
		  }
		  else
		  {
			$('#table').fadeOut(2000);
			$('#pagination_buttons').fadeOut(2000);
		  }
        }
      });
	  
	  var post_id = 'id='+ current_category+"&game_id="+current_game;
	  
	  $.ajax({ 
        type: "POST", 
        url: "php/jquery/getReferee_By_Category.php",
        data: post_id, 
        success: function(result){ 
          $("#referee1").html(result); 
		  $("#referee2").html(result);
		  $("#referee3").html(result);
		  $("#referee4").html(result);
		  $("#previous").fadeIn(4000);
		  $("#show_page").fadeIn(4000);
          $("#next").fadeIn(4000);
        }
      });
	 
		 
        }
      });
  });
		


  
 
});
  