<?php

namespace app\index\home;
use app\common\controller\Common;
use app\blog\model\Cate as CateModel;

class Base extends Common
{
    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        $where = [
        	'p_id' => 0,
        	'is_show' => 1,
        	'status' => 1
        ];
        $topMenus = CateModel::where('p_id',0)->field('cate_name,cate_id,link')->order('sort_order asc')->select();
        $module     = request()->module();
        $controller = request()->controller();
        //$action     = request()->action();
        $thisMenu = '/'.$module.'/'.$controller;
        //halt(strstr('/index/Tosur/index',$thisMenu));
        $this->assign('thisMenu',$thisMenu);
        $this->assign('topMenus',$topMenus);
    }

}