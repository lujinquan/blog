<?php /*a:1:{s:64:"D:\phpStudy\WWW\blog\plugins/hisiphp/view/widget/systeminfo.html";i:1546829020;}*/ ?>
    <table class="layui-table" lay-skin="line">
        <colgroup>
            <col width="160">
            <col>
        </colgroup>
        <thead>
            <tr>
                <th colspan="2">系统基础信息</th>
            </tr> 
        </thead>
        <tbody>
            <tr>
                <td>HisiPHP版本</td>
                <td>V <?php echo config('hisiphp.version'); ?> <a href="<?php echo url('upgrade/index'); ?>" class="mcolor">检查新版本</a></td>
            </tr>
            <tr>
                <td>MySql版本</td>
                <td>MySql <?php echo db()->query('select version() as version')[0]['version']; ?></td>
            </tr>
            <tr>
                <td>PHP版本</td>
                <td>PHP <?php echo htmlentities(PHP_VERSION); ?> </td>
            </tr>
            <tr>
                <td>服务器环境</td>
                <td><?php echo htmlentities(PHP_OS); ?> / <?php echo htmlentities($_SERVER["SERVER_SOFTWARE"]); ?></td>
            </tr>
        </tbody>
    </table>