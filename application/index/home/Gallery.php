<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;
use app\blog\model\Comment as CommentModel;

class Gallery extends Base
{
    public function index()
    {   

        if(SITE_TEMPLATE == 'lost_time'){
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10);
            $catesArr = CateModel::where([['p_id','eq',2],['is_show','eq',1],['status','eq',1]])->column('cate_id');
            $articleWhere = [
                ['cate_id','in',$catesArr],
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

            $galleryArticles = ArticleModel::where($articleWhere)->field('thumb,article_id,cate_id,article_title,article_desc,ctime,author,article_long_title')->page($page)->limit($limit)->order('sort_order asc')->select();
            $this->assign('galleryArticles',$galleryArticles);
            

            // 本栏推荐
            $stickArticles = ArticleModel::where($articleWhere)->where([['is_stick','eq',1]])->field('article_title,cate_id,article_desc,article_id,thumb,author,ctime')->limit(7)->order('click desc')->select();
            $this->assign('stickArticles',$stickArticles);
            // 猜你喜欢
            $loveArticles = ArticleModel::where($articleWhere)->field('article_title,cate_id,article_desc,article_id,thumb,author,ctime')->limit(8)->order('love desc')->select();
            $this->assign('loveArticles',$loveArticles);

        }else{
            $catesArr = CateModel::where([['p_id','eq',3],['is_show','eq',1],['status','eq',1]])->column('cate_id');
            $articleWhere = [
                ['cate_id','in',$catesArr],
                ['is_show','eq',1],
                ['status','eq',1]
            ];
            $galleryArticles = ArticleModel::where($articleWhere)->field('thumb,article_id,cate_id,article_title,article_long_title')->order('sort_order asc')->select();
            $this->assign('galleryArticles',array_chunk($galleryArticles->toArray(),3,false));
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
        // 浏览量 +1
        ArticleModel::where('article_id',$id)->setInc('click');
        // 获取当前文章的评论
        $comments = $row->comment()->with('member')->where(['is_show'=>1,'status'=>1])->order('ctime desc')->limit(4)->select();
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
        //halt($tuiArticles);
        if(SITE_TEMPLATE == 'lost_time'){
           
            // 本栏推荐
            $stickArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>6,'is_stick'=>1])->field('article_title,article_desc,cate_id,article_id,thumb,author,ctime')->limit(7)->order('click desc')->select();
            $this->assign('stickArticles',$stickArticles);
            // 猜你喜欢
            $loveArticles = ArticleModel::where(['status'=>1,'is_show'=>1,'cate_id'=>6])->field('article_title,article_desc,cate_id,article_id,thumb,author,ctime')->limit(8)->order('love desc')->select();
            $this->assign('loveArticles',$loveArticles);

        }
        
        //halt($tuiArticles);
        $this->assign('cateID',$row['cate_id']);
        $this->assign('tuiArticles',$tuiArticles);
        //halt($row);
        $this->assign('comments',$comments);
        $this->assign('data_info',$row);
        return $this->fetch();
    }
}