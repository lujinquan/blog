$('.shadow').on('mouseover',function(){
	$(this).addClass("lu-box-shadow");
});
$('.shadow').on('mouseleave',function(){
	$(this).removeClass("lu-box-shadow");
});
// 文章点赞
$('.like').on('click',function(){
	var that = this;
	var article_id = $(this).attr('data-value');
	var likes = $(this).html();
	$(this).html(parseInt(likes) + 1);
	$.post("/love", { article_id: article_id},function(data){
		layer.tips('点赞成功！',that, {
		  tips: [1, '#5F9EA0'],
		  time: 2000
		});
	});
});
// 评论点赞
$('.like-replay').on('click',function(){
	var that = this;
	var com_id = $(this).attr('data-value');
	var likes = $(this).html();
	$(this).html(parseInt(likes) + 1);
	$.post("/response_love", { com_id: com_id},function(data){
		layer.tips('点赞成功！',that, {
		  tips: [1, '#5F9EA0'],
		  time: 2000
		});
	});
});
// 评论提交
$('.submit').on('click',function(){
	var article_id = $('#article_id').val();
	var com_content = $('#com_content').val();
	$.post("/com", { article_id: article_id,com_content: com_content},function(data){
		layer.msg(data.msg,{
			icon: -1,
			offset: '30px',
			// time: 2000,
			// shade : [0.5 , '#000' , true]
		},function(){
			if(data.code == 1){
				location.reload();
			}
		});
	});
});
$('.replay').on('click',function(data){
	var com_pid = $(this).attr('data-value')
	layer.open({
		type:1,
		area:['500px','200px'],
		resize:false,
		zIndex:100,
		title:false,
		closeBtn:0,
		//title:['回复','font-size:1.6rem;font-weight:600;'],
		btn:['回复','取消'],
		content:'<textarea id="re-sponse" style="display:block;resize:none;width:100%;height:100%;"></textarea>',
		succcess:function(){

		},
		yes:function(thisIndex){
			var com_content = $('#re-sponse').val();
			console.log(thisIndex);
			console.log(com_pid);
			// var data = {'com_pid':com_pid,'com_content':com_content};
			console.log($('#re-sponse').val());
			$.ajax({
				url:"/replay",
				type:"post",
				data:"com_pid="+com_pid+"&com_content="+com_content,
				dataType:'JSON',
				processData: false,
        		contentType: false
			}).done(function(result){
				layer.msg(result.msg,{
					icon: -1,
					offset: '30px',
				},function(){
					if(result.code == 1){
						location.reload();
					}
				});
			});
		}
    });
});