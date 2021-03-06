<?php
// +----------------------------------------------------------------------
// | Thinkphp框架[基于ThinkPHP5.1开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2018-2022 http://www.mylucas.com.cn
// +----------------------------------------------------------------------
// | ThinkPHP框架永久免费开源
// +----------------------------------------------------------------------
// | Author: Lucas <598936602@qq.com>
// +----------------------------------------------------------------------

namespace app\system\admin;

use app\common\controller\Common;
use app\system\model\SystemUser as UserModel;

/**
 * 后台公共控制器
 * @package app\system\admin
 */
class Publics extends Common
{
    /**
     * 登陆页面
     * @author Lucas <598936602@qq.com>
     * @return mixed
     */
    public function index()
    {
        $model = new UserModel;
        if ($this->request->isPost()) {
            $username = $this->request->post('username/s');
            $password = $this->request->post('password/s');
            if (!$model->login($username, $password)) {
                $data = [];
                $data['token'] = $this->request->token();
                return $this->error($model->getError(), url('index'), $data);
            }
            return $this->success('登录成功，页面跳转中...', url('index/index'));
        }
        if ($model->isLogin()) {
            $this->redirect(url('index/index', '', true, true));
        }
        // 检查登录入口的key
        if (isset($_GET['key']) && $_GET['key'] == config('sys.key')) {
            $this->view->engine->layout(false);
            return $this->fetch();
        }else{
            $this->redirect(ROOT_DIR);
        }
        
    }

    /**
     * 退出登陆
     * @author Lucas <598936602@qq.com>
     * @return mixed
     */
    public function logout(){
        model('SystemUser')->logout();
        $this->redirect(ROOT_DIR);
    }


    /**
     * 图标选择
     * @author Lucas <598936602@qq.com>
     * @return mixed
     */
    public function icon() {
        return $this->fetch();
    }

    /**
     * 解锁屏幕
     * @author Lucas <598936602@qq.com>
     * @return mixed
     */
    public function unlocked()
    {
        $_pwd = $this->request->post('password/s');
        $model = model('SystemUser');
        $login = $model->isLogin();
        
        if (!$login) {
            return $this->error('登录信息失效，请重新登录！');
        }

        $password = $model->where('id', $login['uid'])->value('password');
        if (!$password) {
            return $this->error('登录异常，请重新登录！');
        }

        if (!password_verify($_pwd, $password)) {
            return $this->error('密码错误，请重新输入！');
        }

        return $this->success('解锁成功');
    }
}
