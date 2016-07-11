//关于图片的懒加载
(function() {
	$(document).scroll(function() {
		var photo = $(".Box"),
		photoObj = $(".Box img");
		if($("html body").scrollTop() > photo.offset().top-400) {
			for(var i = 0;i < 20;i++) {
				photoObj.eq(i).attr("src","__PUBLIC__/src/images/img"+i+".jpg");
			}
		}
	})
})();