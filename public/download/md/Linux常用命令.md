整理了下linux常用的命令
#### 一、系统信息
```
# 显示及其的处理器架构
arch
# 显示正在使用的内核版本
username -r
# 显示CPU info的信息
cat /proc/cpuinfo
# 校验内存使用
cat /proc/meminfo
# 显示哪些swap被使用
cat /proc/swaps
# 显示内核的版本
cat /proc/version
# 显示网络适配器及统计
cat /proc/net/dev
# 显示已加载的文件系统
cat /proc/mounts

```
#### 二、文件和目录

```
# 进入 ‘/ home’ 目录’
cd /home
# 返回上一级目录
cd ..
# 返回上两级目录
cd ../..
# 进入个人的主目录
cd ~user1
# 返回上次所在的目录
cd -
# 显示工作路径
pwd
# 查看目录中的文件
ls
# 查看目录中的文件
ls -F
# 显示文件和目录的详细资料
ls -l
# 显示文件和目录的详细资料包括权限
ls -lh
# 显示隐藏文件
ls -a
# 显示包含数字的文件名和目录名
ls [0-9]
# 显示文件和目录由根目录开始的树形结构(1)
tree
# 显示文件和目录由根目录开始的树形结构(2)
lstree
# 创建一个叫做 ‘dir1’ 的目录’
mkdir dir1
# 同时创建两个目录
mkdir dir1 dir2
# 创建一个目录树
mkdir -p /tmp/dir1/dir2
# 删除一个叫做 ‘file1’ 的文件’
rm -f file1
# 删除一个叫做 ‘dir1’ 的目录’
rmdir dir1
# 删除一个叫做 ‘dir1’ 的目录并同时删除其内容
rm -rf dir1
# 给runtime文件夹及其子目录和文件，赋予777权限
chmod -R 777 runtime
# 同时删除两个目录及它们的内容
rm -rf dir1 dir2
# 使用通配符来删除所有当前目录下包含.nginx.conf.s文件名的文件
rm -l .nginx.conf.s
# 重命名/移动 一个目录
mv dir1 new_dir
# 复制一个文件
cp file1 file2
# 复制一个目录下的所有文件到当前工作目录
cp dir/ .
# 深度压缩，将test目录压缩成test.zip文件
zip -r test.zip test
# 解压test.zip文件
unzip test.zip
# 深度递归复制dir1目录到dir2目录，如果dir2目录不存在则同时创建另一个文件夹
cp -r dir1 dir2
# 复制一个目录到当前工作目录
cp -a /tmp/dir1 .
# 复制一个目录
cp -a dir1 dir2
```
#### 三、文件搜索

