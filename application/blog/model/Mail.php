<?php
namespace app\blog\model;

use think\Model;
use phpmailer\src\PHPMailer;

class Mail extends Model
{
	    // 设置模型名称
    protected $name = 'mail';
    // 设置主键
    protected $pk = 'id';
    // 定义时间戳字段名
    protected $createTime = 'ctime';
    protected $updateTime = 'dtime';
    // 自动写入时间戳
    protected $autoWriteTimestamp = true;

    protected $type = [
        'ctime' => 'timestamp:Y-m-d H:i:s',
    ];

    public function sendMail($mailInfo){

        //TP5.1引入第三方类库方法
        //1、use phpmailer\src\PHPMailer; new PHPMailer();
        //2、new \phpmailer\src\PHPMailer();

        $mail = new PHPMailer();
        //告诉PHPMailer使用SMTP
        // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        $mail->SMTPDebug = 1;
        // 使用smtp鉴权方式发送邮件
        $mail->isSMTP();
        // smtp需要鉴权 这个必须是true
        $mail->SMTPAuth = true;
        // 链接qq域名邮箱的服务器地址
        $mail->Host = 'smtp.163.com';
        // 设置使用ssl加密方式登录鉴权
        $mail->SMTPSecure = 'ssl';
        // 设置ssl连接smtp服务器的远程服务器端口号465/994
        $mail->Port = 994;
        // 设置发送的邮件的编码
        $mail->CharSet = 'UTF-8';
        // 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->FromName = '发件人昵称';
        // smtp登录的账号 QQ邮箱即可
        $mail->Username = $mailInfo['send_mail'];  //'18674012767@163.com'
        // smtp登录的密码 使用生成的授权码
        $mail->Password = '15X9JRXeEaPDeiT';
        // 设置发件人邮箱地址 同登录账号
        $mail->From = $mailInfo['send_mail'];
        // 邮件正文是否为html编码 注意此处是一个方法
        $mail->isHTML(true);
        // 设置收件人邮箱地址
        $mail->addAddress($mailInfo['accept_mail']);
        // 添加多个收件人 则多次调用方法即可
        //$mail->addAddress('598936602@qq.com');
        // 添加该邮件的主题
        $mail->Subject = $mailInfo['title'];
        // 添加邮件正文
        $mail->Body = $mailInfo['content'];
        // 为该邮件添加附件
        //$mail->addAttachment('./demo.jpg');
        // 发送邮件 返回状态
        if(!$mail->send()){// 发送邮件
            return $mail->ErrorInfo;
        }else{
            return true;
        }

    }
}