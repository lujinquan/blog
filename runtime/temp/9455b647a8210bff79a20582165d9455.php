<?php /*a:6:{s:35:"theme/index/default/blog\index.html";i:1547192299;s:37:"theme/index/default/block\layout.html";i:1547191154;s:37:"theme/index/default/block\header.html";i:1547190327;s:35:"theme/index/default/block\menu.html";i:1547190720;s:37:"theme/index/default/block\search.html";i:1547190671;s:37:"theme/index/default/block\footer.html";i:1547192159;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title>Lucas</title>
<link href="/static/home/css/bootstrap.css?v=<?php echo config('hisiphp.version'); ?>" type="text/css" rel="stylesheet" media="all">
<link href="/static/home/css/style.css?v=<?php echo config('hisiphp.version'); ?>" type="text/css" rel="stylesheet" media="all">
<!--web-font-->
<!-- <link href='http://fonts.useso.com/css?family=Playfair+Display:400,700,900,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.useso.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'> -->
<!--//web-font-->
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="keywords" content="个站 成长 记录 博客 技术"/>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //Custom Theme files -->
<!-- js -->
<script src="/static/home/js/jquery.min-2.2.1.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<!-- start-smoth-scrolling-->
<script type="text/javascript" src="/static/home/js/move-top.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script type="text/javascript" src="/static/home/js/easing.js?v=<?php echo config('hisiphp.version'); ?>"></script>	


<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
</script>

<!--//end-smoth-scrolling-->
</head>
<body>
	<!--navigation-->
	<div class="top-nav">
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-left">
						<li><a href="/" class="active">首页</a></li>
						<li><a href="/index.php/index/Tour/index">旅行</a></li>
						<li><a href="/index.php/index/Gallery/index">书屋</a></li>
						<li><a href="/index.php/index/Blog/index">博客</a></li>
						<li><a href="/index.php/index/Contact/index">关于我</a></li>
					</ul>
					<div class="social-icons">
						<ul>
							<li><a href="#"></a></li>
							<li><a href="#" class="fb"></a></li>
							<li><a href="#" class="gg"></a></li>
						</ul>	
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>	
		</nav>		
	</div>	
	<!--navigation-->
	<!--header-->
	<div class="header">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="/"><img src="/static/home/image/logo.png?v=<?php echo config('hisiphp.version'); ?>" alt=""></a>
			</div>	
			<form class="navbar-form navbar-right" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="搜索">
				</div>
				<button type="submit" class="btn btn-default" aria-label="Left Align">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				</button>
			</form>	
		</div>	
	</div>


<div class="blog">
	<div class="container">
		<ol class="breadcrumb">
			<li><a href="/index">首页</a></li>
			<li>博客</li>
		</ol>
		<div class="col-md-8 blog-left" >
			<div class="blog-info">
				<h4><a href="/singlepage">Mysql博客</a></h4>
				<p>上传自 &nbsp;<a href="#">Lucas</a> &nbsp;&nbsp;2018年07月17日 &nbsp;&nbsp; <a href="#">评论 (10)</a></p>
				<div class="blog-info-text">
					<div class="blog-img">
						<a href="/singlepage"> <img src="/static/home/image/img13.jpg?v=<?php echo config('hisiphp.version'); ?>" class="img-responsive zoom-img" alt=""/></a>
					</div>
					<h5><a href="/singlepage">旅行的真谛，不是运动，而是带动你的灵魂，去寻找到生命的春光。</a></h5>
					<p class="snglp">“清明时节雨纷纷，路上行人已断魂。”里面的“行人”正是去旅游。清明，草长莺飞，百花争艳，是旅游的最佳时期。他既没有七月那样酷热难熬，又没有九月那样一片凄凉，萧寂，也没有一月那样酷寒难耐。于是，决定去新建的清音公园去玩。</p>
					<a href="/singlepage" class="btn btn-primary hvr-rectangle-in">Read More</a>
				</div>	
			</div>	
			<div class="blog-info">
				<h4><a href="/singlepage">Linux博客</a></h4>
				<p>上传自 &nbsp;<a href="#">Lucas</a> &nbsp;&nbsp;2018年07月17日 &nbsp;&nbsp; <a href="#">评论 (10)</a></p>
				<div class="blog-info-text">
					<div class="blog-img">
						<a href="/singlepage"> <img src="/static/home/image/img14.jpg?v=<?php echo config('hisiphp.version'); ?>" class="img-responsive zoom-img" alt=""/></a>
					</div>
					<h5><a href="/singlepage">旅行的真谛，不是运动，而是带动你的灵魂，去寻找到生命的春光。</a></h5>
					<p class="snglp">“清明时节雨纷纷，路上行人已断魂。”里面的“行人”正是去旅游。清明，草长莺飞，百花争艳，是旅游的最佳时期。他既没有七月那样酷热难熬，又没有九月那样一片凄凉，萧寂，也没有一月那样酷寒难耐。于是，决定去新建的清音公园去玩。</p>
					<a href="/singlepage" class="btn btn-primary hvr-rectangle-in">Read More</a>
				</div>	
			</div>	
			<div class="blog-info">
				<h4><a href="/singlepage">Python博客</a></h4>
				<p>上传自 &nbsp;<a href="#">Lucas</a> &nbsp;&nbsp;2018年07月17日 &nbsp;&nbsp; <a href="#">评论 (10)</a></p>
				<div class="blog-info-text">
					<div class="blog-img">
						<a href="/singlepage"> <img src="/static/home/image/img15.jpg?v=<?php echo config('hisiphp.version'); ?>" class="img-responsive zoom-img" alt=""/></a>
					</div>
					<h5><a href="/singlepage">旅行的真谛，不是运动，而是带动你的灵魂，去寻找到生命的春光。</a></h5>
					<p class="snglp">“清明时节雨纷纷，路上行人已断魂。”里面的“行人”正是去旅游。清明，草长莺飞，百花争艳，是旅游的最佳时期。他既没有七月那样酷热难熬，又没有九月那样一片凄凉，萧寂，也没有一月那样酷寒难耐。于是，决定去新建的清音公园去玩。</p>
					<a href="/singlepage" class="btn btn-primary hvr-rectangle-in">Read More</a>
				</div>	
			</div>	
		</div>	
		<div class="col-md-4 single-page-right">
			<div class="category blog-ctgry">
				<h4>博客分类</h4>
				<div class="list-group">
					<a href="/singlepage" class="list-group-item">生活随想</a>
					<a href="/singlepage" class="list-group-item">PHP语言</a>
					<a href="/singlepage" class="list-group-item">Linux系统</a>
					<a href="/singlepage" class="list-group-item">Mysql语言</a>
					<a href="/singlepage" class="list-group-item">前端语言</a>
					<a href="/singlepage" class="list-group-item">Python语言</a>
					<a href="/singlepage" class="list-group-item">PHP框架</a>
					<a href="/singlepage" class="list-group-item">Django框架</a>
					
				</div>
			</div>	
			<div class="recent-posts">
				<h4>最新帖子</h4>
				<div class="recent-posts-info">
					<div class="posts-left sngl-img">
						<a href="/singlepage"> <img src="/static/home/image/img16.jpg?v=<?php echo config('hisiphp.version'); ?>" class="img-responsive zoom-img" alt=""/> </a>
					</div>
					<div class="posts-right">
						<lable>2018年07月18日</lable>
						<h5><a href="/singlepage">Laravel5.5 随笔</a></h5>
						<p>PHP的一款轻量且优雅的框架……</p>
						<a href="/singlepage" class="btn btn-primary hvr-rectangle-in">Read More</a>
					</div>
					<div class="clearfix"> </div>
				</div>	
				<div class="recent-posts-info">
					<div class="posts-left sngl-img">
						<a href="/singlepage"> <img src="/static/home/image/img17.jpg?v=<?php echo config('hisiphp.version'); ?>" class="img-responsive zoom-img" alt=""/></a>
					</div>
					<div class="posts-right">
						<lable>2018年07月18日</lable>
						<h5><a href="/singlepage">Git 踩过的坑 </a></h5>
						<p>一行代码让一天的工作白费了……</p>
						<a href="/singlepage" class="btn btn-primary hvr-rectangle-in">Read More</a>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="comments">
				<h4>最新评论</h4>
				<div class="comments-info">
					<div class="cmnt-icon-left">
						<a href="/singlepage"><img src="/static/home/image/icon1.png?v=<?php echo config('hisiphp.version'); ?>" alt=""/></a>
					</div>
					<div class="cmnt-icon-right">
						<p>2018年07月18日</p>
						<p><a href="/singlepage">Lucas</a></p>
					</div>
					<div class="clearfix"> </div>
					<p class="cmmnt">Laravel 5.5 是一个 LTS 版本，会提供为期 2 年的 bug 修复和为期 3 年的安全修复支持。</p>
				</div>
				<div class="comments-info cmnts-mddl">
					<div class="cmnt-icon-left">
						<a href="/singlepage"><img src="/static/home/image/icon1.png?v=<?php echo config('hisiphp.version'); ?>" alt=""/></a>
					</div>
					<div class="cmnt-icon-right">
						<p>2018年07月18日</p>
						<p><a href="/singlepage">Lucas</a></p>
					</div>
					<div class="clearfix"> </div>
					<p class="cmmnt">Laravel 5.5 是一个 LTS 版本，会提供为期 2 年的 bug 修复和为期 3 年的安全修复支持。</p>
				</div>
				<div class="comments-info">
					<div class="cmnt-icon-left">
						<a href="/singlepage"><img src="/static/home/image/icon1.png?v=<?php echo config('hisiphp.version'); ?>" alt=""/></a>
					</div>
					<div class="cmnt-icon-right">
						<p>2018年07月18日</p>
						<p><a href="/singlepage">Lucas</a></p>
					</div>
					<div class="clearfix"> </div>
					<p class="cmmnt">Laravel 5.5 是一个 LTS 版本，会提供为期 2 年的 bug 修复和为期 3 年的安全修复支持。</p>
				</div>
			</div>
		</div>
		<div class="clearfix"> </div>
		<nav>
			<ul class="pagination">
				<li>
					<a href="#" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li>
					<a href="#" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>	
</div>	
	


<div class="footer">
		<div class="container">
			<div class="col-md-4 about">
				<h3>关于我们</h3>	
				<p>半山里，凭高下视，千百的燕子，绕着殿儿飞。城垛般的围墙，白石的甬道，黄绿琉璃瓦的门楼，玲珑剔透。楼前是山上的晚霞鲜红，楼后是天边的平原村树，深蓝浓紫。暮霭里，融合在一起。难道是玉宇琼楼？难道是瑶宫贝阙？何用来搜索诗肠，且印下一幅图画。</p>
			</div>
			<div class="col-md-4 posts">
				<h3>热门文章</h3>
				<div class="media">
					<div class="media-left">
						<a href="/singlepage">
						  <img class="media-object thumbnail" src="/static/home/image/img11.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
						</a>
				    </div>
					<div class="media-body">
						<h4 class="media-heading"><a href="/singlepage">TOP 1</a></h4>
						<h5>2018年07月17日</h5>
					</div>
				</div>
				<div class="media">
					<div class="media-left">
						<a href="/singlepage">
						  <img class="media-object thumbnail" src="/static/home/image/img10.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
						</a>
				    </div>
					<div class="media-body">
						<h4 class="media-heading"><a href="/singlepage">TOP 2</a></h4>
						<h5>2018年07月17日</h5>
					</div>
				</div>
				<div class="media">
					<div class="media-left">
						<a href="/singlepage">
						  <img class="media-object thumbnail" src="/static/home/image/img11.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
						</a>
				    </div>
					<div class="media-body">
						<h4 class="media-heading"><a href="/singlepage">TOP 3</a></h4>
						<h5>2018年07月17日</h5>
					</div>
				</div>
			</div>
			<div class="col-md-4 address">
				<h3>联系地址</h3>
				<p>已若只生命的短暂，何必望雪思青春。在那个年轻气盛的夏季，怀揣梦想，扬帆起航，让饱满的精神代替一路的疲惫，让坚强的笑声偷换一路的泪水，让梦想的步伐超过徘徊的步履。</p>
				<ul>
					<li><span></span>湖北省武汉市洪山区xx街道xx社区xx栋xx单元xx号</li>
					<li><span class="ph-no"></span>+00 (123) 456 78 90</li>
					<li><span class="mail"></span><a href="mailto:example@mail.com">mail@example.com</a></li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<div class="copy-right">
		<div class="container">
			<p>Copyright &copy; 2015.Company name All rights reserved.<a target="_blank" href="http://sc.chinaz.com/moban/">&#x7F51;&#x9875;&#x6A21;&#x677F;</a></p>
		</div>
	</div>

	<!--smooth-scrolling-of-move-up-->
		<script type="text/javascript">
			$(document).ready(function() {
				/*
				var defaults = {
					containerID: 'toTop', // fading element id
					containerHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
				};
				*/
				
				$().UItoTop({ easingType: 'easeOutQuart' });
				
			});
		</script>
	
		<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!--//smooth-scrolling-of-move-up-->
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/static/home/js/bootstrap.js?v=<?php echo config('hisiphp.version'); ?>"></script>

</body>
</html>