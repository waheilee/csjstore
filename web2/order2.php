<!DOCTYPE html>
<?php
include_once("../class/ulevel_class.php");
include_once("../class/system_class.php");
include_once("../class/bonus_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
$member=getMemberbyID($_SESSION['ID']);
$oid=$_GET['oid'];
$page=$_GET['page'];
$orders=que_select_cl('orders2',$oid);

$o2= getAll("select * from orders2 where ordersnumber={$orders['ordersnumber']}");



// if ($_POST['button1']){
//     if(tx(date("w"))<>1){
//         echo "<script language=javascript>alert('今天不是工作日.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
        
//     }
//     $y=date("Y");
//     $m=date("m");
//     $d=date("d");
    
//     $id=$_GET['oid'];
//     $nickname=$_POST['nickname'];
    
//     $mc=getMemberbyNickName($nickname);
//     if ($mc['id']!=null){
    
//         $o2= getOne("select * from orders2 where id=$id");
//         if ($o2['isqr']==0 && $o2['gs']==1) {//会员提货
            
//             $date=$o2['date'];
//             $num=$sys['num'];
//             $last = date('Y-m-d H:i:s',strtotime("$date +$num day"));
//             $now=now();
//             //echo $last;die();
            
//             if ($now>=$last || $o2['lunci']==4){
//                 $_bonus_cl = new bonus_class();
                
//                 if ($nickname!=$member['nickname']){
//                 if ($nickname!=null){
                    
//                     //买家今天成交的单数  买入的单数
//                     $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buynicname='".$nickname."' and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
//                     $con=count($arr);//单数
//                     $sys=getOne("select id,num,d2 from systemparameters where id=1 ");
//                     if ($con < $sys['d2']){//今天买家每天只能买一单
                    
//                         $you= getOne("select * from buysell where isgrant=0 and lx=1 and buynickname='".$nickname."' order by id asc limit 0,1");
                        
//                        // echo "select * from buysell where isgrant=0 and lx=1 and buynickname={$nickname} order by id asc limit 0,1";die();
//                         if ($you['id']!=null){
                            
                            
//                             $cc_xiugai['isqr']=2;
//                             $cc_xiugai['gs']=0;
//                             edit_update_cl('orders2',$cc_xiugai,$o2['id']);
                            
//                             $_bonus_cl->ircout($member,$o2['ordersnumber'],$o2['goodid'],$o2['goodname'],$o2['jine']);
//                             $_bonus_cl->ppweb($o2['ordersnumber'],$you['id']);
//                             $_bonus_cl->b0bonus();
//                         echo "<script language=javascript>alert('定向挂卖成功.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
//                         }else {
//                             echo "<script language=javascript>alert('未找到买家的订单，请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
//                         }
                        
                      
//                     }else {
//                         echo "<script language=javascript>alert('买家今天已经购买".$con."，挂卖失败！请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";	
//                     }
//                 }else {
//                     echo "<script language=javascript>alert('请输入挂卖的会员，请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";	
//                 }
//                 }else {
//                     echo "<script language=javascript>alert('不能挂卖给自己，请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
//                 }
//             }else {
                
//                 echo "<script language=javascript>alert('订单".$sys['num']."天后才可以挂售，请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";	
//             }
            
//         }else {
//             echo "<script language=javascript>alert('订单未匹配或已经挂售，请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";	
//         }
//     }else {
//         echo "<script language=javascript>alert('挂卖会员不在，请刷新后重试.');window.location.href='?oid=".$oid."&page=".$page."'</script>";
//     }
   
// }



if ($_POST['goback']){
	echo "<script language=javascript>window.location.href='order.php?page=".$page."'</script>";
}
$z= getOne("select id,goodsname,shichangjia from goods where id={$orders['zp']}");
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>我的订单</title>
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
                                <td colspan="6">
                                    订单编号：<?=$orders['ordersnumber']?><br/>
                                    物流公司：<?=$orders['logistics']?><br/>
                                    物流编号：<?=$orders['logisticsno']?><br/>

                                    收件人：<?=$orders['username']?><br/>
                                    联系电话：<?=$orders['usertel']?><br/>
                                    联系地址：<?=$orders['useraddress']?><br/>
                                </td>
                            </tr>
                            <tr>
                                <td>商品名称</td>
                                <td>金额</td>
                                <td>购买数量</td>
                                <td>总计金额</td>
<!--                                <td>提售状态</td>-->
                            </tr>
                            <tr>
                                <td><?=$orders['goodname']?></td>
                                <td ><?=$orders['price']?></td>
                                <td><?=$orders['num']?></td>
                                <td ><?=$orders['jine']?></td>
                            </tr>  
                             
                </table>
            </div>
        </div></form>
        <br/><br/><br/>
        <br/><br/><br/>
    
    </section>
        <?php include 'footer.php';?>
    
</body>
</html>