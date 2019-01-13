<?php

namespace app\index\home;
use app\index\home\Base;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;

class Blog extends Base
{
	    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        $cateWhere = [
        	'p_id' => 4,
        	'is_show' => 1,
        	'status' => 1
        ];
    	$rightCates = CateModel::where($cateWhere)->field('cate_id,cate_name,link')->order('sort_order asc')->select();
        $this->assign('rightCates',$rightCates);
    }

    public function index()
    {
    	$page = input('param.page/d', 1);
        $limit = input('param.limit/d', 3);
        $cateID = input('param.cate_id/d',7);
    	$articleWhere = [
        	'cate_id' => $cateID, //默认显示php语言的栏目
        	'is_show' => 1,
        	'status' => 1
        ];
        $articleFields = 'article_id,cate_id,article_title,article_desc,link,author,ctime,click,thumb';
    	//$initArticles = ArticleModel::with('cate')->where($articleWhere)->field($articleFields)->page($page)->limit(3)->order('sort_order asc')->select();
    	$initArticles = ArticleModel::with('cate')->where($articleWhere)->field($articleFields)->page($page)->order('sort_order asc')->paginate(3);
		//halt($initArticles);//->paginate(config('paginate.list_rows'));
		$page = $initArticles->render();
		$this->assign('page',$page);
    	$this->assign('cateID',$cateID);
    	$this->assign('initArticles',$initArticles);
        return $this->fetch();
    }

    public function detail()
    {
    	$articleID = input('get.article_id');
    	if(!$articleID){
    		return $this->error('文章不存在','blog/index');
    	}
    	$row = ArticleModel::get($articleID);
    	$this->assign('data_info',$row);
    	return $this->fetch();
    }
}