<?php

namespace app\wx\admin;
use think\Controller;
define("TOKEN", "lucas");//自己定义的token 就是个通信的私钥

session_start();
//测试账户的配置，权限更高
define("AppId", "wx106bcee09fcc2b05");//自己定义的token 就是个通信的私钥
define("AppSecret", "cf65f7cb1fd235bd1417abfb4c3d46ff");//自己定义的token 就是个通信的私钥

//斯托曼之路的个人订阅号的配置，权限低
// define("AppId", "wxbe2e4c11d21f77db");//自己定义的token 就是个通信的私钥
// define("AppSecret", "91d24fa8a3f9f77124d11f34f58b2cb6");//自己定义的token 就是个通信的私钥

class Wechatcallbackapitest extends Controller
{
    /**
     * 
     * 微信公众平台 > 基本配置 > 启用配置时需要验证的方法【微信公众平台开发的第一步】
     *
     * 
     */
    public function valid()
    {
        $echoStr = isset($_GET["echostr"])?$_GET['echostr']:''; 

        //第一次接入微信api的时候，微信平台会传递此参数
        if($echoStr){
            if($this->checkSignature()){
               echo $echoStr;
               exit; 
            }
        //用户进入微信会直接调用消息回复功能
        }else{
            $this->responseMsg();
        }
    }




    /**
     * [httpCurl HTTP请求]
     * @param  [type] $url      [description]
     * @param  string $type     [description]
     * @param  string $postData [description]
     * @return [type]           [description]
     */
    public function httpCurl($url, $type='get', $postData='')
    {
        //1.初始化
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//部分链接url要以https协议进行，设定以跳过证书验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($ch,CURLOPT_CAPATH ,dirname(__FILE__)."/");

        // curl_setopt($ch,CURLOPT_CAINFO ,"cacert.pem");
        // curl_setopt($ch, CURLOPT_CAINFO, "./cacert.pem");
        //2.设置curl参数
        curl_setopt($ch, CURLOPT_URL, $url); //要链接的url
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //将curl_exec()获取的信息以字符串返回，而不是直接输出。
        
        if($type == 'post'){
            curl_setopt($ch, CURLOPT_POST, true); //true时发送post请求；
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }
        //3.执行curl请求
        $res = curl_exec($ch); //将返回一个json格式的字符串
        //halt(curl_errno($ch));
        //4.返回结果并关闭curl连接
        if(curl_errno($ch)){
            return curl_error($ch);
        }
        curl_close($ch);
        return $res;
    }

    /**
     *_request():发出请求
     *@curl:访问的URL
     *@https：安全访问协议
     *@method：请求的方式，默认为get
     *@data：post方式请求时上传的数据
     **/
    // private function _request($curl, $method = 'get', $https = true,  $data = null, $headers = [])
    // {
    //     $ch = curl_init(); //初始化
    //     curl_setopt($ch, CURLOPT_CAINFO, "./cacert.pem");
    //     curl_setopt($ch, CURLOPT_URL, $curl); //设置访问的URL
    //     // curl_setopt($ch, CURLOPT_HEADER, false); //设置不需要头信息
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //只获取页面内容，但不输出
    //     if ($https) {
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不做服务器认证
    //         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不做客户端认证
    //     }
    //     if ($method == 'post') {
    //         curl_setopt($ch, CURLOPT_POST, true); //设置请求是POST方式
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //设置POST请求的数据
    //     }
    //     $str = curl_exec($ch); //执行访问，返回结果
    //     curl_close($ch); //关闭curl，释放资源
    //     return $str;
    // }


    /**
     * [getWxAccessToken 获取微信access_token 功能已完成] 
     * @return [type] [description]
     */
    public function getWxAccessToken()
    {
        if(session('access_token')){
            return session('access_token');
        } else {
            $appid = AppId; //填入自己的appid
            $appsecret = AppSecret;
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
            //halt($url);
            $res = $this->httpCurl($url); //调用上面提到的curl方法
            $res = json_decode($res, true);
            $access_token = $res['access_token'];
            session('access_token',$access_token); //将access_token存入缓存，也可用redis、memcache等方式
            
            //halt($res);
            return $access_token;
        }
    }

    /**
     * [getWxServerIp 获取微信服务器的IP地址]
     * @return [type] [description]
     */
    public function getWxServerIp()
    {
        $access_token = $this->getWxAccessToken();
        //halt($access_token);
        $url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token='.$access_token;
        $res = $this->httpCurl($url);
        //halt($res);
        $arr = json_decode($res,true);
        return $arr;
    }

