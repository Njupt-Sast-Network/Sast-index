var a = b = c = null;

var center = new Vue({
    el: "#theBiggest",
    data: {
        userList: true,
        showInfo: false,
        type: 0,
        tip: null,
        showTip: false,
        username: null,
        mail: null,
        depart: null,
        brothers: false,
        userInfos: [],
        id: null,
        showWiki: true,
        showSendPro : false,
        showShareList: false,
        showShare : false,
        current: 1,
        all: 0,
        pages: 0
    },
    computed: {
        indexs: function() {
            var left = 1
            var right = this.pages
            var ar = []
            if (this.pages >= 11) {
                if (this.current > 5 && this.current < this.pages - 4) {
                    left = this.current - 5
                    right = this.current + 4
                } else {
                    if (this.current <= 5) {
                        left = 1
                        right = 10
                    } else {
                        right = this.pages
                        left = this.pages - 9
                    }
                }
            }
            while (left <= right) {
                ar.push(left)
                left++
            }
            return ar
        },
    },
    methods: {
        getUserInfo: function() {
        	this.showWiki = false;
        	this.showSendPro = false;
        	this.showShareList = false;
        	this.showShare = false;
            this.showInfo = true;
            //请求用户信息
            $.post("index.php/Center/userinfo", function(data) {
                $(".username").val(data.username);
                $(".mail").val(data.mail);
                $(".depart").val(data.depart);
            });
        },
        setUserInfo: function() {
            //验证用户名
            this.username.length <= 16 && 3 <= this.username.length ? a = true : a = false;
            //验证邮箱
            this.mail.match(/\w+@\w+.\w/) ? b = true : b = false;
            //提交
            if (a) {
                center.tip = "用户名格式不对!";
                tipMake();
            } else if (b) {
                center.tip = "邮箱格式不对!";
                tipMake();
            } else {
                var userInfo = {
                    id: center.id,
                    username: username,
                    mail: mail
                }
                $.post("修改用户名的url", userInfo, function(data) {
                    if (data.isdone) {
                        center.tip = "修改成功!";
                        tipMake();
                        input.val("")
                    } else {
                        center.tip = "修改失败!";
                        tipMake();
                    }
                })
            }
        },
        delPro: function(id) {
            if (confirm("确定要删除此问题？")) {
                var info = {
                    id: id,
                    type: center.type
                };
                //此处是删除问题的ajax请求
                $.post("url", info, function(data) {
                    if (data.isdone) {
                        center.tip = "操作成功!";
                        tipMake();
                        ajaxGet(0);
                    } else {
                        center.tip = "操作失败!";
                        tipMake();
                    }
                });
            }
        },
        //分页函数
        changeBtn: function(item) {
            if (this.current != item) {
                this.current = item;
                ajaxGet();
            }
        },
        add: function() {
            if (this.current != this.pages) {
                this.current++;
                ajaxGet();
            }
        },
        less: function() {
            if (this.current != 1) {
                this.current--;
                ajaxGet();
            }
        },
        toFirst: function() {
            this.current = 1;
            ajaxGet();
        }
    }
});
//点击状态的切换
var navList = $(".container-fluid .navbar .collapse .nav li");
navList.each(function(index) {
    $(this).click(function() {
        switch (index) {
            //wiki
            case 0:
                clear();
                this.showWiki = true;
	        	this.showSendPro = false;
	        	this.showShareList = false;
	        	this.showShare = false;
	        	this.showInfo = false;
                $(this).addClass("active");
                center.type = 0;
                ajaxGet();
                break;
            case 1:
                clear();
                this.showWiki = false;
	        	this.showSendPro = true;
	        	this.showShareList = false;
	        	this.showShare = false;
	        	this.showInfo = false;
                $(this).addClass("active");
                center.type = 1;
                break;
            //share
            case 3:
                clear();
                this.showWiki = false;
	        	this.showSendPro = false;
	        	this.showShareList = true;
	        	this.showShare = false;
	        	this.showInfo = false;
                navList.eq(2).addClass("active");
                center.type = 3;
                ajaxGet();
                break;
            case 4:
                clear();
                this.showWiki = false;
	        	this.showSendPro = false;
	        	this.showShareList = false;
	        	this.showShare = true;
	        	this.showInfo = false;
                navList.eq(2).addClass("active");
                center.type = 4;
                break;
        }
    });
});
var input = $("input");

function clear() {
    navList.removeClass("active");
    input.val("");
    center.showInfo = false;
}

function tipMake() {
    center.showTip = true;
    setTimeout(function() {
        center.showTip = false;
    }, 2000);
}
//打开页面请求数据
ajaxGet();
function ajaxGet() {
    var info = {
        type: center.type,
        page: center.current
    };
    $.post("/Center/userwiki", info, function(data) {
        switch (data.level) {
            //此处是管理员跳转
            case 1:
                window.location = "__ROOT__/index.php/Admin";
                break;
                //学长分享
            case 2:
                center.brothers = true;
                break;
        }
        center.all = data.count;
        center.pages = Math.ceil(center.all / 5);
        switch (info.type) {
            case 1:
                center.userInfos = [].concat(data.card);
                if(data.card.length == 0) {
                	alert("您暂时还没提过问题哟！");
                }
                break;
        }
    })
}
