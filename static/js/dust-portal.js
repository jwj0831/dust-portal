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
	$('#home').parent().removeClass("active");
	$('#list').parent().removeClass("active");
	$('#chart').parent().removeClass("active");
	$('#settings').parent().addClass("active");
}
else{
	//Prototype js
	new Ajax.PeriodicalUpdater('clock', 'clock.php', {method: 'get', frequency: 1 });
				
	$("#home").parent().addClass("active");
	$("#list").parent().removeClass("active");
	$("#chart").parent().removeClass("active");
	$("#settings").parent().removeClass("active");
}