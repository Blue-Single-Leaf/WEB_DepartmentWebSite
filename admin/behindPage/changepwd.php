<?php 
session_start();
	if (!isset($_SESSION['username'])){
		echo "<script language='javascript'>alert('你尚未登录，请先登录！');window.location.href='../../frontPage/staff.php';</script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<link rel="stylesheet" type="text/css" href="../../css/changepwd_style.css">
<script language="javascript" type="text/javascript">

function check(form){
	if (form.oldpassword.value==""){
		alert("请输入旧密码！");form.oldpassword.focus();return false;
	}
	else if (form.password1.value==""){
		alert("请输入新密码！");form.password1.focus();return false;
	}
	else if (form.password2.value==""){
		alert("请输入确认密码！");form.password2.focus();return false;
	}
    
	else {
		if(confirm("你确定修改密码？")){
		return true;
	}
	else {
		return false;
	}
	}
}
function cancel(){
	
	window.history.back();
}
function input1(){
	if (form1.oldpassword.value=="请输入原来的密码"){
	form1.oldpassword.value="";
	}
	form.oldpassword.border="solid 1px blue";
}
</script>

</head>
<body class="login" mycollectionplug="bind">
<div class="login_m">
<div class="login_logo">修改密码</div>
<div class="login_boder">

<div class="login_padding" id="login_model">
<form name="form1" id="form1" method="post" action="deal_changepwd.php">
  <h2>旧密码</h2>
  <label>
    <input type="password" id="oldpassword" name="oldpassword"  class="txt_input txt_input2" />
  </label>
  <h2>新密码</h2>
  <label>
    <input type="password" name="password1" id="password1" class="txt_input" />
  </label>
  <h2>确认密码</h2>
  <label>
    <input type="password" name="password2" id="password2" class="txt_input" />
  </label>
</div>

   <div class="rem_sub">
     <label>
      <input type="button" name="backbt" id="backbt" class="backbt" onclick="cancel()" value="返回" />
      <input type="submit" class="sub_button" name="button" id="button" onclick="return check(form1)" value="保存" />
     </label>
     </form>
   </div>
<!--login_padding  Sign up end-->
</div><!--login_boder end-->
</div><!--login_m end-->

</body></html>