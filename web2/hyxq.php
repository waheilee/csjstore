<!DOCTYPE html>
<?php
include("check.php");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
$_member_cl = new member_class();
$_bonus_cl = new bonus_class();
$member=getMemberbyID($_SESSION['ID']);

if($_POST['submit']){
    $lx=$_POST['lx'];
    if($_POST['uid']){
        $u= getMemberbyID($_POST['uid']);
        if($u==null){
            echo "<script language=javascript>alert('会员不存在，请刷新后重试！');window.location.href='jihuo.php'</script>";
            return;
        }
        if($u['ispay']==0){
            if($u['reid']==$member['id']){
                
                if($lx==1){
                    if($member['zsq']>=$u['dan']){
                        $up_member['zsq']=$member['zsq']-$u['dan'];//扣库存
                        edit_update_cl('member',$up_member,$member['id']);//更
                        $up_u['zsq']=$u['zsq']+$u['dan'];//扣库存
                        edit_update_cl('member',$up_u,$u['id']);//更

                        $_member_cl->jihuomember($u['id']);//激活
                        
                        $_member_cl->addbdrecord($u,$member,$u['lsk']);//激活记录
                        //$_bonus_cl->yeji_leiji($member['id'],$member['nickname'], $u['lsk'], 0);
                        $_member_cl->orders($member['id'],$u,0,1,0);//报单
                        $_member_cl->orders(0,$member,0,0,$u['ulevel']);//系统补货
                        
                    }else{
                        echo "<script language=javascript>alert('你的库存不足，无法激活该会员！');window.location.href='jihuo.php'</script>";
                        return;
                    }
                }else{
                    $_member_cl->jihuomember($u['id']);//激活
                    $_member_cl->addbdrecord($u,$member,$u['lsk']);//激活记录
                    $_member_cl->orders(0,$u,0,0,0);//订单
                }
                echo "<script language=javascript>alert('激活成功！');window.location.href='jihuo.php'</script>";
            } else {
                echo "<script language=javascript>alert('你不是该会员的推荐人，无法激活该会员！');window.location.href='jihuo.php'</script>";
                return;
            }
        }else{
            echo "<script language=javascript>alert('会员已激活，请刷新后重试！');window.location.href='jihuo.php'</script>";
            return;
        }
    }
}else{
    $ID=$_GET['id'];
    $u= getMemberbyID($ID);
    if($u==null || $u['ispay']<>0){
        echo "<script language=javascript>alert('会员不存在或已激活，请刷新后重试！');window.location.href='jihuo.php'</script>";
        return;
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
<title>会员详情</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/jbxx.css">
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    			<?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
          <form action="?" method="post" name="form">
        	<div class="table2">
               
            	<table>
                	<tr>
                    <input type="hidden" value="<?=$u['id']?>" name="uid">
                    	<td>编号：<?=$u['nickname']?></td>
                    </tr>
					<?php $ulvname=getOne("select id,lvname,yl2,yl3 from ulevel where ulevel={$u['ulevel']}") ?>
                	<tr>
                    	<td>等级：<?=$ulvname['lvname']?></td>
                    </tr>
                    
                    
                	<tr>
                    	<td>姓名：<?=$u['username']?></td>
                    </tr>
<!--                	<tr>
                    	<td>团队业绩：<?=$u['area1']+$u['area2']?></td>
                    </tr>-->
                    <tr>
                    	<td>配货：<?=$ulvname['yl2']?></td>
                    </tr>
                    <tr>
                    	<td>赠货：<?=$ulvname['yl3']?></td>
                    </tr>
                	<tr>
                    	<td>注册时间：<?=$u['rdt']?></td>
                    </tr>
<!--                	<tr>
                    	<td>激活时间：<?=$u['pdt']?></td>
                    </tr>-->
                    <?php if($u['ispay']==1){$xx='已开通';}else{$xx='未开通';} ?>
                	
                </table>
<!--                <table>
                    <tr>
                        <td>我的库存：<?=$member['zsq']?> 口
                        </td>
                    </tr>
                    <tr>
                        <td>发货类型：<select id="lx" name="lx" style="padding:2px;">
                                <option value="1">本人发货</option>
                                <option value="0">系统发货</option>
                                </select>
                        </td>
                    </tr>
                </table>-->
                
            </div>
<!--                <ul class="list3">
                    <li class="on"><input type="submit" id="submit" value="激活" name="submit"></li> 
                    <li class="on1"><a style="color: #999999" href="javascript:history.go(-1);">返回</a></li>
                </ul>-->
           </form>
        </div>
        
        <br/><br/>
    </section><?php include 'footer.php';?>
</body>
</html>