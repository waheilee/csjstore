<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/system_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
$_systemyeji=new system_class();
//checkqx(4,14);
#搜索商品
if ($_POST['Search']){
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
    $Searchlx=$_POST['Searchlx'];
    if($Searchlx<>-1){
        $_SESSION['Searchlx']=" and lx = $Searchlx "; 
    }else{
        $_SESSION['Searchlx']=NULL;
    }
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and sdate>='".$TimeStart."' and sdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;
	}
        
}else{
    $TimeStart=NULL;
    $TimeEnd=NULL;
    $Searchlx=-1;
	if ($_GET['page']==NULL){
        
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
        $_SESSION['Searchlx']=NULL;
	}
}


//if ($_POST['button4']){
//$cheuid_arr = $_POST['UID'];
//	foreach ((array)$cheuid_arr as $id)
//	{
//    	edit_delete_cl('orders2',$id);
//	}
//	echo "<script language=javascript>alert('删除订单完成.');window.location.href='?'</script>";
//}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>进销记录</title>
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
            	<div class="title clearfix">
                        <div class="right1">
                            <select name="Searchlx" id="Searchlx">
                                <option value="-1">全部</option>
                                <option <?php if(0==$Searchlx){?>selected<?php }?> value="0">入库</option>
                                <option <?php if(1==$Searchlx){?>selected<?php }?> value="1">出库</option>
                            </select>
                        	<span> 搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                            <input type="submit" name="Search" id="Search" value="搜索" />
                             <input type="submit"  value="清空" />
                		</div>
<!--                    <div class="right" id="tablit">
                        	<span>导出：</span>
                            <input type="button" value="全部" name="name" onClick="window.location.href='excel.php?table=rk'"/>
                            <input type="button" value="今日" name="name" onClick="window.location.href='excel.php?table=rk2'"/>
                        </div>-->
                      
            		
             	</div>
                
                <div class="table">
<!--                	<ul class="clearfix">
                    	<li>
                        	未发货
                        </li>
                    	<li>
                        	已发货
                        </li>
                    	<li>
                        	已退款
                        </li>
                    
                    </ul>-->
                    <div class="table1" style="overflow-x: scroll">
                	<table>
                    	<tr>
      	<td height="21" align="center">
      	  <input type="checkbox" name="checkbox" onclick="SelectAll() "></td>
        <td align="center">类型</td>
        <td align="center">编号</td>
        <td align="center">时间</td>
        <td align="center">操作</td>
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT id FROM `orders11` WHERE 1=1 ".$_SESSION['Searchlx']." ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
		
//		$jh="SELECT * FROM `member` WHERE ispay>0";
//		if($jhq = mysql_query($jh)){
//		while ($row2=mysql_fetch_array($jhq)){
      	$sql = "SELECT * FROM `orders11` WHERE 1=1 ".$_SESSION['Searchlx']." ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by sdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
                    $z= getMemberbyID($row['uid']);
	  ?>
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?php if($row['lx']==0){?>入库<?php }else{?>出库<?php }?></td>
        <td align="center"><?php if($row['uid']<>0){?><?=$z['nickname']?><?php }else{?>系统<?php }?></td>
<!--        <td align="center"><?=$row['ordersnumber']?></td>-->
        <td align="center"><?=$row['sdate']?></td>
        <td align="center">
          <input type="button" class="button" id="button3" name="button3" value="查看" onClick="window.location.href='rkxq.php?oid=<?=$row['id']?>&page=<?=$p?>'" />
        </td>
      </tr>
      <?php
			}
		}
		//}}
	  ?>
                        
                    	<tr>
                        	<th colspan="20">
                            <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                   
                    </div> 
                
                </div>
                
                
            </div>    </form>        
        </div>
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