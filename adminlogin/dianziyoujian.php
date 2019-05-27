<?php
include("admin_check.php");
include_once("../class/email_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(6,23);
	$_email=new email_class();
	$email=$_email->getemail();
	
	
if($_POST['button']){
		$_email=new email_class();
		$email['id']=1;
		$email['isstart']=$_POST['isstart'];
		$email['txtzhy']=$_POST['txtzhy'];
		$email['txtzadmin']=$_POST['txtzadmin'];
		$email['cztzadmin']=$_POST['cztzadmin'];
		$email['hktzadmin']=$_POST['hktzadmin'];
		$email['ddtzadmin']=$_POST['ddtzadmin'];
		$email['emailuser']=$_POST['emailuser'];
		$email['emailpass']=$_POST['emailpass'];
		$email['emailname']=$_POST['emailname'];
		$email['emailsmtp']=$_POST['emailsmtp'];
		$email['zchy']=$_POST['zchy'];
		$email['hytitle']=$_POST['hytitle'];
		$email['hycontent']=$_POST['hycontent'];
		$_email->update_email($email);
		alert('保存成功.','?');
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>电子邮件</title>
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/xitongshezhi.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
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
            <!-- #EndLibraryItem -->  <form name="form1" method="post" action="?">
<div class="mainBox">
            	<h2>电子邮件<p>(此功能需要用户自行开启邮箱一些设置,具体开启方法请咨询技术人员。)</p></h2>
              
                <div class="table1 table">
                    <table>
                    	<tr>
                        	<td>电子邮件功能</td>
                            <td>
                            	<div class="box">
                            	<b></b>
                            	<input name="isstart" type="radio" id="isstart" value="1"  <?php if($email['isstart']==1){ ?> checked <?php }?>>
开
                                <i class="on"></i>
                            </div>
                            <div class="box">
                            	<b></b>
                            	<input type="radio" name="isstart" id="isstart" value="0" <?php if($email['isstart']==0){ ?> checked <?php }?>>
关
                                <i></i>
                            </div>
                            </td>
                        </tr>
                        <tr>
                        	<td>管理员邮箱账号</td>
                        	<td>
                            	<input name="emailuser" type="text" id="emailuser" value="<?=$email['emailuser']?>"/>
                            </td>
                        	
                        </tr>
                        <tr>
                        	<td>管理员邮箱账号</td>
                        	<td><input name="emailpass" type="password" id="emailpass" value="<?=$email['emailpass']?>"/></td>
                        </tr>
                        <tr>
                        	<td>管理员名称</td>
                        	<td><input name="emailname" type="text" id="emailname" value="<?=$email['emailname']?>"/></td>
                        </tr>
                        <tr>
                        	<td>SMTP</td>
                            <td>
                            	<input name="emailsmtp" type="text" id="emailsmtp" value="<?=$email['emailsmtp']?>"/>
                            </td>
                        </tr>
                        <tr>
                        	<td>提现通知</td>
                            <td>
                            		通知会员<input name="txtzhy" type="checkbox" id="txtzhy" value="1" <?php if($email['txtzhy']==1){?>checked<?php }?>>
          通知管理员<input type="checkbox" name="txtzadmin" id="txtzadmin" value="1" <?php if($email['txtzadmin']==1){?>checked<?php }?>>
                            		
                                
                            	
                            </td>
                        </tr>
                        <tr>
                        	<td>充值通知管理员</td>
                            <td>
                            <div class="box">
                            	<b></b>
                            	<input class="on" type="radio" name="cztzadmin" id="cztzadmin" value="1" <?php if($email['cztzadmin']==1){ ?> checked <?php }?>>
开
                                <i></i>
                            </div>
                            <div class="box">
                            	<b></b>
                            	
                            	<input type="radio" name="cztzadmin" id="cztzadmin" value="0" <?php if($email['cztzadmin']==0){ ?> checked <?php }?>>
    关
                                <i></i>
                            </div>
                                
                            </td>
                        </tr>
                        <tr>
                        	<td>汇款通知管理员</td>
                            <td>
                            <div class="box">
                            	<b></b>
                            	<input type="radio" name="hktzadmin" id="hktzadmin" value="1" <?php if($email['hktzadmin']==1){ ?> checked <?php }?>>
开
                                <i></i>
                            </div>
                            <div class="box">
                            	<b></b>
                            	<input type="radio" name="hktzadmin" id="hktzadmin" value="0" <?php if($email['hktzadmin']==0){ ?> checked <?php }?>>
    关
                                <i></i>
                            </div>
                                
                            	
                            </td>
                        </tr>
                        <tr>
                        	<td>订单通知管理员</td>
                            <td>
                            <div class="box">
                            	<b></b>
                            	<input type="radio" name="ddtzadmin" id="ddtzadmin" value="1" <?php if($email['ddtzadmin']==1){ ?> checked <?php }?>>
开
                                <i></i>
                            </div>
                            <div class="box">
                            	<b></b>
                            	<input type="radio" name="ddtzadmin" id="ddtzadmin" value="0" <?php if($email['ddtzadmin']==0){ ?> checked <?php }?>>
    关
                                <i></i>
                            </div>
                            </td>
                        </tr>
                        <tr>
                        	<td>注册欢迎邮件</td>
                            <td>
                            <div class="box">
                            	<b></b>
                            	<input type="radio" name="zchy" id="zchy" value="1" <?php if($email['zchy']==1){ ?> checked <?php }?>>
开
                                <i></i>
                            </div>
                            <div class="box">
                            	<b></b>
                            	<input type="radio" name="zchy" id="zchy" value="0" <?php if($email['zchy']==0){ ?> checked <?php }?>>
    关
                                <i></i>
                            </div>
                            	
                                
                            	
                            </td>
                        </tr>
                        <tr>
                        	<td>欢迎邮件标题</td>
                            <td>
                            	<input name="hytitle" type="text" id="hytitle" value="<?=$email['hytitle']?>" size="20" maxlength="50">
                            	
                                
                            	
                            </td>
                        </tr>
                        <tr>
                        	<td>欢迎邮件内容</td>
                            <td>
                            	 <textarea name="hycontent" id="hycontent" cols="45" rows="5"><?=$email['hycontent']?></textarea>
                            	
                                
                            	
                            </td>
                        </tr>
                        
                    </table>
                
                </div>
                    <input type="submit" id="button" value="保存" name="button" class="button"/>
                
            </div>
        </div></form>
    </section>
</div>
</body>
</html>