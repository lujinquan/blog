<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;

class Tour extends Base
{
    public function index()
    {
    	
		$catesArr = CateModel::where('p_id','eq',2)->column('cate_id');
    	$where = [];
    	$where[] = ['status','eq',1];
    	$where[] = ['is_show','eq',1];
    	$where[] = ['cate_id','in',$catesArr];
    	$toursArr = ArticleModel::where($where)->field('article_id,article_title,article_long_title,thumb')->order('sort_order asc')->select();
    	$this->assign('toursArr',$toursArr);
        return $this->fetch();
    }
}