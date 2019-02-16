<?php

namespace app\index\home;

use app\index\home\Base;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;

class Gallery extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}