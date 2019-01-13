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
            $fields = 'article_id,article_title,cate_id,author,link,sort_order,is_show,ctime';
            $data['data'] = ArticleModel::with('cate')->field($fields)->where($where)->page($page)->order('ctime desc')->limit($limit)->select();
            $data['count'] = ArticleModel::where($where)->count('cate_id');
            $data['code'] = 0;
            $data['msg'] = '';
            return json($data);
        }
        return $this->fetch();
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            //halt($data);
            // 验证
            // $result = $this->validate($data, 'Article.sceneAdd');
            // if($result !== true) {
            //     return $this->error($result);
            // }
            $mod = new ArticleModel();
            if (!$mod->allowField(true)->create($data)) {
                return $this->error('添加失败');
            }
            return $this->success('添加成功','article/index');
        }
        //halt(1);
        return $this->fetch('form');
    }

    public function edit()
    {
        return $this->fetch();
    }

    public function detail()
    {
        $id = input('article_id');
        $row = ArticleModel::with('cate')->where('article_id',$id)->find();
        //halt(htmlspecialchars($row['article_content']));
        $this->assign('data_info',$row);
        return $this->fetch();
    }

    public function del()
    {
        return $this->fetch();
    }
}