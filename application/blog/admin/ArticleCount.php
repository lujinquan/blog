<?php

namespace app\blog\admin;
use app\system\admin\Admin;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;

class ArticleCount extends Admin
{
    public function index()
    {
    	$where = [
    		['status','eq',1],
    		['is_show','eq',1]
    	];
    	$articles = ArticleModel::with('cate')->where($where)->field('count(article_id) as article_ids,cate_id')->group('cate_id')->select();
    	//halt($articles);
    	$this->assign('articles',$articles);
    	return $this->fetch();
    }
}