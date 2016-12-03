(function() {
	setTimeout(function() {
			$("section.sectionOne .row3 .col-md-3 span").addClass("op");
		},500);
		setTimeout(function() {
			$("section.sectionOne .row3 .col-md-3 p").addClass("op");
		},700);
		setTimeout(function() {
			$("section.sectionOne .row5").addClass("op");
		},900);
	//滚动事件
	$(document).scroll(function() {
		
		if($("html body").scrollTop() > 10) {
			$("#hui").css("display","inline-block");
		}else {
			$("#hui").css("display","none");
		}
		if($("html body").scrollTop() > $("section.sectionOne .row6").offset().top-400 ) {
			for(var i = 0; i < 10; i++) {
				$("section.sectionOne .row6 .intro"+i).addClass("ani"+i);
			}
			
		}
	});
	$("#hui").click(function() {
		$("html body").animate({"scrollTop":"0"});
	});
	$(".down").click(function() {
		$("html body").animate({"scrollTop":$("section.sectionOne").offset().top});
	});
})();