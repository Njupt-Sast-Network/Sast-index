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
        url: '/index.php/Center/addimg', //文件上传的接口地址
        params: null, //键值对,指定文件上传接口的额外参数,上传的时候随文件一起提交
        fileKey: 'fileDataFileName', //服务器端获取文件数据的参数名
        connectionCount: 3,
        leaveConfirm: '正在上传文件...'
    },
    pasteImage: true
});
//分享编辑器
var editorTwo = new Simditor({
    textarea: $('#editorTwo'),
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
        url: '/index.php/Center/addimg', //文件上传的接口地址
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
        brothers: true,
        userInfos: [],
        shareList: [],
        id: null,
        no: false,
        showWiki: false,
        showShareList: false,
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
            $(".showSendPro").removeClass("showText");
            this.showShareList = false;
            $(".showShare").removeClass("showText");
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
                        $("#nick").text(center.username);
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
        subPro: function() {
            var title = $(".proTitle").val(),
                proKey = $(".proKey").val(),
                content = editor.getValue(),
                simple  = $(".simple1").val();
            if (title == "" || proKey == "" || content == "" || simple == "") {
                center.tip = "不能有空信息!";
                tipMake();
            } else {
                //提交问题
                $.post("/index.php/Center/talkupload", { title: title, keywords: proKey, content: content ,simple:simple}, function(data) {
                    if (data.isdone) {
                        center.tip = "操作成功!";
                        tipMake();
                        input.val("");
                        editor.setValue("");
                    } else {
                        center.tip = "操作失败!";
                        tipMake();
                    }
                });
            }
        },
        subShare: function() {
            var title = $(".shareTitle").val(),
                proKey = $(".shareKey").val(),
                content = editorTwo.getValue();
                simple  = $(".simple2").val();
            if (title == "" || proKey == "" || content == "" || simple == "") {
                center.tip = "不能有空信息!";
                tipMake();
            } else {
                //提交问题
                $.post("/index.php/Center/wikiupload", { title: title, keywords: proKey, content: content ,simple:simple}, function(data) {
                    if (data.isdone) {
                        center.tip = "操作成功!";
                        tipMake();
                        input.val("");
                        editorTwo.setValue("");
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
                $(".showSendPro").removeClass("showText");
                center.showShareList = false;
                $(".showShare").removeClass("showText");
                center.showInfo = false;
                $(this).addClass("active");
                center.type = 0;
                ajaxGet();
                break;
            case 1:
                clear();
                center.showWiki = false;
                $(".showSendPro").addClass("showText");
                center.showShareList = false;
                $(".showShare").removeClass("showText");
                center.showInfo = false;
                $(this).addClass("active");
                center.type = 1;
                break;
                //share
            case 3:
                clear();
                center.showWiki = false;
                $(".showSendPro").removeClass("showText");
                center.showShareList = true;
                $(".showShare").removeClass("showText");
                center.showInfo = false;
                navList.eq(2).addClass("active");
                center.type = 3;
                ajaxGet();
                break;
            case 4:
                clear();
                center.showWiki = false;
                $(".showSendPro").removeClass("showText");
                center.showShareList = false;
                $(".showShare").addClass("showText");
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
    $(".simple").val("");
    center.showInfo = false;
    center.no = false;
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
    $.post("/index.php/Center/userwiki",info,function(data) {
        var n = data.level;
        if( n ==1 ) {
            window.location = "/Admin";
        }else if ( n ==2 ) {
            center.brothers = true;
        }
        center.all = data.count;
        center.pages = Math.ceil(center.all / 5);
        switch(info.type) {
            case 0:
                center.userInfos = [].concat(data.card);
                if(center.userInfos.length != 0) {
                    center.showWiki = true;
                }else {
                    center.showWiki = false;
                    center.no = true;
                }
                break;
            case 3:
                center.shareList = [].concat(data.card);
                if(center.shareList.length != 0) {
                    center.showShareList = true;
                }else {
                    center.showShareList = false;
                    center.no = true;
                }
                break;
        }
    })
}
