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
    	$catesArr = CateModel::where([['p_id','eq',3],['is_show','eq',1],['status','eq',1]])->column('cate_id');
    	$articleWhere = [
    		['cate_id','in',$catesArr],
            ['is_show','eq',1],
            ['status','eq',1]
        ];
        $galleryArticles = ArticleModel::where($articleWhere)->field('thumb,article_id,article_title,article_long_title')->order('sort_order asc')->select();
        //halt(array_chunk($galleryArticles->toArray(),3,false));
        $this->assign('galleryArticles',array_chunk($galleryArticles->toArray(),3,false));
        return $this->fetch();
    }

    public function detail()
    {
        $id = input('get.article_id');
        // 浏览量 +1
        ArticleModel::where('article_id',$id)->setInc('click');
        // 获取当前文章详情
        $row = ArticleModel::find($id);
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
        //halt(ArticleModel::getLastSql());
        
        //halt($tuiArticles);
        $this->assign('cateID',$row['cate_id']);
        $this->assign('tuiArticles',$tuiArticles);
        
        $this->assign('comments',$comments);
        $this->assign('data_info',$row);
        return $this->fetch();
    }
}