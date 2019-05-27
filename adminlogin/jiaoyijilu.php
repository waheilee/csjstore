<?php
include("admin_check.php");
include_once("action.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
include_once("../class/member_class.php");
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
		$_SESSION['SearchTime']="and bdate>='".$TimeStart."' and bdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and number='".$SearchContent."' ";
		}if ($SearchType==2){
		    #搜索会员编号
		    $_SESSION['Search']="and buynickname='".$SearchContent."'";
		}if ($SearchType==3){
		    #搜索会员编号
		    $_SESSION['Search']="and sellnickname='".$SearchContent."' ";
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

if ($_POST['button']){//买入
    
    $id=$_POST['id'];
    
    $dd = getOne("SELECT * FROM sellbuy where id=".$id."");
   
    
    if ($dd['issend']==0) {//挂卖中
        
        $_bonus_cl = new bonus_class();
        $_bonus_cl->pphome($id);
        $_bonus_cl->b0bonus();
        
        action::record("手动匹配", $dd['uid'], $_SESSION['adminid'], $dd['number']);
        
        echo "<script language=javascript>alert('手动匹配成功.');window.location.href='?'</script>";
        
    }else {
        echo "<script language=javascript>alert('订单已匹配，请刷新后重试.');window.location.href='?'</script>";
    }
}
if ($_POST['button4']){//买入
        
        $_bonus_cl = new bonus_class();
        $_bonus_cl->ppbuy();
        $_bonus_cl->b0bonus();
        
        action::record("自动匹配", $dd['uid'], $_SESSION['adminid'], $dd['number']);
        
        echo "<script language=javascript>alert('自动匹配成功.');window.location.href='?'</script>";
        
   
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>待匹配记录</title>
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
<!--
function SelectAll() {
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		e.checked=!e.checked;
	}
}
-->
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
                    		 <option value="1">订单编号</option>
                    		 <option value="2">买家编号</option>
                             <option value="3">卖家编号</option>
            <!--<option value="2">电子币</option>
             <option value="3">电子币</option>
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
                	<h3>待交易记录</h3>
                    <div class="table1">
                	<table>
                    	<tr>
                    	        <td>订单编号</td>
                    	        <td>类型</td>
                            	<td>买家编号</td>
                            	<td>卖家编号</td>
                            	<td>商品名称</td>
								<td>交易时间</td>
								<td>匹配时间</td>
								<!--  
								<td>买入时间</td>
								<td>付款时间</td>
								<td>完成时间</td>
								-->
								<td>操作</td>

                        </tr>
						<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `buysell` WHERE isgrant=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `buysell` WHERE isgrant=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by cdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
			   
	  ?>
                    	<tr>
                    	<form name="form" method="post" action="?id=<?=$row['id']?>">
                    	
        <td align="center"><?=$row['ordersnumber']?></td>
        <td align="center"><?php if ($row['lx']==1){?>买入<?php }elseif($row['lx']==2){?>挂售<?php }?></td>
        <td align="center"><?=$row['buynickname']?></td>
        <td align="center"><?=$row['sellnickname']?></td>
        
        <td align="center"><?=$row['goodsname']?></td>
      
        <td align="center"><?=$row['cdate']?></td>
        
        <td align="center"><?=$row['sdate']?></td>
   
        
        <td align="center">
        <input type="text" value="<?=$row['id']?>" name="id" style="display:none"/>
        
        <?php  if ($row['isgrant']==0){//未交易?>
	    <input name="button" type="submit" style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;" id="button" value="匹配" onClick="{if(confirm('您确定要匹配吗?')){this.document.selform.submit();return true;}return false;}"></input>
	   
	    <?php }?>
	    
	        
                				    
        </td>
        
        </form>
      </tr>
	   <?php
			}
		}
	  ?>
                        
                    	<tr>
                        	<th colspan="10">
                          
                            <input name="button4" type="submit" class="btn3" id="button4" value="自动匹配" onClick="{if(confirm('您确定要自动匹配吗?')){this.document.selform.submit();return true;}return false;}">
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