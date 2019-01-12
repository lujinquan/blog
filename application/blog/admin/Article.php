<?php

namespace app\blog\admin;
use app\system\admin\Admin;
use app\blog\model\Article as ArticleModel;

class Article extends Admin
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10);
            $where = [
                'status' => 1,
            ];
            $fields = 'article_title,cate_id,author,link,article_desc,push_time';
            $data['data'] = ArticleModel::field($fields)->where($where)->page($page)->order('sort_order asc')->limit($limit)->select();
            $data['count'] = ArticleModel::where($where)->count('cate_id');
            $data['code'] = 0;
            $data['msg'] = '';
            return json($data);
        }
        return $this->fetch();
    }

    public function add()
    {
        return $this->fetch();
    }

    public function edit()
    {
        return $this->fetch();
    }

    public function detail()
    {
        return $this->fetch();
    }

    public function del()
    {
        return $this->fetch();
    }
}