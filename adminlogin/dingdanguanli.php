<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/member_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
//checkqx(4,14);
#搜索商品
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and (date>='".$TimeStart."' and date<='".$TimeEnd."') or (sdate>='".$TimeStart."' and sdate<='".$TimeEnd."')";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索订单编号
			$_SESSION['Search']="and ordersnumber like '%".$SearchContent."%'";
		}else if($SearchType==2){
			$_SESSION['Search']="and userid like '%".$SearchContent."%'";	
		}else if($SearchType==2){
			$_SESSION['Search']="and username like '%".$SearchContent."%'";
		}
	}else{
		$_SESSION['Search']=NULL;	
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}


if ($_POST['button']){
$cheuid_arr = $_POST['UID'];
	
	foreach ((array)$cheuid_arr as $id)
	{
		$bonus_cl=new bonus_class();
		$orders2=que_select_cl("orders2",$id);
		// if($orders2['bid']==0){
			if ($orders2['issend']==0){
				$orders2['issend']=1;
				$orders2['sdate']=now();
				edit_update_cl('orders2',$orders2,$id);
			}
		// }else{
		// 		echo "<script language=javascript>alert('未付款订单不能发货.');window.location.href='?'</script>";

		// }
	}
	echo "<script language=javascript>alert('订单发货完成.');window.location.href='?'</script>";
}


if ($_POST['button2']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
		$orders2=que_select_cl('orders2',$id);
		$member=que_select_cl('member',$orders2['uid']);
		$upmember['sgb']=$member['sgb']+$orders2['sgb'];
		$upmember['gwb']=$member['gwb']+$orders2['gwb'];
		edit_update_cl('member',$upmember,$member['id']);
		$uporders2['issend']=2;
		$orders2['sdate']=now();
		edit_update_cl('orders2',$uporders2,$id);
	}
	echo "<script language=javascript>alert('退款完成.');window.location.href='?'</script>";
}


if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_delete_cl('orders2',$id);
	}
	echo "<script language=javascript>alert('删除订单完成.');window.location.href='?'</script>";
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>订单管理</title>
<SCRIPT LANGUAGE=javascript>

function SelectAll() {
	
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		e.checked=!e.checked;
	}
}



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
<body style="margin-top:-19px">
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
			<form name="form1" method="post" action="?">
<div class="mainBox">
            	<div class="title clearfix">
                	
                    	<div class="left1">
                 <select name="SearchType" id="SearchType">
                    <option value="1">订单编号</option>
                    <option value="2">会员编号</option>
                    <option value="3">会员姓名</option>
                  </select>
                  <input type="text" name="SearchContent" id="SearchContent">
                            
                            
                    	</div>
                        <div class="right1">
                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                            <input type="submit" name="Search" id="Search" value="搜索" />
                                                  导出表格：
                            <input type="button" value="未发货" name="dayin" id="dayin" onClick="window.location.href='excel.php?table=orders'"/>
							<input type="button" value="已发货" name="dayin" id="dayin" onClick="window.location.href='excel.php?table=orders2'"/>
							<!-- <input type="button" value="已退货" name="dayin" id="dayin" onClick="window.location.href='excel.php?table=orders111'"/> -->
                		</div>
                      
            		
             	</div>
                
                <div class="table">
                	<ul class="clearfix">
                    	<li>
                        	未发货
                        </li>
                        <!--
                    	<li>
                        	已发货
                        </li>
                    	<li>
                        	已退款
                        </li>-->
                    
                    </ul>
                    <div class="table1">
                	<table>
                    	<tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" onclick="SelectAll() "></td>
        <td align="center">订单编号</td>
<!--        <td align="center">供应商</td>
        <td align="center">订单类型</td>-->
        <td align="center">付款方式</td>
        <!-- <td align="center">付款状态</td> -->
        <td align="center">物流公司</td>
        <td align="center">物流编号</td>
       
        <td align="center">会员编号</td>
        <td align="center">会员姓名</td>
       
        <td align="center">联系电话</td>
        <td align="center">联系地址</td>
        <td align="center">商品名称</td>
<!--        <td align="center">订单颜色</td>-->
        <td align="center">单价</td>
        <td align="center">总价</td>
        <td align="center">数量</td>
        <!-- <td align="center">总计</td> -->
<!--        <td align="center">订单金额</td>-->
        <td align="center">订单时间</td>
        <td align="center">发货时间</td>
        <!--  <td align="center">提售</td>  -->
        <td align="center">状态</td>
        <td align="center">操作</td>
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `orders2` WHERE issend=0 and isqr=1  ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
	  	
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
		
		
		
      	$sql = "SELECT * FROM `orders2` WHERE  issend=0 and isqr=1   ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
//                    $member=getOne("SELECT useraddress FROM `member` WHERE id={$row['uid']}")
	  ?>
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['ordersnumber']?></td>
<!--        <td align="center"><?=$me['userid']?></td>-->
      <!-- <td align="center">
         <?php 
  
        switch($row['lx']){
            case 1:  $name = leiname(1); echo $name;  break;
            case 2:  $name = leiname(2); echo $name;  break;
            case 3:  $name = leiname(3); echo $name;  break;
//            case 4:  $name = leiname(4); echo $name;  break;
//            case 5:  $name = leiname(5); echo $name;  break;
//            case 6:  $name = leiname(6); echo $name;  break;
//            case 7:  $name = leiname(7); echo $name;  break;
            
            
        	default:echo "商城商品";break;
				}
				$shichang=getOne("select id,shichangjia from goods where id={$row['goodid']}");
        ?>
        </td>
         --> 
				<td align="center"><?php if($row['lx']==1){?>A积分<?php }elseif($row['lx']==2){ ?>C积分<?php }elseif($row['ljlc']==3){ ?>报单<?php } ?></td>
				<!-- <td align="center"><?php if($row['bid']==0){?>已付款<?php }elseif($row['bid']==1){ ?>未付款<?php } ?></td> -->
        <td align="center"><?=$row['logistics']?></td>
        <td align="center"><?=$row['logisticsno']?></td>
        <!-- <td align="center"  ><?=$row['jine']?></td> -->
        <td align="center"><?=$row['userid']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$row['usertel']?></td>
        <td align="center"><?=$row['useraddress']?></td>
        <td align="center"><?=$row['goodname']?></td>
