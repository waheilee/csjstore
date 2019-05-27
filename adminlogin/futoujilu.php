<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
include_once("../class/member_class.php");
include_once("../class/ulevel_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
//checkqx(2,5);
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
		$_SESSION['SearchTime']="and udate>='".$TimeStart."' and udate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."'";
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
		}
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

#充值确认
if ($_POST['button']){
$cheuid_arr = $_POST['UID'];
	$_bonus=new bonus_class();
	$_member=new member_class();
	$_ulevel_class=new ulevel_class();
	foreach ((array)$cheuid_arr as $id)
	{
		$ulevelup=que_select_cl('ulevelup',$id);
		if ($ulevelup['issh']==0){
			$us=que_select_cl('member',$ulevelup['sid']);
			$ul=ulevel($ulevelup['uplevel']);
			$us_update['ulevel']=$ul['ulevel'];
// 			$us_update['zjulevel']=$ul['ulevel'];
			$us_update['lsk']=$ul['lsk'];
// 			$us_update['sgb']=$us['sgb']+$ulevelup['cha'];
			$us_update['dan']=$ul['dan'];
			edit_update_cl('member',$us_update,$us['id']);
			$cc_xiugai['issh']=1;
    		edit_update_cl('ulevelup',$cc_xiugai,$id);
// 			$shengyu=$_bonus->b1bonus($us['id'],$us['reid'],$ulevelup['cha']);
// 			$_member->addArea($us['id'],$us['treeplace'],$shengyu);
			$_systemyeji=new system_class();
			$_systemyeji->yejitongji(0,0,$ulevelup['cha'],0,0,0,0);
// 			$me=$_member->getMemberbyID($us['id']);
// 			$_ul=$_ulevel_class->getulevelbyulevel($me['ulevel']);
// 			$b5=$_ul['yl6']/100*$ulevelup['cha'];
// 			$me_update['b5']=$me['b5']+$b5;
// 			edit_update_cl('member',$me_update,$me['id']);
			$_bonus->addArea($us['id'], $us['treeplace'], $ulevelup['cha']);
		}
	}
	echo "<script language=javascript>alert('升级确认完成.');window.location.href='?'</script>";
}

#删除记录
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
		$ulevelup=que_select_cl('ulevelup',$id);
		if ($ulevelup['issh']==0){
		   $us=que_select_cl('member',$ulevelup['uid']);
		   $us_update['sgb']=$us['sgb']+$ulevelup['cha'];
		   edit_update_cl('member',$us_update,$ulevelup['uid']);
		   edit_delete_cl('ulevelup',$id);
		}else {
			edit_delete_cl('ulevelup',$id);
		}
	}
	echo "<script language=javascript>alert('删除完成,已退款.');window.location.href='?'</script>";
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>复投记录</title>
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/jihuohuiyuan.css">
<script src="js/jquery.js"></script>
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
 //先声明Excel插件、Excel工作簿等对像
 var jXls, myWorkbook, myWorksheet;
 
 try {
  //插件初始化失败时作出提示
  jXls = new ActiveXObject('Excel.Application');
 }catch (e) {
  alert("无法启动Excel!\n\n如果您确信您的电脑中已经安装了Excel，"+"那么请调整IE的安全级别。\n\n具体操作：\n\n"+"工具 → Internet选项 → 安全 → 自定义级别 → 对没有标记为安全的ActiveX进行初始化和脚本运行 → 启用");
  return false;
 }
 
 //不显示警告 
 jXls.DisplayAlerts = false;
 
 //创建AX对象excel
 myWorkbook = jXls.Workbooks.Add();
 //myWorkbook.Worksheets(3).Delete();//删除第3个标签页(可不做)
 //myWorkbook.Worksheets(2).Delete();//删除第2个标签页(可不做)
 
 //获取DOM对像
 var curTb = document.getElementByIdx_x(DivID);
 
 //获取当前活动的工作薄(即第一个)
 myWorksheet = myWorkbook.ActiveSheet; 
 
 //设置工作薄名称
 myWorksheet.name="NP统计";
 
 //获取BODY文本范围
 var sel = document.body.createTextRange();
 
 //将文本范围移动至DIV处
 sel.moveToElementText(curTb);
 
 //选中Range
 sel.select();
 
 //清空剪贴板
 window.clipboardData.setData('text','');
 
 //将文本范围的内容拷贝至剪贴板
 sel.execCommand("Copy");
 
 //将内容粘贴至工作簿
 myWorksheet.Paste();
 
 //打开工作簿
 jXls.Visible = true;
 
 //清空剪贴板
 window.clipboardData.setData('text','');
 jXls = null;//释放对像
 myWorkbook = null;//释放对像
 myWorksheet = null;//释放对像
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
<div id="conts" class="celan heightLine-1">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	<?php include 'title.php';?>
        	<!-- #EndLibraryItem -->
<div class="mainBox">
            	<div class="table4">
                	<table>
                    	<tr>
                        	<th colspan="7">复投记录</th>
                        </tr>
                        <tr>
        
        <td align="center">复投会员编号</td>
        <td align="center">复投会员姓名</td>
       
        <td align="center">申请级别</td>
        <td align="center">金额</td>
       
        <td align="center">操作日期</td>
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `ulevelup2` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `ulevelup2` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by udate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$yul=ulevel($row['ylevel']);
			$uul=ulevel($row['uplevel']);
			$sid=getOne("select * from to_admin where id=".$row['sid']."");
			
	  ?>
      <tr>
        
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
       
        <td align="center"><?=$uul['lvname']?></td>
        <td align="center"><?=$row['cha']?></td>
        
        <td align="center"><?=$row['udate']?></td>
      </tr>
      <?php
			}
		}
	  ?>
                        
                    	<tr>
                        	<th colspan="7"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                    </table>
                
                
                </div>
                
                
                
                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>