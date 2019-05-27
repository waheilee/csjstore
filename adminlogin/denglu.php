<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>会员管理系统</title>
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/denglu.css">
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}                                         
</script>
</head>
<?php
	include_once("../class/admin_class.php");
	session_start();
	if ($_POST['button'])
	{
		
		$_admin = new admin_class();
		if ($loginadmin=$_admin->getadminbynamepass($_POST['username'],$_POST['password']))
		{
			if($_SESSION['to_admin']){
				alert("检测到您上个帐号尚未退出登录,请您先安全退出上个帐号或关闭浏览器后再尝试重新登录","?");
			}else{
				$_SESSION['to_admin']=$loginadmin['loginname'];
				$_SESSION['adminid']=$loginadmin['id'];
				$_SESSION['qx']=$loginadmin['group'];
				date_default_timezone_set('PRC');
				$_SESSION['lgdate']=date('Y-m-d H:i:s',time());
				$_SESSION['sclgdate']=$loginadmin['logindate'];
				$update_admin['logindate']=$_SESSION['lgdate'];
				$_SESSION['nickname']=$_POST['username'];
				$_SESSION['zq1']=$loginadmin['zq1'];
				$_SESSION['zq2']=$loginadmin['zq2'];
				$_SESSION['zq3']=$loginadmin['zq3'];
				$_SESSION['zq4']=$loginadmin['zq4'];
				$_SESSION['zq5']=$loginadmin['zq5'];
				$_SESSION['zq6']=$loginadmin['zq6'];
				$_SESSION['zq7']=$loginadmin['zq7'];
				$_SESSION['zq8']=$loginadmin['zq8'];
				$_SESSION['zq9']=$loginadmin['zq9'];
				$_SESSION['zq10']=$loginadmin['zq10'];
				$_SESSION['q1']=$loginadmin['q1'];
				$_SESSION['q2']=$loginadmin['q2'];
				$_SESSION['q3']=$loginadmin['q3'];
				$_SESSION['q4']=$loginadmin['q4'];
				$_SESSION['q5']=$loginadmin['q5'];
				$_SESSION['q6']=$loginadmin['q6'];
				$_SESSION['q7']=$loginadmin['q7'];
				$_SESSION['q8']=$loginadmin['q8'];
				$_SESSION['q9']=$loginadmin['q9'];
				$_SESSION['q10']=$loginadmin['q10'];
				$_SESSION['q11']=$loginadmin['q11'];
				$_SESSION['q12']=$loginadmin['q12'];
				$_SESSION['q13']=$loginadmin['q13'];
				$_SESSION['q14']=$loginadmin['q14'];
				$_SESSION['q15']=$loginadmin['q15'];
				$_SESSION['q16']=$loginadmin['q16'];
				$_SESSION['q17']=$loginadmin['q17'];
				$_SESSION['q18']=$loginadmin['q18'];
				$_SESSION['q19']=$loginadmin['q19'];
				$_SESSION['q20']=$loginadmin['q20'];
				$_SESSION['q21']=$loginadmin['q21'];
				$_SESSION['q22']=$loginadmin['q22'];
				$_SESSION['q23']=$loginadmin['q23'];
				$_SESSION['q24']=$loginadmin['q24'];
				$_SESSION['q25']=$loginadmin['q25'];
				$_SESSION['q26']=$loginadmin['q26'];
				$_SESSION['q27']=$loginadmin['q27'];
				$_SESSION['q28']=$loginadmin['q28'];
				$_SESSION['q29']=$loginadmin['q29'];
				$_SESSION['q30']=$loginadmin['q30'];
				$_SESSION['q31']=$loginadmin['q31'];
				$_SESSION['q32']=$loginadmin['q32'];
				$_SESSION['q33']=$loginadmin['q33'];
				$_SESSION['q34']=$loginadmin['q34'];
				$_SESSION['q35']=$loginadmin['q35'];
				$_admin->admin_update($update_admin,$loginadmin['id']);
				
				//记录登陆IP
				$_admin->admin_denglu($loginadmin['loginname']);
				echo "<script language=javascript>window.location.href='index.php'</script>";	
			}
		}else{
			alert('用户名密码错误,请重新登录','?');
		}
	}
	
	if ($_GET['action']=="Quit"){
		$_SESSION['qx']="";
		$_SESSION['to_admin']="";
		$_SESSION['adminid']="";
		$_SESSION['lgdate']="";
		$_SESSION['sclgdate']="";
		$_SESSION['zq1']="";
		$_SESSION['zq2']="";
		$_SESSION['zq3']="";
		$_SESSION['zq4']="";
		$_SESSION['zq5']="";
		$_SESSION['zq6']="";
		$_SESSION['zq7']="";
		$_SESSION['zq8']="";
		$_SESSION['zq9']="";
		$_SESSION['zq10']="";
		$_SESSION['q1']="";
		$_SESSION['q2']="";
		$_SESSION['q3']="";
		$_SESSION['q4']="";
		$_SESSION['q5']="";
		$_SESSION['q6']="";
		$_SESSION['q7']="";
		$_SESSION['q8']="";
		$_SESSION['q9']="";
		$_SESSION['q10']="";
		$_SESSION['q11']="";
		$_SESSION['q12']="";
		$_SESSION['q13']="";
		$_SESSION['q14']="";
		$_SESSION['q15']="";
		$_SESSION['q16']="";
		$_SESSION['q17']="";
		$_SESSION['q18']="";
		$_SESSION['q19']="";
		$_SESSION['q20']="";
		$_SESSION['q21']="";
		$_SESSION['q22']="";
		$_SESSION['q23']="";
		$_SESSION['q24']="";
		$_SESSION['q25']="";
		$_SESSION['q26']="";
		$_SESSION['q27']="";
		$_SESSION['q28']="";
		$_SESSION['q29']="";
		$_SESSION['q30']="";
		$_SESSION['q31']="";
		$_SESSION['q32']="";
		$_SESSION['q33']="";
		$_SESSION['q34']="";
		$_SESSION['q35']="";
	}
?>
<script>
function CheckForm(){
	NickName=document.form1.NickName.value;
	password=document.form1.password.value;
	if(NickName.length == 0){
		alert("请输入用户名.");
		document.form1.NickName.focus();
		return false;
	}
	if(password.length == 0){
		alert("请输入密码.");
		document.form1.password.focus();
		return false;
	}
}
function submitYouFrom(path){
 $('form1').action=path;
 $('form1').submit();
}
</script>
<body>
<div id="container">
	<div class="denglu">
    <form method="post" name="form1" action="" onSubmit="return CheckForm()">
    	<ul>
        	<li><p>用户名</p><input type="text" value="" name="username"/>
            </li>
        	<li><p>密码</p>
            	<input type="password" value="" name="password"/>
            </li>
        	<!--<li><p>验证码</p>
            	<input type="text" placeholder="验证码" name="name1" class="yzm"/>
                <img src="img/commen/yzm.png" alt=""/>
            </li>-->
            <li>
            	<input type="submit" value="确认登录" name="button"/>
            </li>
        
        </ul>
    </form>
    </div>



</div>


</body>
</html>
