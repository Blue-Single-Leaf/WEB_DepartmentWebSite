<?php require_once('../../conn/connect.php'); 
	$id=$_GET['id'];
	$type=$_GET['type'];
	if($type=="article"){
		$table="article";
	}
	else if($type=="program"){
		$table="program";
	}
	else if($type=="appfile"){
		$table="appfile";
	}
	else {
		$table="picture";
	}
	$sql="select * from $table where id = $id";
	$query=$mysqli->query($sql);
	$result=$query->fetch_array();
	$path=$result['path'];
	$filename1=$result['filename'];
	$path=$result['path'];
	$filename=iconv("utf-8","gb2312//IGNORE",$filename1);
$file_path=$path.$filename;
if(!file_exists($file_path)){//检测文件是否存在
echo"文件不存在！";
die();
}
$filesize=filesize($file_path);
$file=fopen("$file_path","r");
header("Content-Type: application/octet-stream");
header("Accept-Ranges: bytes");
header("Content-Length: ".$filesize);
header("Content-Disposition: attachment; filename=".$filename);
$buffer=1024;
//来个文件字节计数器
$count=0;
while(!feof($file)&&($filesize-$count>0)){
$data=fread($file,$buffer);
$count+=$data;//计数
echo $data;//传数据给浏览器端
}
/*echo fread($file,filesize("$file_path"));*/
fclose($file);



/*require('ddxc.php');  
$name="2.jpg";
$name=iconv('utf-8','gb2312',"$name");
$file = $_SERVER['DOCUMENT_ROOT']."/My Sites/test/uploads/".$name;
echo $file;*/

  

/*$obj = new FileDownload();  

//$flag = $obj->download($file, $name);  

$flag = $obj->download($file, $name, true); // 断点续传  

  

if(!$flag){  

    echo 'file not exists';  

}  

?> */
?>
