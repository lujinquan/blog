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
    	
		$catesArr = CateModel::where('p_id','eq',2)->column('cate_id');
    	$where = [];
    	$where[] = ['status','eq',1];
    	$where[] = ['is_show','eq',1];
    	$where[] = ['cate_id','in',$catesArr];
    	$toursArr = ArticleModel::where($where)->field('article_id,article_title,article_long_title,thumb')->order('sort_order asc')->select();
    	$this->assign('toursArr',$toursArr);
        return $this->fetch();
    }

    public function detail()
    {
        $id = input('param.article_id');
        //halt($id);
        // 浏览量 +1
        ArticleModel::where('article_id',$id)->setInc('click');
        // 获取当前文章详情
        $row = ArticleModel::find($id);
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
        return $this->fetch('detail_word');
    }
}