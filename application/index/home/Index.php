<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Article as ArticleModel;

class Index extends Base
{
    public function index()
    {
    	$banner = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>97])->field('article_id,thumb')->find();
    	$this->assign('banner',$banner);
        return $this->fetch();
    }
    public function detail()
    {
    	$id = input('article_id');

    	$data_info = ArticleModel::where('article_id',$id)->find();
    	// 获取当前文章的评论
        $comments = $data_info->comment()->with('member')->where(['is_show'=>1,'status'=>1])->order('ctime desc')->limit(4)->select();
        //halt($comments);
        // 获取推荐的文章
        $tuiWhere = [
            ['cate_id' ,'eq' , $data_info['cate_id']],
            ['is_stick', 'eq', 1],
            ['is_show' ,'eq', 1],
            ['status' ,'eq', 1],
            ['article_id' ,'neq',$id]
        ];
        $tuiArticles = ArticleModel::where($tuiWhere)->field('thumb,article_id,article_title')->order('click desc')->limit(4)->select();
        //halt(ArticleModel::getLastSql());
        

        $this->assign('tuiArticles',$tuiArticles);
        
        $this->assign('comments',$comments);
    	

    	$this->assign('data_info',$data_info);
        return $this->fetch('detail');
    }
}