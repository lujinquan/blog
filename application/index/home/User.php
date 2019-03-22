<?php

namespace app\index\home;

use think\Validate;
use app\index\home\Base;
use app\blog\model\Member as MemberModel;

class User extends Base
{
	public function login()
	{
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
            	halt($validate->getError());
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
}