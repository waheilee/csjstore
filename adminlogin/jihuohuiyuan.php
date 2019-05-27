<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/ulevel_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(1,1);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<?php
#搜索会员
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
    $Searchul=$_POST['Searchul'];
    $Searchname=$_POST['Searchname'];
    $Searchcard=$_POST['Searchcard'];
    $Searchtel=$_POST['Searchtel'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and rdt>='".$TimeStart."' and rdt<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname like '%$SearchContent%' ";
		}elseif($SearchType==2){
			#搜索推荐人
			$_SESSION['Search']="and rname='".$SearchContent."'";
		}
	}else{
		$_SESSION['Search']=NULL;	
	}
    
    if ($Searchname!=NULL){
		$_SESSION['Searchname']="and username='".$Searchname."'";
	}else{
		$_SESSION['Searchname']=NULL;	
	}
    if ($Searchul!=0){
		$_SESSION['Searchul']="and ulevel='".$Searchul."'";
	}else{
		$_SESSION['Searchul']=NULL;	
	}
    if ($Searchcard!=NULL){
		$_SESSION['Searchcard']="and usercard='".$Searchcard."'";
	}else{
		$_SESSION['Searchcard']=NULL;	
	}
    if ($Searchtel!=NULL){
		$_SESSION['Searchtel']="and usertel='".$Searchtel."'";
	}else{
		$_SESSION['Searchtel']=NULL;	
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
        $_SESSION['Searchname']=NULL;	
        $_SESSION['Searchcard']=NULL;	
        $_SESSION['Searchtel']=NULL;
        $_SESSION['Searchul']=NULL;	
	}
}

//if($_POST['del']){
//    echo "<script language=javascript>window.location.href='?'</script>";
//}
#激活会员
if ($_POST['button']){
	$id = $_GET['id'];
	$_member=new member_class();
    $u= getMemberbyID($id);
    $uss= getMemberbyID($u['reid']);
	// $chenggong=0;
	// $shibai=0;
    $_member->jihuomember($id);
    $_member->addbdrecord($u,$uss,$u['lsk']);//激活记录
	echo "<script language=javascript>alert('会员激活完成');window.location.href='?'</script>";
}

#顶层会员
if ($_POST['button2']){
	$cheuid_arr = $_GET['id'];
	$_member=new member_class();
	foreach ((array)$cheuid_arr as $id)
	{
    	$_member->dingcengmember($id);
	}
	echo "<script language=javascript>alert('会员已设置为团队领导.');window.location.href='?'</script>";
}

#空单会员
if ($_POST['button3']){
	$id = $_GET['id'];
	$_member=new member_class();
   $_member->kongdanmember($id);
	echo "<script language=javascript>alert('空单会员设置完成.');window.location.href='?'</script>";
}

#删除会员
if ($_POST['button4'] ){
	$id = $_GET['id'];
	$_member=new member_class();
	$us=$_member->getMemberbyID($id);
	
	if($us['ispay']==1){
	    echo "<script language=javascript>alert('会员".$us['nickname'].",已经激活不能删除,删除失败.');window.location.href='zhengshihuiyuan.php'</script>";
	    return;
	}
		if ($_member->checkfman($id)){
    		edit_delete_cl('member',$id);
		}
		else{
			$us=$_member->getMemberbyID($id);
			echo "<script language=javascript>alert('会员".$us['nickname']."下方已经安置了会员,删除失败.');window.location.href='?'</script>";	
		}
	echo "<script language=javascript>alert('删除会员完成.');window.location.href='?'</script>";
}


?>
<title>激活会员</title>
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
<SCRIPT type="text/javascript">
	function manage(id){
		window.open("../web2/index.php?Manager_ID="+id);
	}

</SCRIPT>
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
<body style="margin-top:-19px">
<div id="container">
	<?php include 'header.php';?>
<section id="main" class="clearfix">
		<!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
		<?php include 'left.php';?>
		<!-- #EndLibraryItem -->
<div id="conts" cl ass="heightLine-1">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	<?php include 'title.php';?>
        	<!-- #EndLibraryItem -->
