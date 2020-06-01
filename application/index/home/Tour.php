<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;
use app\blog\model\Comment as CommentModel;

class Tour extends Base
{
    public function index()
    {
    	if(SITE_TEMPLATE == 'lost_time'){
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10);
            $catesArr = CateModel::where([['p_id','eq',3],['is_show','eq',1],['status','eq',1]])->field('cate_id,cate_name')->select()->toArray();
            // $articleWhere = [
            //     ['cate_id','in',$catesArr],
            //     ['is_show','eq',1],
            //     ['status','eq',1]
            // ];
            $tourArticles = [];
            $cates = [];
            foreach ($catesArr as $c) {
                $cates[] = $c['cate_id'];
                $tourCateWhere = [
                    ['cate_id','eq',$c['cate_id']],
                    ['is_show','eq',1],
                    ['status','eq',1]
                ];
                $tourArticles[$c['cate_id']]['cate_name'] = $c['cate_name'];
                $tourArticles[$c['cate_id']]['list'] = ArticleModel::where($tourCateWhere)->field('thumb,article_id,cate_id,article_title,article_desc,ctime,author,article_long_title')->limit(6)->order('sort_order asc')->select()->toArray();
            }  
            //halt($tourArticles);
            $this->assign('tourArticles',$tourArticles);

            
            // 本栏推荐
            $stickArticles = ArticleModel::where([['status','eq',1],['is_show','eq',1],['cate_id','in',$cates],['is_stick','eq',1]])->field('article_title,article_desc,cate_id,article_id,thumb,author,ctime')->limit(7)->order('click desc')->select();
            $this->assign('stickArticles',$stickArticles);
            // 猜你喜欢
            $loveArticles = ArticleModel::where([['status','eq',1],['is_show','eq',1],['cate_id','in',$cates],['is_stick','eq',1]])->field('article_title,article_desc,cate_id,article_id,thumb,author,ctime')->limit(8)->order('love desc')->select();
            $this->assign('loveArticles',$loveArticles);

        }else{
            $catesArr = CateModel::where('p_id','eq',2)->column('cate_id');
            $where = [];
            $where[] = ['status','eq',1];
            $where[] = ['is_show','eq',1];
            $where[] = ['cate_id','in',$catesArr];
            $toursArr = ArticleModel::where($where)->field('article_id,article_title,article_long_title,thumb')->order('sort_order asc')->select();
            $this->assign('toursArr',$toursArr);
        }
        return $this->fetch();
    }

    public function list()
    {
        if(SITE_TEMPLATE == 'lost_time'){
            $cate_id = input('param.cate_id/d', '');
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 1);
            $catesArr = CateModel::where([['p_id','eq',3],['is_show','eq',1],['status','eq',1]])->field('cate_id,cate_name,link')->select();
            $this->assign('catesArr',$catesArr);
            $this->assign('catesArr',$catesArr);
            $cateidsArr = [];
            $cateInfo = '';
            foreach($catesArr as $c){
                $cateidsArr[] = $c['cate_id'];
            }
            if($cate_id){ //如果有子分类，则直接取子分类的文章
                $cateInfo = CateModel::where([['cate_id','eq',$cate_id]])->find();
                $cateidsArr = [$cate_id];
            }
            $this->assign('cateInfo',$cateInfo);
            $articleWhere = [
                ['cate_id','in',$cateidsArr],
                ['is_show','eq',1],
                ['status','eq',1]
            ];
            $total_data = ArticleModel::where($articleWhere)->count();
            $total_page = ceil($total_data/$limit);
            if($page > $total_page){
                $page = $total_page;
            }
            $this->assign('total_data',$total_data);
            $this->assign('total_page',$total_page);
            $this->assign('page',$page);

            $tourArticles = ArticleModel::where($articleWhere)->field('thumb,article_id,cate_id,article_title,article_desc,ctime,author,article_long_title')->page($page)->limit($limit)->order('sort_order asc')->select();
            //halt($galleryArticles);
            $this->assign('tourArticles',$tourArticles);
            // 本栏推荐
            $stickArticles = ArticleModel::where($articleWhere)->where([['is_stick','eq',1]])->field('article_title,cate_id,article_desc,article_id,thumb,author,ctime')->limit(7)->order('click desc')->select();
            $this->assign('stickArticles',$stickArticles);
            // 猜你喜欢
            $loveArticles = ArticleModel::where($articleWhere)->field('article_title,cate_id,article_desc,article_id,thumb,author,ctime')->limit(8)->order('love desc')->select();
            $this->assign('loveArticles',$loveArticles);

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

    public function detail()
    {
        $id = input('param.article_id');
        // 获取当前文章详情
        $row = ArticleModel::with('cate')->where(['article_id'=>$id,'is_show'=>1,'status'=>1])->find();
        if(!$row){
            return $this->error('页面不存在','/index.html');
        }
        // 上一篇
        $preRow = ArticleModel::with('cate')->where(['is_show'=>1,'status'=>1,'cate_id'=>$row['cate_id']])->where([['article_id','<',$id]])->order('article_id desc')->find();
        // 下一篇
        $nextRow = ArticleModel::with('cate')->where(['is_show'=>1,'status'=>1,'cate_id'=>$row['cate_id']])->where([['article_id','>',$id]])->order('article_id asc')->find();
        // 浏览量 +1
        ArticleModel::where('article_id',$id)->setInc('click');
        // 获取当前文章的评论
        $comments = $row->comment()->with('member')->where([['is_show','eq',1],['status','eq',1]])->order('ctime desc')->limit(10)->select();
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
        
        $this->assign('cateID',$row['cate_id']);
        $this->assign('tuiArticles',$tuiArticles);
        
        $this->assign('comments',$comments);
        $this->assign('data_info',$row);
        if(SITE_TEMPLATE == 'lost_time'){
            
            // 本栏推荐
            $stickArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>6,'is_stick'=>1])->field('article_title,article_desc,cate_id,article_id,thumb,author,ctime')->limit(7)->order('click desc')->select();
            $this->assign('stickArticles',$stickArticles);
            // 猜你喜欢
            $loveArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>6])->field('article_title,article_desc,cate_id,article_id,thumb,author,ctime')->limit(8)->order('love desc')->select();
            $this->assign('loveArticles',$loveArticles);
            $this->assign('preRow',$preRow);
            $this->assign('nextRow',$nextRow);
            return $this->fetch(); 
        }else{
            return $this->fetch('detail_word');
        }
        
    }
}