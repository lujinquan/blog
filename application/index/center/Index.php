<?php

namespace app\index\center;

use app\common\controller\Common;

class Index extends Common
{
    public function index()
    {
    	return $this->fetch('index@center/login');
    }
}