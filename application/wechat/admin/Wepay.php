<?php

namespace app\wechat\admin;

use app\system\admin\Admin;
include_once EXTEND_PATH."wechat/include.php";

class Wepay extends Admin
{
	private $config;
	/**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        $this->config = [
        	//调用mini_login方法的时候，用下面的配置
		    // 'appid'     => 'wx2cb8b9b001e3b37b',
		    // 'appsecret' => '7813490da6f1265e4901ffb80afaa36f',
		    // 令牌
		    'token'          => 'lucas',
		    // 支付AppID
		    'appid'          => 'wx2cb8b9b001e3b37b', //公房管理小程序
		    // 公众号AppSecret
		    'appsecret'      => '7813490da6f1265e4901ffb80afaa36f',
		    // 公众号消息加解密密钥
		    'encodingaeskey' => 'VSFry92ZK486pfvv9lsITw1FpXjkBOGOXjeILzRnyFo',
		    // 配置商户支付参数
		    'mch_id'         => "1244050802",
		    'mch_key'        => 'odlkcxyjx425IMKILAXS84LOKHKglhhh',
		    // 配置商户支付双向证书目录 （p12 | key,cert 二选一，两者都配置时p12优先）
		    'ssl_p12'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_cert.p12',
		    // 'ssl_key'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_key.pem',
		    // 'ssl_cer'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_cert.pem',
		    // 配置缓存目录，需要拥有写权限
		    'cache_path'     => '',
		];
    }

	public function index(){	
		return $this->fetch();
	}

   	/**
   	 * 功能描述：统一下单
   	 * @author  Lucas 
   	 * 创建时间:  2020-03-09 14:54:52
   	 */
	public function wepay_create(){
		try {
		    $wechat = \WeChat\Pay::instance($this->config);
		    // 组装参数，可以参考官方商户文档
		    $options = [
		        'body'             => '测试商品',
		        'out_trade_no'     => time(),
		        'total_fee'        => '1',
		        'openid'           => 'o38gpszoJoC9oJYz3UHHf6bEp0Lo',
		        'trade_type'       => 'JSAPI',
		        'notify_url'       => 'http://a.com/text.html',
		        'spbill_create_ip' => '127.0.0.1',
		    ];
		    // 生成预支付码
		    $result = $wechat->createOrder($options);
		    // 创建JSAPI参数签名
		    $options = $wechat->createParamsForJsApi($result['prepay_id']);

		    echo '<pre>';
		    echo "\n--- 创建预支付码 ---\n";
		    var_export($result);

		    echo "\n\n--- JSAPI 及 H5 参数 ---\n";
		    var_export($options);

		} catch (Exception $e) {

		    // 出错啦，处理下吧
		    echo $e->getMessage() . PHP_EOL;

		}
	}

	

}