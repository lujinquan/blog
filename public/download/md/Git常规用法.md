Git 是一个开源的分布式版本控制系统,用于敏捷高效地处理任何或小或大的项目，常用操作如下。

#### 一、本地创建git仓库，并关联远程

1、初始化 `git init`

2、创建于远程的关联 `git remote add orgin git@github:xxx/xxx.git`

3、克隆远程的`git clone git@github:xxx/xxx.git`，通常如果没有添加公钥，会提示如下错误）

[点击查看效果图](href="https://www.mylucas.com/ueditor/php/upload/image/20190725/1564025414.png")

4、以下操作也可以在命令行中键入： `cd ~/.ssh`  然后 `ls` 再 `subl id_rsa.pub`

5、如果向远程push失败，可以依次键入以下代码，清除里面的内容
```
cd ~/.ssh
ls
subl known_hosts
```
6、在本地生成公钥执行生成公钥和私钥的命令：ssh-keygen  并按回车3下（为什么按三下，是因为有提示你是否需要设置密码，如果设置了每次使用Git都会用到密码，一般都是直接不写为空，直接回车就好了）。会在一个文件夹（windows默认在C:\Users\Administrator\.ssh\）里面生成一个私钥 id_rsa和一个公钥id_rsa.pub。（可执行start ~ 命令，生成的公私钥在 .ssh的文件夹里面，例如

[点击查看效果图](href="https://www.mylucas.com/ueditor/php/upload/image/20190725/1564025737.png")

7、将本地生成的公钥加入到远程github上

#### 二、git常规操作

1、添加 `git add`

2、提交 `git commit -m ''`

3、推送远程 `git push`

4、从远程获取更新 `git pull`

5、本地代码库更新 `git checkout .`

6、将远程代码强制覆盖到本地
```
git fetch --all
git reset --hard origin/master
git pull
```
7、查看当前关联的远程服务器 `git remote -v`

8、查看当前本地分支 `git branch`

9、查看远程和本地分支 `git branch -a`

[点击查看效果图](href="https://www.mylucas.com/ueditor/php/upload/image/20190725/1564026219.png")

10、克隆远程代码 `git clone git@github.com:xxx/xxx.git`

11、将远程的test分支检出到本地的ask分支 `git pull orgin test:test`

12、切换到test分支 `git checkout ask`

13、本地版本回退到b65sde版本 `git reset --hard b65sde`
#### 三、git小技巧
1、`ctrl + L` 清除屏幕

2、`git update-index --assume-unchanged 文件` 强制忽略文件在git status中不被检测到

3、`git log` 状态下如何退出？英文输入法下按 Q

4、`git reset HEAD <file>` 将文件恢复到上一个版本，通常用在添加文件git add误添加文件的时候
#### 四、git疑难解答
1、.gitignore文件如何正常使用？

在里面定义免检测规则后，如果文件本身在版本库中存在，那么先执行`git rm -r --cached .` 命令以便清除缓存，然后 在 `git add` 或者 `git commit` 的时候就不会被检测了（注意如果未被add 那么在`git add` 的时候就不会被检测到，如果已经add但是未被 commit 那么在`git commit`的时候就不会被检测到）
```
git rm -r --cached .
git add .
git commit -m "update gitignore"
```
2、如果出现这种警告问题，通常是windows换行符造成的

[点击查看效果图](href="https://www.mylucas.com/ueditor/php/upload/image/20190725/1564027356.png")

解决方式： `git config --global core.autocrlf false` 【增加该配置】