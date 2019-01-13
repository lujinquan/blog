<?php

namespace app\index\home;
use app\index\home\Base;

class Index extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}