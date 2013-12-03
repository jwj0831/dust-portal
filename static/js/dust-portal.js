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
	jQuery(document).ready(function() {
		var idi = parseInt(<?= $idi; ?>);// idi_number;
		switch (idi) {
			case 0:
				jQuery("#symbol-info").css( {"background-color": "#f5bb63" });
			  	break;
			case 1:
			 	jQuery("#symbol-info").css( {"background-color": "#e8703e" });
			  	break;
			case 2:
			 	jQuery("#symbol-info").css( {"background-color": "#d33431" });
			  	break;
			default:
			  $("#symbol-info").css( {"background-color": "#f5bb63" });
		}
	});
				
	jQuery("#home").parent().addClass("active");
	jQuery("#list").parent().removeClass("active");
	jQuery("#chart").parent().removeClass("active");
	jQuery("#settings").parent().removeClass("active");
}