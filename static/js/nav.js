var pathArray = window.location.pathname.split( '/' );
var currentPage = pathArray[2];
alert(currentPage);

if(currentPage == "charts.php") {
	jQuery("#home").parent().removeClass("active");
	jQuery("#charts").parent().addClass("active");
	jQuery("#settings").parent().removeClass("active");
}
else if(currentPage == "settings.php") {
	jQuery("#home").parent().removeClass("active");
	jQuery("#charts").parent().removeClass("active");
	jQuery("#settings").parent().addClass("active");
}
else{
	jQuery("#home").parent().addClass("active");
	jQuery("#charts").parent().removeClass("active");
	jQuery("#settings").parent().removeClass("active");
}