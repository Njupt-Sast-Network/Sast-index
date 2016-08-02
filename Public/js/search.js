//讨论组件
var taolunTemplate = new Vue({
	el:".taolun",
	data: {
		items:[],
		cons: [],
		more: false
	},
	methods:{
		getCon : function(id) {
			var info = {
				type : 1,
				id : id,
				page: 1,
			};
			$.post("/index.php/View/more",info,function(data) {
				if(data.length == 5 ) {
					taolunTemplate.more = true
				}
				taolunTemplate.cons = [].concat(data.card);
			})
		}
	}
});
//新闻组件
var xinwenTemplate = new Vue({
	el:".xinwen",
	data: {
		items:[],
	},
});
//wiki组件
var wikiTemplate = new Vue({
	el:".wiki",
	data: {
		items:[],
	}
});
/*
分页组件
all是总条数
current是当前页数
type是当前搜索的种类
pages是总页数
*/
var pageTemplate = new Vue({
	el:".pageAll",
	data: {
		all: 0,
		current: 1,
		type: 0,
		pages:0,
	},
	computed: {
		indexs: function(){
              var left = 1
              var right = this.pages
              var ar = [] 
              if(this.pages>= 11){
                if(this.current > 5 && this.current < this.pages-4){
                        left = this.current - 5
                        right = this.current + 4
                }else{
                    if(this.current<=5){
                        left = 1
                        right = 10
                    }else{
                        right = this.pages
                        left = this.pages -9
                    }
                }
             }
            while (left <= right){
                ar.push(left)
                left ++
            }   
            return ar
           },
	},
	methods: {
		changeBtn: function(item) {
			if(this.current != item) {		
				this.current = item;	
				loadContent(this.type);							
			}		
		},
		/*
		想到的优化方案：将加载过的页面内容对应的存在数组里，
		可以通过检查当前页是否被加载过，进行判断，
		优化目的：减少http请求。
		2333目前没时间进行性能优化
		*/
		add: function() {
			if(this.current != this.pages) {
				this.current ++;
				loadContent(this.type);
			}
		},
		less: function() {
			if(this.current != 1) {
				this.current --;
				loadContent(this.type);
			}
		},
		toFirst: function() {
			this.current = 1;
			loadContent(this.type);
		}
	}
});
loadContent(0);
//传输结果
ajaxGet();
function ajaxGet () {
	var putIn = $("div.findS .put"),
	sub = $("div.findS .btn");
	putIn.keyup(function(event) {
		var keycode = event.which;
		if (keycode == 13) {
			loadContent(pageTemplate.type);
		}
	});	
	sub.click(function() {
		loadContent(pageTemplate.type);
	});
}
//动态请求
(function() {
	var navList = $(".contant .rowBiggest .col-md-8 .rowNav ul li"),
	rowContant = $(".contant .rowBiggest .col-md-8 .rowContant"),
	loading = $(".contant .rowBiggest .col-md-8 .rowContant .loading");
//Vue的组件化写法
	var vm = new Vue({
		el:'.rowNav',
		components: {
			navli: {
				template: '#navtemplate',
				props:['msg'],
				data:function() {
					return {
						changeChoose: function(e) {
							if(!e.classList.contains("choose")) {
								$(".contant .rowBiggest .col-md-8 .rowNav ul .choose").removeClass("choose");
								e.classList.add("choose");
								pageTemplate.current = 1;
								var index = $(".contant .rowBiggest .col-md-8 .rowNav ul li").index(e);	
								switch(index) {
									//此处只是为了测试前端，，，，真正使用之后会用ajax请求完成数据的切换
									case 1 : $(".rowContant ul").hide();
											 $(".taolun").show();
											 loadContent(index);
											 break;
									case 2 : $(".rowContant ul").hide();
											 $(".xinwen").show();
											 loadContent(index);
											 break;
									case 3 : $(".rowContant ul").hide();
											 $(".wiki").show();
											 loadContent(index);
											 break;
								}				
							}
						}
					}
				}
			}
		}
	});
})();
//关于加载问题 
function loadContent(index) {
	var loading = $(".contant .rowBiggest .col-md-8 .rowContant .loading");
	var content = $(".put").val();
	loading.ajaxStart(function() {
			$(this).css("display","inline-block");
		}).ajaxComplete(function() {
			$(this).css("display","none");
		});
	$.ajax({
		type: "post",
		url : "/index.php/Index/Search/search",
		dataType:"json",
		data: {
			content: content,
			table: index,
			page: pageTemplate.current,
		},
		success:function(data) {
			//传入data.count调用分页函数
			paging(data.count,index);
			//搜索结果为0
			if(data.card.length == 0) {
				$(".searchTip").show();
				$(".searchTip .content").text(content);
			}else {
				$(".searchTip").hide();
			}
			//四个分区的渲染
			switch(index) {
				case 1: taolunTemplate.items = [];
				taolunTemplate.items= [].concat(data.card);
				break;
				case 2: xinwenTemplate.items = [];
				xinwenTemplate.items= [].concat(data.card);
				break;
				case 3: wikiTemplate.items = [];
				wikiTemplate.items= [].concat(data.card);
				break;	
			}
		}
	})
}
//分页函数
function paging(count,index) {
	
	//获取总条数的dom
	var total = $(".rowTip .number");
	//获取分页dom的父元素
	var pageParent = $(".pageAll");
	total.text(count);
	var pages = Math.ceil(count/7);
	if(count == 0) {
		pageTemplate.current = 1;
		pages = 1;
	}	
	//此处可优化
	$(".pageAll .pages").text(pages);
	pageTemplate.all = count;
	pageTemplate.pages = pages;
	pageTemplate.type = index;
}
//右边热搜的滚动
(function() {
	var rightRow = $(".contant .rowBiggest .col-md-3 .rightRow");
	//检测滑轮位移
	$(window).scroll(function() {
		if ($("html body").scrollTop() > 300) {
			rightRow.addClass("fix");
		}else {
			rightRow.removeClass("fix");		}
	})
})();
//评论收起展开
(function() {
	var openComment = $(".contant .rowBiggest .col-md-8 .rowContant .taolun .open"),
	count = true;
	openComment.click(function() {
		$(this).parent().next().slideToggle();
		if(count) {
			$(this).text("收起");
			count = false;
		}else {
			$(this).text("展开评论");
			count = true;
		}	
	})
})();




















