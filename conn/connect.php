<?php
	require_once('config.php');//�������󲢴����ӣ����һ��������ѡ������ݿ����� 
$mysqli = new mysqli('localhost','myadmin','myadmin','info'); 
if($mysqli->errno){
	die('Connect Error:'.$mysqli->error);
}else{
	$mysqli->set_charset('UTF8');
}
?>