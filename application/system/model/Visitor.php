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

namespace app\system\model;

use think\Model;
//use app\system\model\SystemUser as UserModel;
/**
 * 后台日志模型
 * @package app\system\model
 */
class Visitor extends Model
{
    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = 'mtime';

    // 自动写入时间戳
    protected $autoWriteTimestamp = true;
    
    protected $type = [
        'ctime' => 'timestamp:Y-m-d H:i:s',
        'mtime' => 'timestamp:Y-m-d H:i:s',
    ];

    // public function user()
    // {
    //     return $this->hasOne('SystemUser', 'id', 'uid');
    // }
}