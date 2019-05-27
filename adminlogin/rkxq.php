<?php
include("admin_check.php");
include_once("../function.php");

session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<?php
$oid=$_GET['oid'];
$page=$_GET['page'];
$orders=que_select_cl('orders11',$oid);
#结算
//if ($_POST['button']){
//        $csno=$_POST['logisticsno'];        
//        $cs=$_POST['logistics'];
//	$uporder['logisticsno']=$csno;
//	$uporder['logistics']=$cs;
//	edit_update_cl('orders',$uporder,$oid);
//        $or=que_select_cl('orders',$oid);
//        $arr=getAll("SELECT * FROM `orders2` WHERE ordersnumber='{$or['ordersnumber']}'");
//        foreach ($arr as $key =>$row){
//            edit_sql("update `orders2` set logisticsno='{$csno}',logistics='{$cs}' where id={$row['id']}");
//        }
//	echo "<script language=javascript>alert('修改成功.');window.location.href='?oid=".$oid."&page=".$page."'</script>";	
//}

if ($_POST['goback']){
	echo "<script language=javascript>window.location.href='rukuliebiao.php'</script>";
}
?>

<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>详情</title>
<SCRIPT LANGUAGE=javascript>
<!--
function SelectAll() {
	
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		e.checked=!e.checked;
	}
}


-->
</script>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/jihuohuiyuan.css">
<script src="js/jquery.js"></script>
<script src="js/lanrenzhijia.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}                                         
</script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="container">
	<!-- #BeginLibraryItem "/Library/header.lbi" -->
	 <?php include 'header.php';?>
	<!-- #EndLibraryItem -->
<section id="main" class="clearfix">
		<!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
		<?php include 'left.php';?>
		<!-- #EndLibraryItem -->
<div id="conts" cl ass="heightLine-1">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	 <?php include 'title.php';?>
        	<!-- #EndLibraryItem -->
			<form name="form" method="post" action="?oid=<?=$oid?>&page=<?=$page?>">
<div class="mainBox">
            <table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="table1" style="font-size:26px;">
      
      <tr>
        <td height="10" colspan="2" align="center">详细信息</td>
      </tr>
<!--      <tr>
        <td height="10" colspan="2" align="center"><p>入库编号：<?=$orders['ordersnumber']?>
          </td>
      </tr>-->
      <tr>
        <td >名称</td>  
        <td >数量</td>   
        </tr>
        <?php   $sql = "SELECT * FROM `orders22` WHERE ordersnumber='{$orders['ordersnumber']}'";
                $arr=getAll($sql);
                foreach ($arr as $key =>$row){ 

                ?>
                <tr>
                    <td ><?=$row['goodname']?></td>
                    <td ><?=$row['num']?></td>
                </tr>
                <?php }?>
       <tr>
        <td colspan="2" align="center"><input name="goback" type="submit" class="btn1" id="goback" value="返回"></td>
      </tr>

   </table>         
        </div></form>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
<script type="text/javascript">

var mDD = document.getElementById("tablit").getElementsByTagName("dd");
var mDIV= document.getElementById("tablit").getElementsByTagName("div");


for (var i=0;i<mDD.length;i++){
 (function(index) {
  mDD[index].onmouseover = function() {
   if (mDD[index].className == 'out') {
    for (var j = 0; j < mDD.length; j++) {
     mDD[j].className = 'out';
     mDIV[j].style.display = 'none';
    }
    mDD[index].className = 'on';
    mDIV[index].style.display = 'block';
   }
  }

 })(i);
}

</script>
</html>