var lunbo = (function() {
	// 初始化轮播
    $('#myCarousel').carousel({
  		interval: 8000
		})
    $("#myCarousel").carousel('cycle');
    // 停止轮播
    $("#myCarousel").mouseenter(function(){
         $("#myCarousel .carousel-inner .item").carousel('pause');
    });
    $("#myCarousel").mouseleave(function(){
         $("#myCarousel").carousel('cycle');
    });
})();
