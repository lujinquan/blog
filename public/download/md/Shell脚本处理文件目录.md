场景如下：linux环境中，需要扫描某个目录及其子目录下的所有文件，对特定的文件类型和特定时间的文件做删除处理。
#### 一、sh脚本
1、创建sh脚本文件 `vi xx.sh`
```
#! /bin/bash

# set ff=unix

# 递归读取某文件夹
function readDir(){
#一般的写法是 for f in ls ./但是如果文件名中带空格，比如”A B” 那么虽然ls能正确列出，但是for却会把空格当成分隔符 将A，B分别赋给f，导致变成两个文件名研究发现问号？在文件名中也可以代表空格。因此可以这样写：for f in ls ./ | tr " " "\?" ,这种方法可行但只能正常显示文件名无法删除改文件或处理该文件
for file in ls $1
do
    # 如果是目录
    if [ -d $1”/“$file ] ; then
        if [ $file == “node_modules” ]
        then
            echo $file”此目录排除，不处理”
        elif [ $file == “dist” ]
        then
            echo $file”此目录排除，不处理”
        else
            # echo $1”/“$file”为目录”
            readDir $1”/“$file $2
        fi
    # 如果是文件
    else
        if [ $file == “replaceField.sh” ]
        then
            echo $file”此文件为sh文件，不处理”
        else
            #echo $1”/“$file “为文件”
            currFile=$1”/“$file

            #echo $currFile
            # 执行delFile函数
            delFile $currFile $2
        fi
    fi
    done
}

# 删除最后修改时间超过separatedDate的文件
function delFile(){
    # 获取1文件的后缀
    fileExtension=”${1##*.}”
    # 获取$1文件的最后修改时间，结果例如：Modify: 2019-08-11 17:09:54.000000000 +0800
    fileMtimeAttribute=stat "$1" | grep Modify
    # 字符串分隔，结果例如：2019-08-11 17:09:54
    fileMdate=${fileMtimeAttribute: 8: 19}
    # 将格式化的时间转换成时间戳格式
    fileMtime=date -d "$fileMdate" +%s
    # 设置参照时间（后面用作比较，如果大于此时间则执行后续操作）
    separatedDate=”2020-01-29 00:00:00”
    # 转换成时间戳格式
    separatedTime=date -d "$separatedDate" +%s
    # 如果是ddeal_gt_separatedTime_extension_php模式
    if [ $2 == “deal_gt_separatedTime_extension_php” ] ; then
        # 如果文件最后修改时间大于参照时间，且文件类型为php，直接删除
        if [ $fileMtime -gt $separatedTime ] && [ $fileExtension == ‘php’ ] ; then
            #echo “当前文件的时间：”$fileMdate”，参照时间：”$separatedDate
            rm -f $1
            echo “已移除文件：”$1
            # 移除文件后将记录写入到txt
            echo “已移除文件：”$1 >> /deal-wufun-log.txt

        fi
    # 如果是deal模式
    elif [ $2 == “deal_extension_php” ] ; then
        # 如果文件为php，直接删除
        if [ $fileExtension == ‘php’ ]; then
            #echo “当前文件的时间：”$fileMdate”，参照时间：”$separatedDate
            rm -f $1
            echo “已移除文件：”$1
            echo “已移除文件：”$1 >> /deal-wufun-log.txt
        fi
    else
        echo “后续功能待添加”
    fi

}

# 询问用户是否愿意执行此脚本
read -p “脚本制作人-Lucas，当前脚本用于：删除/data/xxx下所有最后修改时间大于2020-01-21 00:00:00的php文件，并删除/data/xxx下的uploads、hot、hotnews、ueditor下所有的php文件，如有疑问请联系Lucas，是否继续, y/n?” s
#echo $s
if [ ! -n “$s” ] ; then
    echo “您啥都没输入！已退出执行当前脚本！”
    exit
fi
if [ “$s” != “y” ] ; then
    echo “您输入了$s，已退出执行当前脚本！”
    exit
fi

# 解决这个问题，当然就要从单词分隔符着手。而bash中使用的是$IFS（Internal Field Separator）这个变量，内容为” \n\t”，先把IFS改成\n\b，处理完后再改成\n\t
SAVEIFS=$IFS
IFS=$(echo -en “\n\b”)

# 方案一：直接执行
echo -e “\n” >> /deal-wufun-log.txt
echo “执行时间：”$(date +”%Y-%m-%d %H:%M:%S”) >> /deal-wufun-log.txt

readDir “/data/xxx” “deal_gt_separatedTime_extension_php”
readDir “/data/xxx/uploads” “deal_extension_php”
readDir “/data/xxx/hot” “deal_extension_php”
readDir “/data/xxx/hotnews” “deal_extension_php”
readDir “/data/xxx/ueditor” “deal_extension_php”

echo -e “\n”
echo “运行完成！如需查看详细运行结果请执行命令，cat /deal-wufun-log.txt”
# # 方案二：询问同意后执行
# # 询问是否执行第一个脚本？
# read -p “1、是否需要删除/data/xxx下所有最后修改时间大于2020-01-21 00:00:00的php文件, y/n?” a
# if [ “$a” = “y” ] ; then
#     #read -p “请再次确认, y/n?” b
#     #if [ $b == “y” ] ; then
#         # 递归删除/usr/share/nginx/html/ph/application/user下的所有最后修改时间大于参照时间的php文件
#         readDir “/data/xxx” “deal_gt_separatedTime_extension_php”
#     #fi
# elif [ “$a” = “n” ] ; then
#     echo “您选择了no”
# else
#     echo “输入错误，请输入y或n”
# fi

# # 询问是否执行第二个脚本？
# read -p “2、是否需要删除/data/xxx/uploads下所有的php文件, y/n?” c
# if [ “$c” = “y” ] ; then
#     # 递归删除/usr/share/nginx/html/ph/application/user下的所有类型为php的文件
#     readDir “/data/xxx/uploads” “deal_extension_php”
#     readDir “/data/xxx/hot” “deal_extension_php”
#     readDir “/data/xxx/hotnews” “deal_extension_php”
#     readDir “/data/xxx/ueditor” “deal_extension_php”
# elif [ “$c” = “n” ] ; then
#     echo “您选择了no”
# else
#     echo “输入错误，请输入y或n”
# fi

IFS=$SAVEIFS
IFS=$(echo -en “ \n\t”)

exit

```
> 提示：sh脚本在编辑后可能会出现编码问题

使用技巧
```
# 文档编辑后退出的命令模式下，查看文件格式
set ff
# 执行完上述命令后可以看到信息 fileformat=dos 或 fileformat=unix
# 修改文件格式为unix
set ff=unix
# 然后保存退出
wq
```

#### 二、创建日志文件

```
# 创建deal-wufun-log.txt，用来接收程序执行写入的日志
touch deal-wufun-log.txt
```
#### 三、执行sh脚本
```
sh xx.sh
```
