
      $(document).ready(function(){
        $('#search-data').unbind().keyup(function(e) {
          var value = $(this).val();
          if (value.length>0) {
            //alert(99933);
            searchData(value);
          }
          else {
            $('#search-result').hide();
          }
        }
      );
	  
	  
	  $('#search-result').on('click','#srch_button',function(){ 
       var contact_id = $(this).val();
	 
	   //var contact_id =  $(this).text();
	   $("#receiver_id").val(contact_id);
	   $('#search-data').val('');
	   $('#search-result').hide();
	   //alert(contact_id);
      });
	  
	  
	  
      });
					   
					   
					   
      function searchData(val){
        $('#search-result').show();
		
       var post = "search=%"+val+"%";
	  
	   $.ajax({ 
        type: "POST", 
        url: "php/jquery/getResults.php",
        data: post,
        success: function(result){ 
          $('#search-result').html(result);
        }
      });
	  
      }
