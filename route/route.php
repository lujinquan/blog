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
// 

//顶部导航
Route::rule('tour$','index/Tour/index');
Route::rule('gallery$','index/Gallery/index');
Route::rule('blog$','index/Blog/index');
Route::rule('contact$','index/Contact/index');

//首页的album
Route::rule('album/[:id]','index/Index/album?article_id=:id');
//首页的book
Route::rule('book/[:id]','index/Index/book?article_id=:id');

//博客的详情
Route::rule('blog/:id$','index/Blog/detail?article_id=:id');

Route::rule('blog/cate/:id','index/Blog/index?cate_id=:id');


// Route::group('blog', [
//     ':id'   => 'index/Blog/index',
//     ':name' => 'index/Blog/index',
// ])->ext('html')->pattern(['id' => '\d+']);