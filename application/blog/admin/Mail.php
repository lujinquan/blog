<?php

namespace app\blog\admin;
use app\system\admin\Admin;
use app\blog\model\Mail as MailModel;

class Mail extends Admin
{
    public function index()
    {
    	if ($this->request->isAjax()) {
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10); 
            $where = [
            	'status' => 1,
            ];
            $data['data'] = MailModel::where($where)->page($page)->order('ctime desc')->limit($limit)->select();
            $data['count'] = MailModel::where($where)->count('id');
            $data['code'] = 0;
            $data['msg'] = '';
            return json($data);
        }
    	return $this->fetch();
    }

    public function add()
    {	
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $result = $this->validate($data, 'Mail');
            if($result !== true) {
                return $this->error($result);
            }
            //halt($data);
            $info = (new MailModel())->sendMail($data);
            if($info === true){
                $res['code'] = 0;
                $res['msg'] = '发送成功';
            }else{
                $res['code'] = 1;
                $res['msg'] = $info;
            }
            return json($res);
        }
    	
    	return $this->fetch('form');
    }
}