<?php
include("admin_check.php");
include_once("../function.php");
include_once("action.php");
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
			$_SESSION['Search']="and issh=0";
		}elseif($SearchType==3){
			#搜索已发放
			$_SESSION['Search']="and issh=1";
		}
	}
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

#确认
if ($_POST['button']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
		$up=que_select_cl('ulevelup',$id);
		if ($up['issh']==0){
			$us=que_select_cl('member',$up['uid']);
			$us_update['ulevel']=$up['uplevel'];
            $us_update['zju']=0;
			action::record("升级确认", $chongzhi['uid'], $_SESSION['adminid'],$up['uplevel']);
			edit_update_cl('member',$us_update,$us['id']);
			$cc_xiugai['issh']=1;
            $cc_xiugai['sdate']= now();

    		edit_update_cl('ulevelup',$cc_xiugai,$id);
		}
	}
	echo "<script language=javascript>alert('升级确认完成.');window.location.href='?'</script>";
}

#删除记录
if ($_POST['button4']){
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{	$chongzhi=que_select_cl('chongzhi',$id);
		if($chongzhi['isgrant']==0){
			action::record("删除充值记录", $chongzhi['uid'], $_SESSION['adminid'],"删除记录");
			edit_delete_cl('chongzhi',$id);
			echo "<script language=javascript>alert('删除完成.');window.location.href='?'</script>";
		}else{
			echo "<script>alert('已充值记录不能删除');</script>";
			break;
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
<title>升级申请</title>
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
<script>


function SelectAll() {
	
	for (var i=0;i<document.form1.UID.length;i++) {
        
		var e=document.form1.UID[i];
        
		e.checked=!e.checked;
	}
}
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
<div id="conts" class="heightLine-1">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	 <?php include 'title.php';?>
        	<!-- #EndLibraryItem --><form name="form1" method="post" action="?">
<div class="mainBox">
            	<div class="title clearfix">
                	
                    	<div class="left">
                    		<select name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
<!--            <option value="2">未发放</option>
            <option value="3">已发放</option>-->
          </select>
            <input type="text" name="SearchContent" id="SearchContent">
                <input type="submit" name="Search" id="Search" class="btn1" value="搜索">
                      <!--       导出表格：
           <input type="button" name="dayin" id="dayin" class="btn1" value="未确认" onClick="window.location.href='excel.php?table=chongzhi'">
              <input type="button" name="dayin" id="dayin" class="btn1" value="已确认" onClick="window.location.href='excel.php?table=chongzhi2'">-->
                    	</div>
                        <div class="right">
                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                		</div>
            		
             	</div>
                
                <div class="table">
                	<h3>升级申请</h3>
                    <div class="table1">
                	<table>
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center" class="td1">会员编号</td>
        <td align="center" class="td1">会员姓名</td>
        <td align="center" class="td1">原级别</td>
        <td align="center" class="td1">申请级别</td>
        <td align="center">申请时间</td>
        <td align="center">操作</td>
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT id FROM `ulevelup` WHERE issh=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `ulevelup` WHERE issh=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by udate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			
	  ?>
                    	 <tr>
        <td height="21" align="center"><?php if($row['isgrant']==0){?><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"><?php }?></td>
        <td align="center"><?=$row['nickname']?></td>
        <td align="center"><?=$row['username']?></td>
        <td align="center"><?php $ul=ulevel($row['ylevel']); echo $ul['lvname'];?></td>
        <td align="center"><?php $ul2=ulevel($row['uplevel']); echo $ul2['lvname'];?></td>
        <td align="center"><?=$row['udate']?></td>
        <td align="center"><?php if ($row['isgrant']==1){?>已确认<?php }else{?> <font color="#FF0000">未确认</font><?php }?></td>
      </tr>
      <?php
			}
		}
	  ?>
                        	<th colspan="9">
                            <input type="submit"  name="button" id="button" value="升级确认" onClick="{if(confirm('您确定要进行升级确认吗?')){this.document.selform.submit();return true;}return false;}"/>
<!--                            	<input type="submit" id="button4" value="删除" name="button4" onClick="{if(confirm('您确定要删除该记录吗?')){this.document.selform.submit();return true;}return false;}"/>-->
                           <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div>  </form>          
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>