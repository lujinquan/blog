<?php

namespace app\index\home;
use app\index\home\Base;

class Tour extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}