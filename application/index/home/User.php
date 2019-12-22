<?php

namespace app\index\home;

use think\Validate;
use app\index\home\Base;
use app\blog\model\Mail as MailModel;
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
                'captcha|验证码' => 'require|captcha',
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
                $result['msg'] = '登录密码错误！';
                return json($result);
            }
            // 更新登录信息
            $member->last_login_time = time();
            $member->last_login_ip   = get_client_ip();
            if ($member->save()) {
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
                $result['code'] = -1;
                $result['msg'] = $validate->getError();
                return json($result);
			}
            $mod = new MemberModel();
            if (!$mod->allowField(true)->create($data)) {
                $result['code'] = -1;
                $result['msg'] = '未知错误';
                return json($result);
            }
            $result['code'] = 0;
            $result['msg'] = '注册成功';
            return json($result);
        }
		return $this->fetch();
	}

    /**
     * 会员忘记密码发送回执码
     * @return [type] [description]
     */
    public function receipt()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            $result = $map = $mailInfo = [];
            $map['email'] = trim($data['email']);
            $map['status'] = 1;
            $map['is_show'] = 1;
            $validate = new Validate([
                'email|邮箱' => 'require|email',
            ]);
            if (!$validate->check($data)) {
                $result['code'] = -1;
                $result['msg'] = $validate->getError();
                return json($result);
            }

            $member = MemberModel::where($map)->find();
            if (!$member) {
                $result['code'] = -2;
                $result['msg'] = '邮箱未被注册或被禁用！';
                return json($result);
            }
            // 给邮箱发送回执码
            $receipt = random($length = 6, $type = 1);
            $mailInfo['send_name'] = 'Lucas个人站长';
            $mailInfo['send_mail'] = '18674012767@163.com';
            $mailInfo['accept_mail'] = $map['email'];
            $mailInfo['expir_time'] = time() + 5*60;
            $mailInfo['type'] = 2;
            $mailInfo['code'] = $receipt;
            $mailInfo['title'] = '回执码';
            $mailInfo['remark'] = $member['nick'].'于'.date('Y-m-d H:i:s').'，申请找回密码';
            $mailInfo['content'] = 'Lucas提示您：回执码是'.$receipt.'，有效时长为5分钟，请在5分钟内完成密码重置操作！';
            //halt($mailInfo);
            $info = (new MailModel())->sendMail($mailInfo);
            if($info === true){
                $result['code'] = 0;
                $result['msg'] = '发送成功！';
            }else{
                $result['code'] = -3;
                $result['msg'] = '发送失败！';
            }
            return json($result);
        }
    }

    /**
     * 会员忘记密码
     * @return [type] [description]
     */
    public function forget()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            $result = $map = $mailInfo = [];
            $map['email'] = trim($data['email']);
            $map['status'] = 1;
            $map['is_show'] = 1;
            $validate = new Validate([
                'email|邮箱' => 'require|email',
                'receipt|回执码' => 'require',
            ]);
            if (!$validate->check($data)) {
                $result['code'] = -1;
                $result['msg'] = $validate->getError();
                return json($result);
            }

            $member = MemberModel::where($map)->find();
            if (!$member) {
                $result['code'] = -2;
                $result['msg'] = '邮箱未被注册或被禁用！';
                return json($result);
            }
            
            $mailRow = MailModel::where(['accept_mail'=>$map['email'],'type'=>2])->order('id desc')->find();
            if($mailRow){
                if($mailRow['expir_time'] < time()){
                    $result['code'] = -5;
                    $result['msg'] = '回执码已过期！';
                    return json($result);
                }
                if(strtolower(trim($data['receipt'])) !== $mailRow['code']){
                    $result['code'] = -4;
                    $result['msg'] = '回执码错误！';
                    return json($result);
                }
            }else{
                $result['code'] = -3;
                $result['msg'] = '请先获取回执码！';
                return json($result);
            }
            $result['code'] = 0;
            $result['msg'] = '提交成功！';
            $result['key'] = str_coding($member['member_id'],'ENCODE');
            return json($result);
        }
        return $this->fetch();
    }

    public function setting()
    {
        $key = input('param.key');
        if($key){
            $key = str_replace(" ","+",$key); //加密过程中可能出现“+”号，在接收时接收到的是空格，需要先将空格替换成“+”号
            $memberID = str_coding($key,'DECODE');
            //halt($memberID);
            $map = [];
            $map['member_id'] = $memberID;
            $map['status'] = 1;
            $map['is_show'] = 1;
            $memberRow = MemberModel::where($map)->find();
            if(!$memberRow){
                return $this->error('参数错误！','/'); 
            }
            //验证回执码是否过期
            $mailRow = MailModel::where(['accept_mail'=>$memberRow['email'],'type'=>2])->order('id desc')->find();
            $difftime = $mailRow['expir_time'] - time();
            if($difftime < 0){
                return $this->error('回执码已过期！','/forget');
            }
        }else{
           return $this->error('参数错误！','/'); 
        }
        if ($this->request->isPost()) {
            $data = $this->request->post();
            
            $data['salt'] = substr(uniqid(),0,6);
            $data['password'] = md5($data['password'].$data['salt']);
            $data['password_confirm'] = md5($data['password_confirm'].$data['salt']);
            $validate = new Validate([
                'password|密码'   => 'require|length:32|confirm',
            ]);
            if (!$validate->check($data)) {
                $result['code'] = -1;
                $result['msg'] = $validate->getError();
                return json($result);
            }
            $res = MemberModel::where(['member_id'=>$memberID])->update(['password'=>$data['password']]);
            
            if ($res !== false) {
                $result['code'] = 0;
                $result['msg'] = '密码重置成功！';
            }else{
                $result['code'] = -1;
                $result['msg'] = '密码重置成功';  
            }
            return json($result);
        }
        $this->assign('difftime',$difftime);
        $this->assign('key',$key);
        return $this->fetch();
    }

    public function appeal()
    {
        //exit;
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