var userInfo;
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
        url: 'ImgUpload.action', //文件上传的接口地址
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
        users: []
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
        delUser: function(user) {
            if (confirm("确定要删除此用户么？")) {
                //此处是删除用户的ajax请求
                $.post("/index.php/Admin/index/deluser", userInfo, function(data) {
                    if (data.isdone) {
                        manage.tip = "操作成功!";
                        tipMake();
                        manage.users.$remove(user);
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
    $.post("/index.php/Admin/index/get",info,function(data) {
    	manage.all = data.all;
    	manage.pages= Math.ceil(manage.all/10);
    	manage.users = [].concat(data.card);
    })
}
//点击状态的切换
var navList = $(".container-fluid .navbar .collapse .nav li");
navList.each(function(index) {
    $(this).click(function() {
        switch (index) {
            //用户管理
            case 0:
                navList.removeClass("active");
                $(this).addClass("active");
                manage.showNews = false;
                manage.showText = false;
                manage.showUser = true;
                manage.type = 0;
                ajaxGet();
                break;
                //讨论区管理
            case 1:
                navList.removeClass("active");
                $(this).addClass("active");
                manage.showNews = false;
                manage.showText = false;
                manage.showUser = false;
                manage.type = 1;
                ajaxGet();
                break;
                //动态管理
            case 3:
                navList.removeClass("active");
                navList.eq(2).addClass("active");
                manage.showNews = true;
                manage.showText = false;
                manage.showUser = false;
                manage.type = 2;
                ajaxGet();
                break;
            case 4:
                navList.removeClass("active");
                navList.eq(2).addClass("active");
                manage.showNews = false;
                manage.showText = true;
                manage.showUser = false;
                break;
                //作品管理
            case 6:
                navList.removeClass("active");
                navList.eq(5).addClass("active");
                manage.showNews = false;
                manage.showText = false;
                manage.showUser = false;
                manage.type = 3;
                ajaxGet();
                break;
            case 7:
                navList.removeClass("active");
                navList.eq(5).addClass("active");
                manage.showNews = false;
                manage.showText = true;
                manage.showUser = false;
                break;
        }
    });
})
