<?php /*a:6:{s:61:"D:\phpStudy\WWW\blog\application\system\view\store\index.html";i:1546829020;s:56:"D:\phpStudy\WWW\blog\application\system\view\layout.html";i:1546829020;s:62:"D:\phpStudy\WWW\blog\application\system\view\block\header.html";i:1546829020;s:60:"D:\phpStudy\WWW\blog\application\system\view\block\menu.html";i:1546829020;s:61:"D:\phpStudy\WWW\blog\application\system\view\block\layui.html";i:1546829020;s:62:"D:\phpStudy\WWW\blog\application\system\view\block\footer.html";i:1546829020;}*/ ?>
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
    .layui-table-tool-temp{padding-right:0;}
</style>
<table id="dataTable"></table>
<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script type="text/javascript">
    layui.use(['table', 'jquery', 'layer', 'laytpl', 'form', 'md5'], function() {
        var si, 
            table = layui.table, 
            $ = layui.jquery, 
            layer = layui.layer, 
            laytpl = layui.laytpl,
            form = layui.form,
            identifier = '<?php echo config("hs_cloud.identifier"); ?>',
            clientIp = '<?php echo get_client_ip(); ?>',
            md5 = layui.md5;

        var getParam = function(name) { 
                var value = "", isFound = !1, search = this.location.search; 
                if (search.indexOf("?") == 0 && search.indexOf("=") > 1) { 
                    var params = unescape(search).substring(1, search.length).split("&"), i = 0; 
                    while (i < params.length && !isFound) {
                        params[i].indexOf("=") > 0 && params[i].split("=")[0].toLowerCase() == name.toLowerCase() && (value = params[i].split("=")[1], isFound = !0), i++ 
                    }
                } 
                return value == "" && (value = null), value;
            };

        var install = function (param) {
            $('.app-info').html('<div class="app-pay-success red">正在安装应用中，请勿刷新或关闭此页面</div>');
            $.get('<?php echo url('install'); ?>', param, function(res) {
                if (res.code == 1) {
                    $('.app-pay-success').removeClass('red').html('安装成功，稍后将自动刷新页面....');
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                } else {
                    $('.app-pay-success').html(res.msg);
                }
            }, 'json');
        };

        var popBindCloud = function ()
        {
            layer.open({
                title:'绑定云平台 / <a href="https://store.hisiphp.com/act/reg?domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>" target="_blank" class="mcolor">注册云平台</a>',
                id:'popLoginBox',
                area:'380px',
                content:$('#popCloudBind').html(),
                btn:['确认绑定', '取消'],
                btnAlign:'c',
                move:false,
                yes:function(index) {
                    var tips = $('#resultTips'), 
                        account = $('#cloudAccount').val(), 
                        pwd = $('#cloudPassword').val();
                    tips.html('请稍后，云平台通信中...');
                    $.post('<?php echo url("upgrade/index"); ?>', {account: account, password: md5.exec(pwd)}, function(res) {
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
                },
                success: function() {
                    $('#cloudForm .layui-word-aux').html('温馨提示：您需要登录云平台后才能安装此应用');
                }
            });
        }

        var specSelect = function() {
            var payment = $('.payment.layui-btn-normal').attr('data-value'),
                branchId = $('.branch_id.layui-btn-normal').attr('data-value'),
                price = $('.branch_id.layui-btn-normal').attr('data-price');
            $.ajax({
                url:'<?php echo htmlentities($api_url); ?>createOrder',
                data: {identifier: identifier,domain: '<?php echo get_domain(); ?><?php echo ROOT_DIR; ?>', payment: payment, branch_id: branchId},
                dataType: 'jsonp',
                error: function(){
                    $('.app-order-id').html('支付二维码获取失败');
                },
                success: function(res) {
                    if (res.code == 200) {
                        var installParam = {
                            app_name: res.app_name, 
                            app_type: res.app_type, 
                            app_keys: res.app_keys, 
                            branch_id: branchId
                        };

                        if (res.app_keys != null && res.app_keys != '') {
                            $('.app-order-id').html('<a data-data=\''+JSON.stringify(installParam)+'\' class="layui-btn layui-btn-normal mt50" id="installBtn">'+(parseFloat(price) <= 0 ? '免费应用' : '已支付')+'，请点此直接安装</a>');
                        } else {
                            $('.app-price').html('￥'+price);
                            $('.app-order-id').html('<span class="red">支付时请备注订单号：'+res.order_id+'</span><br><a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-normal j-show-question">点此查看常见问题</a>');
                            $('#qrcode').attr('src', res.qrcode).show();
                            // 定时刷新支付状态
                            var checkOrder = function() {
                                clearTimeout(si);
                                $.ajax({
                                    url:'<?php echo htmlentities($api_url); ?>checkOrder',
                                    data: {branch_id: branchId, identifier: identifier, domain: '<?php echo get_domain(); ?><?php echo ROOT_DIR; ?>'},
                                    dataType: 'jsonp',
                                    success: function(result) {
                                        installParam.app_keys = result.app_keys;
                                        if (result.code == 200) {
                                            install(installParam);
                                        } else {
                                            si = setTimeout(function () {
                                                checkOrder();
                                            }, 5000);
                                        }
                                    }
                                });
                            }
                            setTimeout(function(){checkOrder()}, 5000);
                        }
                    } else {
                        $('.app-order-id').html(res.msg);
                    }
                }
            });
        };

        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url('', input('get.')); ?>'
            ,page: true
            ,toolbar: '#toolbar'
            ,defaultToolbar: []
            ,text: {none: '对不起！暂无相关应用，不过不用担心，一大波开发者正在开发中....'}
            ,cols: [[
                {field:'title', width:180, title: '应用名称', templet:function(d) {
                    return d.title+' <i data-title="'+d.title+'" data-data='+JSON.stringify(d.preview)+' class="layui-icon layui-icon-picture"></i>';
                }}
                ,{field:'intro', title: '应用简介'}
                ,{field:'author', width:100, title: '作者'}
                ,{field:'price', width:100, title: '价格', templet:function(d) {
                    return '￥'+d.price;
                }}
                ,{field:'sales', width:70, title: '下载'}
                ,{width:160, title: ( identifier ? '<a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-normal j-bind-cloud">重新绑定</a>' : ''), templet: '#buttonTpl'}
            ]]
            ,done:function(res, curr, count) {
                var type = getParam('type'), catId = getParam('cat_id');
                $('#type'+(type ? type : 1)).removeClass('layui-btn-primary').addClass('layui-btn-normal');
                $('#cats'+(catId ? catId : 0)).removeClass('layui-btn-primary').addClass('layui-btn-normal');
            }
        });

        // 按条件筛选
        $(document).on('click', '.app-filter', function() {
            var that = $(this), 
                _url = '<?php echo url(''); ?>',
                _id = that.attr('data-id'),
                type = getParam('type'),
                catId = getParam('cat_id');

            if (that.attr('data-type') == 1) {
                _url += '?type='+that.attr('data-id')+(catId ? '&cat_id='+catId : '');
            } else {
                _url += '?cat_id='+that.attr('data-id')+(type ? '&type='+type : '');
            }

            history.replaceState('', '', _url);
            table.reload('dataTable', {
              url: _url,
              page: 1
            });
            return false;
        });

        // 弹出安装界面
        $(document).on('click', '.pop-install', function() {
            var that = $(this), data = new Function('return '+ that.attr('data-data'))();
            if (identifier == null || identifier == '') {
                popBindCloud();
            } else {
                laytpl($('#installTpl').html()).render(data, function(html) {
                    layer.open({
                        type: 1,
                        shade: 0.5,
                        title: '安装'+data.title,
                        skin: 'layui-layer-rim',
                        area: ['480px', '460px'],
                        content: html,
                        success: function(layero, index) {
                            specSelect();
                        },
                        cancel: function(index, layero) { 
                            clearTimeout(si);
                            return true; 
                        }  
                    });
                })
            }
            return false;
        });

        // 弹出绑定云平台界面
        $(document).on('click', '.j-bind-cloud', function() {
            popBindCloud();
        });

        // 应用分支和支付方式切换
        $(document).on('click', '.app-spec-a', function() {
            var that = $(this);
            if (that.hasClass('layui-btn-normal')) {
                return false;
            }
            that.removeClass('layui-btn-primary').addClass('layui-btn-normal')
            that.siblings('a').addClass('layui-btn-primary').removeClass('layui-btn-normal');
            specSelect();
        });

        // 已购买的应用手动点击安装
        $(document).on('click', '#installBtn', function() {
            var that = $(this), param = new Function('return '+ that.attr('data-data'))();
            install(param);
        });

        $(document).on('click', '.j-show-question', function() {
            layer.open({
                type: 1,
                title: '购买常见问题',
                shadeClose: true,
                area:['580px', '300px'],
                content: $('#questionTpl').html()
            });
        });

        $(document).on('click', '.layui-icon-picture', function() {
            var that = $(this), data = new Function('return '+ that.attr('data-data'))(), json = [];
            for(var i in data) {
                json.push({alt: that.attr('data-title'), pid: '123', src: 'https://store.hisiphp.com'+data[i], 'thumb': 'https://store.hisiphp.com'+data[i]});
            }
            layer.photos({photos: {status: 1, start: 0, title: that.attr('data-title'), id: 1, data: json}});
        });
    });
