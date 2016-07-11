$(function() {
	var login = function() {
		var user = $("#shelter .loginContent ul li .username");
		var pw = $("#shelter .loginContent ul li .password");
		var sub = $("#shelter .loginContent .sub");
		var ver = $("#shelter .loginContent ul li .ver")
		var content = $("#shelter .conshelter");
		var x,y,z;//通过条件	
		var tip = $("#shelter .loginContent .tip");//错误提示
		var url = null;	
		tip.click(function() {
			console.log(1)
		})
		//数据验证
		function check(obj,fun) {
			if(!fun(obj.val())) {
				return false;
			}else {
				return true;
			}		
		}
		//ajax提交
		function subm() {
			$.ajax({
				type: "POST",
				url: "/Index/Login/login",
				data: {
					username : user.val(),
					password : pw.val(),
					verify : ver.val()
				},
				dataType:"json",			
				success:function(data) {
					if(data.valid==1) {
						$("#shelter").css("display","none");
						content.css("height","300px");
						sub.css("top","160px");
						che();
						$(".contentLi").find("#user").remove();
						$(".contentLi").append("<li><a href='ddd'>"+data.username+"</a></li>");
						$(".contentLi").append("<li><a href='/Index/Login/logout'>退出</a></li>");
						$(".hideBar").css("height","360px");
						$("nav.nav .hideBar ul li .searchBar").css("width","500px");	
					}else {
						wrongChange();
						//刷新验证码
						fleshVerify(document.getElementById('Verifyimg'));
						tip.addClass("wrong").text(data.message);
						// console.log("1234567890");
					}	
					// console.log(data.valid,data.message);
					// console.log(data)
				},
				error:function(x) {
					console.log(x);
				}
			})
		}
		//验证
		function endCheck() {
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
			if(!x) {
				che();
				user.addClass("wrongput");
				wrongChange();
				tip.text("用户名格式错误！")
			}else if(!y){
				che();
				pw.addClass("wrongput");
				wrongChange();
				tip.text("密码格式错误！")
			}else if (!z) {
				che();
				ver.addClass("wrongput");
				wrongChange();
				tip.text("验证码格式错误！");
			}else {
				che();	
				subm();
			}
		}
		//错误变化
		function wrongChange() {
			content.css("height","320px");
			sub.css("top","180px");	
			tip.addClass("wrong");
		}
		//点击
		sub.click(function() {
			endCheck();		
		});
		//感应键盘
		user.keyup(function(e) {
			var keycode = e.which;
			if(keycode == 13) {
				endCheck();
			}
		});
		pw.keyup(function(e) {
			var keycode = e.which;
			if(keycode == 13) {
				endCheck();
			}
		});
		ver.keyup(function(e) {
			var keycode = e.which;
			if(keycode == 13) {
				endCheck();
			}
		});
		//关闭登录窗口
		$("#shelter .conshelter .closed").click(function() {
			$("#shelter").css("display","none");
			content.css("height","300px");
			sub.css("top","160px");
			che();
			user.val("");
			pw.val("");
			ver.val("");
			tip.removeClass('wrong');
		});
		function che() {
			function che() {
			$("#shelter ul li input").removeClass('wrongput');
		}
		}
		var qie = (function() {
			var loginc = $("#shelter .loginContent");
			var res = $("#shelter .resContent");
			var loginBtn = $("#shelter .tool .login");
			var resBtn = $("#shelter .tool .register");
			var idname = $("#shelter .resContent ul li .idname");
			var idpw = $("#shelter .resContent ul li .idpw");
			var reuser = $("#shelter .resContent ul li .username");
			var repw = $("#shelter .resContent ul li .password");
			var mail = $("#shelter .resContent .mail");
			var rever = $("#shelter .resContent ul li .ver");
			var resub = $("#shelter .resContent .sub");
			var tip2 = $("#shelter .resContent .tip2");//错误提示
			loginBtn.click(function() {
				$(this).addClass("choosed");
				resBtn.removeClass("choosed");
				res.css("display","none");
				loginc.css("display","inline-block");
				content.css("height","300px");
				sub.css("top","160px");
				che();
				user.val("");
				pw.val("");
				ver.val("");
				tip.text("");
			});
			resBtn.click(function() {
				$(this).addClass("choosed");
				loginBtn.removeClass("choosed");
				loginc.css("display","none");
				res.css("display","inline-block");
				content.css("height","350px");
				che();
				idname.val("");
				idpw.val("");
				reuser.val("");
				repw.val("");
				mail.val("");
				rever.val("");
				tip2.text("");
			});
		})();
	}
	//登录框的出现
	var recitive = (function() {
		$(document).on("click","#user",function() {
			$("#shelter").css("display","inline-block");
		});
	})();
	login();
});

/*切换登录注册*/
