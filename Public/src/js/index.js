//提交响应式的搜索框
var sousuo = (function() {
	var sou = $("nav.nav .hideBar ul li .searchBar");
	var suo = $("nav.nav .hideBar ul li .glyphicon-search"),
	data = null;
	var reg=/<script[^>]*>.*(?=<\/script>)<\/script>/gi;  
	//点击提交
	suo.click(function() {
		data = sou.val();
			if(data != "") {
				data.replace(reg,"");
				$.get("此处是提交地址",data);
			}else {
				alert("搜索信息不能为空");
			}
	})
	//用enter提交
	sou.keyup(function(e) {
		var keycode = e.which;
		if (keycode == 13) {
			data = sou.val();
			if(data != "") {
				data.replace(reg,"");
				$.get("此处是提交地址",data);
			}else {
				alert("搜索信息不能为空");
			}
		}
	})
})();
//菜单
var menu = (function() {
	var menuBtn = $(".nav .menu"),
	hideBar = $(".nav .hideBar"),
	searchBtn = $("nav.nav .navLi ul li .searchBtn"),
	searchBar = $("nav.nav .secondSearch");
	menuBtn.click(function() {
		hideBar.slideToggle();
	});
	searchBtn.click(function() {
		searchBar.slideToggle();
	});
})();