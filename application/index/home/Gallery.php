<?php

namespace app\index\home;
use app\index\home\Base;

class Gallery extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}