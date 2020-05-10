<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Tag as TagModel;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;
use app\blog\model\Comment as CommentModel;

class Download extends Base
{
	    /**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        // 获取右侧栏目
        $cateWhere = [
        	'p_id' => 4,
        	'is_show' => 1,
        	'status' => 1
        ];
    	$rightCates = CateModel::where($cateWhere)->field('cate_id,cate_name,link')->order('sort_order asc')->select();
        // 获取右侧最新文章
        $newWhere = [
            'is_show' => 1,
            'status' => 1,
            'is_stick' => 1
        ];
        $newArticles = ArticleModel::where($newWhere)->field('thumb,medium_thumb,article_id,article_title,article_long_title')->order('click desc,ctime desc')->limit(4)->select();
        // 获取右侧最新评论
        $newComWhere = [
            'is_show' => 1,
            'status' => 1,
        ];
        // 获取右侧云标签
        $newComments = CommentModel::with('article,member')->where($newComWhere)->field('com_id,article_id,member_id,com_content,ctime')->order('ctime desc')->limit(4)->select();
        $tags = TagModel::where('status',1)->field('id,tag_name,url')->limit(30)->order('order_sort asc')->select();
        $this->assign('tags',$tags);
        $this->assign('newArticles',$newArticles);
        $this->assign('newComments',$newComments);
        $this->assign('rightCates',$rightCates);
    }

    public function index()
    {
    	$page = input('param.page/d', 1);
        $limit = input('param.limit/d', 5);
        $cateID = input('param.cate_id/d',7);
    	$articleWhere = [
        	'cate_id' => $cateID, //默认显示php语言的栏目
        	'is_show' => 1,
        	'status' => 1
        ];
        $articleFields = 'article_id,cate_id,article_title,article_long_title,article_desc,link,author,ctime,click,thumb';
    	//$initArticles = ArticleModel::with('cate')->where($articleWhere)->field($articleFields)->page($page)->limit(3)->order('sort_order asc')->select();
    	$initArticles = ArticleModel::with('cate')->where($articleWhere)->field($articleFields)->page($page)->order('sort_order asc,ctime desc')->paginate($limit);
		//halt(count($initArticles));//->paginate(config('paginate.list_rows'));
		$page = $initArticles->render();
		$this->assign('page',$page);
    	$this->assign('cateID',$cateID);
    	$this->assign('initArticles',$initArticles);
        return $this->fetch();
    }
}