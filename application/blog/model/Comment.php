<?php
namespace app\blog\model;

use think\Model;
use think\Loader;

class Comment extends Model
{
	    // 设置模型名称
    protected $name = 'comment';
    // 设置主键
    protected $pk = 'com_id';
    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = 'mtime';
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    protected $type = [
        'ctime' => 'timestamp:Y-m-d H:i:s',
    ];

    /**
     * 入库
     * @param array $data 入库数据
     * @author Lucas <598936602@qq.com>
     * @return bool
     */
    
    public function article()
    {
        return $this->belongsTo('article', 'article_id', 'article_id')->bind('article_title,thumb');
    }

    public function member()
    {
        return $this->belongsTo('member', 'member_id', 'member_id')->bind('nick,avatar');
    }

}