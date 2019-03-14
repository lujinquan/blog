<?php
namespace app\blog\model;

use think\Model;
use think\Loader;

class Article extends Model
{
	// 设置模型名称
    protected $name = 'article';
    // 设置主键
    protected $pk = 'article_id';
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
    
    public function cate()
    {
        return $this->belongsTo('cate', 'cate_id', 'cate_id')->bind('cate_name');
    }

    public function comment()
    {
        return $this->hasMany('comment')->field('com_content,com_id,member_id,ctime');
    }

}