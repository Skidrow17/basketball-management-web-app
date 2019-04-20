 $(document).ready(function(){

var global_category=-1;
  
  $('#tableta').hide();
 var current_category=-1;
  /* PREPARE THE SCRIPT */
    $("#team_category").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
      var category = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
	  global_category=category;
	  var post_id = 'id='+ category;
	   //alert(post_id);
      //var dataString = "allbooks="+allbooks; /* STORE THAT TO A DATA STRING */

      $.ajax({ /* THEN THE AJAX CALL */
        type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "php/jquery/getMatch_By_Category.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data: post_id, /* THE DATA WE WILL BE PASSING */
        success: function(result){ /* GET THE TO BE RETURNED DATA */
          $("#matches").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
	
        }
      });

    });
	
	
	
	 $("#matches").change(function(){ 
	  current_game = $(this).val();
	  var post_id = "game_id="+current_game+"&category_id="+global_category;
	  current_page=0;
	  
	   //alert(post_id);
      //var dataString = "allbooks="+allbooks; /* STORE THAT TO A DATA STRING */

      $.ajax({ /* THEN THE AJAX CALL */
        type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "php/jquery/getMatch_By_Match_id.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data: post_id, /* THE DATA WE WILL BE PASSING */
        success: function(result){ /* GET THE TO BE RETURNED DATA */
          $("#tableta").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
		  $('#tableta').show();
		 // alert(result);
        }
      });

    });
	
	
});
	