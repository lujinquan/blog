<?php

namespace app\index\home;

use think\Validate;
use app\index\home\Base;
use app\blog\model\Member as MemberModel;

class User extends Base
{
	public function login()
	{
        if ($this->request->isPost()) {
            $data = $this->request->post();

            $result = $map = [];
            $map['email'] = trim($data['email']);
            $map['status'] = 1;
            $map['is_show'] = 1;
            $validate = new Validate([
                'email|邮箱' => 'require|email',
                'password|密码' => 'require',
            ]);
            if (!$validate->check($data)) {
                $result['code'] = -1;
                $result['msg'] = $validate->getError();
                return json($result);
            }
            $member = MemberModel::where($map)->find();
            if (!$member) {
                $result['code'] = -2;
                $result['msg'] = '用户不存在或被禁用！';
                return json($result);
            }
            // 密码校验
            if ($member['password'] !== md5($data['password'].$member['salt'])) {
                $result['code'] = -3;
                $result['msg'] = '登陆密码错误！';
                return json($result);
            }
            // 更新登录信息
            $member->last_login_time = time();
            $member->last_login_ip   = get_client_ip();
            if ($member->save()) {
                // 执行登陆
                // $login = [];
                // $login['member_id'] = $member->member_id;
                // $login['nick'] = $member->nick;
                // $login['avatar'] = $member->avatar;
                // cookie('member',$login);
                cookie('member_id', $member->member_id);
                cookie('avatar', $member->avatar);
                cookie('nick', $member->nick);
                $result['code'] = 0;
                $result['msg'] = '登录成功';
                return json($result);
            }else{
                $result['code'] = -4;
                $result['msg'] = '未知错误';
                return json($result);
            }
        }
		return $this->fetch();
	}

	public function register()
	{
		if ($this->request->isPost()) {
            $data = $this->request->post();
            if(!$data['is_agree']){
            	return $this->error('未同意相关守则和法律政策');
            }
            $data['salt'] = substr(uniqid(),0,6);
            $data['password'] = md5($data['password'].$data['salt']);
            $data['password_confirm'] = md5($data['password_confirm'].$data['salt']);


            $validate = new Validate([
			    'nick|昵称'       => 'require|unique:system_user',
			    'email|邮箱' => 'require|email',
			    'password|密码'   => 'require|length:32|confirm',
			]);
            if (!$validate->check($data)) {
			    return $this->error($validate->getError());
			}
            $mod = new MemberModel();
            if (!$mod->allowField(true)->create($data)) {
                return $this->error('添加失败');
            }
            return $this->success('添加成功');
        }
		return $this->fetch();
	}

    public function logout()
    {
        $member_id = input('member_id');
        cookie('member_id',null);
        $result = [];
        $result['code'] = 0; 
        $result['msg'] = '退出成功'; 
        return json($result);
    }
}