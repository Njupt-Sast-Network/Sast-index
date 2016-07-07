var lunbo = (function() {
	//封装的关于变色函数，status1是a增加的class，status2是li增加的class，
	//status3是hover变化颜色的
	function bianse(status1,status2,status3) {
		$("nav.nav .navLi ul li a").removeClass();
		$("nav.nav .navLi ul li").removeClass();
		$("#user").addClass("willLogin");
		$("nav.nav .navLi ul li a").addClass(status1);
    	$("nav.nav .navLi ul li").addClass(status2);
    	$("nav.nav .navLi ul li").mouseenter(function() {
    		$(this).children().addClass(status3);
    	});
    	$("nav.nav .navLi ul li").mouseleave(function() {
    		$(this).children().removeClass(status3);
    	});
	}
	// 初始化轮播
    $('#myCarousel').carousel({
  		interval: 8000
		})
    $("#myCarousel").carousel('cycle');
    // 停止轮播
    $("#myCarousel").mouseenter(function(){
         $("#myCarousel").carousel('pause');
    });
    $("#myCarousel").mouseleave(function(){
         $("#myCarousel").carousel('cycle');
    });
    $('#myCarousel').on('slid.bs.carousel', function() {
    	$("#myCarousel .carousel-inner .item").each(function(i) {
    		if ($(this).hasClass("active")) {
    			//判断是否有active这个类
    			switch(i) {
    				case 0: bianse("zhuang0","zhuangtai0","zhuanghover0");break;
    				case 1: bianse("zhuang2","zhuangtai2","zhuanghover2");break;
                    case 2: bianse("zhuang1","zhuangtai1","zhuanghover1");break;
    				case 3: bianse("zhuang3","zhuangtai3","zhuanghover3");break;
    				case 4: bianse("zhuang4","zhuangtai4","zhuanghover4");break;
    				case 5: bianse("zhuang3","zhuangtai3","zhuanghover3");break;
    				case 6: bianse("zhuang5","zhuangtai5","zhuanghover5");break;
                    case 7: bianse("zhuang4","zhuangtai6","zhuanghover3");break;
    			}
    		}
    	})
	});
})();
