<?php

namespace app\index\home;
use app\common\controller\Common;

class Singlepage extends Common
{
    public function index()
    {
        return $this->fetch();
    }
}