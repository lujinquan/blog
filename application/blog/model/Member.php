<?php
namespace app\blog\model;

use think\Model;

class Member extends Model
{
	// 设置模型名称
    protected $name = 'member';
    // 设置主键
    protected $pk = 'member_id';
    // 定义时间戳字段名
    protected $createTime = 'ctime';
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    protected $type = [
        'ctime' => 'timestamp:Y-m-d H:i:s',
        'last_login_time' => 'timestamp:Y-m-d H:i:s',
    ];

    public function comment()
    {
        return $this->hasMany('comment')->field('com_content,com_id');
    }

}