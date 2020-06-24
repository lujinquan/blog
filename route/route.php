<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


/**
 * 网站路由
 */
Route::pattern([
    'name' => '\w+',
    'id'   => '\d+',
]);


//Route::rule('路由表达式','路由地址','请求类型','路由参数（数组）','变量规则（数组）');
//顶部导航,$表示全匹配,:id表示变量，[]表示该变量是路由匹配的可选变量
Route::rule('index$','index/Index/index');
//首页文章的详情
Route::rule('index/:id$','index/Index/detail?article_id=:id');



Route::rule('contact$','index/Contact/index');
Route::rule('download$','index/Download/index');
//全站搜索
Route::rule('search/:name','index/Index/search?keywords=:name');
Route::rule('search/page/<name>/<page>','index/Index/search')->pattern(['name' => '\w+','page' => '\d+']);
//首页的album
Route::rule('album/[:id]','index/Index/album?article_id=:id');
//首页的book
Route::rule('book/[:id]','index/Index/book?article_id=:id');


// 【读书角】默认列表
Route::rule('tour$','index/Tour/index');
// 【读书角】分页列表
Route::rule('tour/page/<page>','index/Tour/index')->pattern(['page' => '\d+']);
// 【读书角】的文章详情
Route::rule('tour/:id$','index/Tour/detail?article_id=:id');
// 【读书角】的子分类下的默认文章列表
Route::rule('tour/cate/:id$','index/Tour/list?cate_id=:id');
// 【读书角】的子分类下的分页文章列表
Route::rule('tour/cate/page/<cate_id>/<page>','index/Tour/list')->pattern(['cate_id' => '\d+', 'page' => '\d+']);
// 【读书角】的子分类下的文章详情
Route::rule('tour/cate/<cate_id>/<article_id>','index/Tour/detail')->pattern(['cate_id' => '\d+', 'article_id' => '\d+']);


// 【生活随想】默认列表
Route::rule('gallery$','index/Gallery/index');
// 【生活随想】分页列表
Route::rule('gallery/page/<page>','index/Gallery/index')->pattern(['page' => '\d+']);
// 【生活随想】的文章详情
Route::rule('gallery/:id$','index/Gallery/detail?article_id=:id');
// 【生活随想】的子分类下的文章详情
Route::rule('gallery/cate/<cate_id>/<article_id>','index/gallery/detail')->pattern(['cate_id' => '\d+', 'article_id' => '\d+']);


// 【博客】默认列表
Route::rule('blog$','index/Blog/index');
// 【博客】分页列表
Route::rule('blog/page/<page>','index/Blog/index')->pattern(['page' => '\d+']);
// 【博客】的详情
Route::rule('blog/:id$','index/Blog/detail?article_id=:id');
// 【博客】的子分类下的默认文章列表
Route::rule('blog/cate/:id$','index/Blog/index?cate_id=:id');
// 【博客】的子分类下的分页文章列表
Route::rule('blog/cate/page/<cate_id>/<page>','index/Blog/index')->pattern(['cate_id' => '\d+', 'page' => '\d+']);
// 【博客】的子分类下的文章列表中的文章详情，如Domain/blog/cate/2/1.html，会路由到index/Blog/detail，同时会有两个参数，cate_id = 2，id = 1;注意blog/cate这中间的连接符/是可以改成别的符号的，例如定义blog-cate-<cate_id>-<id>，浏览器访问就应该是Domain/blog-cate-2-1
Route::rule('blog/cate/<cate_id>/<article_id>','index/Blog/detail')->pattern(['cate_id' => '\d+', 'article_id' => '\d+']);
//上面的路由可以改变下，变成下面的路由，这样如Domain/blog/cate/2/id/1.html，路由效果同上
//Route::rule('blog/cate/<cate_id>/article_id/<article_id>','index/Blog/detail')->pattern(['cate_id' => '\d+', 'article_id' => '\d+']);


//博客点赞
Route::rule('love/:id$','index/Blog/love?article_id=:id');
//博客评论
Route::rule('com$','index/Blog/com');
//博客的评论点赞
Route::rule('response_love$','index/Blog/response_love');
//博客标签跳转
Route::rule('tag/:id$','index/Blog/tag?tag_id=:id');
//网站会员登录
Route::rule('login$','index/User/login');
//网站会员登出
Route::rule('logout$','index/User/logout');
//网站会员忘记密码
Route::rule('forget$','index/User/forget');
//网站会员忘记密码发送回执
Route::rule('receipt$','index/User/receipt');
//网站会员设置密码
Route::rule('setting$','index/User/setting');
//网站会员注册
Route::rule('register$','index/User/register');
//网站会员提交申诉
Route::rule('appeal$','index/User/appeal');
//个人二维码信息
Route::rule('lucas','index/Contact/info');
//打赏功能
Route::rule('pay','index/Contact/pay');
//评论的回复留言
Route::rule('replay$','index/Blog/replay');
//全局搜索
Route::rule('search$','index/Index/search');
/**
 * 系统路由
 */

// Route::rule('admin.php/lucas','admin.php/system/publics/index');