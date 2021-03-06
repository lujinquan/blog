Linux中常使用cp命令复制文件或目录（夹），下面来深度探讨下。
#### 一、简单查看下cp的帮助信息。

```
cp --help
```

常用的指令有

```
cp -a 目录 目标目录
```
说明： 此选项通常在复制目录时使用，它保留链接、文件属性，并复制目录下的所有内容，包括子目录和所有文件，这个操作对象是【目录】。对链接不清晰的可以查看[Linux链接](href=&quot;http://www.mylucas.com.cn&quot;)。

举例说明：cp -a /test1 /test2
将/test1目录（包含子目录和所有文件）复制到/test2目录，
1、如果/test2目录不存在，会自动创建/test2目录，并会将/test1（包含子目录和所有文件）复制放到/test2目录下。
2、如果/test2目录已存在，则会将test1目录（包含子目录和所有文件）复制放到/test2目录下形成/test2/test1目录。
提示：/test1/ 和 /test1 是一样的，都是代表根目录下的test1目录。


```
cp -r 目录 目标目录
```
说明： 将一个目录下的子目录及所有文件复制，这个操作对象是【目录】。操作目录的时候同上。



```
cp -a 目录/* 新目录
```

说明： 将一个目录下的子目录及所有文件复制，这个操作对象是【目录下的子目录和文件】。

举例说明：cp -a /test1/* /test2
将/test1目录（包含子目录和所有文件）复制到/test2目录，
1、如果/test2目录不存在，会报错/test2目录不存在。
2、如果/test2目录已存在，则会将/test1（包含子目录和所有文件）复制放到/test2目录下，如果/test2目录下有其他文件不会被覆盖，如果/test2目录下有同名文件会提示是否覆盖，yes或no自行选择。
提示：如果/test1目录下的文件非常多会报错。


```
cp -a 目录/. 新目录
```

说明： 将一个目录下的子目录及所有文件复制，这个操作对象是【目录下的子目录和文件】。

举例说明：cp -a /test1/* /test2
将/test1目录（包含子目录和所有文件）复制到/test2目录，
1、如果/test2目录不存在，会自动创建/test2目录，并会将/test1（包含子目录和所有文件）复制放到/test2目录下。
2、如果/test2目录已存在，则会将/test1（包含子目录和所有文件）复制放到/test2目录下，如果/test2目录下有其他文件不会被覆盖，如果/test2目录下有同名文件会提示是否覆盖，y或n自行选择，加入-f指令可以在覆盖目标文件的时候不提示直接覆盖。
提示：不会出现上述目录下的文件过多报错的情况。

```
# 可能用到的命令
# 查看当前文件夹下的文件个数
ls -lR|grep "^-"|wc -l
# 删除当前目录下的所有子目录和子文件
rm -rf *
```

总结：
1、如果想搬运一个目录（递归子目录）到另一个目录，为了排除干扰，推荐使用例如： cp -af /目录/. /新目录
2、如果搬运一个目录到另一个目录（目标目录不存在），推荐使用： cp -a 目录 新目录
3、cp -a 和 cp -r 在操作目录下的文件时效果是一样的