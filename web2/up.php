<!DOCTYPE html>
<?php
include_once ("check.php");
include("check2.php");
include_once("../function.php");
include_once("../bonus.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");
include_once("../class/system_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
$bonus_cl=new bonus_class();
$_member_cl= new member_class();
$_systemyeji= new system_class();
// $ID=$_GET['ID'];
// if ($ID=="")
$ID=$_SESSION['ID'];
$member = getMemberbyID($_SESSION['ID']);
// $cx="&ID=".$ID."";
if($_GET['id']){
    $orders=getOne("select id,uid,ordersnumber,issend,sgb,goods,lx,shumu,bid from orders where id=".$_GET['id']." ");
    $u=getOne("select id,zsq,ulevel from member where id=".$orders['uid']." ");
    $bd= getOne("select a1 from jiangjin where id=1");
    $o= getOne("select * from goods where id={$bd['a1']}");
    if($orders['bid']<>$_SESSION['ID']){
        echo "<script language=javascript>alert('操作失误，请刷新后重试');window.location.href='?'</script>";
    }
    if($member['zsq']>=$orders['shumu']){
        if ($orders['issend']==0){
            $bonus_cl->fahuo($orders['id']);
        }
        $me_update['zsq'] = $member['zsq']-$orders['shumu'];//扣库存
        edit_update_cl('member',$me_update,$member['id']);
        $_member_cl->add($member['id'],$orders['shumu'],$orders['shumu']*$o['price']);//业绩
        if($u['ulevel']>1){
            $u_update['zsq'] = $u['zsq']+$orders['shumu'];//个人剩余数量
            edit_update_cl('member',$u_update,$orders['uid']);
        }
        echo "<script language=javascript>alert('订单发货完成');window.location.href='?'</script>";
    }else{
        echo "<script language=javascript>alert('您的库存不足，发货失败');window.location.href='?'</script>";
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
<title>发货列表</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/tuijian.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    		<?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
        	<div class="table">
            	<table>
                	<tr>
                        <td>订单编号</td>
                    	<td>类型</td>
                    	<td>会员编号</td>
                        <td>会员姓名</td>
                    	<td>差额数量</td>
                        <td>赠品数量</td>
                        <td>订单时间</td>
                    	<td>操作</td>
                    </tr>
                     <?php
                            
                            $pagesize = 20; //设置每页记录数
                            $sql = "SELECT id FROM `orders` WHERE lx=-1 and uid in (select id from member where zju=0) and bid=".$ID." and issend=0";
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
                            $sql = "SELECT * FROM `orders` WHERE lx=-1 and uid in (select id from member where zju=0) and bid=".$ID." and issend=0 order by cdate desc";
                            if(getOne($sql)){
                            if($query = mysql_query($sql)){
                                while ($row=mysql_fetch_array($query)){
                                   switch ($row['lx']){
                                        case -1:$lx="升级";break;
                                        case 0:$lx="报单";break;
                                        case 1:$lx="补货";break;
                                        case 2:$lx="购物";break;

                                    }
                                    //$ul= getOne("select lvname from ulevel where ulevel={$row['ulevel']}");
                                    ?>
                    <tr>
                    	<td><?=$row['ordersnumber']?></td>
                        <td><?=$lx?></td>
                        <td><?=$row['userid']?></td>
                    	<td><?=$row['username']?></td>
                    	<td><?=$row['shumu']?></td>
                        <td><?=$row['znum']?></td>
                        <td><?=$row['cdate']?></td>
                    	<td><a href="up.php?id=<?=$row['id']?>">发货</a></td>
                    </tr>
                    <?php }
                    
                            }}else{?>
                            <tr>
                                    <td colspan="10">暂无内容</td>
                                </tr>
                            <?php } ?>
                                <tr>
                                <td align="center" colspan="10"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
                            </tr>
                </table>
            </div>
        </div>
        <br/><br/><br/>
        <br/><br/><br/>
    
    </section>
            <?php include 'footer.php';?>
    
</body>
</html>