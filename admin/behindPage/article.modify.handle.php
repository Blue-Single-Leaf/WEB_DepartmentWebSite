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
	$id=$_POST['article_id'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$description =$_POST['description'];
	/*$content = $_POST['content'];*/
	
	$self=$_POST['self'];
	
	if(!empty($_FILES['myfile']['tmp_name'])){
		$sort="docx";
		$tmp_name=$_FILES['myfile']['tmp_name'];
		$name=$_FILES['myfile']['name'];
		$str=explode(".",$name);
		
		if($str['1']!=$sort){
			echo "<script language='javascript'>alert('上传的文件格式不对！\\n请上传Word文档！');window.history.back();</script>";
		}
		else {
		$type="Word";
		}
		$size1=$_FILES['myfile']['size'];
		$size="$size1"/'1024';
		$size=round($size,2)."KB";
		$name=iconv('utf-8','gb2312',$_FILES['myfile']['name']);
		$path=$_SERVER['DOCUMENT_ROOT'].'/DepartmentWeb/uploads/article/';
		move_uploaded_file($tmp_name,$path.$name);
		$name=$_FILES['myfile']['name'];
		/*$path=$_SERVER['DOCUMENT_ROOT'].'/DepartmentWeb/uploads/';*/
	
	$modifysql = "update  article set title = '$title',author = '$author', description = '$description', self = '$self', path = '$path',  type = '$type', size = '$size' where id='$id'" ;
	}	

	else {
			$modifysql="update  article set title = '$title', author = '$author', description = '$description', self = '$self' where id='$id'";
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