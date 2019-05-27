<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
include_once("../class/system_class.php");
session_start();
$sys= getsys();
$_bonus_cl = new bonus_class();
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
<title>会员信息</title>
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/index.css">

<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/jihuohuiyuan.css">

<script src="js/jquery.js"></script>
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
<?php
$_system=new system_class();
$system=$_system->system_right();
$sql = "SELECT * FROM `ulevelup`";
?>
<div id="container">
	
   <!-- #BeginLibraryItem "/Library/header.lbi" -->
   <?php include 'header.php';?>
  
   <!-- #EndLibraryItem -->
<section id="main" class="clearfix">
		<!-- #BeginLibraryItem "/Library/Untitled.lbi" -->
		<?php include 'left.php';?>
		
		<!-- #EndLibraryItem -->
<div id="conts" cl ass="heightLine-1">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	<?php include 'title.php';?>
        	<!-- #EndLibraryItem -->
<div class="table">
            	<table class="table1" cellpadding="0" cellspacing="0" border="0">
                	<tr>
                    	<th colspan="2">上次登陆时间:<?=$_SESSION['sclgdate']?></th>
                    
                    </tr>
					<?php if ($_SESSION['to_admin'] ==admin){?>
					<?php 
					$gudong=getall("select id from member where gudong=1");
					$num=count($gudong);//获取股东人数
					?>
                    <?php
                    
                    $j=getOne("select sum(num) from tixian where uid <>1");
                    $zj=$j['sum(num)'];

                    $td= getOne("select count(id) from member where repath like '%,1,%'");
                    $tdrs=$td['count(id)'];

                    $cp=getOne("select sum(num) from orders2 where uid <>1");
                    $tdcp=$cp['sum(num)'];
                    if($tdcp==NULL){
                        $tdcp=0;
                    }
                    
                    $_y=date("Y");
                    $_m=date("m");
                    $_d=date("d");
                    //本周的第一天和最后一天
                    $date=new DateTime();
                    $date->modify('this week');
                    $first_day_of_week=$date->format('Y-m-d');
                    $date->modify('this week +6 days');
                    $end_day_of_week=$date->format('Y-m-d');
                    
                    $yj3=getOne("select sum(jine) from orders2 where lunci<>2 and lunci<>3 and day(date)=".$_m." and uid <>1");
                    $ryj=$yj3['sum(jine)'];
                    if($ryj==NULL){
                        $ryj=0;
                    }
                    
                    $yj=getOne("select sum(jine) from orders2 where lunci<>2 and lunci<>3 and date>='$first_day_of_week' and date   <=' $end_day_of_week' and uid <>1");
                    $zyj=$yj['sum(jine)'];
                    if($zyj==NULL){
                        $zyj=0;
                    }
                    $yj1=getOne("select sum(jine) from orders2 where lunci<>2 and lunci<>3 and month(date)=".$_m." and uid <>1");
                    $yyj=$yj1['sum(jine)'];
                    if($yyj==NULL){
                        $yyj=0;
                    }
                    
                    $yj2=getOne("select sum(jine) from orders2 where lunci<>2 and lunci<>3 and year(date)=".$_y." and uid <>1");
                    $nyj=$yj2['sum(jine)'];
                    if($nyj==NULL){
                        $nyj=0;
                    }
                    ?>
                	<tr class="red">
                    	<td>本日新增会员：</td>
                    	<td><?=$system['xhyday']?></td>
                    </tr>
                   
                    <tr class="red">
                    	<td>本日新增收入：</td>
                    	<td><?=$system['xyejiday']?></td>
                    </tr>
                    <tr class="red">
                    	<td>本周新增会员：</td>
                    	<td><?=$system['xhydayl']?></td>
                    </tr>
                    <tr class="red">
                    	<td>本周新增收入：</td>
                    	<td><?=$zyj?></td>
                    </tr>
                	<tr class="red">
                    	<td>本月新增会员：</td>
                    	<td><?=$system['xhymonth']?></td>
                    </tr>
					<tr class="red">
                    	<td>本月新增收入：</td>
                    	<td><?=$yyj?></td>
                    </tr>
                	<tr class="red">
                    	<td>年度新增会员：</td>
                    	<td><?=$system['xhyyear']?></td>
                    </tr>
					<tr class="red">
                    	<td>年度新增收入：</td>
                    	<td> <?=$nyj?></td>
                    </tr>
					<?php
						$shouxu=getOne("select sum(jine) from bonuslaiyuan where lx=8");
						$fei=-$shouxu['sum(jine)'];
						if($fei){
							$fei=-$shouxu['sum(jine)'];
						}else{
							$fei=0;
						}
					?>
					<tr class="red">
                    	<td>累计销量：</td>
                    	<td> <?=$tdcp?></td>
                    </tr>
                	<tr class="red">
                    	<td>总会员数：</td>
                    	<td> <?=$tdrs?></td>
                    </tr>
                <?php }?>
                
                </table>
                
                <table class="table2" cellpadding="0" cellspacing="0" border="0">
                	<tr>
                    	<th colspan="2">本次登陆时间:<?=$_SESSION['lgdate']?></th>
                    
                    </tr>
					<?php if ($_SESSION['to_admin'] ==admin){?>
                	<tr class="blue">
                    	<td>待激活会员：</td>
                    	<td><input type="button" id="button" name="button" value="现在处理" onClick="window.location.href='jihuohuiyuan.php'"/>&nbsp;&nbsp;<?=$system['weijh']?></td>
                    </tr>
					
<!--                	<tr class="blue">
                    	<td>待处理实体展厅：</td>
                    	<td><input type="button" id="button" name="button" value="现在处理"  onClick="window.location.href='shitizhanting.php'"/>&nbsp;&nbsp;<?=$system['fwzx']?></td>
                    </tr>-->
                	<tr class="blue">
                    	<td>待处理提现申请：</td>
                    	<td><input type="button" id="button" name="button" value="现在处理" onClick="window.location.href='tixianguanli.php'"/>&nbsp;&nbsp;<?=$system['tixian']?></td>
                    </tr>
                	<tr class="blue">
                    	<td>待处理充值申请：</td>
                    	<td><input type="button" id="button" name="button" value="现在处理" onClick="window.location.href='chongzhiguanli.php'"/>&nbsp;&nbsp;<?=$system['chongzhi']?></td>
                    </tr>
                    <tr class="blue">
                    	<td>待处理升级申请：</td>
                    	<td><input type="button" id="button" name="button" value="现在处理" onClick="window.location.href='shengjishenqing.php'"/>&nbsp;&nbsp;<?=$system['shengji']?></td>
                    </tr>
                    <tr class="blue">
                    	<td>待处理商品订单：</td>
                    	<td><input type="button" id="button" name="button" value="现在处理"  onClick="window.location.href='dingdanguanli.php'"/>&nbsp;&nbsp;<?=$system['dingdan']?></td>
                    </tr>
                <?php }?>
                
                </table>
            
            
            
            </div>
