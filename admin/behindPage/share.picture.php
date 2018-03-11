<?php
//1传入页码
include('checkID3.php');
   require_once('../../conn/connect.php'); 
if (!isset($_GET['p'])){
	$page = 1;
}else{
$page = $_GET['p'];}


//2根据页码取出数据:php对mysql的处理

$pagesize = 6;
$showpage = 5;
//获取数据总行数
$sql = "select id from picture where self = 0";
$mysqli_result=$mysqli->query($sql);
$total;
if(isset($mysqli_result->num_rows))
{
	$total = $mysqli_result->num_rows;
}
else
{
	$total = 0;
}
//计算总页数
$total_pages = ceil($total/$pagesize);
//3显示数据和分页条
$page_banner = "<div class='page'>";
//计算偏移量
$pageoffset = ($showpage-1)/2;
//初始化数据
$start = 1;
$end = $total_pages;


$sql = "SELECT * FROM picture where self = 0 LIMIT ".($page-1)*$pagesize .",$pagesize";
$query = $mysqli->query($sql);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>电子工程系|图片共享</title>
	<link rel="stylesheet" href="../../css/share_style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../../css/picture.css" type="text/css" />
    <script type="text/javascript" language="javascript">
	function Img_download(obj){
		
		obj.src="../../Images/下载2.png";
	}
	function Img_back(obj){
		
		obj.src="../../Images/下载1.png";
	}
	function show_download(obj){
		var down_div=obj.getElementsByClassName('download')['0'];
		
		down_div.style.display="block";
		
			
	}
	function disappear(obj){
		var down_div=obj.getElementsByClassName('download')['0'];
		down_div.style.display="none";
	}
	
    </script>
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1>Share</h1>
			<div id="top-navigation">
				Welcome <?php if($_SESSION['power']!=3){;?><a href="<?php if($_SESSION['power']==2) echo "self_article.php";if($_SESSION['power']==0) echo "super_article.php";?> " title="<?php if($_SESSION['power']==2) echo"点击进入个人空间";else echo "点击进入管理页面";?>"><strong><?php echo $_SESSION['username'];}?></strong></a>
				<span>|</span>
				<a href="logout.php">Log out</a>
			</div>
	  </div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<div id="navigation">
			<ul>
			    <li><a href="share.article.php" ><span>文章</span></a></li>
			    <li><a href="share.program.php"><span>程序</span></a></li>
			    <li><a href="share.app.php"><span>软件</span></a></li>
			    <li><a href="share.picture.php" class="active"><span>图片</span></a></li>
			   
			</ul>
		</div>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->
				
			
					<!-- Box Head -->
<div class="box-head">
						<h2 class="left">图片列表</h2>
</div>

	<div id="fh5co-board" data-columns>
    <table>
    	<tr>
<?php
	 if($query && $query->num_rows>0){
		 $i=1;
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
					$name=iconv('utf-8','gb2312//IGNORE',$result['filename']);
					$file1=$result['path'].$name;
					$file=$result['path'].$result['filename'];
		
		
	?>			
    		<td>
        	<div class="item">
        		<div class="animate-box"  onmouseout="disappear(this)" onmouseover="show_download(this)">
                	<div class="img_box" style="position:relative" >
                	
                	
	        		<a href="show_picture.php?id=<?php echo $result['id'];?>" target="_blank" class="image-popup fh5co-board-img" title="">
					<?php list($width,$height,$type,$attr)=getimagesize($file1);
					if($width>$height){;?>
                   <div style="position:absolute;bottom:0"><img src="<?php echo $file;?>" width="100%" style="vertical-align:bottom;display:block" alt="<?php echo $result['filename'];?>" /></div></a>
                    <?php }
					else {;?>
					
					<div style="text-align:center"><img src="<?php echo $file;?>"  height="336.8px;" alt="<?php echo $result['filename'];?>" onmouseover="show_download(this)" /></div>
						
                    </a>
                    
                    <?php }?>
                    </div>
                  	<div class="download" >
                    	<div class="p_name"><?php echo $result['filename'];?></div>
                   <span class="p_time"><?php echo $result['date'];?></span>
                    <a href="download.php?type=picture&id=<?php echo $result['id'];?>" title="下载该图片"><img id="p_down" name="p_down" src="../../Images/下载1.png" onmouseover="Img_download(this)" onmouseout="Img_back(this)"   /></a><span class="size"><?php echo $size;?></span>
                     
                    </div>
                    
        		</div>
        		<div class="fh5co-desc"><pre><?php echo $result['description'];?></pre></div>
        	</div>
            </td>
            <?php if($i%3==0){
				echo '</tr>'.'<tr>';
			}
			$i++;
			
             }}
			else{
				echo "无图片上传!";}?>
         </table>
    </div>
    
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
echo "<span id='num'>共有记录&nbsp;&nbsp;".$total."&nbsp;&nbsp;条&nbsp;&nbsp;</span>";
echo $page_banner;

?>
</div>
<div id="nothing">
</div>
		


</body>
</html>