<?php
session_start();
include("admin_check.php");
include_once("../function.php");
include_once("../class/member_class.php");

header("Content-Type: text/html;charset=utf-8");
//checkqx(1,2);
#搜索会员
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
    $Searchul=$_POST['Searchul'];
    $Searchull=$_POST['Searchull'];
    $Searchname=$_POST['Searchname'];
    $Searchcard=$_POST['Searchcard'];
    $Searchtel=$_POST['Searchtel'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and pdt>='".$TimeStart."' and pdt<='".$TimeEnd."'";	
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
			$_SESSION['Search']="and rname like '%$SearchContent%' ";
		}elseif($SearchType==3){
			#搜索报单中心
			$_SESSION['Search']="and bdname like '%$SearchContent%'";
		}elseif($SearchType==4){
			#搜索顶层会员
			$_SESSION['Search']="and fathername='顶层会员' and nickname like '%$SearchContent%'";
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
    if ($Searchull!=-1){
            $_SESSION['Searchull']="and zjulevel='".$Searchull."'";
    }else{
            $_SESSION['Searchull']=NULL;	
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
        $_SESSION['Searchull']=NULL;
	}
}

if($_POST['qingkong']){
    $_SESSION['Search']=NULL;	
    $_SESSION['SearchTime']=NULL;
    $_SESSION['Searchname']=NULL;	
    $_SESSION['Searchcard']=NULL;	
    $_SESSION['Searchtel']=NULL;
    $_SESSION['Searchul']=NULL;
    $_SESSION['Searchull']=NULL;
    $Searchull=-1;
}
//if($_POST['del']){
//    echo "<script language=javascript>window.location.href='?'</script>";
//}
//冻结会员
if($_POST['button']){
$cheuid_arr = $_POST['UID'];
if($cheuid_arr==null){
	echo "<script language=javascript>alert('请选择您要解除锁定的会员.');window.location.href='?'</script>";
}else{
$_member=new member_class();
foreach ((array)$cheuid_arr as $id)
	{
    	$_member->jiedong($id);
	}
	echo "<script language=javascript>alert('解除对该会员的锁定设置完成.');window.location.href='?'</script>";
}
}
//解冻会员
if($_POST['button1']){
$cheuid_arr = $_POST['UID'];
if($cheuid_arr==null){
	echo "<script language=javascript>alert('请选择您要锁定的会员.');window.location.href='?'</script>";
}else{
$_member=new member_class();
	foreach ((array)$cheuid_arr as $id)
		{
	    	$_member->dongjie($id);
		}
		echo "<script language=javascript>alert('锁定会员设置完成.');window.location.href='?'</script>";
	}
}
#删除会员
if($_POST['button4']){
	$cheuid_arr = $_POST['UID'];
	if($cheuid_arr==null){
		echo "<script language=javascript>alert('请选择您要删除的会员.');window.location.href='?'</script>";
	}else{
		$_member=new member_class();
		foreach ((array)$cheuid_arr as $id)
		{
			$us=$_member->getMemberbyID($id);
			if ($_member->checkfman($id)){
				$_member->shanchu($us['id'], $us['treeplace'], $us['lsk'], $us['ulevel']);
				edit_delete_cl('member',$id);
			}else{
				echo "<script language=javascript>alert('会员".$us['nickname']."下方已经安置了会员,删除失败.');window.location.href='?'</script>";
			}
		}
			echo "<script language=javascript>alert('删除会员完成.');window.location.href='?'</script>";
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
<title>正式会员</title>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/jihuohuiyuan.css">
<script src="js/jquery.js"></script>
<script src="js/lanrenzhijia.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>

<SCRIPT type="text/javascript">
	function manage(id){
		window.open("../web2/index.php?Manager_ID="+id);
	}

</SCRIPT>
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}       

function SelectAll() {
	
	for (var i=0;i<document.form1.UID.length;i++) {
        
		var e=document.form1.UID[i];
        
		e.checked=!e.checked;
	}
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
<div id="conts" cl ass="heightLine-1">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	<?php include 'title.php';?>
        	<!-- #EndLibraryItem --><form action="" method="post" name="form1">
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
            <?php $arr= getAll("select ulevel,lvname from ulevel where ulevel<>0 order by ulevel");       
            foreach ($arr as $k=>$r){?>
            <option <?php if($r['ulevel']==$Searchul){?> selected <?php } ?>  value="<?=$r['ulevel']?>"><?=$r['lvname']?></option>
                <?php }?> 
            
        </select>
        职称：<select name="Searchull" id="Searchull">
            <option  value="-1">全部</option>
            <?php $arrl= getAll("select ulevel,zjname from zjulevel order by ulevel");       
            foreach ($arrl as $k=>$r){?>
            <option <?php if($r['ulevel']==$Searchull){?> selected <?php } ?>  value="<?=$r['ulevel']?>"><?=$r['zjname']?></option>
                <?php }?> 
            
        </select>
        身份证号：<input type="text" value="<?=$Searchcard?>" name="Searchcard" id="Searchcard" placeholder="请输入身份证号">
        
        
<!--<input type="button" value="搜索" name="name"/>-->

    </div>   		
    </div>
            <div class="title clearfix">    	
            <div class="left">
                电话：<input type="text" value="<?=$Searchtel?>" name="Searchtel" id="Searchtel" placeholder="请输入电话">
            </div>   		
            </div>
        
        <div class="title clearfix">
        <div class="left">
                <span>时间：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" />至
                <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" />

                <input type="submit" name="Search" id="Search" class="btn1" value="搜索">
                  <input type="submit" name="qingkong" id="del" class="btn1" value="清空">
                <input type="button" value="导出表格" name="dayin" id="dayin" onClick="window.location.href='excel.php?table=member'"/>

            </div>
            <div class="right">
            </div>


    </div>
    </form>
                <div class="table">
                	<h3>正式会员</h3>
                    <div class="table1" style="overflow: scroll;">
                	<table>
                    	<tr>
	  <td height="21" align="center"><input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">会员编号</td>
        <td align="center">会员姓名</td>
        <td align="center">会员级别</td>
        <td align="center">职称级别</td>
        <td align="center">报单中心</td>
        <td align="center">合格经销商</td>
        <td align="center">注册金额</td>
        <td align="center">推荐人</td>
        <td align="center">身份证号</td>
        <td align="center">电话</td>
        <td align="center">累计业绩</td>
        <td align="center">经销商考核业绩</td>
<!--        <td align="center">职称考核业绩</td>-->
        <td align="center">累计C积分</td>
        <td align="center">剩余A积分</td>
        <td align="center">剩余B积分</td>
        <td align="center">剩余C积分</td>
        <td align="center">激活时间</td>
        <td align="center">是否锁定</td>
        <td  colspan="4"  align="center">详细信息</td>
    </tr>

			<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT id FROM `member` WHERE ispay>=1 ".$_SESSION['Search']." ".$_SESSION['Searchname']." ".$_SESSION['Searchul']." ".$_SESSION['Searchull']." ".$_SESSION['Searchcard']." ".$_SESSION['Searchtel']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `member` WHERE ispay>=1 ".$_SESSION['Search']." ".$_SESSION['Searchname']." ".$_SESSION['Searchul']." ".$_SESSION['Searchull']." ".$_SESSION['Searchcard']." ".$_SESSION['Searchtel']." ".$_SESSION['SearchTime']." order by pdt desc,id desc limit ".$start.",".$pagesize;
             
      	if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$ul=ulevel($row['ulevel']);
                        $zjul=zjulevel($row['zjulevel']);
                        if($row['isbd']==0){
                            $isbd=否;
                        }elseif($row['isbd']==2){
                            $isbd=是;
                        }
			
                        if($row['zjulevel1']==0){
                            $jxs=否;
                        }elseif($row['zjulevel1']==2){
                            $jxs=是;
                        }
			?>
                        <tr>
	  <td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['userid']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?=$ul['lvname']?></td>
        <td align="center"><?=$zjul['zjname']?></td>
        <td align="center"><?=$isbd?></td>
        <td align="center"><?=$jxs?></td>
        <td align="center"><?=$row['lsk']?></td>
        <td align="center"><?=$row['rname']?></td>
        <td align="center"><?=$row['usercard']?></td>
        <td align="center"><?=$row['usertel']?></td>
        <td align="center"><?=$row['area1']?></td>
        <td align="center"><?=$row['yarea1']?></td>
<!--        <td align="center"><?=$row['yarea2']?></td>-->
        <td align="center"><?=$row['maxmey']?></td>
        <td align="center"><?=$row['zsq']?></td>
        <td align="center"><?=$row['cfxf']?></td>
        <td align="center"><?=$row['mey']?></td>
        <td align="center"><?=$row['pdt']?></td>
        <td align="center"><?php if($row['islock']==0){echo "未锁定";}else{ echo "已锁定";}?></td>
        <td align="center" colspan="4" >      	
        	<input type="button" class="button" id="button" name="button" value="查看" onClick="window.location.href='zshy_chakan.php?ID=<?=$row['id']?>'" />  
        	<input type="button" class="button" id="button" name="button" value="管理" onClick="manage(<?=$row['id']?>)" />
        	
        </td>      
        </tr>
		 <?php
			}
		}
	  ?>
                    	<tr>
                        	<th colspan="25">
                            <input name="button1" type="submit" class="btn1" id="button1" value="锁定会员" onClick="{if(confirm('您确定要锁定该会员吗?')){this.document.selform.submit();return true;}return false;}">
		   		<input name="button" type="submit" class="btn3" id="button" value="解除锁定" onClick="{if(confirm('您确定要解除对该会员的锁定吗?')){this.document.selform.submit();return true;}return false;}">
                            <a href="#"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div> </form>           
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>