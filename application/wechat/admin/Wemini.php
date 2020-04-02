<?php

namespace app\wechat\admin;

use app\system\admin\Admin;
include_once EXTEND_PATH."wechat/include.php";

class Wemini extends Admin
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
		    // 'appid'     => 'wx6bb7b70258da09c6',
		    // 'appsecret' => '78b7b8d65bd67b078babf951d4342b42',
		    'appid'     => 'wxaac82b178a3ef1d2',
		    'appsecret' => '2035d07676392ac121549f66384b04e4',
		];
    }

	public function index(){	
		return $this->fetch();
	}

   	/**
   	 * 功能描述：检验数据的真实性，并且获取解密后的明文
   	 * @author  Lucas 
   	 * 创建时间:  2020-03-09 11:53:58
   	 */
	public function mini_login(){
		// 解码数据
		$iv = 'ltM/wT7hsAl0TijEBI4v/g==';
		$code = '013LyiTR0TwjC92QjJRR0mEsTR0LyiT3';
		$decode = 'eIoVtIC2YzLCnrwiIs1IBbXMvC0vyL8bo1IhD38fUQIRbk3lgTWa0Hdw/Ty7NTs3iu7YlqqZBti+cxd6dCfeXBUQwTO2QpbHg0WTeDAdrihsHRHm4dCWdfTx8rzDloGbNOIsKdRElIhUH5YFdiTr5AYiufUDb34cwJ4GNWLAUq4bR0dmFeVEi+3nfwe2MAjGYDl4aq719VLsHodOggK6lXZvM5wjoDyuZsK2dPqJr3/Ji30Z0mdyFq32R4uR3rtJH/h+Rj0+/QmE9QYG7Y6Z48hgPE8cpnhRQNwH49jnC/zKZ9wtDkQ/J8J3Ed2i58zcuY01v8IV+pZ8oBUKXfO5ha+APOxtBSTzyHraU/2RGo8UWtOF6h64OQZhd/UQQy362eyc/qoq8sF9JnEFRP0mRmTDJ+u9oyDhxswCu6x8V73ERWaJeEGSCyjiGpep7/DxZ6eSSBq36OB0BWBkJqsq9Q==';
		$sessionKey = 'OetNxl86B/yMpbwG6wtMEw==';
		$mini = \WeMini\Crypt::instance($this->config);
		echo '<pre>';
		print_r($mini->decode($iv, $sessionKey, $decode));
	}

	/**
   	 * 功能描述：获取小程序二维码(提示：注意关闭debug)
   	 * @author  Lucas 
   	 * 创建时间:  2020-03-09 11:53:58
   	 */
	public function mini_qrc(){
		$mini = \WeMini\Qrcode::instance($this->config);
		try {
		    header('Content-type:image/jpeg'); //输出的类型
		//    echo $mini->createDefault('pages/index?query=1');
		//    echo $mini->createMiniScene('432432', 'pages/index/index');
		    echo $mini->createMiniPath('pages/index?query=1');
		} catch (Exception $e) {
		    var_dump($e->getMessage());
		}
	}

	/**
   	 * 功能描述：获取小程序模板库标题列表
   	 * @author  Lucas 
   	 * 创建时间:  2020-03-09 14:21:15
   	 */
	public function mini_template_library_list(){
		$mini = \WeMini\Template::instance($this->config);
		try {
		    echo '<pre>';
		    print_r($mini->getTemplateLibraryList());
		} catch (Exception $e) {
		    var_dump($e->getMessage());
		}
	}

	/**
   	 * 功能描述：获取小程序模板库标题列表
   	 * @author  Lucas 
   	 * 创建时间:  2020-03-09 14:21:15
   	 */
	public function mini_template_library(){
		$mini = \WeMini\Template::instance($this->config);
		try {
			$template_id = 'AT0003';
		    echo '<pre>';
		    print_r($mini->getTemplateLibrary($template_id));
		} catch (Exception $e) {
		    var_dump($e->getMessage());
		}
	}

	/**
   	 * 功能描述：帐号下已存在的模板列表
   	 * @author  Lucas 
   	 * 创建时间:  2020-03-09 14:21:15
   	 */
	public function mini_template_list(){
		$mini = \WeMini\Template::instance($this->config);
		try {
		    echo '<pre>';
		    print_r($mini->getTemplateList());
		} catch (Exception $e) {
		    var_dump($e->getMessage());
		}
	}


}