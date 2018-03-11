
<?php 
	require_once('../../conn/connect.php');
	include('checkID3.php');
	$type=$_GET['table'];
	$id = $_GET['id'];
	
	$sql = "select * from $type where id=$id";
	
	$query = $mysqli->query($sql);
	if($query && $query->num_rows>0){
		$value = $query->fetch_assoc();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>文章内容</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../../css/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
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
    <?php if($type=="article"){;?>
		<div class="post">
			<h1 class="title"><?php echo $value['title']?><span style="color:#60C;font-size:14px;">　　作者：<!--作者放置到这里--><?php echo $value['author']?></span><span id="time">发表时间：&nbsp;&nbsp;<?php echo $value['posttime'];?></span></h1>
			<div class="entry">
				<!--文章内容放置到这里-->
				<pre><?php echo $value['description'];?></pre>
			</div>
            <?php }
			else if($type=="appfile"){
			;?><div class="post">
			<h1 class="title"><?php echo $value['name']?>　　<span id="time">发表时间：&nbsp;&nbsp;<?php echo $value['posttime'];?></span></h1>
			<div class="entry">
				<!--文章内容放置到这里-->
				<pre><?php echo $value['description'];?></pre>
			</div>
            <?php }
			else if($type=="program"){
				;?>
                <div class="post">
			<h1 class="title"><?php echo $value['name']?><span style="color:#60C;font-size:14px;">　编程者：<!--作者放置到这里--><?php echo $value['maker']?></span><span id="time">发表时间：&nbsp;&nbsp;<?php echo $value['posttime'];?></span></h1>
			<div class="entry">
				<!--文章内容放置到这里-->
				<pre><?php echo $value['description'];?></pre>
			</div>
            <?php }
			else{;?>
				<div class="post">
			<h1 class="title"><?php echo $value['filename']?><span style="color:#60C;font-size:14px;">　　作者：<!--作者放置到这里--><?php echo $value['author']?></span><span id="time">发表时间：&nbsp;&nbsp;<?php echo $value['date'];?></span></h1>
			<div class="entry">
				<!--文章内容放置到这里-->
				<pre><?php echo $value['description'];?></pre>
			</div>
            <?php };?>
            <div id="download">
           <a href="download.php?id=<?php echo $value['id'];?>&type=<?php echo $type;?>"> 下载该文件</a>
            </div>
		</div>
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