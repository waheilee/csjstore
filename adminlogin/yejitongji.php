<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(3,9);
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	$SearchType=$_POST['SearchType'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and jsdate>='".$TimeStart."' and jsdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}



?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>业绩统计</title>
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
        	<!-- #EndLibraryItem --><form action="" method="post" name="form1">
<div class="mainBox">
            	<div class="title clearfix">
                	
                        <div class="right1">
                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                            <input type="submit" value="搜索" name="Search" id="Search"/>
                        </div>
            		
             	</div>
                
                <div class="table">
                	<h3>业绩统计</h3>
                    <div class="table1">
                	<table>
                    	<tr>
                            	<td>日期</td>
                            	<td>新增会员</td>
                            	<td>会员总数</td>
                            	<td>新增业绩</td>
                            	<td>业绩总数</td>
                            	<td>奖金发放</td>
                            	<td>发放总数</td>
                            	<td>波比</td>
                            	<td>总波比</td>
                        </tr>
						 <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `systemyeji` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
		if($query = mysql_query($sql)){
	  		$sum = mysql_num_rows($query); //计算总记录数 
		}else{
			$sum=0;	
		} 
		if($sum % $pagesize == 0) //计算总页数 
			$total = (int)($sum/$pagesize); 
		else 
			$total = (int)($sum/$pagesize) + 1; 
			if (isset($_GET['page'])) //获得页码
			{ 
				$p = (int)$_GET['page'];
			} 
			else 
			{ 
				$p = 1;
			}
			if ($p>$total){
				$p=$total;	
			}
		$start = $pagesize * ($p - 1); //计算起始记录 
      	$sql = "SELECT * FROM `systemyeji` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by ydate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
                    	<tr>
        <td align="center"><?=date("Y-m-d H:s:i",strtotime($row['ydate']))?></td>
        <td align="center"><?=$row['xzhy']?></td>
        <td align="center"><?=$row['zhy']?></td>
        <td align="center"><?=$row['xzyj']?></td>
        <td align="center"><?=$row['zyj']?></td>
        <td align="center"><?=$row['ff']?></td>
        <td align="center"><?=$row['zff']?></td>
        <td align="center"><?=$row['ff']/$row['xzyj']*100?>%</td>
        <td align="center"><?=$row['zff']/$row['zyj']*100?>%</td>
      </tr>
      <?php
			}
		}
	  ?>
                    	<tr>
                        	<th colspan="9">
                            
                           <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div>   </form>         
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>