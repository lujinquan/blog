<?php
// +----------------------------------------------------------------------
// | HisiPHP框架[基于ThinkPHP5.1开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.hisiphp.com
// +----------------------------------------------------------------------
// | HisiPHP承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 橘子俊 <364666827@qq.com>，开发者QQ群：50304283
// +----------------------------------------------------------------------

namespace app\blog\validate;

use think\Validate;

/**
 * 栏目验证器
 * @package app\system\validate
 */
class Mail extends Validate
{
    //定义验证规则
    protected $rule = [
        'title|邮件标题' => 'require',
        'send_mail|收件邮箱' => 'require|email',
        'accept_mail|收件邮箱' => 'require|email',
        '__token__'      => 'require|token',
    ];

    //定义验证提示
    protected $message = [
        'title.require' => '邮件标题不能为空',
        'send_mail.require' => '发件邮箱不能为空',
        'send_mail.email' => '发件邮箱格式不正确',
        'accept_mail.require' => '收件邮箱不能为空',
        'accept_mail.email' => '收件邮箱格式不正确',
    ];

}