<div class="mainBox">
            	<form name="form1" method="post" action="?">
            	
    <div class="title clearfix">
                	
    <div class="left">
        <select name="SearchType" id="SearchType">
            <option <?php if($SearchType==1){?> selected <?php } ?>  value="1">会员编号</option>
            <option <?php if($SearchType==2){?> selected <?php } ?> value="2">推荐人编号</option>
            <!-- <option value="3">服务中心</option> -->
        </select>

        <input type="text" value="<?=$SearchContent?>" name="SearchContent" id="SearchContent" placeholder="请输入编号">
        
        姓名：<input type="text" value="<?=$Searchname?>" name="Searchname" id="Searchname" placeholder="请输入姓名">
        等级：<select name="Searchul" id="Searchul">
            <option  value="0">全部</option>
            <?php $arr= getAll("select id,ulevel,lvname from ulevel where ulevel<>2 and ulevel<>0 order by ulevel");       
            foreach ($arr as $k=>$r){?>
            <option <?php if($r['ulevel']==$Searchul){?> selected <?php } ?>  value="<?=$r['ulevel']?>"><?=$r['lvname']?></option>
                <?php }?> 
            
        </select>
        身份证号：<input type="text" value="<?=$Searchcard?>" name="Searchcard" id="Searchcard" placeholder="请输入身份证号">
        电话：<input type="text" value="<?=$Searchtel?>" name="Searchtel" id="Searchtel" placeholder="请输入电话">
<!--<input type="button" value="搜索" name="name"/>-->

    </div>

                        
            		
    </div>
        <div class="title clearfix">
        <div class="left">
                <span>时间：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" />至
                <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" />

                <input type="submit" name="Search" id="Search" class="btn1" value="搜索">
                  <input type="submit" name="del" id="del" class="btn1" value="清空">
               
            </div>
            <div class="right">
            </div>


    </div>
    </form>
                
                <div class="table">
                	<h3>未激活会员</h3>
                    <div class="table1">
                	<table>
                    	<tr>
                            	<td>会员编号</td>
                            	<td>会员姓名</td>
                                <td>会员级别</td>
                                <td>投资金额</td>
                            	<!-- <
                               	<td>推广申请</td> -->
                            	<!-- <td>会员资格</td> -->
                            	<td>推荐人</td>
                                <td>身份证号</td>
                                <td>电话</td>
                            	<!-- <td>接点人</td>
                                <td>服务中心</td> -->
                            	<td>注册时间</td>
                            	<td>详细信息</td>
                        </tr>
<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT id FROM `member` WHERE ispay=0 ".$_SESSION['Search']." ".$_SESSION['Searchname']." ".$_SESSION['Searchul']." ".$_SESSION['Searchcard']." ".$_SESSION['Searchtel']." ".$_SESSION['SearchTime']." ";
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
      	$sql = "SELECT * FROM `member` WHERE ispay=0 ".$_SESSION['Search']." ".$_SESSION['Searchname']." ".$_SESSION['Searchul']." ".$_SESSION['Searchcard']." ".$_SESSION['Searchtel']." ".$_SESSION['SearchTime']." order by rdt desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$ul=ulevel($row['ulevel']);
			if($row['ulevel']>0){
			    $lv=$ul['lvname'];
			}
	  ?>
				
					<tr>
     
     	 <form name="form1" method="post" action="?id=<?=$row['id']?>">
        <td align="center"><?=$row['userid']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$lv?></td>
        <td align="center"><?=$row['lsk']?></td>
        <!-- 
          <td align="center"><?=$tg?></td>
        
         -->
        <td align="center"><?=$row['rname']?></td>
        <td align="center"><?=$row['usercard']?></td>
        <td align="center"><?=$row['usertel']?></td>
        
        <!-- <td align="center"><?=$row['fathername']?></td>
        <td  align="center"><?=$row['bdname']?></td>  -->
        <td align="center"><?=$row['rdt']?></td>
        
        <td align="center">
            <input name="button" type="submit" class="button" id="button" value="激活" onClick="{if(confirm('您确定要激活该会员吗?')){this.document.selform.submit();return true;}return false;}">
            <input name="button4" type="submit" class="button" id="button4" value="删除" onClick="{if(confirm('您确定要删除该会员吗?')){this.document.selform.submit();return true;}return false;}">
        	<input type="button" class="button" id="button" name="button1" value="查看" onClick="window.location.href='zshy_chakan.php?ID=<?=$row['id']?>'" />
        	<input type="button" class="button" id="button" name="button1" value="管理" onClick="manage(<?=$row['id']?>)" />
        	
        	
        <!--  	<input  name="button3" type="submit" class="button" id="button3" value="空单会员" onClick="{if(confirm('您确定要将该会员设置为空单会员吗?')){this.document.selform.submit();return true;}return false;}">
             
             <input  name="button5" type="submit" class="button" id="button5" value="空单回填" onClick="{if(confirm('您确定要将该会员设置为空单回填会员吗?')){this.document.selform.submit();return true;}return false;}">
         -->
        </td>
         </form>
       </tr>	
 <?php
			}
		}
	  ?>
                    	<tr>
                        	<th colspan="9"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>