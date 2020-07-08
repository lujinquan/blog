
如果需要把mysql数据库表结构导出来，除了导出成sql、excel、txt、xml等等格式以外，怎么导出成markdown文件格式呢？比如当我们编写数据库数据字典的时候、或者是在程序中浏览的时候可以嵌入markdown代码可以更方便快捷地浏览和使用。

#### 一、创建markdown.html

创建这个html文件是为了用网页表单做交互，代码如下：

```
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
	</head>
	<body>
		<form>
		主机：<input type="text" name="host"><br>
		端口：<input type="text" name="port"><br>
		用户名：<input type="text" name="user"><br>
		数据库名：<input type="text" name="dbname"><br>
		密码：<input type="text" name="password"><br>
		<button type="button" id="export_to_markdown" value="1">导出成markdown文件</button>
		</form>
	</body>
	<script src="https://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
	<script type="text/javascript">
	$('#export_to_markdown').click(function(){
		var host = $('input[name="host"]').val();
		var port = $('input[name="port"]').val();
		var user = $('input[name="user"]').val();
		var dbname = $('input[name="dbname"]').val();
		var password = $('input[name="password"]').val();
		console.log(host);
		$.get('./markdown.php', {'host':host,'port':port,'user':user,'dbname':dbname,'password':password}, function(res) {
			var res = JSON.parse(res);
		    if (res.code == 1) {
		    	document.location.href = res.url;
		    }else{
		    	alert(res.msg);
		    }
		});
	})
	</script>
</html>
```
#### 二、创建php文件处理

代码如下：

```
<?php
function getMd($servername, $username, $password, $dbname ,$port)
{
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
    	//echo 1;exit;
    	echo json_encode(array('code'=>0,'msg'=>'数据库连接失败！'));exit;
    }

    $result = $conn->query("SHOW TABLE STATUS");
    if ($result->num_rows > 0) {
        $mark = '';
        while ($row = $result->fetch_assoc()) {
        	$mark .= '### ' . $row['Name'] . ' ' . $row['Comment'] . PHP_EOL;
        	$mark .= '|  编号  |  中文名  |  字段名称  |  数据类型  |  主键  |  外键  |  是否允许为空  |  备注  |' . PHP_EOL;
            $mark .= '|: ------ :|: ------ :|: ------ :|: ------ :|: ------ :|: ------ :|: ------ :|: ------ :|' . PHP_EOL;
        	//var_dump($row);exit;
            //$table_name = $row["Tables_in_{$dbname}"];
            $obj = $conn->query("show full columns from {$row['Name']}");

            $k =  1;
            while ($data = $obj->fetch_assoc()) {

                $mark .= '| ' . $k .' | ' . $data['Comment'] . ' | ' . $data['Field'] . ' | '. $data['Type'] . ' | ' . $data['Key'] . ' |  | ' . $data['Null'] . ' |  |'  . PHP_EOL;
                $k++;
            }
            // 索引 
            $mark .= PHP_EOL;
            $mark .= '### 索引' . PHP_EOL;
            $mark .= PHP_EOL;
            $mark .= '|  编号  |  名  |  字段  |  索引类型  |  索引方法  |' . PHP_EOL;
            $mark .= '|: ------ :|: ------ :|: ------ :|: ------ :|: ------ :|' . PHP_EOL;
            $mark .= '|   1 |    |    |    |    |' . PHP_EOL;
            // 引擎
            $mark .= PHP_EOL;
            $mark .= '### 引擎' . PHP_EOL;
            $mark .= PHP_EOL;
            $mark .= '|  引擎  |  排序规则  |  字符集  |  数据目录  |' . PHP_EOL;
            $mark .= '|: ------ :|: ------ :|: ------ :|: ------ :|' . PHP_EOL;
            $mark .= '| '.$row['Engine'].' | '.$row['Collation'].' | '.$row['Collation'].' |'.$row['Collation'].' |' . PHP_EOL;
            $mark .= PHP_EOL;
        }
        file_put_contents('markdown.md', $mark);
    }
    $conn->close();
    echo json_encode(array('code'=>1,'msg'=>'导出成功！','url'=>'./markdown.md'));
    exit;
}

$params = $_GET;
//var_dump($params);exit;
if($params){
	$servername = empty($params['host']) ? "" : trim($params['host']);
	if(!$servername){
		echo json_encode(array('code'=>0,'msg'=>'请填写主机'));exit;
	}
	$username = empty($params['user']) ? "" : trim($params['user']);
	if(!$username){
		echo json_encode(array('code'=>0,'msg'=>'请填写用户名'));exit;
	}
	$password = empty($params['password']) ? "" : $params['password'];
	if(!$password){
		echo json_encode(array('code'=>0,'msg'=>'请填写密码'));exit;
	}
	$dbname = empty($params['dbname']) ? "" : $params['dbname'];
	if(!$dbname){
		echo json_encode(array('code'=>0,'msg'=>'请填写数据库名'));exit;
	}
	$port = empty($params['port']) ? "" : $params['port'];
	if(!$port){
		echo json_encode(array('code'=>0,'msg'=>'请填写端口号'));exit;
	}
	getMd($servername, $username, $password, $dbname, $port);
}
```
创建空markdown.md文件，并赋予写权限用于导出

#### 三、浏览器打开html文件

正确填写数据库配置信息点击导出即可
