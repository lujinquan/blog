$('.shadow').on('mouseover',function(){
	$(this).addClass("lu-box-shadow");
});
$('.shadow').on('mouseleave',function(){
	$(this).removeClass("lu-box-shadow");
});
$('.like').on('click',function(){
	var article_id = $(this).attr('data-value');
	var likes = $(this).html();
	$(this).html(parseInt(likes) + 1);
	$.post("/index/blog/love", { article_id: article_id},function(data){
		// layer.msg('点赞成功',{
		// 	icon: 1,
		// 	yes: function(index){
		// 	}
		// });
		layer.tips('点赞成功！','.like', {
		  tips: [1, '#5F9EA0'],
		  time: 2000
		});
	});
});
