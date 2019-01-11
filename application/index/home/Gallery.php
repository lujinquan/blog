<?php

namespace app\index\home;
use app\common\controller\Common;

class Gallery extends Common
{
    public function index()
    {
        return $this->fetch();
    }
}