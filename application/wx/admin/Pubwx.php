<?php

namespace app\wx\admin;
use app\system\admin\Admin;

class Pubwx extends Admin
{
    public function index()
    {
    	return $this->fetch();
    }
}