<!--            <br>
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
            
            
            <option value="3">奖金累计排行</option>
             <option value="4">推荐人数排行</option> 
            <option value="5">业绩累计排行</option>
          </select>
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
        <td align="center">编号</td>
        <td align="center">姓名</td>
        <td align="center">级别</td>
        <td align="center">业绩</td>
    </tr>
	 <?php
     $i=1;
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT id FROM `member` WHERE rejine>0 and id<>1 and ispay>=1 ".$_SESSION['Searchul']." order by rejine ";
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
      	$sql = "SELECT id,userid,ulevel,username,rejine FROM `member` WHERE rejine>0 and id<>1 and ispay>=1 ".$_SESSION['Searchul']." order by rejine desc limit 10 ";//".$start.",".$pagesize;
		if(getAll($sql)){
        if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$ul=ulevel($row['ulevel']);
	  ?>
                    	<tr>
        <td align="center"><?=$i?></td>
        <td align="center"><?=$row['userid']?><?php if($row['ispay']==2){?>[空单会员]<?php }?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$ul['lvname']?></td>
        <td align="center"><?=$row['rejine']?></td>
        </tr>
      <?php
      $i++;
			}
        }
        
        }else{
            ?>
                
                <tr>
                    <td colspan="6" align="center">暂无数据</td>
        </tr>
                <?php
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
            
        </div>-->
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>