
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
  /*如果用户没有通过身份验证，页面跳转至登陆页面*/
  session_start();
  if(!isset($_SESSION['username'])/* && $_SESSION['islogin']===1)*/){
	  echo "<script language='javascript'>alert('您尚未登录，请先登录！');window.location='../../index.html'</script>";
      /*header("location:../fwst8_summercamp/staff.html");*/
	  
  }
  if($_SESSION['power']!=0){
	  echo "<script language='javascript'>alert('您的权限不够，请先进行管理员登录！');window.location='../../index.html'</script>";
  }
?>
