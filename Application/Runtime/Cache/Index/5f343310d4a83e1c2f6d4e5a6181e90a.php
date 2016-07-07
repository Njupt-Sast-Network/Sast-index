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
		      <li data-target="#myCarousel" data-slide-to="7"></li>

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
		      <div class="item">
		         <img src="/Public/images/organize.jpg"alt="seventh slide">
		         <div class="introduce">
		         	<div class="frosted-glass"></div>
		         	<span class="introTitle">赛事部</span>
		         	<div class="introContent">赛事部主要负责校科协举办的各类重大比赛，例如创新杯，挑战杯等等，赛事部的部员们为每一次比赛默默付出，确保比赛举办成功。</div>
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
								<p class="name">崔天昊</p>
								<p class="job">现任通院科协主席</p>
								<p class="contant">研究方向web前端，并有一定经验。</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos pos3">
								<p class="name">董家睿</p>
								<p class="job">2015届网络部副部长</p>
								<p class="contant">研究方向web后端，尤其对thinkphp的使用较为熟悉</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos2">
								<p class="name">倪丁凡</p>
								<p class="job">2015届电子部讲师</p>
								<p class="contant">之前研究硬件方向，现在主要研究ios开发</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos2 pos3">
								<p class="name">顾怡</p>
								<p class="job">2015届网络部部长</p>
								<p class="contant">web知识面广，研究web前端方向，经验较为丰富。</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min2 allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce2 pos">
								<p class="name">奚佳伟</p>
								<p class="job">2013届网络部部长</p>
								<p class="contant contantBig">web前端工程师，南邮前端第一人，前端经验非常丰富，曾在阿里巴巴，百度实习，现就职于百度公司。开发过各种网站，大学期间通过写代码，自己挣生活费，让自己的优秀成为一种习惯。</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min2 allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce2 pos">
								<p class="name">孙放</p>
								<p class="job">科协传奇人物</p>
								<p class="contant contantBig">放叔，全称孙放，江湖人称鼎山女尸，曾任校科协主席，现担任阿里高级产品经理。个人经典语录：Bug总是会有的，不会凭空消失，也不会凭空产生，它总是从一段代码转移到另一段代码中，从一种影响转换为另一种影响，在转移和转换的过程中，bug的总量是不变的。</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos">
								<p class="name">刘强胜</p>
								<p class="job">2015届计算机部部长</p>
								<p class="contant">主要研究方向是python，经验较为丰富。</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos pos3">
								<p class="name">郑致远</p>
								<p class="job">2015届计算机部副部长</p>
								<p class="contant">主要研究java，其他各类语言都比较熟悉，擅长于acm比赛。</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos2">
								<p class="name">周捷</p>
								<p class="job">2015届网络部网安组组长</p>
								<p class="contant">擅长于渗透等信安技术，多次提交网站漏洞，ctf比赛成绩优异。</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce1 pos2 pos3">
								<p class="name">褚鑫强</p>
								<p class="job">2014届网络部部长</p>
								<p class="contant">web前端工程师，web技术较为全面，经验较为丰富。</p>
							</div>
						</div>
					</div>
					<div class="Box">
						<div class="smallBox">
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos pos4">
								<p class="name">张丹阳</p>
								<p class="job">2015届主席团</p>
								<p class="contant">主持过科协大大小小活动，功不可没。</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos">
								<p class="name">叶子新</p>
								<p class="job">2015届办公室主任</p>
								<p class="contant">将科协内部交流梳理的有条不紊，做事非常周全细致。</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos2  pos4">
								<p class="name">徐铄芮</p>
								<p class="job">2015届科宣部副部长</p>
								<p class="contant">外表甜美，擅长ps等多媒体技术，在科协宣传工作中起到很大作用。</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos2">
								<p class="name">李赫</p>
								<p class="job">2015届科宣部部长</p>
								<p class="contant">性格爽朗，为科协宣传全力付出。</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min2 allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce4 pos">
								<p class="name">黄诚博</p>
								<p class="job">2015届技术中心主席</p>
								<p class="contant contantBig">在担任主席期间，尽职尽责，本人技术过硬。ACM-ICPC亚洲区域赛（北京站）铜奖；南京邮电大学第六届程序设计大赛一等奖等等，为科协的部员起着学习榜样的作用。</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min2 allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce4 pos">
								<p class="name">樊超</p>
								<p class="job">2013届计算机部部长</p>
								<p class="contant contantBig">曾在Red Hat (Linux内核)实习，现在就职于富士通，兴趣点在于Linux的学习与开发。虽然是物理专业出身，但是编程着实厉害。</p>
							</div>
						</div>
						<div class="smallBox">
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos pos4">
								<p class="name">曹文</p>
								<p class="job">2015届外联部部长</p>
								<p class="contant">组织过各种科协与外界的交流活动。</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos">
								<p class="name">朱立宇</p>
								<p class="job">2015届电子部长</p>
								<p class="contant">研究方向在硬件开发，兴趣驱使，经验丰富。</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos2  pos4">
								<p class="name">王悉宇</p>
								<p class="job">2015届网络部核心部员</p>
								<p class="contant">对各种计算机技术非常感兴趣，也乐于与其他部员交流自己的学习成果。</p>
							</div>
							<div class="min allmin">
								<img src="/Public/images/lazy.jpg" alt="">
							</div>
							<div class="introduce introduce3 pos2">
								<p class="name">陶黎成</p>
								<p class="job">2015届计算机部核心部员</p>
								<p class="contant">擅长acm比赛，为人随和，在同届当中技术较为出色。</p>
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