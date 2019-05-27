<!DOCTYPE html>
<?php
include("check.php");
include_once("../function.php");
include_once("../class/system_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
if($_SESSION['isbd']==2){
    $ID=$_GET['id'];
}
if($ID==""){
    $ID=$_SESSION['ID'];
}
$member=getMemberbyID($ID);
if ($_POST['submit1']){
    $_system=new system_class();
    $sys=$_system->system_information(1);
    if($_POST['newtradepass']!=NULL){
        if($_POST['confirmnewtradepass']==$_POST['newtradepass']) {
            if (md5($_POST['oldtradepass']) == $member['password2']) {
                $pass = md5($_POST['newtradepass']);
                $pass2 = $_POST['newtradepass'];
                edit_sql("update `member` set password2='" . $pass . "',pass2='" . $pass2 . "' where id=" . $_SESSION['ID'] . "");
                echo "<script language=javascript>alert('修改交易密码成功.');window.location.href='?'</script>";
            } else {
                echo "<script language=javascript>alert('原始交易密码错误,请确认后重新输入.');window.location.href='?'</script>";
            }
        }else {
            echo "<script language=javascript>alert('密码和确认密码不一致,请确认后重新输入.');window.location.href='?'</script>";
        }
    }
}
if ($_POST['submit']){
    $_system=new system_class();
    $sys=$_system->system_information(1);
    if($_POST['newpass']!=NULL){
        if($_POST['tradepass']==$_POST['newpass']) {
            if (md5($_POST['oldpass']) == $member['password1']) {
                $pass = md5($_POST['newpass']);
                $pass1 = $_POST['newpass'];
                edit_sql("update `member` set password1='" . $pass . "',pass1='" . $pass1 . "' where id=" . $_SESSION['ID'] . "");
                echo "<script language=javascript>alert('修改登录密码成功.');window.location.href='?'</script>";
            } else {
                echo "<script language=javascript>alert('原始登录密码错误,请确认后重新输入.');window.location.href='?'</script>";
            }
        }else {
            echo "<script language=javascript>alert('密码和确认密码不一致,请确认后重新输入.');window.location.href='?'</script>";
        }
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
<title>账户安全</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/register.css">
<script>
        function CheckForm(){
            oldpass=document.form1.oldpass.value;
            newpass=document.form1.newpass.value;
            confirmnewpass=document.form1.confirmnewpass.value;
            tradepass=document.form1.tradepass.value;
            if(oldpass.length == 0){
                alert("温馨提示:\n请输入原始密码.");
                document.form1.oldpass.focus();
                return false;
            }
            if(newpass.length == 0){
                alert("温馨提示:\n请输入新密码.");
                document.form1.newpass.focus();
                return false;
            }
            if(confirmnewpass.length == 0){
                alert("温馨提示:\n请输入确认新密码.");
                document.form1.confirmnewpass.focus();
                return false;
            }
            if(tradepass.length == 0){
                alert("温馨提示:\n请输入交易密码.");
                document.form1.tradepass.focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
 <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
            <form action="" method="post">
                <div class="table3">
                    <table>
                        <tr>
                            <td><strong>旧登录密码</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password" name="oldpass" id="oldpass" >
                            </td>
                        </tr>
                        <tr>
                            <td><strong>新登录密码</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	 <input name="newpass" type="password" id="newpass" >
                            </td>
                        </tr>
                        <tr>
                            <td><strong>确认登录密码</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password" name="tradepass" id="tradepass">
                            </td>
                        </tr>
                        <tr>
                            <td>
                            	<input type="submit" id="submit" name="submit" class="btn" value="修改登录密码" />
                            </td>
                        </tr>
                         <tr>
                            <td><strong>原始交易密码:</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password" name="oldtradepass" id="oldtradepass">
                            </td>
                        </tr>
                         <tr>
                            <td><strong>新交易密码:</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	<input type="password" name="newtradepass" id="newtradepass">
                            </td>
                        </tr>
                          <tr>
                            <td><strong>确认新密码:</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password" name="confirmnewtradepass" id="confirmnewtradepass">
                            </td>
                        </tr>
                        <tr>
                            <td>
                            	<input type="submit" id="submit" name="submit1" class="btn" value="修改交易密码" />
                            </td>
                        </tr>
                    </table>
                    
                    <ul class="clearfix">
                    	<li  style="width:100%">
                        	<a href="zhanghu.php" style="background:none; color:#555">返回</a>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
        
    
    </section><?php include 'footer.php';?>
</body>
</html>