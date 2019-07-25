<?php

namespace app\wx\admin;

use think\Controller;
include_once EXTEND_PATH."wxpub/wxBizMsgCrypt.php";

class Api extends Controller
{
	public function checkSignature()
	{
		$toUser = 'a'; 
        $fromUser = 'b';
        $time = time();
        //返回文字消息的模板
        $textTpl = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Content><![CDATA[%s]]></Content><MsgId>1234567890123456</MsgId></xml>";
        $msgType = "text";
        $content = 'ok';
        //dump();dump();dump();
        $info = sprintf($textTpl, $toUser,$fromUser, $time ,$msgType,$content);
        halt($info);
	}
}