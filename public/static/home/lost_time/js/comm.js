$(document).ready(function() {
    //nav     
    var obj = null;
    var As = document.getElementById('starlist').getElementsByTagName('a');
    obj = As[0];
    for (i = 1; i < As.length; i++) {
        if (window.location.href.indexOf(As[i].href) >= 0) obj = As[i];
    }
    //obj.id = 'selected';
    //nav
    $("#mnavh").click(function() {
        $("#starlist").toggle();
        $("#mnavh").toggleClass("open");
    });
    //search  
    $(".searchico").click(function() {
        $(".search").toggleClass("open");
    });
    //searchclose 
    $(".searchclose").click(function() {
        $(".search").removeClass("open");
    });
    //banner
    $('#banner').easyFader();
    //nav menu   
    $(".menu").click(function(event) {
        $(this).children('.sub').slideToggle();
    });
    //tab
    $('.tab_buttons li').click(function() {
        $(this).addClass('newscurrent').siblings().removeClass('newscurrent');
        $('.newstab>div:eq(' + $(this).index() + ')').show().siblings().hide();
    });
});

function global_search(){
  var formData = $('#searchform').serialize();
  var keyborad = $('.input_text').val();
  if(keyborad == '' || keyborad == '请输入关键字词'){
    return false;
  }
  //验证表单数据
  $.ajax({
      type: 'POST',
      url: "/search.html",
      data: formData,
      processData : false,
      contentType : false,
      complete:function(){

      },
      success:function(res){
        if(res.code || res.total_data == 0){
          alert('搜索结果为空');
        }else{
          html = '';
          html += '<div class="whitebg lanmu"> <img src="/static/home/lost_time/images/search_banner.jpg">';
          html += '<h1>全栈搜索</h1>';
          html += '<p>搜一搜，找一找……。</p>';
          html += '</div>';
          html += '<div class="whitebg bloglist">';
          // 搜索的文章列表
          html += '<ul>';
          for(i in res.searchArticles){
            html += '<li>';
            html += '<h3 class="blogtitle"><a href="index/'+ res.searchArticles[i]['article_id'] +'.html" target="_blank">'+ res.searchArticles[i]['article_title'] +'</a></h3>';
            html += '<p class="blogtext">'+ res.searchArticles[i]['article_desc'] +'</p>';
            html += '<p class="bloginfo"><i class="avatar"><img src="/static/home/lost_time/images/avatar.jpg"></i><span>'+ res.searchArticles[i]['author'] +'</span><span>'+ res.searchArticles[i]['ctime'] +'</span><span>【<a href="javascript:;">原创</a>】</span></p>';
            html += '<a href="index/'+ res.searchArticles[i]['article_id'] +'.html" target="_blank" class="viewmore">阅读更多</a> </li>';
          }
          html += '</ul>';
          // 搜索的文章列表分页栏
          html += '<div class="pagelist">';
          html += '<a title="Total record">&nbsp;<b>总数：'+ res.total_data +'条</b> </a>&nbsp;&nbsp;&nbsp;';

          if(res.total_page > 1 && res.page > 1){ //如果当前页码和总页码都大于1
            html += '<a href="javascript:;" onclick="gotoPage(1)" data-href="/search/page/1.html">首页</a>&nbsp;';
            html += '<a href="javascript:;" onclick="gotoPage('+ (res.page-1) +')">上一页</a>&nbsp;';
          }
          for (var k = 1; k <= res.total_page; k++) {
            if(k == res.page){ //如果页码等于当前页码，高亮显示
              html += '<b>'+ k +'</b>';
            }else{
              html += '<a href="javascript:;" onclick="gotoPage('+ k +')" class="search_page">'+ k +'</a>&nbsp;';
            }           
          }
          if(res.total_page > 1 && res.page < res.total_page){ //如果当前页码小于总页码，且总页码大于1
            html += '<a href="javascript:;" onclick="gotoPage('+ (res.page+1) +')" class="search_page">下一页</a>&nbsp;';
            html += '<a href="javascript:;" onclick="gotoPage('+ res.total_page +')">尾页</a>';
          }
          html += '</div>';
          
          html += '</div>';
          $('#download').html(html);
          $('#contact').html(html);
          $('.lbox').html(html);
        }
     }
  });
};
