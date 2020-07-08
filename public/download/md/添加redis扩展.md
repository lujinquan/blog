
如何在lnmp或者lamp环境下安装redis扩展？

#### 一、安装redis模块

1、查看是否已安装

> 提示：通过phpinfo搜索redis关键字，或通过php -m 查看是否有redis模块

2、如果没有则安装对应php版本的redis模块，下面是安装php5.5的redis扩展

```
yum -y install php55w-pecl-redis.x86_64
```
3、安装完扩展后重启php-fpm，
```
# 重启php-fpm
systemctl restart php-fpm.service
```
4、然后重启nginx或apached
```
# 重启nginx
systemctl restart nginx.service

# 重启apached
service httpd restart
```
#### 二、连接远程redis服务器

1、输入命令：redis-cli -h 主机 -p 端口
```
# 重启php-fpm
redis-cli -h 主机 -p 端口
```
> 提示：Redis 默认禁ping，可以使用 telnet 来检测连通性。云数据库 Redis 暂时不支持外网访问，如果需要支持外网访问，可通过带有外网的云服务器通过 Iptable 代理的方式来实现。[更多点击查看详细参考文档](href="https://cloud.tencent.com/document/product/239/18664") 

2、输入命令：auth 密码 

```
auth 密码
```
> 注意：如果显示ok表示连接远程redis服务器成功，redis的三个重要参数 host（主机） , port （端口号）, auth (密码：有些是免密配置)