<?php /*a:6:{s:58:"D:\phpStudy\WWW\blog\application\blog\view\cate\index.html";i:1547203165;s:54:"D:\phpStudy\WWW\blog\application\blog\view\layout.html";i:1547194856;s:62:"D:\phpStudy\WWW\blog\application\system\view\block\header.html";i:1546829020;s:60:"D:\phpStudy\WWW\blog\application\system\view\block\menu.html";i:1546829020;s:61:"D:\phpStudy\WWW\blog\application\system\view\block\layui.html";i:1546829020;s:62:"D:\phpStudy\WWW\blog\application\system\view\block\footer.html";i:1546829020;}*/ ?>
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
                        <div class="page-toolbar">
    <div class="page-filter">
        <div class="layui-input-inline layui-col-md2">
            <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-normal layui-icon layui-icon-edit">&nbsp;新增栏目</a>
        </div>
        <form class="layui-form layui-form-pane" action="<?php echo url("","",true,false);?>"  method="get" id="hisi-table-search">
            <div class="layui-input-inline layui-col-md2">
                <input type="text" name="keywords" placeholder="搜索" class="layui-input">
            </div>
            
            <div class="layui-input-inline layui-col-md3" style="margin-left:20px;">
                
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">
                    <i class="layui-icon">&#xe615;</i>
                    搜索
                </button>
                <button type="reset" class="layui-btn">重置</button>
            </div>
        </form>
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
<table id="dataTable" lay-filter='dataTable'></table>
<script type="text/html" title="操作按钮模板" id="buttonTpl">
    <a href="<?php echo url('cate'); ?>?cate_id={{ d.cate_id }}" class="layui-btn layui-btn-xs layui-btn-normal">详情</a>
    <button data-href="<?php echo url('del'); ?>?cate_id={{ d.cate_id }}" class="layui-btn layui-btn-xs layui-btn-danger delete">删除</button>
</script>
<script type="text/javascript">
    layui.use(['table'], function() {
        var table = layui.table;
        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url("blog/Cate/index"); ?>' //数据接口
            ,page: true //开启分页
            ,limit: 10
            ,text: {
                none : '暂无相关数据'
            }
            ,cols: [[ //表头
                {field: 'sort_order', width: 100, sort: true,title: '排序'}
                ,{field: 'cate_name', width: 160, title: '栏目名称'}
                ,{field: 'cate_url', width: 300, title: '栏目路径'}
                ,{field: 'cate_desc', width: 200, title: '描述'}
                ,{field: 'is_show', width: 80,title: '状态' ,templet: function(d) {
                    switch(parseInt(d.is_show)){
                        case 1:
                          return '可用';
                          break;
                        case 2:
                          return '禁用';
                          break;
                        default:
                          return '';
                    }  
                }}
                ,{title: '操作', width: 180, templet: '#buttonTpl',fixed:'right'}
            ]]
            ,done:function(res,curr,count){
               
            }
        })
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
                    <div class="page-toolbar">
    <div class="page-filter">
        <div class="layui-input-inline layui-col-md2">
            <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-normal layui-icon layui-icon-edit">&nbsp;新增栏目</a>
        </div>
        <form class="layui-form layui-form-pane" action="<?php echo url("","",true,false);?>"  method="get" id="hisi-table-search">
            <div class="layui-input-inline layui-col-md2">
                <input type="text" name="keywords" placeholder="搜索" class="layui-input">
            </div>
            
            <div class="layui-input-inline layui-col-md3" style="margin-left:20px;">
                
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">
                    <i class="layui-icon">&#xe615;</i>
                    搜索
                </button>
                <button type="reset" class="layui-btn">重置</button>
            </div>
        </form>
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
<table id="dataTable" lay-filter='dataTable'></table>
<script type="text/html" title="操作按钮模板" id="buttonTpl">
    <a href="<?php echo url('cate'); ?>?cate_id={{ d.cate_id }}" class="layui-btn layui-btn-xs layui-btn-normal">详情</a>
    <button data-href="<?php echo url('del'); ?>?cate_id={{ d.cate_id }}" class="layui-btn layui-btn-xs layui-btn-danger delete">删除</button>
