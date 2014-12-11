$(document).ready(function(){
		$(window).resize(function(){
			if($(window).width() >= 767){
				$("#left-side-bar-menu").slideDown('350');
				$("#left-side-bar-menu").slideDown('350');
			}
			else{
				$("#right-side-bar-chatwindow").slideUp('350');
				$("#right-side-bar-chatwindow").slideUp('350');
			}
		});
	
	 $("#menu-trigger a").click(function(){
		if(!$(this).hasClass("dropy")) {
			// hide any open menus and remove all other classes
			$("#left-side-bar-menu").slideUp('350');
			$("#menu-trigger a").removeClass("dropy");
			
			// open our new menu and add the dropy class
			$("#left-side-bar-menu").slideDown('350');
			$(this).addClass("dropy");
		}
		else if($(this).hasClass("dropy")) {
			$(this).removeClass("dropy");
			$("#left-side-bar-menu").slideUp('350');
		}
	});
	/** Chat window **/
	 $("#menu-trigger-chat a").click(function(){
		if(!$(this).hasClass("dropy")) {
			// hide any open menus and remove all other classes
			$("#right-side-bar-chatwindow").slideUp('350');
			$("#menu-trigger-chat a").removeClass("dropy");
			
			// open our new menu and add the dropy class
			$("#right-side-bar-chatwindow").slideDown('350');
			$(this).addClass("dropy");
		}
		else if($(this).hasClass("dropy")) {
			$(this).removeClass("dropy");
			$("#right-side-bar-chatwindow").slideUp('350');
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
