
<?php
 include_once '../class/bonus_class.php';
//连接数据库
include_once '../config.php';
include_once '../conn.php'; 
include_once '../class/system_class.php';
include_once '../function.php';
$err['isbd']=1;
$err['ulevel']=9;
$err['lvname']="全国代理";
add_insert_cl('ulevel', $err);
 
?>
