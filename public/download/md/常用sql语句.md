整理了下mysql常用的函数
#### 一、数字函数
```
# 返回绝对值
abs(num)
# 返回不大于num的最大整数
floor(num)
# 返回不小于num的最小整数
ceiling(num)
# 返回四舍五入的整数
round(num)
```
#### 二、字符串函数
```
# 字符串替换
replace(字段,查询的值,替换成的值)
例如：update result set arrive = replace(arrive ,’2017-10-27’ ,’2017-10-26’) where rid = 1;
# 字符串连接，中间没有连接符
concat(str1,str2)
例如：select group_concat(id) from table1 # 将table1表的id字段用逗号连接起来
# 字符串连接，用指定连接符连接
concat_ws(separator,str1,str2)
# 字符串连接，用指定连接符连接
group_concat(str1,separator,str2)
# 字符串去除特殊字符
trim(field)
# 字符串长度
length()
# 返回字符串最左len个字符
left(str,len)
# 返回字符串最右len个字符
right(str,len)
# 返回字符串从pos位置开始的所有字符
substring(str,pos)
# 翻转字符串
reverse(str)
# 返回子串在字符串中第一次出现的位置
instr(str,substr)
```
#### 三、日期时间函数
```
# 时间戳转换成格式化时间
from_unixtime(1234567890, ‘%Y-%m-%d %H:%i:%S’)
# 格式化时间转换成时间戳
unix_timestamp(‘2006-11-04 12:23:00’)
```
#### 四、聚合函数
```
# 返回指定列的平均值
AVG(col)
# 返回指定列中非NULL值的个数
COUNT(col)
# 返回指定列的最小值
min(col)
# 返回指定列的最大值
max(col)
# 返回指定列的所有值之和
sum(col)
# 返回由属于一组的列值连接组合而成的结果
group_concat(col)
```
#### 五、流程控制函数
```
# 如果testN是真，则返回resultN,否则返回default
case when[test1] then [result1] …else [default] end
# 如果test和valN相等，则返回resultN，否则返回default
case [test] when[val1] then [result] …else [default] end
# 如果test是真，则返回t，否则返回f
if(test,t,f)
# 如果arg1不是空，返回arg1，否则返回arg2
ifnull(arg1,arg2)
#  如果arg1=arg2 返回null; 否则返回arg1
nullif(arg1,arg2)
# 多分支流程
case [] when [] then [] when [] then [] when [] then [] else [] end

CASE [expression to be evaluated]

WHEN [val 1] THEN [result 1]

WHEN [val 2] THEN [result 2]

WHEN [val 3] THEN [result 3]

……

WHEN [val n] THEN [result n]

ELSE [default result]

END
```
#### 六、加密函数
```
# 简单加密
md5()、sha()、sha1()
# 安全加密
aes_encrypt(str,key_str)、aes_decrypt(crypt_str,key_str)
# 密码加密
password(str) 单向不可逆
```
#### 七、系统信息函数
```
# 返回最后插入的记录ID
last_insert_id()
# 返回当前数据库名
database()
# 返回当前客户的连接id
connection_id()
# 返回当前登录用户名
user() 或 system_user()
# 返回mysql服务器的版本
version()
# 将表达式expr重复运行count次
benchmark(count,expr)
# 返回最后一个select查询进行检索的总行数
found_rows()
```