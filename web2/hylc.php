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
    
    $res = getOne("SELECT * FROM member where id={$uid}");
   	// $bdlevel=$_POST['bdlevel'];

//     if (md5($_POST['password2'])==$member['password2']){
     
//         if ($bdlevel==1){
//         	$lsk=$sys['sqfwzx'];
//         }else {
//         	$lsk=$sys['sqfwzx2'];
//         }
      
    	if($res['isbd']<1){
    		
    		
    			//if ($res['zjulevel']>=2){
    	
    				$sql="update member set isbd=1,date1=now() where id={$uid}";
    				mysql_query($sql);
    				echo "<script language=javascript>alert('申请提交成功，请等待审核通过。');window.location.href='?'</script>";
    			//}else {
    			//  
    			//	echo "<script language=javascript>alert('级别不足，无法申请报单中心!');window.location.href='?'</script>";
    			//}
    	
    	}else{
    		
    		echo "<script language=javascript>alert('您已申请为实体展厅，请不要重复申请!');window.location.href='?'</script>";
    	}
        
//     }
//     else{
//         echo "<script language=javascript>alert('二级密码不正确.');window.location.href='?id=".$ID."'</script>";
//     }
}

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>实体展厅申请</title>
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
            	<li class="on"><a href="hylc.php">实体展厅申请</a></li>
            	<!--  
            	<li><a href="lcjl.php">申请记录</a></li>
            	-->
            </ul>
            <form action="" method="post">
                <div class="table3">
                   <table>
                        <!-- <tr>
                            <td><strong>申请条件</strong></td>
                        </tr> -->
                        <tr>
                            <td>
                                <input type='text' value="请点击提交申请按钮,申请成为实体展厅" name="num1" style="background:#eee" readonly/>
                            </td>
                        </tr>
                       
                         <!-- <tr>
                            <td><strong>当前业绩</strong></td>
                        </tr>
                         <?php  
                        session_start();
                        $member=getMemberbyID($_SESSION['ID']);
                       
                        ?>
                        <tr>
                            <td>
                            <?php ?>
                               <p class="yue bg">￥<?php echo $member['area1']+$member['area2'];?> </p>
                            </td>
                        </tr>
                        
                           <tr>
                            <td><strong>需求业绩</strong></td>
                        </tr>
                        
                         <tr>
                            <td>
                            <?php  $sys=getOne("select d2 from systemparameters where id =1"); ?>
                               <p class="yue bg">￥<?php echo $sys['d2'];?> </p>
                            </td>
                        </tr>
                        
                        
                        
                         <tr>
                            <td><strong>申请类型</strong></td>
                        </tr>
                        <tr>
                            <td>       
                           <select  name="bdlevel" id="bdlevel">
                                     <option value="2">服务中心</option>
                                </select>    
                            </td>
                        </tr>-->
                       
                   
                      
                      
                    </table> 
                    <?php
                    // $me=getOne("select id from orders2 where uid={$member['id']} and jine>=5000 and lx>=1 and lx<=4");
                    // if($me){

                    
                    ?>
                    <ul class="clearfix">
                    	<li>
                        	    <input type="submit" value="提交申请" style="width: 40%;" id="submit" name="submit"
                                       onClick="javascript:return confirm('您确认提交申请吗？');">
                        </li>
                    	<!-- <li>
                        	<a href="javascript:history.back(-1);">返回</a>
                        </li> -->
                    </ul>
                    <?php
                        // }else{
                    ?>
                        <!-- <p>您不符合申请实体展厅条件!</p> -->
                    <?php
                        // }
                    ?>
                    <table border="1" cellspacing="0">
                    <tr><td align="center" colspan="2"><b>实体展厅申请记录</b></td></tr>
                    <tr>
                        <td align="center">会员编号</td>
                        <td align="center">申请日期</td>
                        <td align="center">审核日期</td>
                        <td align="center">审核状态</td>
                    </tr>
                    <?php
                    $us=getOne("select id,nickname,isbd,date1,date2 from member where id={$member['id']} and isbd>=1");
                    ?>
                    <tr>
                        <td align="center"><?=$us['nickname']?></td>
                        <td align="center"><?=$us['date1']?></td>
                        <td align="center"><?=$us['date2']?></td>
                        <td align="center">
                        <?php if ($us['isbd']==2){?>已通过<?php }elseif($us['isbd']==1){ ?> <font color="#FF0000">审核中</font>  <?php }else{ ?><?php }?>
                        </td>
                    </tr>
                    </table>

                </div>
            </form>
        </div>
        
    
    </section>
     <?php include 'footer.php';?>
</body>
</html>