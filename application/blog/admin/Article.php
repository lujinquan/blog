<?php

namespace app\blog\admin;
use app\system\admin\Admin;
use app\blog\model\Cate as CateModel;
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
            $fields = 'article_id,article_title,cate_id,author,link,sort_order,is_show,ctime,com,love,click';
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
            $result = $this->validate($data, 'Article.sceneAdd');
            if($result !== true) {
                return $this->error($result);
            }
            $mod = new ArticleModel();
            if (!$mod->allowField(true)->create($data)) {
                return $this->error('添加失败');
            }
            return $this->success('添加成功','article/index');
        }
        $cateWhere = [
            'is_show' => 1,
            'status' => 1
        ];
        $cates = CateModel::where($cateWhere)->field('cate_id,cate_name,p_id,level')->select();
        $this->assign('cates',$cates);
        return $this->fetch('form');
    }

    public function edit()
    {
        $id = input('get.article_id');
        if ($this->request->isPost()) {
            $data = $this->request->post();
            //halt($data);
            // 验证
            $result = $this->validate($data, 'Article.sceneAdd');
            if($result !== true) {
                return $this->error($result);
            }
            $mod = new ArticleModel();
            if (!$mod->allowField(true)->create($data)) {
                return $this->error('添加失败');
            }
            return $this->success('添加成功','article/index');
        }
        if(!$id){
            return $this->error('参数错误');
        }
        $row = ArticleModel::get($id);
        $cateWhere = [
            'is_show' => 1,
            'status' => 1
        ];
        $cates = CateModel::where($cateWhere)->field('cate_id,cate_name,p_id,level')->select();
        $this->assign('cates',$cates);
        $this->assign('data_info',$row);
        return $this->fetch();
    }

    public function detail()
    {
        $id = input('article_id');
        $row = ArticleModel::with('cate')->where('article_id',$id)->find();
        $this->assign('data_info',$row);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('article_id');
        //halt($id);
        $update = [
            'dtime' => request()->time(),
            'status' => 0
        ];
        $res = ArticleModel::where('article_id',$id)->update($update);
        if($res){
            return $this->success('删除成功','article/index');
        }
        return $this->error('删除失败');
    }
}