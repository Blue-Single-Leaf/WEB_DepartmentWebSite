<?php
   require_once('../../conn/connect.php'); 
   include('checkID2.php');
?>
<?php
//1传入页码
$id=$_GET['id'];

$sql = "SELECT * FROM article where id = $id";
$query = $mysqli->query($sql);
$result=$query->fetch_array();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>电子工程系</title>
<link rel="stylesheet" type="text/css" href="../../css/self_style.css" />
<link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'>
<!-- jQuery file -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
var $ = jQuery.noConflict();
$(function() {
$('#tabsmenu').tabify();
$(".toggle_container").hide(); 
$(".trigger").click(function(){
	$(this).toggleClass("active").next().slideToggle("slow");
	return false;
});
});

function confir(){
	if(confirm("你确定删除文章？")){
		return true;
	}
	else {
		return false;
	}
	
}

function check(form){
	if (form.title.value==""){
		alert("标题不能为空！");form.title.focus();return false;
	}
	if (form.author.value==""){
		alert("作者不能为空！");form.author.focus();return false;
	}
	if (form.description.value==""){
		alert("简介不能为空！");form.description.focus();return false;
	}
}
	
</script>
</head>
<body>
<div id="panelwrap">
  	
	<div class="header">
    <div class="title">个人中心</div>
    
    <div class="header_right"> <span id="welcome">welcome&nbsp;&nbsp;<font id="un"><?php echo $_SESSION['username'];?></font>&nbsp;&nbsp;<a href="changpwd.php" class="settings">修改密码</a></span> </div>
    
    <div class="menu">
    <ul>
    <li><a href="#manage" class="selected">管理文章</a></li>
    <li><a href="#add">添加文章</a></li>
    <li><a href="../../test/article/article.list.php">文章列表</a></li>
    <li><a href="logout.php">退出</a></li>
    </ul>
    </div>
    
    </div>
    
    <div class="submenu"></div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             

<div class="submenu"><h2><a name="add">修改文章</a></h2></div>
    <div id="tab1" class="tabcontent">
    
        <form id="form1" name="form1" method="post" action="article.modify.handle.php" enctype="multipart/form-data">
        <div class="yon">是否公开：&nbsp;&nbsp;<input type="radio" name="self" value="0" <?php if($result['self']==0) echo 'checked';?> />公开发表&nbsp;&nbsp;<input name="self" type="radio" value="1" <?php if($result['self']==1) echo 'checked';?>/>自己欣赏</div>
        <div class="form">
            
            <div class="form_row">
            <label>标&nbsp;&nbsp;题:</label>
            <input type="text" class="form_input" name="title" id="title" value="<?php echo $result['title'];?>"/>
            </div>
             
            <div class="form_row">
            <label>作&nbsp;&nbsp;者:</label>
            <input type="text" class="form_input" name="author" id="author" value="<?php echo $result['author'];?>" />
            </div>
            
             <div class="form_row">
            <label>内&nbsp;容&nbsp;简&nbsp;介:<br/><br/>(拉动右下角可<br/>扩展文本框)</label>
            <textarea class="form_textarea" name="description" id="description" ><?php echo $result['description'];?></textarea>
            </div>
            
            <div class="form_row">
            请选择附件
			 <input type="file" name="myfile" class="view" />
			 <input type="submit" class="form_submit" value="Submit" onclick="return check(form1)" />
             <br/>&nbsp;&nbsp;（可选）
            </div> <input type="hidden" value="<?php echo $id;?>" name="article_id" />
            <div class="clear"></div>
        </div>
        </form>
    </div> 
      
     </div>
     </div><!-- end of right content-->
                     
      <div class="sidebar" id="sidebar">
     <h2><a href="self_article.php">文章</a></h2>
    
        <ul>
            <li><a href="self_article.php?a=2&l=1">文章列表</a></li>
            <li><a href="self_article.php">文章管理</a></li>
            <li><a href="#">其他</a></li>
        </ul>   
        
    <h2><a href="self_program.php">程序</a></h2>
    
        <ul>
            <li><a onclick="return pagelist()" style="cursor:pointer">程序列表</a></li>
            <li><a onclick="return org()" style="cursor:pointer" >程序管理</a></li>
            <li><a href="#">其他</a></li>
        </ul> 
        
   <h2><a href="self_app.php">软件</a></h2>
    
        <ul>
            <li><a href="self_app.php?l=1&a=2">软件列表</a></li>
            <li><a href="self_app.php">软件管理</a></li>
            <li><a href="#">其他</a></li>
        </ul>  
         
    <h2><a href="picture.php">图片</a></h2> 
        <ul>
            <li><a href="#">图片列表</a></li>
            <li><a href="#">图片管理</a></li>
            <li><a href="#">其他</a></li>
        </ul>         
    
    </div>             
    
    <div class="clear"></div>
    </div> <!--end of center_content-->
    
    <div class="footer">吉林大学南湖校区</div>

</div>

    	
</body>
</html>
