<?php

namespace app\blog\admin;
use app\system\admin\Admin;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;

class ArticleCount extends Admin
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $where = [
                ['status','eq',1],
                ['is_show','eq',1]
            ];
            $articles = ArticleModel::with('cate')->where($where)->field('count(article_id) as article_ids,cate_id')->group('cate_id')->select();
            $data['code'] = 0;
            $data['msg'] = '';
            return json($data);
        }
        $where = [
            ['status','eq',1],
            ['is_show','eq',1]
        ];
    	$data['data'] = ArticleModel::with('cate')->where($where)->field('count(article_id) as article_ids,cate_id')->group('cate_id')->select()->toArray();
        $data['code'] = 0;
        $data['msg'] = '';
    	//halt(json($data));
    	$this->assign('articles',json_encode($data));
    	return $this->fetch();
    }
}