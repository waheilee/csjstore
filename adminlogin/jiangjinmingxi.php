<?php
include("admin_check.php");
include_once("../function.php");
include_once("../bonus.php");
session_start();
header("Content-Type: text/html;charset=utf-8");

$cx="&uid=".$_GET['uid']."&bdate=".$_GET['bdate']."&lx=".$_GET['lx']."";
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
		$_SESSION['SearchTime']="and bdate>='".$TimeStart."' and bdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."'";
		}else{
            $_SESSION['Search']=NULL;
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
<title>积分明细查询</title>
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
        	<!-- #EndLibraryItem --><form action="" name="form1" method="post">
<div class="mainBox">
            	<div class="title clearfix">
                	
                    	<div class="left1">
                        	<select name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
          </select><input type="text" name="SearchContent" id="SearchContent">
                    	</div>
                        <div class="right1">
                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                            <input type="submit" name="Search" id="Search" class="btn1" value="搜索">
                        </div>
            		
             	</div>
                
                <div class="table">
                	<h3>积分明细查询</h3>
                    <div class="table1">
                	<table>
                    	<tr>
                            	<td>日期</td>
                            	<td>会员</td>
                            	<td>类型</td>
                            	<td>摘要</td>
                            	<td>相关会员</td>
                            	<td>金额</td>
                        </tr>
						 <?php
                if($_GET['uid']){
			$a="and uid='".$_GET['uid']."'";
		}
		else{
			$a="and uid!=0";
		}
                if($_GET['lx']){
                    $b="and lx={$_GET['lx']}";

                }else{
                    $b="";
                }
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `bonuslaiyuan` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." $a $b ";
	  //	print_r($sql);
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
		
      	$sql = "SELECT * FROM `bonuslaiyuan` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." $a $b order by bdate desc,id desc limit ".$start.",".$pagesize;
      
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
                    	<tr>
          <td align="center" ><?=$row['bdate'];?></td>
          <td align="center" ><?=$row['nickname']?></td>
          <?php
          switch ($row['lx']){
				case 1:
					$lx=$bonus1name;
					break;
				case 2:
					$lx=$bonus2name;
					break;
				case 3:
					$lx=$bonus3name;
					break;
				case 4:
					$lx=$bonus4name;
					break;
				case 5:
					$lx=$bonus5name;
					break;
				case 6:
					$lx=$bonus6name;
					break;
				case 7:
					$lx=$bonus7name;
					break;
				case 8:
					$lx=$bonus8name;
					break;
				case 9:
					$lx=$bonus9name;
					break;
				case 10:
					$lx=$bonus10name;
					break;
              case 11:
                  $lx=$bonus11name;
                  break;
				case 12:
					$lx=$bonus12name;
					break;
			
		  }
		  ?>
          <td align="center" ><?=$lx?></td>
          <td align="center" ><?=$row['beizhu']?></td>
          <td align="center" ><?=$row['ynickname']?></td>
          <td align="center" ><?=$row['jine']?></td>
        </tr>
      <?php
			}
		}
	  ?>
                    	<tr>
                        	<th colspan="6">
                            
                            <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div></form>
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>