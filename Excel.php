<?php
// 输出Excel文件头，可把user.csv换成你要的文件名
header(’Content-Type: application/vnd.ms-excel’);
header(’Content-Disposition: attachment;filename=”user.csv”’);
header(’Cache-Control: max-age=0’); 
 
// 从数据库中获取数据，为了节省内存，不要把数据一次性读到内存，从句柄中一行一行读即可
$sql = ’select * from tbl where ……’;
$stmt = $db->query($sql);
// 打开PHP文件句柄，php://output 表示直接输出到浏览器
$fp = fopen(’php://output’, ’a’);
// 输出Excel列名信息
$head = array(’姓名’, ’性别’, ’年龄’, ’Email’, ’电话’, ’……’);
foreach ($head as $i => $v) {
// CSV的Excel支持GBK编码，一定要转换，否则乱码
$head[$i] = iconv(’utf-8’, ’gbk’, $v);
}
// 将数据通过fputcsv写到文件句柄
fputcsv($fp, $head);
// 计数器
$cnt = 0;
// 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
$limit = 100000;
// 逐行取出数据，不浪费内存
while ($row = $stmt->fetch(Zend_Db::FETCH_NUM)) {
$cnt ++;
if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
ob_flush();
flush();
$cnt = 0;
}
foreach ($row as $i => $v) {
$row[$i] = iconv(’utf-8’, ’gbk’, $v);
}
fputcsv($fp, $row);
}