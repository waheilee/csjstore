<?php
include("admin_check.php");
include_once("../function.php");

session_start();
?>
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
$lx=$_GET['lx'];
$orders=que_select_cl('orders2',$oid);
#结算
if ($_POST['button']){
	$uporder['logisticsno']=$_POST['logisticsno'];
	$uporder['logistics']=$_POST['logistics'];
	edit_update_cl('orders2',$uporder,$oid);
	echo "<script language=javascript>alert('修改成功.');window.location.href='?oid=".$oid."&page=".$page."'</script>";	
}

if ($_POST['goback']){
	echo "<script language=javascript>window.location.href='dingdanguanli.php?page=".$page."'</script>";
}
?>

<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>订单详细信息</title>
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
      <div id="daochu">
      <tr>
        <td height="10" colspan="5" align="center"> 订单详细信息</td>
      </tr>
      <tr>
        <td height="10" colspan="5" align="left"><p>订单编号：<?=$orders['ordersnumber']?>
          <br>
          物流公司：
          <input name="logistics" id="logistics" type="text" value="<?=$orders['logistics']?>">
          <br>
          物流编号：
          <input type="text" name="logisticsno" id="logisticsno" value="<?=$orders['logisticsno']?>">
          <input name="button" type="submit" class="btn2" id="button" value="修改">
          <br>
          会员编号：<?=$orders['userid']?><br>
        会员姓名：<?=$orders['username']?><br>
      
        联系电话：<?=$orders['usertel']?><br>
        联系地址：<?=$orders['useraddress']?><br>
        订单金额：<?=$orders['sgb']?><br>
        </p></td>
      </tr>
<tr>
<!--         <td align="center">商品图片</td> -->
        <td align="center">商品名称</td>
        <!-- <td align="center">现金</td> -->
        <td align="center">单价</td>
        <td align="center">购买数量</td>
        <td align="center">总计</td>
      </tr>
        <?php
          $goods=getOne("select id,goodsimg,shichangjia from goods where id={$orders['goodid']}");
          if($goods['goodsimg']){
            $img="../upload/".$goods['goodsimg'];
          }else{
            $img="img/shop/pho1.jpg";
        }
			// $shichang=getOne("select id,shichangjia from goods where id={$orders['goodid']}");

        ?>
      <tr>
          
        <td align="center"><?=$orders['goodname']?></td>
        <!--<td align="center"><?php if ($lx==1){?>首购商品<?php }else{?>重购商品<?php }?></td>-->
        
<!--        <td align="center"><?=$goods['shichangjia']?></td>-->
        <td align="center"><?=$orders['price']?></td>

        <td align="center"><?=$orders['num']?></td>
        <td align="center"><?=$orders['price']*$orders['num']?></td>
        </tr>
        
      <?php
		//	}
		//}
	  ?>
      </div>
        <td colspan="5" align="center"><input name="goback" type="submit" class="btn1" id="goback" value="返回"></td>
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