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
        $ip = get_client_ip();
        // 设置ip白名单
        $white_list_ip = ['119.97.248.198'];
        if(!in_array($ip,$white_list_ip)){ 
            echo '<h1 style="text-align:center;font-size:12rem;font-weight:normal;vertical-align:middle;font-family:&quot;background-color:#FFFFFF;"><span style="font-size:12rem;">203</span></h1><p class="text" style="text-align:center;font-size:1.6rem;color:#D93641;font-family:&quot;background-color:#FFFFFF;">很抱歉，页面已被限制访问！</p>';exit;
            //$this->fetch('error');exit;
        }
        $topMenus = CateModel::where('p_id',0)->field('cate_name,cate_id,link')->order('sort_order asc')->select();
        // 定位当前菜单
        $module     = request()->module();
        $controller = request()->controller();
        //$action     = request()->action();
        //$thisMenu = '/'.$module.'/'.$controller;
        $thisMenu = '/'.strtolower($controller).'.html';
        if($controller == 'Index'){
            $thisMenu = '/';
        }else{
            $thisMenu = '/'.strtolower($controller).'.html';
        }

        // 获取最热门文章TOP3
        $hotWhere = [
            'is_show' => 1,
            'status' => 1,
        ];
        $hotArticles = ArticleModel::where($hotWhere)->field('thumb,medium_thumb,article_id,article_title,ctime')->order('click desc')->limit(3)->select();

        $this->assign('hotArticles',$hotArticles);
        $this->assign('thisMenu',$thisMenu);
        $this->assign('topMenus',$topMenus);
    }

}