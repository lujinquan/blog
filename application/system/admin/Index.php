<?php
// +----------------------------------------------------------------------
// | Thinkphp框架[基于ThinkPHP5.1开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2018-2022 http://www.mylucas.com.cn
// +----------------------------------------------------------------------
// | ThinkPHP框架永久免费开源
// +----------------------------------------------------------------------
// | Author: Lucas <598936602@qq.com>
// +----------------------------------------------------------------------

namespace app\system\admin;

use Env;
use hisi\Dir;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;
/**
 * 后台默认首页控制器
 * @package app\system\admin
 */

class Index extends Admin
{
    /**
     * 首页
     * @author Lucas <598936602@qq.com>
     * @return mixed
     */
    public function index()
    {
        if (cookie('hisi_iframe')) {
            $this->view->engine->layout(false);
            return $this->fetch('iframe');
        } else {
            $where = [
            ['status','eq',1],
            ['is_show','eq',1]
        ];

        // 获取折线图数据【以时间为横坐标，以发布数量】
        $articleTimes = ArticleModel::where($where)->column('from_unixtime(ctime, \'%Y-%m-%d\') as ctimes');
        $arr = [];
        foreach($articleTimes as $at){
            if(isset($arr[$at])){
                $arr[$at]++;
            }else{
                $arr[$at] = 0;
            }
        }
        $datestr =$this->prDates('2019-01-01',date('Y-m-d'));
        $d=substr($datestr,0,-1);
        $array=explode(',',$d);
        $articlesTimeKeys = json_encode($array);
        $result = [];
        foreach($array as $a){
            if(!isset($arr[$a])){
                $result[$a] = 0;
            }else{
                $result[$a] = $arr[$a];
            }
        }
        $articlesTimeVals = json_encode(array_values($result));


        // 获取柱状图和饼状图数据【栏目类别+文章数量】
        $data = ArticleModel::with('cate')->where($where)->field('count(article_id) as article_ids,cate_id')->group('cate_id')->select()->toArray();
        $articles = json_encode($data);
        $cates = [];
        foreach ($data as $d) {
            $cates[] = $d['cate_name'];
        }
        //halt($cates);
        $this->assign('cates',$cates);
        $this->assign('articles',$articles);
        $this->assign('articlesTimeKeys',$articlesTimeKeys);
        $this->assign('articlesTimeVals',$articlesTimeVals);
            return $this->fetch();
        }
    }

    public function prDates($start,$end){//获取两个日期之间的所有日期 2016-04-02至2016-04-16  
        $dt_start = strtotime($start);
        $dt_end = strtotime($end);
        $value = '';
        while ($dt_start<=$dt_end){
            $value.= date('Y-m-d',$dt_start).",";
            $dt_start = strtotime('+1 day',$dt_start);
        }
        return $value;
    }

    /**
     * 欢迎首页
     * @author Lucas <598936602@qq.com>
     * @return mixed
     */
    public function welcome()
    {

        return $this->fetch('index');
    }

    /**
     * 清理缓存
     * @author Lucas <598936602@qq.com>
     * @return mixed
     */
    public function clear()
    {
        if (Dir::delDir(Env::get('runtime_path')) === false) {
            return $this->error('缓存清理失败');
        }
        return $this->success('缓存清理成功');
    }
}
