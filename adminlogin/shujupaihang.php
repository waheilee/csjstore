<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(1,2);
#搜索会员
if ($_POST['Search']){
	switch ($_POST['SearchType']){
		case 0:
			$title = "正常排序";
			$_SESSION['Search']='pdt';
			break;
		case 1:
			$title = "团队累计业绩排序";
			$_SESSION['Search']='area1';
			break;
		case 2:
			$title = "团队累计销售排序";
			$_SESSION['Search']='dan1';
			break;
		case 3:
			$title = "团队季度业绩排序";
			$_SESSION['Search']='yarea1';
			break;
		case 4:
		 	$title = "团队季度销售排序";
		 	$_SESSION['Search']='ydan1';
		 	break;
        case 5:
			$title = "个人累计业绩排序";
			$_SESSION['Search']='area2';
			break;
		case 6:
			$title = "个人累计销售排序";
			$_SESSION['Search']='dan2';
			break;
		case 7:
			$title = "个人季度业绩排序";
			$_SESSION['Search']='yarea2';
			break;
        case 8:
		 	$title = "个人季度销售排序";
		 	$_SESSION['Search']='ydan2';
		 	break;
		case 9:
			$title = "团队累计人数排序";
			$_SESSION['Search']='narea1';
			break;
        case 10:
			$title = "直推累计人数排序";
			$_SESSION['Search']='recount';
			break;
        case 11:
			$title = "直推累计业绩排序";
			$_SESSION['Search']='reyeji';
			break;
        case 12:
			$title = "剩余库存排序";
			$_SESSION['Search']='zsq';
			break;
        case 13:
			$title = "剩余积分排序";
			$_SESSION['Search']='mey';
			break;
        case 14:
			$title = "红利包排序";
			$_SESSION['Search']='fanli';
			break;
        
		
	}
}else{
	if ($_GET['page']==NULL){
		$title = "正常排序";
		$_SESSION['Search']='pdt';
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
<title>数据排行</title>
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
<div class="mainBox">
            	<div class="title clearfix">
                	<form action="" method="post" name="form1">
                        <div class="right1">
                        	<select name="SearchType" id="SearchType">
            <option <?php if($title=="正常排序"){?>selected<?php }?> value="0">正常排序</option>
            <option <?php if($title=="团队累计业绩排序"){?>selected<?php }?> value="1">团队累计业绩排序</option>
            <option <?php if($title=="团队累计销售排序"){?>selected<?php }?> value="2">团队累计销售排序</option>
            <option <?php if($title=="团队季度业绩排序"){?>selected<?php }?>  value="3">团队季度业绩排序</option>
            <option <?php if($title=="团队季度销售排序"){?>selected<?php }?>  value="4">团队季度销售排序</option>
            <option <?php if($title=="个人累计业绩排序"){?>selected<?php }?>  value="5">个人累计业绩排序</option>
            <option <?php if($title=="个人累计销售排序"){?>selected<?php }?>  value="6">个人累计销售排序</option>
            <option <?php if($title=="个人季度业绩排序"){?>selected<?php }?>  value="7">个人季度业绩排序</option>
            <option <?php if($title=="个人季度销售排序"){?>selected<?php }?>  value="8">个人季度销售排序</option>
            <option <?php if($title=="团队累计人数排序"){?>selected<?php }?>  value="9">团队累计人数排序</option>
            <option <?php if($title=="直推累计人数排序"){?>selected<?php }?>  value="10">直推累计人数排序</option>
            <option <?php if($title=="直推累计业绩排序"){?>selected<?php }?>  value="11">直推累计业绩排序</option>
            <option <?php if($title=="剩余库存排序"){?>selected<?php }?>  value="12">剩余库存排序</option>
            <option <?php if($title=="剩余积分排序"){?>selected<?php }?>  value="13">剩余积分排序</option>
            <option <?php if($title=="红利包排序"){?>selected<?php }?>  value="14">红利包排序</option>
            
            
<!--            <option value="3">奖金累计排行</option>
             <option value="4">推荐人数排行</option> 
            <option value="5">业绩累计排行</option>-->
          </select>
                            <input type="submit" value="搜索" name="Search" id="Search"/>
                        </div>
            		</form>
             	</div>
                
                <div class="table">
                	<h3><?=$title?></h3>
                    <div class="table1">
                	<table>
                    	<tr>
        <td align="center">会员编号</td>
        <td align="center">会员姓名</td>
        <td style="display: none;" align="center">会员资格</td>
        <td style="display: none;" align="center">推荐人</td>
        <td style="display: none;" align="center">接点人</td>
        <td align="center">团队累计业绩</td>
        <td align="center">团队累计销售</td>
        <td align="center">团队季度业绩</td>
        <td align="center">团队季度销售</td>
        <td align="center">个人累计业绩</td>
        <td align="center">个人累计销售</td>
        <td align="center">个人季度业绩</td>
        <td align="center">个人季度销售</td>
        <td align="center">团队累计人数</td>
        <td align="center">直推累计人数</td>
        <td align="center">直推累计业绩</td>
        <td align="center">剩余库存</td>
        <td align="center">剩余积分</td>
        <td align="center">红利包</td>
<!--        <td align="center">累计奖金</td>
       
         <td align="center">推荐人数</td> 
-->     
        <td style="display: none;" align="center">服务中心</td>
        <td style="display: none;" align="center">激活时间</td>
        <td align="center">详细信息</td>
    </tr>
	 <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT id FROM `member` WHERE ispay>=1 order by ".$_SESSION['Search']." ";
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
      	$sql = "SELECT id,userid,ulevel,username,zsq,mey,maxmey,recount,fanli,reyeji,area1,area2,dan1,dan2,yarea1,yarea2,ydan1,ydan2,narea1,narea2 FROM `member` WHERE ispay>=1 order by ".$_SESSION['Search']." desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$ul=ulevel($row['ulevel']);
	  ?>
                    	<tr>
        <td align="center"><?=$row['userid']?><?php if($row['ispay']==2){?>[空单会员]<?php }?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center" style="display: none;"><?=$ul['lvname']?></td>
        <td align="center" style="display: none;"><?=$row['rname']?></td>
        <td align="center" style="display: none;"><?=$row['fathername']?></td>
        <td style="display:none" align="center"><?=$row['usertel']?></td>
        <td style="display:none" align="center"><?=$row['userqq']?></td>
        <td align="center"><?=$row['area1']?></td>
        <td align="center"><?=$row['dan1']?></td>
        <td align="center"><?=$row['yarea1']?></td>
        <td align="center"><?=$row['ydan1']?></td>
        <td align="center"><?=$row['area2']?></td>
        <td align="center"><?=$row['dan2']?></td>
        <td align="center"><?=$row['yarea2']?></td>
        <td align="center"><?=$row['ydan2']?></td>
        <td align="center"><?=$row['narea1']?></td>
        <td align="center"><?=$row['recount']?></td>
        <td align="center"><?=$row['reyeji']?></td>
        <td align="center"><?=$row['zsq']?></td>
        <td align="center"><?=$row['mey']?></td>
        <td align="center"><?=$row['fanli']?></td>
        <!-- <td align="center"><?=$row['maxmey']?></td>
        
        <td align="center"><?=$row['recount']?></td>
        <td align="center"><?=$row['area1']+$row['area2']?></td> -->
        <td align="center"style="display:none"><?=$row['bdname']?></td>
        <td align="center"style="display:none"><?=$row['pdt']?></td>
        <td align="center"><input type="button" class="button" id="button" name="button" value="查看" onClick="window.location.href='zshy_chakan.php?ID=<?=$row['id']?>'" /></td>
      </tr>
      <?php
			}
		}
	  ?>

                    	<tr>
                        	<th colspan="20">
                            
                            <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>