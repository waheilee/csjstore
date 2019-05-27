<?php
include("admin_check.php");
include_once("../function.php");
include_once("action.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(2,4);
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
		$_SESSION['SearchTime']="and tdate>='".$TimeStart."' and tdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."'";
		}else if($SearchType==2){
			$_SESSION['Search']="and bdname='".$SearchContent."'";
		}
	}else{
		if ($SearchType==1){
			$_SESSION['Search']=NULL;
		}elseif($SearchType==2){
			#搜索未发放
			$_SESSION['Search']="and isgrant=0";
		}elseif($SearchType==3){
			#搜索已发放
			$_SESSION['Search']="and isgrant=1";
		}elseif($SearchType==4){
			#搜索已发放
			$_SESSION['Search']="and isgrant=2";
		}
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

#提现确认
if ($_POST['button']){
$cheuid_arr = $_POST['UID'];
	$tixian['isgrant']=1;
	foreach ((array)$cheuid_arr as $id)
	{
	    $ti=que_select_cl('tixian',$id);
	    if($ti['isgrant'] == 0) {
            action::record("提现确认", $ti['uid'], $_SESSION['adminid'], $ti['num']);

            edit_update_cl('tixian', $tixian, $id);
        }
	}
	echo "<script language=javascript>alert('提现确认完成.');window.location.href='?'</script>";
}

#删除记录
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
		$tixian=que_select_cl('tixian',$id);
		$us=que_select_cl('member',$tixian['uid']);
		
		if($tixian['isgrant'] == 0){
			$xiugai['cfxf']=$us['cfxf']+$tixian['num'];
			action::record("提现退回", $tixian['uid'], $_SESSION['adminid'],"提现退回");
			
			
			edit_update_cl('member',$xiugai,$us['id']);
			//edit_delete_cl('tixian',$id);
			$tixian['isgrant']=2;
			edit_update_cl('tixian',$tixian,$id);
			
			echo "<script language=javascript>alert('提现退回完成,提现金额退回账户.');window.location.href='?'</script>";
				
		}else{
			echo "<script>alert('已确认记录不能删除');</script>";
		}
    	
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
<title>提现管理</title>
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
        	<!-- #EndLibraryItem --><form action="" method="post" name="form1">
<div class="mainBox">
            	<div class="title clearfix">
                	
                    	<div class="left">
                    		 <select style="width:127px;" name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
            
            <option value="2">未发放</option>
            <option value="3">已发放</option>
            <option value="4">退回</option>
          </select>
                            <input type="text" name="SearchContent" id="SearchContent">
                             <input type="submit" name="Search" id="Search" class="btn1" value="搜索">
                            <input type="button" value="未发放" name="dayin" id="dayin" onClick="window.location.href='excel.php?table=tixian'"/>
                            <input type="button" value="已发放" name="dayin" id="dayin" onClick="window.location.href='excel.php?table=tixian1'"/>
                            <input type="button" value="已退回" name="dayin" id="dayin" onClick="window.location.href='excel.php?table=tixian2'"/>
							 
                    	</div>
                        <div class="right">
                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                		</div>
            	
             	</div>
                
                <div class="table">
                	<h3>提现管理</h3>
                    <div class="table1">
                	<table>
                    	<tr>
                            	<td><input type="checkbox" value="" name="name"/></td>
                            	<td>会员编号</td>
                            	<td>会员姓名</td>
                            	<td>提现金额</td>
                            	<!-- <td>手续费</td> -->
                            	 
                            	<!-- <td>平台管理费</td> -->
                            	<td>实发金额</td>
                            	<td>开户银行</td>
                            	<td>开户账号</td>
                            	<td>开户姓名</td>
                            	<td>开户地址</td>
                            	<td>提现时间</td>
                            	<!--<td>服务中心</td>-->
                            	<td>审核状态</td>
                        </tr>
						<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `tixian` WHERE lx=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
	  
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
      	$sql = "SELECT * FROM `tixian` WHERE lx=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by tdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
                    	 <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$row['num']?></td>
        <!-- <td align="center"><?=$row['shui']?></td> -->
        <!-- <td align="center"><?=$row['shui1']?></td> -->
     
        <td align="center"><?=$row['mey']?></td>      
        <td align="center"><?=$row['bankname']?></td>
        <td align="center"><?=$row['bankcard']?></td>
        <td align="center"><?=$row['bankusername']?></td>
        <td align="center"><?=$row['bankaddress']?></td>
        <td align="center"><?=$row['tdate']?></td>
       
        <td align="center"><?php if ($row['isgrant']==1){?>已发放<?php }elseif($row['isgrant']==0){?> <font color="#FF0000">未发放</font><?php }elseif($row['isgrant']==2){?> <font color="#CD8500">退回</font><?php }?></td>
      </tr>
      <?php
			}
		}
	  ?>
                        
                    	<tr>
                        	<th colspan="12">
                            <input type="submit" id="button" value="提现确认" name="button" onClick="{if(confirm('您确定要进行提现确认吗?')){this.document.selform.submit();return true;}return false;}"/>
                            	<input name="button4" type="submit" id="button4" value="提现退回" onClick="{if(confirm('您确定要退回吗?')){this.document.selform.submit();return true;}return false;}"/>
                            <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div>        	</form>    
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>