<?php
	require_once('../../conn/connect.php');
	$username=$_POST['username'];
	$pwd=$_POST['pwd2'];
	$sql="insert into user(username,password,power) values('$username','$pwd','2')";
	$query=$mysqli->query($sql);
	if($query){
		echo "添加用户成功！<br/><a href='Wopop.html'>立即登录</a>&nbsp;&nbsp;<a href='admin.index.php'>返回资源首页</a>";
	}
	else{
		echo $username;
		echo $pwd;
		echo $sql;
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