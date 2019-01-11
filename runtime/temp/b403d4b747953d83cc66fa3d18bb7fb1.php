<?php /*a:2:{s:63:"D:\phpStudy\WWW\blog\application\system\view\publics\index.html";i:1546829020;s:61:"D:\phpStudy\WWW\blog\application\system\view\block\layui.html";i:1546829020;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title>后台管理登录 -  Powered by <?php echo config('hisiphp.name'); ?></title>
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link rel="stylesheet" href="/static/js/layui/css/layui.css">
    <style type="text/css">
        body{background-color:#f5f5f5;}
        .login-head{position:fixed;left:0;top:0;width:80%;height:60px;line-height:60px;background:#000;padding:0 10%;}
        .login-head h1{color:#fff;font-size:20px;font-weight:600}
        .login-box{margin:240px auto 0;width:400px;background-color:#fff;padding:15px 30px;border-radius:10px;box-shadow: 5px 5px 15px #999;}
        .login-box .layui-input{font-size:15px;font-weight:400}
        .login-box input[name="password"]{letter-spacing:5px;font-weight:800}
        .login-box .layui-btn{width:100%;}
        .login-box .copyright{text-align:center;height:50px;line-height:50px;font-size:12px;color:#ccc}
        .login-box .copyright a{color:#ccc;}
    </style>
</head>
<body>
<div class="login-head">
    <h1><?php echo config('base.site_name'); ?></h1>
</div>
<div class="login-box">
    <form action="<?php echo url(); ?>" method="post" class="layui-form layui-form-pane">
        <fieldset class="layui-elem-field layui-field-title">
            <legend>管理后台登录</legend>
        </fieldset>
        <div class="layui-form-item">
            <label class="layui-form-label">登录账号</label>
            <div class="layui-input-block">
                <input type="text" name="username" class="layui-input" lay-verify="required" placeholder="请输入登录账号" autofocus="autofocus" value="">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">登录密码</label>
            <div class="layui-input-block">
                <input type="password" name="password" class="layui-input" lay-verify="required" placeholder="******" value="">
            </div>
        </div>
        <?php echo token(); ?>
        <input type="submit" value="登录" lay-submit="" lay-filter="formLogin" class="layui-btn">
    </form>
    <div class="copyright">
        © 2018-2020 <a href="<?php echo config('hisiphp.url'); ?>" target="_blank"><?php echo config('hisiphp.copyright'); ?></a> All Rights Reserved.
    </div>
</div>
<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script type="text/javascript">
layui.use(['form', 'layer', 'jquery', 'md5'], function() {
    var $ = layui.jquery, layer = layui.layer, form = layui.form, md5 = layui.md5;
    form.on('submit(formLogin)', function(data) {
        var that = $(this), _form = that.parents('form'),
            account = $('input[name="username"]').val(),
            pwd = $('input[name="password"]').val(),
            token = $('input[name="__token__"]').val();

        layer.msg('数据提交中...',{time:500000});
        that.prop('disabled', true);
        
        $.ajax({
            type: "POST",
            url: _form.attr('action'),
            data: {username: account, password: md5.exec(pwd), '__token__' : token},
            success: function(res) {
                if (typeof(res.data.token) != 'undefined') {
                    $('input[name="__token__"]').val(res.data.token);
                }
                layer.msg(res.msg, {}, function() {
                    if (res.code == 1) {
                        location.href = res.url;
                    } else {
                        that.prop('disabled', false);
                    }
                });

            }
        });
        return false;
    });
});
</script>
</body>
</html>