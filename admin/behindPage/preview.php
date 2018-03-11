<?php 
	include('checkID2.php');
   require_once('../../conn/connect.php'); 
   $id=$_GET['id'];
   $sql="select path from picture where id = $id";
   $query=$mysqli->query($sql);
   $result=$query->fetch_array();
   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图片预览</title>
<style type="text/css">
body img {
	text-align:center;
	margin-top:100px;
}
</style>
</head>

<body>
<img src="<?php echo $result['path'];?>" title="<?php echo $result['title'];?>" alt="<?php echo $result['description'];?>" height="300px" width="500px" />
</body>
</html>