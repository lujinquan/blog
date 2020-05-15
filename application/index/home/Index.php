<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;

class Index extends Base
{
    public function index()
    {//halt(VERSION);//cookie('avatar')
    	$banner = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>97])->field('article_id,thumb')->find();
    	$this->assign('banner',$banner);

        $imgs = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>98])->field('article_id,thumb')->limit(6)->select();
        //halt(array_chunk($imgs->toArray(),3,true));
        $this->assign('imgs',array_chunk($imgs->toArray(),3,true));

        $imgsTui = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>99])->field('article_id,article_title,author,article_long_title,thumb')->limit(3)->select();
        //halt($imgsTui);
        $this->assign('imgsTui',$imgsTui);
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