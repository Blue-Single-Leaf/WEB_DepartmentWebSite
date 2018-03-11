<?php
	require_once('../../conn/connect.php');
	if(isset($_GET['id'])){
	$id = $_GET['id'];
	$sql="select * from picture where id = $id";
	$query1=$mysqli->query($sql);
	$result=$query1->fetch_array();
	$path=$result['path'];
	unlink($path);
	$deletesql = "delete from picture where id=$id";
	$query2 = $mysqli->query($deletesql);
	}
	if(isset($_GET['check'])){
		foreach($_POST['checkBoxs'] as $id){
			$sql="select * from picture where id = $id";
			$query1=$mysqli->query($sql);
			$result=$query1->fetch_array();
			$path=$result['path'];
			unlink($path);
			$deletesql = "delete from picture where id=$id";
			$query2 = $mysqli->query($deletesql);
		}
	}
	if($query1 and $query2){
		echo "<script>alert('删除图片成功');window.history.back();</script>";
	}else{
		echo "<script>alert('删除图片失败');window.history.back();</script>";
	}
?>