<?php
// +----------------------------------------------------------------------
// | Thinkphp框架[基于ThinkPHP5.1开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2018-2022 http://www.mylucas.com.cn
// +----------------------------------------------------------------------
// | ThinkPHP框架永久免费开源
// +----------------------------------------------------------------------
// | Author: Lucas <598936602@qq.com>
// +----------------------------------------------------------------------

// 为方便系统升级，二次开发中用到的公共函数请写在此文件，禁止修改common.php文件
// ===== 系统升级时此文件永远不会被覆盖 =====
// 应用公共文件
function tree($data,$pid=0,$level=0){
    //定义一个静态数组型变量
    static $tree = array();
    //遍历 $data
    foreach($data as $row){
        //获取pid=$pid的元素
        if($row['pid'] == $pid){
            $row['level'] = $level;
            //存储当前数据
            $tree[]=$row;
            //实现递归操作
            tree($data,$row['id'],$level+1);
        }
    }
    //返回遍历好的数据
    return $tree;
}

if (!function_exists('convertUTF8')) {

    function convertUTF8($str){
        if (empty($str)) {
            return $str;
        }
        $code = mb_detect_encoding($str);     //$code为当前字符的字符编码

        if ($code == 'UFT-8') {
            return $str;
        } else {
            return iconv($code, 'utf-8', $str);
        }
    }

}

if (!function_exists('convertGBK')) {

    function convertGBK($str){
        if (empty($str)) {
            return $str;
        }
        $code = mb_detect_encoding($str);     //$code为当前字符的字符编码

        if ($code == 'GBK') {
            return $str;
        } else {
            return iconv($code, 'GBK', $str);
        }
    }

}