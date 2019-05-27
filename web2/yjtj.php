<!DOCTYPE html>
<?php
include("check.php");
include_once("../function.php");
include_once("../class/system_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
	if($_SESSION['isbd']==2){
		$ID=$_GET['id'];
	}
	if($ID==""){
		$ID=$_SESSION['ID'];
	}
	$member=getMemberbyID($ID);
	
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>业绩统计</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/jbxx.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
<link rel="stylesheet" type="text/css" href="ssx/style/cssreset-min.css">
<link rel="stylesheet" type="text/css" href="ssx/style/common.css">
<style type="text/css">
	.citys{
		margin-bottom: 10px;
	}
	.citys p{
		line-height: 28px;
	}
	.warning{
		color: #c00;
	}
	.main a{
		margin-right: 8px;
		color: #369;
	}
</style>
<script type="text/javascript" src="ssx/script/jquery.min.js"></script>
<script type="text/javascript" src="ssx/script/jquery.citys.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	  <?php include 'header.php';?>
    
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
        	<div class="table2">
            	<table>
                    <?php
                    
                    $j=getOne("select sum(num) from tixian where uid in(select id from member where repath like '%,{$member['id']},%' and zjulevel<1)");
                    $zj=$j['sum(num)'];

                    $td= getOne("select count(id) from member where repath like '%,{$member['id']},%' and zjulevel<1");
                    $tdrs=$td['count(id)'];

                    $cp=getOne("select sum(num) from orders2 where uid in(select id from member where repath like '%,{$member['id']},%' and zjulevel<1)");
                    $tdcp=$cp['sum(num)'];
                    
                    $_y=date("Y");
                    $_m=date("m");
                    $_d=date("d");
                    //本周的第一天和最后一天
                    $date=new DateTime();
                    $date->modify('this week');
                    $first_day_of_week=$date->format('Y-m-d');
                    $date->modify('this week +6 days');
                    $end_day_of_week=$date->format('Y-m-d');
                
                    $yj=getOne("select sum(jine) from orders2 where lunci<>2 and lunci<>3 and date>='$first_day_of_week' and date   <=' $end_day_of_week' and uid in(select id from member where repath like '%,{$member['id']},%' and zjulevel<1)");
                    $zyj=$yj['sum(jine)'];
                    if($zyj==NULL){
                        $zyj=0;
                    }
                    $yj1=getOne("select sum(jine) from orders2 where lunci<>2 and lunci<>3 and month(date)=".$_m." and uid in(select id from member where repath like '%,{$member['id']},%' and zjulevel<1)");
                    $yyj=$yj1['sum(jine)'];
                    if($yyj==NULL){
                        $yyj=0;
                    }
                    
                    $yj2=getOne("select sum(jine) from orders2 where lunci<>2 and lunci<>3 and year(date)=".$_y." and uid in(select id from member where repath like '%,{$member['id']},%' and zjulevel<1)");
                    $nyj=$yj2['sum(jine)'];
                    if($nyj==NULL){
                        $nyj=0;
                    }
                    ?>
                    <tr>
                        <td>周业绩：<?=$zyj?></td>
                    </tr>
                    <tr>
                    	<td>月业绩：<?=$yyj?></td>
                    </tr>
                    <tr>
                    	<td>年业绩：<?=$nyj?></td>
                    </tr>
                    <tr>
                    	<td>团队人数：<?=$tdrs?></td>
                    </tr>
                    <tr>
                        <td>产品数量：<?=$tdcp?></td>
                    </tr>
                	<tr>
                        <td>提现金额：<?=$zj?></td>
                    </tr>

                </table>
                 <ul class="list3">
                    <li style="width:100%"><a href="javascript:history.go(-1);"><input type="submit" value="返回" /></a></li>
                </ul>
            </div>
        </div>
        
        <br/><br/>
    </section><!-- #BeginLibraryItem "/Library/footer.lbi" -->
    <?php include 'footer.php';?>
</body>
</html>