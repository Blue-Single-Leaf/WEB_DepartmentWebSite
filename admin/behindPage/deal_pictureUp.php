<?php 
session_start();
	header("Content-type:text/html;charset=utf-8");
	if (!isset($_SESSION['username'])){
		echo "<script language='javascript'>alert('你尚未登录，请先登录！');window.history.back();</script>";
	}
	if ($_FILES['myfile']['error']>0){
		echo "上传错误，错误原因：".$_FILES['myfile']['error'];
	}
	else{
		$sort=array('jpg','jpeg','png','gif');
		$type="";
		$tmp_name=$_FILES['myfile']['tmp_name'];
		$filename=$_FILES['myfile']['name'];
		$str=explode(".",$filename);
		for($i=0;$i<count($str);$i++){
		if(strtolower(end($str))==$sort["$i"]){
			$type=strtolower(end($str));
			break;
		}
		}
		if($type==""){
		echo "<script language='javascript'>alert('上传的图片格式不对！\\n请上传jpg,jpeg,png,gif格式的图片！');window.history.back();</script>";
		}
		else{
		
	require_once('../../conn/connect.php');
	//把传递过来的信息入库,在入库之前对所有的信息进行校验。
	/*if(!(isset($_POST['title'])&&(!empty($_POST['title'])))){
		echo "<script>alert('标题不能为空');window.location.href='admin.index.php';</script>";
	}*/
	
	
	
	$description =$_POST['description'];
	/*$content = $_POST['content'];*/
	$dateline=date("Y-m-d");
	$self=$_POST['self'];
	$poster=$_SESSION['username'];
	
		$size=$_FILES['myfile']['size'];
		
		$filename=iconv('utf-8','gb2312//IGNORE',$_FILES['myfile']['name']);
		$path='../../uploads/picture/';
		move_uploaded_file($tmp_name,$path.$filename);
		$filename=$_FILES['myfile']['name'];
		/*$path=$_SERVER['DOCUMENT_ROOT'].'/DepartmentWeb/uploads/';*/
	
	$insertsql = "insert into picture(  description, date, poster,filename,self,path, type, size) values( '$description', '$dateline','$poster','$filename','$self', '$path','$type','$size')";
	$query = $mysqli->query($insertsql);
	if($query){
		$mysqli->close();
		echo "<script>alert('添加图片成功！');window.history.back();</script>";
	}
	else{
		echo "<script>alert('添加图片失败！');window.history.back();</script>";
	}
	}	
	}




?>