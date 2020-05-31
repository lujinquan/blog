<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;
use app\blog\model\Comment as CommentModel;

class Index extends Base
{
    public function index()
    {
        if(SITE_TEMPLATE == 'lost_time'){
            // 主页轮播数据
            $bannerImgs = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>100])->field('article_id,thumb')->limit(4)->select();
            $this->assign('bannerImgs',$bannerImgs);
            // 主页轮播旁边的两个竖行排列的文章
            $bannerHImgs = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>101])->field('article_title,article_id,thumb')->limit(2)->order('sort_order asc')->select();
            $this->assign('bannerHImgs',$bannerHImgs);
            // 主页生活栏目（页面中显示是个人博客）的文章
            $lifeArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>6])->field('article_title,cate_id,article_desc,article_id,thumb')->limit(5)->order('sort_order asc')->select();
            $this->assign('lifeArticles',$lifeArticles);
            // 主页php栏目的文章
            $phpArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>7])->field('article_title,cate_id,article_desc,article_id,thumb')->limit(5)->order('sort_order asc')->select();
            $this->assign('phpArticles',$phpArticles);
            // 主页python栏目的文章
            $pythonArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>11])->field('article_title,cate_id,article_desc,article_id,thumb')->limit(5)->order('sort_order asc')->select();
            $this->assign('pythonArticles',$pythonArticles);
            // 主页HTML栏目的文章
            $htmlArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>10])->field('article_title,cate_id,article_desc,article_id,thumb')->limit(5)->order('sort_order asc')->select();
            $this->assign('htmlArticles',$htmlArticles);
            // 主页Mysql栏目的文章
            $mysqlArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>9])->field('article_title,cate_id,article_desc,article_id,thumb')->limit(5)->order('sort_order asc')->select();
            $this->assign('mysqlArticles',$mysqlArticles);
            // 主页linux栏目的文章
            $linuxArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>8])->field('article_title,cate_id,article_desc,article_id,thumb')->limit(5)->order('sort_order asc')->select();
            $this->assign('linuxArticles',$linuxArticles);
            // 主页公告栏目的文章
            $noticeArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>102])->field('article_title,cate_id,article_desc,article_id,thumb')->limit(4)->order('sort_order asc')->select();
            $this->assign('noticeArticles',$noticeArticles);
            // 主页原创精彩专题
            $originalArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>103])->field('article_title,cate_id,article_desc,article_id,thumb')->limit(6)->order('sort_order asc')->select();
            $this->assign('originalArticles',$originalArticles);
            
            // 主页推荐栏目
            $stickArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'is_stick'=>1])->field('article_title,cate_id,article_desc,article_id,thumb,author,ctime')->limit(8)->order('click desc')->select();
            foreach ($stickArticles as $key => &$value) {
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
            $this->assign('stickArticles',$stickArticles);
            // 主页最新文章栏目
            $newArticles = ArticleModel::where(['status'=>1,'is_show'=>1])->where([['cate_id','neq',102]])->field('article_title,cate_id,article_desc,article_id,thumb,author,ctime')->limit(8)->order('ctime desc')->select();
            $this->assign('newArticles',$newArticles);
            // 主页猜你喜欢（热门）文章
            $loveArticles = ArticleModel::where(['status'=>1,'is_show'=>1])->where([['cate_id','neq',102]])->field('article_title,cate_id,article_desc,article_id,thumb,author,ctime')->limit(8)->order('love desc')->select();
            $this->assign('loveArticles',$loveArticles);

        }else{
            $banner = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>97])->field('article_id,thumb')->find();
            $this->assign('banner',$banner);

            $imgs = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>98])->field('article_id,thumb')->limit(6)->select();
            //halt(array_chunk($imgs->toArray(),3,true));
            $this->assign('imgs',array_chunk($imgs->toArray(),3,true));

            $imgsTui = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>99])->field('article_id,article_title,author,article_long_title,thumb')->limit(3)->select();
            //halt($imgsTui);
            $this->assign('imgsTui',$imgsTui);
        }
    	
        return $this->fetch();
    }

    /**
     * 功能描述： 主文字的详情
     * =====================================
     * @author  Lucas 
     * email:   598936602@qq.com 
     * Website  address:  www.mylucas.com.cn
     * =====================================
     * 创建时间: 2020-05-10 08:23:34
     * @example 
     * @link    文档参考地址：
     * @return  返回值  
     * @version 版本  1.0
     */
    public function word()
    {
        $id = input('article_id');

        $data_info = ArticleModel::where('article_id',$id)->find();
        // 获取当前文章的评论
        $comments = $data_info->comment()->with('member')->where(['is_show'=>1,'status'=>1])->order('ctime desc')->limit(4)->select();
        // 获取推荐的文章
        $tuiWhere = [
            ['cate_id' ,'eq' , $data_info['cate_id']],
            ['is_stick', 'eq', 1],
            ['is_show' ,'eq', 1],
            ['status' ,'eq', 1],
            ['article_id' ,'neq',$id]
        ];
        $tuiArticles = ArticleModel::where($tuiWhere)->field('thumb,article_id,article_title')->order('click desc')->limit(4)->select();
        
        $this->assign('tuiArticles',$tuiArticles);
        $this->assign('comments',$comments);
        $this->assign('data_info',$data_info);
        return $this->fetch('detail_main_word');
    }

    public function detail()
    {
    	$id = input('article_id');

    	$data_info = ArticleModel::with('cate')->where('article_id',$id)->find();
    	// 获取当前文章的评论
        $comments = $data_info->comment()->with('member')->where(['is_show'=>1,'status'=>1])->order('ctime desc')->limit(4)->select();
        // 获取推荐的文章
        $tuiWhere = [
            ['cate_id' ,'eq' , $data_info['cate_id']],
            ['is_stick', 'eq', 1],
            ['is_show' ,'eq', 1],
            ['status' ,'eq', 1],
            ['article_id' ,'neq',$id]
        ];
        $tuiArticles = ArticleModel::where($tuiWhere)->field('thumb,article_id,article_title')->order('click desc')->limit(4)->select();

        if(SITE_TEMPLATE == 'lost_time'){
            // 主页点击排行栏目
            $clickRankingArticles = ArticleModel::where(['status'=>1,'is_show'=>1])->field('article_title,article_desc,article_id,thumb')->limit(8)->order('click desc')->select();
            $this->assign('clickRankingArticles',$clickRankingArticles);
            // 本栏推荐
            $stickArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>6,'is_stick'=>1])->field('article_title,article_desc,article_id,thumb,author,ctime')->limit(7)->order('click desc')->select();
            $this->assign('stickArticles',$stickArticles);
            // 猜你喜欢
            $loveArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>6])->field('article_title,article_desc,article_id,thumb,author,ctime')->limit(8)->order('love desc')->select();
            $this->assign('loveArticles',$loveArticles);

        }

        $this->assign('tuiArticles',$tuiArticles);
        $this->assign('comments',$comments);
    	$this->assign('data_info',$data_info);
        return $this->fetch('detail');
    }

    public function search()
    {
        //$page = input('param.page/d', 1);
        $limit = input('param.limit/d', 10);
        $keywords = input('param.keywords');
        $where = [];
        $where[] = ['is_show','eq',1];
        $where[] = ['status','eq',1];
        // 关键词搜索，匹配关键词或标题
        if($keywords){
            $whereKeywords = "keywords like '%".$keywords."%' or article_title like '%".$keywords."%'";  
        }else{
            $whereKeywords = '';
        }
        //$whereQuery['query']['page'] = $page;
        $whereQuery['query']['keywords'] = $keywords;
        $articles = ArticleModel::where($where)->where($whereKeywords)->order('ctime desc')->paginate($limit,'',$whereQuery);
        // $articles = ArticleModel::where($where)->where($whereKeywords)->paginate($limit,'',$whereQuery)->each(function($item, $key){
        //     //$item->nickname = 'think';
        // });
        $page = $articles->render();
        $this->assign('page',$page);
        $this->assign('keywords',$keywords);
        $this->assign('articles',$articles);
        return $this->fetch('search_index');
    }

    public function search_old()
    {
        $page = input('param.page/d', 1);
        $limit = input('param.limit/d', 10);
        $keywords = input('param.keywords');
        $where = [];
        $where[] = ['is_show','eq',1];
        $where[] = ['status','eq',1];
        //$where[] = ['keywords','like','%'.$keywords.'%'];
        // 关键词搜索，匹配关键词或标题
        if($keywords){
            $whereKeywords = "keywords like '%".$keywords."%' or article_title like '%".$keywords."%'";
            //$where[] = ['keywords','like','%'.$keywords.'%'];
        }else{
            $whereKeywords = '';
        }
        $whereQuery['query']['keywords'] = $keywords;
        //halt($keywords);
        $articles = ArticleModel::where($where)->where($whereKeywords)->page($page)->order('ctime desc')->paginate($limit,'',$whereQuery);
        $page = $articles->render();
        $this->assign('page',$page);
        $this->assign('keywords',$keywords);
        $this->assign('articles',$articles);

        return $this->fetch('search_index');
    }

    public function album()
    {
        $id = input('article_id');
        //halt($id);
        $data_info = ArticleModel::where('article_id',$id)->find();
        $this->assign('data_info',$data_info);
        return $this->fetch('album');
    }

    public function book()
    {
        $id = input('article_id');
        $data_info = ArticleModel::where('article_id',$id)->find();
        $this->assign('data_info',$data_info);
        return $this->fetch('book');
    }
}