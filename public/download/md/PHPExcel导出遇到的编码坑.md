
PHPEXCEL是php导入导出excel的常用插件，当导出并保存到服务器的时候需要注意编码问题，windows默认使用GBK编码，linux默认使用UTF-8编码，否则会出现无法导出和下载的问题。

#### 一、导出excel到浏览器中

代码如下：
```
header("Pragma: public");
header("Expires: 0");
header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
header("Content-Type:application/force-download");
header("Content-Type:application/vnd.ms-execl");
header("Content-Type:application/octet-stream");
header("Content-Type:application/download");
header('Content-Disposition:attachment;filename=' . $filename);
header("Content-Transfer-Encoding:binary");
$objWriter->save('php://output');
```

#### 二、导出到服务器中，通过ajax下载

后端代码如下：
```
// 先保存在服务器，然后返回文件路径【注意windows默认使用GBK编码，linux默认使用UTF-8编码】
if(strtoupper(substr(PHP_OS,0,3))==='WIN'){ //如果是windows服务器，则保存成GBK编码格式
      $filePath = './upload/excel/'.convertGBK($filename);
}else{ //如果不是，则保存成UTF-8格式
      $filePath = './upload/excel/'.convertUTF8($filename);
}
$objWriter->save($filePath);
$returnJson = [];
$returnJson['code'] = 1;
$returnJson['msg'] = '导出成功！';
$returnJson['data'] = '/upload/excel/'.$filename;
return json($returnJson); // 返回的文件名需要是以UTF-8编码
```
前端代码如下：
```
$.ajax({
	type:"post",// 请求方式
	url:"{:url('rent/export')}",
	async:true,// 同步异步
	dataType:"json",
	data :{'inst_id':inst,'owner_id':owner,'query_month':month},//这里是前台传到后台的数据
        //回调函数
	success:function(output){
		layer.msg(output.msg);
		if(output.code){ //成功则直接下载						
			document.location.href = output.data;
		}
	}
});
```