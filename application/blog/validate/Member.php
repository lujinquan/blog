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

namespace app\blog\validate;

use think\Validate;

/**
 * 用户验证器
 * @package app\system\validate
 */
class Member extends Validate
{
    //定义验证规则
    protected $rule = [
    	'username|用户名' => 'require|alphaNum|unique:member',
        'nick|昵称'       => 'require|unique:member',
        'email|邮箱'      => 'requireWith:email|email|unique:member',
        'password|密码'   => 'require|length:32|confirm',
        'mobile|手机号'   => 'requireWith:mobile|regex:^1\d{10}',
        '__token__'      => 'require|token',
    ];

    //定义验证提示
    protected $message = [
        'username.require' => '请输入用户名',
        'email.require'    => '邮箱不能为空',
        'email.email'      => '邮箱格式不正确',
        'email.unique'     => '该邮箱已存在',
        'password.require' => '密码不能为空',
        'password.length'  => '密码设置无效',
        'mobile.regex'     => '手机号不正确',
    ];

    //定义验证场景
    protected $scene = [
        //新增
        'register'  =>  ['email', 'password', 'nick', '__token__'],
  
        
    ];
    /*// 自定义更新场景
    public function sceneRegister()
    {
        return $this->only(['email', 'password', 'nick', '__token__']);
    }

    // 自定义更新场景
    public function sceneUpdate()
    {
        return $this->only(['username', 'email', 'mobile', 'password', 'role_id', '__token__'])
                    ->remove('password', ['require'])
                    ->append('password', ['requireWith']);
    }

    // 自定义更新个人信息
    public function sceneInfo()
    {
        return $this->only(['username', 'email', 'mobile', 'password', '__token__'])
                    ->remove('password', ['require'])
                    ->append('password', ['requireWith']);
    }

    // 自定义登录场景
    public function sceneLogin()
    {
        return $this->only(['username', 'password', '__token__'])
                    ->remove('username', ['unique'])
                    ->remove('password', ['confirm'])
                    ->append('username', ['require']);
    }*/
}
