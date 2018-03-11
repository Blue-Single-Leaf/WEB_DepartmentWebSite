

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改密码</title>

	
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
	window.location="admin.index.php";
}
function input1(){
	if (form1.oldpassword.value=="请输入原来的密码"){
	form1.oldpassword.value="";
	}
	form.oldpassword.border="solid 1px blue";
}
</script>

</head>

<body>

       <div>
            <h4>修改密码</h4>
            <form  name="form1" action="deal_changepwd.php" method="post">
                <div>
                   <label>旧密码</label>
                    <input type="password" name="oldpassword" value="请输入原来的密码" onfocus="input1()" maxlength="30">
                    <label>新密码</label>
                    <input type="password" name="password1" maxlength="30">
                </div>
                <div class="form-group">
                    <label>确认密码</label>
                    <input type="password" name="password2" maxlength="30">
                    
                </div> 
           
            <div>
              <input type="submit" value="确定" onclick="return check(form1)"/>
              <input type="button" value="取消" onclick="cancel()"/>
              
            </div>
       </form>
     </div>
</body>
</html>