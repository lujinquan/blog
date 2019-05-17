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
class Article extends Validate
{
    //定义验证规则
    protected $rule = [
        'cate_id|所属栏目'    => 'require',
        'article_title|文章标题'      => 'require|unique:article',
        'sort_order|排序号'   => 'number',
        'article_desc|文章描述'   => 'require',
        'keywords|关键词' => 'require',
        //'__token__'      => 'require|token',
    ];

    //定义验证提示
    protected $message = [
        'cate_id.require' => '请选择所属栏目',
        'article_title.require'  => '文章标题不能为空',
        'article_title.unique'  => '文章标题已存在',
        'sort_order.require'    => '排序号不能为空',
        'sort_order.number'    => '排序号必须为数字',
        'article_desc.require'    => '文章描述不能为空',
        'keywords.require'      => '关键词不能为空',
    ];

    // 自定义新增场景
    public function sceneAdd()
    {
        return $this->only(['cate_id', 'article_title', 'sort_order', 'article_desc', 'keywords', '__token__']);    
    }

}