<?php
include("admin_check.php");
include_once("../function.php");
include_once("../bonus.php");
session_start();
header("Content-Type: text/html;charset=utf-8");

if ($_GET['did']==""){
	$did=$_SESSION['did'];
}else{
	$did=$_GET['did'];
	$_SESSION['did']=$_GET['did'];	
}
if ($did=="") alert('查询错误','admin_bonustime.php');

#搜索会员
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	$SearchType=$_POST['SearchType'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and b.bdate>='".$TimeStart."' and b.bdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and m.nickname='".$SearchContent."'";
		}
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
<title>积分明细</title>
<script language="javascript"> 
<!--     
//导出excel
function exportExcel(DivID){
var oXL = new ActiveXObject("Excel.Application"); 
  var oWB = oXL.Workbooks.Add(); 
  var oSheet = oWB.ActiveSheet;  
  var sel=document.body.createTextRange();
  sel.moveToElementText(daochu);
  sel.select();
  sel.execCommand("Copy");
  oSheet.Paste();
  oXL.Visible = true;
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
<form name="form1" method="post" action="?did=<?=$did?>">
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
                	
                    	<div class="left1">
                        	 <select name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
          </select>
          <input type="text" name="SearchContent" id="SearchContent">
          <input type="submit" name="Search" id="Search" class="btn1" value="搜索">
          <input name="input" type="button" class="btn1" value="返回" onClick="javascript:history.go(-1);">
          <td height="4" align="center"><input type="button" name="dayin" id="dayin" class="btn1" value="导出表格" onClick="window.location.href='excel.php?table=bonus&time=<?php echo $did;?>'"></td>
                    	</div>
                        
            		
             	</div>
                
                <div class="table">
                	<h3>积分明细</h3>
                    <div class="table1">
                	<table>
                    	<tr>
      	<td align="center">会员编号</td>
        <td align="center">会员姓名</td>
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
        <td align="center" >操作</td>
        </tr>
	<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `member` as m left join `bonus` as b on m.id=b.uid WHERE b.did=".$did." ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `member` as m left join `bonus` as b on m.id=b.uid WHERE b.did=".$did." ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by b.bdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
        <tr>
        <td align="center"><?=$row['userid']?></td>
        <td align="center"><?=$row['username']?></td>
        <td <?=$bonus1xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=1"><?=$row['b1']?></a></td>
        <td <?=$bonus2xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=2"><?=$row['b2']?></a></td>
        <td <?=$bonus3xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=3"><?=$row['b3']?></a></td>
        <td <?=$bonus4xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=4"><?=$row['b4']?></a></td>
        <td <?=$bonus5xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=5"><?=$row['b5']?></a></td>
        <td <?=$bonus6xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=6"><?=$row['b6']?></a></td>
        <td <?=$bonus7xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=7"><?=$row['b7']?></a></td>
        <td <?=$bonus8xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=8"><?=$row['b8']?></a></td>
        <td <?=$bonus9xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=9"><?=$row['b9']?></a></td>
        <td <?=$bonus10xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=10"><?=$row['b10']?></a></td>
        <td <?=$bonus11xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>&lx=11"><?=$row['b11']?></a></td>
        <td <?=$bonus0xs;?> align="center" ><a href="jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>"><?=$row['b0']?></a></td>
        <td align="center" >
          <input type="button" class="button" id="button" name="button" value="查看" onClick="window.location.href='jiangjinmingxi.php?uid=<?=$row['uid']?>&bdate=<?=$row['bdate']?>'" />
        </td>
      </tr>
      <?php
			}
		}
	  ?>
                    	<tr>
                        	<th colspan="14">
                            
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
</div></form>
</body>
</html>