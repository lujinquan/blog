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

//顶部导航,$表示全匹配,:id表示变量，[]表示该变量是路由匹配的可选变量
Route::rule('tour$','index/Tour/index');
Route::rule('gallery$','index/Gallery/index');
Route::rule('blog$','index/Blog/index');
Route::rule('contact$','index/Contact/index');
//全站搜索
Route::rule('search/:name','index/Index/search?keywords=:name');
//首页的album
Route::rule('album/[:id]','index/Index/album?article_id=:id');
//首页的book
Route::rule('book/[:id]','index/Index/book?article_id=:id');
//博客的详情
Route::rule('blog/:id$','index/Blog/detail?article_id=:id');
//博客右侧的分类
Route::rule('blog/cate/:id','index/Blog/index?cate_id=:id');
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
//网站会员注册
Route::rule('register$','index/User/register');

//评论的回复留言
Route::rule('replay$','index/Blog/replay');
/**
 * 系统路由
 */

// Route::rule('admin.php/lucas','admin.php/system/publics/index');