<?php 
include("admin_check.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
include_once("../class/system_class.php");
include_once("action.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
$y1= getOne("select *  from `systemparameters` where id=1");
//$level= getOne("select z2  from zjulevel where id=1");
$ul= ulevel(1);
$n=getOne("select count(id) from `member` where ispay>0 and fanli>0");
$num=$n['count(id)'];

$n1=getOne("select count(id) from `member` where zjulevel>=7 and ispay>0");
$num1=$n1['count(id)'];

$now=now();
$y=date("Y",strtotime(now()));
$m=date("m",strtotime(now()));
$d=date("d",strtotime(now()));
$bonus_cl=new bonus_class();

if ($_POST['button']){
    $bonus_cl->zjulevel1();
//    $bonus_cl->b0bonus();
    action::record("经销商考核", 0, $_SESSION['adminid'],"考核");
    edit_sql("update `systemparameters` set date='".$now."' where id=1 ");
    edit_sql("update `member` set yarea1=0");
    echo "<script language=javascript>alert('经销商考核完成.');window.location.href='?'</script>";
}
           
//if ($_POST['button1']){
//                $bonus_cl->sj();
//                $bonus_cl->sj1();
//                $bonus_cl->sj2();
////                $bonus_cl->b0bonus();
//                action::record("职称考核", 0, $_SESSION['adminid'],"考核");
//                edit_sql("update `systemparameters` set date1='".$now."' where id=1 ");
//                edit_sql("update `member` set yarea2=0");
//                echo "<script language=javascript>alert('职称考核完成.');window.location.href='?'</script>";
//}
//?> 
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>奖金结算</title>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/caiwuguanli.css">
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
<body style="margin-top:-19px">
<div id="container">
	<!-- #BeginLibraryItem "/Library/header.lbi" -->
	<?php include 'header.php';?>
	<!-- #EndLibraryItem -->
<section id="main" class="clearfix">
		<!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
		<?php include 'left.php';?>
		<!-- #EndLibraryItem -->
<div id="conts">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	<?php include 'title.php';?>
        	<!-- #EndLibraryItem -->
<div class="mainBox">
<form name="form1" method="post" action="?" >
        <table width="100%" cellpadding="6" cellspacing="1" border="0" align="center" class="table">
            <tr>
                <td align="center" colspan="6"><strong><font color="#FF0000">经销商考核</font></strong></td>
            </tr>
            <tr>
                <td align="center"></td>
                <td align="center">上次执行时间</td>
                <td align="center"></td>
                <td align="center">操作</td>
            </tr>
            <tr>
                <td align="center"></td>
                <td align="center"><?=$y1['date']?></td>
                <td align="center"></td>
                <td align="center">
                    <input name="button" id="button" type="submit" class="btn3"  value="经销商考核" onClick="{if(confirm('您确定要考核吗?')){this.document.selform.submit();return true;}return false;}"/>
                </td>
          </tr>

<!--            <tr>
                <td align="center" colspan="6"><strong><font color="#FF0000">职称考核</font></strong></td>
            </tr>
            <tr>
                <td align="center"></td>
                <td align="center">上次执行时间</td>
                <td align="center"></td>
                <td align="center">操作</td>
            </tr>
            <tr>
                <td align="center"></td>
                <td align="center"><?=$y1['date1']?></td>
                <td align="center"></td>
                <td align="center">
                    <input name="button1" id="button" type="submit" class="btn3"  value="职称考核" onClick="{if(confirm('您确定要考核吗?')){this.document.selform.submit();return true;}return false;}"/>
                </td>
          </tr>-->
          </tr>
        </table>
     </form>
</body>
</html>