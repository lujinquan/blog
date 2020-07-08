
sublime text 是很多人喜欢的一款编辑器，下面分享一下sublime text 3使用心得，事无巨细，仅供大家参考。

#### 一、下载安装
点击下载 [sublime text 3](href="http://www.sublimetextcn.com/Sublime Text3_64.exe") 并安装。

#### 二、设置快捷键
打开菜单 **首选项 》快捷键设置**，添加如下代码
```
// 代码格式化快捷键
{ "keys": ["ctrl+alt+l"], "command": "reindent" },
```
#### 三、设置代码片段
打开菜单 **工具 》代码片段**

1、创建一个常用的注释片段
```
<snippet>
    <content><![CDATA[
/**
 * $2
 * =====================================
 * @author  Lucas
 * email:   598936602@qq.com
 * Website  address:  www.mylucas.com.cn
 * =====================================
 * 创建时间: $1 <-- 这里输入 ctrl + shift + . 自动生成当前时间戳
 * @return  返回值  $3
 * @version 版本  1.0
 */

]]></content>
    <!-- 输入lu自动补全上述代码 -->
    <tabTrigger>lu</tabTrigger>
    <scope>source.php</scope>
</snippet>
```
2、创建一个类注释片段
```
<snippet>
    <content><![CDATA[
// +----------------------------------------------------------------------
// | 框架永久免费开源
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.mylucas.com.cn
// +----------------------------------------------------------------------
// | Author: Lucas <598936602@qq.com>
// +----------------------------------------------------------------------
// | Motto: There is only one kind of failure in the world is to give up .
// +----------------------------------------------------------------------
]]></content>
    <!-- 输入lucas自动补全上述代码 -->
    <tabTrigger>lucas</tabTrigger>
    <scope>source.php</scope>
</snippet>
```
> 提示：你可以复制以上全部代码并保存，保存后的地址例如：E:sublimeSublime Text3DataPackagesUser
这里的lu为触发方式，source.php 触发场景 在php 文件才能触发，不写默认全部场景，标签里面的是你需要重用的内容

#### 四、创建新插件

1、创建生成当前时间的插件

打开菜单 **工具》插件开发》新建插件**
```
import datetime
import sublime_plugin
class AddCurrentTimeCommand(sublime_plugin.TextCommand):
    def run(self, edit):
        self.view.run_command("insert_snippet", 
            {
                "contents": "%s" % datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S") 
            }
        )
```
> 提示：你可以全选覆盖保存为addCurrentTime.py ，保存到对应的插件位置如：E:sublimeSublime Text3DataPackagesUser

生成后设置快捷键来调用插件
```
[
    {
        "command": "add_current_time",
        "keys": [
            "ctrl+shift+."
        ]
    }
]
```