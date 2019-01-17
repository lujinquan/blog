<?php

namespace app\blog\admin;
use app\system\admin\Admin;
use app\blog\model\Member as MemberModel;

class Member extends Admin
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10);
            $where = [
                'status' => 1,
            ];
            $fields = 'member_id,nick,email,last_login_time,login_count,is_show,ctime';
            $data['data'] = MemberModel::field($fields)->where($where)->page($page)->order('ctime desc')->limit($limit)->select();
            $data['count'] = MemberModel::where($where)->count('member_id');
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
            $data['password'] = md5($data['password']);
            $data['password_confirm'] = md5($data['password_confirm']);
            $data['salt'] = random();
            //halt($data);
            // 验证
            $result = $this->validate($data, 'Member.sceneAdd');
            if($result !== true) {
                return $this->error($result);
            }

            $mod = new MemberModel();
            if (!$mod->allowField(true)->create($data)) {
                return $this->error('添加失败');
            }
            return $this->success('添加成功','index');
        }
        
        return $this->fetch('form');
    }

    public function detail()
    {
        $id = input('member_id');
        $row = MemberModel::where('member_id',$id)->find();
        $this->assign('data_info',$row);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('member_id');
        $update = [
            'dtime' => request()->time(),
            'status' => 0
        ];
        $res = MemberModel::where('member_id',$id)->update($update);
        if($res){
            return $this->success('删除成功','index');
        }
        return $this->error('删除失败');
    }

    public function show()
    {
        $id = input('member_id');
        $show = input('val');
        $res = MemberModel::where('member_id',$id)->setField('is_show',$show);
        if($res){
            return $this->success('设置成功');
        }
        return $this->error('设置失败');
    }
}