<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(2,7);
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
		$_SESSION['SearchTime']="and zdate>='".$TimeStart."' and zdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."' or snickname='".$SearchContent."'";
		}
	}else{
		if ($SearchType==1){
			$_SESSION['Search']=NULL;
		}elseif($SearchType==2){
			#搜索现金币
			$_SESSION['Search']="and lx=1";
		}elseif($SearchType==3){
			#搜索现金
			$_SESSION['Search']="and lx=2";
		}elseif($SearchType==4){
			#搜索奖金
			$_SESSION['Search']="and lx=2";
		}
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

#删除记录
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_delete_cl('zhuanzhang',$id);
	}
	alert("删除完成","?");
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>转账记录</title>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/jihuohuiyuan.css">
<script src="js/jquery.js"></script>
<script src="js/lanrenzhijia.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
<SCRIPT LANGUAGE=javascript>

function SelectAll() {
	
	for (var i=0;i<document.form1.UID.length;i++) {
        
		var e=document.form1.UID[i];
        
		e.checked=!e.checked;
	}
}
</script>
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
        	<!-- #EndLibraryItem --><form action="?" method="post" name="form1">
<div class="mainBox">
            	<div class="title clearfix">
                	
                    	<div class="left">
                    		<select name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
<!--            <option value="2">积分</option>
            <option value="3">库存</option>-->
            <!-- <option value="3">现金</option>
            <option value="4">奖金</option> -->
          </select>
                            <input type="text" name="SearchContent" id="SearchContent">
        <input type="submit" name="Search" id="Search" class="btn1" value="搜索">
                            <input type="button" value="导出表格" name="dayin" id="dayin" onClick="window.location.href='excel.php?table=zhuanzhang'"/>
                    	</div>
                        <div class="right">
                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                		</div>
            		
             	</div>
                
                <div class="table">
                	<h3>转账记录</h3>
                    <div class="table1">
                	<table>
                    	<tr>
                            	<td><input type="checkbox" value="" name="name"/></td>
                            	<td>转出会员</td>
                            	<td>转出会员姓名</td>
                            	<td>转入会员</td>
                            	<td>转入会员姓名</td>
                            	<td>转账金额</td>
                            	<td>转账类型</td>
								<td>转账时间</td>

                        </tr>
						<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT id FROM `zhuanzhang` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `zhuanzhang` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by zdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
	  ?>
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$row['snickname']?></td>
        <td align="center"><?=$row['susername']?></td>
        <td align="center"><?=$row['jine']?></td>
        
        <td align="center"><?php if ($row['lx']==1){?>C积分<?php }elseif($row['lx']==2){?>库存<?php }elseif($row['lx']==4){?>激活钱包<?php }?></td>
        <td align="center"><?=$row['zdate']?></td>
      </tr>
	   <?php
			}
		}
	  ?>
                        
                    	<tr>
                        	<th colspan="8">
                          
<!--                            	<input name="button4" type="submit" class="btn3" id="button4" value="删除记录" onClick="{if(confirm('您确定要删除该记录吗?')){this.document.selform.submit();return true;}return false;}">
                            -->
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
</html>