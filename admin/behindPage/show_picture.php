<?php 
	include("../../conn/connect.php");
	include("checkId3.php");
	$id;
	$page_show=8;
	$sql1="select id from picture where self = 0";
	$query1=$mysqli->query($sql1);
	$total=$query1->num_rows;
	$allpage=ceil($total/$page_show);
	if(isset($_GET['page'])){
		$page=$_GET['page'];
		
	}
	else{
		
		$id=$_GET['id'];;
		for($i=0;$i<$allpage;$i++){
			$s="select * from picture where self = 0 LIMIT ".$i*$page_show.",$page_show";
			$q=$mysqli->query($s);
			$array1=array();
			$j=0;
			while($r=$q->fetch_array()){
				$array1["$j"]=$r['id'];
				$j++;
			}
			echo $array1['0'];
			if(in_array("$id",$array1)){
				$page=$i+1;
				break;
			}
		}
	}
				
	$sql2="select * from picture where self = 0 LIMIT ".($page-1)*$page_show.",$page_show";
	$query=$mysqli->query($sql2);
	$query2=$mysqli->query($sql2);
	
	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../../css/show_picture.css"  />
<title>图片预览</title>
<script language="javascript" style="text/javascript">
/*function change_big(obj){
	obj.style.width="140px";
	obj.style.height="140px";
}
function change_back(obj){
	obj.style.width="100px";
	obj.style.height="100px";
}*/
function big_img(obj){
	var a=document.getElementsByClassName('s_picture');
	for(var i=0;i<a.length;i++){
		a[i].style.border="2px solid silver";
	}
	obj.style.border="4px solid red";
	
	var img=new Image();
	img.src=obj.src;
	my_img=document.getElementById('my_img');
	my_img.src=obj.src;
	var big_picture=document.getElementsById('big_picture');
	var img_width=img.offsetWidth;
	var img_height=img.offsetHeight;
	if(img_width>2*img_height){
		my_img.style.width="100%";
	}
	else{
		my_img.style.height="100%";
	}
	
		
	

	
	
}
	

</script>
</head>

<body>
<div class="big">
	<div class="big_up">
		<img src="../../Images/show_picture_big_up.png" />
	</div>
	<div id="big_picture" align="center">
	
        <img  id="my_img" src="<?php while($r2=$query2->fetch_array()){if($r2['id']==$id) echo $r2['path'].$r2['filename'];}?>"   />
	
    </div>
	<div class="big_down">
		<img src="../../Images/show_picture_big_down.png" />
	</div>
</div>
<div class="small">
	<div class="small_up">
    	<img src="../../Images/show_picture_small_up.png"  />
    </div>
    <div class="small_picture">
	<?php 
		while($result=$query->fetch_array()){ $file=$result['path'].$result['filename'];?>
    	<div class="img_box" ><img  class="s_picture" onclick="big_img(this)" src="<?php echo $file;?>" <?php if($result['id']==$id){?> style="border:4px solid red" <?php }?> />
    	</div>
    <?php }?>

	</div>
    <div class="small_down">
        	<img src="../../Images/show_picture_small_down.png"  />
    </div>
</div>
</body>
</html>