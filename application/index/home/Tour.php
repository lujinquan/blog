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
                $tourArticles[$c['cate_id']]['list'] = ArticleModel::where($tourCateWhere)->field('thumb,article_id,article_title,article_desc,ctime,author,article_long_title')->limit(6)->order('sort_order asc')->select()->toArray();
            }  
            //halt($tourArticles);
            $this->assign('tourArticles',$tourArticles);

            // 主页点击排行栏目
            $clickRankingArticles = ArticleModel::where(['status'=>1,'is_show'=>1])->field('article_title,article_desc,article_id,thumb')->limit(8)->order('click desc')->select();
            $this->assign('clickRankingArticles',$clickRankingArticles);
            // 本栏推荐
            $stickArticles = ArticleModel::where([['status','eq',1],['is_show','eq',1],['cate_id','in',$cates],['is_stick','eq',1]])->field('article_title,article_desc,article_id,thumb,author,ctime')->limit(7)->order('click desc')->select();
            $this->assign('stickArticles',$stickArticles);
            // 猜你喜欢
            $loveArticles = ArticleModel::where([['status','eq',1],['is_show','eq',1],['cate_id','in',$cates],['is_stick','eq',1]])->field('article_title,article_desc,article_id,thumb,author,ctime')->limit(8)->order('love desc')->select();
            $this->assign('loveArticles',$loveArticles);
            // 主页文章总数
            $articlesCount = ArticleModel::where(['status'=>1,'is_show'=>1])->where([['cate_id','neq',102]])->count();
            $this->assign('articlesCount',$articlesCount);
            // 主页评论总数
            $commentsCount = CommentModel::where(['status'=>1,'is_show'=>1])->count();
            $this->assign('commentsCount',$commentsCount);

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

    public function detail()
    {
        $id = input('param.article_id');
        // 获取当前文章详情
        $row = ArticleModel::where(['article_id'=>$id,'is_show'=>1,'status'=>1])->find();
        if(!$row){
            return $this->error('页面不存在','/index.html');
        }
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
            // 主页点击排行栏目
            $clickRankingArticles = ArticleModel::where(['status'=>1,'is_show'=>1])->field('article_title,article_desc,article_id,thumb')->limit(8)->order('click desc')->select();
            $this->assign('clickRankingArticles',$clickRankingArticles);
            // 本栏推荐
            $stickArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>6,'is_stick'=>1])->field('article_title,article_desc,article_id,thumb,author,ctime')->limit(7)->order('click desc')->select();
            $this->assign('stickArticles',$stickArticles);
            // 猜你喜欢
            $loveArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>6])->field('article_title,article_desc,article_id,thumb,author,ctime')->limit(8)->order('love desc')->select();
            $this->assign('loveArticles',$loveArticles);
            // 主页文章总数
            $articlesCount = ArticleModel::where(['status'=>1,'is_show'=>1])->where([['cate_id','neq',102]])->count();
            $this->assign('articlesCount',$articlesCount);
            // 主页评论总数
            $commentsCount = CommentModel::where(['status'=>1,'is_show'=>1])->count();
            $this->assign('commentsCount',$commentsCount);
            return $this->fetch(); 
        }else{
            return $this->fetch('detail_word');
        }
        
    }
}