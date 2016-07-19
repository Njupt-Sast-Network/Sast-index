(function(){
	//点赞请求
	var like = someInfo();
	var info = {
		type : like[0],
		id : like[1],
		page: 1,
	};
	var status = null;
	var textarea = $(".contant .rowBiggest .col-md-8 .comment .mine");
	//打开网页立即请求信息
	ajaxComment();
	var vm = new Vue({
		el : ".contant",
		data: {
			islike : like[2],
			tip : "请先登录...",
			tipDis: false,
			items : [],
			getInfo : false,
			msg : "评论",
		},
		methods: {
			ajaxCom : function() {
				ajaxComment();
			},
			ajaxLike : function() {
				if(!this.islike) {
					$.post("/index.php/Com/like",info,function(data){
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
					$.post("/index.php/Com/dislike",info,function(data){
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
			},
			sendComment : function() {
				if(textarea.val() != "") {
					$.ajax({
						type: "post",
						url : "/index.php/Com/com",
						data : {
							id : like[1],
							type : like[0],
							content : textarea.val()
						},
						success : function(data) {
							if(!data.islogin) {
								vm.tip = "请先登录...";
								tipMake();
							}else {
								if(data.isdone) {
									vm.islike = true;
									vm.tip = "谢谢您的评论!";
									textarea.val("");
									tipMake();
									vm.items = [];
									info.page = 1;
									ajaxComment();
								}else {
									vm.tip = "操作失败!";
									tipMake();
								}
							}
						}
					});
				}else {
					vm.tip = "评论不能为空！";
					tipMake();
				}
			},
			checkNum : function() {
				if (textarea.val().length == 200) {
					this.tip = "只能输入200字!";
					tipMake();
				}
			}
		}
	});
	function ajaxComment() {
		$.post("/index.php/View/more",info,function(data){
			status = data["islogin"];
			var len = like[3] - info.page*3;
			if ( len < 3) {
				for(var i = 0;i < len;i++) {
					vm.items.push(data[i]); 
				}
			} else {
				for(var i = 0;i < 3;i++) {
					vm.items.push(data[i]); 
				}
			}
			if (like[3] > info.page*3) {
				vm.getInfo = true;
			}else {
				vm.getInfo = false;
			}
			info.page++;
		});
	}
	function tipMake() {
		vm.tipDis = true;
		setTimeout(function() {
			vm.tipDis = false;
		},2000);
	}
	textarea.keyup(function(e) {
		var keycode = e.which;
		if (keycode!=8&&textarea.val().length == 200) {
			vm.tip = "只能输入200字!";
			tipMake();
		}
	});
})();