</script>
<script type="text/javascript">
    layui.use(['table'], function() {
        var table = layui.table;
        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url("blog/Cate/index"); ?>' //数据接口
            ,page: true //开启分页
            ,limit: 10
            ,text: {
                none : '暂无相关数据'
            }
            ,cols: [[ //表头
                {field: 'sort_order', width: 100, sort: true,title: '排序'}
                ,{field: 'cate_name', width: 160, title: '栏目名称'}
                ,{field: 'cate_url', width: 300, title: '栏目路径'}
                ,{field: 'cate_desc', width: 200, title: '描述'}
                ,{field: 'is_show', width: 80,title: '状态' ,templet: function(d) {
                    switch(parseInt(d.is_show)){
                        case 1:
                          return '可用';
                          break;
                        case 2:
                          return '禁用';
                          break;
                        default:
                          return '';
                    }  
                }}
                ,{title: '操作', width: 180, templet: '#buttonTpl',fixed:'right'}
            ]]
            ,done:function(res,curr,count){
               
            }
        })
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
                        <div class="page-toolbar">
    <div class="page-filter">
        <div class="layui-input-inline layui-col-md2">
            <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-normal layui-icon layui-icon-edit">&nbsp;新增栏目</a>
        </div>
        <form class="layui-form layui-form-pane" action="<?php echo url("","",true,false);?>"  method="get" id="hisi-table-search">
            <div class="layui-input-inline layui-col-md2">
                <input type="text" name="keywords" placeholder="搜索" class="layui-input">
            </div>
            
            <div class="layui-input-inline layui-col-md3" style="margin-left:20px;">
                
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">
                    <i class="layui-icon">&#xe615;</i>
                    搜索
                </button>
                <button type="reset" class="layui-btn">重置</button>
            </div>
        </form>
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
<table id="dataTable" lay-filter='dataTable'></table>
<script type="text/html" title="操作按钮模板" id="buttonTpl">
    <a href="<?php echo url('cate'); ?>?cate_id={{ d.cate_id }}" class="layui-btn layui-btn-xs layui-btn-normal">详情</a>
    <button data-href="<?php echo url('del'); ?>?cate_id={{ d.cate_id }}" class="layui-btn layui-btn-xs layui-btn-danger delete">删除</button>
</script>
<script type="text/javascript">
    layui.use(['table'], function() {
        var table = layui.table;
        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url("blog/Cate/index"); ?>' //数据接口
            ,page: true //开启分页
            ,limit: 10
            ,text: {
                none : '暂无相关数据'
            }
            ,cols: [[ //表头
                {field: 'sort_order', width: 100, sort: true,title: '排序'}
                ,{field: 'cate_name', width: 160, title: '栏目名称'}
                ,{field: 'cate_url', width: 300, title: '栏目路径'}
                ,{field: 'cate_desc', width: 200, title: '描述'}
                ,{field: 'is_show', width: 80,title: '状态' ,templet: function(d) {
                    switch(parseInt(d.is_show)){
                        case 1:
                          return '可用';
                          break;
                        case 2:
                          return '禁用';
                          break;
                        default:
                          return '';
                    }  
                }}
                ,{title: '操作', width: 180, templet: '#buttonTpl',fixed:'right'}
            ]]
            ,done:function(res,curr,count){
               
            }
        })
    });

</script>
                    </div>
                </div>
            </div>
        </div>
    <?php break; default: ?>
        
        <div class="page-tab-content">
            <div class="page-toolbar">
    <div class="page-filter">
        <div class="layui-input-inline layui-col-md2">
            <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-normal layui-icon layui-icon-edit">&nbsp;新增栏目</a>
        </div>
        <form class="layui-form layui-form-pane" action="<?php echo url("","",true,false);?>"  method="get" id="hisi-table-search">
            <div class="layui-input-inline layui-col-md2">
                <input type="text" name="keywords" placeholder="搜索" class="layui-input">
            </div>
            
            <div class="layui-input-inline layui-col-md3" style="margin-left:20px;">
                
                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">
                    <i class="layui-icon">&#xe615;</i>
                    搜索
                </button>
                <button type="reset" class="layui-btn">重置</button>
            </div>
        </form>
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
<table id="dataTable" lay-filter='dataTable'></table>
<script type="text/html" title="操作按钮模板" id="buttonTpl">
    <a href="<?php echo url('cate'); ?>?cate_id={{ d.cate_id }}" class="layui-btn layui-btn-xs layui-btn-normal">详情</a>
    <button data-href="<?php echo url('del'); ?>?cate_id={{ d.cate_id }}" class="layui-btn layui-btn-xs layui-btn-danger delete">删除</button>
</script>
<script type="text/javascript">
    layui.use(['table'], function() {
        var table = layui.table;
        table.render({
            elem: '#dataTable'
            ,url: '<?php echo url("blog/Cate/index"); ?>' //数据接口
            ,page: true //开启分页
            ,limit: 10
            ,text: {
                none : '暂无相关数据'
            }
            ,cols: [[ //表头
                {field: 'sort_order', width: 100, sort: true,title: '排序'}
                ,{field: 'cate_name', width: 160, title: '栏目名称'}
                ,{field: 'cate_url', width: 300, title: '栏目路径'}
                ,{field: 'cate_desc', width: 200, title: '描述'}
                ,{field: 'is_show', width: 80,title: '状态' ,templet: function(d) {
                    switch(parseInt(d.is_show)){
                        case 1:
                          return '可用';
                          break;
                        case 2:
                          return '禁用';
                          break;
                        default:
                          return '';
                    }  
                }}
                ,{title: '操作', width: 180, templet: '#buttonTpl',fixed:'right'}
            ]]
            ,done:function(res,curr,count){
               
            }
        })
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