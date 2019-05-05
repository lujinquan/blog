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

use Env;
use hisi\Dir;

/**
 * 后台默认首页控制器
 * @package app\system\admin
 */

class Index extends Admin
{
    /**
     * 首页
     * @author Lucas <598936602@qq.com>
     * @return mixed
     */
    public function index()
    {
        if (cookie('hisi_iframe')) {
            $this->view->engine->layout(false);
            return $this->fetch('iframe');
        } else {
            return $this->fetch();
        }
    }

    /**
     * 欢迎首页
     * @author Lucas <598936602@qq.com>
     * @return mixed
     */
    public function welcome()
    {
        return $this->fetch('index');
    }

    /**
     * 清理缓存
     * @author Lucas <598936602@qq.com>
     * @return mixed
     */
    public function clear()
    {
        if (Dir::delDir(Env::get('runtime_path')) === false) {
            return $this->error('缓存清理失败');
        }
        return $this->success('缓存清理成功');
    }
}
