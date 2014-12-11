$(document).ready(function(){
		$(window).resize(function(){
			if($(window).width() >= 767){
				$("#menu_drop_content").slideDown('350');
			}
			else{
				$("#menu_drop_content").slideUp('350');
			}
		});
	
	 $("#menu_drop_down_button").click(function(){
		if(!$(this).hasClass("dropy")) {
			// hide any open menus and remove all other classes
			$("#menu_drop_content").slideUp('350');
			$("#menu_drop_down_button").removeClass("dropy");
			
			// open our new menu and add the dropy class
			$("#menu_drop_content").slideDown('350');
			$(this).addClass("dropy");
		}
		else if($(this).hasClass("dropy")) {
			$(this).removeClass("dropy");
			$("#menu_drop_content").slideUp('350');
		}
	});
});

	/*** For Animation ***/
	$('.for_animate').waypoint(function(down) {
		$(this).addClass('animation');
		$(this).addClass('fadeInUp');
	}, { offset: '90%' });
					
	/*** For Equal Height ***/
	$(document).ready(function(){
		$(".block").equalHeights(); 
	});
	
	
$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
