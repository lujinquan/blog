<?php

namespace app\index\home;
use app\index\home\Base;

class Singlepage extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}