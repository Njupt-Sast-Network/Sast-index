$(function() {
	var registerAll = function() {
		var user = $("#shelter .resContent ul li .username");
		var pw = $("#shelter .resContent ul li .password");
		var sub = $("#shelter .resContent .sub");
		var mail = $("#shelter .resContent .mail");
		var ver = $("#shelter .resContent ul li .ver");
		var tip = $("#shelter .resContent .tip2");//错误提示
		var content = $("#shelter .conshelter");
		var x,y,z,b;//通过条件		
		//数据验证
		function check(obj,fun) {
			if(!fun(obj.val())) {
				return false;
			}else {
				return true;
			}		
		}
		function che() {
			$("#shelter .resContent ul li input").removeClass('wrongput');
			tip.text("");
		}
		//ajax提交
		function subm() {
			$.ajax({
				type: "POST",
				url:"/index.php/Index/Login/reg",
				data: {
					username : user.val(),
					password : pw.val(),
					email : mail.val(),
					verify : ver.val()
				},
				dataType:"json",				
				success:function(data,user) {
					if(data.valid==1) {
						$("#shelter").css("display","none");
						che();
						$(".contentLi").find("#user").remove();
						$(".contentLi").append("<li><a href='ddd'>"+data.username+"</a></li>");
						$(".contentLi").append("<li><a href='/index.php/Index/Login/logout'>退出</a></li>");
						$(".hideBar").css("height","200px");
					}else {		
						wrongChange();
						//刷新验证码
						fleshVerify(document.getElementById('VerifyImg'));
						tip.addClass("wrong").text(data.message);
						// console.log("1234567890");
					}	
					// console.log(data.valid,data.message);
				},
			})
		}
		//验证
		function endCheck() {
			//验证邮箱
			b =check(mail,function(val){
				if(val.match(/\w+@\w+.\w/)){
					return true;
				}
				else return false;
			});
			//验证用户名
			x = check(user,function(val) {
				if(val.match(/^\S+$/)&&val.length>=3&&val.length<=16){
					return true;
				}
				else return false;
			});
			//验证密码格式
			y = check(pw,function(val){
				if(val.match(/^\S+$/)&&val.length>=6&&val.length<=16){
					return true;
				}
				else return false;
			});
			//验证码
			z = check(ver,function(val){
				if(val.length == 4){
					return true;
				}
				else return false;
			});
			if(!x){
				che();
				user.addClass("wrongput");
				wrongChange();
				tip.text("用户名格式错误！")
			}else if(!y){
				che();
				pw.addClass("wrongput");
				wrongChange();
				tip.text("密码格式错误！")
			}else if (!b) {
				che();
				mail.addClass("wrongput");
				wrongChange();
				tip.text("邮箱格式错误！");
			}else if (!z) {
				che();
				ver.addClass("wrongput");
				wrongChange();
				tip.text("验证码格式错误！");
			}
			if (x&&y&&z&&b) {
				che();
				subm();
			}
		}
		//错误变化
		function wrongChange() {
			tip.addClass("wrong");
		}
		//点击
		sub.click(function() {
			endCheck();		
		});
		//感应键盘
		function jianpan(e) {
			var keycode = e.which;
			if(keycode == 13) {
				endCheck();
			}
		}
		user.keyup(function(e) {
			x = check(user,function(val) {
				if(val.match(/^\S+$/)&&val.length>=3&&val.length<=16){
					return true;
				}
				else return false;
			});
			if(!x) {
				che();
				user.addClass("wrongput");
				wrongChange();
				tip.text("用户名格式错误！")
			}else {
				che();
			}
			jianpan(e);
		})
		pw.keyup(function(e) {
			y = check(pw,function(val){
				if(val.match(/^\S+$/)&&val.length>=6&&val.length<=16){
					return true;
				}
				else return false;
			});
			if(!y){
				che();
				pw.addClass("wrongput");
				wrongChange();
				tip.text("密码格式错误！")
			}else {
				che();
			}
			jianpan(e);
		});
		ver.keyup(function(e) {
			z = check(ver,function(val){
				if(val.length == 4){
					return true;
				}
				else return false;
			});
			if (!z) {
				che();
				ver.addClass("wrongput");
				wrongChange();
				tip.text("验证码格式错误！");
			}else {
				che();
			}
			jianpan(e);
		});
		mail.keyup(function(e) {
			b =check(mail,function(val){
				if(val.match(/\w+@\w+.\w/)){
					return true;
				}
				else return false;
			});
			if (!b) {
				che();
				mail.addClass("wrongput");
				wrongChange();
				tip.text("邮箱格式错误！");
			}else {
				che();
			}
			jianpan(e);
		});
	}
	registerAll();
});
