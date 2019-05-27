<!DOCTYPE html>
<?php
include_once("../class/ulevel_class.php");
include_once("../class/system_class.php");
include_once("../function.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);
if($member==null){
     echo "<script language=javascript>alert('您尚未登陆,请登陆后查看!.');window.location.href='../copyindex.php'</script>";
 }
if($_GET['del']){
    $o= getOne("select * from orders2 where uid={$member['id']} and id={$_GET['del']}");
    if($o['issend']==-1){
        // dingdandel($o['ordersnumber']);
        edit_delete_cl('orders2',$_GET['del']);  
        echo "<script language=javascript>alert('订单删除成功！');window.location.href='?'</script>";
    }else{
        echo "<script language=javascript>alert('该订单不可删除！');window.location.href='?'</script>";
    } 
}
#搜索商品
if ($_POST['Search']){
    $SearchContent=$_POST['SearchContent'];
    $TimeStart=$_POST['TimeStart'];
    $TimeEnd=$_POST['TimeEnd'];
    if ($TimeStart!=NULL){
        if ($TimeEnd==NULL){
            $TimeEnd=now();
        }
        $_SESSION['SearchTime']="and date>='".$TimeStart."' and date<='".$TimeEnd."'";
    }else{
        $_SESSION['SearchTime']=NULL;
    }
    if ($SearchContent!=NULL){
        $SearchType=$_POST['SearchType'];
        $SearchType=1;
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

if ($_POST['button']){
$cheuid_arr = $_POST['UID'];
	
	foreach ((array)$cheuid_arr as $id)
	{
		$bonus_cl=new bonus_class();
		$orders2=que_select_cl("orders2",$id);
		// if($orders2['bid']==0){
			if ($orders2['gs']==1){
				$orders2['gs']=2;
				edit_update_cl('orders2',$orders2,$id);
			}
		// }else{
		// 		echo "<script language=javascript>alert('未付款订单不能发货.');window.location.href='?'</script>";

		// }
	}
	echo "<script language=javascript>alert('订单挂售完成.');window.location.href='?'</script>";
}

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>排单列表</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/tuijian.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	<?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
        <form name="form" method="post" action="?oid=<?=$oid?>&page=<?=$page?>">
   	  <div class="mainBox">
        	<div class="table">
            	<table>
                	<tr>
<!--      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" onclick="SelectAll() "></td>-->
          <td align="center">订单编号</td>

<!--        <td align="center">会员编号</td>-->
      
<!--        <td align="center">商品名称</td>
    
        
        <td align="center">数量</td>-->
 
        <td align="center">时间</td>
        <!--  <td align="center">操作</td>-->
        </tr>
   <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `buysell` WHERE isgrant=0 and lx=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
	  	
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
		
		
		
      	$sql = "SELECT * FROM `buysell` WHERE  isgrant=0 and lx=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by cdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
//                    $member=getOne("SELECT useraddress FROM `member` WHERE id={$row['uid']}")
	  ?>
                    	<tr>
<!--      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>-->
         <td align="center"><?=$row['ordersnumber']?></td> 
<!--        <td align="center"><?=$row['buynickname']?></td>-->
        
<!--        <td align="center"><?=$row['goodsname']?></td>

        <td align="center"><?=$row['num']?></td>-->

        <td align="center"><?=$row['cdate']?></td>
        <!-- <td align="center">
         <input type="button" class="button" id="button3" name="button" value="出售" onClick="window.location.href='order2.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" />
            </a></td>
             -->
      </tr>
      <?php
			}
		}
	
	  ?>
                            <tr>
                                <td align="center" colspan="10"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
                            </tr>
          
                </table>
            </div>
        </div></form>
        <br/><br/><br/>
        <br/><br/><br/>
    
    </section>
        <?php include 'footer.php';?>
    <script>
		$(function(){
    		$("#gFooter li:nth-child(2)").addClass("on")
			
		})
    </script>
    
</body>
</html>