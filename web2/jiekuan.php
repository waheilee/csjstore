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
   
   
    
      if(md5($_POST['password2'])==$member['password2']){
        if($member['jiekuan']==0){
           
            $sql="update member set jiekuan=1 where id={$uid}";
            mysql_query($sql);
    $ul=getOne("select * from ulevel where ulevel=".$member['ulevel']."");
            $jiekuan['uid']=$uid;
            $jiekuan['nickname']=$_SESSION['nickname'];
            $jiekuan['username']=$member['username'];
            $jiekuan['jine']=$ul['yl4'];
            //$jiekuan['mey']=$jine;
            $jiekuan['cdate']=now();
            //$jiekuan['sdate']=now();
           
            $jiekuan['tel']=$member['usertel'];
            $jiekuan['beizhu']=$_POST['beizhu'];
            //$jiekuan['goodsimg']=$_POST['goodsimg'];
            echo add_insert_cl('jiekuan',$jiekuan);
            
            
            echo "<script language=javascript>alert('申请提交成功，请等待审核通过。');window.location.href='?'</script>";
        }else{
            echo "<script language=javascript>alert('当前借款未全额还款.');window.location.href='?'</script>";
            return;
        }
     }else{
           echo "<script language=javascript>alert('二级密码不正确.');window.location.href='#'</script>";
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
<title>会员借款</title>
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
            	<li class="on"><a href="jiekuan.php">借款申请</a></li>
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
                                <input type='text' value="当次借款还清后才可进行下次借款!" name="num1" style="background:#eee" readonly/>
                            </td>
                        </tr>
                         <?php  
                        session_start();
                        $member=getMemberbyID($_SESSION['ID']);
                       
                        ?>
                        <tr>
                            <td><strong>已借款金额</strong></td>
                        </tr>
                       
                        <tr>
                            <td>
                            
                               <p class="yue bg">￥<?php echo $member['jkje'];?> </p>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>待还款金额</strong></td>
                        </tr>
                       
                        <tr>
                            <td>
                          
                               <p class="yue bg">￥<?php echo $member['hkje'];?> </p>
                            </td>
                        </tr>
                           <tr>
                            <td><strong>可借款金额</strong></td>
                        </tr>
                        
                         <tr>
                            <td>
                            <?php  $ul=getOne("select * from ulevel where ulevel=".$member['ulevel'].""); ?>
                               <p class="yue bg">￥<?php echo $ul['yl4'];?> </p>
                            </td>
                        </tr>
                        
                        
                        
                         <tr>
                            <td><strong>类型</strong></td>
                        </tr>
                        <tr>
                            <td>       
                           <select   >
                                     <option value="0">申请借款</option>
                                </select>    
                            </td>
                        </tr>
                       
                     <tr>
                            <td><strong>二级密码（默认：222222）</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password" id="password2" name="password2" placeholder="二级密码"/>
                            </td>
                        </tr>
                      
                      
                    </table>
                    
                    <ul class="clearfix">
                    	
                    <?php if($member['jiekuan']==0){?>	
                    	<li>
                        	    <input type="submit" value="提交申请" style="width: 40%;" id="submit" name="submit"
                                       onClick="javascript:return confirm('您确认提交申请吗？.');">
                        </li>
                    	<?php }else{?>
                    	
                    	<li>
                              <input type='text' value="已提交借款申请!"   style="background:#eee;color:black;" readonly/>
                         	 
                        </li>
                    	<?php }?>
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