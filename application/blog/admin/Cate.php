<?php

namespace app\blog\admin;
use app\system\admin\Admin;
use app\blog\model\Cate as CateModel;

class Cate extends Admin
{
	public $tabData = [];
    //protected $hisiTable = 'SystemUser';
    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();

        $tabData['menu'] = [
            [
                'title' => '管理员角色',
                'url' => 'system/user/role',
            ],
            [
                'title' => '系统管理员',
                'url' => 'system/user/index',
            ],
        ];
        $this->tabData = $tabData;
    }

    public function index()
    {
    	if ($this->request->isAjax()) {
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10);
           
            $where = [
            	'status' => 1,
            ];
            $fields = 'cate_id,sort_order,cate_name,link,cate_desc,is_show,ctime,cate_name';
            $data['data'] = CateModel::field($fields)->where($where)->page($page)->order('sort_order asc')->limit($limit)->select();
            $data['count'] = CateModel::where($where)->count('cate_id');
            $data['code'] = 0;
            $data['msg'] = '';
            return json($data);
        }
        $this->assign('hisiTabData', $this->tabData);
        return $this->fetch();
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            // 验证
            $result = $this->validate($data, 'Cate.sceneAdd');
            if($result !== true) {
                return $this->error($result);
            }
            if (!CateModel::create($data)) {
                return $this->error('添加失败');
            }
            return $this->success('添加成功','cate/index');
        }
        return $this->fetch('form');
    }

    public function edit()
    {
        return $this->fetch();
    }

    public function detail()
    {
        return $this->fetch();
    }

    public function del()
    {
        return $this->fetch();
    }
}