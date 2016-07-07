<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>科协陈列馆</title>
	<script type="text/javascript" src="/sast/Public/js/vue.js"></script>	
	<link rel="stylesheet" type="text/css" href="/sast/Public/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/sast/Public/css/indexTop.css">
	<link rel="stylesheet" type="text/css" href="/sast/Public/css/login.css">
	<link rel="stylesheet" type="text/css" href="/sast/Public/css/register.css">
	<link rel="stylesheet" type="text/css" href="/sast/Public/css/search.css">
</head>
<body>
		<!--有点坑的导航-->
	<nav class="nav">
		<div class="container-fluid">
		<img src="/sast/Public/images/blogo.png" alt="logo">
		<div class="navLi">
			<ul class="contentLi">
				<li><a href="<?php echo U('Index/Index/index');?>">首页</a></li>
				<li><a href="<?php echo U('Index/Search/index');?>">科协陈列馆</a></li>				
				<li class="login" id="user"><a href="javascript:;">登录|注册</a></li>
				<li><a href="#">关于</a></li>
				<li><a href="javascript:;"><span class="glyphicon glyphicon-search searchBtn" aria-hidden="true"></span></a></li>
			</ul>
		</div>
		<div class="menu">
			<span class="glyphicon glyphicon-th-large"></span>
		</div>
		<div class="hideBar">
			<ul class="contentLi">
				<li><a href="<?php echo U('index');?>">首页</a></li>
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
							<span class="tip">用户名要在3~18位之间！</span></li>
						<li>
							<input type="password" placeholder="请输入6~16位密码" class="putin password">
							<span class="tip">密码不正确</span>
						</li>
						<li>
							<input type="text" placeholder="验证码" class="ver">
							<span class="tip2">验证码格式不对！</span>
							<img src="<?php echo U('Index/Login/getverify',Math.array());?>" alt="验证码" id="Verifyimg" onClick="fleshVerify(this)">
							<a href="javascript:;" id="change" onClick="fleshVerify(document.getElementById('Verifyimg'))">(点击刷新)</a>
						</li>
						<button class="sub">登录</button>
					</ul>
				</div>
				<div class="resContent">
					<ul>
						<li>
							<input type="text" placeholder="请输入学号" class="putin idname">
							<span class="tip">学号格式不正确</span></li>
						<li>
							<input type="password" placeholder="请输入正方密码" class="putin idpw">
							<span class="tip">正方密码不能为空</span></li>
						</li>
						<li>
							<input type="text" placeholder="请输入3~16位用户名" class="putin username">
							<span class="tip">用户名要在3~18位之间！</span></li>
						</li>
						<li>
							<input type="text" placeholder="请输入6~16位密码" class="putin password">
							<span class="tip">密码不正确</span>
						</li>
						<li>
							<input type="text" placeholder="请输入邮箱" class="putin mail">
							<span class="tip">邮箱不正确</span>
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
		img.src='<?php echo U('Index/Login/getverify',array());?>'
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
					<div class="col-md-8">
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
							<span class="spanTitle">为您搜索到相关答案<span class="number"><?php echo ($count); ?></span>个</span>
						</div>
						<div class="row rowContant">
							<ul class="zuopin allUl">
								<?php if(is_array($card)): $i = 0; $__LIST__ = $card;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li>
									<a href="{这是链接}" class="title"><?php echo ($data["title"]); ?></a>
									<p class="name">作者：<?php echo ($data["author"]); ?></p>
									<p class="xueyuan">关键字：<?php echo ($data["keyword"]); ?></p>
									<p class="pContant">简介：<?php echo ($data["text"]); ?></p>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>				
							</ul>
							<!--此处只是测试前端布局-->
								<ul class="taolun" style="display: none">
									<li>
										<div>
											<img src="/sast/Public/images/img3.jpg" alt="用户头像" class="taolunImg"><span class="from">来自</span><a class="username">刘云龙</a>
											<p class="problem">怎么使用thinkphp呢？</p>
											<div class="caozuo">
												<a href="javascript:;" class="ping">评论</a>&nbsp;&nbsp;
												<a href="javascript:;" class="open">展开评论</a>
											</div>
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
										<div>
											<img src="/sast/Public/images/img3.jpg" alt="用户头像" class="taolunImg"><span class="from">来自</span><a class="username">刘云龙</a>
											<p class="problem">怎么使用thinkphp呢？</p>
											<div class="caozuo">
												<a href="javascript:;" class="ping">评论</a>&nbsp;&nbsp;
												<a href="javascript:;" class="open">展开评论</a>
											</div>
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
										<div>
											<img src="/sast/Public/images/img3.jpg" alt="用户头像" class="taolunImg"><span class="from">来自</span><a class="username">刘云龙</a>
											<p class="problem">怎么使用thinkphp呢？</p>
											<div class="caozuo">
												<a href="javascript:;" class="ping">评论</a>&nbsp;&nbsp;
												<a href="javascript:;" class="open">展开评论</a>
											</div>
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
									<li>
										<img class="newsImg" src="/sast/Public/images/a1.png" alt="">
										<div class="newsList"><a class="newTitle" href="ddddd">据说校科协网络部要招新啦</a>
										<p class="news">即日起凭本人身份证学生证到顾学姐处登记报名即可获赠mac pro一台，这可是由网络部部长顾学姐亲自掏钱购买的哟，并且附有顾学姐的亲笔签名一套，先来先得。。。。</p></div>
									</li>
									<li>
										<img class="newsImg" src="/sast/Public/images/a1.png" alt="">
										<div class="newsList"><a class="newTitle" href="ddddd">据说校科协网络部要招新啦</a>
										<p class="news">即日起凭本人身份证学生证到顾学姐处登记报名即可获赠mac pro一台，这可是由网络部部长顾学姐亲自掏钱购买的哟，并且附有顾学姐的亲笔签名一套，先来先得。。。。</p></div>
									</li>
									<li>
										<img class="newsImg" src="/sast/Public/images/a1.png" alt="">
										<div class="newsList"><a class="newTitle" href="ddddd">据说校科协网络部要招新啦</a>
										<p class="news">即日起凭本人身份证学生证到顾学姐处登记报名即可获赠mac pro一台，这可是由网络部部长顾学姐亲自掏钱购买的哟，并且附有顾学姐的亲笔签名一套，先来先得。。。。即日起凭本人身份证学生证到顾学姐处登记报名即可获赠mac pro一台，这可是由网络部部长顾学姐亲自掏钱购买的哟，并且附有顾学姐的亲笔签名一套，先来先得。。。。</p></div>
									</li>
									<li>
										<img class="newsImg" src="/sast/Public/images/a1.png" alt="">
										<div class="newsList"><a class="newTitle" href="ddddd">据说校科协网络部要招新啦</a>
										<p class="news">即日起凭本人身份证学生证到顾学姐处登记报名即可获赠mac pro一台，这可是由网络部部长顾学姐亲自掏钱购买的哟，并且附有顾学姐的亲笔签名一套，先来先得。。。。即日起凭本人身份证学生证到顾学姐处登记报名即可获赠mac pro一台，这可是由网络部部长顾学姐亲自掏钱购买的哟，并且附有顾学姐的亲笔签名一套，先来先得。。。。即日起凭本人身份证学生证到顾学姐处登记报名即可获赠mac pro一台，这可是由网络部部长顾学姐亲自掏钱购买的哟，并且附有顾学姐的亲笔签名一套，先来先得。。。。</p></div>
									</li>
									<li>
										<img class="newsImg" src="/sast/Public/images/a1.png" alt="">
										<div class="newsList"><a class="newTitle" href="ddddd">据说校科协网络部要招新啦</a>
										<p class="news">即日起凭本人身份证学生证到顾学姐处登记报名即可获赠mac pro一台，这可是由网络部部长顾学姐亲自掏钱购买的哟，并且附有顾学姐的亲笔签名一套，先来先得。。。。</p></div>
									</li>
									<li>
										<img class="newsImg" src="/sast/Public/images/a1.png" alt="">
										<div class="newsList"><a class="newTitle" href="ddddd">据说校科协网络部要招新啦</a>
										<p class="news">即日起凭本人身份证学生证到顾学姐处登记报名即可获赠mac pro一台，这可是由网络部部长顾学姐亲自掏钱购买的哟，并且附有顾学姐的亲笔签名一套，先来先得。。。。</p></div>
									</li>
									<li>
										<img class="newsImg" src="/sast/Public/images/a1.png" alt="">
										<div class="newsList"><a class="newTitle" href="ddddd">据说校科协网络部要招新啦</a>
										<p class="news">即日起凭本人身份证学生证到顾学姐处登记报名即可获赠mac pro一台，这可是由网络部部长顾学姐亲自掏钱购买的哟，并且附有顾学姐的亲笔签名一套，先来先得。。。。</p></div>
									</li>
								</ul>
								<ul class="wiki allUl" style="display: none">
									<li>
										<a class="wikiTitle" href="sss">如何实现懒加载？</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是js程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者:sadpig</span>&nbsp;&nbsp;<span class="time">2016年5月25日</span></div>
									</li>
									<li>
										<a class="wikiTitle" href="sss">如何实现懒加载？</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是js程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者:sadpig</span>&nbsp;&nbsp;<span class="time">2016年5月25日</span></div>
									</li>
									<li>
										<a class="wikiTitle" href="sss">如何实现懒加载？</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是js程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者:sadpig</span>&nbsp;&nbsp;<span class="time">2016年5月25日</span></div>
									</li>
									<li>
										<a class="wikiTitle" href="sss">如何实现懒加载？</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是js程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者:sadpig</span>&nbsp;&nbsp;<span class="time">2016年5月25日</span></div>
									</li>
									<li>
										<a class="wikiTitle" href="sss">如何实现懒加载？</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是js程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者:sadpig</span>&nbsp;&nbsp;<span class="time">2016年5月25日</span></div>
									</li>
									<li>
										<a class="wikiTitle" href="sss">如何实现懒加载？</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是js程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者:sadpig</span>&nbsp;&nbsp;<span class="time">2016年5月25日</span></div>
									</li>
									<li>
										<a class="wikiTitle" href="ddd">如何实现懒加载？</a>
										<p class="wikiContent">懒加载技术(简称lazyload)并不是新技术, 它是js程序员对网页性能优化的一种方案.lazyload的核心是按需加载.在大型网站中都有lazyload的身影,例如谷歌的图片搜索页,迅雷首页，淘宝网,QQ空间等.因此掌握lazyload技术是个不错的选择,可惜jquery插件lazy load官网(http://www.appelsiini.net/projects/lazyload)称不支持新版浏览器。</p>
										<div class="more"><span class="author">作者:sadpig</span>&nbsp;&nbsp;<span class="time">2016年5月25日</span></div>
									</li>
								</ul>
							<img src="/sast/Public/images/loading.gif" height="40" width="40" alt="loading..." class="loading" style="display:none;">
						</div>
						<div class="row" style="width: 100%;margin-bottom:30px;" align="center">
							<div class="pageAll"><?php echo ($page); ?></div>								
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
	
	<script type="text/javascript" src="/sast/Public/js/jquery.js"></script>
	<script type="text/javascript" src="/sast/Public/js/bootstrap.js"></script>
	<script type="text/javascript" src="/sast/Public/js/Login.js"></script>
	<script type="text/javascript" src="/sast/Public/js/register.js"></script>
	<script type="text/javascript" src="/sast/Public/js/index.js"></script>
	<script type="text/javascript" src="/sast/Public/js/search.js"></script>
</body>
</html>