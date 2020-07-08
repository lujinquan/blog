linux安装宝塔面板，以centos7.4为例
#### 一、安装


```
yum install -y wget && wget -O install.sh 
http://download.bt.cn/install/install_6.0.sh && sh install.sh

```
> 提示：系统须为纯净版，未安装过类似lnmp或lamp环境，安装需花费约1分钟


#### 二、查看入口

```
/etc/init.d/bt default
# 或者使用快捷命令
bt default
```
> 提示：登录后直接选择极速版安装lnmp环境

#### 三、使用小技巧
1、使用composer安装php项目依赖时会受php版本影响，如何修改php默认版本？
```
ln -sf /www/server/php/72/bin/php /usr/bin/php
```
2、安装项目提示Warning:require():open_basedir restriction in effect. File(/www/wwwroot/……，如何解决？进入菜单“网站目录”，取消勾选“防跨站攻击（open_basedir）”即可。

3、如何卸载宝塔
```
# 下载卸载sh脚本
wget http://download.bt.cn/install/bt-uninstall.sh
# 执行sh脚本
sh bt-uninstall.sh
```
> 提示：根据提示输入1或2后按回车清理面板或环境 （若输入其他值或不输入直接回车则只卸载面板），此卸载脚本不会删除你的数据库及网站数据