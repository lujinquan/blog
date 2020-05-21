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
            $keywords = trim(input('param.keywords'));
            $cateid = input('param.cate_id');

            if($cateid === 0){
                $cateArr = CateModel::where('level','eq',3)->column('cate_id');
            }else{
                $find = CateModel::where('cate_id','eq',$cateid)->find();
                if($find['level'] == 1){
                    $cateArr = CateModel::where('p_id','eq',$cateid)->column('cate_id');
                }else{
                    $cateArr = [$cateid];
                }
            }

            $where = [
                ['status','eq',1],
            ];
            if($cateid){
                $where[] = ['cate_id','in',$cateArr];
            }
            // 关键词搜索，匹配关键词或标题
            if($keywords){
                $whereKeywords = "keywords like '%".$keywords."%' or article_title like '%".$keywords."%'";
                //$where[] = ['keywords','like','%'.$keywords.'%'];
            }else{
                $whereKeywords = '';
            }
            $fields = 'article_id,keywords,article_title,cate_id,author,link,sort_order,is_show,ctime,com,love,click';
            $data['data'] = ArticleModel::with('cate')->field($fields)->where($where)->where($whereKeywords)->page($page)->order('ctime desc')->limit($limit)->select();
            //halt(ArticleModel::getLastSql());
            $data['count'] = ArticleModel::where($where)->count('cate_id');
            $data['code'] = 0;
            $data['msg'] = '';
            return json($data);
        }
        $catWhere = [
            ['status' , 'eq',1],
            ['is_show' ,'eq', 1],
            ['level','lt',3],
        ];
        $cates = CateModel::where($catWhere)->field('cate_id,cate_name,p_id,level')->select();
        $this->assign('cates', $cates);
        return $this->fetch();
    }

    public function md()
    {
        return $this->fetch();
    }

    public function md_render()
    {
        $row = ArticleModel::get(88);
        //halt($row);
        $this->assign('data_info', $row);
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
        // $articles = ArticleModel::select();
        // foreach ($articles as $key => $value) {
        //     $mod = new ArticleModel();
        //     //$data['article_content'] = htmlspecialchars($data['article_content']);
        //     $mod->allowField(true)->save(['article_content'=>htmlspecialchars_decode($value['article_content'])],['article_id'=>$value['article_id']]);
        // }
        // halt($articles);

        $id = input('get.article_id');
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $data['article_md_content'] = $_POST['article_md_content']; //用原始的方法接收带标签的数据
            //$data['article_md_content'] = htmlspecialchars_decode($data['article_md_content']);
            //halt(htmlspecialchars($data['article_content']));
            // 验证
            // $result = $this->validate($data, 'Article.sceneAdd');
            // if($result !== true) {
            //     return $this->error($result);
            // }
            $mod = new ArticleModel();
            if (!$mod->allowField(true)->save($data,['article_id'=>$data['article_id']])) {
                return $this->error('修改失败');
            }
            return $this->success('修改成功');
        }
        if(!$id){
            return $this->error('参数错误');
        }
        $row = ArticleModel::get($id);
        //$row['article_md_content'] = htmlspecialchars($row['article_md_content']);
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

    public function sort_order()
    {
        $id = input('article_id');
        $sort = input('val');
        $res = ArticleModel::where('article_id',$id)->setField('sort_order',$sort);
        if($res){
            return $this->success('排序成功');
        }
        return $this->error('排序失败');
    }

    public function show()
    {
        $id = input('article_id');
        $show = input('val');
        $res = ArticleModel::where('article_id',$id)->setField('is_show',$show);
        if($res){
            return $this->success('设置成功');
        }
        return $this->error('设置失败');
    }
}