</script>
<script type="text/html" id="questionTpl">
<pre>

  <span class="layui-badge layui-bg-blue">问</span> 如何实现线上域名本地解析？
  <span class="layui-badge layui-bg-green">答</span> 通过<a href="https://jingyan.baidu.com/article/5bbb5a1b15c97c13eba1798a.html" class="red" target="_blank">修改hosts</a>实现本地解析，用解析后的新域名进入后台重新绑定云平台即可。


  <span class="layui-badge layui-bg-blue">问</span> 付款成功了，还是显示未支付？
  <span class="layui-badge layui-bg-green">答</span> 支付成功后正常是会立即生效，2分钟内未生效请联系<a href="http://wpa.qq.com/msgrd?v=3&uin=364666827&site=qq&menu=yes" target="_top">QQ：364666827</a>

  <span class="layui-badge layui-bg-blue">问</span> a.com已经购买过此应用了，为什么www.a.com还要再购买？
  <span class="layui-badge layui-bg-green">答</span> 应用授权采用单域名授权，单域名规则并不是以根域名来判断的。
</pre>
</script>
<script type="text/html" id="installTpl">
    <div class="layui-form">
        <dl class="app-spec">
            <dt>分支选择：</dt>
            <dd>
                {{# var i = 0; }}
                {{#  layui.each(d.branchs, function(index, item){ }}
                    <a href="javascript:void(0);" class="app-spec-a branch_id layui-btn layui-btn-xs {{ i == 0 ? 'layui-btn-normal' : 'layui-btn-primary' }}" data-value="{{ item.id }}" data-price="{{ item.price }}">{{ item.name }}</a>
                    {{# i++; }}
                {{#  }); }}
            </dd>
        </dl>
        <dl class="app-spec">
            <dt>支付方式：</dt>
            <dd>
                <a href="javascript:void(0);" data-value="wechat" class="layui-btn layui-btn-xs layui-btn-normal payment app-spec-a">微信支付</a>
                <a href="javascript:void(0);" data-value="alipay" class="layui-btn layui-btn-xs layui-btn-primary payment app-spec-a">支付宝支付</a>
            </dd>
        </dl>
        <dl class="app-spec">
            <dt>特别说明：</dt>
            <dd>
                <a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-danger j-show-question">★本应用为单域名授权，购买后不支持变更，点此查看解决方案★</a>
            </dd>
        </dl>
        <div class="layui-form-item app-info">
            <div class="app-price"></div>
            <div class="app-qrocde">
                <img src="" style="display:none;" id="qrcode" width="200" height="200" />
            </div>
            <div class="app-order-id"></div>
        </div>
    </div>
</script>
<script type="text/html" id="toolbar">
    <dl class="apps-filter-tr">
        <dt>应用类型：</dt>
        <dd>
            <a href="javascript:void(0);" id="type1" data-type="1" data-id="1" class="layui-btn layui-btn-primary layui-btn-xs app-filter">模块</a>
            <a href="javascript:void(0);" id="type2" data-type="1" data-id="2" class="layui-btn layui-btn-primary layui-btn-xs app-filter">插件</a>
            <a href="javascript:void(0);" id="type3" data-type="1" data-id="3" class="layui-btn layui-btn-primary layui-btn-xs app-filter">主题</a>
        </dd>
    </dl>
<!--     <dl class="apps-filter-tr">
        <dt>应用分类：</dt>
        <dd>
            <a href="javascript:void(0);" id="cats0" data-id="0" class="layui-btn layui-btn-primary layui-btn-xs app-filter">所有</a>
            <?php if(is_array($data['cats']) || $data['cats'] instanceof \think\Collection || $data['cats'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['cats'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <a href="javascript:void(0);" data-type="2" id="cats<?php echo htmlentities($vo['id']); ?>" data-id="<?php echo htmlentities($vo['id']); ?>" class="layui-btn layui-btn-primary layui-btn-xs app-filter"><?php echo htmlentities($vo['name']); ?></a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </dd>
    </dl> -->
</script>
<script type="text/html" id="buttonTpl">
    <a href="https://store.hisiphp.com/detail/{{ d.id }}.html?iframe=yes" class="layui-btn layui-btn-xs layui-btn-primary j-iframe-pop" width="800" title="详情预览">详情</a>{{# if (d.install) { }}{{# if (d.upgrade == 1) { }}<a href="<?php echo url('upgrade/lists'); ?>?app_type={{ d.type == 1 ? 'module' : (d.type == 2 ? 'plugins' : 'theme') }}&identifier={{ d.install }}" target="_blank" class="layui-btn layui-btn-xs">升级</a>{{# } else { }}<a href="javascript:void(0);" title="暂无新版本" class="layui-btn layui-btn-xs layui-disabled">升级</a>{{# } }}{{# } else { }}<a href="#<?php echo url('install'); ?>?app_id={{ d.id }}" data-data='{{ JSON.stringify(d) }}' class="layui-btn layui-btn-xs layui-btn-normal pop-install">安装</a>{{# } }}{{# if (d.preview_url) { }}<a href="{{ d.preview_url }}" class="layui-btn layui-btn-xs layui-btn-primary">演示</a>{{# } }}
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
    .layui-table-tool-temp{padding-right:0;}
</style>
<table id="dataTable"></table>
<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script type="text/javascript">
    layui.use(['table', 'jquery', 'layer', 'laytpl', 'form', 'md5'], function() {
        var si, 
            table = layui.table, 
            $ = layui.jquery, 
            layer = layui.layer, 
            laytpl = layui.laytpl,
            form = layui.form,
            identifier = '<?php echo config("hs_cloud.identifier"); ?>',
            clientIp = '<?php echo get_client_ip(); ?>',
            md5 = layui.md5;

        var getParam = function(name) { 
                var value = "", isFound = !1, search = this.location.search; 
                if (search.indexOf("?") == 0 && search.indexOf("=") > 1) { 
                    var params = unescape(search).substring(1, search.length).split("&"), i = 0; 
                    while (i < params.length && !isFound) {
                        params[i].indexOf("=") > 0 && params[i].split("=")[0].toLowerCase() == name.toLowerCase() && (value = params[i].split("=")[1], isFound = !0), i++ 
                    }
                } 
                return value == "" && (value = null), value;
            };

        var install = function (param) {
            $('.app-info').html('<div class="app-pay-success red">正在安装应用中，请勿刷新或关闭此页面</div>');
            $.get('<?php echo url('install'); ?>', param, function(res) {
                if (res.code == 1) {
                    $('.app-pay-success').removeClass('red').html('安装成功，稍后将自动刷新页面....');
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                } else {
                    $('.app-pay-success').html(res.msg);
                }
            }, 'json');
        };

        var popBindCloud = function ()
        {
            layer.open({
                title:'绑定云平台 / <a href="https://store.hisiphp.com/act/reg?domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>" target="_blank" class="mcolor">注册云平台</a>',
                id:'popLoginBox',
                area:'380px',
                content:$('#popCloudBind').html(),
                btn:['确认绑定', '取消'],
                btnAlign:'c',
                move:false,
                yes:function(index) {
                    var tips = $('#resultTips'), 
                        account = $('#cloudAccount').val(), 
                        pwd = $('#cloudPassword').val();
                    tips.html('请稍后，云平台通信中...');
                    $.post('<?php echo url("upgrade/index"); ?>', {account: account, password: md5.exec(pwd)}, function(res) {
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
                },
                success: function() {
                    $('#cloudForm .layui-word-aux').html('温馨提示：您需要登录云平台后才能安装此应用');
                }
            });
        }

        var specSelect = function() {
            var payment = $('.payment.layui-btn-normal').attr('data-value'),
                branchId = $('.branch_id.layui-btn-normal').attr('data-value'),
                price = $('.branch_id.layui-btn-normal').attr('data-price');
            $.ajax({
                url:'<?php echo htmlentities($api_url); ?>createOrder',
                data: {identifier: identifier,domain: '<?php echo get_domain(); ?><?php echo ROOT_DIR; ?>', payment: payment, branch_id: branchId},
                dataType: 'jsonp',
                error: function(){
                    $('.app-order-id').html('支付二维码获取失败');
                },
                success: function(res) {
                    if (res.code == 200) {
                        var installParam = {
                            app_name: res.app_name, 
                            app_type: res.app_type, 
                            app_keys: res.app_keys, 
                            branch_id: branchId
                        };

                        if (res.app_keys != null && res.app_keys != '') {
                            $('.app-order-id').html('<a data-data=\''+JSON.stringify(installParam)+'\' class="layui-btn layui-btn-normal mt50" id="installBtn">'+(parseFloat(price) <= 0 ? '免费应用' : '已支付')+'，请点此直接安装</a>');
                        } else {
                            $('.app-price').html('￥'+price);
                            $('.app-order-id').html('<span class="red">支付时请备注订单号：'+res.order_id+'</span><br><a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-normal j-show-question">点此查看常见问题</a>');
                            $('#qrcode').attr('src', res.qrcode).show();
                            // 定时刷新支付状态
                            var checkOrder = function() {
                                clearTimeout(si);
                                $.ajax({
                                    url:'<?php echo htmlentities($api_url); ?>checkOrder',
                                    data: {branch_id: branchId, identifier: identifier, domain: '<?php echo get_domain(); ?><?php echo ROOT_DIR; ?>'},
                                    dataType: 'jsonp',
                                    success: function(result) {
                                        installParam.app_keys = result.app_keys;
                                        if (result.code == 200) {
                                            install(installParam);
                                        } else {
                                            si = setTimeout(function () {
                                                checkOrder();
                                            }, 5000);
                                        }
                                    }
                                });
                            }
                            setTimeout(function(){checkOrder()}, 5000);
                        }
                    } else {
                        $('.app-order-id').html(res.msg);
                    }
                }
            });
        };

        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url('', input('get.')); ?>'
            ,page: true
            ,toolbar: '#toolbar'
            ,defaultToolbar: []
            ,text: {none: '对不起！暂无相关应用，不过不用担心，一大波开发者正在开发中....'}
            ,cols: [[
                {field:'title', width:180, title: '应用名称', templet:function(d) {
                    return d.title+' <i data-title="'+d.title+'" data-data='+JSON.stringify(d.preview)+' class="layui-icon layui-icon-picture"></i>';
                }}
                ,{field:'intro', title: '应用简介'}
                ,{field:'author', width:100, title: '作者'}
                ,{field:'price', width:100, title: '价格', templet:function(d) {
                    return '￥'+d.price;
                }}
                ,{field:'sales', width:70, title: '下载'}
                ,{width:160, title: ( identifier ? '<a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-normal j-bind-cloud">重新绑定</a>' : ''), templet: '#buttonTpl'}
            ]]
            ,done:function(res, curr, count) {
                var type = getParam('type'), catId = getParam('cat_id');
                $('#type'+(type ? type : 1)).removeClass('layui-btn-primary').addClass('layui-btn-normal');
                $('#cats'+(catId ? catId : 0)).removeClass('layui-btn-primary').addClass('layui-btn-normal');
            }
        });

        // 按条件筛选
        $(document).on('click', '.app-filter', function() {
            var that = $(this), 
                _url = '<?php echo url(''); ?>',
                _id = that.attr('data-id'),
                type = getParam('type'),
                catId = getParam('cat_id');

            if (that.attr('data-type') == 1) {
                _url += '?type='+that.attr('data-id')+(catId ? '&cat_id='+catId : '');
            } else {
                _url += '?cat_id='+that.attr('data-id')+(type ? '&type='+type : '');
            }

            history.replaceState('', '', _url);
            table.reload('dataTable', {
              url: _url,
              page: 1
            });
            return false;
        });

        // 弹出安装界面
        $(document).on('click', '.pop-install', function() {
            var that = $(this), data = new Function('return '+ that.attr('data-data'))();
            if (identifier == null || identifier == '') {
                popBindCloud();
            } else {
                laytpl($('#installTpl').html()).render(data, function(html) {
                    layer.open({
                        type: 1,
                        shade: 0.5,
                        title: '安装'+data.title,
                        skin: 'layui-layer-rim',
                        area: ['480px', '460px'],
                        content: html,
                        success: function(layero, index) {
                            specSelect();
                        },
                        cancel: function(index, layero) { 
                            clearTimeout(si);
                            return true; 
                        }  
                    });
                })
            }
            return false;
        });

        // 弹出绑定云平台界面
        $(document).on('click', '.j-bind-cloud', function() {
            popBindCloud();
        });

        // 应用分支和支付方式切换
        $(document).on('click', '.app-spec-a', function() {
            var that = $(this);
            if (that.hasClass('layui-btn-normal')) {
                return false;
            }
            that.removeClass('layui-btn-primary').addClass('layui-btn-normal')
            that.siblings('a').addClass('layui-btn-primary').removeClass('layui-btn-normal');
            specSelect();
        });

        // 已购买的应用手动点击安装
        $(document).on('click', '#installBtn', function() {
            var that = $(this), param = new Function('return '+ that.attr('data-data'))();
            install(param);
        });

        $(document).on('click', '.j-show-question', function() {
            layer.open({
                type: 1,
                title: '购买常见问题',
                shadeClose: true,
                area:['580px', '300px'],
                content: $('#questionTpl').html()
            });
        });

        $(document).on('click', '.layui-icon-picture', function() {
            var that = $(this), data = new Function('return '+ that.attr('data-data'))(), json = [];
            for(var i in data) {
                json.push({alt: that.attr('data-title'), pid: '123', src: 'https://store.hisiphp.com'+data[i], 'thumb': 'https://store.hisiphp.com'+data[i]});
            }
            layer.photos({photos: {status: 1, start: 0, title: that.attr('data-title'), id: 1, data: json}});
        });
    });
</script>
<script type="text/html" id="questionTpl">
<pre>

  <span class="layui-badge layui-bg-blue">问</span> 如何实现线上域名本地解析？
  <span class="layui-badge layui-bg-green">答</span> 通过<a href="https://jingyan.baidu.com/article/5bbb5a1b15c97c13eba1798a.html" class="red" target="_blank">修改hosts</a>实现本地解析，用解析后的新域名进入后台重新绑定云平台即可。


  <span class="layui-badge layui-bg-blue">问</span> 付款成功了，还是显示未支付？
  <span class="layui-badge layui-bg-green">答</span> 支付成功后正常是会立即生效，2分钟内未生效请联系<a href="http://wpa.qq.com/msgrd?v=3&uin=364666827&site=qq&menu=yes" target="_top">QQ：364666827</a>

  <span class="layui-badge layui-bg-blue">问</span> a.com已经购买过此应用了，为什么www.a.com还要再购买？
  <span class="layui-badge layui-bg-green">答</span> 应用授权采用单域名授权，单域名规则并不是以根域名来判断的。
</pre>
</script>
<script type="text/html" id="installTpl">
    <div class="layui-form">
        <dl class="app-spec">
            <dt>分支选择：</dt>
            <dd>
                {{# var i = 0; }}
                {{#  layui.each(d.branchs, function(index, item){ }}
                    <a href="javascript:void(0);" class="app-spec-a branch_id layui-btn layui-btn-xs {{ i == 0 ? 'layui-btn-normal' : 'layui-btn-primary' }}" data-value="{{ item.id }}" data-price="{{ item.price }}">{{ item.name }}</a>
                    {{# i++; }}
                {{#  }); }}
            </dd>
        </dl>
        <dl class="app-spec">
            <dt>支付方式：</dt>
            <dd>
                <a href="javascript:void(0);" data-value="wechat" class="layui-btn layui-btn-xs layui-btn-normal payment app-spec-a">微信支付</a>
                <a href="javascript:void(0);" data-value="alipay" class="layui-btn layui-btn-xs layui-btn-primary payment app-spec-a">支付宝支付</a>
            </dd>
        </dl>
        <dl class="app-spec">
            <dt>特别说明：</dt>
            <dd>
                <a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-danger j-show-question">★本应用为单域名授权，购买后不支持变更，点此查看解决方案★</a>
            </dd>
        </dl>
        <div class="layui-form-item app-info">
            <div class="app-price"></div>
            <div class="app-qrocde">
                <img src="" style="display:none;" id="qrcode" width="200" height="200" />
            </div>
            <div class="app-order-id"></div>
        </div>
    </div>
</script>
<script type="text/html" id="toolbar">
    <dl class="apps-filter-tr">
        <dt>应用类型：</dt>
        <dd>
            <a href="javascript:void(0);" id="type1" data-type="1" data-id="1" class="layui-btn layui-btn-primary layui-btn-xs app-filter">模块</a>
            <a href="javascript:void(0);" id="type2" data-type="1" data-id="2" class="layui-btn layui-btn-primary layui-btn-xs app-filter">插件</a>
            <a href="javascript:void(0);" id="type3" data-type="1" data-id="3" class="layui-btn layui-btn-primary layui-btn-xs app-filter">主题</a>
        </dd>
    </dl>
<!--     <dl class="apps-filter-tr">
        <dt>应用分类：</dt>
        <dd>
            <a href="javascript:void(0);" id="cats0" data-id="0" class="layui-btn layui-btn-primary layui-btn-xs app-filter">所有</a>
            <?php if(is_array($data['cats']) || $data['cats'] instanceof \think\Collection || $data['cats'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['cats'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <a href="javascript:void(0);" data-type="2" id="cats<?php echo htmlentities($vo['id']); ?>" data-id="<?php echo htmlentities($vo['id']); ?>" class="layui-btn layui-btn-primary layui-btn-xs app-filter"><?php echo htmlentities($vo['name']); ?></a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </dd>
    </dl> -->
</script>
<script type="text/html" id="buttonTpl">
    <a href="https://store.hisiphp.com/detail/{{ d.id }}.html?iframe=yes" class="layui-btn layui-btn-xs layui-btn-primary j-iframe-pop" width="800" title="详情预览">详情</a>{{# if (d.install) { }}{{# if (d.upgrade == 1) { }}<a href="<?php echo url('upgrade/lists'); ?>?app_type={{ d.type == 1 ? 'module' : (d.type == 2 ? 'plugins' : 'theme') }}&identifier={{ d.install }}" target="_blank" class="layui-btn layui-btn-xs">升级</a>{{# } else { }}<a href="javascript:void(0);" title="暂无新版本" class="layui-btn layui-btn-xs layui-disabled">升级</a>{{# } }}{{# } else { }}<a href="#<?php echo url('install'); ?>?app_id={{ d.id }}" data-data='{{ JSON.stringify(d) }}' class="layui-btn layui-btn-xs layui-btn-normal pop-install">安装</a>{{# } }}{{# if (d.preview_url) { }}<a href="{{ d.preview_url }}" class="layui-btn layui-btn-xs layui-btn-primary">演示</a>{{# } }}
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
    .layui-table-tool-temp{padding-right:0;}
</style>
<table id="dataTable"></table>
<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script type="text/javascript">
    layui.use(['table', 'jquery', 'layer', 'laytpl', 'form', 'md5'], function() {
        var si, 
            table = layui.table, 
            $ = layui.jquery, 
            layer = layui.layer, 
            laytpl = layui.laytpl,
            form = layui.form,
            identifier = '<?php echo config("hs_cloud.identifier"); ?>',
            clientIp = '<?php echo get_client_ip(); ?>',
            md5 = layui.md5;

        var getParam = function(name) { 
                var value = "", isFound = !1, search = this.location.search; 
                if (search.indexOf("?") == 0 && search.indexOf("=") > 1) { 
                    var params = unescape(search).substring(1, search.length).split("&"), i = 0; 
                    while (i < params.length && !isFound) {
                        params[i].indexOf("=") > 0 && params[i].split("=")[0].toLowerCase() == name.toLowerCase() && (value = params[i].split("=")[1], isFound = !0), i++ 
                    }
                } 
                return value == "" && (value = null), value;
            };

        var install = function (param) {
            $('.app-info').html('<div class="app-pay-success red">正在安装应用中，请勿刷新或关闭此页面</div>');
            $.get('<?php echo url('install'); ?>', param, function(res) {
                if (res.code == 1) {
                    $('.app-pay-success').removeClass('red').html('安装成功，稍后将自动刷新页面....');
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                } else {
                    $('.app-pay-success').html(res.msg);
                }
            }, 'json');
        };

        var popBindCloud = function ()
        {
            layer.open({
                title:'绑定云平台 / <a href="https://store.hisiphp.com/act/reg?domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>" target="_blank" class="mcolor">注册云平台</a>',
                id:'popLoginBox',
                area:'380px',
                content:$('#popCloudBind').html(),
                btn:['确认绑定', '取消'],
                btnAlign:'c',
                move:false,
                yes:function(index) {
                    var tips = $('#resultTips'), 
                        account = $('#cloudAccount').val(), 
                        pwd = $('#cloudPassword').val();
                    tips.html('请稍后，云平台通信中...');
                    $.post('<?php echo url("upgrade/index"); ?>', {account: account, password: md5.exec(pwd)}, function(res) {
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
                },
                success: function() {
                    $('#cloudForm .layui-word-aux').html('温馨提示：您需要登录云平台后才能安装此应用');
                }
            });
        }

        var specSelect = function() {
            var payment = $('.payment.layui-btn-normal').attr('data-value'),
                branchId = $('.branch_id.layui-btn-normal').attr('data-value'),
                price = $('.branch_id.layui-btn-normal').attr('data-price');
            $.ajax({
                url:'<?php echo htmlentities($api_url); ?>createOrder',
                data: {identifier: identifier,domain: '<?php echo get_domain(); ?><?php echo ROOT_DIR; ?>', payment: payment, branch_id: branchId},
                dataType: 'jsonp',
                error: function(){
                    $('.app-order-id').html('支付二维码获取失败');
                },
                success: function(res) {
                    if (res.code == 200) {
                        var installParam = {
                            app_name: res.app_name, 
                            app_type: res.app_type, 
                            app_keys: res.app_keys, 
                            branch_id: branchId
                        };

                        if (res.app_keys != null && res.app_keys != '') {
                            $('.app-order-id').html('<a data-data=\''+JSON.stringify(installParam)+'\' class="layui-btn layui-btn-normal mt50" id="installBtn">'+(parseFloat(price) <= 0 ? '免费应用' : '已支付')+'，请点此直接安装</a>');
                        } else {
                            $('.app-price').html('￥'+price);
                            $('.app-order-id').html('<span class="red">支付时请备注订单号：'+res.order_id+'</span><br><a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-normal j-show-question">点此查看常见问题</a>');
                            $('#qrcode').attr('src', res.qrcode).show();
                            // 定时刷新支付状态
                            var checkOrder = function() {
                                clearTimeout(si);
                                $.ajax({
                                    url:'<?php echo htmlentities($api_url); ?>checkOrder',
                                    data: {branch_id: branchId, identifier: identifier, domain: '<?php echo get_domain(); ?><?php echo ROOT_DIR; ?>'},
                                    dataType: 'jsonp',
                                    success: function(result) {
                                        installParam.app_keys = result.app_keys;
                                        if (result.code == 200) {
                                            install(installParam);
                                        } else {
                                            si = setTimeout(function () {
                                                checkOrder();
                                            }, 5000);
                                        }
                                    }
                                });
                            }
                            setTimeout(function(){checkOrder()}, 5000);
                        }
                    } else {
                        $('.app-order-id').html(res.msg);
                    }
                }
            });
        };

        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url('', input('get.')); ?>'
            ,page: true
            ,toolbar: '#toolbar'
            ,defaultToolbar: []
            ,text: {none: '对不起！暂无相关应用，不过不用担心，一大波开发者正在开发中....'}
            ,cols: [[
                {field:'title', width:180, title: '应用名称', templet:function(d) {
                    return d.title+' <i data-title="'+d.title+'" data-data='+JSON.stringify(d.preview)+' class="layui-icon layui-icon-picture"></i>';
                }}
                ,{field:'intro', title: '应用简介'}
                ,{field:'author', width:100, title: '作者'}
                ,{field:'price', width:100, title: '价格', templet:function(d) {
                    return '￥'+d.price;
                }}
                ,{field:'sales', width:70, title: '下载'}
                ,{width:160, title: ( identifier ? '<a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-normal j-bind-cloud">重新绑定</a>' : ''), templet: '#buttonTpl'}
            ]]
            ,done:function(res, curr, count) {
                var type = getParam('type'), catId = getParam('cat_id');
                $('#type'+(type ? type : 1)).removeClass('layui-btn-primary').addClass('layui-btn-normal');
                $('#cats'+(catId ? catId : 0)).removeClass('layui-btn-primary').addClass('layui-btn-normal');
            }
        });

        // 按条件筛选
        $(document).on('click', '.app-filter', function() {
            var that = $(this), 
                _url = '<?php echo url(''); ?>',
                _id = that.attr('data-id'),
                type = getParam('type'),
                catId = getParam('cat_id');

            if (that.attr('data-type') == 1) {
                _url += '?type='+that.attr('data-id')+(catId ? '&cat_id='+catId : '');
            } else {
                _url += '?cat_id='+that.attr('data-id')+(type ? '&type='+type : '');
            }

            history.replaceState('', '', _url);
            table.reload('dataTable', {
              url: _url,
              page: 1
            });
            return false;
        });

        // 弹出安装界面
        $(document).on('click', '.pop-install', function() {
            var that = $(this), data = new Function('return '+ that.attr('data-data'))();
            if (identifier == null || identifier == '') {
                popBindCloud();
            } else {
                laytpl($('#installTpl').html()).render(data, function(html) {
                    layer.open({
                        type: 1,
                        shade: 0.5,
                        title: '安装'+data.title,
                        skin: 'layui-layer-rim',
                        area: ['480px', '460px'],
                        content: html,
                        success: function(layero, index) {
                            specSelect();
                        },
                        cancel: function(index, layero) { 
                            clearTimeout(si);
                            return true; 
                        }  
                    });
                })
            }
            return false;
        });

        // 弹出绑定云平台界面
        $(document).on('click', '.j-bind-cloud', function() {
            popBindCloud();
        });

        // 应用分支和支付方式切换
        $(document).on('click', '.app-spec-a', function() {
            var that = $(this);
            if (that.hasClass('layui-btn-normal')) {
                return false;
            }
            that.removeClass('layui-btn-primary').addClass('layui-btn-normal')
            that.siblings('a').addClass('layui-btn-primary').removeClass('layui-btn-normal');
            specSelect();
        });

        // 已购买的应用手动点击安装
        $(document).on('click', '#installBtn', function() {
            var that = $(this), param = new Function('return '+ that.attr('data-data'))();
            install(param);
        });

        $(document).on('click', '.j-show-question', function() {
            layer.open({
                type: 1,
                title: '购买常见问题',
                shadeClose: true,
                area:['580px', '300px'],
                content: $('#questionTpl').html()
            });
        });

        $(document).on('click', '.layui-icon-picture', function() {
            var that = $(this), data = new Function('return '+ that.attr('data-data'))(), json = [];
            for(var i in data) {
                json.push({alt: that.attr('data-title'), pid: '123', src: 'https://store.hisiphp.com'+data[i], 'thumb': 'https://store.hisiphp.com'+data[i]});
            }
            layer.photos({photos: {status: 1, start: 0, title: that.attr('data-title'), id: 1, data: json}});
        });
    });
</script>
<script type="text/html" id="questionTpl">
<pre>

  <span class="layui-badge layui-bg-blue">问</span> 如何实现线上域名本地解析？
  <span class="layui-badge layui-bg-green">答</span> 通过<a href="https://jingyan.baidu.com/article/5bbb5a1b15c97c13eba1798a.html" class="red" target="_blank">修改hosts</a>实现本地解析，用解析后的新域名进入后台重新绑定云平台即可。


  <span class="layui-badge layui-bg-blue">问</span> 付款成功了，还是显示未支付？
  <span class="layui-badge layui-bg-green">答</span> 支付成功后正常是会立即生效，2分钟内未生效请联系<a href="http://wpa.qq.com/msgrd?v=3&uin=364666827&site=qq&menu=yes" target="_top">QQ：364666827</a>

  <span class="layui-badge layui-bg-blue">问</span> a.com已经购买过此应用了，为什么www.a.com还要再购买？
  <span class="layui-badge layui-bg-green">答</span> 应用授权采用单域名授权，单域名规则并不是以根域名来判断的。
</pre>
</script>
<script type="text/html" id="installTpl">
    <div class="layui-form">
        <dl class="app-spec">
            <dt>分支选择：</dt>
            <dd>
                {{# var i = 0; }}
                {{#  layui.each(d.branchs, function(index, item){ }}
                    <a href="javascript:void(0);" class="app-spec-a branch_id layui-btn layui-btn-xs {{ i == 0 ? 'layui-btn-normal' : 'layui-btn-primary' }}" data-value="{{ item.id }}" data-price="{{ item.price }}">{{ item.name }}</a>
                    {{# i++; }}
                {{#  }); }}
            </dd>
        </dl>
        <dl class="app-spec">
            <dt>支付方式：</dt>
            <dd>
                <a href="javascript:void(0);" data-value="wechat" class="layui-btn layui-btn-xs layui-btn-normal payment app-spec-a">微信支付</a>
                <a href="javascript:void(0);" data-value="alipay" class="layui-btn layui-btn-xs layui-btn-primary payment app-spec-a">支付宝支付</a>
            </dd>
        </dl>
        <dl class="app-spec">
            <dt>特别说明：</dt>
            <dd>
                <a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-danger j-show-question">★本应用为单域名授权，购买后不支持变更，点此查看解决方案★</a>
            </dd>
        </dl>
        <div class="layui-form-item app-info">
            <div class="app-price"></div>
            <div class="app-qrocde">
                <img src="" style="display:none;" id="qrcode" width="200" height="200" />
            </div>
            <div class="app-order-id"></div>
        </div>
    </div>
</script>
<script type="text/html" id="toolbar">
    <dl class="apps-filter-tr">
        <dt>应用类型：</dt>
        <dd>
            <a href="javascript:void(0);" id="type1" data-type="1" data-id="1" class="layui-btn layui-btn-primary layui-btn-xs app-filter">模块</a>
            <a href="javascript:void(0);" id="type2" data-type="1" data-id="2" class="layui-btn layui-btn-primary layui-btn-xs app-filter">插件</a>
            <a href="javascript:void(0);" id="type3" data-type="1" data-id="3" class="layui-btn layui-btn-primary layui-btn-xs app-filter">主题</a>
        </dd>
    </dl>
<!--     <dl class="apps-filter-tr">
        <dt>应用分类：</dt>
        <dd>
            <a href="javascript:void(0);" id="cats0" data-id="0" class="layui-btn layui-btn-primary layui-btn-xs app-filter">所有</a>
            <?php if(is_array($data['cats']) || $data['cats'] instanceof \think\Collection || $data['cats'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['cats'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <a href="javascript:void(0);" data-type="2" id="cats<?php echo htmlentities($vo['id']); ?>" data-id="<?php echo htmlentities($vo['id']); ?>" class="layui-btn layui-btn-primary layui-btn-xs app-filter"><?php echo htmlentities($vo['name']); ?></a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </dd>
    </dl> -->
</script>
<script type="text/html" id="buttonTpl">
    <a href="https://store.hisiphp.com/detail/{{ d.id }}.html?iframe=yes" class="layui-btn layui-btn-xs layui-btn-primary j-iframe-pop" width="800" title="详情预览">详情</a>{{# if (d.install) { }}{{# if (d.upgrade == 1) { }}<a href="<?php echo url('upgrade/lists'); ?>?app_type={{ d.type == 1 ? 'module' : (d.type == 2 ? 'plugins' : 'theme') }}&identifier={{ d.install }}" target="_blank" class="layui-btn layui-btn-xs">升级</a>{{# } else { }}<a href="javascript:void(0);" title="暂无新版本" class="layui-btn layui-btn-xs layui-disabled">升级</a>{{# } }}{{# } else { }}<a href="#<?php echo url('install'); ?>?app_id={{ d.id }}" data-data='{{ JSON.stringify(d) }}' class="layui-btn layui-btn-xs layui-btn-normal pop-install">安装</a>{{# } }}{{# if (d.preview_url) { }}<a href="{{ d.preview_url }}" class="layui-btn layui-btn-xs layui-btn-primary">演示</a>{{# } }}
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
                    </div>
                </div>
            </div>
        </div>
    <?php break; default: ?>
        
        <div class="page-tab-content">
            <style type="text/css">
    .layui-table-tool-temp{padding-right:0;}
</style>
<table id="dataTable"></table>
<script src="/static/js/layui/layui.js?v=<?php echo config('hisiphp.version'); ?>"></script>
<script>
    var ADMIN_PATH = "<?php echo htmlentities($_SERVER['SCRIPT_NAME']); ?>", LAYUI_OFFSET = 60;
    layui.config({
    	base: '/static/system/js/',
        version: '<?php echo config("hisiphp.version"); ?>'
    }).use('global');
</script>
<script type="text/javascript">
    layui.use(['table', 'jquery', 'layer', 'laytpl', 'form', 'md5'], function() {
        var si, 
            table = layui.table, 
            $ = layui.jquery, 
            layer = layui.layer, 
            laytpl = layui.laytpl,
            form = layui.form,
            identifier = '<?php echo config("hs_cloud.identifier"); ?>',
            clientIp = '<?php echo get_client_ip(); ?>',
            md5 = layui.md5;

        var getParam = function(name) { 
                var value = "", isFound = !1, search = this.location.search; 
                if (search.indexOf("?") == 0 && search.indexOf("=") > 1) { 
                    var params = unescape(search).substring(1, search.length).split("&"), i = 0; 
                    while (i < params.length && !isFound) {
                        params[i].indexOf("=") > 0 && params[i].split("=")[0].toLowerCase() == name.toLowerCase() && (value = params[i].split("=")[1], isFound = !0), i++ 
                    }
                } 
                return value == "" && (value = null), value;
            };

        var install = function (param) {
            $('.app-info').html('<div class="app-pay-success red">正在安装应用中，请勿刷新或关闭此页面</div>');
            $.get('<?php echo url('install'); ?>', param, function(res) {
                if (res.code == 1) {
                    $('.app-pay-success').removeClass('red').html('安装成功，稍后将自动刷新页面....');
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                } else {
                    $('.app-pay-success').html(res.msg);
                }
            }, 'json');
        };

        var popBindCloud = function ()
        {
            layer.open({
                title:'绑定云平台 / <a href="https://store.hisiphp.com/act/reg?domain=<?php echo htmlentities($_SERVER["SERVER_NAME"]); ?>" target="_blank" class="mcolor">注册云平台</a>',
                id:'popLoginBox',
                area:'380px',
                content:$('#popCloudBind').html(),
                btn:['确认绑定', '取消'],
                btnAlign:'c',
                move:false,
                yes:function(index) {
                    var tips = $('#resultTips'), 
                        account = $('#cloudAccount').val(), 
                        pwd = $('#cloudPassword').val();
                    tips.html('请稍后，云平台通信中...');
                    $.post('<?php echo url("upgrade/index"); ?>', {account: account, password: md5.exec(pwd)}, function(res) {
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
                },
                success: function() {
                    $('#cloudForm .layui-word-aux').html('温馨提示：您需要登录云平台后才能安装此应用');
                }
            });
        }

        var specSelect = function() {
            var payment = $('.payment.layui-btn-normal').attr('data-value'),
                branchId = $('.branch_id.layui-btn-normal').attr('data-value'),
                price = $('.branch_id.layui-btn-normal').attr('data-price');
            $.ajax({
                url:'<?php echo htmlentities($api_url); ?>createOrder',
                data: {identifier: identifier,domain: '<?php echo get_domain(); ?><?php echo ROOT_DIR; ?>', payment: payment, branch_id: branchId},
                dataType: 'jsonp',
                error: function(){
                    $('.app-order-id').html('支付二维码获取失败');
                },
                success: function(res) {
                    if (res.code == 200) {
                        var installParam = {
                            app_name: res.app_name, 
                            app_type: res.app_type, 
                            app_keys: res.app_keys, 
                            branch_id: branchId
                        };

                        if (res.app_keys != null && res.app_keys != '') {
                            $('.app-order-id').html('<a data-data=\''+JSON.stringify(installParam)+'\' class="layui-btn layui-btn-normal mt50" id="installBtn">'+(parseFloat(price) <= 0 ? '免费应用' : '已支付')+'，请点此直接安装</a>');
                        } else {
                            $('.app-price').html('￥'+price);
                            $('.app-order-id').html('<span class="red">支付时请备注订单号：'+res.order_id+'</span><br><a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-normal j-show-question">点此查看常见问题</a>');
                            $('#qrcode').attr('src', res.qrcode).show();
                            // 定时刷新支付状态
                            var checkOrder = function() {
                                clearTimeout(si);
                                $.ajax({
                                    url:'<?php echo htmlentities($api_url); ?>checkOrder',
                                    data: {branch_id: branchId, identifier: identifier, domain: '<?php echo get_domain(); ?><?php echo ROOT_DIR; ?>'},
                                    dataType: 'jsonp',
                                    success: function(result) {
                                        installParam.app_keys = result.app_keys;
                                        if (result.code == 200) {
                                            install(installParam);
                                        } else {
                                            si = setTimeout(function () {
                                                checkOrder();
                                            }, 5000);
                                        }
                                    }
                                });
                            }
                            setTimeout(function(){checkOrder()}, 5000);
                        }
                    } else {
                        $('.app-order-id').html(res.msg);
                    }
                }
            });
        };

        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url('', input('get.')); ?>'
            ,page: true
            ,toolbar: '#toolbar'
            ,defaultToolbar: []
            ,text: {none: '对不起！暂无相关应用，不过不用担心，一大波开发者正在开发中....'}
            ,cols: [[
                {field:'title', width:180, title: '应用名称', templet:function(d) {
                    return d.title+' <i data-title="'+d.title+'" data-data='+JSON.stringify(d.preview)+' class="layui-icon layui-icon-picture"></i>';
                }}
                ,{field:'intro', title: '应用简介'}
                ,{field:'author', width:100, title: '作者'}
                ,{field:'price', width:100, title: '价格', templet:function(d) {
                    return '￥'+d.price;
                }}
                ,{field:'sales', width:70, title: '下载'}
                ,{width:160, title: ( identifier ? '<a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-normal j-bind-cloud">重新绑定</a>' : ''), templet: '#buttonTpl'}
            ]]
            ,done:function(res, curr, count) {
                var type = getParam('type'), catId = getParam('cat_id');
                $('#type'+(type ? type : 1)).removeClass('layui-btn-primary').addClass('layui-btn-normal');
                $('#cats'+(catId ? catId : 0)).removeClass('layui-btn-primary').addClass('layui-btn-normal');
            }
        });

        // 按条件筛选
        $(document).on('click', '.app-filter', function() {
            var that = $(this), 
                _url = '<?php echo url(''); ?>',
                _id = that.attr('data-id'),
                type = getParam('type'),
                catId = getParam('cat_id');

            if (that.attr('data-type') == 1) {
                _url += '?type='+that.attr('data-id')+(catId ? '&cat_id='+catId : '');
            } else {
                _url += '?cat_id='+that.attr('data-id')+(type ? '&type='+type : '');
            }

            history.replaceState('', '', _url);
            table.reload('dataTable', {
              url: _url,
              page: 1
            });
            return false;
        });

        // 弹出安装界面
        $(document).on('click', '.pop-install', function() {
            var that = $(this), data = new Function('return '+ that.attr('data-data'))();
            if (identifier == null || identifier == '') {
                popBindCloud();
            } else {
                laytpl($('#installTpl').html()).render(data, function(html) {
                    layer.open({
                        type: 1,
                        shade: 0.5,
                        title: '安装'+data.title,
                        skin: 'layui-layer-rim',
                        area: ['480px', '460px'],
                        content: html,
                        success: function(layero, index) {
                            specSelect();
                        },
                        cancel: function(index, layero) { 
                            clearTimeout(si);
                            return true; 
                        }  
                    });
                })
            }
            return false;
        });

        // 弹出绑定云平台界面
        $(document).on('click', '.j-bind-cloud', function() {
            popBindCloud();
        });

        // 应用分支和支付方式切换
        $(document).on('click', '.app-spec-a', function() {
            var that = $(this);
            if (that.hasClass('layui-btn-normal')) {
                return false;
            }
            that.removeClass('layui-btn-primary').addClass('layui-btn-normal')
            that.siblings('a').addClass('layui-btn-primary').removeClass('layui-btn-normal');
            specSelect();
        });

        // 已购买的应用手动点击安装
        $(document).on('click', '#installBtn', function() {
            var that = $(this), param = new Function('return '+ that.attr('data-data'))();
            install(param);
        });

        $(document).on('click', '.j-show-question', function() {
            layer.open({
                type: 1,
                title: '购买常见问题',
                shadeClose: true,
                area:['580px', '300px'],
                content: $('#questionTpl').html()
            });
        });

        $(document).on('click', '.layui-icon-picture', function() {
            var that = $(this), data = new Function('return '+ that.attr('data-data'))(), json = [];
            for(var i in data) {
                json.push({alt: that.attr('data-title'), pid: '123', src: 'https://store.hisiphp.com'+data[i], 'thumb': 'https://store.hisiphp.com'+data[i]});
            }
            layer.photos({photos: {status: 1, start: 0, title: that.attr('data-title'), id: 1, data: json}});
        });
    });
</script>
<script type="text/html" id="questionTpl">
<pre>

  <span class="layui-badge layui-bg-blue">问</span> 如何实现线上域名本地解析？
  <span class="layui-badge layui-bg-green">答</span> 通过<a href="https://jingyan.baidu.com/article/5bbb5a1b15c97c13eba1798a.html" class="red" target="_blank">修改hosts</a>实现本地解析，用解析后的新域名进入后台重新绑定云平台即可。


  <span class="layui-badge layui-bg-blue">问</span> 付款成功了，还是显示未支付？
  <span class="layui-badge layui-bg-green">答</span> 支付成功后正常是会立即生效，2分钟内未生效请联系<a href="http://wpa.qq.com/msgrd?v=3&uin=364666827&site=qq&menu=yes" target="_top">QQ：364666827</a>

  <span class="layui-badge layui-bg-blue">问</span> a.com已经购买过此应用了，为什么www.a.com还要再购买？
  <span class="layui-badge layui-bg-green">答</span> 应用授权采用单域名授权，单域名规则并不是以根域名来判断的。
</pre>
</script>
<script type="text/html" id="installTpl">
    <div class="layui-form">
        <dl class="app-spec">
            <dt>分支选择：</dt>
            <dd>
                {{# var i = 0; }}
                {{#  layui.each(d.branchs, function(index, item){ }}
                    <a href="javascript:void(0);" class="app-spec-a branch_id layui-btn layui-btn-xs {{ i == 0 ? 'layui-btn-normal' : 'layui-btn-primary' }}" data-value="{{ item.id }}" data-price="{{ item.price }}">{{ item.name }}</a>
                    {{# i++; }}
                {{#  }); }}
            </dd>
        </dl>
        <dl class="app-spec">
            <dt>支付方式：</dt>
            <dd>
                <a href="javascript:void(0);" data-value="wechat" class="layui-btn layui-btn-xs layui-btn-normal payment app-spec-a">微信支付</a>
                <a href="javascript:void(0);" data-value="alipay" class="layui-btn layui-btn-xs layui-btn-primary payment app-spec-a">支付宝支付</a>
            </dd>
        </dl>
        <dl class="app-spec">
            <dt>特别说明：</dt>
            <dd>
                <a href="javascript:void(0);" class="layui-btn layui-btn-xs layui-btn-danger j-show-question">★本应用为单域名授权，购买后不支持变更，点此查看解决方案★</a>
            </dd>
        </dl>
        <div class="layui-form-item app-info">
            <div class="app-price"></div>
            <div class="app-qrocde">
                <img src="" style="display:none;" id="qrcode" width="200" height="200" />
            </div>
            <div class="app-order-id"></div>
        </div>
    </div>
</script>
<script type="text/html" id="toolbar">
    <dl class="apps-filter-tr">
        <dt>应用类型：</dt>
        <dd>
            <a href="javascript:void(0);" id="type1" data-type="1" data-id="1" class="layui-btn layui-btn-primary layui-btn-xs app-filter">模块</a>
            <a href="javascript:void(0);" id="type2" data-type="1" data-id="2" class="layui-btn layui-btn-primary layui-btn-xs app-filter">插件</a>
            <a href="javascript:void(0);" id="type3" data-type="1" data-id="3" class="layui-btn layui-btn-primary layui-btn-xs app-filter">主题</a>
        </dd>
    </dl>
<!--     <dl class="apps-filter-tr">
        <dt>应用分类：</dt>
        <dd>
            <a href="javascript:void(0);" id="cats0" data-id="0" class="layui-btn layui-btn-primary layui-btn-xs app-filter">所有</a>
            <?php if(is_array($data['cats']) || $data['cats'] instanceof \think\Collection || $data['cats'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['cats'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <a href="javascript:void(0);" data-type="2" id="cats<?php echo htmlentities($vo['id']); ?>" data-id="<?php echo htmlentities($vo['id']); ?>" class="layui-btn layui-btn-primary layui-btn-xs app-filter"><?php echo htmlentities($vo['name']); ?></a>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </dd>
    </dl> -->
</script>
<script type="text/html" id="buttonTpl">
    <a href="https://store.hisiphp.com/detail/{{ d.id }}.html?iframe=yes" class="layui-btn layui-btn-xs layui-btn-primary j-iframe-pop" width="800" title="详情预览">详情</a>{{# if (d.install) { }}{{# if (d.upgrade == 1) { }}<a href="<?php echo url('upgrade/lists'); ?>?app_type={{ d.type == 1 ? 'module' : (d.type == 2 ? 'plugins' : 'theme') }}&identifier={{ d.install }}" target="_blank" class="layui-btn layui-btn-xs">升级</a>{{# } else { }}<a href="javascript:void(0);" title="暂无新版本" class="layui-btn layui-btn-xs layui-disabled">升级</a>{{# } }}{{# } else { }}<a href="#<?php echo url('install'); ?>?app_id={{ d.id }}" data-data='{{ JSON.stringify(d) }}' class="layui-btn layui-btn-xs layui-btn-normal pop-install">安装</a>{{# } }}{{# if (d.preview_url) { }}<a href="{{ d.preview_url }}" class="layui-btn layui-btn-xs layui-btn-primary">演示</a>{{# } }}
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