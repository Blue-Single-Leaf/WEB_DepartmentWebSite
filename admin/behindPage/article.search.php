
<?php 
	require_once('../../conn/connect.php');
	include('checkID2.php');
	if (!isset($_POST['key'])){
		$key="";
		$searchway="scontent";
	}
	else{
	$key=$_POST['key'];
	$searchway=$_POST['searchway'];
	}
	if ($searchway=="scontent"){
	$sql="select * from article where self = 0 and ( title like '%$key%' or author like '%$key%' or description like '%$key%' )order by dateline desc";
	}
	else {
	$sql="select * from article where self = 0 and dateline like '%$key%' order by dateline desc";
	}
	$query = $mysqli->query($sql);
	if($query && $query->num_rows>0){
		$total = $query->num_rows;
		while($row = $query->fetch_assoc()){
			$newkey="<font style='color:red'>".$key."</font>";
				$row=str_replace($key,$newkey,$row);
			$data[] = $row;
		}
	}
	else {
		echo "<script language='javascript'>alert('您输入的查询方式与查询内容不符！\\n\\n文字查询请选择关键字方式;\\n\\n上传时间查询请选择日期方式。');window.location='article.search.php';</script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>文章检索</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
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
			<li><a href="../../test/article/admin/article.add.php">添加文章</a></li>
			<li><a href="../../test/article/admin/article.manage.php">文章管理</a></li>
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
					<input type="text" id="s" name="key" value="<?php echo $key;?>" />
					<input type="submit" id="x" value="Search" />
                    <br/><br/>共得结果&nbsp;&nbsp;<?php echo "<span id='n'>".$total."</span>";?>&nbsp;&nbsp;条
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