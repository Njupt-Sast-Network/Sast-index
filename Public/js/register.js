$(function() {
	var registerAll = function() {
		var idname = $("#shelter .resContent ul li .idname");
		var idpw = $("#shelter .resContent ul li .idpw");
		var user = $("#shelter .resContent ul li .username");
		var pw = $("#shelter .resContent ul li .password");
		var sub = $("#shelter .resContent .sub");
		var mail = $("#shelter .resContent .mail");
		var ver = $("#shelter .resContent ul li .ver");
		var tip = $("#shelter .resContent .tip2");//错误提示
		var content = $("#shelter .conshelter");
		var x,y,z,a,b,c;//通过条件		
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
		}
		//ajax提交
		function subm() {
			$.ajax({
				type: "POST",
				url:"/Index/login/index",
				data: {
					idname : idname.val(),
					idpassword : idpw.val(),
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
						var userLi = $(".login");
						userLi.html("<button class='btn btn-default dropdown-toggle' type='button' id='dropdownMenu1' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>Dropdown<span class='caret'></span></button>  <ul class='dropdown-menu' aria-labelledby='dropdownMenu1'><li><a href='#'>Action</a></li><li><a href='#'>Another action</a></li><li><a href='#'>Something else here</a></li><li><a href='#'>Separated link</a></li></ul>");
					}else {
						
						tip.addClass("wrong").text(data.message);
						// console.log("1234567890");
					}	
					// console.log(data.valid,data.message);
				},
			})
		}
		//验证
		function endCheck() {
			//验证学号
			a = check(idname,function(val) {
				if(val.match(/^\S+$/)&&val.length==9&&val.charAt(0) == 'B'){
					return true;
				}
				else return false;
			});
			//验证邮箱
			b =check(mail,function(val){
				if(val.match(/\w+@\w+.\w/)&&val.length>8&&val.length<25){
					return true;
				}
				else return false;
			});
			//正方密码
			c = check(idpw,function(val){
				if(val.length != 0){
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
			if(!a) {
				che();
				idname.addClass("wrongput");
				wrongChange();
				tip.text("学号格式不对！")
			}else if(!c) {
				che();
				idpw.addClass("wrongput");
				wrongChange();
				tip.text("正方密码不能为空！")
			}else if(!x){
				che();
				user.addClass("wrongput");
				wrongChange();
				tip.text("用户名格式错误！")
			}else if(!y){
				che();
				pw.addClass("wrongput");
				wrongChange();
				tip.text("密码格式错误！")
			}else if (!c) {
				che();
				ver.addClass("wrongput");
				wrongChange();
				tip.text("邮箱格式错误！");
			}else if (!z) {
				che();
				ver.addClass("wrongput");
				wrongChange();
				tip.text("验证码格式错误！");
			}
			if (x&&y&&z&&a&&b&&c) {
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
			jianpan(e);
		})
		pw.keyup(function(e) {
			jianpan(e);
		});
		ver.keyup(function(e) {
			jianpan(e);
		});
		idname.keyup(function(e) {
			jianpan(e);
		});
		idpw.keyup(function(e) {
			jianpan(e);
		});
		mail.keyup(function(e) {
			jianpan(e);
		});
	}
	registerAll();
});