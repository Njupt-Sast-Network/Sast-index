<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>科协陈列馆</title>
	<script type="text/javascript" src="/Public/js/vue.js"></script>	
	<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/indexTop.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/login.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/register.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/search.css">
</head>
<body>
		<!--有点坑的导航-->
	<nav class="nav">
		<div class="container-fluid">
		<img src="/Public/images/blogo.png" alt="logo">
		<div class="navLi">
			<ul class="contentLi">
				<li><a href="<?php echo U('Index/Index/index');?>">首页</a></li>
				<li><a href="<?php echo U('Index/Search/index');?>">科协陈列馆</a></li>
				<?php if (!$_SESSION['userinfo']) { ?>				
				<li class="login" id="user"><a href="javascript:;">登录|注册</a></li>
				<li><a href="#">关于</a></li>
				<li><a href="javascript:;"><span class="glyphicon glyphicon-search searchBtn" aria-hidden="true"></span></a></li>
				<?php }else{ ?>
				<li><a href="#">关于</a></li>
				<li><a href="javascript:;"><span class="glyphicon glyphicon-search searchBtn" aria-hidden="true"></span></a></li>
				<li><a href='ddd'><?php echo ($_SESSION['userinfo']['username']); ?></a></li>
				<li><a href="/Index/Login/logout">退出</a></li>
				<?php } ?>

			</ul>
		</div>
		<div class="menu">
			<span class="glyphicon glyphicon-th-large"></span>
		</div>
		<div class="hideBar">
			<ul class="contentLi">
				<li><a href="<?php echo U('Index/Index/index');?>">首页</a></li>
				<li><a href="<?php echo U('Index/Search/index');?>">科协陈列馆</a></li>				
				<li id="user" class="willLogin">登录|注册</li>
				<li><a href="#">关于</a></li>
				<li>
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					<input type="text" class="searchBar" placeholder="按下Enter...Search..."></input>
				</li>
			</ul>
		</div>
		<div class="secondSearch" method="get">
			<form action="">
				<input type="text" class="searchBar" placeholder="Search..."></input>
				<input type="submit" class="sub" value="Submit"></input>
			</form>
		</div>
		</div>
	</nav>
	<!--登录-->
		<div id="shelter">
			<div class="conshelter">
				<div class="closed">×</div>
				<div class="tool login">
					<span class="login choosed">登录</span>
					<span class="register">注册</span>
				</div>
				<div class="loginContent">
					<ul>
						<li>
							<input type="text" placeholder="请输入3~16位用户名" class="putin username">
						<li>
							<input type="password" placeholder="请输入6~16位密码" class="putin password">
						</li>
						<li>
							<input type="text" placeholder="验证码" class="ver">
							<img src="<?php echo U('Index/Login/getverify',Math.array());?>" alt="验证码" id="Verifyimg" onClick="fleshVerify(this)">
							<a href="javascript:;" id="change" onClick="fleshVerify(document.getElementById('Verifyimg'))">(点击刷新)</a>
						</li>
						<span class="tip"></span>
						<button class="sub">登录</button>
					</ul>
				</div>
				<div class="resContent">
					<ul>
						<li>
							<input type="text" placeholder="请输入学号" class="putin idname">
						<li>
							<input type="password" placeholder="请输入正方密码" class="putin idpw">
						</li>
						<li>
							<input type="text" placeholder="请输入3~16位用户名" class="putin username">
						</li>
						<li>
							<input type="text" placeholder="请输入6~16位密码" class="putin password">
						</li>
						<li>
							<input type="text" placeholder="请输入邮箱" class="putin mail">
						</li>
						<li>
							<input type="text" placeholder="验证码" class="ver">
							<span class="tip2">验证码格式不对！</span>
							<img src="<?php echo U('Index/Login/getverify',Math.array());?>" alt="验证码" id="VerifyImg" onClick="fleshVerify(this)"><a href="javascript:;" id="change" onClick="fleshVerify(document.getElementById('VerifyImg'))">(点击刷新)</a>
						</li>
						<button class="sub">登录</button>
					</ul>
				</div>
			</div>
		</div>
	<script>
	function fleshVerify(img){ //重载验证码
		var time = new Date().getTime();
		img.src='<?php echo U("Index/Login/getverify",array());?>'
	}
	</script>
	<div class="findS">
		<div class="filter">
			<select v-model="selected" class="choice same">
				<option selected>关键字</option>
				<option>创作人</option>
			</select>
			<input type="text" class="put same" placeholder="请输入想搜索的内容...">
			<input type="button" class="same btn" value="搜索">
		</div>
	</div>
	<div class="contant">
		<div class="container">	
				<div class="row rowBiggest">
					<div class="col-md-8" >
						<div class="row rowNav">
							<ul>
								<navli msg="作品" class="choose"></navli>
								<navli msg="讨论区"></navli>
								<navli msg="新闻"></navli>
								<navli msg="学长分享"></navli>
							</ul>
						</div>
						<template id="navtemplate">
							<li @click="changeChoose($el)">{{msg}}</li>
						</template>
						<div class="row rowTip" style="background-color:#F9F9F9">
							<span class="spanTitle">为您搜索到相关答案<span class="number"></span>个</span>
						</div>
						<div class="row rowContant" style="min-height: 1000px;">
							<ul class="zuopin allUl">
								<template v-for="item in items">
								<li>
									<a href="dd" class="title">{{item.title}}</a>
									<p class="name">作者：{{item.author}}</p>
									<p class="xueyuan">学院：{{item.department}}</p>
									<p class="pContant">简介：{{item.text}}</p>
								</li>
								</template>			
							</ul>
								<ul class="taolun" style="display: none">
								<!--
									<template v-for="item in items">
									<li>
										<img :src="item.src" alt="用户头像" class="taolunImg"><span class="from">来自</span><a class="username">{{item.nickname}}</a>
										<p class="problem">{{item.problem}}</p>
										<div class="caozuo">
											<a href="javascript:;" class="ping">评论</a>&nbsp;&nbsp;
											<a href="javascript:;" class="open">展开评论</a>
										</div>
										评论内容不是第一次请求得到
										<div class="row comment">
											<div class="row small">
												<span class="name">狒狒神:</span>
												<span class="answer">你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档</span>
											</div>
										 	<a href="javascript:;" class="response">回复</a>
										</div>
									</li>
									</template>
									-->
									<li>
										<img src="/Public/images/img3.jpg" alt="用户头像" class="taolunImg"><span class="from">来自</span><a class="username">小泉花阳</a>
										<p class="problem">请问thinkphp中M函数的作用是什么？</p>
										<div class="caozuo">
											<a href="javascript:;" class="ping">评论</a>&nbsp;&nbsp;
											<a href="javascript:;" class="open">展开评论</a>
										</div>
										<div class="row comment">
											<div class="row small">
												<span class="name">狒狒神:</span>
												<span class="answer">你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档</span>
											</div>
										 	<a href="javascript:;" class="response">回复</a>
										</div>
									</li>
									<li>
										<img src="/Public/images/img3.jpg" alt="用户头像" class="taolunImg"><span class="from">来自</span><a class="username">小泉花阳</a>
										<p class="problem">请问thinkphp中M函数的作用是什么？</p>
										<div class="caozuo">
											<a href="javascript:;" class="ping">评论</a>&nbsp;&nbsp;
											<a href="javascript:;" class="open">展开评论</a>
										</div>
										<div class="row comment">
											<div class="row small">
												<span class="name">狒狒神:</span>
												<span class="answer">你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档</span>
											</div>
										 	<a href="javascript:;" class="response">回复</a>
										</div>
									</li>
									<li>
										<img src="/Public/images/img3.jpg" alt="用户头像" class="taolunImg"><span class="from">来自</span><a class="username">小泉花阳</a>
										<p class="problem">请问thinkphp中M函数的作用是什么？</p>
										<div class="caozuo">
											<a href="javascript:;" class="ping">评论</a>&nbsp;&nbsp;
											<a href="javascript:;" class="open">展开评论</a>
										</div>
										<div class="row comment">
											<div class="row small">
												<span class="name">狒狒神:</span>
												<span class="answer">你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档</span>
											</div>
										 	<a href="javascript:;" class="response">回复</a>
										</div>
									</li>
									<li>
										<img src="/Public/images/img3.jpg" alt="用户头像" class="taolunImg"><span class="from">来自</span><a class="username">小泉花阳</a>
										<p class="problem">请问thinkphp中M函数的作用是什么？</p>
										<div class="caozuo">
											<a href="javascript:;" class="ping">评论</a>&nbsp;&nbsp;
											<a href="javascript:;" class="open">展开评论</a>
										</div>
										<div class="row comment">
											<div class="row small">
												<span class="name">狒狒神:</span>
												<span class="answer">你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档你可以去查一下官方文档</span>
											</div>
										 	<a href="javascript:;" class="response">回复</a>
										</div>
									</li>

								</ul>
								<ul class="xinwen allUl" style="display: none">
								<!--
									<template v-for="item in items">
									<li>
										<img class="newsImg" :src="item.imgSrc">
										<div class="newsList"><a class="newTitle" :href="item.newsHref">{{item.title}}</a>
										<p class="news">{{item.text}}</p></div>
									</li>
									</template>
								-->
								<li>
										<img class="newsImg" src="/Public/images/a1.png">
										<div class="newsList"><a class="newTitle"href="item.newsHref">据说校科协网络部招新啦</a>
										<p class="news">据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦</p>
										<p style="float:right;">2016年5月10日</p></div>
									</li>
									<li>
										<img class="newsImg" src="/Public/images/a1.png">
										<div class="newsList"><a class="newTitle"href="item.newsHref">据说校科协网络部招新啦</a>
										<p class="news">据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦</p>
										<p style="float:right;">2016年5月10日</p></div>
									</li>
									<li>
										<img class="newsImg" src="/Public/images/a1.png">
										<div class="newsList"><a class="newTitle"href="item.newsHref">据说校科协网络部招新啦</a>
										<p class="news">据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦</p>
										<p style="float:right;">2016年5月10日</p></div>
									</li>
									<li>
										<img class="newsImg" src="/Public/images/a1.png">
										<div class="newsList"><a class="newTitle"href="item.newsHref">据说校科协网络部招新啦</a>
										<p class="news">据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦据说校科协网络部招新啦</p>
										<p style="float:right;">2016年5月10日</p></div>
									</li>

								</ul>
								<ul class="wiki allUl" style="display: none">
								<!--
									<template v-for="item in items">
									<li>
										<a class="wikiTitle" :href="wikiHref">{{item.title}}</a>
										<p class="wikiContent">{{item.text}}</p>
										<div class="more"><span class="author">{{item.author}}</span>&nbsp;&nbsp;<span class="time">{{item.timestamp}}</span></div>
									</li>
									</template>
								-->
								<li>
										<a class="wikiTitle" href="wikiHref">关于懒加载的实现</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是javascript程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者：sadpig</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="time">2016年5月4日</span></div>
									</li>
																	<li>
										<a class="wikiTitle" href="wikiHref">关于懒加载的实现</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是javascript程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者：sadpig</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="time">2016年5月4日</span></div>
									</li>
																	<li>
										<a class="wikiTitle" href="wikiHref">关于懒加载的实现</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是javascript程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者：sadpig</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="time">2016年5月4日</span></div>
									</li>
																	<li>
										<a class="wikiTitle" href="wikiHref">关于懒加载的实现</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是javascript程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者：sadpig</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="time">2016年5月4日</span></div>
									</li>
								</ul>
							<img src="/Public/images/loading.gif" height="40" width="40" alt="loading..." class="loading" style="display:none;">
							<div class="searchTip"><span class="notFind">没有关于“<span class="content"></span>”的搜索结果</span></div>
						</div>
						<!--分页-->
						<div class="row" style="margin-bottom:30px;">
							<ul class="pageAll" style="width: 100%;text-align: center;">
								<li class="page" @click="toFirst();">第一页</li>
								<li class="page" @click="less();">上一页</li>
								<li class="page" v-for="index in indexs" @click="changeBtn(index)">{{index}}</li>
								<li class="page" @click="add()">下一页</li>
								<li class="amount">{{current}}/<span class="pages"></span></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3">
						<div class="row rightRow" style="height:700px;">
							<div class="title">热门搜索</div>
							<a href="{这是链接}" class="s1">多写代码少装逼</a>
							<a href="{这是链接}" class="s2">多写代码少装逼</a>
							<a href="{这是链接}" class="s3">多写代码少装逼</a>
							<a href="{这是链接}" class="s4">多写代码少装逼</a>
							<a href="{这是链接}" class="s5">多写代码少装逼</a>
							<a href="{这是链接}" class="s6">多写代码少装逼</a>
							<a href="{这是链接}" class="s7">多写代码少装逼</a>
							<a href="{这是链接}" class="s8">多写代码少装逼</a>
							<a href="{这是链接}" class="s9">多写代码少装逼</a>
						</div>
					</div>
				</div>
		</div>
		<div class="container-fluid foot" style="background-color:#337D69;">
			<div class="row">
				<p style="color:#fff;margin-top:4px;margin-left:20px;">Copy right &copy;狒狒神 &copy;Shiratsuy   github:https://github.com/SoloJiang</p>
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="/Public/js/jquery.js"></script>
	<script type="text/javascript" src="/Public/js/bootstrap.js"></script>
	<script type="text/javascript" src="/Public/js/Login.js"></script>
	<script type="text/javascript" src="/Public/js/register.js"></script>
	<script type="text/javascript" src="/Public/js/index.js"></script>
	<script type="text/javascript" src="/Public/js/search.js"></script>
</body>
</html>