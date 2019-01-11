<?php

namespace app\index\home;
use app\common\controller\Common;

class Contact extends Common
{
    public function index()
    {
        return $this->fetch();
    }
}