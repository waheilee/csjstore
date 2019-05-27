<?php
include_once ("../member/check.php");
include("../member/check2.php");
include_once("../function.php");
include_once("../bonus.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
$ID=$_GET['ID'];
// if ($ID=="") 
	//$ID=$_SESSION['ID'];
	$sql = "SELECT * FROM `member` WHERE id=".$ID." ";
	$us=getOne($sql);
	
// $cx="&ID=".$ID."";
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>查看奖金明细</title>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/chakan.css">
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
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><?php include 'header.php';?><!-- #EndLibraryItem --><section id="main" class="clearfix"><!-- #BeginLibraryItem "/Library/sideBar.lbi" --><?php include 'left.php';?><!-- #EndLibraryItem --><div id="conts" cl ass="heightLine-1"><!-- #BeginLibraryItem "/Library/title.lbi" --><?php include 'title.php';?><!-- #EndLibraryItem --><div class="mainBox">
            <div class="table2">
            	<table>
                	<tr>
                    	<td>结算时间</td>
                   <td <?=$bonus1xs;?> align="center" ><?=$bonus1name?></td>
                    <td <?=$bonus2xs;?> align="center" ><?=$bonus2name?></td>
                    <td <?=$bonus3xs;?> align="center" ><?=$bonus3name?></td>
                    <td <?=$bonus4xs;?> align="center" ><?=$bonus4name?></td>
                    <td <?=$bonus5xs;?> align="center" ><?=$bonus5name?></td>
                    <td <?=$bonus6xs;?> align="center" ><?=$bonus6name?></td>
                    <td <?=$bonus7xs;?> align="center" ><?=$bonus7name?></td>
                    <td <?=$bonus8xs;?> align="center" ><?=$bonus8name?></td>
                    <td <?=$bonus9xs;?> align="center" ><?=$bonus9name?></td>
                    <td <?=$bonus10xs;?> align="center" ><?=$bonus10name?></td>
                    <td <?=$bonus11xs;?> align="center" ><?=$bonus11name?></td>

                    <td <?=$bonus0xs;?> align="center" ><?=$bonus0name?></td>
                    	 




 
<!-- <td>实际发放</td> -->
                    </tr>
					 <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT id FROM `bonus` WHERE uid=".$ID."";
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
      	$sql = "SELECT * FROM `bonus` WHERE uid=".$ID." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
                	<tr>
                    	<td><?=date("Y-m-d H:s:i",strtotime($row['bdate']))?></td>
                   

                        <td <?=$bonus1xs;?> align="center" ><?=$row['b1']?></td>
                        <td <?=$bonus2xs;?> align="center" ><?=$row['b2']?></td>
                        <td <?=$bonus3xs;?> align="center" ><?=$row['b3']?></td>
                        <td <?=$bonus4xs;?> align="center" ><?=$row['b4']?></td>
                        <td <?=$bonus5xs;?> align="center" ><?=$row['b5']?></td>
                        <td <?=$bonus6xs;?> align="center" ><?=$row['b6']?></td>
                        <td <?=$bonus7xs;?> align="center" ><?=$row['b7']?></td>
                        <td <?=$bonus8xs;?> align="center" ><?=$row['b8']?></td>
                        <td <?=$bonus9xs;?> align="center" ><?=$row['b9']?></td>
                        <td <?=$bonus10xs;?> align="center" ><?=$row['b10']?></td>
                        <td <?=$bonus11xs;?> align="center" ><?=$row['b11']?></td>

                        <td <?=$bonus0xs;?> align="center" ><?=$row['b0']?></td>
                    </tr>
					<?php
			}
		}
// 		$sql1="SELECT sum(b0),sum(b1),sum(b2),sum(b3),sum(b4),sum(b5),sum(b6),sum(b7),sum(b8),sum(b9),sum(b10),sum(b11),sum(b12) FROM `bonus` WHERE uid=".$ID."";
// 		if($query=mysql_query($sql1)){
// 			$zj=mysql_fetch_array($query);
// 		}
	  ?>
                    <tr>
                    	<th colspan="6">
                        	<?php echo fenye($p,$pagesize,$sum,$total,$cx)?>
                        </th>
                    </tr>
                
                </table>
            </div>
                
                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>