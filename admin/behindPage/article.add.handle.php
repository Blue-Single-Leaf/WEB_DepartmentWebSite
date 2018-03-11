<?php
	session_start();
	if (!isset($_SESSION['username'])){
		echo "<script language='javascript'>alert('你尚未登录，请先登录！');window.history.back();</script>";
	}
	if ($_FILES['myfile']['error']>0){
		echo "上传错误，错误原因：".$_FILES['myfile']['error'];
	}
	else{
		$sort="docx";
		$tmp_name=$_FILES['myfile']['tmp_name'];
		$filename=$_FILES['myfile']['name'];
		$str=explode(".",$filename);
		
		if($str['1']!=$sort){
			echo "<script language='javascript'>alert('上传的文件格式不对！\\n请上传Word文档！');window.history.back();</script>";
		}
		else {
		$type="Word";
	require_once('../../conn/connect.php');
	//把传递过来的信息入库,在入库之前对所有的信息进行校验。
	/*if(!(isset($_POST['title'])&&(!empty($_POST['title'])))){
		echo "<script>alert('标题不能为空');window.location.href='admin.index.php';</script>";
	}*/
	
	$title = $_POST['title'];
	$author = $_POST['author'];
	$description =$_POST['description'];
	/*$content = $_POST['content'];*/
	$posttime=date("Y-m-d");
	$self=$_POST['self'];
	$poster=$_SESSION['username'];
	
		$size=$_FILES['myfile']['size'];
		
		$filename=iconv('utf-8','gb2312',$_FILES['myfile']['name']);
		$path=$_SERVER['DOCUMENT_ROOT'].'/DepartmentWeb/uploads/article/';
		move_uploaded_file($tmp_name,$path.$filename);
		$filename=$_FILES['myfile']['name'];
		/*$path=$_SERVER['DOCUMENT_ROOT'].'/DepartmentWeb/uploads/';*/
	
	$insertsql = "insert into article(title, author, description, posttime, poster,filename,self,path, type, size) values('$title', '$author', '$description', '$posttime','$poster','$filename','$self', '$path','$type','$size')";
	$query = $mysqli->query($insertsql);
	if($query){
		$mysqli->close();
		echo "<script>alert('发布文章成功！');window.history.back();</script>";
	}
	else{
		echo "<script>alert('发布文章失败！');window.history.back();</script>";
	}
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