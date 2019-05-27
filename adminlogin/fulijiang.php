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
		$orders2=que_select_cl("fulijiang",$id);
		if ($orders2['isff']==0){
			$orders2['isff']=1;
			$orders2['fdate']=now();
			edit_update_cl('fulijiang',$orders2,$id);
			$idd=getOne("select uid from fulijiang where id={$id}");
			edit_sql("update `member` set area1=0,area2=0 where id=".$idd['uid']."");
		}else{
		    echo "<script language=javascript>alert('请勿重复审核!.');window.location.href='?'</script>";
		    return;
		}
	}
	echo "<script language=javascript>alert('审核通过完成.');window.location.href='?'</script>";
}


if ($_POST['button2']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
	    $orders2=que_select_cl('fulijiang',$id);
	    if ($orders2['isff']==0){
		$uporders2['isff']=2;
		$uporders2['fdate']=now();
		edit_update_cl('fulijiang',$uporders2,$id);
	    }else{
	        echo "<script language=javascript>alert('已通过审核请勿驳回.');window.location.href='?'</script>";
	        return;
	    }
	}
	echo "<script language=javascript>alert('审核驳回完成.');window.location.href='?'</script>";
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
<title>福利奖审核</title>
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
			<form name="form1" method="post" action="?">
<div class="mainBox">
<!-- 
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
							input type="button" value="已退货" name="dayin" id="dayin" onClick="window.location.href='excel.php?table=orders111'"/> 
                		</div>
                      
            		
             	</div>
                 -->
                <div class="table">
                <!-- 
                	<ul class="clearfix">
                    	<li>
                        	未发货
                        </li>
                    	<li>
                        	已发货
                        </li>
                    </ul>
                       -->	
                    <div class="table1">
                	<table>
                    	<tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" onclick="SelectAll() "></td>
        <td align="center">序号</td>
        <td align="center">会员id</td>
        <td align="center">会员姓名</td>
        <td align="center">申请等级</td>
         <td align="center">会员业绩</td>
          <td align="center">推荐人数</td>
        <td align="center">申请时间</td>
        <td align="center">审核时间</td>
        <td align="center">当前状态</td>
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `fulijiang` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";

	  	
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
		
		
		
      	$sql = "SELECT * FROM `fulijiang` WHERE 1=1".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by date desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
      <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
      	<td align="center"><?=$row['id']?></td>
        <td align="center"><?=$row['uid']?></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center">第<?=$row['lv']?>级别</td>
        <td align="center"><?=$row['yeji']?></td>
        <td align="center"><?=$row['recount']?></td>
        <td align="center"><?=$row['date']?></td>
        <td align="center"><?=$row['fdate']?></td>
        <td align="center"><?php if($row['isff']==0){?>未通过<?php }else if($row['isff']==1){ ?>已通过<?php }else if($row['isff']==2){?>驳回<?php }?></td>
      </tr>
      <?php
			}
		}
	
	  ?>
                        
                    	<tr>
                        	<th colspan="10">
                            <input type="submit" id="button" value="审核通过" name="button" onClick="{if(confirm('您确定审核通过吗?')){this.document.selform.submit();return true;}return false;}"/>
                            <input type="submit" id="button2" name="button2" value="审核驳回" onClick="{if(confirm('您确定审核驳回吗?')){this.document.selform.submit();return true;}return false;}"/>
                            <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                 
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