
以window系统Windows Server 2012 R标准版64位中文版为例安装wamp环境。

#### 一、apche安装

1、下载对应32位或64位的apache压缩包，[官网下载地址](https://www.apachehaus.com/cgi-bin/download.plx)

2、解压后，命令行进入到在apache的bin目录中输入 `httpd.exe -k install -n "Apache2.4"` ,会提示安装成功

> 提示：Apache2.4是版本，如果输入错误的版本号，也能安装成功但是会无法启动

3、修改httpd-conf约第38行Define SRVROOT的值，修改为一个正常路径，如`D:/lucas/apache/httpd-2.4.29-o102n-x64-vc14-r2/Apache24"`

修改httpd-conf约第280行代码为 `DirectoryIndex index.html index.php`

为了开启apache重写模式，并修改httpd-conf约第158行代码为开启状态

为了开启apache重写模式，修改httpd-conf约第267行代码为 `AllowOverride All`

4、命令行进入到在apache的bin目录中，输入 `httpd.exe -k start` ，即可启动成功

> 提示：1、在命令行模式下输入，`netstat -ano|findstr "80"`，用来检查80端口是否被占用
2、可在任务管理器中查看，如果提示不成功，会提醒httpd-conf文件的哪里配置有问题，对应修改好了即可

5、内网访问 `http://localhost` ，或者外网访问 xxx.xx.xxx.xx ,初始页面能正常打开，至此apache安装完毕

#### 二、php安装

1，[下载php压缩包](href="http://windows.php.net/download#php-7.2")，推荐下载php-7.2.3-Win32-VC15-x64.zip

 2，解压后，复制 php.ini-development，并改名为 php.ini ,[点此查看参考文档](href="https://jingyan.baidu.com/album/ce09321b7593062bfe858f6c.html?picindex=8")

 3，打开php.ini文件，将原`extension_dir = "/ext"`参数修改为：

`extension_dir = "D:/lucas/php/php-7.2.3-Win32-VC15-x64/ext"`

并开启extension=mysqli.dll扩展，和一些PDO支持，还有gd2支持

4，打开apache配置文件httpd.conf , 在代码的最后加入以下代码并重启apache服务:

```
# php7 support
LoadModule php7_module "D:/lucas/php/php-7.2.3-Win32-VC15-x64/php7apache2_4.dll"
AddType application/x-httpd-php .php
# configure the path to php.ini
PHPIniDir "D:/lucas/php/php-7.2.3-Win32-VC15-x64/"
```
> 注意：若遇到apache无法启动，请在cmd模式下 通过拖拽apache服务，并输入httpd.exe -k start 指令，根据提示修改，通常情况下报错的原因是php7apache2_4.dll文件不存在，这个时候只需要下载正确的压缩包即可，或路径指向不正确

5，在网站跟目录编辑一个php文件，若访问成功则php配置成功

#### 三、mysql安装

[点此查看参考文档](href="https://jingyan.baidu.com/article/363872ec2e27076e4ba16fc3.html")

至此wamp环境安装成功（Windows Server 2012 64位+ Apache 2.4.29 + php7.2.3 + mysql5.7）