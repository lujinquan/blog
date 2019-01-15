<?php

namespace app\index\home;
use app\common\controller\Common;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;

class Base extends Common
{
    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        // 获取顶部菜单
        $where = [
        	'p_id' => 0,
        	'is_show' => 1,
        	'status' => 1
        ];
        $topMenus = CateModel::where('p_id',0)->field('cate_name,cate_id,link')->order('sort_order asc')->select();
        // 定位当前菜单
        $module     = request()->module();
        $controller = request()->controller();
        //$action     = request()->action();
        $thisMenu = '/'.$module.'/'.$controller;

        // 获取最热门文章TOP3
        $hotWhere = [
            'is_show' => 1,
            'status' => 1,
        ];
        $hotArticles = ArticleModel::where($hotWhere)->field('thumb,article_id,article_title,ctime')->order('click desc')->limit(3)->select();
        //halt(strstr('/index/Tosur/index',$thisMenu));
        $this->assign('hotArticles',$hotArticles);
        $this->assign('thisMenu',$thisMenu);
        $this->assign('topMenus',$topMenus);
    }

}