    // /**
    //  * 接受事件推送并回复
    //  * @return [type] [description]
    //  */
    // public function responseMsg()
    // {
    //     // 1、获取到微信推送过来的post数据（xml格式）
    //     $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    //     // 2、处理消息类型，并设置回复类型和内容
    //     if (!empty($postStr)){
    //         $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    //         $fromUsername = $postObj->FromUserName;
    //         $toUsername = $postObj->ToUserName;
    //         $keywords = $postObj->Content;
    //         $time = time();
            
    //         // 回复模板
    //         $textTpl = "<xml>
    //         <ToUserName><![CDATA[%s]]></ToUserName>
    //         <FromUserName><![CDATA[%s]]></FromUserName>
    //         <CreateTime>%s</CreateTime>
    //         <MsgType><![CDATA[%s]]></MsgType>
    //         <Content><![CDATA[%s]]></Content>
    //         </xml>";

    //         // 判断该数据包是否是订阅的事件推送
    //         if(strtolower($postObj->MsgType) == 'event'){
    //             // 如果是关注 subscribe 事件
    //             if(strtolower($postObj->Event == 'subscribe')){
                    
    //                 // 回复用户消息
    //                 $msgType = "text";
    //                 $contentStr = '欢迎关注Lucas的个人公众号 ——斯托曼之路';
    //                 // 通过模板，返回数据
    //                 $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
    //                 echo $resultStr;
    //             }
    //             // 如果是取消关注 unsubscribe 事件
    //             if(strtolower($postObj->Event) == 'unsubscribe'){
    //                 // 回复用户消息
    //                 $msgType = "text";
    //                 $contentStr = '取消成功，期待您的下次关注，我们会努力做得更好！';
    //                 // 通过模板，返回数据
    //                 $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
    //                 echo $resultStr;
    //             }
    //         }

    //         // 判断该数据包是否是消息推送
    //         if(strtolower($postObj->MsgType) == 'text'){
    //             // 如果用户回复公众号“你好”
    //             if($keywords == '你好'){
    //                 // 回复用户消息
    //                 $msgType = "text";
    //                 $contentStr = '你也好！';
    //                 // 通过模板，返回数据
    //                 $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
    //                 echo $resultStr;
    //             }
    //         }
    //     }
    // }

