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
namespace app\common\validate;

use think\Validate;

/**
 * 语言包验证器
 * @package app\common\validate
 */
class SystemLanguage extends Validate
{
    //定义验证规则
    protected $rule = [
        'name|语言名称' => 'require|unique:system_language',
        'code|语言代码'  => 'require|unique:system_language',
    ];

    //定义验证提示
    protected $message = [
        'name.require' => '语言名称不允许为空',
        'name.unique' => '语言名称已存在',
        'code.require' => '语言代码不允许为空',
        'code.unique' => '语言代码已存在',
    ];
}
