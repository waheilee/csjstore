<!DOCTYPE html>
<?php
include("check.php");
include_once("../function.php");
include("check2.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);
header("Content-Type: text/html;charset=utf-8");
$belevel=$_POST['belevel'];
if ($_POST['submit']){
    $uid=$_SESSION['ID'];
    $res = getOne("SELECT * FROM member where id=$uid");
    $bdlevel=$_POST['bdlevel'];
    $jine=$member['area1']+$member['area2'];
    $iul1=getOne("select a1,a2,a3 from jiandian where id=1");
    $iul2=getOne("select a1,a2,a3 from jiandian where id=2");
    $iul3=getOne("select a1,a2,a3 from jiandian where id=3");
    $iul4=getOne("select a1,a2,a3 from jiandian where id=4");
    $iul5=getOne("select a1,a2,a3 from jiandian where id=5");
    $xx=0;
    //lv1
    if($bdlevel==1){
        if($jine>=$iul1['a1'] && $res['recount']>=$iul1['a2']){
            $xx=1;
        }else{
            echo "<script language=javascript>alert('您的业绩不足,申请失败.');window.location.href='?'</script>";
            return;
        }
    }
    //lv2
    if($bdlevel==2){
        if($jine>=$iul2['a1'] && $res['recount']>=$iul2['a2']){
            $xx=1;
        }else{
            echo "<script language=javascript>alert('您的业绩不足,申请失败.');window.location.href='?'</script>";
            return;
        }
    }
    //lv3
    if($bdlevel==3){
        if($jine>=$iul3['a1'] && $res['recount']>=$iul3['a2']){
            $xx=1;
        }else{
            echo "<script language=javascript>alert('您的业绩不足,申请失败.');window.location.href='?'</script>";
            return;
        }
    }
    //lv4
    if($bdlevel==4){
        if($jine>=$iul4['a1'] && $res['recount']>=$iul4['a2']){
            $xx=1;
        }else{
            echo "<script language=javascript>alert('您的业绩不足,申请失败.');window.location.href='?'</script>";
            return;
        }
    }
    //lv5
    if($bdlevel==5){
        if($jine>=$iul5['a1'] && $res['recount']>=$iul5['a2']){
            $xx=1;
        }else{
            echo "<script language=javascript>alert('您的业绩不足,申请失败.');window.location.href='?'</script>";
            return;
        }
    } 
    if($xx==1){
        $fuli['uid']=$member['id'];
        $fuli['nickname']=$member['nickname'];
        $fuli['date']=now();
        $fuli['lv']=$bdlevel;
        $fuli['isff']=0;
        $fuli['yeji']=$jine;
        $fuli['recount']=$res['recount'];
        add_insert_cl('fulijiang',$fuli);
        echo "<script language=javascript>alert('申请提交成功，请等待审核通过。');window.location.href='?'</script>";
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
<title>福利奖申请</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/register.css">
</head>
<body>
<div id="container">
	
  <section id="main">
  <header id="gHeader"> 
    		<?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
    	<div class="mainBox">
    	<ul class="list2 list1 clearfix">
            	<li class="on"><a href="fulijiang.php">福利奖申请</a></li>
            	<!--  
            	<li><a href="lcjl.php">申请记录</a></li>
            	-->
            </ul>
            <form action="" method="post">
                <div class="table3">
                    <table>
                        <tr>
                            <td><strong>温馨提示</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <input type='text' value="申请前请确定自己业绩充足后进行申请!" name="num1" style="background:#eee" readonly/>
                            </td>
                        </tr>
                       
                        <tr>
                            <td><strong>团队业绩</strong></td>
                        </tr>
                         <?php  
                        session_start();
                        $member=getMemberbyID($_SESSION['ID']);
                       
                        ?>
                        <tr>
                            <td>
                               <p class="yue bg">￥<?php echo $member['area1']+$member['area2'];?> </p>
                            </td>
                        </tr>
                         <tr>
                            <td><strong>推荐人数</strong></td>
                        </tr>
                        <tr>
                            <td>
                               <p class="yue bg"><?php echo $member['recount'];?> </p>
                            </td>
                        </tr>
                         <tr>
                            <td><strong>申请类型</strong></td>
                        </tr>
                        <tr>
                            <td>       
                           <select  name="bdlevel" id="bdlevel">
                                     <option value="1">福利奖Lv1</option>
                                     <option value="2">福利奖Lv2</option>
                                     <option value="3">福利奖Lv3</option>
                                     <option value="4">福利奖Lv4</option>
                                     <option value="5">福利奖Lv5</option>
                                </select>    
                            </td>
                        </tr>
                       
                   
                      
                      
                    </table>
                    
                    <ul class="clearfix">
                    	<li>
                        	    <input type="submit" value="提交申请" style="width: 40%;" id="submit" name="submit"
                                       onClick="javascript:return confirm('您确认提交申请吗？.');">
                        </li>
                    	<li>
                        	<a href="javascript:history.back(-1);">返回</a>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
        
    
    </section>
     <?php include 'footer.php';?>
</body>
</html>