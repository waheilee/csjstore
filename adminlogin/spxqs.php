<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");

include("check.php");
date_default_timezone_set('PRC');

$member=getMemberbyID($_SESSION['ID']);
if ($_GET['id']!=NULL){
	$goods=que_select_cl('chongzhi',$_GET['id']);
}



?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>详细信息</title>
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



          						 <table>
                                 <tr>
                                    <td rowspan="3" align="left" valign="top" style="width:20cm; height:20cm;">
                                    <img src="../upload/<?=$goods['goodsimg']?>" style="width:20cm; height:20cm;" align="top"></td>
                                   <td align="left" valign="top">
                                      	<h3>会员编号：<?=$goods['nickname']?></h3>
                                    
                                    
                                   
                                    	<h3>会员姓名：<?=$goods['username']?></h3>
                                  
                                 
                                   
                                    	<h3>充值金额：<?=$goods['jine']?></h3>
                                    	<h3>备注：<?=$goods['beizhu']?></h3>
                                   </td>
                                   </tr>
                         
                                  <tr>
                                    <td colspan="3" align="center" valign="top">     
                                     <input name="input" type="button" value="返  回" onClick="history.back(-1)"></td>
                                    </tr>
                                 
                                  <tr>
                                    <td colspan="4" align="center" >&nbsp;</td>
                                  </tr>
                            </table>   
        				</div></form>
				</section>
	<footer id="gFooter">	
	</footer>
</div>
</body>
</html>