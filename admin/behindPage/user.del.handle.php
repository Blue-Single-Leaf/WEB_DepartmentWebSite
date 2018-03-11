<?php
	require_once('../../conn/connect.php');
	if(isset($_GET['id'])){
	$id = $_GET['id'];
	$deletesql = "delete from user where id=$id";
	$query2 = $mysqli->query($deletesql);
	}
	if(isset($_GET['check'])){
		foreach($_POST['checkBoxs'] as $id){
			$deletesql = "delete from appfile where id=$id";
			$query2 = $mysqli->query($deletesql);
		}
	}
	if( $query2){
		echo "<script>alert('删除用户成功');window.history.back();</script>";
	}else{
		echo "<script>alert('删除用户失败');window.history.back();</script>";
	}
?>