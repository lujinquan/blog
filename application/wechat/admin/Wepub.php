<?php

namespace app\wechat\admin;
use app\system\admin\Admin;
include_once EXTEND_PATH."wechat/include.php";

class Wepub extends Admin
{
	private $config;
	/**
     * 初始化方法
     */
    protected function initialize()
    {
        parent::initialize();
        // 公众号配置参数
        $this->config = [
        	// 令牌
		    'token'          => 'lucas',
		    // 公众号AppID
		    'appid'          => 'wxbe2e4c11d21f77db',
		    // 公众号AppSecret
		    'appsecret'      => 'd6e461a9d6b6fe5b9043230871867f4c',
		    // 公众号消息加解密密钥
		    'encodingaeskey' => 'VSFry92ZK486pfvv9lsITw1FpXjkBOGOXjeILzRnyFo',
		    // 配置商户支付参数
		    'mch_id'         => "1332187001",
		    'mch_key'        => 'A82DC5BD1F3359081049C568D8502BC5',
		    // 配置商户支付双向证书目录 （p12 | key,cert 二选一，两者都配置时p12优先）
		    'ssl_p12'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_cert.p12',
		    // 'ssl_key'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_key.pem',
		    // 'ssl_cer'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_cert.pem',
		    // 配置缓存目录，需要拥有写权限
		    'cache_path'     => '',
		];
    }

    public function index()
    {
    	return $this->fetch();
    }

    /**
   	 * 功能描述：获取公众号access_token(注意访问的ip需在公众号ip白名单中)
   	 * @author  Lucas 
   	 * 创建时间:  2020-03-09 11:53:58
   	 */
	public function get_access_token(){
		try {
		    // 创建接口实例
		    $wechat = \WeChat\Contracts\BasicWeChat::instance($this->config);
		    // 获取用户列表
		    $result = $wechat->getAccessToken();
		    echo '<pre>';
		    var_export($result);
		} catch (Exception $e) {
		    // 出错啦，处理下吧
		    echo $e->getMessage() . PHP_EOL;
		}
	}

   	/**
   	 * 功能描述：获取公众号用户（注意检查是否有接口权限）
   	 * @author  Lucas 
   	 * 文档：https://mp.weixin.qq.com/advanced/advanced?action=table&token=49663436&lang=zh_CN
   	 * 创建时间:  2020-03-09 11:53:58
   	 */
	public function user_get(){
		try {
		    // 创建接口实例
		    // $wechat = \We::WeChatUser($config);
		    // $wechat = new \WeChat\User($config);
		    $wechat = \WeChat\User::instance($this->config);
		    // 获取用户列表
		    $result = $wechat->getUserList();
		    echo '<pre>';
		    var_export($result);
		    // 批量获取用户资料
		    foreach (array_chunk($result['data']['openid'], 100) as $item) {
		        $userList = $wechat->getBatchUserInfo($item);
		        var_export($userList);
		    }
		} catch (Exception $e) {
		    // 出错啦，处理下吧
		    echo $e->getMessage() . PHP_EOL;
		}
	}






}