<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户注册</title>
<script language="javascript" type="text/javascript">
function check(form){
	if(form.username.value==""){
		alert("用户名不能为空！");form.username.focus();return false;
	}
	if(form.pwd.value==""){
		alert("密码不能为空！");form.pwd.focus();return false;
	}
	if(form.pwd2.value==""){
		alert("确认密码不能为空！");form.pwd2.focus();return false;
	}
	if(form.pwd.value!=form.pwd2.value){
		alert("两次输入的密码不相同！");form.pwd2.focus();return false;
	}
		
}
function user(){
	if(form2.username.value=="请输入用户名"){
		form2.username.value="";
	}
}
	

</script>
</head>

<body>
<div>
<form name="form2" id="form2" method="post" action="deal_register.php">
	<table>
    	<tr>
        	<td colspan="2">请填写下列必要信息</td>
        </tr>
        <tr>
        	<td>用户名：</td>
            <td><input type="text" id="username" name="username" onfocus="user()" value="请输入用户名" /></td>
        </tr>
        <tr>
        	<td>密码：</td>
            <td><input type="password" name="pwd" id="pwd" /></td>
        </tr>
        <tr>
        	<td>密码确认：</td>
            <td><input type="password" name="pwd2" id="pwd2" /></td>
        </tr>
        <tr>
        	<td>请输入验证码:</td>
            <td><input type="text" name="verify" id="verify" /></td>
        </tr>
        <tr>
        	
            <td colspan="2"><input type="submit" name="submit" value="提交" onclick="return check(form2)" />&nbsp;&nbsp;<input type="reset" value="重填" name="reset" /></td>
        </tr>

    
    
    </table>
</form>
</div>
</body>
</html>