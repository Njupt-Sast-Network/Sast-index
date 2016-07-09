(function() {
	//滚动事件
	$(document).scroll(function() {
		if($("html body").scrollTop() > 800) {
			$("section.sectionOne .row3 .col-md-3 span").animate({opacity:"1"},800,function() {
				$(this).next().animate({opacity:"1"},500);
			});
		}
		if($("html body").scrollTop() > 10) {
			$("#hui").css("display","inline-block");
		}else {
			$("#hui").css("display","none");
		}
	});
	$("#hui").click(function() {
		$("html body").animate({"scrollTop":"0"});
	});
	$(".down").click(function() {
		$("html body").animate({"scrollTop":$("section.sectionOne").offset().top});
	});
})();