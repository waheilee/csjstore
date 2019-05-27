<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(5,16);
#搜索新闻
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and newstime>='".$TimeStart."' and newstime<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索新闻标题
			$_SESSION['Search']="and newstitle like '%".$SearchContent."%'";
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

#发布新闻
if ($_POST['button']){
$cheuid_arr = $_POST['UID'];
	$news['isfb']=1;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('shipin',$news,$id);
	}
	echo "<script language=javascript>alert('视频前台显示设置完成.');window.location.href='?'</script>";
}

#停止发布
if ($_POST['button2']){
$cheuid_arr = $_POST['UID'];
    $news['isfb']=0;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('shipin',$news,$id);
	}
	echo "<script language=javascript>alert('视频已停止显示.');window.location.href='?'</script>";
}

#删除新闻
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
	    
	    $t=getOne("select name from shipin where id={$id}");
	    $tu=$t['name'];
	    $path='../upload2/'.$tu;
    	delDirAndFile($path,$delDir = FALSE);
    	edit_delete_cl('shipin',$id);
    	echo "<script language=javascript>alert('删除视频完成.');window.location.href='?'</script>";
    	
	}

	echo "<script language=javascript>alert('删除视频完成.');window.location.href='?'</script>";
}
//删除文件
function delDirAndFile($path,$delDir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
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
<title>视频管理</title>
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
	<?php include 'header.php';?>
   
    
    
	<section id="main" class="clearfix">
		<!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
		<?php include 'left.php';?>
		<!-- #EndLibraryItem -->
<div id="conts" cl ass="heightLine-1">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	 <?php include 'title.php';?>
        	<!-- #EndLibraryItem --><form name="form1" method="post" action="?">
<div class="mainBox">
            
                
                <div class="table">
                	<h3>视频管理</h3>
                    <div class="table1">
                	<table>
                    	<tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">序号</td>
        <td align="center">视频标题</td>
        <td align="center">上传时间</td>
        <td align="center">是否显示</td>
       
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `shipin` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `shipin` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['id']?></td>
  
		 <td align="center"><?=$row['biao']?></td>
        <td align="center"><?=$row['date']?></td>
        <td align="center"><?php if ($row['isfb']==1){?>已显示<?php }else{?><font color="#FF0000">已隐藏</font><?php }?></td>
        </td>
      </tr>
      <?php
			}
		}
	  ?>
                        
                    	<tr>
                        	<th colspan="5">
                            <input type="submit" name="button" id="button" value="前台显示" onClick="{if(confirm('您确定要前台显示该视频吗?')){this.document.selform.submit();return true;}return false;}"/>
                            	<input type="submit" value="停止显示" name="button2" id="button2" onClick="{if(confirm('您确定要停止显示视频吗?')){this.document.selform.submit();return true;}return false;}"/>
                                <input type="submit" value="删除视频" name="button4" id="button4" onClick="{if(confirm('您确定要删除视频吗?')){this.document.selform.submit();return true;}return false;}"/>
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