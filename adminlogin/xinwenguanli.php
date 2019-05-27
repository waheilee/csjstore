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
	$news['isedit']=1;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('news',$news,$id);
        $num=getOne("select table_name from information_schema.columns where table_schema = 'isnews' and column_name='g{$id}'");
        if($num){
            edit_sql("update isnews set n{$id}=0 ");
        }
	}
	echo "<script language=javascript>alert('新闻发布完成.');window.location.href='?'</script>";
}

#停止发布
if ($_POST['button2']){
$cheuid_arr = $_POST['UID'];
	$news['isedit']=0;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('news',$news,$id);
        $num=getOne("select table_name from information_schema.columns where table_schema = 'isnews' and column_name='g{$id}'");
        if($num){
            edit_sql("update isnews set n{$id}=1 ");
        }
        
	}
	echo "<script language=javascript>alert('新闻已停止发布.');window.location.href='?'</script>";
}

#删除新闻
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
        
        $num=getOne("select table_name from information_schema.columns where table_schema = 'isnews' and column_name='g{$id}'");
        if($num){
            edit_sql("ALTER TABLE isnews DROP COLUMN n{$id}");
        }
    	edit_delete_cl('news',$id);
	}
	echo "<script language=javascript>alert('删除新闻完成.');window.location.href='?'</script>";
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>新闻管理</title>
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
            	<div class="title clearfix">
                	
                    	<div class="left1">
                    		<select name="SearchType" id="SearchType">
            <option value="1">新闻标题</option>
          </select>
                           <input type="text" name="SearchContent" id="SearchContent">
                            
                    <input type="submit" name="Search" id="Search"  value="搜索">
                    	</div>
                        <div class="right1">
                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                            
                		</div>
            		
             	</div>
                
                <div class="table">
                	<h3>新闻管理</h3>
                    <div class="table1">
                	<table>
                    	<tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">新闻序号</td>
        <td align="center">新闻标题</td>
        <td align="center">发布人</td>
        <td align="center">发布时间</td>
        <td align="center">是否发布</td>
        <td align="center">操作</td>
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `news` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `news` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['id']?></td>
        <td align="center"><?=$row['newstitle']?></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['newstime']?></td>
        <td align="center"><?php if ($row['isedit']==1){?>已发布<?php }else{?><font color="#FF0000">未发布</font><?php }?></td>
        <td align="center">
        <!--<input type="button" class="button" id="button3" name="button3" value="查看" onClick="window.location.href='../web/newsxiangqing.php?nid=<?=$row['id']?>'" />-->&nbsp;
          <input type="button" class="button" id="button5" name="button5" value="修改" onClick="window.location.href='newsupdate.php?nid=<?=$row['id']?>'" />
        
        </td>
      </tr>
      <?php
			}
		}
	  ?>
                        
                    	<tr>
                        	<th colspan="7">
                            <input type="submit" name="button" id="button" value="发布新闻" onClick="{if(confirm('您确定要发布新闻吗?')){this.document.selform.submit();return true;}return false;}"/>
                            	<input type="submit" value="停止发布" name="button2" id="button2" onClick="{if(confirm('您确定要停止发布新闻吗?')){this.document.selform.submit();return true;}return false;}"/>
                                <input type="submit" value="删除新闻" name="button4" id="button4" onClick="{if(confirm('您确定要删除新闻吗?')){this.document.selform.submit();return true;}return false;}"/>
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