<!--        <td align="center"><?=$row['yanse']?></td>-->
        <td align="center"><?=$row['price']?></td>
        <td align="center"><?=$row['jine']?></td>
        <td align="center"><?=$row['num']?></td>
<!--        <td align="center"><?=$row['jine']?></td>-->
        
        <td align="center"><?=$row['date']?></td>
        <td align="center"><?=$row['sdate']?></td>
        
        <td align="center"><?php if($row['issend']==0){?>未发货<?php }else if($row['issend']==1){ ?>已发货<?php }else if($row['issend']==2){?>已退款<?php }?></td>
        <td align="center">
          <input type="button" class="button" id="button3" name="button3" value="查看" onClick="window.location.href='spxq.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" />
        </a></td>
      </tr>
      <?php
			}
		}
	
	  ?>
                        
                    	<tr>
                        	<th colspan="18">
                            <input type="submit" id="button" value="确认发货" name="button" onClick="{if(confirm('您确定要发货吗?')){this.document.selform.submit();return true;}return false;}"/>
                            	<!--<input type="button" value="删除记录" name="name"/>-->
                            <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                    <table>
                    	<tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="box"  onclick="SelectAll()"></td>
        
        <td align="center">订单编号</td>
<!--        <td align="center">供应商</td>-->
   <!--   <td align="center">订单类型</td> -->   
        <td align="center">付款方式</td>
        <!-- <td align="center">付款状态</td> -->
        <td align="center">物流公司</td>
        <td align="center">物流编号</td>
       
        <td align="center">会员编号</td>
        <td align="center">会员姓名</td>
       
        <td align="center">联系电话</td>
        <td align="center">联系地址</td>
        <td align="center">商品名称</td>
<!--        <td align="center">订单颜色</td>-->
        <td align="center">单价</td>
        <td align="center">总价</td>
        <td align="center">数量</td>
        <!-- <td align="center">总计</td> -->
<!--        <td align="center">订单金额</td>-->
        <td align="center">订单时间</td>
        <td align="center">发货时间</td>
           
        <td align="center">状态</td>
        <td align="center">操作</td>
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `orders2` WHERE issend=1 and isqr=1  ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
	  	
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
		
		
		
      	$sql = "SELECT * FROM `orders2` WHERE  issend=1 and isqr=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$shichang=getOne("select id,shichangjia from goods where id={$row['goodid']}");
                        $me=getOne("SELECT userid FROM `member` WHERE id={$row['uid']}")

	  ?>
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        
      
        <td align="center"><?=$row['ordersnumber']?></td>
          <!--  <td align="center">
        <?php 
         switch($row['lx']){
            case 1:  $name =报单商品; echo $name;  break;
            case 2:  $name =重消商品; echo $name;  break;
//            case 2:  $name = leiname(2); echo $name;  break;
//            case 3:  $name = leiname(3); echo $name;  break;
//            case 4:  $name = leiname(4); echo $name;  break;
//            case 5:  $name = leiname(5); echo $name;  break;
//            case 6:  $name = leiname(6); echo $name;  break;
//            case 7:  $name = leiname(7); echo $name;  break;
            
            
        	default:echo "商城商品";break;
				}
				$shichang=getOne("select id,shichangjia from goods where id={$row['goodid']}");
        ?>
        </td>
        -->
				<td align="center"><?php if($row['lx']==1){?>A积分<?php }elseif($row['lx']==2){ ?>C积分<?php }elseif($row['ljlc']==3){ ?>报单<?php } ?></td>
				<!-- <td align="center"><?php if($row['bid']==0){?>已付款<?php }elseif($row['bid']==1){ ?>未付款<?php } ?></td> -->
        <td align="center"><?=$row['logistics']?></td>
        <td align="center"><?=$row['logisticsno']?></td>
        <!-- <td align="center"  ><?=$row['jine']?></td> -->
        <td align="center"><?=$row['userid']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$row['usertel']?></td>
        <td align="center"><?=$row['useraddress']?></td>
        <td align="center"><?=$row['goodname']?></td>
<!--        <td align="center"><?=$row['yanse']?></td>-->
        <td align="center"><?=$row['price']?></td>
        <td align="center"><?=$row['jine']?></td>
        <td align="center"><?=$row['num']?></td>
<!--        <td align="center"><?=$row['jine']?></td>-->

        <td align="center"><?=$row['date']?></td>
        <td align="center"><?=$row['sdate']?></td>
      
        <td align="center"><?php if($row['issend']==0){?>未发货<?php }else if($row['issend']==1){ ?>已发货<?php }else if($row['issend']==2){?>已退款<?php }?></td>
        <td align="center"><input type="button" class="button" id="button3" name="button3" value="查看" onClick="window.location.href='spxq.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" /></td>
      </tr>
      <?php
			}
		}
		
	  ?>
                        
                    	<tr>
                        	<th colspan="18">
                            
                            <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                    
                    </div>
                    
                    
                
                </div>
                
                
            </div>            
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