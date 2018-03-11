<?php
session_start();
  if(!isset($_SESSION['username'])/* && $_SESSION['islogin']===1)*/){
	  echo "<script language='javascript'>alert('您尚未登录，请先登录！');window.location='../../index.html'</script>";
      /*header("location:../fwst8_summercamp/staff.html");*/
	  
  }
?>
