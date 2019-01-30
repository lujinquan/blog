<?php

namespace app\index\home;
use app\index\home\Base;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;
use app\blog\model\Comment as CommentModel;

class Blog extends Base
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
        ];
        $newArticles = ArticleModel::where($newWhere)->field('thumb,article_id,article_title,article_long_title')->order('ctime desc')->limit(4)->select();
        // 获取右侧最新评论
        $newComWhere = [
            'is_show' => 1,
            'status' => 1,
        ];
        $newComments = CommentModel::with('article,member')->where($newWhere)->field('com_id,article_id,member_id,com_content,uid,uid_photo,ctime')->order('ctime desc')->limit(4)->select();
//halt($newComments);
        $this->assign('newArticles',$newArticles);
        $this->assign('newComments',$newComments);
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
        $articleFields = 'article_id,cate_id,article_title,article_long_title,article_desc,link,author,ctime,click,thumb';
    	//$initArticles = ArticleModel::with('cate')->where($articleWhere)->field($articleFields)->page($page)->limit(3)->order('sort_order asc')->select();
    	$initArticles = ArticleModel::with('cate')->where($articleWhere)->field($articleFields)->page($page)->order('sort_order asc')->paginate(5);
		//halt($initArticles);//->paginate(config('paginate.list_rows'));
		$page = $initArticles->render();
		$this->assign('page',$page);
    	$this->assign('cateID',$cateID);
    	$this->assign('initArticles',$initArticles);
        return $this->fetch();
    }

    public function detail()
    {
    	$id = input('get.article_id');
    	if(!$id){
    		return $this->error('文章不存在','blog/index');
    	}
        // 浏览量 +1
        ArticleModel::where('article_id',$id)->setInc('click');
        // 获取当前文章详情
        $row = ArticleModel::find($id);
        // 获取当前文章的评论
        $comments = $row->comment()->with('member')->where(['is_show'=>1,'status'=>1])->order('ctime desc')->limit(4)->select();
        //halt($comments);
        // 获取推荐的文章
        $tuiWhere = [
            'cate_id' => $row['cate_id'],
            'is_stick' => 1,
            'is_show' => 1,
            'status' => 1,
            'article_id' => ['neq',$id]
        ];
        $tuiArticles = ArticleModel::where($tuiWhere)->field('thumb,article_id,article_title')->order('click desc')->limit(4)->select();
        
        
        //halt($tuiArticles);
        $this->assign('cateID',$row['cate_id']);
        $this->assign('tuiArticles',$tuiArticles);
        
        $this->assign('comments',$comments);
    	$this->assign('data_info',$row);
    	return $this->fetch();
    }

    public function com()
    {
        $id = input('article_id');
        $res = ArticleModel::where('article_id',$id)->setInc('com');
        if($res){
           return $this->success('评论成功','article/index'); 
        }
        return $this->error('评论失败');
    }

    public function love()
    {
        $id = input('article_id');
        $res = ArticleModel::where('article_id',$id)->setInc('love');
        if($res){
           return $this->success('点赞成功'); 
        }
        return $this->error('点赞失败');
    }
}