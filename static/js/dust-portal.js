jQuery(document).ready(function() {
	var pathArray = window.location.pathname.split( '/' );
	var currentPage = pathArray[2];
	
	if(currentPage == "list.php") {
		jQuery("#home").parent().removeClass("active");
		jQuery("#list").parent().addClass("active");
		jQuery("#chart").parent().removeClass("active");
		jQuery("#settings").parent().removeClass("active");
	}
	else if(currentPage == "chart.php") {
		google.load("visualization", "1", { packages: ["corechart"] });
        google.setOnLoadCallback(drawChart);

        function drawChart() {
            var jsonData = $.ajax({
                url: "chart_process.php",
                dataType: "json",
                async: false
            }).responseText;

            var obj = window.JSON.stringify(jsonData);
            var data = google.visualization.arrayToDataTable(obj);

            var options = {
                title: 'Raw Dust Value'
            };

            var chart = new google.visualization.LineChart(
                        document.getElementById('chart_div'));
            chart.draw(data, options);
        }
		
		
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