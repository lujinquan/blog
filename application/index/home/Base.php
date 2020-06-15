<?php

namespace app\index\home;
use think\Db;
use app\common\controller\Common;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;
use app\blog\model\Comment as CommentModel;
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
            // 设置黑名单ip '127.0.0.1',
            $black_list_ip = ['119.97.248.198','221.235.84.238'];
            //halt($client_ip);
            if(!in_array($client_ip,$white_list_ip) || in_array($client_ip,$black_list_ip)){
                //include('./template/notice/notice.html');die();
                
                //echo '<h1 style="text-align:center;font-size:12rem;margin-top:10%;font-weight:normal;vertical-align:middle;font-family:&quot;background-color:#FFFFFF;"><span style="font-size:12rem;">203</span></h1><p class="text" style="text-align:center;font-size:1.6rem;color:#D93641;font-family:&quot;background-color:#FFFFFF;">很抱歉，页面升级中！</p>';exit; //页面已被限制访问
            }
        }else{
            include('./template/notice/notice.html');die();
            //echo '<h1 style="text-align:center;font-size:12rem;margin-top:10%;font-weight:normal;vertical-align:middle;font-family:&quot;background-color:#FFFFFF;"><span style="font-size:12rem;">203</span></h1><p class="text" style="text-align:center;font-size:1.6rem;color:#D93641;font-family:&quot;background-color:#FFFFFF;">很抱歉，页面已被限制访问！</p>';exit;
        } 

        // 定位当前菜单
        //$module     = request()->module();
        $controller = request()->controller();

        $thisMenu = '/'.strtolower($controller).'.html';
        if($controller == 'Index'){
            $thisMenu = '/';
        }else{
            $thisMenu = '/'.strtolower($controller).'.html';
        }
        $thisMenuName = '';
        // 定义模板常量
        if (!defined('SITE_TEMPLATE')) {
            define('SITE_TEMPLATE', config()['sys']['site_template']);
        }
        
        $topMenus = CateModel::where('p_id',0)->field('cate_name,cate_id,link')->order('sort_order asc')->select();
        foreach ($topMenus as $k => &$v) {
            $v['childs'] = [];
            if(in_array($v['cate_id'], [4])){ //只展示技术博客的二级菜单
                $v['childs'] = CateModel::where('p_id',$v['cate_id'])->field('cate_name,cate_id,link')->order('sort_order asc')->select();
            }
            if($v['link'] == $thisMenu){
                $thisMenuName = $v['cate_name'];
            }
        }
        //halt($thisMenuName);
        $this->assign('thisMenuName',$thisMenuName);

        // 点击排行模块
        $clickRankingArticles = ArticleModel::with('cate')->where(['status'=>1,'is_show'=>1])->field('article_title,cate_id,article_desc,article_id,thumb')->limit(7)->order('click desc')->select();
        foreach ($clickRankingArticles as $key => &$value) {
            $find = CateModel::where([['cate_id','eq',$value['cate_id']]])->field('p_id,link')->find();
            //halt($find);
            if($find['p_id']){ //二级栏目
                $cateRow = CateModel::where([['cate_id','eq',$find['p_id']]])->field('link')->find();
                $pos = strpos($cateRow['link'], '.');
                if($pos){
                    $value['top_cate_flag'] = substr($cateRow['link'],0,$pos);  
                }else{
                    $value['top_cate_flag'] = $cateRow['link'];
                }
            }else{ //顶级栏目
                $pos = strpos($find['link'], '.');
                $value['top_cate_flag'] = substr($find['link'],1,2);
            }
        }
        $this->assign('clickRankingArticles',$clickRankingArticles);

        // 主页文章总数
        $articlesCount = ArticleModel::where(['status'=>1,'is_show'=>1])->where([['cate_id','neq',102]])->count();
        $this->assign('articlesCount',$articlesCount);
        // 主页评论总数
        $commentsCount = CommentModel::where(['status'=>1,'is_show'=>1])->count();
        $this->assign('commentsCount',$commentsCount); 
        
        // dump($topMenus);
        // halt($thisMenu);
        // 获取最热门文章TOP3
        $hotWhere = [
            'is_show' => 1,
            'status' => 1,
        ];
        $hotArticles = ArticleModel::where($hotWhere)->field('thumb,medium_thumb,article_id,article_title,ctime')->order('click desc')->limit(3)->select();
        $this->assign('cateID','');
        $this->assign('hotArticles',$hotArticles);
        $this->assign('thisMenu',$thisMenu);
        $this->assign('topMenus',$topMenus);

          
    }

}