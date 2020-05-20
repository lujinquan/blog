<?php

namespace app\index\home;
use think\Db;
use app\common\controller\Common;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;
use app\system\model\Visitor as VisitorModel;

class Base extends Common
{
    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        // 获取顶部菜单
        // $where = [
        // 	'p_id' => 0,
        // 	'is_show' => 1,
        // 	'status' => 1
        // ];
        $client_ip = get_client_ip();
        // 更新游客ip库
        $visitor = new VisitorModel;
        //halt($_SERVER);
        //$visitor_row = $VisitorModel->where([['ip','eq',$ip]])->find();
        // if($visitor_row){
        //     $visitor_row->times = Db::raw('times+1');
        //     $visitor_row->save();
        // }else{
        $visitor->client_ip = $client_ip;
        $visitor->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $client_browser = get_client_browser();
        $visitor->client_browser = trim(implode('-',$client_browser),'-');
        $visitor->http_cookie = isset($_SERVER['HTTP_COOKIE'])?$_SERVER['HTTP_COOKIE']:'';
        $visitor->agent_type = client_os();
        if(isset($_SERVER['REQUEST_SCHEME'])){
            $visitor->page_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        }
        $visitor->redirect_status = $_SERVER['REDIRECT_STATUS'];
        $visitor->http_referer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
        $visitor->request_method = $_SERVER['REQUEST_METHOD'];
        $visitor->server_ip = $_SERVER['SERVER_ADDR'];
        $visitor->save();
        // }

   
        // 页面是否开放，如果设置为 false 则直接弹出限制访问提示
        $is_open = true;

        if($is_open){
            // 设置白名单ip
            $white_list_ip = [];
            // 设置黑名单ip
            $black_list_ip = ['119.97.248.198','127.0.0.1','221.235.84.238'];
            if(!in_array($client_ip,$white_list_ip) || in_array($client_ip,$black_list_ip)){
                //echo '<h1 style="text-align:center;font-size:12rem;margin-top:10%;font-weight:normal;vertical-align:middle;font-family:&quot;background-color:#FFFFFF;"><span style="font-size:12rem;">203</span></h1><p class="text" style="text-align:center;font-size:1.6rem;color:#D93641;font-family:&quot;background-color:#FFFFFF;">很抱歉，页面升级中！</p>';exit; //页面已被限制访问
            }
        }else{
            echo '<h1 style="text-align:center;font-size:12rem;margin-top:10%;font-weight:normal;vertical-align:middle;font-family:&quot;background-color:#FFFFFF;"><span style="font-size:12rem;">203</span></h1><p class="text" style="text-align:center;font-size:1.6rem;color:#D93641;font-family:&quot;background-color:#FFFFFF;">很抱歉，页面已被限制访问！</p>';exit;
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