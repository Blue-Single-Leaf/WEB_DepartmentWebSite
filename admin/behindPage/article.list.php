
<?php
	include('checkID2.php');
   require_once('../../conn/connect.php');
    
	
 
?>
<?php
	$sql = "select id from article";
//1传入页码
if (!isset($_GET['p'])){
	$page = 1;
}else{
$page = $_GET['p'];}

//2根据页码取出数据:php对mysql的处理
$pagesize = 3;
$showpage = 5;
//获取数据总行数

$mysqli_result=$mysqli->query($sql);
$total = $mysqli_result->num_rows;
//计算总页数
$total_pages = ceil($total/$pagesize);
//3显示数据和分页条
$page_banner = "<div class='pages'>";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>文章列表</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#welcome {
	float:left;
	margin-left:10px;
	margin-top:20px;
	font-size:18px;
	color:#69C;
}
#un {
	font-size:24px;
	color: #C0F;
}
div.pages{
text-align:center;
}

div.pages a{
border:#aaaadd 1px solid;
text-decoration:none;
padding:2px 5px;
margin:3px;
}
div.pages span.current{
border:#000099 1px solid;
background-color:#000099;
padding:2px 6px;
margin:3px;
color:#fff;
font-weight:bold;
}
div.pages span.disable{
border:#eee 1px solid;
padding:2px 5px;
margin:3px;
color:#ddd;
}
div.pages form{
display:inline;
}
</style>
</head>
<body>
<div id="wrapper">
<span id="welcome">欢迎&nbsp;&nbsp;<font id="un"><?php echo $_SESSION['username'];?></font></span>
<!-- start header -->
<div id="header">
	<div id="logo">
		<h1><a href="#">学术研究<sup></sup></a></h1>
		<h2></h2>
	</div>
	<div id="menu">
		<ul>
			<li class="active"><a href="article.list.php">文章列表</a></li>
			<li><a href="self_article.php">添加文章</a></li>
			<li><a href="self_article.php">文章管理</a></li>
			<li><a href='logout.php'>退出</a></li>
		</ul>
	</div>
</div>
<!-- end header -->
</div>

<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
	<?php
			foreach($data as $value){
	?>
		<div class="post">
			<h1 class="title"><?php echo $value['title']?><span style="color:#60C;font-size:14px;">　　作者：<!--作者放置到这里--><?php echo $value['author']?></span><span id="time">发表时间：&nbsp;&nbsp;<?php echo $value['dateline'];?></span></h1>
			<div class="entry">
				<?php echo $value['description']?>
			</div>
			<div class="meta">
				<p class="links"><a href="article.show.php?id=<?php echo $value['id']?>" class="more">查看详细</a>&nbsp;&nbsp;&raquo;&nbsp;&nbsp;</p>
			</div>
		</div>
	<?php
			}
	
	?>
    
   <br/>
   
   <?php	

if($page > 1){
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=1"."'>"."首页</a>";
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".($page-1)."'>"."上一页</a>";
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
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".$i."'>".$i."</a>";
    }
}
//尾部省略
if($total_pages > $showpage && $total_pages >$page+$pageoffset){
    $page_banner.="...";
}

if($page < $total_pages){
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".($page+1)."'>"."下一页</a>";
    $page_banner.= "<a href='".$_SERVER['PHP_SELF']."?p=".$total_pages."'>". "尾页</a>";
}else{
    $page_banner.="<span class='disable'>下一页></span>";
    $page_banner.="<span class='disable'>尾页</span>";
  }
$page_banner.="共{$total_pages}页";
$page_banner.="<form action = 'article.list.php' method='get'>";
$page_banner.="到第<input type='text' size='2' name='p' value='$page'>页";
$page_banner.="<input type='submit' value='确定'>";
$page_banner.="</form></div>";
echo $page_banner;
     ?>

	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li id="search">
				<h2><b class="text1">Search</b></h2>
				<form method="post" action="article.search.php" name="form1">
					<fieldset>
                   按
                    <select name="searchway" id="searchway" size="1">
                    	<option value="scontent" selected="selected">关键字</option>
                        <option value="date">日期</option>
                    </select>
                    查询<br/><br/>
					<input type="text" id="s" name="key" value="" />
					<input type="submit" id="x" value="Search" />
					</fieldset>
				</form>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
<!-- start footer -->
<div id="footer">
	<p id="legal"></p>
</div>
<!-- end footer -->
</body>
</html>