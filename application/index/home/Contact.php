<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Article as ArticleModel;

// use phpqrcode\QRcode;
// include EXTEND_PATH.'phpqrcode/phpqrcode.php';

class Contact extends Base
{
    public function index()
    {
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
    	/**
    	 * 生成二维码
         * png($text, $outfile = false, $level = QR_ECLEVEL_L, $size = 3, $margin = 4, $saveandprint=false)
         * $text 二维码内容 ，$ounfile 是否输出文件默认否如果是则写文件地址
         * $level 容错级别 ，$size 生成图片大小
         * $margin 图片的margin ，$saveandprint是否直接输出
         */
    	// $code = substr(md5(substr(uniqid(),-6)),6).substr(uniqid(),-6);
     //    $text = 'http://www.mylucas.com.cn/index/Contact/info';   //二维码内容
     //    $level = 'L';    //容错级别
     //    $size = 10;           //生成图片大小
     //    $url = '/upload/qrcode/'.$code.'.png';
     //    $outfile = $_SERVER['DOCUMENT_ROOT'].$url;
     //    $qrcode = new QRcode;
     //    $qrcode::png($text,$outfile,$level,$size,0);
   		// $this->assign('qrcode_url',$url);
        if(SITE_TEMPLATE == 'lost_time'){
            $articleWhere = [
                ['cate_id','eq',105],
                ['is_show','eq',1],
                ['status','eq',1]
            ];
            $articles = ArticleModel::where($articleWhere)->field('thumb,article_id,cate_id,article_title,article_type,article_desc,ctime,author,article_long_title')->order('sort_order asc')->select();
            $this->assign('articles',$articles);
        } 
        $this->assign('http_type',$http_type);
        return $this->fetch();
    }

    public function info()
    {
        return $this->fetch();
    }

    public function pay()
    {
        halt('给博主打赏的二维码跳转页面，制作中……');
        return $this->fetch();
    }
}