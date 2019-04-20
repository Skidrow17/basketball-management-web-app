    var number_of_pages1 = 0 ;
	var current_page1 = 0;
	var current_category1 = 0;
	
$(document).ready(function(){
	
	
		n_o_g1();
		myFunction1();
		
	 $("#previous1").click(function(){ 
      
	  if(current_page1!=0)
	  {
	  current_page1=current_page1-1;
	  $('#current').text(current_page1);
	  var post = "current_page="+current_page1;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getGames_By_User.php",
        data: post,
        success: function(result){ 
          $("#here").html(result); 
        }
      });
	 
	  }
       
    });
	
	
	$("#next1").click(function(){ 
      
	  if(current_page1<number_of_pages1-1)
	  {
	  current_page1=current_page1+1;
	  $('#current').text(current_page1);
	   var post = "current_page="+current_page1;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getGames_By_User.php",
        data: post,
        success: function(result){ 
          $("#here").html(result); 
        }
      });
	
    }
});


$('#here').on('click','#score',function(){ 
  var btn = $(this).val();
    $("#set_score").show();
	$("#show_games").hide();
	
	var post_id = "game_id="+btn;
	
	$.ajax({ 
        type: "POST", 
        url: "php/jquery/getGame_By_ID.php",
        data: post_id,
        success: function(result){ 
		//alert(result);
          $("#set_score").html(result); 
        }
      });
	
	
});


$('#here').on('click','#location',function(){ 
 var btn = $(this).val();
var post_id = "game_id="+btn;
	$.ajax({ 
        type: "POST", 
        url: "php/jquery/getCourt_By_GameID.php",
        data: post_id,
		dataType: 'json',
        success: function(result){ 
		 window.open("https://maps.apple.com/?q="+result.latitude+","+result.longitude+"");
          //$("#set_score").html(result); 
        }
      });


});


$('#set_score').on('click','#back3',function(){ 
    $("#set_score").hide();
	$("#show_games").show();
});


$("#max").click(function(){ 
      
	  if(number_of_pages1!=0)
	  current_page2=Math.ceil(number_of_pages1-1);
	  $('#current').text(current_page2);
	   var post = "current_page="+current_page2;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getGames_By_User.php",
        data: post,
        success: function(result){ 
          $("#here").html(result); 
        }
      });
 });	

 
 
$("#min").click(function(){ 
      
	  current_page2=parseInt(0);
	  $('#current').text(current_page2);
	   var post = "current_page="+current_page2;
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getGames_By_User.php",
        data: post,
        success: function(result){ 
          $("#here").html(result); 
        }
      });
 });







});



	
function myFunction1() {
	
	
	var post_id = "current_page=0";
	
	$.ajax({ 
        type: "POST", 
        url: "php/jquery/getGames_By_User.php",
        data: post_id,
        success: function(result){ 
		//alert(result);
          $("#here").html(result); 
        }
      });

    
}


function n_o_g1() {
	$.ajax({ 
        url: "php/jquery/getN_O_Games_By_User.php",
        success: function(result){ 
		number_of_pages1 = result;
		$('#min').text(0);
		$('#current').text(0);
		
		if(number_of_pages1!=0)
		$('#max').text(Math.ceil(number_of_pages1)-1);
		else
		$('#max').text(0); 
        
       //alert(result);
        }
      });

}