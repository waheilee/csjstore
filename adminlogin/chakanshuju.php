<?php
include("action.php");
include("admin_check.php");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");
header("Content-Type: text/html;charset=utf-8");
$_member_cl=new member_class();
$bonus_cl=new bonus_class();
$_systemyeji=new system_class();
$date= now();
session_start();
//checkqx(4,14);
#搜索商品
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and (cdate>='".$TimeStart."' and cdate<='".$TimeEnd."')";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索订单编号
			$_SESSION['Search']="and ordersnumber like '%".$SearchContent."%'";
		}else if($SearchType==2){
			$_SESSION['Search']="and userid like '%".$SearchContent."%'";	
		}else if($SearchType==2){
			$_SESSION['Search']="and username like '%".$SearchContent."%'";
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

//仅导入
if ($_POST['button1']){
	$cheuid_arr = $_POST['UID'];
    if($cheuid_arr){
        foreach ((array)$cheuid_arr as $id)
        {
            $ino= getOne("select ordersnumber,logistics,logisticsno from inorders where id={$id}");
            if ($ino){
                $o= getOne("select id from orders where ordersnumber='{$ino['ordersnumber']}'");
                if($o){
                    $orders_up['logistics']=$ino['logistics'];
                    $orders_up['logisticsno']=$ino['logisticsno'];
                    edit_update_cl('orders',$orders_up,$o['id']);
                }
            }
            edit_delete_cl('inorders',$id);
        }
        echo "<script language=javascript>alert('导入完成');window.location.href='?'</script>";
    }else{
        echo "<script language=javascript>alert('请选择要导入的数据');window.location.href='?'</script>";
    }
	
	
}

//导入并发货
if ($_POST['button2']){
	$cheuid_arr = $_POST['UID'];
    if($cheuid_arr){
        foreach ((array)$cheuid_arr as $id)
        {
            $ino= getOne("select id,ordersnumber,logistics,logisticsno from inorders where id={$id}");

            if ($ino){
                $o= getOne("select id,uid,issend,sgb,ordersnumber,goods from orders where ordersnumber='{$ino['ordersnumber']}'");
                if($o){
                    $or['logistics']=$ino['logistics'];
                    $or['logisticsno']=$ino['logisticsno'];
                    edit_update_cl('orders',$or,$o['id']);//导入
                    if ($o['issend']==0){
                        $bonus_cl->fahuo($o['id']);//发货
                    }
                }
            }
            edit_delete_cl('inorders',$id);
        }
        echo "<script language=javascript>alert('导入并发货完成');window.location.href='?'</script>";
    }else{
        echo "<script language=javascript>alert('请选择要导入并发货的数据');window.location.href='?'</script>";
    }
}

//删除
if ($_POST['button3']){
    $cheuid_arr = $_POST['UID'];
    if($cheuid_arr){
        foreach ((array)$cheuid_arr as $id)
        {
            edit_delete_cl('inorders',$id);
        }
        echo "<script language=javascript>alert('删除完成');window.location.href='?'</script>";
    }else{
        echo "<script language=javascript>alert('请选择要删除的数据');window.location.href='?'</script>";
    }
}

//全部导入
if ($_POST['button4']){
        $cheuid_arr=getAll("select id from inorders");
        foreach ($cheuid_arr as $k =>$id)
        {
            $ino= getOne("select ordersnumber,logistics,logisticsno from inorders where id={$id['id']}");
            if ($ino){
                $o= getOne("select id from orders where ordersnumber='{$ino['ordersnumber']}'");
                if($o){
                    $orders_up['logistics']=$ino['logistics'];
                    $orders_up['logisticsno']=$ino['logisticsno'];
                    edit_update_cl('orders',$orders_up,$o['id']);
                }
            }
            edit_delete_cl('inorders',$id['id']);
        }
        echo "<script language=javascript>alert('全部导入完成');window.location.href='?'</script>";
}
//全部导入并发货
if ($_POST['button5']){
        $cheuid_arr=getAll("select id from inorders");
        foreach ($cheuid_arr as $k =>$id)
        {
            $ino= getOne("select id,ordersnumber,logistics,logisticsno from inorders where id={$id['id']}");

            if ($ino){
                $o= getOne("select id,uid,issend,ordersnumber,goods from orders where ordersnumber='{$ino['ordersnumber']}'");
                if($o){
                    $or['logistics']=$ino['logistics'];
                    $or['logisticsno']=$ino['logisticsno'];
                    edit_update_cl('orders',$or,$o['id']);//导入
                    if ($o['issend']==0){
                        $bonus_cl->fahuo($o['id']);//发货
                    }
                }
            }
            edit_delete_cl('inorders',$id['id']);
        }
        echo "<script language=javascript>alert('全部导入并发货完成');window.location.href='?'</script>";
}
//全部删除
if ($_POST['button6']){
    edit_delete_all('inorders');
    echo "<script language=javascript>alert('全部删除完成');window.location.href='?'</script>";
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>查看数据</title>

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
			<form id="form1" name="form1" method="post" action="?">
<div class="mainBox">
            	<div class="title clearfix">
                	
                    	<div class="left1">
                 <select name="SearchType" id="SearchType">
                    <option value="1">订单编号</option>
<!--                    <option value="2">会员编号</option>
                    <option value="3">会员姓名</option>-->
                  </select>
                  <input type="text" name="SearchContent" id="SearchContent">
                            
                            
                    	</div>
                        <div class="right1">
<!--                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>-->
                            <input type="submit" name="Search" id="Search" value="搜索" />
                            导出表格：
                            <input type="button" value="重新编辑" name="dayin" id="dayin" onClick="window.location.href='excel.php?table=daoru'"/>
                            
                		</div>
                      
            		
             	</div>
                
                <div class="table">
<!--                	<ul class="clearfix">
                    	<li>
                        	未发货
                        </li>
                    	<li>
                        	已发货
                        </li>
                    	<li>
                        	已退款
                        </li>
                    
                    </ul>-->
                    <div class="table1">
                        
                	<table>
                    	<tr>
      	<td height="21" align="center">全选
            <input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll();">
      	</td>
        <td align="center">订单编号</td>
        <td align="center">订单类型</td>
        <td align="center">物流公司</td>
        <td align="center">物流编号</td>
     <!--   <td align="center">订单时间</td>
        <td align="center">订单总计</td>

        <td align="center">会员编号</td>
        <td align="center">会员姓名</td>
       
       
        <td align="center">联系电话</td>
        <td align="center">联系地址</td>
        <td align="center">订单时间</td>
        <td align="center">发货时间</td>
        <td align="center">状态</td>-->
        <td align="center">操作</td>
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT id FROM `inorders` WHERE ordersnumber is not null ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
	  	
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
		
      	$sql = "SELECT * FROM `inorders` WHERE ordersnumber is not null ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
        <tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['ordersnumber']?></td>
       <td align="center"><?=$row['lx']?></td>
        <td align="center"><?=$row['logistics']?></td>
        <td align="center"><?=$row['logisticsno']?></td>
       <!-- <td align="center"  ><?=$row['cdate']?></td>
    
        
        <td align="center"><?=$row['userid']?></td>
        <td align="center"><?=$row['username']?></td>
       
        
        <td align="center"><?=$row['usertel']?></td>
        <td align="center"><?=$row['useraddress']?></td>
        <td align="center"><?=$row['cdate']?></td>
        <td align="center"><?=$row['sdate']?></td>
        <td align="center"><?php if($row['issend']==0){?>未发货<?php }else if($row['issend']==1){ ?>已发货<?php }else if($row['issend']==2){?>已退款<?php }?></td>
        -->
        <td align="center">
          <input type="button" class="button" id="button3" name="button3" value="查看" onClick="window.location.href='spxq1.php?o=<?=$row['ordersnumber']?>&page=<?=$p?>'" />
        </a></td>
      </tr>
      <?php
			}
		}
	
	  ?>
                        
                    	<tr>
                        	<th colspan="14">
                                 <input type="submit" id="button1" value="仅导入数据" name="button1" style="background:#e74f5b" onClick="{if(confirm('您确定要仅导入数据吗?')){this.document.selform.submit();return true;}return false;}"/>
                            <input type="submit" id="button2" value="导入并发货" name="button2" onClick="{if(confirm('您确定要导入并发货吗?')){this.document.selform.submit();return true;}return false;}"/>
                            <input type="submit" id="button3" value="删除数据" name="button3" onClick="{if(confirm('您确定要删除数据吗?')){this.document.selform.submit();return true;}return false;}"/>
                            <input type="submit" id="button4" value="全部导入" name="button4" onClick="{if(confirm('您确定要全部导入吗?')){this.document.selform.submit();return true;}return false;}"/>
                            <input type="submit" id="button5" value="全部导入并发货" name="button5" onClick="{if(confirm('您确定要全部导入并发货吗?')){this.document.selform.submit();return true;}return false;}"/>
                            <input type="submit" id="button6" value="全部删除" name="button6" onClick="{if(confirm('您确定要全部删除吗?')){this.document.selform.submit();return true;}return false;}"/>
                            <a href="daorushuju.php">继续导入数据</a>
                            <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                   
                    
                    </div>
                    
                    
                
                </div>
                
                
            </div>   
                </form>
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
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