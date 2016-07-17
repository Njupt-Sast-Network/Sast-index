(function(){
	//点赞请求
	var like = someInfo();
	var data = {
		type : like[0],
		id : like[1],
	}
	var vm = new Vue({
		el : ".contant",
		data: {
			islike : like[2],
			tip : "请先登录...",
			tipDis: false
		},
		methods: {
			ajaxLike : function() {
				if(!this.islike) {
					$.post("/index.php/Com/like",data,function(data){
						if(!data.islogin) {
							vm.tip = "请先登录...";
							tipMake();
						}else {
							if(data.isdone) {
								vm.islike = true;
								vm.tip = "谢谢你的赞!";
								tipMake();
							}else {
								vm.tip = "操作失败!";
								tipMake();
							}
						}
					});
				}else {
					$.post("/index.php/Com/dislike",data,function(data){
							if(data.isdone) {
								vm.islike = false;
								vm.tip = "赞已取消!";
								tipMake();
							}else {
								vm.tip = "操作失败!";
								tipMake();
							}
					});
				}
			}
		}
	});
	function tipMake() {
		vm.tipDis = true;
		setTimeout(function() {
			vm.tipDis = false;
		},2000);
	}
})();