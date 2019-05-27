<!DOCTYPE html>
<?php
include("function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
unset($_SESSION['ID']); 
unset($_SESSION['NickName']); 
unset($_SESSION['UserID']); 
unset($_SESSION['isboss']);
unset($_SESSION['pass']);
if ($_POST['loginnow'] == "loginnow"){
 	if($_POST['txtValidCode'] == $_SESSION['code']){
		if(systemstatus()){
			if (checkLogin($_POST['txtUserAccount'],$_POST['txtPassword'])){
				$us=getMemberbyNickName($_POST['txtUserAccount']);
				if ($us['islock']==0){
                    if ($us['ispay']>0) {
                        $_SESSION['ID'] = $us['id'];
                        $_SESSION['nickname'] = $us['nickname'];
                        $_SESSION['isboss'] = $us['isboss'];
                        $_SESSION['sclogin'] = $us['sclogin'];
                        $member_update['sclogin'] = now();
                        edit_update_cl('member', $member_update, $us['id']);

                        echo "<script language=javascript>window.location.href='./web2/index.php'</script>";
                    }else{
                        echo "<script language=javascript>alert('您还未激活,无法登陆,请联系管理员.');window.location.href='?'</script>";
                    }
				}else{
					echo "<script language=javascript>alert('您已被管理员锁定,无法登陆,请联系管理员.');window.location.href='?'</script>";	
				}
			}else{
				echo "<script language=javascript>alert('用户名或密码错误.');window.location.href='?'</script>";
			}
		}else{
    		echo "<script language=javascript>alert('系统维护,暂时关闭,给您带来不便我们感到万分抱歉.');window.location.href='?'</script>";
		}
	}else{
		echo "<script language=javascript>alert('验证码错误.');window.location.href='?'</script>";
	}
}else{
	$_SESSION['ID']=null;
	$_SESSION['nickname']=null;
	$_SESSION['userid']=null;
	$_SESSION['isboss']=null;
	$_SESSION['pass2']=null;
	$_SESSION['pass3']=null;
	$_SESSION['bdname']=null;
	$_SESSION['bdid']=null;
		
}

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>登陆</title>
<link rel="stylesheet" href="assets/css/common.css">
<link rel="stylesheet" href="assets/css/denglu.css">
<script>
	function CheckForm(){
		txtUserAccount=document.form.txtUserAccount.value;
		txtPassword=document.form.txtPassword.value;
		txtValidCode=document.form.txtValidCode.value;
		if(txtUserAccount.length == 0){
			 alert("温馨提示:\n请输入会员编号.");		
			document.form.txtUserAccount.focus();
			return false;
		}
		if(txtPassword.length == 0){
			 alert("温馨提示:\n请输入登录密码.");
			document.form.txtPassword.focus();
			return false;
		}
		if(txtValidCode.length == 0){
			alert("温馨提示:\n请输入验证码.");
			document.form.txtValidCode.focus();
			return false;
		}
		return true;
	}
	</script>
</head>
<body>
<div id="container">
	<header id="gHeader"> 
    	<div class="logo">
        	<a href="#">
            	<img src="images/logo.png" alt=""/>百隆升网络科技
            </a>
        </div>
        <span class="return">
        	<a href="#">
        		<img src="images/icon1.png" alt=""/>
        	</a>
        </span>
    
    </header>
    <section id="main">
    	<div class="pho">
        	<img src="images/bill.jpg" alt=""/>
        </div>
       <form name="form" method="post" action="Index.php" id="form" onSubmit="return CheckForm()">
        <INPUT type=hidden value=loginnow name=loginnow> 
        	<ul>
            	<li>
            		<input type="text" name="txtUserAccount" class="username" placeholder="用户名">
                	
                </li>
            	<li>
            		<input type="password" name="txtPassword" class="password" placeholder="密码">
                	
                </li>
            </ul>
            <br/>
            <p class="clearfix">
            	
            	<input type="submit" value="商城登陆" name="btn"/>
            	<!--  <a href="#" class="zc">新用户注册</a>
            	-->
            </p>
            
        </form>
    
    </section>
    <?php include 'web2/footer.php';?>
	

</div>
</body>
</html>