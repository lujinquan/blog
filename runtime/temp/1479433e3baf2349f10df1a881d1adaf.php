<?php /*a:6:{s:38:"theme/index/default/contact\index.html";i:1547192217;s:37:"theme/index/default/block\layout.html";i:1547191154;s:37:"theme/index/default/block\header.html";i:1547190327;s:35:"theme/index/default/block\menu.html";i:1547190720;s:37:"theme/index/default/block\search.html";i:1547190671;s:37:"theme/index/default/block\footer.html";i:1547192159;}*/ ?>
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


<style type="text/css">
	body, html {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
	#allmap{width:100%;height:500px;}
	p{margin-left:5px; font-size:14px;}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=m1devgrfGaqjsLycBZCm8egKV4uqFq7h"></script>
<div class="contact">
<div class="container">
	<ol class="breadcrumb">
		<li><a href="/index">首页</a></li>
		<li>联系我……</li>
	</ol>
	<!-- <div class="tesimonial"><h3>联系我……</h3></div> -->
</div>
<!-- <div class="space-4"></div> -->
<div class="container">
	<div class="col-xs-6 col-sm-3" style="margin-top:40px;" id="allmap">
		
	</div>
	<!-- <h4>地图</h4> -->
	<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14228.54849623564!2d-80.10342101116558!3d26.930867031043434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d93335441a6f7d%3A0xdc51486fff899a21!2sJupiter%2C+FL%2C+USA!5e0!3m2!1sen!2sin!4v1433741837407" frameborder="0" style="border:0"></iframe> -->
</div>
<div class="container">
	<div class="contact-form">
		<div class="col-md-4 contact-form-left">
			<h4>联系信息</h4>
			<p>旅行的意义其实是教会我们做独立的自我，习惯一个人的生活，不依赖，有自己的主见，能够独立的面对生活中的磨难与困苦。</p>					
		</div>
		<div class="col-md-8 contact-form-right">
			<h4>联系表单</h4>
			<form>
				<input type="text" value="姓名" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '姓名';}" required="">
				<input type="email" value="邮箱" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '邮箱';}" required="">
				<input type="text" value="联系方式" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '联系方式';}" required="">
				<textarea type="text"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '信息...';}" required="">信息...</textarea>
				<input type="submit" value="提交" >
			</form>
		</div>
		<div class="clearfix"></div>
	</div>
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
	// 百度地图API功能
	var map = new BMap.Map("allmap");
	var point = new BMap.Point(114.328035,30.562251);
	var marker = new BMap.Marker(point);  // 创建标注
	map.addOverlay(marker);              // 将标注添加到地图中
	map.centerAndZoom(point, 15);
	var opts = {
	  width : 200,     // 信息窗口宽度
	  height: 100,     // 信息窗口高度
	  title : "沙湖明珠6栋一单元" , // 信息窗口标题
	  enableMessage:true,//设置允许信息窗发送短息
	  message:"亲耐滴，晚上一起吃个饭吧？戳下面的链接看下地址喔~"
	}
	var infoWindow = new BMap.InfoWindow("地址：湖北省武汉市武昌区公正路18号", opts);  // 创建信息窗口对象 
	marker.addEventListener("click", function(){          
		map.openInfoWindow(infoWindow,point); //开启信息窗口
	});
</script>



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