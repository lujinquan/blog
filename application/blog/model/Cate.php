<?php
namespace app\blog\model;

use think\Model;
use think\Loader;

class Cate extends Model
{
	    // 设置模型名称
    protected $name = 'article_cate';
    // 设置主键
    protected $pk = 'cate_id';
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
    public function storage($data = [])
    {
        if (empty($data)) {
            $data = request()->post();
        }

        // 验证
        $valid = Loader::validate('bh/Corate');
        

        if (isset($data['id']) && !empty($data['id'])) {

            if ($valid->scene('edit')->check($data) !== true) 
            {
                $this->error = $valid->getError();
                return false;
            }
            $res = $this->update($data);
            $row = self::get($data['id']);
            if ($res) {
                $his = [
                    'b_id' => $row['b_id'],
                    'bt_id' => BhouseModel::where('b_id', $row['b_id'])->value('bt_id'),
                    'histype' => 9, // 
                    'cuid' => ADMIN_ID,
                    'description' => '——',
                ];
                (new BhousehisModel)->storage($his);
            }

        } else {

            if ($valid->scene('add')->check($data) !== true) 
            {
                $this->error = $valid->getError();
                return false;
            }
            $res = $this->create($data);
            if ($res) {
                $his = [
                    'b_id' => $res['b_id'],
                    'bt_id' => BhouseModel::where('b_id', $res['b_id'])->value('bt_id'),
                    'histype' => 8, // 
                    'cuid' => ADMIN_ID,
                    'description' => '装修范围：' . $res['content'],
                ];
                (new BhousehisModel)->storage($his);
            }
        }
        if (!$res) {
            $this->error = '保存失败';
            return false;
        }

        return $res;
    }
}