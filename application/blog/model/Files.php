<?php

namespace app\blog\model;
use think\Model;

class Files extends Model
{
	// 设置模型名称
    protected $name = 'files';
    // 设置主键
    protected $pk = 'id';
    // 定义时间戳字段名
    protected $createTime = 'ctime';
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    protected $type = [
        'ctime' => 'timestamp:Y-m-d H:i:s',
    ];
}