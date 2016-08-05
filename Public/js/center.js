var editor = new Simditor({
    textarea: $('#editor'),
    toolbar: [
        'title',
        'bold',
        'italic',
        'underline',
        'strikethrough',
        'fontScale',
        'color',
        'ol',
        'ul',
        'blockquote',
        'code',
        'table',
        'link',
        'image',
        'hr',
        'indent',
        'outdent',
        'alignment'
    ],
    upload: {
        url: 'index.php/Admin/add/addimg', //文件上传的接口地址
        params: null, //键值对,指定文件上传接口的额外参数,上传的时候随文件一起提交
        fileKey: 'fileDataFileName', //服务器端获取文件数据的参数名
        connectionCount: 3,
        leaveConfirm: '正在上传文件...'
    },
    pasteImage: true
});
var a = b = c = false;
var center = new Vue({
    el: "#theBiggest",
    data: {
        userList: true,
        showInfo: false,
        type: 0,
        tip: null,
        showTip: false,
        username: "",
        mail: "",
        depart: "",
        brothers: false,
        userInfos: [],
        shareList:[],
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
            $.post("/index.php/Center/userinfo", function(data) {
                center.username = data.username;
                center.mail = data.mail;
                center.depart = data.department;
            });
        },
        setUserInfo: function() {
            //验证用户名
            this.username.length <= 16 && 3 <= this.username.length ? (a = false) : a = true;

            // if(this.username.match(/^\S+$/)&&this.username.length>=3&&this.username.length<=16)
            //     a = 1;
            // else
            //     a= 0;
            //验证邮箱
            this.mail.match(/\w+@\w+.\w/) ? (b = false) : b = true;
            //提交
            if (!a) {
                console.log(a)
                center.tip = "用户名格式不对!";
                tipMake();
            } else if (!b) {
                center.tip = "邮箱格式不对!";
                tipMake();
            } else {
                var userInfo = {
                    department: center.depart,
                    username: center.username,
                    mail: center.mail,
                    department: center.depart
                }
                $.post("/index.php/Center/changeinfo", userInfo, function(data) {
                    if (data.isdone) {
                        center.tip = "修改成功!";
                        tipMake();
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
                $.post("/index.php/Center/del", info, function(data) {
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
        delShare: function(id) {
            if (confirm("确定要删除此分享？")) {
                var info = {
                    id: id,
                    type: center.type
                };
                //此处是删除分享的ajax请求
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
                center.showWiki = true;
	        	center.showSendPro = false;
	        	center.showShareList = false;
	        	center.showShare = false;
	        	center.showInfo = false;
                $(this).addClass("active");
                center.type = 0;
                ajaxGet();
                break;
            case 1:
                clear();
                center.showWiki = false;
	        	center.showSendPro = true;
	        	center.showShareList = false;
	        	center.showShare = false;
	        	center.showInfo = false;
                $(this).addClass("active");
                center.type = 1;
                break;
            //share
            case 3:
                clear();
                center.showWiki = false;
	        	center.showSendPro = false;
	        	center.showShareList = true;
	        	center.showShare = false;
	        	center.showInfo = false;
                navList.eq(2).addClass("active");
                center.type = 3;
                ajaxGet();
                break;
            case 4:
                clear();
                center.showWiki = false;
	        	center.showSendPro = false;
	        	center.showShareList = false;
	        	center.showShare = true;
	        	center.showInfo = false;
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
    $.post("/index.php/Center/userwiki", info, function(data) {
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
        console.log(center.type)
        switch (info.type) {
            case 0:
                center.userInfos = [].concat(data.card);
                if(data.card.length == 0) {
                	alert("您暂时还没提过问题哟！");
                }
                break;
             case 3:
                 center.shareList = [].concat(data.card);
                 console.log(1);break;
               
        }
    })
}
