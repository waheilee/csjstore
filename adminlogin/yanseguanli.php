<?php
include("admin_check.php");
include_once("../function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
//checkqx(4,13);
#添加颜色
if ($_POST['tianjia']){
    echo "<script language=javascript>window.location.href='tianjialeibie.php'</script>";	
}

#发布颜色
if ($_POST['button']){
$cheuid_arr = $_POST['UID'];
	$goods['isdisplay']=1;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('yanse',$goods,$id);
	}
	echo "<script language=javascript>alert('颜色发布完成.');window.location.href='?'</script>";
}

#停止发布
if ($_POST['button2']){
$cheuid_arr = $_POST['UID'];
	$goods['isdisplay']=0;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('yanse',$goods,$id);
	}
	echo "<script language=javascript>alert('颜色已停止发布.');window.location.href='?'</script>";
}

#删除新闻
if ($_POST['button4']){
	
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
	
    	edit_delete_cl('yanse',$id);
		
		
	}
	echo "<script language=javascript>alert('删除颜色完成.');window.location.href='?'</script>";
}


?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>颜色管理</title>
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
                	
                    	<div class="left1">
                    	 
                              
                            
                    	</div>
                        <div class="right1">
                        	   <input type="submit" value="添加颜色" name="tianjia" id="tianjia"/>
                		</div>
            		
             	</div>
                
                <div class="table">
                	<h3>颜色管理</h3>
                    <div class="table1">
                	<table>
                    	<tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">颜色名称</td>
        <td align="center">颜色序列</td>
         
        <td align="center">排列顺序</td>
        <td align="center">状态</td>
          </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `yanse` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." ";
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
      	$sql = "SELECT * FROM `yanse` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by shun asc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['name']?></td>
        <td align="center"><?=$row['lx']?></td>
         
        <td align="center"><?=$row['shun']?></td>
        <td align="center"><?php if ($row['isdisplay']==1){?>已发布<?php }else{?><font color="#FF0000">未发布</font><?php }?></td>
	       </tr>
      <?php
			}
		}
	  ?>
                        
                    	<tr>
                        	<th colspan="5">
                        	 <input type="submit" id="button" value="发布颜色" name="button" onClick="{if(confirm('您确定要发布颜色吗?')){this.document.selform.submit();return true;}return false;}"/>
                      
                                	 <input type="submit" id="button2" value="停止发布" name="button2" onClick="{if(confirm('您确定要停止发布吗?')){this.document.selform.submit();return true;}return false;}"/>
              
                              <input type="submit" id="button4" value="删除颜色" name="button4" onClick="{if(confirm('您确定要删除颜色吗?')){this.document.selform.submit();return true;}return false;}"/>
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