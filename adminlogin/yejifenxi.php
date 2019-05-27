<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
$_bonus_cl = new bonus_class();
$_bonus_cl->ljyeji();
//checkqx(1,2);
#搜索会员
if ($_POST['Search']){
    $Searchul=$_POST['Searchul'];
    if($Searchul<>0){
        $_SESSION['Searchul']=" and ulevel= ".$Searchul." ";
        $s= ulevel($Searchul);
        $xs=$s['lvname'];
    }else{
        $_SESSION['Searchul']=NULL;
    }
}else{
	if ($_GET['page']==NULL){
        $_SESSION['Searchul']=NULL;
        $Searchul="";
        $xs="";
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
<title>本月排名</title>
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
                            <select name="Searchul" id="Searchul">
                                <?php $arr= getAll("select id,ulevel,lvname from ulevel order by ulevel");                               
                                foreach ($arr as $k){?>
                                    <option value="<?=$k['ulevel']?>" <?php if($Searchul==$k['ulevel']){?>selected<?php }?> ><?=$k['lvname']?></option>
                                <?php }?>
                            </select>
<!--                        	<select name="SearchType" id="SearchType">
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
            
            
            <option value="3">奖金累计排行</option>
             <option value="4">推荐人数排行</option> 
            <option value="5">业绩累计排行</option>
          </select>-->
                            <input type="submit" value="搜索" name="Search" id="Search"/>
                             <input type="submit" name="del" id="del" class="btn1" value="清空">
                        </div>
            		</form>
             	</div>
                
                <div class="table">
                	<h3><?=$xs?>本月排名</h3>
                    <div class="table1">
                	<table>
                    	<tr>
        <td align="center">排名</td>
        <td align="center">会员编号</td>
        <td align="center">会员姓名</td>
        <td align="center">业绩</td>
    </tr>
	 <?php
     $i=1;
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT id FROM `member` WHERE ispay>=1 ".$_SESSION['Searchul']." order by rejine ";
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
      	$sql = "SELECT id,userid,ulevel,username,rejine FROM `member` WHERE ispay>=1 ".$_SESSION['Searchul']." order by rejine desc limit 10 ";//".$start.",".$pagesize;
		if(getAll($sql)){
        if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$ul=ulevel($row['ulevel']);
	  ?>
                    	<tr>
        <td align="center"><?=$i?></td>
        <td align="center"><?=$row['userid']?><?php if($row['ispay']==2){?>[空单会员]<?php }?></td>
        <td align="center"><?=$row['username']?></td>
        
        <td align="center"><?=$row['rejine']?></td>
        </tr>
      <?php
      $i++;
			}
        }
        
        }else{
            ?>
                
                <tr>
                    <td colspan="4" align="center">暂无数据</td>
        </tr>
                <?php
        }
	  ?>

                    	<tr>
<!--                        	<th colspan="20">
                            
                            <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>-->
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