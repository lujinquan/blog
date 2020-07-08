工作中可能会发现动态添加的dom元素上的事件无法触发，如何解决？

#### 一、场景代码如下
```
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <script typet="text/javascript" src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
    <div class="one">
        <span class="two" >
            <span>热爱：<input type="text" name="love"><span class="del" style="cursor:pointer;"> - </span></span>
        </span>
        <span class="three add" style="cursor:pointer"> + </span>
    </div>
</body>
</html>
<script type="text/javascript">
    $('.add').on('click',function(){
        var that = $('.add');
        var html = '<span class="two" ><span>热爱：<input type="text" name="love"><span class="del" style="cursor:pointer"> - </span></span></span>';
        console.log(that);
        that.before(html);
    });
    // 常规写法，无法触发
    $('.del').click(function(){
        var that = $(this);
        that.parent().remove();
    });
</script>
```
#### 二、改后的js代码如下
1、方案一：元素层级绑定的方式
```
<script type="text/javascript">
    $('.add').on('click',function(){
        var that = $('.add');
        var html = '<span class="two" ><span>热爱：<input type="text" name="love"><span class="del" style="cursor:pointer"> - </span></span></span>';
        console.log(that);
        that.before(html);
    });
    // 元素层级绑定
    $('.one').on('click','.del',function(){
        var that = $(this);
        that.parent().remove();
    });
</script>
```
2、方案二：行内事件绑定
```
<script type="text/javascript">
    $('.add').on('click',function(){
        var that = $('.add');
        var html = '<span class="two" ><span>热爱：<input type="text" name="love"><span class="del" onclick="del_tr(this)" style="cursor:pointer"> - </span></span></span>';
        console.log(that);
        that.before(html);
    });
    // 行内绑定
    function del_tr(obj){
    	var that = $(obj);
        that.parent().remove();
    }
</script>
```
> 提示：解决方式是，不直接绑定事件，而是代替为以父元素绑定子元素的方式