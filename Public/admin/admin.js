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
//新建一个vue实例
/*
分页组件
all是总条数
current是当前页数
type是当前搜索的种类
pages是总页数
*/
var manage = new Vue({
    el: "#theBiggest",
    data: {
        all: 0,
        current: 1,
        type: 0,
        pages: 0,
        tip: "",
        showTip: false,
        showUser: true,
        showText: false,
        showNews: false,
        showShare: false,
        users: [],
        news: [],
        results: [],
        problems: [],
        shareList:[],
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
        delUser: function(user,uid) {
            if (confirm("确定要删除此用户么？")) {
                var userInfo = {
                    id : uid,
                    type : manage.type
                };
                //此处是删除用户的ajax请求
                $.post("/index.php/Admin/index/deluser", userInfo, function(data) {
                    if (data.isdone) {
                        manage.tip = "操作成功!";
                        tipMake();
                        ajaxGet(0);
                    } else {
                        manage.tip = "操作失败!";
                        tipMake();
                    }
                });
            }
        },
        delNews: function(id) {
            if (confirm("确定要删除此条动态么？")) {
                var userInfo = {
                    id : id,
                    type : manage.type
                };
                //此处是删除动态的ajax请求
                $.post("/index.php/Admin/index/deluser", userInfo, function(data) {
                    if (data.isdone) {
                        manage.tip = "操作成功!";
                        tipMake();
                        ajaxGet();
                    } else {
                        manage.tip = "操作失败!";
                        tipMake();
                    }
                });
            }
        },
        delPro: function(id) {
            if (confirm("确定要删除此问题么？")) {
                var userInfo = {
                    id : id,
                    type : manage.type
                };
                //此处是删除动态的ajax请求
                $.post("/index.php/Admin/index/deluser", userInfo, function(data) {
                    if (data.isdone) {
                        manage.tip = "操作成功!";
                        tipMake();
                        ajaxGet();
                    } else {
                        manage.tip = "操作失败!";
                        tipMake();
                    }
                });
            }
        },
        delShare: function(id) {
            if (confirm("确定要删除此分享么？")) {
                var userInfo = {
                    id : id,
                    type : manage.type
                };
                //此处是删除分享的ajax请求
                $.post("/index.php/Admin/index/deluser", userInfo, function(data) {
                    if (data.isdone) {
                        manage.tip = "操作成功!";
                        tipMake();
                        ajaxGet();
                    } else {
                        manage.tip = "操作失败!";
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
//注册自定义过滤器
Vue.filter('reverse', function (value) {
    if(value == 1) {
        return "管理员";
    }else if(value == 2) {
        return "sast学长";
    }else return "普通";
})
function tipMake() {
    manage.showTip = true;
    setTimeout(function() {
        manage.showTip = false;
    }, 2000);
}
//打开网页请求数据
ajaxGet();

function ajaxGet() {
    var info = {
        type: manage.type,
        page: manage.current
    };
    $.post("/index.php/Admin/index/get", info, function(data) {
        manage.all = data.count;
        manage.pages = Math.ceil(manage.all / 5);
        switch(info.type) {
            case 0: manage.users = [].concat(data.card);break;
            case 1: manage.problems = [].concat(data.card);break;
            case 2: manage.news = [].concat(data.card);break;
            case 3: manage.shareList = [].concat(data.card);break;
        }
    }) 
}
//点击状态的切换
var navList = $(".container-fluid .navbar .collapse .nav li");
navList.each(function(index) {
    $(this).click(function() {
        switch (index) {
            //用户管理
            case 0:
                clear();
                $(this).addClass("active");
                manage.showText = false;
                manage.showNews = false;
                manage.showShare = false;
                $(".textContainer").removeClass("showText");
                manage.showUser = true;
                manage.type = 0;
                ajaxGet();
                break;
                //讨论区管理
            case 1:
                clear();
                navList.removeClass("active");
                $(this).addClass("active");
                manage.showNews = false;
                manage.showShare = false;
                editor.setValue("");
                $(".textContainer").removeClass("showText");
                manage.showUser = false;
                manage.showText = true;
                manage.type = 1;
                ajaxGet();
                break;
                //动态管理
            case 3:
                clear();    
                navList.removeClass("active");
                navList.eq(2).addClass("active");
                manage.showShare = false;
                manage.showText = false;
                manage.showNews = true;
                $(".textContainer").removeClass("showText");
                editor.setValue("");
                manage.showUser = false;
                manage.type = 2;
                ajaxGet();
                break;
            case 4:
                clear();
                navList.removeClass("active");
                navList.eq(2).addClass("active");
                manage.showShare = false;
                manage.showText = false;
                manage.showNews = false;
                $(".textContainer").addClass("showText");
                editor.setValue("");
                manage.showUser = false;
                break;
            // 分享列表
            case 5:
                clear();
                navList.removeClass("active");
                $(this).addClass("active");
                manage.showNews = false;
                editor.setValue("");
                $(".textContainer").removeClass("showText");
                manage.showUser = false;
                manage.showText = false;
                manage.showShare = true;
                manage.type = 3;
                ajaxGet();
                break;
        }
    });
});
var input = $("input"),intro = $(".simple");
function clear() {
    navList.removeClass("active");
    editor.setValue("");
    input.val("");
    intro.val("");
}
//提交按钮
function passText() {
   var exp = $("#textCon");
    exp.val(editor.getValue()); 
}

    