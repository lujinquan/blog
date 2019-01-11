<?php /*a:7:{s:63:"D:\phpStudy\WWW\blog\application\system\view\upgrade\index.html";i:1546829020;s:56:"D:\phpStudy\WWW\blog\application\system\view\layout.html";i:1546829020;s:62:"D:\phpStudy\WWW\blog\application\system\view\block\header.html";i:1546829020;s:60:"D:\phpStudy\WWW\blog\application\system\view\block\menu.html";i:1546829020;s:61:"D:\phpStudy\WWW\blog\application\system\view\block\layui.html";i:1546829020;s:66:"D:\phpStudy\WWW\blog\application\system\view\block\bind_cloud.html";i:1546829020;s:62:"D:\phpStudy\WWW\blog\application\system\view\block\footer.html";i:1546829020;}*/ ?>
<?php if(input('param.hisi_iframe') || cookie('hisi_iframe')): ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlentities($hisiCurMenu['title']); ?> -  Powered by <?php echo config('hisiphp.name'); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" href="/static/js/layui/css/layui.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/system/css/theme.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/system/css/style.css?v=<?php echo config('hisiphp.version'); ?>" media="all">
    <link rel="stylesheet" href="/static/fonts/typicons/min.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/fonts/font-awesome/min.css?v=<?php echo config('hisiphp.version'); ?>">
</head>
<body class="hisi-theme-<?php echo cookie('hisi_admin_theme'); ?>">
<?php else: ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php if($hisiCurMenu['url'] == 'system/index/index'): ?>管理控制台<?php else: ?><?php echo htmlentities($hisiCurMenu['title']); ?><?php endif; ?> -  Powered by <?php echo config('hisiphp.name'); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="stylesheet" href="/static/js/layui/css/layui.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/system/css/theme.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/system/css/style.css?v=<?php echo config('hisiphp.version'); ?>" media="all">
    <link rel="stylesheet" href="/static/fonts/typicons/min.css?v=<?php echo config('hisiphp.version'); ?>">
    <link rel="stylesheet" href="/static/fonts/font-awesome/min.css?v=<?php echo config('hisiphp.version'); ?>">
</head>
<body class="layui-layout-body hisi-theme-<?php echo cookie('hisi_admin_theme'); ?>">
<?php 
$ca = strtolower(request()->controller().'/'.request()->action());
 ?>
<div class="layui-layout layui-layout-admin">
    <div class="layui-header" style="z-index:999!important;">
    <div class="fl header-logo">后台管理中心</div>
    <div class="fl header-fold"><a href="javascript:;" title="打开/关闭左侧导航" class="aicon ai-shouqicaidan" id="foldSwitch"></a></div>
    <ul class="layui-nav fl nobg main-nav">
        <?php if(is_array($hisiMenus) || $hisiMenus instanceof \think\Collection || $hisiMenus instanceof \think\Paginator): $i = 0; $__LIST__ = $hisiMenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if(($hisiCurParents['pid'] == $vo['id'] and $ca != 'plugins/run') or ($ca == 'plugins/run' and $vo['id'] == 3)): ?>
           <li class="layui-nav-item layui-this">
            <?php else: ?>
            <li class="layui-nav-item">
            <?php endif; ?> 
            <a href="javascript:;"><?php echo htmlentities($vo['title']); ?></a></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <ul class="layui-nav fr nobg head-info">
        <li class="layui-nav-item">
            <a href="/" target="_blank" class="aicon ai-ai-home" title="前台"></a>
        </li>
        <li class="layui-nav-item">
            <a href="<?php echo url('system/index/clear'); ?>" class="j-ajax aicon ai-qingchu" refresh="yes" title="清缓存"></a>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:void(0);" class="aicon ai-suo" id="lockScreen" title="锁屏"></a>
        </li>
        <li class="layui-nav-item">
            <a href="<?php echo url('system/user/setTheme'); ?>" id="admin-theme-setting" class="aicon ai-theme"></a>
        </li>
        <li class="layui-nav-item">
            <a href="javascript:void(0);"><?php echo htmlentities($login['nick']); ?>&nbsp;&nbsp;</a>
            <dl class="layui-nav-child">
                <dd>
                    <a data-id="00" class="admin-nav-item top-nav-item" href="<?php echo url('system/user/info'); ?>">个人设置</a>
                </dd>
                <dd>
                    <a href="<?php echo url('system/user/iframe'); ?>" class="j-ajax" refresh="yes"><?php echo input('cookie.hisi_iframe') ? '单页布局' : '框架布局'; ?></a>
                </dd>
                <?php if(is_array($languages) || $languages instanceof \think\Collection || $languages instanceof \think\Paginator): $i = 0; $__LIST__ = $languages;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['pack']): ?>
                    <dd><a href="<?php echo url('system/index/index'); ?>?lang=<?php echo htmlentities($vo['code']); ?>"><?php echo htmlentities($vo['name']); ?></a></dd>
                    <?php endif; ?>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <dd>
                    <a data-id="000" class="admin-nav-item top-nav-item" href="<?php echo url('system/language/index'); ?>">语言包管理</a>
                </dd>
                <dd>
                    <a href="<?php echo url('system/publics/logout'); ?>">退出登陆</a>
                </dd>
            </dl>
        </li>
    </ul>
