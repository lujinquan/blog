<?php
namespace app\blog\admin;
use app\system\admin\Admin;

class Article extends Admin
{
    public function index()
    {
        return $this->fetch();
    }

    public function add()
    {
        return $this->fetch();
    }

    public function edit()
    {
        return $this->fetch();
    }

    public function detail()
    {
        return $this->fetch();
    }

    public function del()
    {
        return $this->fetch();
    }
}