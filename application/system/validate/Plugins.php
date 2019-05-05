<?php
// +----------------------------------------------------------------------
// | Thinkphp框架[基于ThinkPHP5.1开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2018-2022 http://www.mylucas.com.cn
// +----------------------------------------------------------------------
// | ThinkPHP框架永久免费开源
// +----------------------------------------------------------------------
// | Author: Lucas <598936602@qq.com>
// +----------------------------------------------------------------------

namespace app\system\validate;

use think\Validate;

/**
 * 插件验证器
 * @package app\system\validate
 */
class Plugins extends Validate
{
    //定义验证规则
    protected $rule = [
		'name|插件名'			=> 'require|alphaDash|unique:system_plugins',
		'title|插件标题'			=> 'require',
		'identifier|插件标识'		=> 'require|unique:system_plugins',
    ];
}
