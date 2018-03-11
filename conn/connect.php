<?php
	require_once('config.php');//创建对象并打开连接，最后一个参数是选择的数据库名称 
$mysqli = new mysqli('localhost','******','******','******'); 
if($mysqli->errno){
	die('Connect Error:'.$mysqli->error);
}else{
	$mysqli->set_charset('UTF8');
}
?>