```
# 从 ‘/‘ 开始进入根文件系统搜索文件和目录
find / -name file1
# 搜索属于用户 ‘user1’ 的文件和目录
find / -user user1
# 在目录 ‘/ home/user1’ 中搜索带有’.bin’ 结尾的文件
find /home/user1 -name *.bin
# 搜索在过去100天内未被使用过的执行文件
find /usr/bin -type f -atime +100
# 搜索在10天内被创建或者修改过的文件
find /usr/bin -type f -mtime -10
# 搜索以 ‘.rpm’ 结尾的文件并定义其权限
find / -name *.rpm -exec chmod 755 ‘{}’ \;
# 搜索以 ‘.rpm’ 结尾的文件，忽略光驱、捷盘等可移动设备
find / -xdev -name *.rpm
# 寻找以 ‘.ps’ 结尾的文件 - 先运行 ‘updatedb’ 命令
locate *.ps
# 显示一个二进制文件、源码或man的位置
whereis halt
# 显示一个二进制文件或可执行文件的完整路径
which halt
```
#### 四、磁盘空间
```
# 查看当前目录总共占的容量。而不单独列出各子项占用的容量
du -sh
# 查看当前目录下一级子文件和子目录占用的磁盘容量。
du -lh —max-depth=1
# 显示已经挂载的分区列表
df -h
# 以尺寸大小排列文件和目录
ls -lSr |more
# 估算目录 ‘dir1’ 已经使用的磁盘空间’
du -sh dir1
# 以容量大小为依据依次显示文件和目录的大小
du -sk * | sort -rn
# 以大小为依据依次显示已安装的rpm包所使用的空间 (fedora, redhat类系统)
rpm -q -a —qf '%10{SIZE}t%{NAME}n' | sort -k1,1n
# 以大小为依据显示已安装的deb包所使用的空间 (ubuntu, debian类系统)
dpkg-query -W -f='${Installed-Size;10}t${Package}n' | sort -k1,1n
```
#### 五、用户和群组
```
# 创建一个新用户组
groupadd group_name
# 删除一个用户组
groupdel group_name
# 重命名一个用户组
groupmod -n new_group_name old_group_name
# 创建一个属于 “admin” 用户组的用户
useradd -c “Name Surname “ -g admin -d /home/user1 -s /bin/bash user1
# 创建一个新用户
useradd user1
# 删除一个用户 ( ‘-r’ 排除主目录)
userdel -r user1
# 修改用户属性
usermod -c “User FTP” -g system -d /ftp/user1 -s /bin/nologin user1
# 修改口令
passwd
# 修改一个用户的口令 (只允许root执行)
passwd user1
# 设置用户口令的失效期限
chage -E 2005-12-31 user1
# 检查 ‘/etc/passwd’ 的文件格式和语法修正以及存在的用户
pwck
# 检查 ‘/etc/passwd’ 的文件格式和语法修正以及存在的群组
grpck
#e 登陆进一个新的群组以改变新创建文件的预设群组
newgrp group_nam
```
#### 六、压缩与解压
```
# 解压一个叫做 ‘file1.bz2’的文件
bunzip2 file1.bz2
# 压缩一个叫做 ‘file1’ 的文件
bzip2 file1
# 解压一个叫做 ‘file1.gz’的文件
gunzip file1.gz
# 压缩一个叫做 ‘file1’的文件
gzip file1
# 最大程度压缩
gzip -9 file1
# 创建一个叫做 ‘file1.rar’ 的包
rar a file1.rar test_file
# 同时压缩 ‘file1’, ‘file2’ 以及目录 ‘dir1’
rar a file1.rar file1 file2 dir1
# 解压rar包
rar x file1.rar
# 解压rar包
unrar x file1.rar
# 创建一个非压缩的 tarball
tar -cvf archive.tar file1
# 创建一个包含了 ‘file1’, ‘file2’ 以及 ‘dir1’的档案文件
tar -cvf archive.tar file1 file2 dir1
# 显示一个包中的内容
tar -tf archive.tar
# 释放一个包
tar -xvf archive.tar
# 将压缩包释放到 /tmp目录下
tar -xvf archive.tar -C /tmp
# 创建一个bzip2格式的压缩包
tar -cvfj archive.tar.bz2 dir1
# 解压一个bzip2格式的压缩包
tar -xvfj archive.tar.bz2
# 创建一个gzip格式的压缩包
tar -cvfz archive.tar.gz dir1
# 解压一个gzip格式的压缩包
tar -xvfz archive.tar.gz
# 创建一个zip格式的压缩包
zip file1.zip file1
# 将几个文件和目录同时压缩成一个zip格式的压缩包
zip -r file1.zip file1 file2 dir1
# 解压一个zip格式压缩包
unzip file1.zip
```
#### 七、查看文件
```
# 从第一个字节开始正向查看文件的内容
cat file1
# 从最后一行开始反向查看一个文件的内容
tac file1
# 查看一个长文件的内容
more file1
# 类似于 ‘more’ 命令，但是它允许在文件中和正向操作一样的反向操作
less file1
# 查看一个文件的前两行
head -2 file1
# 查看一个文件的最后两行
tail -2 file1
# 实时查看被添加到一个文件中的内容
tail -f /var/log/messages
```