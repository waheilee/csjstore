<!DOCTYPE html>
<?php
include_once("../class/ulevel_class.php");
include_once("../class/system_class.php");
include_once("../class/bonus_class.php");
include_once("../function.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);
if($member==null){
     echo "<script language=javascript>alert('您尚未登陆,请登陆后查看!.');window.location.href='../copyindex.php'</script>";
 }
 $sys=getOne("select id,num,d2 from systemparameters where id=1 ");
 $oid=$_GET['oid'];
 $page=$_GET['page'];
 
 
 $o2= getOne("select * from orders2 where id=$oid");

 if ($o2['isqr']==0 && $o2['gs']==1) {//挂卖的订单
     
     $date=$o2['date'];
     $num=$sys['num'];
     $last = date('Y-m-d H:i:s',strtotime("$date +$num day"));
     $now=now();
     //echo $last;die();
     
     if ($now>=$last || $o2['lunci']==4){
         
         
     }else {
         echo "<script language=javascript>alert('订单不满".$num."天，不能挂售.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
     }
 }else {
     echo "<script language=javascript>alert('订单已挂售或者提货.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
 }
#搜索商品
if ($_POST['Search']){
    $SearchContent=$_POST['SearchContent'];
    
    if ($SearchContent!=NULL){
        $SearchType=$_POST['SearchType'];
     
        if ($SearchType==1){
            #搜索订单编号
            $_SESSION['Search']="and ordersnumber like '%".$SearchContent."%'";
        }else if($SearchType==2){
            $_SESSION['Search']="and userid like '%".$SearchContent."%'";
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

if ($_POST['button1']){
    if(tx(date("w"))<>1){
        echo "<script language=javascript>alert('今天不是工作日.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
        
    }
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    
    $id=$_GET['oid'];
    $bid=$_POST['id'];
    
    
    
        
        $o2= getOne("select * from orders2 where id=$id");
       
        if ($o2['isqr']==0 && $o2['gs']==1) {//会员提货
            
            $date=$o2['date'];
            $num=$sys['num'];
            $last = date('Y-m-d H:i:s',strtotime("$date +$num day"));
            $now=now();
            //echo $last;die();
            
            if ($now>=$last || $o2['lunci']==4){
                echo aaa;
               
                        $_bonus_cl = new bonus_class();
                
                        $buy= getOne("select * from buysell where id=$bid");
                        $nickname=$buy['buynickname'];
                       
                        
                        //买家今天成交的单数  买入的单数
                        $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buynicname='".$nickname."' and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
                        $con=count($arr);//单数
                        $sys=getOne("select id,num,d2 from systemparameters where id=1 ");
                        if ($con < $sys['d2']){//今天买家每天只能买一单
                            
                            
                            
                            $you= getOne("select * from buysell where id=$bid and isgrant=0 and lx=1 and buynickname='".$nickname."' order by id asc limit 0,1");
                           // echo "select * from buysell where id=$bid and isgrant=0 and lx=1 and buynickname='".$nickname."' order by id asc limit 0,1";die();
                            
                            // echo "select * from buysell where isgrant=0 and lx=1 and buynickname={$nickname} order by id asc limit 0,1";die();
                            if ($you['id']!=null){
                                
                                
                                $cc_xiugai['isqr']=2;
                                $cc_xiugai['gs']=0;
                                edit_update_cl('orders2',$cc_xiugai,$o2['id']);
                                
                                $_bonus_cl->ircout($member,$o2['ordersnumber'],$o2['goodid'],$o2['goodname'],$o2['jine']);
                                $_bonus_cl->ppweb($o2['ordersnumber'],$you['id']);
                                $_bonus_cl->b0bonus();
                                
                                echo "<script language=javascript>alert('定向挂卖成功.');window.location.href='order.php?oid=".$oid."&page=".$page."'</script>";
                            }else {
                                echo "<script language=javascript>alert('定向挂卖的订单已匹配，请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
                            }
                            
                            
                        }else {
                            echo "<script language=javascript>alert('买家今天已经购买".$con."，挂卖失败！请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
                        }
                    
               
            }else {
                
                echo "<script language=javascript>alert('订单".$sys['num']."天后才可以挂售，请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
            }
            
        }else {
            echo "<script language=javascript>alert('订单未匹配或已经挂售，请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
        }
    
    
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
                                	<td>
                                    	<select name="SearchType" id="SearchType">
                                        	<option value="1">订单编号</option>
                                        	<option value="2">会员编号</option>
                                        </select>
                                        <input type="text" name="SearchContent" placeholder="搜索相关数据..." id="SearchContent" class="first"/>
                                    
                                        <input type="submit"  name="Search" id="Search" class="btn1" value="搜索"/>
                                    </td>
                                    </tr>
                	<tr>
<!--      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" onclick="SelectAll() "></td>-->
          <td align="center">订单编号</td>

          <td align="center">会员编号</td>
      
<!--        <td align="center">商品名称</td>
    
        
        <td align="center">数量</td>-->
 
        <td align="center">时间</td>
          <td align="center">操作</td>
        </tr>
   <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `buysell` WHERE isgrant=0 and lx=1 and buyid!=".$_SESSION['ID']." ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
	  	
	  	
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
		
		
		
      	$sql = "SELECT * FROM `buysell` WHERE  isgrant=0 and lx=1 and buyid!=".$_SESSION['ID']." ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by cdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
//                    $member=getOne("SELECT useraddress FROM `member` WHERE id={$row['uid']}")
	  ?>
                    	<tr>
<!--      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>-->
         <td align="center"><?=$row['ordersnumber']?></td> 
        <td align="center"><?=$row['buynickname']?></td>
        
<!--        <td align="center"><?=$row['goodsname']?></td>

        <td align="center"><?=$row['num']?></td>-->

        <td align="center"><?=$row['cdate']?></td>
         <td align="center">
           <input type="text" value="<?=$row['id']?>" name="id" style="display:none"/>
         <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="submit" value="定售" name="button1" onClick="{if(confirm('您确定要定售吗?')){this.document.selform.submit();return true;}return false;}"/>
         </td>
             
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