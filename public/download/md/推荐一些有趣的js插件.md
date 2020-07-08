给大家推荐几个有趣的插件，点缀下我们的网站
#### 一、推荐一款炫酷的js插件

1、[点此下载](href="http::/www.mylucas.com.cn/index/center/down.html?f=xxx")

2、在页面中引入canvas-nest.min.js即可完成调用
```
<script color="0,0,255" opacity='0.5' zIndex="-1" count="100" src="./canvas-nest.min.js"></script>
```
> 提示：参数有三个：color（线的颜色rgb格式），opacity（透明度），zIndex（z轴位置），count（线的数量）。

#### 二、推荐一款点击弹出“爱心”图案的js插件
1、[点此下载](href="http::/www.mylucas.com.cn/index/center/down.html?f=xxx")

2、在页面中引入love.js即可完成调用
```
<!-- 鼠标点击特效 S -->
    <script src="__HOME_JS__/love.js"></script>
    <script type="text/javascript">
	    $(window).scroll(function() {
	        if ($(window).scrollTop() > 100) {
	            $('#back-top').fadeIn(1000);
	        } else {
	            $("#back-top").fadeOut(1000);
	        }
	    });
	    $("#back-top").click(function() {
	        $('body,html').animate({
	            scrollTop: '0'
	        }, 1000);
	        return false;
	    })
	</script>
	<!-- 鼠标点击特效 E -->
```
#### 三、推荐一款点击弹出“礼花”图案的js插件
1、[点此下载](href="http::/www.mylucas.com.cn/index/center/down.html?f=xxx")

2、在页面中引入mouse-click.js即可完成调用
```
<!-- 鼠标点击特效_1 S -->
	<script src="__HOME_JS__/mouse-click.js"></script>
	<canvas width="1777" height="841" style="position: fixed; left: 0px; top: 0px; z-index: 2147483647; pointer-events: none;"></canvas>
	<!-- 鼠标点击特效_1 E -->
```
#### 四、推荐一款“猫咪”图案的js插件

```
<script src="https://eqcn.ajz.miesnfu.com/wp-content/plugins/wp-3d-pony/live2dw/lib/L2Dwidget.min.js"></script>
	<!-- 猫图案的位置 -->
	<div id="live2d-widget"><canvas id="live2dcanvas" width="200" height="400" style="position: fixed; opacity: 0.7; left: 70px; bottom: 0px; z-index: 1; pointer-events: none;"></canvas>
	</div>
	 <script>
	     L2Dwidget.init({
	          "model": {
	              jsonPath: "https://unpkg.com/live2d-widget-model-hijiki/assets/hijiki.model.json",<!--这里改模型，前面后面都要改-->
	              "scale": 1
	          },
	          "display": {
	              "position": "left",<!--设置看板娘的上下左右位置-->
	              "width": 100,
	              "height": 200,
	              "hOffset": 0,
	              "vOffset": 0
	          },
	          "mobile": {
	              "show": true,
	              "scale": 0.5
	          },
	          "react": {
	              "opacityDefault": 0.7,<!--设置透明度-->
	              "opacityOnHover": 0.2
	          }
	      });
	  window.onload = function(){
	       $("#live2dcanvas").attr("style","position: fixed; opacity: 0.7; left: 70px; bottom: 0px; z-index: 1; pointer-events: none;")
	  }
	  </script>
	  <!-- 猫特效 E -->
```