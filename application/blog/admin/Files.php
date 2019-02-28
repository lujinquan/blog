<?php

namespace app\blog\admin;
use app\system\admin\Admin;
use app\blog\model\Files as FilesModel;

class Files extends Admin
{
    public function index()
    {
    	if ($this->request->isAjax()) {
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10); 
            $where = [
            	'status' => 1,
            ];
            $data['data'] = FilesModel::where($where)->page($page)->order('ctime desc')->limit($limit)->select();
            $data['count'] = FilesModel::where($where)->count('id');
            $data['code'] = 0;
            $data['msg'] = '';
            return json($data);
        }
    	return $this->fetch();
    }

    public function detail()
    {
        $id = input('id');
        $row = MailModel::get($id);
        $this->assign('data_info',$row);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('id');
        $update = [
            'dtime' => request()->time(),
            'status' => 0
        ];
        $res = MailModel::where('id',$id)->update($update);
        if($res){
            return $this->success('删除成功','mail/index');
        }
        return $this->error('删除失败');
    }
}