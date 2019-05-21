<?php

namespace app\wx\admin;

include_once EXTEND_PATH."wxpub/wxBizMsgCrypt.php";

class Api
{
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
}