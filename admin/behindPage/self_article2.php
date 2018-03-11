<?php
   require_once('../../conn/connect.php'); 
	include('checkID2.php');
?>
<?php
//1传入页码

if (!isset($_GET['p'])){
	$page = 1;
}else{
$page = $_GET['p'];}


//2根据页码取出数据:php对mysql的处理

$pagesize = 5;
$showpage = 5;
//获取数据总行数\
$poster=$_SESSION['username'];
$sql = "select id from article where poster = '$poster'";
$mysqli_result=$mysqli->query($sql);
$total = $mysqli_result->num_rows;
//计算总页数
$total_pages = ceil($total/$pagesize);
//3显示数据和分页条
$page_banner = "<div class='page'>";
//计算偏移量
$pageoffset = ($showpage-1)/2;
//初始化数据
$start = 1;
$end = $total_pages;


$sql = "SELECT * FROM article LIMIT ".($page-1)*$pagesize .",$pagesize";
$query = $mysqli->query($sql);
if($query && $query->num_rows>0){
		while($row = $query->fetch_assoc()){
			$data[] = $row;
		}
	}else{
		$data = array();
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panelo - Free Admin Template</title>
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
    <h2><a name="manage">文章管理列表</a></h2> 
                    
                    
<table id="rounded-corner">
    <thead>
    	<tr>
        	<th width="20px;"><input type="checkbox" name="allselect" onclick="selectall()" /></th> 
            <th width="40px;">编号</th>
            
            <th>标题</th>
            
            <th width="80px;">公开性</th>
            <th width="60px;">修改</th>
            <th width="60px;">删除</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="12">&nbsp;
            <div class="form_sub_buttons">
    <input class="button red" value="删除已选" type="submit" name="delsub" id="delsub" onclick="submit_confirm()" /></form>
    </div>
            <?php	

if($page > 1){
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=1'>首页</a>";
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".($page-1)."' ><上一页</a>";
}else{
    $page_banner.="<span class='disable'>首页</span>";
    $page_banner.="<span class='disable'><上一页</span>";
}

if($total_pages > $showpage){
    if($page > $pageoffset+1){
        $page_banner.="...";
    }
    if($page > $pageoffset){
        $start = $page - $pageoffset;
        $end = $total_pages > $page+$pageoffset?$page+$pageoffset:$total_pages;
    }else{
        $start = 1;
        $end = $total_pages > $showpage ? $showpage:$total_pages;
    }
    if($page + $pageoffset > $total_pages){
        $start = $start - ($page+$pageoffset-$end);
    }
}
for($i=$start;$i<=$end;$i++){
    if($page==$i){
        $page_banner.="<span class='current'>{$i}</span>";
    }else{
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".$i."' >$i</a>";
    }
}
//尾部省略
if($total_pages > $showpage && $total_pages >$page+$pageoffset){
    $page_banner.="...";
}

if($page < $total_pages){
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".($page+1)."' >下一页></a>";
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".($total_pages)."'>尾页</a>";
}else{
    $page_banner.="<span class='disable'>下一页></span>";
    $page_banner.="<span class='disable'>尾页</span>";
  }
$page_banner.="共{$total_pages}页";
$page_banner.="<form action = 'article.manage.php' method='get'>";
$page_banner.="到第<input type='text' size='2' name='p' value='$page'>页";
$page_banner.="<input type='submit' value='确定'>";
$page_banner.="</form></div>";
echo $page_banner;
?>  
  </td>
        </tr>
    </tfoot>
    <tbody>
    
    <?php 
		if(!empty($data)){
			$i=($page-1)*$pagesize+1;
			
			foreach($data as $value){
	?>
    	<tr class="odd">
        	<td><input type="checkbox" name="checkBoxs[]" /></td>
            <td>&nbsp;<?php echo $i;$i++;?></td>
            <td>&nbsp;<a href="article.show.php?id=<?php echo $value['id'];?>" title="<?php echo $value['description'];?>"><?php echo $value['title']?></a></td>
            <td>&nbsp;<?php if($value['self']==0) echo "公开";else echo "不公开";?></td>
         
            <td><a href="article.update.handle.php?id=<?php echo $value['id'];?>" </a>&nbsp;&nbsp;修改</td>  
            <td><a href="article.del.handle.php?id=<?php echo $value['id'];?>" onclick="javascript:return confir()">删除</a></td>  <?php 
		 
			 
			  
		  }?>
        </tr>
    <?php
        	
		}
     ?>
    	
    </tbody>
</table>

	
    
    <ul id="tabsmenu" class="tabsmenu">
        <li class="active"><a href="#add">添加文章</a></li>
        <li><a href="#manage">管理文章</a></li>
        <li><a href="../../test/article/article.list.php">文章列表</a></li>
        <li><a href="logout.php">退出</a></li>
    </ul>
    <div class="submenu"><h2><a name="add">添加文章</a></h2></div>
    <div id="tab1" class="tabcontent">
    
        <form id="form1" name="form1" method="post" action="article.add.handle.php" enctype="multipart/form-data">
        <div class="form">
            
            <div class="form_row">
            <label>标题:</label>
            <input type="text" class="form_input" name="title" id="title"/>
            </div>
             
            <div class="form_row">
            <label>作者:</label>
            <input type="text" class="form_input" name="author" id="author" />
            </div>
            
             <div class="form_row">
            <label>内容简介:</label>
            <textarea class="form_textarea" name="description" id="description" ></textarea>
            </div>
            <div>是否公开：&nbsp;&nbsp;<input type="radio" name="self" value="0" checked="checked" />公开发表&nbsp;&nbsp;<input name="self" type="radio" value="1" />自己欣赏</div>
            <div class="form_row">
            请选择附件
			 <input type="file" name="myfile" />
			 <input type="submit" class="form_submit" value="Submit" onclick="return check(form1)" />
            </div> 
            <div class="clear"></div>
        </div>
        </form>
    </div> 
      
     </div>
     </div><!-- end of right content-->
                     
      <div class="sidebar" id="sidebar">
    <h2><a href="self_app.php">软件</a></h2>
    
        <ul>
            <li><a href="#">软件列表</a></li>
            <li><a href="#">软件管理</a></li>
            <li><a href="#">其他</a></li>
        </ul>
        
    <h2><a href="self_program.php">程序</a></h2>
    
        <ul>
            <li><a href="#">程序列表</a></li>
            <li><a href="#">程序管理</a></li>
            <li><a href="#">其他</a></li>
        </ul> 
        
    <h2><a href="admin.index.php">文章</a></h2>
    
        <ul>
            <li><a href="#">文章列表</a></li>
            <li><a href="#">文章管理</a></li>
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