    /**
     * [responseMsg 事件回复及关键字回复]
     * @return [type] [description]
     */
    public function responseMsg()
    {
        // 1.获取微信推过来的post数据（xml格式）
        //$postStr = $GLOBALS["HTTP_RAW_POST_DATA"]; //thinkphp不能这样接收
        $postArr = file_get_contents("php://input");
        // 模板如下：
        // $postArr = "<xml>
        //   <ToUserName><![CDATA[toUser]]></ToUserName>
        //   <FromUserName><![CDATA[fromUser]]></FromUserName>
        //   <CreateTime>1348831860</CreateTime>
        //   <MsgType><![CDATA[text]]></MsgType>
        //   <Content><![CDATA[this is a test]]></Content>
        //   <MsgId>1234567890123456</MsgId>
        // </xml>";
        // 2.根据消息类型进行回复
        if(!empty($postArr)){
            $postObj = simplexml_load_string($postArr,'SimpleXMLElement',LIBXML_NOCDATA); //将xml数据转换为对象
            // 2.1.判断消息类型
            if(strtolower($postObj->MsgType) == 'event'){
                //关注事件，新用户关注后自动回复
                if(strtolower($postObj->Event) == 'subcribe'){
                    $content = '欢迎关注Lucas的公众号，在这里你将得到……'; //自定义回复内容
                    $info = $this->responseText($postObj, $content);
                    echo $info;
                } elseif(strtolower($postObj->Event) == 'click'){
                    //点击菜单事件
                    switch($postObj->EventKey){
                        case 'V1_TEBIE_LANMU': // 特别栏目
                            $content = '这是点击《特别栏目》后，系统推送的消息……'; //自定义回复内容
                            $info = $this->responseText($postObj, $content);
                            echo $info;
                            break;
                        case '': //
                            //也可回复图文消息
                            $arr = array(
                                array(
                                    'title' => '潮图|你的姆爷Slim Shady',
                                    'description' => '高能预警',
                                    'picUrl' => '',
                                    'url' => '',
                                )
                            );
                            $info = $this->responseNews($postObj, $arr);
                            echo $info;
                            break;
                    }
                } elseif(strtolower($postObj->Event) == 'scan') {
                    //扫码事件，用户扫码后会跳转至公众号，可自动回复相关内容
                    switch ($postObj->EventKey){
                        case 2000:
                            $content = "";
                            $info = $this->responseText($postObj, $content);
                            echo $info;
                            break;
                    }
                }
            } 
            //用户输入关键字回复
            if(strtolower($postObj->MsgType) == 'text'){
                $keyword = trim($postObj->Content);
                if(!empty($keyword)) {
                    //返回图文信息
                    // if($keyword == 'slimshady'){
                    //     $arr = array(
                    //         array(
                    //             'title' => '',
                    //             'description' => '',
                    //             'picUrl' => '',
                    //             'url' => '',
                    //         ),                        
                    //     );
                    //     $info = $this->responseNews($postObj, $arr);
                    //     echo $info;
                    // }
                    //返回文本消息
                    switch ($keyword) {
                        case '1':
                            //返回的文本消息也可以是链接形式
                            //$content = "<a href='http://www.mylucas.com.cn'>欢迎访问Lucas的个人网站！</a>";
                            $content = "Lucas —— 4年的phper开发者,详情可以查看我的个人网站https://www.mylucas.com.cn。";
                            break;
                        case '2':
                            $content = "具体可以发送邮件至598936602@qq.com，有意者可私聊^-^";
                            break;
                        default:
                            $content = "对不起，我不能理解您的意思，您可以尝试回复‘1’获取公众号的开发者基本信息，回复‘2’获取最新优惠活动！";
                            break;
                    }
                    $arr = [
                        'Content' => trim($postObj->Content),
                        'ToUserName' => trim($postObj->ToUserName),
                        'FromUserName' => trim($postObj->FromUserName),
                        'MsgType' => trim($postObj->MsgType),
                        'MsgId' => trim($postObj->MsgId),
                    ];
                    //halt($arr);
                    $info = $this->responseText($postObj, $content);
                    echo $info;
                }  else {
                    echo 'Input something...';
                }            
            }       
        }
    }

