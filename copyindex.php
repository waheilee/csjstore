<!DOCTYPE html>
<?php
include("function.php");

session_start();
unset($_SESSION['ID']);
unset($_SESSION['NickName']);
unset($_SESSION['UserID']);
unset($_SESSION['isboss']);
header("Content-Type: text/html;charset=utf-8");
if ($_POST['loginnow'] == "loginnow"){
   
   if($_POST['txtValidCode'] == $_SESSION['code']){
      
        if(systemstatus()){
            // $na=getOne("select id from member where nickname={$_POST['txtUserAccount']}");
            // if($na){
                if (checkLogin($_POST['txtUserAccount'],$_POST['txtPassword'])){
                    $us=getMemberbyNickName($_POST['txtUserAccount']);
                    if ($us['islock']==0){
                        $_SESSION['ID']=$us['id'];
                        $_SESSION['nickname']=$us['nickname'];
                        $_SESSION['isboss']=$us['isboss'];
                        $_SESSION['sclogin']=$us['sclogin'];
                        $_SESSION['bclogin']=now();
                        $member_update['sclogin']=now();
                        edit_update_cl('member',$member_update,$us['id']);
                        echo "<script language=javascript>window.location.href='web2/zhanghu.php'</script>";
                    }else{
                        echo "<script language=javascript>alert('您已被管理员锁定,无法登陆,请联系管理员.');window.location.href='?'</script>";
                    }
                }elseif(checkLogin1($_POST['txtUserAccount'],$_POST['txtPassword'])){
                    $us=getOne("select * from member where usertel={$_POST['txtUserAccount']}");
                    if ($us['islock']==0){
                        $_SESSION['ID']=$us['id'];
                        $_SESSION['nickname']=$us['nickname'];
                        $_SESSION['isboss']=$us['isboss'];
                        $_SESSION['sclogin']=$us['sclogin'];
                        $_SESSION['bclogin']=now();
                        $member_update['sclogin']=now();
                        edit_update_cl('member',$member_update,$us['id']);
                        echo "<script language=javascript>window.location.href='web2/zhanghu.php'</script>";
                    }else{
                        echo "<script language=javascript>alert('您已被管理员锁定,无法登陆,请联系管理员.');window.location.href='?'</script>";
                    }

                }
                else{
                    echo "<script language=javascript>alert('用户名或密码错误.');window.location.href='?'</script>";
                }
            // }else{
            //     echo "<script language=javascript>alert('用户名不存在.');window.location.href='../web2/index.php'</script>";

            // }
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

<link rel="stylesheet" href="web2/css/show.css">
<script>
	function CheckForm(){
		//class="Validate"
		txtUserAccount=document.form1.txtUserAccount.value;
		txtPassword=document.form1.txtPassword.value;
		txtValidCode=document.form1.txtValidCode.value;
		if(txtUserAccount.length == 0){
			 alert("温馨提示:\n请输入会员编号或手机号");		
			document.form1.txtUserAccount.focus();
			return false;
		}
		if(txtPassword.length == 0){
			 alert("温馨提示:\n请输入登录密码");
			document.form1.txtPassword.focus();
			return false;
		}
		if(txtValidCode.length == 0){
			alert("温馨提示:\n请输入验证码");
			document.form1.txtValidCode.focus();
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
            	<!--  <img src="web2/images/logo22.png" alt=""/>-->产品中心
            </a>
        </div>
        <span class="return">
        	<a href="#">
        		<img src="web2/images/icon1.png" alt=""/>
        	</a>
        </span>
    
    </header>
    <section id="main">
    	<div class="pho">
        	<img src="web2/images/bill.jpg" alt=""/>
        </div>
        
       <form name="form1" method="post" action="?" id="form1" onSubmit="return CheckForm()">
       <INPUT type=hidden value=loginnow name=loginnow> 
        	<ul>
            	<li>
                    <input type="text" value="<?=$_GET['n']?>" name="txtUserAccount" class="username" placeholder="会员编号">
                	
                </li>
            	<li>
            		<input type="password" name="txtPassword" class="password" placeholder="密码">
                	
                </li>
                <li class="num">
                <input type="text" placeholder="验证码" class="yzm" name="txtValidCode" onFocus="this.value=''"/>
				<img id="txtValidCode" class="yzm1" alt="验证码图片" onclick="this.src=this.src+'?'" src="./code.php"  />    
                </li>
          		
            <br/>
            <p >
            	
            	<input type="submit" value="商城登陆" name="submit"/>
<!--              	 <a href="web2/register2.php?rname=admin" class="zc">新用户注册</a>-->
            	
            </p>
              <!-- #BeginLibraryItem "/Library/footer.lbi" -->
    
    	<p  class="bq"> </p>
   
              </ul>
        </form>
                <script src="assets/js/jquery-1.8.2.min.js"></script>

     <script src="assets/js/supersized-init.js"></script>
      <script src="assets/js/scripts.js"></script>
    </section>
   <footer id="gFooter">
<ul class="clearfix">

<!--<li>
<a href="web2/index.php">
<b><img src="web2/images/icon17.png" alt=""/></b>
产品
</a>
</li>
<li>
<a href="web2/gsdt.php">
<b><img src="web2/images/icon19.png" alt=""/></b>
排单
</a>
</li>

<li>
    <a href="web2/scgg.php">
<b><img src="web2/images/icon16.png" alt=""/></b>
公告
</a>
</li>
<li>
<a href="web2/zhanghu.php">
<b><img src="web2/images/icon18.png" alt=""/></b>
账户
</a>
</li>-->
</ul>
</footer>
	

</div>
</body>
</html>