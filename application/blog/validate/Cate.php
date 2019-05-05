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
 * 栏目验证器
 * @package app\system\validate
 */
class Cate extends Validate
{
    //定义验证规则
    protected $rule = [
        'p_id|上级栏目'    => 'require',
        'cate_name|栏目名称'      => 'require|unique:article_cate',
        'sort_order|排序号'   => 'require|number',
        'cate_desc|栏目描述'   => 'require',
        'keywords|关键词' => 'require',
        '__token__'      => 'require|token',
    ];

    //定义验证提示
    protected $message = [
        'p_id.require' => '请选择上级栏目',
        'cate_name.require'  => '栏目名称不能为空',
        'cate_name.unique'  => '栏目名称已存在',
        'sort_order.require'    => '排序号不能为空',
        'sort_order.number'    => '排序号必须为数字',
        'cate_desc.require'    => '栏目描述不能为空',
        'keywords.require'      => '关键词不能为空',
    ];

    // 自定义新增场景
    public function sceneAdd()
    {
        return $this->only(['p_id', 'cate_name', 'sort_order', 'cate_desc', 'keywords', '__token__']);    
    }

    // 自定义更新个人信息
    // public function sceneUpdate()
    // {
    //     return $this->only(['username', 'email', 'mobile', 'password', '__token__'])
    //                 ->remove('password', ['require'])
    //                 ->append('password', ['requireWith']);
    // }

}