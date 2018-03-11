<?php
   require_once('../../conn/connect.php'); 
   include('checkID2.php');
?>
<?php
//1传入页码
if(isset($_GET['a'])){
	$a=$_GET['a'];
}
else {
	$a=0;
}
if(isset($_GET['l'])){
	$l=$_GET['l'];
}
else {
	$l=0;
}
if (!isset($_GET['p'])){
	$page = 1;
}else{
$page = $_GET['p'];}


//2根据页码取出数据:php对mysql的处理

$pagesize= 5;
$pagesize2=10;
$showpage = 5;
//获取数据总行数
$poster=$_SESSION['username'];
$sql = "select id from appfile where poster='$poster'";
$mysqli_result=$mysqli->query($sql);
$total;
if(isset($mysqli_result->num_rows))
{
	$total = $mysqli_result->num_rows;
}
else
{
	$total = 0;
}//计算总页数
$total_pages = ceil($total/$pagesize);
$total_pages2=ceil($total/$pagesize2);
//3显示数据和分页条
$page_banner = "<div class='page' >";
$page_banner2 = "<div class='page'>";
//计算偏移量
$pageoffset = ($showpage-1)/2;
//初始化数据
$start = 1;
$end = $total_pages;
$end2=$total_pages2;


$sql = "SELECT * FROM appfile where poster='$poster' LIMIT ".($page-1)*$pagesize .",$pagesize";
$sql2 = "SELECT * FROM appfile where poster='$poster' LIMIT ".($page-1)*$pagesize2 .",$pagesize2";
$query = $mysqli->query($sql);
$query2 = $mysqli->query($sql2);
if($query && $query->num_rows>0){
		while($row = $query->fetch_assoc()){
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	if($query2 && $query2->num_rows>0){
		while($row2 = $query2->fetch_assoc()){
			$data2[] = $row2;
		}
	}else{
		$data2 = array();
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>电子工程系|个人中心</title>
<link rel="stylesheet" type="text/css" href="../../css/self_style.css" />
<link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'>
<!-- jQuery file -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" language="javascript" src="../../js/self.js">

	
</script>
</head>
<body>
<div id="panelwrap">
  	
	<div class="header">
    	<div class="title">个人中心</div>
    
    	<div class="header_right"> <span id="welcome">welcome&nbsp;&nbsp;<font id="un"><?php echo $_SESSION['username'];?></font>&nbsp;&nbsp;<a href="changepwd.php" class="settings">修改密码</a></span> </div>
    
    	<div class="menu">
    <ul>
    <li><a href="#manage" class="selected">管理软件</a></li>
    <li><a onclick="a_a()" style="cursor:pointer">添加软件</a></li>
    <li><a onclick="return pagelist()" style="cursor:pointer">软件列表</a></li>
    <li><a href="logout.php">退出</a></li>
    </ul>
   		</div>
    
    </div>
    
    <div class="submenu"></div>          
                    
    <div class="center_content">  
 
    	<div id="right_wrap">
        	<div id="right_content">             
   		 	<h2><a name="manage">软件管理列表</a></h2> 
    		
                    
                    

    
    <div id="five_page" style="display:<?php if($l==1) echo "none";else if($a==1) echo "none";else  echo "block;"?>">
    <table class="rounded-corner">
    <thead>
    	<tr>
            <th width="40px;">编号</th>
            
            <th>名称</th>
            <th>大小</th>
            <th width="80px;">公开性</th>
            <th width="60px;">修改</th>
            <th width="60px;">删除</th>
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="12">&nbsp;
           

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
$page_banner.="<form action = 'self_app.php' method='get'>";
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
				$size1=$value['size'];
				
					if($size1 <1024)
					$size=$size1."B";
				
					else if($size1<1024*1024)
					$size=round($size1/(1024),2)."KB";
					else if($size1<1024*1024*1024)
					$size=round($size1/(1024*1024),2)."MB";
					else if($size1<1024*1024*1024*1024)
					$size=round($size1/(1024*1024*1024),2)."GB";
					else 
					$size="文件过大！";
				
	?>
    	<tr class="odd">
           
    <td><?php echo $i; $i++;?></td>
            <td>&nbsp;<a href="article.show.php?id=<?php echo $value['id'];?>&table=appfile"><?php echo $value['name']?></a></td>
            <td>&nbsp;<?php echo $size?></td>
            <td>&nbsp;<?php  if($value['self']==0) echo "公开";else echo "不公开";?></td>
            <td><a href="app.modify.php?id=<?php echo $value['id'];?>&table=appfile" >修改</a></td>  
            <td><a href="app.del.handle.php?id=<?php echo $value['id'];?>&table=appfile" onclick="javascript:return confir()">删除</a></td>  <?php 
		 
			 
			  
		  }?>
        </tr>
    <?php
        	
		}
     ?>
    	
    </tbody>
    </table>
    </div>
    <div id="ten_page" style="display:<?php if($l==1) echo "block";else if($a==1) echo "none";else echo "none";?>">
   <table class="rounded-corner">
    <thead>
    	<tr>
            <th width="40px;">编号</th>
            
            <th>名称</th>
            <th>大小</th>
            <th width="80px;">公开性</th>
            <th width="60px;">修改</th>
            <th width="60px;">删除</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<td colspan="12">&nbsp;
                <?php	

if($page > 1){
    $page_banner2.= "<a href='".$_SERVER['PHP_SELF']."?p=1&l=1&a=2'>首页</a>";
    $page_banner2.= "<a href='".$_SERVER['PHP_SELF']."?p=".($page-1)."&l=1&a=2' ><上一页</a>";
}else{
    $page_banner2.="<span class='disable'>首页</span>";
    $page_banner2.="<span class='disable'><上一页</span>";
}

if($total_pages2 > $showpage){
    if($page > $pageoffset+1){
        $page_banner2.="...";
    }
    if($page > $pageoffset){
        $start = $page - $pageoffset;
        $end2 = $total_pages2 > $page+$pageoffset?$page+$pageoffset:$total_pages2;
    }else{
        $start = 1;
        $end2 = $total_pages2 > $showpage ? $showpage:$total_pages2;
    }
    if($page + $pageoffset > $total_pages2){
        $start = $start - ($page+$pageoffset-$end2);
    }
}
for($i=$start;$i<=$end2;$i++){
    if($page==$i){
        $page_banner2.="<span class='current'>{$i}</span>";
    }else{
    $page_banner2.= "<a href='".$_SERVER['PHP_SELF']."?p=".$i."&l=1&a=2' >$i</a>";
    }
}
//尾部省略
if($total_pages2 > $showpage && $total_pages2 >$page+$pageoffset){
    $page_banner2.="...";
}

if($page < $total_pages2){
    $page_banner2.= "<a href='".$_SERVER['PHP_SELF']."?p=".($page+1)."&l=1&a=2' >下一页></a>";
    $page_banner2.= "<a href='".$_SERVER['PHP_SELF']."?p=".($total_pages2)."&l=1&a=2'>尾页</a>";
}else{
    $page_banner2.="<span class='disable'>下一页></span>";
    $page_banner2.="<span class='disable'>尾页</span>";
  }
$page_banner2.="共{$total_pages2}页";
$page_banner2.="<form action = 'self_app.php?l=1&a=2' method='get'>";
$page_banner2.="到第<input type='text' size='2' name='p' value='$page'>页";
$page_banner2.="<input type='submit' value='确定'>";
$page_banner2.="</form></div>";
echo $page_banner2;

?>
  </td>
        </tr>
    </tfoot>
    <tbody>
    
    <?php 
		if(!empty($data2)){
			$i=($page-1)*$pagesize2+1;
			
			foreach($data2 as $value){
				/*根据大小输出单位*/
				$size1=$value['size'];
				
					if($size1 <1024)
					$size=$size1."B";
				
					else if($size1<1024*1024)
					$size=round($size1/(1024),2)."KB";
					else if($size1<1024*1024*1024)
					$size=round($size1/(1024*1024),2)."MB";
					else if($size1<1024*1024*1024*1024)
					$size=round($size1/(1024*1024*1024),2)."GB";
					else 
					$size="文件过大！";
				
	?>
    	<tr class="odd">
            <td>&nbsp;<?php echo $i;$i++;?></td>
            <td>&nbsp;<a href="article.show.php?id=<?php echo $value['id'];?>&type=appfile" title="<?php echo $value['description'];?>"><?php  $length=mb_strlen($value['name'],"utf8");if($length<20) echo $value['name'];else echo mb_substr($value['name'],0,20,"utf8")."...";?></a></td>
			<td><?php echo $size;?></td>
            <td>&nbsp;<?php if($value['self']==0) echo "公开";else echo "不公开";?></td>
         
            <td><a href="app.modify.php?id=<?php echo $value['id'];?>&table=appfile"> &nbsp;&nbsp;修改</a></td>  
            <td><a href="app.del.handle.php?id=<?php echo $value['id'];?>&table=appfile" onclick="javascript:return confir()">删除</a></td>  <?php 
		 
			 
			  
		  }?>
        </tr>
    <?php
        	
		}
     ?>
     </tbody>
     </table>
	</div>

		<div id="add_article" style="display:<?php if($a==0 and $l==0) echo "block";else if($a==1) echo "block";else  echo "none";?>">		
    	
        
        
            
      <div class="submenu"><h2><a name="add">添加软件</a></h2></div>
    <div id="tab1" class="tabcontent">
    <form id="form1" name="form1" method="post" action="deal_exepost.php" enctype="multipart/form-data">
        	<div class="yon">是否公开：&nbsp;&nbsp;<input type="radio" name="self" value="0" checked="checked" />公开发表&nbsp;&nbsp;<input name="self" type="radio" value="1" />自己欣赏</div>
        <div class="form">
            
            <div class="form_row">
            <label>软件名称:</label>
            <input type="text" class="form_input" name="AppName" id="AppName"/>
            </div>
            
             <div class="form_row">
            <label>介&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;绍:</label>
            <textarea class="form_textarea" name="description" id="description" ></textarea>
            </div>
            <div class="form_row">
            请选择附件
			 <input type="file" name="myfile" class="view" />
			 <input type="submit" class="form_submit" value="Submit" onclick="return check(form1)" />
             <input type="hidden" name="table" value="appfile" />
            </div> 
            <div class="clear"></div>
        </div>
        </form>
    </div> 

    	</div>
     </div>
</div><!-- end of right content-->
                     
      <div class="sidebar" id="sidebar">
     <h2><a href="self_article.php">文章</a></h2>
    
        <ul>
            <li><a onclick="return pagelist()" style="cursor:pointer">文章列表</a></li>
            <li><a href="self_article.php">文章管理</a></li>
            <li><a href="#">其他</a></li>
        </ul>   
        
    <h2><a href="self_program.php">程序</a></h2>
    
        <ul>
            <li><a href="self_program.php?a=2&l=1">程序列表</a></li>
            <li><a href="self_program.php">程序管理</a></li>
            <li><a href="#">其他</a></li>
        </ul> 
        
   <h2><a href="self_app.php">软件</a></h2>
    
        <ul>
            <li><a href="self_app.php?l=1&a=2">软件列表</a></li>
            <li><a onclick="return org()" style="cursor:pointer" >软件管理</a></li>
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
