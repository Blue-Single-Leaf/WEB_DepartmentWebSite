<?php
//1传入页码
include('checkID.php');
   require_once('../../conn/connect.php'); 
if (!isset($_GET['p'])){
	$page = 1;
}else{
$page = $_GET['p'];}


//2根据页码取出数据:php对mysql的处理

$pagesize = 10;
$showpage = 5;
//获取数据总行数
$sql = "select id from program";
$mysqli_result=$mysqli->query($sql);
if(isset($mysqli_result->num_rows)){
	$total = $mysqli_result->num_rows;
}
else $total="0";
//计算总页数
$total_pages = ceil($total/$pagesize);
//3显示数据和分页条
$page_banner = "<div class='page'>";
//计算偏移量
$pageoffset = ($showpage-1)/2;
//初始化数据
$start = 1;
$end = $total_pages;


$sql = "SELECT * FROM program LIMIT ".($page-1)*$pagesize .",$pagesize";
$query = $mysqli->query($sql);
/*if($query && $query->num_rows>0){
		while($row = $query->fetch_assoc()){
			$data[] = $row;
		}
	}else{
		$data = array();
	}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Free CSS template Collect from Cssmoban.com</title>
	<link rel="stylesheet" href="../../css/super_style.css" type="text/css" media="all" />
 <script type="text/javascript" language="javascript" src="../../js/super.js">
	</script>
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1>Manager</h1>
			<div id="top-navigation">
				Welcome <strong>Administrator</strong>
				<span>|</span>
				<a href="logout.php">Log out</a>
			</div>
	  </div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<div id="navigation">
			<ul>
			    <li><a href="super_article.php" ><span>文章管理</span></a></li>
			    <li><a href="super_program.php" class="active"><span>程序管理</span></a></li>
			    <li><a href="super_app.php"><span>软件管理</span></a></li>
			    <li><a href="super_picture.php"><span>图片管理</span></a></li>
			    <li><a href="super_user.php"><span>用户管理</span></a></li>
			</ul>
		</div>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->
				
				<div class="box">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left" id="ob_type">程序列表</h2>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
                    <div class="table">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th width="30px">Choose</th>
                                <th width="40px">Id</th>
								<th width="200px">Name</th>
                                <th width="100px">Maker</th>
								<th width="250px">Description</th>
								<th>Size</th>
                                <th>Poster</th>
								<th class="ac">Control</th>
							</tr>
    					<form name="form1" id="form1" method="post" action="program.del.handle.php?check=more">
							<tr>
								<td><a id="allselect" onclick="javascript:return allselect()">全选</a></td>
                                <td>编号</td>
								<td>程序名</td>
                                <td>编程者</td>
								<td>描述</td>
								<td>大小</td>
                                <td>上传者</td>
								<td>Delete</td>
							</tr>
<?php 
	if($query && $query->num_rows>0){
		$i=($page-1)*$pagesize+1;
	while($result=$query->fetch_array()){
		$size1=$result['size'];
				
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
	
                            <tr>
                            	<td><input type="checkbox"  name="checkBoxs[]" value="<?php echo $result['id'];?>" class="checkbox" /></td>
                                <td><?php echo $i;?></td>
                                <td><?php echo $result['name'];?></td>
                                <td><?php echo $result['maker'];?></td>
                              	<td><?php echo $result['description'];?></td>
                                <td><?php echo $size;?></td>
                                <td><?php echo $result['poster'];?></td>
                                <td><a href="program.del.handle.php?id=<?php echo $result['id'];?>" onclick="javascript:return confir()">删除程序</a></td>
                            </tr>
<?php $i++;
	} 
	}
	else {
		echo "尚无程序上传！";
	}
?>
					
                    	</table>
                        </div> <br/><br/>
                        <div id="sub"> <input type="submit" name="submit1" id="submit1" value="删除选中" onclick="javascript:return submit_confirm()"/>
                        </div></form>
<div id="page">
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
  </div>
<div id="num">共有记录&nbsp;&nbsp;<span id="num2"><?php echo $total;?></span>&nbsp;&nbsp;条
</div>	

</body>
</html>