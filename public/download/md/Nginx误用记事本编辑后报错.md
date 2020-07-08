记录一次打开nginx.conf文件编辑保存后，nginx重启报错

1、查看错误日志发现
```
[emerg] 19256#1496:unknown directive “#” in xxxxxxxxxxxx/conf/nginx.conf:3。
```
2、分析发现conf文件用记事本打开编辑过，保存了bom头，才会造成报错。

3、将nginx.conf文件用sublime或其他软件打开用utf-8编码保存文件，重启即可。

> 提示：尽可能不用记事本编辑文本文件，记事本在保存文件的时候，会在文件头添加0xefbbbf（十六进制）的字符。