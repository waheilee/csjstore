<?php
	include_once("../class/admin_class.php");
	
	session_start();
	unset($_SESSION['to_admin']);
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
			
				echo "<script language=javascript>window.location.href='main.php'</script>";	
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
	NickName=document.form1.username.value;
	password=document.form1.password.value;
	if(NickName.length == 0){
		alert("请输入用户名.");
		document.form1.username.focus();
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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="会员管理系统">
    <meta name="keywords" content="会员管理系统">
    <title>会员管理系统</title>
    <link rel="stylesheet" type="text/css" href="adminstyle/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="adminstyle/css/login.css">
    <script type="text/javascript" src="adminstyle/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="adminstyle/js/jquery1.js"></script>
</head>
<body id="login" >
    <div class="container" style="position:relative;">
        <div class="login-con">
            <div class="logo"><img src="adminstyle/img/111.jpg" alt=""/></div>
            <h4>会员管理平台</h4>
            <div class="login-main">
                <h5>登录中心<span></span><span class="last"></span></h5>
                <form name="form1" method="post" action="?" id="form1" style="*margin:0;*padding:0;" onSubmit="return CheckForm()">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwULLTE2ODIzOTA3MTJkZCNhRMEfRY7ooHXTBmHnnKOQUUi2TdxzpyCkMxyD6mQY" />
</div>

<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="CA0B0334" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEdAAbhmtYni7Vc1/W5OD471Oevr9HSIn4c+u2hJJ7wsjwta1J+LPGCtMWcL/TMKTvQvbQRIIWQVb9G6HNjWgtv81RU6ZACrx5RZnllKSerU+IuKs34O/GfAV4V4n0wgFZHr3ci1NflSkX8rPHAPn0ipFwwUF8m/YP2TctUxx1E6rPggg==" />
</div>
                    <div class="bs-example">
                        <i><img src="adminstyle/img/icon2.png" alt=""/></i>
                        <div class="input-con"><input name="username" type="text" maxlength="30" id="username" placeholder="输入管理员编号" /></div>
                    </div>
                    <div class="bs-example">
                        <i><img src="adminstyle/img/icon1.png" alt=""/></i>
                        <div class="input-con"><input name="password" type="password" maxlength="20" id="password" placeholder="输入密码" /></div>
                    </div>
                    
                   
                    <div class="login-btn row">
                        <div class="col-xs-6"><input type="submit" name="button" value="登录" id="button" class="btn btn-block" /></div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(function(){
        var wHeight = $(window).height();
        $('#login').height(wHeight + 'px');
        if((wHeight - $('.login-con').height()) >= 40){
            $('.login-con').css('top',(wHeight - $('.login-con').height() - 80)/2 + 'px');
        }
        JPlaceHolder.init();
    });
    var JPlaceHolder = {
        //检测
        _check : function(){
            return 'placeholder' in document.createElement('input');
        },
        //初始化
        init : function(){
            if(!this._check()){
                this.fix();
            }
        },
        //修复
        fix : function(){
            jQuery(':input[placeholder]').each(function(index, element) {
                var self = $(this), txt = self.attr('placeholder');
                self.wrap($('<div></div>').css({position:'relative', zoom:'1', border:'none', background:'none', padding:'none', margin:'none'}));
                var pos = self.position(), h = self.outerHeight(true), paddingleft = self.css('padding-left');
                var holder = $('<span></span>').text(txt).css({position:'absolute', left:'0px', top:pos.top, height:h, lineHeight:h + 'px', paddingLeft:paddingleft, color:'#aaa'}).appendTo(self.parent());
                self.focusin(function(e) {
                    holder.hide();
                }).focusout(function(e) {
                    if(!self.val()){
                        holder.show();
                    }
                });
                holder.click(function(e) {
                    holder.hide();
                    self.focus();
                });
            });
        }
    };
</script>
<script>
  	var _mtac = {"performanceMonitor":1,"senseQuery":1};
  	(function() {
  		var mta = document.createElement("script");
  		mta.src = "http://pingjs.qq.com/h5/stats.js?v2.0.4";
  		mta.setAttribute("name", "MTAH5");
  		mta.setAttribute("sid", "500508692");
  		mta.setAttribute("cid", "500508693");
  		var s = document.getElementsByTagName("script")[0];
  		s.parentNode.insertBefore(mta, s);
  	})();
</script>
</html>