</div>
<div class="layui-side layui-bg-black" id="switchNav">
    <div class="layui-side-scroll">
        <?php if(is_array($hisiMenus) || $hisiMenus instanceof \think\Collection || $hisiMenus instanceof \think\Paginator): $i = 0; $__LIST__ = $hisiMenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if(($hisiCurParents['pid'] == $v['id'] and $ca != 'plugins/run') or ($ca == 'plugins/run' and $v['id'] == 3)): ?>
        <ul class="layui-nav layui-nav-tree">
        <?php else: ?>
        <ul class="layui-nav layui-nav-tree" style="display:none;">
        <?php endif; if(is_array($v['childs']) || $v['childs'] instanceof \think\Collection || $v['childs'] instanceof \think\Paginator): $kk = 0; $__LIST__ = $v['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($kk % 2 );++$kk;?>
            <li class="layui-nav-item <?php if($kk == 1): ?>layui-nav-itemed<?php endif; ?>">
                <a href="javascript:;"><i class="<?php echo htmlentities($vv['icon']); ?>"></i><?php echo htmlentities($vv['title']); ?><span class="layui-nav-more"></span></a>
                <dl class="layui-nav-child">
                    <?php if($vv['title'] == '快捷菜单'): ?>
                        <dd>
                            <a class="admin-nav-item" data-id="0" href="<?php echo input('cookie.hisi_iframe') ? url('system/index/welcome') : url('system/index/index'); ?>"><i class="aicon ai-shouye"></i> 后台首页</a>
                        </dd>
                        <?php if(is_array($vv['childs']) || $vv['childs'] instanceof \think\Collection || $vv['childs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vv['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($i % 2 );++$i;?>
                        <dd>
                            <a class="admin-nav-item" data-id="<?php echo htmlentities($vvv['id']); ?>" href="<?php if(strpos('http', $vvv['url']) === false): ?><?php echo url($vvv['url'], $vvv['param']); else: ?><?php echo htmlentities($vvv['url']); ?><?php endif; ?>"><?php if(file_exists('.'.$vvv['icon'])): ?><img src="<?php echo htmlentities($vvv['icon']); ?>" width="16" height="16" /><?php else: ?><i class="<?php echo htmlentities($vvv['icon']); ?>"></i><?php endif; ?> <?php echo htmlentities($vvv['title']); ?></a><i data-href="<?php echo url('system/menu/del?id='.$vvv['id']); ?>" class="layui-icon j-del-menu">&#xe640;</i>
                        </dd>
                        <?php endforeach; endif; else: echo "" ;endif; else: if(is_array($vv['childs']) || $vv['childs'] instanceof \think\Collection || $vv['childs'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vv['childs'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($i % 2 );++$i;?>
                        <dd>
                            <a class="admin-nav-item" data-id="<?php echo htmlentities($vvv['id']); ?>" href="<?php if(strpos('http', $vvv['url']) === false): ?><?php echo url($vvv['url'], $vvv['param']); else: ?><?php echo htmlentities($vvv['url']); ?><?php endif; ?>"><?php if(file_exists('.'.$vvv['icon'])): ?><img src="<?php echo htmlentities($vvv['icon']); ?>" width="16" height="16" /><?php else: ?><i class="<?php echo htmlentities($vvv['icon']); ?>"></i><?php endif; ?> <?php echo htmlentities($vvv['title']); ?></a>
                        </dd>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php endif; ?>
                </dl>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<script type="text/html" id="hisi-theme-tpl">
    <ul class="hisi-themes">
        <?php $_result=session('hisi_admin_themes');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <li data-theme="<?php echo htmlentities($vo); ?>" class="hisi-theme-item-<?php echo htmlentities($vo); ?>"></li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</script>
    <div class="layui-body" id="switchBody">
        <ul class="bread-crumbs">
            <?php if(is_array($hisiBreadcrumb) || $hisiBreadcrumb instanceof \think\Collection || $hisiBreadcrumb instanceof \think\Paginator): $i = 0; $__LIST__ = $hisiBreadcrumb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($key > 0 && $i != count($hisiBreadcrumb)): ?>
                    <li>></li>
                    <li><a href="<?php echo url($v['url'].'?'.$v['param']); ?>"><?php echo htmlentities($v['title']); ?></a></li>
                <?php elseif($i == count($hisiBreadcrumb)): ?>
                    <li>></li>
                    <li><a href="javascript:void(0);"><?php echo htmlentities($v['title']); ?></a></li>
                <?php else: ?>
                    <li><a href="javascript:void(0);"><?php echo htmlentities($v['title']); ?></a></li>
                <?php endif; ?>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <li><a href="<?php echo url('system/menu/quick?id='.$hisiCurMenu['id']); ?>" title="添加到首页快捷菜单" class="j-ajax">[+]</a></li>
        </ul>
        <div style="padding:0 10px;" class="mcolor"><?php echo runhook('system_admin_tips'); ?></div>
            <div class="page-body">
<?php endif; switch($hisiTabType): case "1": ?>
        
        <div class="layui-card">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        <a href="javascript:;" id="curTitle"><?php echo $hisiCurMenu['title']; ?></a>
                    </li>
                </ul>
                <div class="layui-tab-content page-tab-content">
                    <div class="layui-tab-item layui-show">
                        <style type="text/css">
    #popLoginBox{padding:0 20px!important;}
</style>
<table class="layui-table" lay-skin="line">
    <thead>
        <tr>
            <th>系统信息</th>
        </tr> 
    </thead>
    <tbody>
        <tr>
            <td>当前版本：HisiPHP v<?php echo config('hisiphp.version'); ?>&nbsp;&nbsp;<?php if(config('hs_cloud.identifier')): ?><a href="<?php echo url('lists'); ?>" style="display:none" id="upgrade" class="layui-btn layui-btn-normal layui-btn-xs">有新版本，请点此升级</a><?php else: ?><a href="javascript:layer.msg('请先绑定账号！');" style="display:none" id="upgrade" class="mcolor">点此获取升级</a><?php endif; ?></td>
        </tr>
        <tr>
            <td>云平台通信：<span class="layui-btn layui-btn-normal layui-btn-xs" id="connectionStatus">...</span></td>
        </tr>
        <tr>
            <td>绑定云平台：<?php if(config('hs_cloud.identifier')): ?><?php echo substr(config('hs_cloud.identifier'), 0, 5); ?>***<?php echo substr(config('hs_cloud.identifier'), -5); ?> <a href="javascript:void(0);" class="layui-btn layui-btn-primary layui-btn-xs cloudBind">重新绑定</a><?php else: ?><a href="javascript:void(0);" class="layui-btn layui-btn-normal layui-btn-xs cloudBind">绑定云平台账号</a><span class="font12" style="color:#999"> [温馨提示：只有绑定了云平台，才可以使用在线升级]</span><?php endif; ?></td>
        </tr>
        <tr>
            <td>授权认证：<?php echo htmlentities($_SERVER['SERVER_NAME']); ?> <span class="red">未认证</span></td>
        </tr>
        <tr>
            <td>运行环境：<?php echo htmlentities($_SERVER["SERVER_SOFTWARE"]); ?></td>
        </tr>
        <tr>
            <td>服务器时间：<?php echo date("Y年n月j日 H:i:s"); ?></td>
        </tr>
    </tbody>
</table>
<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script type="text/html" id="popCloudBind">
    <form class="layui-form layui-form-pane page-form" action="<?php echo url(); ?>" method="post" id="cloudForm">
        <div class="layui-form-item">
            <label class="layui-form-label">云平台账号</label>
            <div class="layui-input-inline w200">
                <input type="text" class="layui-input" id="cloudAccount" name="account" lay-verify="required" autocomplete="off" placeholder="请输入云平台登陆账号">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">云平台密码</label>
            <div class="layui-input-inline w200">
                <input type="password" class="layui-input" id="cloudPassword" name="password" lay-verify="required" autocomplete="off" placeholder="请输入云平台登陆密码">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-form-mid layui-word-aux" style="padding:0!important;">
                温馨提示：确认绑定，表示您已了解并同意<a href="#" class="mcolor2">云平台相关协议</a>
            </div>
        </div>
        <div class="layui-form-item" id="resultTips"></div>
    </form>
</script>
<script>
layui.use(['jquery', 'layer', 'md5'], function() {
    var $ = layui.jquery, layer = layui.layer, md5 = layui.md5;
    $.ajax({
        dataType: 'JSON',
        url:'<?php echo htmlentities($api_url); ?>connection',
        data:'domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>&version=<?php echo config("hisiphp.version"); ?>',
        error:function(){
            $('#connectionStatus').removeClass('layui-btn-normal').addClass('layui-btn-danger').html('通信异常');
        },success:function(json) {
            $('#connectionStatus').html('通信正常');
            if (json.data.upgrade == 1) {
                $('#upgrade').show();
            }
        }
    });

    $('.cloudBind').on('click', function() {
        layer.open({
            title:'绑定云平台 / <a href="https://store.hisiphp.com/act/reg?domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>" target="_blank" class="mcolor">注册云平台</a>',
            id:'popLoginBox',
            area:'380px',
            content:$('#popCloudBind').html(),
            btn:['确认绑定', '取消'],
            btnAlign:'c',
            move:false,
            yes:function(index) {
                var tips = $('#resultTips');
                var account = $('#cloudAccount').val();
                var pwd = $('#cloudPassword').val();

                tips.html('请稍后，云平台通信中...');
                $.post('<?php echo url(''); ?>', {account: account, password: md5.exec(pwd)}, function(res) {
                    if (res.code == 1) {
                        layer.msg(res.msg);
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        tips.addClass('red').html(res.msg);
                        setTimeout(function() {
                            tips.removeClass('red').html('');
                        }, 3000);
                    }
                });
                return false;
            }
        });
    });
});
</script>
                    </div>
                </div>
            </div>
        </div>
    <?php break; case "2": ?>
        
        <div class="layui-card">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <?php if(is_array($hisiTabData['menu']) || $hisiTabData['menu'] instanceof \think\Collection || $hisiTabData['menu'] instanceof \think\Paginator): $k = 0; $__LIST__ = $hisiTabData['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;if($k == 1): ?>
                        <li class="layui-this">
                        <?php else: ?>
                        <li>
                        <?php endif; ?>
                        <a href="javascript:;"><?php echo $vo['title']; ?></a>
                        </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="layui-tab-content page-tab-content">
                    <style type="text/css">
    #popLoginBox{padding:0 20px!important;}
</style>
<table class="layui-table" lay-skin="line">
    <thead>
        <tr>
            <th>系统信息</th>
        </tr> 
    </thead>
    <tbody>
        <tr>
            <td>当前版本：HisiPHP v<?php echo config('hisiphp.version'); ?>&nbsp;&nbsp;<?php if(config('hs_cloud.identifier')): ?><a href="<?php echo url('lists'); ?>" style="display:none" id="upgrade" class="layui-btn layui-btn-normal layui-btn-xs">有新版本，请点此升级</a><?php else: ?><a href="javascript:layer.msg('请先绑定账号！');" style="display:none" id="upgrade" class="mcolor">点此获取升级</a><?php endif; ?></td>
        </tr>
        <tr>
            <td>云平台通信：<span class="layui-btn layui-btn-normal layui-btn-xs" id="connectionStatus">...</span></td>
        </tr>
        <tr>
            <td>绑定云平台：<?php if(config('hs_cloud.identifier')): ?><?php echo substr(config('hs_cloud.identifier'), 0, 5); ?>***<?php echo substr(config('hs_cloud.identifier'), -5); ?> <a href="javascript:void(0);" class="layui-btn layui-btn-primary layui-btn-xs cloudBind">重新绑定</a><?php else: ?><a href="javascript:void(0);" class="layui-btn layui-btn-normal layui-btn-xs cloudBind">绑定云平台账号</a><span class="font12" style="color:#999"> [温馨提示：只有绑定了云平台，才可以使用在线升级]</span><?php endif; ?></td>
        </tr>
        <tr>
            <td>授权认证：<?php echo htmlentities($_SERVER['SERVER_NAME']); ?> <span class="red">未认证</span></td>
        </tr>
        <tr>
            <td>运行环境：<?php echo htmlentities($_SERVER["SERVER_SOFTWARE"]); ?></td>
        </tr>
        <tr>
            <td>服务器时间：<?php echo date("Y年n月j日 H:i:s"); ?></td>
        </tr>
    </tbody>
</table>
<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script type="text/html" id="popCloudBind">
    <form class="layui-form layui-form-pane page-form" action="<?php echo url(); ?>" method="post" id="cloudForm">
        <div class="layui-form-item">
            <label class="layui-form-label">云平台账号</label>
            <div class="layui-input-inline w200">
                <input type="text" class="layui-input" id="cloudAccount" name="account" lay-verify="required" autocomplete="off" placeholder="请输入云平台登陆账号">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">云平台密码</label>
            <div class="layui-input-inline w200">
                <input type="password" class="layui-input" id="cloudPassword" name="password" lay-verify="required" autocomplete="off" placeholder="请输入云平台登陆密码">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-form-mid layui-word-aux" style="padding:0!important;">
                温馨提示：确认绑定，表示您已了解并同意<a href="#" class="mcolor2">云平台相关协议</a>
            </div>
        </div>
        <div class="layui-form-item" id="resultTips"></div>
    </form>
</script>
<script>
layui.use(['jquery', 'layer', 'md5'], function() {
    var $ = layui.jquery, layer = layui.layer, md5 = layui.md5;
    $.ajax({
        dataType: 'JSON',
        url:'<?php echo htmlentities($api_url); ?>connection',
        data:'domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>&version=<?php echo config("hisiphp.version"); ?>',
        error:function(){
            $('#connectionStatus').removeClass('layui-btn-normal').addClass('layui-btn-danger').html('通信异常');
        },success:function(json) {
            $('#connectionStatus').html('通信正常');
            if (json.data.upgrade == 1) {
                $('#upgrade').show();
            }
        }
    });

    $('.cloudBind').on('click', function() {
        layer.open({
            title:'绑定云平台 / <a href="https://store.hisiphp.com/act/reg?domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>" target="_blank" class="mcolor">注册云平台</a>',
            id:'popLoginBox',
            area:'380px',
            content:$('#popCloudBind').html(),
            btn:['确认绑定', '取消'],
            btnAlign:'c',
            move:false,
            yes:function(index) {
                var tips = $('#resultTips');
                var account = $('#cloudAccount').val();
                var pwd = $('#cloudPassword').val();

                tips.html('请稍后，云平台通信中...');
                $.post('<?php echo url(''); ?>', {account: account, password: md5.exec(pwd)}, function(res) {
                    if (res.code == 1) {
                        layer.msg(res.msg);
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        tips.addClass('red').html(res.msg);
                        setTimeout(function() {
                            tips.removeClass('red').html('');
                        }, 3000);
                    }
                });
                return false;
            }
        });
    });
});
</script>
                </div>
            </div>
        </div>
    <?php break; case "3": ?>
        
        <div class="layui-card">
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <?php if(is_array($hisiTabData['menu']) || $hisiTabData['menu'] instanceof \think\Collection || $hisiTabData['menu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $hisiTabData['menu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;
                            $hisiTabData['current'] = isset($hisiTabData['current']) ? $hisiTabData['current'] : '';
                         if($vo['url'] == $hisiCurMenu['url'] or (url($vo['url']) == $hisiTabData['current'])): ?>
                        <li class="layui-this">
                        <?php else: ?>
                        <li>
                        <?php endif; if(substr($vo['url'], 0, 4) == 'http'): ?>
                            <a href="<?php echo htmlentities($vo['url']); ?>" target="_blank"><?php echo $vo['title']; ?></a>
                        <?php else: ?>
                            <a href="<?php echo url($vo['url']); ?>"><?php echo $vo['title']; ?></a>
                        <?php endif; ?>
                        </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="layui-tab-content page-tab-content">
                    <div class="layui-tab-item layui-show">
                        <style type="text/css">
    #popLoginBox{padding:0 20px!important;}
</style>
<table class="layui-table" lay-skin="line">
    <thead>
        <tr>
            <th>系统信息</th>
        </tr> 
    </thead>
    <tbody>
        <tr>
            <td>当前版本：HisiPHP v<?php echo config('hisiphp.version'); ?>&nbsp;&nbsp;<?php if(config('hs_cloud.identifier')): ?><a href="<?php echo url('lists'); ?>" style="display:none" id="upgrade" class="layui-btn layui-btn-normal layui-btn-xs">有新版本，请点此升级</a><?php else: ?><a href="javascript:layer.msg('请先绑定账号！');" style="display:none" id="upgrade" class="mcolor">点此获取升级</a><?php endif; ?></td>
        </tr>
        <tr>
            <td>云平台通信：<span class="layui-btn layui-btn-normal layui-btn-xs" id="connectionStatus">...</span></td>
        </tr>
        <tr>
            <td>绑定云平台：<?php if(config('hs_cloud.identifier')): ?><?php echo substr(config('hs_cloud.identifier'), 0, 5); ?>***<?php echo substr(config('hs_cloud.identifier'), -5); ?> <a href="javascript:void(0);" class="layui-btn layui-btn-primary layui-btn-xs cloudBind">重新绑定</a><?php else: ?><a href="javascript:void(0);" class="layui-btn layui-btn-normal layui-btn-xs cloudBind">绑定云平台账号</a><span class="font12" style="color:#999"> [温馨提示：只有绑定了云平台，才可以使用在线升级]</span><?php endif; ?></td>
        </tr>
        <tr>
            <td>授权认证：<?php echo htmlentities($_SERVER['SERVER_NAME']); ?> <span class="red">未认证</span></td>
        </tr>
        <tr>
            <td>运行环境：<?php echo htmlentities($_SERVER["SERVER_SOFTWARE"]); ?></td>
        </tr>
        <tr>
            <td>服务器时间：<?php echo date("Y年n月j日 H:i:s"); ?></td>
        </tr>
    </tbody>
</table>
<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script type="text/html" id="popCloudBind">
    <form class="layui-form layui-form-pane page-form" action="<?php echo url(); ?>" method="post" id="cloudForm">
        <div class="layui-form-item">
            <label class="layui-form-label">云平台账号</label>
            <div class="layui-input-inline w200">
                <input type="text" class="layui-input" id="cloudAccount" name="account" lay-verify="required" autocomplete="off" placeholder="请输入云平台登陆账号">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">云平台密码</label>
            <div class="layui-input-inline w200">
                <input type="password" class="layui-input" id="cloudPassword" name="password" lay-verify="required" autocomplete="off" placeholder="请输入云平台登陆密码">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-form-mid layui-word-aux" style="padding:0!important;">
                温馨提示：确认绑定，表示您已了解并同意<a href="#" class="mcolor2">云平台相关协议</a>
            </div>
        </div>
        <div class="layui-form-item" id="resultTips"></div>
    </form>
</script>
<script>
layui.use(['jquery', 'layer', 'md5'], function() {
    var $ = layui.jquery, layer = layui.layer, md5 = layui.md5;
    $.ajax({
        dataType: 'JSON',
        url:'<?php echo htmlentities($api_url); ?>connection',
        data:'domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>&version=<?php echo config("hisiphp.version"); ?>',
        error:function(){
            $('#connectionStatus').removeClass('layui-btn-normal').addClass('layui-btn-danger').html('通信异常');
        },success:function(json) {
            $('#connectionStatus').html('通信正常');
            if (json.data.upgrade == 1) {
                $('#upgrade').show();
            }
        }
    });

    $('.cloudBind').on('click', function() {
        layer.open({
            title:'绑定云平台 / <a href="https://store.hisiphp.com/act/reg?domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>" target="_blank" class="mcolor">注册云平台</a>',
            id:'popLoginBox',
            area:'380px',
            content:$('#popCloudBind').html(),
            btn:['确认绑定', '取消'],
            btnAlign:'c',
            move:false,
            yes:function(index) {
                var tips = $('#resultTips');
                var account = $('#cloudAccount').val();
                var pwd = $('#cloudPassword').val();

                tips.html('请稍后，云平台通信中...');
                $.post('<?php echo url(''); ?>', {account: account, password: md5.exec(pwd)}, function(res) {
                    if (res.code == 1) {
                        layer.msg(res.msg);
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        tips.addClass('red').html(res.msg);
                        setTimeout(function() {
                            tips.removeClass('red').html('');
                        }, 3000);
                    }
                });
                return false;
            }
        });
    });
});
</script>
                    </div>
                </div>
            </div>
        </div>
    <?php break; default: ?>
        
        <div class="page-tab-content">
            <style type="text/css">
    #popLoginBox{padding:0 20px!important;}
</style>
<table class="layui-table" lay-skin="line">
    <thead>
        <tr>
            <th>系统信息</th>
        </tr> 
    </thead>
    <tbody>
        <tr>
            <td>当前版本：HisiPHP v<?php echo config('hisiphp.version'); ?>&nbsp;&nbsp;<?php if(config('hs_cloud.identifier')): ?><a href="<?php echo url('lists'); ?>" style="display:none" id="upgrade" class="layui-btn layui-btn-normal layui-btn-xs">有新版本，请点此升级</a><?php else: ?><a href="javascript:layer.msg('请先绑定账号！');" style="display:none" id="upgrade" class="mcolor">点此获取升级</a><?php endif; ?></td>
        </tr>
        <tr>
            <td>云平台通信：<span class="layui-btn layui-btn-normal layui-btn-xs" id="connectionStatus">...</span></td>
        </tr>
        <tr>
            <td>绑定云平台：<?php if(config('hs_cloud.identifier')): ?><?php echo substr(config('hs_cloud.identifier'), 0, 5); ?>***<?php echo substr(config('hs_cloud.identifier'), -5); ?> <a href="javascript:void(0);" class="layui-btn layui-btn-primary layui-btn-xs cloudBind">重新绑定</a><?php else: ?><a href="javascript:void(0);" class="layui-btn layui-btn-normal layui-btn-xs cloudBind">绑定云平台账号</a><span class="font12" style="color:#999"> [温馨提示：只有绑定了云平台，才可以使用在线升级]</span><?php endif; ?></td>
        </tr>
        <tr>
            <td>授权认证：<?php echo htmlentities($_SERVER['SERVER_NAME']); ?> <span class="red">未认证</span></td>
        </tr>
        <tr>
            <td>运行环境：<?php echo htmlentities($_SERVER["SERVER_SOFTWARE"]); ?></td>
        </tr>
        <tr>
            <td>服务器时间：<?php echo date("Y年n月j日 H:i:s"); ?></td>
        </tr>
    </tbody>
</table>
<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script type="text/html" id="popCloudBind">
    <form class="layui-form layui-form-pane page-form" action="<?php echo url(); ?>" method="post" id="cloudForm">
        <div class="layui-form-item">
            <label class="layui-form-label">云平台账号</label>
            <div class="layui-input-inline w200">
                <input type="text" class="layui-input" id="cloudAccount" name="account" lay-verify="required" autocomplete="off" placeholder="请输入云平台登陆账号">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">云平台密码</label>
            <div class="layui-input-inline w200">
                <input type="password" class="layui-input" id="cloudPassword" name="password" lay-verify="required" autocomplete="off" placeholder="请输入云平台登陆密码">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-form-mid layui-word-aux" style="padding:0!important;">
                温馨提示：确认绑定，表示您已了解并同意<a href="#" class="mcolor2">云平台相关协议</a>
            </div>
        </div>
        <div class="layui-form-item" id="resultTips"></div>
    </form>
</script>
<script>
layui.use(['jquery', 'layer', 'md5'], function() {
    var $ = layui.jquery, layer = layui.layer, md5 = layui.md5;
    $.ajax({
        dataType: 'JSON',
        url:'<?php echo htmlentities($api_url); ?>connection',
        data:'domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>&version=<?php echo config("hisiphp.version"); ?>',
        error:function(){
            $('#connectionStatus').removeClass('layui-btn-normal').addClass('layui-btn-danger').html('通信异常');
        },success:function(json) {
            $('#connectionStatus').html('通信正常');
            if (json.data.upgrade == 1) {
                $('#upgrade').show();
            }
        }
    });

    $('.cloudBind').on('click', function() {
        layer.open({
            title:'绑定云平台 / <a href="https://store.hisiphp.com/act/reg?domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>" target="_blank" class="mcolor">注册云平台</a>',
            id:'popLoginBox',
            area:'380px',
            content:$('#popCloudBind').html(),
            btn:['确认绑定', '取消'],
            btnAlign:'c',
            move:false,
            yes:function(index) {
                var tips = $('#resultTips');
                var account = $('#cloudAccount').val();
                var pwd = $('#cloudPassword').val();

                tips.html('请稍后，云平台通信中...');
                $.post('<?php echo url(''); ?>', {account: account, password: md5.exec(pwd)}, function(res) {
                    if (res.code == 1) {
                        layer.msg(res.msg);
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        tips.addClass('red').html(res.msg);
                        setTimeout(function() {
                            tips.removeClass('red').html('');
                        }, 3000);
                    }
                });
                return false;
            }
        });
    });
});
</script>
        </div>
<?php endswitch; if(input('param.hisi_iframe') || cookie('hisi_iframe')): ?>
</body>
</html>
<?php else: ?>
        </div>
    </div>
    <div class="layui-footer footer">
        <span class="fl">Powered by <a href="<?php echo config('hisiphp.url'); ?>" target="_blank"><?php echo config('hisiphp.name'); ?></a> v<?php echo config('hisiphp.version'); ?></span>
        <span class="fr"> © 2018-2020 <a href="<?php echo config('hisiphp.url'); ?>" target="_blank"><?php echo config('hisiphp.copyright'); ?></a> All Rights Reserved.</span>
    </div>
</div>
</body>
</html>
<?php endif; ?>