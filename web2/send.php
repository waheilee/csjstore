<!DOCTYPE html>
<?php
include("../member/check.php");
include("../member/check2.php");
include_once("../function.php");
$information=que_select_cl('information',1);
header("Content-Type: text/html;charset=utf-8");
session_start();
$us=que_select_cl('member',$_SESSION['ID']);
if ($_POST['submit']){


    if(empty($_POST['snickname'])){
        echo"<script>alert('会员不能为空');history.go(-1);</script>";
        //echo "<script language=javascript>alert('您输入有误，正在返回列表');window.location.href='message.php?'</script>";
        exit;
    }
    if(empty($_POST['title'])){
        echo"<script>alert('标题不能为空');history.go(-1);</script>";
        exit;
    }
    if(empty($_POST['mailcontent'])){
        echo"<script>alert('内容不能为空');history.go(-1);</script>";
        exit;
    }
    if(empty($_POST['sendcode'])){
        echo"<script>alert('验证码不能为空');history.go(-1);</script>";
        exit;
    }
    if($_POST['sendcode']!==$_SESSION['sendcode']){
        echo"<script>alert('验证码不正确');history.go(-1);</script>";
        exit;
    }
    //var_dump($_POST);exit;
    if ($sus=getMemberbyNickName($_POST['snickname'])){
        
        
        
        if($sus['nickname']!=$us['nickname']){
            $mail['uid']=$us['id'];
            $mail['nickname']=$us['nickname'];
            $mail['sid']=$sus['id'];
            $mail['snickname']=$sus['nickname'];
            $mail['title']=$_POST['title'];
            $mail['mailcontent']=$_POST['mailcontent'];
            $mail['fdate']=now();
            echo add_insert_cl('mail',$mail);
            echo "<script language=javascript>alert('发送成功.');window.location.href='?'</script>";
        }else{
            echo "<script language=javascript>alert('不能给自己发送站内信');window.location.href='?'</script>";
        }

    }else{
        echo "<script language=javascript>alert('该会员不存在,请确认后重新填写');window.location.href='?'</script>";
    }
}
$member = getMemberbyID($_SESSION['ID']);
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>发送邮件</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/send.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
        	<ul class="list6 clearfix">
            	<li>
                	<a href="wdxx.php">收件箱</a>
                </li>
            	<li>
                	<a href="fajianxiang.php">发件箱</a>
                </li>
            	<li class="on">
                	<a href="send.php">发送邮件</a>
                </li>
            </ul>
            
            <br/>
            <form action="" method="post" class="form1">
            	<table>
            		<tr>
                    	<th>收件人</th>
                    </tr>
                	<tr>
                    	<th><input type="text" name="snickname" id="snickname" value="admin" readonly/></th>
                    </tr>
                	<tr>
                    	<th>标题</th>
                    </tr>
                	<tr>
                    	<th><input type="text" name="title" id="title" value=""/></th>
                    </tr>
                	<tr>
                    	<th>内容</th>
                    </tr>
                	<tr>
                    	<th><textarea name="mailcontent" id="mailcontent" style="height: 300px;"></textarea></th>
                    </tr>
                    <tr>
                    	<th>验证码</th>
                    </tr>
                	<tr>
                    	<th><input type="text" name="sendcode" value="" class="yzm"/>
                    	<img style="display: none" src="img/commen/captcha.png" alt=""/>
                                <img style="width: 30%; " id="txtValidCode" class="Validate" alt="验证码图片" onclick="this.src=this.src+'?'" src="./verification_code.php"  /></th>
                    </tr>
                </table>
            
            
            </form>
            <br/>
           <ul class="list3 clearfix">
           	<li>
            	<input name="submit" type="submit" value="发送信息">
            </li>
           	<li>
            	<a href="fajianxiang.php">返回列表</a>
            </li>
           </ul>
        </div>
    <br/> <br/> <br/>
    </section><?php include 'footer.php';?>
</body>
</html>