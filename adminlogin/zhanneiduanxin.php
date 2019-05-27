<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(5,17);
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
		$_SESSION['SearchTime']="and fdate>='".$TimeStart."' and fdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."'";
		}elseif($SearchType==2){
			#搜索会员编号
			$_SESSION['Search']="and snickname='".$SearchContent."'";
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

#删除记录
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_delete_cl('mail',$id);
	}
	echo "<script language=javascript>alert('删除完成.');window.location.href='?'</script>";
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>站内短信</title>
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
                	
                    	<div class="left1">
                    		 <select name="SearchType" id="SearchType">
            <option value="1">发信会员</option>
            <option value="2">收信会员</option>
          </select>
                    <input type="text" name="SearchContent" id="SearchContent">
                            
                  <input type="submit" name="Search" id="Search" value="搜索">   
                    	</div>
                        <div class="right1">
                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                            
                		</div>
            		
             	</div>
                
                <div class="table">
                	<h3>站内短信</h3>
                    <div class="table1">
                	<table>
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">发信会员</td>
        <td align="center">收信会员</td>
        <td align="center">标题</td>
        <td align="center">发信时间</td>
        <td align="center">查看内容</td>
        </tr>
		 <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `mail` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `mail` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by fdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
                    	 <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['snickname']?></td>
        <td align="center"><?=$row['title']?></td>
        <td align="center"><?=$row['fdate']?></td>
        <td align="center"><input name="" type="button" class="button" value="查看" onClick="window.location.href='../member/mailcontent.php?mid=<?=$row['id']?>'"></td>
      </tr>
      <?php
			}
		}
	  ?>
                        
                    	<tr>
                        	<th colspan="5">
                                <input type="submit" value="删除短信" name="button4" class="shanchu" id="button4" onClick="{if(confirm('您确定要删除该短信吗?')){this.document.selform.submit();return true;}return false;}"/>
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