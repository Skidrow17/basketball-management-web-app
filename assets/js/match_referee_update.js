 $(document).ready(function(){

 var number_of_pages = 0;
 var current_page=0;
 var current_category=-1;
 var current_game=-1;
	
  
  $('#tableta').hide();
 var current_category=-1;
  
    $("#team_category").change(function(){ 
      var category = $(this).val(); 
	  var post_id = 'id='+ category;
	  
      $.ajax({ 
        type: "POST", 
        url: "php/jquery/getMatch_By_Category.php", 
        data: post_id, 
        success: function(result){ 
          $("#matches").html(result);
	
        }
      });

    });
	
	
	$("#matches").change(function(){ 
      var game = $(this).val(); 
	  var post_id = 'game_id='+ game;
	  current_game=game;

      $.ajax({ 
        type: "POST", 
        url: "php/jquery/getN_O_Human_Power_By_Game.php", 
        data: post_id, 
        success: function(result){ 
			
			number_of_pages=result;
        }
      });

    });

	
	 $("#matches").change(function(){ 
	  current_game = $(this).val();
	  var post_id = "game_id="+current_game+"&current_page="+current_page;
	  current_page=0;
	  
	  
      $.ajax({ 
        type: "POST", 
        url: "php/jquery/getHuman_Power_By_Game.php",
        data: post_id, 
        success: function(result){ 
		  $('#tableta').show();
          $("#table").html(result); 
        }
      });

    });
	
	
	 $("#previous").click(function(){ 
      
	  if(current_page!=0)
	  {
	  current_page=current_page-1;
	  
	  var post = "game_id="+current_game+"&current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getHuman_Power_By_Game.php",
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
	  
	   var post = "game_id="+current_game+"&current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getHuman_Power_By_Game.php",
        data: post,
        success: function(result){ 
          $("#table").html(result); 
        }
      });
	  
	  }
    });
	
	
$('#table').on('click','.btn',function(){ 
  var btn = $(this).val();
	
		
		var post = "id="+btn+"&game_id="+current_game;
		$.ajax({ 
        type: "POST", 
        url: "php/delete/delete_human_power.php",
        data: post,
        success: function(result){ 
		
		var post_id="id="+current_game+"&current_page=0";
		$.snackbar({content: result});
    
	  $.ajax({ 
        type: "POST", 
        url: "php/jquery/getN_O_Human_Power_By_Game.php", 
        data: post_id, 
        success: function(result){ 
			
			number_of_pages=result;
        }
      });
	  
	  var post = "game_id="+current_game+"&current_page="+current_page;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getHuman_Power_By_Game.php",
        data: post,
        success: function(result){ 
          $("#table").html(result); 
        }
      });
	  
		
        }
      });
  });
	
	
	
});
	
	
	
	
	