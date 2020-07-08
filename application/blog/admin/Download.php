<?php

namespace app\blog\admin;

use hisi\Dir;
use hisi\PclZip;
use app\system\admin\Admin;
use app\blog\model\Cate as CateModel;
use app\blog\model\Article as ArticleModel;

class Download extends Admin
{
    public function index()
    {
    	if ($this->request->isAjax()) {
            $page = input('param.page/d', 1);
            $limit = input('param.limit/d', 10);
            $path_base_dir = ROOT_PATH.'public/download/md/';
	    	$files = Dir::getList($path_base_dir);

	    	$temps = array_slice($files, ($page- 1) * $limit, $limit);

	    	$data = $result = [];
	    	foreach ($temps as $k => $f) {
	    		$file = $path_base_dir.$f;

	    		$data[$k]['file_base_dir'] = '/download/md/';
	    		$data[$k]['file_name'] = iconv("GBK","UTF-8",$f);
	    		$data[$k]['file_size'] = filesize($file);
	    		$data[$k]['file_type'] = filetype($file);
	    		$data[$k]['file_mtime'] = date('Y-m-d H:i:s',filemtime($file));
	    		$data[$k]['file_atime'] = date('Y-m-d H:i:s',fileatime($file));
	    		$data[$k]['file_ctime'] = date('Y-m-d H:i:s',filectime($file));

	    	}
	    	$result['data'] = $data;
	        $result['count'] = count($files);
	        $result['code'] = 0;
	        $result['msg'] = '';
	        return json($result);
        }
    
        return $this->fetch();
    }

    public function add()
    {
        if ($this->request->isPost()) {

        } 
        return $this->fetch('form');
    }
}