<?php
	session_start();
	if (!isset($_SESSION['username'])){
		echo "<script language='javascript'>alert('你尚未登录，请先登录！');window.location.href='../../frontPage/staff.php';</script>";
	}
	/*if ($_FILES['myfile']['error']>0){
		echo "上传错误，错误原因：".$_FILES['myfile']['error'];
	}*/
	
	require_once('../../conn/connect.php');
	//把传递过来的信息入库,在入库之前对所有的信息进行校验。
	/*if(!(isset($_POST['title'])&&(!empty($_POST['title'])))){
		echo "<script>alert('标题不能为空');window.location.href='admin.index.php';</script>";
	}*/
	$id=$_POST['obj_id'];
	$name = $_POST['title'];
	$table=$_POST['type'];
	$description =$_POST['description'];
	/*$content = $_POST['content'];*/
	
	$self=$_POST['self'];
	
	if(!empty($_FILES['myfile']['tmp_name'])){

		$tmp_name=$_FILES['myfile']['tmp_name'];
		$filename=$_FILES['myfile']['name'];
		
		
		
		
		$size1=$_FILES['myfile']['size'];
		$size="$size1"/'1024';
		$size=round($size,2)."KB";
		$filename=iconv('utf-8','gb2312',$_FILES['myfile']['name']);
		if($table=='appfile'){
		$path=$_SERVER['DOCUMENT_ROOT'].'/DepartmentWeb/uploads/app/';
		}
		else{
			$path=$_SERVER['DOCUMENT_ROOT'].'/DepartmentWeb/uploads/exe/';
		}
		move_uploaded_file($tmp_name,$path);
		$filename=$_FILES['myfile']['name'];
		/*$path=$_SERVER['DOCUMENT_ROOT'].'/DepartmentWeb/uploads/';*/
		if($table=='program'){
			$maker=$_POST['maker'];
	$modifysql = "update  program set name = '$name',maker='$maker', description = '$description', self = '$self', path = '$path',   size = '$size',filename='$filename' where id='$id'" ;
	}	else{
		$modifysql = "update  appfile set name = '$name', description = '$description', self = '$self', path = '$path',   size = '$size',filename='$filename' where id='$id'" ;
	}
	}
		

	else {
		if($table=="appfile"){
			$modifysql="update  appfile set name = '$name', description = '$description', self = '$self' where id='$id'";
		}
		else{
			$maker=$_POST['maker'];
			$modifysql="update  program set name = '$name', maker='$maker',description = '$description', self = '$self' where id='$id'";
		}
		}
	$query = $mysqli->query($modifysql);
	if($query){
		$mysqli->close();
		echo "<script>alert('修改文章成功！');window.history.back();</script>";
	}
	else{
		echo "<script>alert('修改文章失败！');window.history.back();</script>";
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