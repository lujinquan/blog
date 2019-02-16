<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;

class Index extends Base
{
    public function index()
    {
    	$banner = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>97])->field('article_id,thumb')->find();
    	$this->assign('banner',$banner);

        $imgs = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>98])->field('article_id,thumb')->limit(6)->select();
        //halt(array_chunk($imgs->toArray(),3,true));
        $this->assign('imgs',array_chunk($imgs->toArray(),3,true));

        $imgsTui = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>99])->field('article_id,article_title,author,article_long_title,thumb')->limit(3)->select();
        $this->assign('imgsTui',$imgsTui);
        return $this->fetch();
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

    public function album()
    {
        $id = input('article_id');
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