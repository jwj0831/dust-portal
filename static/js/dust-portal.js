jQuery(document).ready(function() {
	
	if( jQuery(window).width() <= 500 ){
		jQuery("#title-bar").text("Indoor Dust Monitor");
	}

	
	var pathArray = window.location.pathname.split( '/' );
	var currentPage = pathArray[2];
	
	if(currentPage == "list.php") {
		jQuery("#home").parent().removeClass("active");
		jQuery("#list").parent().addClass("active");
		jQuery("#chart").parent().removeClass("active");
		jQuery("#settings").parent().removeClass("active");
	}
	else if(currentPage == "chart.php") {
		jQuery("#home").parent().removeClass("active");
		jQuery("#list").parent().removeClass("active");
		jQuery("#chart").parent().addClass("active");
		jQuery("#settings").parent().removeClass("active");
	}
	else if(currentPage == "settings.php") {
		jQuery("#home").parent().removeClass("active");
		jQuery("#list").parent().removeClass("active");
		jQuery("#chart").parent().removeClass("active");
		jQuery("#settings").parent().addClass("active");
	}
	else{
		//Prototype js
		new Ajax.PeriodicalUpdater('clock', 'clock.php', {method: 'get', frequency: 1 });
		jQuery("#home").parent().addClass("active");
		jQuery("#list").parent().removeClass("active");
		jQuery("#chart").parent().removeClass("active");
		jQuery("#settings").parent().removeClass("active");
	}
});