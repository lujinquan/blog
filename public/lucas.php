<?php
// +----------------------------------------------------------------------
// | Thinkphp框架[基于ThinkPHP5.1开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2018 http://www.HisiPHP.com
// +----------------------------------------------------------------------
// | HisiPHP提供个人非商业用途免费使用，商业需授权。
// +----------------------------------------------------------------------
// | Author: Lucas <598936602@qq.com>
// +----------------------------------------------------------------------

// [ 后台入口文件 ]
namespace think;

header('Content-Type:text/html;charset=utf-8');

// 定义应用目录
define('APP_PATH', __DIR__ . '/application/');

define('EXTEND_PATH', __DIR__ .'/../extend/');

// 定义默认控制器为admin【当前文件命名并不重要，可以是lucas.php也可以是admin.php，重要的是ENTRANCE的定义，决定控制器的访问地址】
define('ENTRANCE', 'admin');

// 加载基础文件
require __DIR__ . '/../thinkphp/base.php';

// 检查是否安装
if(!is_file('./../install.lock')) {
    header('location: /');
} else {
    Container::get('app')->run()->send();
}
