<?php 
	session_start();
	require_once('../../conn/connect.php');
	if(!isset($_SESSION['username'])){
		echo "<script language='javascript'>alert('您尚未登录，请先登录！');window.location.href='login.php';</script>";
	}
	$desc=$_POST['description'];
	$self=$_POST['self'];
	$filename=$_FILES['myfile']['name'];
	$name=$_POST['AppName'];
	$type=$_POST['table'];
	
	if($_FILES['myfile']['error']>0){
		echo "上传文件出错!<br/>出错原因：".$_FILES['myfile']['error'];
	}
	else {
		/*$filename=$_FILES['myfile']['name'];*/
		$tmp_name=$_FILES['myfile']['tmp_name'];
		$size=$_FILES['myfile']['size'];
		/*$size="$size1"/'1024'."KB";*/
		$filename=iconv('utf-8','gb2312',$_FILES['myfile']['name']);
		if($type=="appfile"){
		$path='../../uploads/app/';
		}
		else{
			$path='../../uploads/exe/';
		}
		move_uploaded_file($tmp_name,$path.$filename);
		$filename=$_FILES['myfile']['name'];
		if($type=="appfile"){
		$path='../../uploads/app/';
		}
		else{
			$path='../../uploads/exe/';
		}
		$date=date("Y-m-d");
		$poster=$_SESSION['username'];
		if($type=="appfile"){
	$insertsql = "insert into appfile (name,description,poster,filename,posttime,path,self,size) values('$name', '$desc', '$poster','$filename','$date', '$path','$self','$size')";
		}
		if ($type=="program"){
			$maker=$_POST['maker'];
			$insertsql = "insert into program (name,maker,description,poster,filename,posttime,path,self,size) values('$name','$maker', '$desc', '$poster','$filename','$date', '$path','$self','$size')";
		}
			
	$query = $mysqli->query($insertsql);
	if($query){
		echo "<script>alert('发布成功！');window.history.back()</script>";
	}
	else{
		echo "<script>alert('发布失败！');window.history.back()</script>";
	}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
</body>
</html>