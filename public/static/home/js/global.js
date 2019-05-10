$('.shadow').on('mouseover',function(){
	$(this).addClass("lu-box-shadow");
});
$('.shadow').on('mouseleave',function(){
	$(this).removeClass("lu-box-shadow");
});
$('.like').on('click',function(){
	var that = this;
	var article_id = $(this).attr('data-value');
	var likes = $(this).html();
	$(this).html(parseInt(likes) + 1);
	$.post("/love", { article_id: article_id},function(data){
		// layer.msg('点赞成功',{
		// 	icon: 1,
		// 	yes: function(index){
		// 	}
		// });
		layer.tips('点赞成功！',that, {
		  tips: [1, '#5F9EA0'],
		  time: 2000
		});
	});
});
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
					layer.msg(result.msg);
					if(result.code == 1){
						layer.close(thisIndex);
						location.reload();
					}
				});
			}
	    });
	});