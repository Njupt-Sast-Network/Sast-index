<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>南京邮电大学科学技术协会</title>
	<link rel="stylesheet" type="text/css" href="/Public/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/indexTop.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/index.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/login.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/register.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/indexMain.css">
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
	<!--轮播-->
		<div id="myCarousel" class="carousel slide carousel-fade">
		   <!-- 轮播（Carousel）指标 -->
		   <ol class="carousel-indicators">
		      <li data-target="#myCarousel" data-slide-to="0" 
		         class="active"></li>
		      <li data-target="#myCarousel" data-slide-to="1"></li>
		      <li data-target="#myCarousel" data-slide-to="2"></li>
		      <li data-target="#myCarousel" data-slide-to="3"></li>
		      <li data-target="#myCarousel" data-slide-to="4"></li>
		      <li data-target="#myCarousel" data-slide-to="5"></li>
		      <li data-target="#myCarousel" data-slide-to="6"></li>
		   </ol>   
		   <!-- 轮播（Carousel）项目 -->
		   <div class="carousel-inner">
		      <div class="item active">
		         <img src="/Public/images/home.jpg" alt="First slide">
		         <div class="introduce">
		         	<div class="frosted-glass"></div>
		         	<span class="introTitle">计算机部</span>
		         	<div class="introContent">计算机部是校科协的传统部门，主要负责开展计算机软件方面的竞赛、技术培训以及项目和科研工作，目前主要有以下几个研究方向：Windows编程，acm算法，linux系统，游戏开发。同时拥有若干个项目组和专业研究小组。</div>
		         </div>
		         <div class="continue">
		         	<a href="javascript:;" class="down">继续向下</a><a href="dddd">报名入口</a>
		         </div>
		      </div>
		      <div class="item">
		         <img src="/Public/images/inter.jpg"alt="Second slide">
		         <div class="introduce">
		         	<span class="introTitle">网络部</span>
		         	<div class="introContent">网络部是一个热衷于web前后端开发、网络安全和多媒体制作的技术部门。我们不仅喜欢热门的web前端技术，我们还研究数据库 服务器 http协议 web脚本语言(python php ruby and Node.js)等方面的知识使用。我们喜欢渗透、逆向的快感，我们还做的了视频拍的了绚丽的mv。</div>
		         </div>
		         <div class="continue">
		         	<a href="javascript:;" class="down">继续向下</a><a href="dddd">报名入口</a>
		         </div>
		      </div>
		      <div class="item">
		         <img src="/Public/images/dianzi.jpg"alt="Third slide">
		         <div class="introduce">
		         	<div class="frosted-glass"></div>
		         	<span class="introTitle">电子部</span>
		         	<div class="introContent">电子部由爱好硬件制作与应用的学生组成。主要职能是帮助广大学生熟悉单片机基本操作与原理并加以应用，提高学生对硬件的认识程度。主要研究电子电路，片上系统，数字电路，模拟电路等等相关的知识和技术。</div>
		         </div>
		         <div class="continue">
		         	<a href="javascript:;" class="down">继续向下</a><a href="dddd">报名入口</a>
		         </div>
		      </div>
		      <div class="item">
		         <img src="/Public/images/bangongshi.jpg"alt="fourth slide">
		         <div class="introduce">
		         	<div class="frosted-glass"></div>
		         	<span class="introTitle">办公室</span>
		         	<div class="introContent">办公室作为主席团和校科协各个部门的沟通纽带，是校科协运作的保障部门，与其他部门都有着紧密的联系。办公室的工作主要包括 ：人员的组织与调配 、 活动的策划与总结 、 成员档案的归类与整理 、 文案的编辑与制作以及账务管理等 。</div>
		         </div>
		         <div class="continue">
		         	<a href="javascript:;" class="down">继续向下</a><a href="dddd">报名入口</a>
		         </div>
		      </div>
		      <div class="item">
		         <img src="/Public/images/web.png" alt="Fifth slide">
		         <div class="introduce">
		         	<div class="frosted-glass"></div>
		         	<span class="introTitle">科宣部</span>
		         	<div class="introContent">科宣部全称科普宣传部，活跃在校科协各种宣传活动的第一线。用手绘展示科技风采，用网络传播科技文化，用视频呈现科技魅力，将科技与文艺紧密结合，把创新思想融入科技推广。</div>
		         </div>
		         <div class="continue">
		         	<a href="javascript:;" class="down">继续向下</a><a href="dddd">报名入口</a>
		         </div>
		      </div>
		      <div class="item">
		         <img src="/Public/images/wailian.jpg"alt="sixth slide">
		         <div class="introduce">
		         	<div class="frosted-glass"></div>
		         	<span class="introTitle">外联部</span>
		         	<div class="introContent">外联部，主要负责科协和外界的联系与日常活动的组织开展。其中包括校科协与企业之间的联系，科协与兄弟院校之间的联系，并经常举办讲座会谈等活动来增进相互之间的了解。</div>
		         </div>
		         <div class="continue">
		         	<a href="javascript:;" class="down">继续向下</a><a href="dddd">报名入口</a>
		         </div>
		      </div>
		      <div class="item">
		         <img src="/Public/images/shefa.jpg"alt="seventh slide">
		         <div class="introduce">
		         	<div class="frosted-glass"></div>
		         	<span class="introTitle">社会发展部</span>
		         	<div class="introContent">社团发展部主要负责科协与各直属社团之间的日常联系与发展，使直属社团与科协联系紧密，更好的发展。同时也负责科协中的创新创业版块，负责学校的创新创业工作及创新项目与产业孵化，积极动员同学们和各参赛队的创新创业工作。同时处理创新创业中心的日常工作。</div>
		         </div>
		         <div class="continue">
		         	<a href="javascript:;" class="down">继续向下</a><a href="dddd">报名入口</a>
		         </div>
		      </div>
   			</div>
		</div> 
		<section class="sectionOne">
			<div class="container">
				<br><br>
				<div class="row">
					<div class="col-md-1 title">
						<span class="glyphicon glyphicon-list-alt ii"></span>科协动态
						<div class="more"><a href="sdds">more <span class="glyphicon glyphicon-forward"></span></a></div>
					</div>
				</div>
				<div class="row row2">
					  <div class="col-md-3">
					  	<h4><?php echo ($news[0]["title"]); ?></h4>
						<div class="image">
							<img src="/Public/images/a1.png">
						</div>
						<p class="introduce">
						<?php echo ($news[0]["text"]); ?></p>
						<a href="dsfs">READ MORE</a>
					  </div>
					  <div class="col-md-3">
					  	<h4><?php echo ($news[1]["title"]); ?></h4>
						<div class="image">
							<img src="/Public/images/a1.png">
						</div>
						<p class="introduce">
						<?php echo ($news[1]["text"]); ?></p>
						<a href="dsfs">READ MORE</a>
					  </div>
					  <div class="col-md-3">
					  	<h4><?php echo ($news[2]["title"]); ?></h4>
						<div class="image">
							<img src="/Public/images/a1.png">
						</div>
						<p class="introduce">
						<?php echo ($news[2]["text"]); ?></p>
						<a href="dsfs">READ MORE</a>
					  </div>
				</div>
				<br><br>
				<div class="row row3" style="margin-top:80px" align="center">
					<div class="col-md-3"><span class="glyphicon glyphicon-blackboard"></span><p>开源平等</p></div>
					<div class="col-md-3"><span class="glyphicon glyphicon-send"></span><p>志存高远</p></div>
					<div class="col-md-3"><span class="glyphicon glyphicon-transfer"></span><p>薪火相传</p></div>
				</div>
				<div class="row row4" style="margin-top:80px;height:480px;">
					<div class="zhe"><span>科协这个大家庭</span></div>
					<div class="Box">
						<div class="smallBox">
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos pos3">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos2">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos2 pos3">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min2 allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce2 pos">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant contantBig">45646545</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min2 allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce2 pos">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant contantBig">45646545</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos pos3">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos2">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos2 pos3">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
						</div>
					</div>
					<div class="Box">
						<div class="smallBox">
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos pos4">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos2  pos4">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos2">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min2 allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce4 pos">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant contantBig">45646545</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min2 allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce4 pos">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant contantBig">高级研发工程师，就职于全球颇有影响力的搜索引擎公司，曾供职于新浪。负责移动客户端相关的服务端研发工作，对大流量业务、高并发业务有较多的经验与解决方案。技术极客，喜欢一切新特奇技术，希望把技术做到极致</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos pos4">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos2  pos4">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos2">
								<p class="name">花花</p>
								<p class="job">2015科宣部长</p>
								<p class="contant">45646545</p>
							</div>
						</div>
					</div>
				</div>			
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div class="container-fluid" style="background-color:#337D69">
				<div class="row"><h1>联系我们</h1></div>
				<div class="col-md-6">
					<br>
					<br>
					<p>地址:南京市栖霞区文苑路9号南京邮电大学大学生活动中心208</p>
					<p>邮箱:sast@njupt.edu.cn</p>
					<p>网址:http://www.njuptsast.org</p>
					<p>Copy right &copy;校科协网络部  <a style="color:#fff" href="https://github.com/teisan">https://github.com/teisan</a></p>
					<p>&copy;狒狒神 &copy;Shiratsuyu <a style="color:#fff" href="https://github.com/teisan">https://github.com/teisan</a></p>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-3">
				<br>
				<br>
					<p class="erwei">扫二维码关注南邮校科协微信号</p>
					<p >（录取查询方式之一）</p>
					<img src="/Public/images/getqrcode.jpeg" height="200" width="200">
					<br>
				<br>
				</div>
				
			</div>
		</section>
		<span id="hui" class="glyphicon glyphicon-menu-up"></span>
	<script type="text/javascript" src="/Public/js/jquery.js"></script>
	<script type="text/javascript" src="/Public/js/bootstrap.js"></script>
	<script type="text/javascript" src="/Public/js/index.js"></script>
	<script type="text/javascript" src="/Public/js/top.js"></script>
	<script type="text/javascript" src="/Public/js/Login.js"></script>
	<script type="text/javascript" src="/Public/js/register.js"></script>
	<script type="text/javascript" src="/Public/js/main.js"></script>
	<script type="text/javascript" src="/Public/js/tab.js"></script>
	<script type="text/javascript" src="/Public/js/lazyload.js"></script>
</body>
</html>