//关于图片的懒加载
(function() {
	$(document).scroll(function() {
		var photo = $(".Box"),
		photoObj = $(".Box img");
		setTimeout(function() {
			for(var i = 0;i < 20;i++) {
				photoObj.eq(i).attr("src","/Public/images/img"+i+".jpg");
			}
			},1000);
			
			

	})
})();
