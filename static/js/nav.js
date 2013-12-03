var pathArray = window.location.pathname.split( '/' );
alert(window.location.pathname);
var currentPage = pathArray[2];
alert(currentPage);

if(currentPage == "charts.php") {
	$("#home").parent().removeClass("active");
	$("#charts").parent().addClass("active");
	$("#settings").parent().removeClass("active");
}
else if(currentPage == "settings.php") {
	$("#home").parent().removeClass("active");
	$("#charts").parent().removeClass("active");
	$("#settings").parent().addClass("active");
}
else{
	$("#home").parent().addClass("active");
	$("#charts").parent().removeClass("active");
	$("#settings").parent().removeClass("active");
}