$(document).ready(function(){
	$('.venobox').venobox({        
        framewidth: '70vw',        // default: ''
        frameheight: '100%',       // default: ''
        numeratio: true,            // default: false
        infinigall: true            // default: false
    });
	
	$('#calendarGroup').carousel({
		interval: false
	}); 
	$(".multimedia-item").click(function(){
		var src = $(this).children("img").attr("src");
		var modalImg = "<div class='full-screen' style='position:absolute;margin:0px auto;width:90vw;height:90vh' >";
		modalImg+="<img src='"+src+"' class='img-fuild'></img>";
		modalImg+="</div>";
	});

	checkitem();
	$("#calendarGroup").on("slid.bs.carousel", "", checkitem);
});

var checkitem = function() {
	var $this;
	$this = $("#calendarGroup");
	if ($("#calendarGroup .carousel-inner .carousel-item:first").hasClass("active")) {
		$(".calendar-prev").addClass("calendar-hide");
		$(".calendar-next").removeClass("calendar-hide");
	} else if ($("#calendarGroup .carousel-inner .carousel-item:last").hasClass("active")) {
		$(".calendar-next").addClass("calendar-hide");
		$(".calendar-prev").removeClass("calendar-hide");
	} else {
		$(".calendar-next").removeClass("calendar-hide");
		$(".calendar-prev").removeClass("calendar-hide");
	}
};