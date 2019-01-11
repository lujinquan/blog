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
    	//halt(1);
    	if ($this->request->isAjax()) {
    		//halt(1);
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10);
           
            $where = [
            	'status' => 1,
            ];
            $fields = 'cate_id,sort_order,cate_name,cate_url,cate_desc,is_show';
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