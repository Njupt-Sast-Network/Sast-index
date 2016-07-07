$(document).ready(function() {
	$("section.sectionOne .row4 .Box .smallBox .allmin").each(function(index) {/*通过each方法找到所有的allmin*/
		var m=n=0,
		minNode = $(this);
		$(this).mouseenter(function() {	
		m = 1;		
			timeout=setTimeout(function() {
				minNode.next().addClass("chuxian");
				
			},300)
		}).mouseleave(function() {
			clearTimeout(timeout);
			m = 0;
			setTimeout(function() {
				if(n == 0) {
					minNode.next().removeClass("chuxian");
				}
			},100);
		});
		minNode.next().mouseenter(function() {
			n = 1;
		}).mouseleave(function() {
			n = 0;
			setTimeout(function() {
				if(m==0) {
					minNode.next().removeClass("chuxian");
				}
			},100);
		})
	});
	$("section.sectionOne .row4").mouseenter(function() {
		$("section.sectionOne .row4 .zhe").fadeOut();
	}).mouseleave(function() {
		$("section.sectionOne .row4 .zhe").fadeIn();
	})
});