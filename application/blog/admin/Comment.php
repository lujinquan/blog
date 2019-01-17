<?php

namespace app\blog\admin;
use app\system\admin\Admin;
use app\blog\model\Comment as CommentModel;

class Comment extends Admin
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10);
            $where = [
                'status' => 1,
            ];
            $fields = 'com_id,article_id,member_id,com_content,is_show,ctime';
            $data['data'] = CommentModel::with('article,member')->field($fields)->where($where)->page($page)->order('ctime desc')->limit($limit)->select();
            $data['count'] = CommentModel::where($where)->count('com_id');
            $data['code'] = 0;
            $data['msg'] = '';
            return json($data);
        }
        return $this->fetch();
    }

    public function del()
    {
        $id = input('com_id');
        $update = [
            'dtime' => request()->time(),
            'status' => 0
        ];
        $res = CommentModel::where('com_id',$id)->update($update);
        if($res){
            return $this->success('删除成功','index');
        }
        return $this->error('删除失败');
    }

    public function show()
    {
        $id = input('com_id');
        $show = input('val');
        $res = CommentModel::where('com_id',$id)->setField('is_show',$show);
        if($res){
            return $this->success('设置成功');
        }
        return $this->error('设置失败');
    }
}