<?php /*a:6:{s:36:"theme/index/default/index\index.html";i:1547191348;s:37:"theme/index/default/block\layout.html";i:1547191154;s:37:"theme/index/default/block\header.html";i:1547190327;s:35:"theme/index/default/block\menu.html";i:1547190720;s:37:"theme/index/default/block\search.html";i:1547190671;s:37:"theme/index/default/block\footer.html";i:1547190425;}*/ ?>
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

	<!--//header-->
	<div class="banner">
		<!-- banner-text Slider starts Here -->
				<script src="/static/home/js/responsiveslides.min.js?v=<?php echo config('hisiphp.version'); ?>"></script>
				 <script>
					// You can also use "$(window).load(function() {"
						$(function () {
						// Slideshow 4
							$("#slider3").responsiveSlides({
							auto: true,
							pager:false,
							nav:true,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							$('.events').append("<li>before event fired.</li>");
							},
							after: function () {
								$('.events').append("<li>after event fired.</li>");
							}
						});	
					});
				</script>
			<!--//End-slider-script -->
			<div class="banner-title"> 
				<div class="container">
					<div  id="top" class="callbacks_container">
						<ul class="rslides" id="slider3">
							<li>
								<h5>《木兰词·拟古决绝词柬友》</h5>
								<h1></h1>
							</li>
							<li>
								<h5>人生若只如初见，何事秋风悲画扇？</h5>
								<h5>等闲变却故人心，却道故人心易变。</h5>
							</li>
							<li>
								<h5>骊山语罢清宵半，泪雨霖铃终不怨。</h5>
								<h5>何如薄幸锦衣郎，比翼连枝当日愿。 </h5>
							</li>
							
						</ul>	
					</div>
				</div>
            </div>	
	</div>		
	<div class="banner-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-4 bb-grids">
					<a href="/index.php/index/Singlepage/index" class="thumbnail">
					  <img src="/static/home/image/img1.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
					</a>
				</div>
				<div class="col-md-4 bb-grids">
					<a href="/singlepage" class="thumbnail">
					  <img src="/static/home/image/img2.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
					</a>
				</div>
				<div class="col-md-4 bb-grids">
					<a href="/singlepage" class="thumbnail">
					  <img src="/static/home/image/img3.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
					</a>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="row">
				<div class="col-md-4 bb-grids">
					<a href="/singlepage" class="thumbnail">
					  <img src="/static/home/image/img4.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
					</a>
				</div>
				<div class="col-md-4 bb-grids">
					<a href="/singlepage" class="thumbnail">
					  <img src="/static/home/image/img5.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
					</a>
				</div>
				<div class="col-md-4 bb-grids">
					<a href="/singlepage" class="thumbnail">
					  <img src="/static/home/image/img6.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
					</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>	
	</div>	
	<div class="banner-bottom">
		<div class="container">
			<h3>信步走下山门去，何曾想寻幽访胜？ </h3>
			<p>低头走着，—首诗的断句，忽然浮上脑海来。“四月江南无矮树，人家都在绿阴中。”何用苦忆是谁的著作，何用苦忆这诗的全文。只此已描画尽了山下的人家！</p>
		</div>
	</div>	
	<div class="features">
		<div class="container">
			<h3>巴金  《海上日出 》</h3>
			<div class="row">
				<div class="col-sm-6 col-md-4 featur-grids">
					<div class="thumbnail feature-thmbnl">
						<h4>峻青《秋色赋》</h4>
						<img src="/static/home/image/img7.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
						<div class="caption">
							<h5><a href="singlepage.html">好一派迷人的秋色啊!<a></h5>
							<p>其色惨淡，烟霏云敛……其意萧条，山川寂寥”的凄凉景色，更看不到那种“渥然丹者为槁木，黟然黑者为星星”的悲秋情绪</p>
							<a href="singlepage.html" class="btn btn-primary hvr-rectangle-in">更多……</a>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 featur-grids">
					<div class="thumbnail feature-thmbnl">
						<h4>峻青《秋色赋》</h4>
						<img src="/static/home/image/img8.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
						<div class="caption">
							<h5><a href="singlepage.html">好一派迷人的秋色啊!<a></h5>
							<p>其色惨淡，烟霏云敛……其意萧条，山川寂寥”的凄凉景色，更看不到那种“渥然丹者为槁木，黟然黑者为星星”的悲秋情绪</p>
							<a href="singlepage.html" class="btn btn-primary hvr-rectangle-in">更多……</a>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 featur-grids">
					<div class="thumbnail feature-thmbnl">
						<h4>峻青《秋色赋》</h4>
						<img src="/static/home/image/img9.jpg?v=<?php echo config('hisiphp.version'); ?>" alt="">
						<div class="caption">
							<h5><a href="singlepage.html">好一派迷人的秋色啊!<a></h5>
							<p>其色惨淡，烟霏云敛……其意萧条，山川寂寥”的凄凉景色，更看不到那种“渥然丹者为槁木，黟然黑者为星星”的悲秋情绪</p>
							<a href="singlepage.html" class="btn btn-primary hvr-rectangle-in">更多……</a>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
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