<?php

namespace app\wechat\admin;

use app\system\admin\Admin;
include_once EXTEND_PATH."wxpub/wxBizMsgCrypt.php";
include_once EXTEND_PATH."wechat/include.php";

class Index extends Admin
{
    protected $hisiModel = '';//模型名称[通用添加、修改专用]
    protected $hisiTable = '';//表名称[通用添加、修改专用]
    protected $hisiAddScene = '';//添加数据验证场景名
    protected $hisiEditScene = '';//更新数据验证场景名

    public function index()
    {
        return $this->fetch();
    }

    public function checkSignature()
	{
		$signature = $_GET["signature"];
		$times = $_GET["timestamp"];
		$nonce = $_GET["nonce"];

		$tmpArr = array($timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if($signature){
			return true;
		}else{
			return false;
		}
	}

    public function testapi()
    {
    	// 第三方发送消息给公众平台
		$encodingAesKey = "FyQ5QGIsiSxfR2cwx9jrqejiolEgPngAw9fALI8Z9FH";
		$token = "weixin";
		$timeStamp = "1409304348";
		$nonce = "xxxxxx";
		$appId = "wxbe2e4c11d21f77db";
		$text = "<xml><ToUserName><![CDATA[oia2Tj我是中文jewbmiOUlr6X-1crbLOvLw]]></ToUserName><FromUserName><![CDATA[gh_7f083739789a]]></FromUserName><CreateTime>1407743423</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA[eYJ1MbwPRJtOvIEabaxHs7TX2D-HV71s79GUxqdUkjm6Gs2Ed1KF3ulAOA9H1xG0]]></MediaId><Title><![CDATA[testCallBackReplyVideo]]></Title><Description><![CDATA[testCallBackReplyVideo]]></Description></Video></xml>";


		$pc = new \WXBizMsgCrypt($token, $encodingAesKey, $appId);
		$encryptMsg = '';
		$errCode = $pc->encryptMsg($text, $timeStamp, $nonce, $encryptMsg);
		if ($errCode == 0) {
			print("加密后: " . $encryptMsg . "\n");
		} else {
			print($errCode . "\n");
		}

		$xml_tree = new \DOMDocument();
		$xml_tree->loadXML($encryptMsg);
		$array_e = $xml_tree->getElementsByTagName('Encrypt');
		$array_s = $xml_tree->getElementsByTagName('MsgSignature');
		$encrypt = $array_e->item(0)->nodeValue;
		$msg_sign = $array_s->item(0)->nodeValue;

		$format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
		$from_xml = sprintf($format, $encrypt);

		// 第三方收到公众号平台发送的消息
		$msg = '';
		$errCode = $pc->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $msg);
		if ($errCode == 0) {
			print("解密后: " . $msg . "\n");
		} else {
			print($errCode . "\n");
		}
    }
}