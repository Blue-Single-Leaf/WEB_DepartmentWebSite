<?php
session_start();
require_once('../../conn/connect.php');
$name=$_SESSION['username'];
$pwd = $_POST['oldpassword'];
$pwd1 = $_POST['password1'];
$pwd2 = $_POST['password2'];
$sql = "select * from user where password='$pwd' and username='$name'";
$query = $mysqli->query($sql);
if($query && $query->num_rows>0){
if ($pwd1==$pwd2) {
$sql="update user set password='$pwd2' where username='".$_SESSION['username']."'";
$query = $mysqli->query($sql);
if ($query ) {
echo "恭喜，密码修改成功！<br/>2秒后返回个人中心！";
echo "<meta http-equiv='refresh' content='2;url=self_article.php'>";
}
}
else {
echo "两次输入的新密码不同，请重新输入!";
echo "<meta http-equiv='refresh' content='1;url=changepwd.php'>";
}
}
else {
echo "旧密码不正确，请重新输入!";
echo "<meta http-equiv='refresh' content='1;url=changepwd.php'>";
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