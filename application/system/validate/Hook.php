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
 * 钩子验证器
 * @package app\system\validate
 */
class Hook extends Validate
{
    //定义验证规则
    protected $rule = [
		'name|钩子名称'	=> 'require|unique:system_hook',
		'intro|钩子描述' => 'require',
    ];
}
