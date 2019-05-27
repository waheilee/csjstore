
<?php
 include_once '../class/bonus_class.php';
//连接数据库
include_once '../config.php';
include_once '../conn.php'; 
include_once '../class/system_class.php';
include_once '../function.php'; 
$bonus_cl=new bonus_class();
set_time_limit(0);

//$now=now();
//edit_sql("update `systemparameters` set date1='".$now."'  where id=1");
$bonus_cl=new bonus_class();

 

$bonus_cl->ppbuy();//以买家为中心匹配

$bonus_cl->b0bonus();

 
echo "<script language=javascript>alert('发放成功！');window.location.href='?'</script>";

 
?>
