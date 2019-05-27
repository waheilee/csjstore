<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
include_once("../class/member_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
#搜索会员
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索会员编号
			$uu=getMemberbyNickName($SearchContent);
			$_SESSION['Search']="and uid='".$uu['id']."'";
		}elseif($SearchType==2){
			#搜索推荐人
			$_SESSION['Search']="and rname='".$SearchContent."'";
		}elseif($SearchType==3){
			#搜索报单中心
			$_SESSION['Search']="and bdname='".$SearchContent."'";
		}elseif($SearchType==4){
			#搜索顶层会员
			$_SESSION['Search']="and fathername='顶层会员' and nickname='".$SearchContent."'";
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
//$us=GetMemberbyID($_SESSION['ID']);
if ($_POST['submit']){
	$level=(int)$_POST['level'];
	if(is_numeric($_POST['jine'])){
	    $b=new bonus_class();
	    $sql="select id,nickname,shourulevel from member where shourulevel={$_POST['level']}";
	    $rs=getAll($sql);
	    if(!empty($rs)){
	    	foreach($rs as $v){
	    	    $sql="update member set b5=b5+{$_POST['jine']} where id={$v['id']}";
	    	    mysql_query($sql);
	    	    $b->bonus_laiyuan($v['id'], $v['nickname'], $v['shourulevel'], "-",5, $_POST['jine'], "员工工资");
	    	    
	    	}
	    }
		//$b->b0bonus();
		alert("分红成功","?");
	}else{
		alert("请输入正确的数值","?");
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
<title>操作记录</title>
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/jihuohuiyuan.css">
<script src="js/jquery.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
<script language="javascript">
<!--
function checknickname(lx)
{
	var iframe = document.getElementById("iframe");
	var user =  document.getElementById("nickname");
	iframe.src= "../member/checknickname.php?lx="+lx+"&nickname="+user.value;
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
<body style="margin-top:-19px">
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
                        	<th colspan="7">操作记录</th>
                        </tr>
                        <tr>
                        	<td>序号</td>
                        	<td>时间</td>
                        	<td>类型</td>
                        	<td>会员编号</td>
                        	<td>会员姓名</td>
                        	<td>操作</td>
                        	<td>操作人</td>
                        </tr>
						 <?php
	  	$pagesize = 10; //设置每页记录数 
	  	$sql = "SELECT * FROM `action` a left join member m on m.id=a.uid   left join to_admin t on t.id=a.operationid where 1=1  ".$_SESSION['Search']." ";
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
      	$sql = "SELECT * FROM `action` a left join member m on m.id=a.uid left join to_admin t on t.id=a.operationid  where 1=1 ".$_SESSION['Search']." order by time desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
		
	  ?>
                        <tr>
        
        <td align="center"><?=$row['id']?></td>
        <td align="center"><?=$row['time']?></td>
        <td align="center"><?=$row['lxx'];   ?></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$row['jine']?></td>
        <td align="center"><?=$row['loginname']?></td>
        
        
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