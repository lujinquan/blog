<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Tag as TagModel;
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
        if(SITE_TEMPLATE == 'lost_time'){
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10);
            $catesArr = CateModel::where([['p_id','eq',4],['is_show','eq',1],['status','eq',1]])->column('cate_id');
            $articleWhere = [
                ['cate_id','in',$catesArr],
                ['is_show','eq',1],
                ['status','eq',1]
            ];
            $blogArticles = ArticleModel::where($articleWhere)->field('thumb,article_id,article_title,article_desc,ctime,author,article_long_title')->page($page)->limit($limit)->order('sort_order asc')->select();
            //halt($galleryArticles);
            $this->assign('blogArticles',$blogArticles);

            // 主页点击排行栏目
            $clickRankingArticles = ArticleModel::where(['status'=>1,'is_show'=>1])->field('article_title,article_desc,article_id,thumb')->limit(8)->order('click desc')->select();
            $this->assign('clickRankingArticles',$clickRankingArticles);
            // 本栏推荐
            $stickArticles = ArticleModel::where($articleWhere)->where([['is_stick','eq',1]])->field('article_title,article_desc,article_id,thumb,author,ctime')->limit(7)->order('click desc')->select();
            $this->assign('stickArticles',$stickArticles);
            // 猜你喜欢
            $loveArticles = ArticleModel::where($articleWhere)->field('article_title,article_desc,article_id,thumb,author,ctime')->limit(8)->order('love desc')->select();
            $this->assign('loveArticles',$loveArticles);
            // 主页文章总数
            $articlesCount = ArticleModel::where(['status'=>1,'is_show'=>1])->where([['cate_id','neq',102]])->count();
            $this->assign('articlesCount',$articlesCount);
            // 主页评论总数
            $commentsCount = CommentModel::where(['status'=>1,'is_show'=>1])->count();
            $this->assign('commentsCount',$commentsCount);

        }else{
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
        }
        return $this->fetch();
    }

    /**
     * [detail 获取文章的详情]
     * @return [json] [回复是否成功]
     */
    public function detail()
    {
    	$id = input('article_id','');
    	// 获取当前文章详情
        $row = ArticleModel::where(['article_id'=>$id,'is_show'=>1,'status'=>1])->find();
        if(!$row){
            return $this->error('页面不存在','/index.html');
        }
        // 浏览量 +1
        ArticleModel::where(['article_id'=>$id,'is_show'=>1,'status'=>1])->setInc('click');

        // 获取当前文章的评论
        $comments = $row->comment()->with('member')->where(['is_show'=>1,'status'=>1])->order('ctime desc')->select();
        foreach($comments as &$c){
            $c['replay'] = CommentModel::with(['member'])->where([['com_pid','eq',$c['com_id']],['is_show','eq',1],['status','eq',1]])->order('ctime asc')->select();
        }
        //halt($comments);
        // 获取推荐的文章
        $tuiWhere = [
            ['cate_id' ,'eq' , $row['cate_id']],
            ['is_stick', 'eq', 1],
            ['is_show' ,'eq', 1],
            ['status' ,'eq', 1],
            ['article_id' ,'neq',$id]
        ];
        $tuiArticles = ArticleModel::where($tuiWhere)->field('thumb,article_id,article_title')->order('click desc')->limit(4)->select();
        //halt(ArticleModel::getLastSql());
        
        //halt($tuiArticles);
        $this->assign('cateID',$row['cate_id']);
        $this->assign('tuiArticles',$tuiArticles);
        
        $this->assign('comments',$comments);
    	$this->assign('data_info',$row);
    	return $this->fetch();
    }

    /**
     * [com 文章的评论功能]
     * @return [json] [评论是否成功]
     */
    public function com()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            //halt($data);
            if(!$data['com_content']){
                return $this->error('评论不能为空');
            }
            $data['member_id'] = cookie('member_id')?cookie('member_id'):10000;
            $mod = new CommentModel;
            if (!$mod->allowField(true)->create($data)) {
                return $this->error('评论失败');
            }
            ArticleModel::where('article_id',$data['article_id'])->setInc('com');
            return $this->success('评论成功');
        }
    }

    /**
     * [replay 文章评论的回复功能]
     * @return [json] [回复是否成功]
     */
    public function replay()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            //halt($data);
            if(!$data['com_content']){
                return $this->error('回复不能为空');
            }
            $data['member_id'] = cookie('member_id')?cookie('member_id'):10000;
            $mod = new CommentModel;
            if (!$mod->allowField(true)->create($data)) {
                return $this->error('回复失败');
            }
            // ArticleModel::where('article_id',$data['article_id'])->setInc('com');
            return $this->success('回复成功');
        }
        
    }

    /**
     * [love 文章的点赞功能]
     * @return [json] [回复是否成功]
     */
    public function tag()
    {
        $id = input('id');
        $row = TagModel::get($id);
//halt($row);
        $page = input('param.page/d', 1);
        $limit = input('param.limit/d', 5);
        
        $articleWhere = [
            ['cate_id' , 'eq' , $row['cate_id']], //默认显示php语言的栏目
            ['keywords' , 'like' , '%'.$row['tag_name'].'%'],
            ['is_show' , 'eq' , 1],
            ['status' , 'eq' , 1],
        ];
        //halt($articleWhere);
        $articleFields = 'article_id,cate_id,article_title,article_long_title,article_desc,link,author,ctime,click,thumb';
        $initArticles = ArticleModel::with('cate')->where($articleWhere)->field($articleFields)->page($page)->order('ctime desc')->paginate($limit);
        //halt($initArticles);
        $page = $initArticles->render();
        $this->assign('page',$page);
        $this->assign('cateID',$row['cate_id']);
        $this->assign('initArticles',$initArticles);
        return $this->fetch('index');
    }

    /**
     * [love 文章的点赞功能]
     * @return [json] [回复是否成功]
     */
    public function love()
    {
        $id = input('id');
        $res = ArticleModel::where('article_id',$id)->setInc('love');
        if($res){
           return $this->success('点赞成功'); 
        }
        return $this->error('点赞失败');
    }

    /**
     * [love 文章评论的点赞功能]
     * @return [json] [回复是否成功]
     */
    public function response_love()
    {
        $id = input('com_id');
        $res = CommentModel::where('com_id',$id)->setInc('love');
        if($res){
           return $this->success('点赞成功'); 
        }
        return $this->error('点赞失败');
    }
}