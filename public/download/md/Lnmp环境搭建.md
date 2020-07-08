
以centos7.2 64位为例使用yum安装

#### 一、搭建nginx
1、安装nginx
```
yum -y install nginx
```
2、开启nginx服务
```
systemctl start nginx.service
```
3、常用nginx命令如下
```
# 查看nginx版本
nginx -v
# 帮助
nginx -h
# 显示版本
nginx -v
# 显示版本和配置信息
nginx -V
# 测试配置(如果配置有问题会提示配置文件哪里错误)
nginx -t
# 测试配置时，只输出错误信息
nginx -q
# 停止服务器
nginx -s stop
# 重新加载配置
nginx -s reload
```
> 提示：通常安装完后nginx.conf文件位于/etc/nginx/nginx.conf

#### 二、安装mysql
1、下载mysql
```
yum install mariadb mariadb-server
```
2、安装mysql
```
yum install -y mariadb-server
```
3、开启mysql
```
systemctl start mariadb.service
```
4、开启支持mysql
```
systemctl enable mariadb.service
```
#### 三、使用yum安装php

1、不指定版本，安装默认版本php
```
# 安装默认版本
yum -y install php
# 安装默认版本php扩展
yum install php-mysql php-gd libjpeg php-ldap php-odbc php-pear php-xml php-xmlrpc php-mbstring php-bcmath php-mhash
# 重启nginx服务器和开启php-fpm服务
systemctl restart nginx.service
systemctl restart php-fpm.service
```
2、如果想要切换到指定版本，先卸载
```
yum remove php* php-common
```

3、安装指定版本php
```
# 安装yum源，由于当前是centos7系列所以选择下面的el7
rpm -Uvh https://mirror.webtatic.com/yum/el7/epel-release.rpm
# 安装对应的webtatic-release
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
# 开始安装，例如安装php7.0
yum install php70w
# 重启nginx服务器和开启php-fpm服务
systemctl restart nginx.service
systemctl restart php-fpm.service
```
> 提示：卸载 yum remove php70w 如遇问题尝试yum clean all 再执行安装命令

4、相关的php指令如下
```
# 查看php版本
php -v
# 卸载某扩展，例如卸载pdo
yum remove php70-pdo
#  查看php安装了那些模块
yum list installed | grep php
```
#### 四、也可以使用安装包安装php
1、下载对应的php包
```
# 例如下载php5.6
wget http://cn2.php.net/distributions/php-7.1.1.tar.gz
# 例如下载php7.2
wget http://cn2.php.net/distributions/php-7.2.4.tar.gz
```
> 提示：如果不指定下载的位置会默认下载到当前所在目录下，建议创建一个php目录，专门放php包

2、解压并执行
```
# 解压
tar xf php-5.6.38.tar.gz
# 需要安装gcc
yum install gcc autoconf gcc-c++
# 安装相关扩展
yum install libxml2 libxml2-devel openssl openssl-devel bzip2 bzip2-devel libcurl libcurl-devel libjpeg libjpeg-devel libpng libpng-devel freetype freetype-devel gmp gmp-devel readline readline-devel libxslt libxslt-devel
yum install systemd-devel
yum install openjpeg-devel
# 配置config
./configure \
--prefix=/usr/local/php/php56 \
--with-config-file-path=/usr/local/php/php56/etc \
--with-zlib-dir \
--with-freetype-dir \
--enable-mbstring \
--with-libxml-dir=/usr \
--enable-xmlreader \
--enable-xmlwriter \
--enable-soap \
--enable-calendar \
--with-curl \
--with-zlib \
--with-gd \
--with-pdo-sqlite \
--with-pdo-mysql \
--with-mysqli \
--with-mysql-sock \
--enable-mysqlnd \
--disable-rpath \
--enable-inline-optimization \
--with-bz2 \
--with-zlib \
--enable-sockets \
--enable-sysvsem \
--enable-sysvshm \
--enable-pcntl \
--enable-mbregex \
--enable-exif \
--enable-bcmath \
--with-mhash \
--enable-zip \
--with-pcre-regex \
--with-jpeg-dir=/usr \
--with-png-dir=/usr \
--with-openssl \
--enable-ftp \
--with-kerberos \
--with-gettext \
--with-xmlrpc \
--with-xsl \
--enable-fpm \
--with-fpm-user=php-fpm \
--with-fpm-group=php-fpm \
--with-fpm-systemd \
--enable-fileinfo
# 编译
make
# 编译检测
make test
# 编译安装
make install
```
> 提示：如果相关80端口被占用，可以使用`sudo fuser -k 80/tcp`命令关闭占用80端口的进程

3、启用安装php版本的php-fpm，例如上面手动安装的php56，安装位置位于/root目录下
```
# 创建用户及组
useradd lucas
groupadd lucas
usermod -G lucas lucas
# 修改对应php-fpm.conf文件配置，如果没有php-fpm.conf，可以复制一份php-fpm.conf.default文件改名
user = lucas
group = lucas
listen = 127.0.0.1:9001 # 默认是9000端口，多个php版本共存的情况下可以使用不同的端口号去监听
# 启用php-fpm
root/php71/sbin/php-fpm

```
> 提示：如果端口被占用可以执行命令`killall php-fpm`

4、可能用到的命令
```
netstat -an |grep :80
sudo chmod -R 777 xxx
```
#### 五、手动编译安装redis
1、下载redis
```
# 例如下载redis3.0.7
wget http://download.redis.io/releases/redis-3.0.7.tar.gz
wget https://github.com/phpredis/phpredis/archive/4.0.2.tar.gz
```
2、解压并执行
```
# 解压
tar -zxvf redis-3.0.7.tar.gz
# 编译
make
# 编译检测
make test
# 编译安装
make install
```
> 提示：如果make test 报错 killing still running Redis server 18882，可以执行命令 `vim tests/integration/replication-2.tcl` 将after 后面的数字改成1000即可

3、修改配置，修改redis-3.0.7/redis.conf文件，port 6379 改成6300
4、启用redis服务，/root为redis的安装目录
```
/root/redis-3.0.7/src/redis.server
```