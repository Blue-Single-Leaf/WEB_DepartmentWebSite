
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<?php
session_start();
header('content-type:text/html;charset=utf-8');
$mysqli=new mysqli('localhost','******','******','******');
if($mysqli->errno){
	die('Connect Error'.$mysqli->error);
}
$mysqli->set_charset('UTF8');
$username=$_POST['username'];
$password=$_POST['password'];


 $sql = "select * from user where username = '$username' and password = '$password'";  
/*$mysqli_stmt=$mysqli->prepare($sql);
@$mysqli_stmt->bind_param('ss',$username,$password);
if($mysqli_stmt->execute()){
	$mysqli_stmt->store_result();
	if($mysqli_stmt->num_rows>0){*/
	$query = $mysqli->query($sql);
	$result=$query->fetch_array();
if($query && $query->num_rows>0){
		$_SESSION['username']=$username;
		$_SESSION['password']=$password;
		$_SESSION['power']=$result['power'];
		
		echo "<script language='javascript'>;window.location.href='share.article.php';</script>";
		/*header("location:admin.index.php");*/
	}else{
	      echo "<script language='javascript'>alert('用户名或密码错误');history.back()</script>";
		  /*echo '<br/>';*/
	     }



?>
<body>
</body>
</html>
