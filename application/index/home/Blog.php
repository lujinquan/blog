<?php

namespace app\index\home;
use app\common\controller\Common;

class Blog extends Common
{
    public function index()
    {
        return $this->fetch();
    }
}