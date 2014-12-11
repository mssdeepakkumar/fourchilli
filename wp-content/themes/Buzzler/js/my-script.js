var $ = jQuery;

$(document).ready(function() {


$(".rem-to-watchlist").live("click", function(){ 
		
		var pid = $(this).attr('rel');
		var cette = $(this);
		
		$.ajax({
						url: SITE_URL + "/wp-admin/admin-ajax.php",
						type:'POST',
						data:'action=remove_from_watchlist&pid=' + pid,
						success: function (text) {  
						
							//text = text.slice(0, -1);
							//$('#my_pkg_cell' + delete_package).animate({ backgroundColor: "red" }, 'slow');
							//$("#my_pkg_cell" + delete_package).remove();
							
							if(text == "NO_LOGGED-1")
							{
								window.location = SITE_URL + "/wp-login.php";
							}
							else
							{
								if(is_on_check_list == 1)
								{
									$("#post-ID-" + pid).hide('slow'); 
								}
								else{
									cette.html(plus_watchlist);
									cette.removeClass("rem-to-watchlist");
									cette.addClass("add-to-watchlist");
								}
							}
							
							return false;
						  }
					 });
			
		return false;
	});

//----------------------------------------------------------------------------
	
	$(".add-to-watchlist").live("click", function(){ 
		
		var pid = $(this).attr('rel');
		var cette = $(this);
		
		$.ajax({
						url: SITE_URL + "/wp-admin/admin-ajax.php",
						type:'POST',
						data:'action=add_to_watchlist&pid=' + pid,
						success: function (text) {  
						
							//text = text.slice(0, -1);
							//$('#my_pkg_cell' + delete_package).animate({ backgroundColor: "red" }, 'slow');
							//$("#my_pkg_cell" + delete_package).remove();
						if(text == "NO_LOGGED-1")
						{
							window.location = SITE_URL + "/wp-login.php";
						}
						else
						{	
							
						
								cette.html(minus_watchlist);
								cette.removeClass("add-to-watchlist");
								cette.addClass("rem-to-watchlist");
							
						}
						
							
							return false;
						  }
					 });
			
		return false;
	});	
	    
});