    //回复文字消息
    public function responseText($postObj, $content)
    {
        $toUser = $postObj->FromUserName; 
        $fromUser = $postObj->ToUserName;
        //$time = $postObj->CreateTime;
        $time = time();
        //返回文字消息的模板
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[%s]]></MsgType>
        <Content><![CDATA[%s]]></Content>
        </xml>";
        $msgType = "text";
        //dump();dump();dump();
        $info = sprintf($textTpl, $toUser,$fromUser, $time ,$msgType,$content);
        return $info;
    }


    /**
     * [defineMenu 自定义菜单 功能已完成]
     * @return [type] [description]
     */
    public function defineMenu()
    {
        $access_token = $this->getWxAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        //菜单内容
        
        /*//第一种方案，定义数组，再json化，会报40033错误，推荐用第二种方案直接定义标准的json数据
        $postArr = array(
            'button' => array( 
                array( //第一个一级菜单
                    'name' => '菜单名',
                    'type' => 'click', //分为click和view两种，click为点击事件，view为跳转到指定url
                    'key'  => 'EventKey' // type为click时为key，可针对传入的eventkey设定回复内容，见下面的事件回复
                ),
                
                array( //第二个一级菜单
                    'name' => '一级菜单',
                    'sub_button' => array(
                        //二级菜单
                        array(
                            'name' => '二级菜单',
                            'type' => 'view',
                            'url'  => 'http://www.mylucas.com.cn' //type为view时key值为url
                        )
                    )
                )
            )
        );
        $postJson = json_encode($postArr); //post数据的格式为json*/

        //第二种方案，定义json数据
        $postJson = '{
             "button":[
             {
                   "name":"分类阅读",
                   "sub_button":[
                   {    
                       "type":"view",
                       "name":"推文精选",
                       "desc":"这是个view例子，点击此菜单会调用获取用户信息的接口",
                       "url":"http://www.mylucas.com.cn/admin.php/wx/Wechatcallbackapitest/getUserInfo"
                    },
                    {
                         "type":"miniprogram",
                         "name":"专属语音",
                         "desc":"这是个miniprogram例子，点击此菜单系统会打开url的小程序",
                         "url":"http://mp.weixin.qq.com",
                         "appid":"wx286b93c14bbf93aa",
                         "pagepath":"pages/lunar/index"
                     },
                    {
                       "type":"click",
                       "name":"特别栏目",
                       "desc":"这是个click例子，点击此菜单系统会根据key值回复一个消息",
                       "key":"V1_TEBIE_LANMU"
                    },
                    {
                       "type":"click",
                       "name":"最新发布",
                       "key":"V1_ZUIXIN_FABU"
                    },
                    {
                       "type":"click",
                       "name":"历史搜索",
                       "key":"V1_LISHI_SOUSUO"
                    }]
               },
              {    
                  "type":"click",
                  "name":"官网",
                  "key":"V2_GUAN_WANG"
              },
              {
                   "name":"商务合作",
                   "sub_button":[
                   {    
                       "type":"view",
                       "name":"转载须知",
                       "url":"http://www.soso.com/"
                    },
                    {
                         "type":"miniprogram",
                         "name":"联系我们",
                         "url":"http://mp.weixin.qq.com",
                         "appid":"wx286b93c14bbf93aa",
                         "pagepath":"pages/lunar/index"
                     },
                    {
                       "type":"click",
                       "name":"在线客服",
                       "key":"V1001_GOOD"
                    }]
               }]
         }';
        $res = $this->httpCurl($url, 'post', $postJson); //成功返回 "{"errcode":0,"errmsg":"ok"}"
    }

    //获取网页授权以及用户的基本信息
    public function getBaseInfo()
    {
        $appId = AppId; //上文提及的公众号自己的appid
        //$redirectUri = urlencode('调用getUserOpenId的uri');
        $redirectUri = urlencode('http://www.mylucas.com.cn/admin.php/wx/Wechatcallbackapitest/getUserOpenId');
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appId.'&redirect_uri='.$redirectUri.'&response_type=code&scope=snsapi_base&state=123#wechat_redirect';
        header('location:'.$url); //此步仅做演示，实际业务中引导用户访问调用此方法的链接来跳转至redirectUrl
    }

    //获取网页授权以及用户的基本信息
    public function getUserOpenId()
    {
        $appId = AppId;
        $appSecret = AppSecret;
        $code = $_GET['code']; //getBaseInfo 方法传来的code
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appId.'&secret='.$appSecret.'&code='.$code.'&grant_type=authorization_code';
        $res = $this->httpCurl($url);
        //halt($res);
        //返回值的格式：{ "access_token":"ACCESS_TOKEN", "expires_in":7200, "refresh_token":"REFRESH_TOKEN", "openid":"OPENID", "scope":"SCOPE" } 
    }

    /**
     * 获取用户的基本信息
     */
    public function getUserBaseInfo()
    {
        //第一步，先获取openid和网页授权access_token
        $appId = AppId;
        $appSecret = AppSecret;
        //$code = $_GET['code']; //getBaseInfo 方法传来的code
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appId.'&secret='.$appSecret.'&code='.$code.'&grant_type=authorization_code';
        $res = $this->httpCurl($url);
        //返回值的格式：{ "access_token":"ACCESS_TOKEN", "expires_in":7200, "refresh_token":"REFRESH_TOKEN", "openid":"OPENID", "scope":"SCOPE" }
        $res = json_decode($res, true);
        $access_token = $res['access_token'];
        $openid = $res['openid'];

        //第二步，获取用户的详细信息
        $url = ' https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $arr = $this->httpCurl($url);
    }

    //获取网页授权以及用户的基本信息
    public function getUserInfo()
    {
        //第一步，先获取openid和网页授权access_token
        $appId = AppId;
        $appSecret = AppSecret;
        //$code = $_GET['code']; //getBaseInfo 方法传来的code
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appId.'&secret='.$appSecret.'&code='.$code.'&grant_type=authorization_code';
        $res = $this->httpCurl($url);
        //返回值的格式：{ "access_token":"ACCESS_TOKEN", "expires_in":7200, "refresh_token":"REFRESH_TOKEN", "openid":"OPENID", "scope":"SCOPE" }
        $res = json_decode($res, true);
        $access_token = $res['access_token'];
        $openid = $res['openid'];

        //第二步，获取用户的详细信息
        $url = ' https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';
        $arr = $this->httpCurl($url);
    }


    /**
     * [checkSignature 验证服务器是否与微信平台互通]
     * @return [type] [description]
     */
    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr,SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }

}