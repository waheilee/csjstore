<!DOCTYPE html>
<?php 
include("check.php");
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
// 			$_bonus->addArea($us['id'], $us['treeplace'], $ulevelup['cha']);
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
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>升级记录</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/register.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	<?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
    	<ul class="list2 list1 clearfix">
            	<li><a href="hylc.php">会员升级</a></li>
            	<li class="on"><a href="lcjl.php">升级记录</a></li>
            </ul>
            
            <div class="table4">
            	<table>
                	<tr>
                	
                    	<td>会员编号</td>
                    	<td>会员姓名</td>
                    	<td>补差金额</td>
                    	<td>操作日期</td>
                    	<td>升级方式</td>
                    </tr>
                    <?php
                    $id=$_SESSION['ID'];
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `ulevelup` WHERE uid=$id ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
		$sql = "SELECT * FROM `ulevelup` WHERE uid=$id ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by udate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$yul=ulevel($row['ylevel']);
			//var_dump($yul);exit;
			$uul=ulevel($row['uplevel']);
			$sid=getOne("select * from to_admin where id=".$row['sid']."");
			
	  ?>
                    <tr>
                    	<td><?=$row['nickname']?></td>
                    	<td><?=$row['username']?></td>
                    	<td><?=$row['cha']?></td>
                    	<td><?=$row['udate']?></td>
                    	<td>自主升级</td>
                    </tr>
                    <?php }}?>
                </table>
            </div>
            
        </div>
        
    
    </section><?php include 'footer.php';?>
</body>
</html>