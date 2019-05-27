<!DOCTYPE html PUBLIC "-//w3c//dtd html 4.0 transitional//en">
<?php
include("function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
unset($_SESSION['ID']); 
unset($_SESSION['NickName']); 
unset($_SESSION['UserID']); 
unset($_SESSION['isboss']);


if ($_POST['loginnow'] == "loginnow"){//echo $_SESSION['verification'];
	if($_POST['login_yzm'] == $_SESSION['verification']){
		if(systemstatus()){
			if (checkLogin($_POST['username'],$_POST['password'])){
				$us=getMemberbyNickName($_POST['username']);
				if ($us['islock']==0){
				$_SESSION['ID']=$us['id'];
				$_SESSION['nickname']=$us['nickname'];
				$_SESSION['username']=$us['username'];
				$_SESSION['userid']=$us['userid'];
				$_SESSION['isboss']=$us['isboss'];
				$_SESSION['sclogin']=$us['sclogin'];
				$_SESSION['bdid']=$us['bdid'];
				$_SESSION['isbd']=$us['isbd'];
				$_SESSION['ispay']=$us['ispay'];
				$_SESSION['ulevel']=$us['ulevel'];
				$_SESSION['bdlevel']=$us['bdlevel'];
				$_SESSION['ppath']=$us['ppath'];
				$_SESSION['dzb']=$us['dianzibi'];
				$_SESSION['language']=$_POST['language'];//alert($_POST['language']);
				if ($us['id']==1){
					$_SESSION['bdname']=$us['nickname'];
				}else{
					if ($us['isbd']==2){
						$_SESSION['bdname']=$us['nickname'];
					}else{
						$_SESSION['bdname']=$us['bdname'];	
					}
				}
				$_SESSION['bclogin']=now();
				$member_update['sclogin']=now();
				edit_update_cl('member',$member_update,$us['id']);
				
				echo "<script language=javascript>window.location.href='member/index.php'</script>";
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

//导航条目
$information2=que_select_cl('information',2);
$information3=que_select_cl('information',3);
$information4=que_select_cl('information',4);
$information5=que_select_cl('information',5);	

?>

<!-- saved from url=(0033)http://www.cwtcoin.com/index.html -->
<html class="screen-desktop-wide device-desktop">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">    
    <title>欢迎登入-华星积分矿机管理中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="generator" content="editplus">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="member/css/style.css" type="text/css" rel="stylesheet">
    <link href="member/css/zui.lite.css" type="text/css" rel="stylesheet">

    <script language="javascript" type="text/javascript" src="member/js/jquery-2.0.3.min.js"></script>

    <script language="javascript" type="text/javascript" src="member/js/zui.min.js"></script>
	<script>
	function CheckForm(){
		username=document.form.username.value;
		password=document.form.password.value;
		login_yzm=document.form.login_yzm.value;
		if(username.length == 0){
			alert("请输入用户名.");			
			document.form.username.focus();
			return false;
		}
		if(password.length == 0){
			alert("请输入密码.");
			document.form.password.focus();
			return false;
		}
		if(login_yzm.length == 0){
			alert("请输入验证码.");
			document.form.login_yzm.focus();
			return false;
		}
	}
	</script>
    <script>
        $('#myModal').modal({
            keyboard: false,
            show: true
        })
        
        $('#myModal2').modal({
            keyboard: false,
            show: true
        })
        
        $('#myModal3').modal({
            keyboard: false,
            show: true
        })
        
        $('#myModal4').modal({
            keyboard: false,
            show: true
        })
        
        $('#myModal5').modal({
            keyboard: false,
            show: true
        })
    </script>

    <SCRIPT type="text/javascript">
    function changing(){
        document.getElementById('checkpic').src="checkcode.php?"+Math.random();
    } 
    </SCRIPT>
    
<!-- ---------------------------------------中英文切换start------------------------------------------------------------ -->
<!--      <script src="js/jquery-1.6.js" type="text/javascript"></script>  -->
    <script src="js/cookiesHelper.js" type="text/javascript"></script>
    <script src="js/dict.js" type="text/javascript"></script>
    <script type="text/javascript">
	  function language() {
		  //alert(getCookie("somoveLanguage"));
	      //根據cookie切換語言種類
	      if (getCookie("somoveLanguage") == "en") {
	          var result = setEnglish($("body").html());
	          $("body").html(result);
	       }
	  }
	  window.onload=language;//页面加载(刷新)时调用
    </script>  
 
    <script type="text/javascript">
        function chgLang() {
            SetCookie("somoveLanguage", $("#ddlSomoveLanguage").children('option:selected').val());
            //alert(getCookie("somoveLanguage"));
            location='login.php';//强制刷新页面
  			//delCookie("somoveLanguage");
        }

        function language(){
			var sb=document.getElementById("ddlSomoveLanguage").value;
			document.getElementById("language").value=sb;
        }
	</script>
<!-- ---------------------------------------中英文切换end------------------------------------------------------------ --> 
    
</head>
<body style="">
    <!--main-->
    <div class="container-fluid header">
        <div class="container">
            
            <div class="index_nav">
                <ul class="nav nav-secondary">
                    <li class="active"><a href="login.php">首 页</a></li>
<!--                     <li><a data-toggle="modal" href="index.php/#mySmModal2">运营中心</a></li> -->
                    <li><a data-toggle="modal" href="index.php/#mySmModal3">积 分 资 讯</a></li>
                    <li><a data-toggle="modal" href="index.php/#mySmModal4">天 行 积 分</a></li>
                    <li><a data-toggle="modal" href="index.php/#mySmModal5">新 手 指 南</a></li>
                </ul>
                <a class="login" data-toggle="modal" href="index.php/#mySmModal" onclick="language()">矿机登录</a>
                <select class="login2" id="ddlSomoveLanguage" onchange="return chgLang();">
	                <option value="ch" <?php if($_COOKIE['somoveLanguage']=="ch"){?>selected="selected" <?php }?>>中 文</option>
	                <!-- 
	                <option value="en" <?php if($_COOKIE['somoveLanguage']=="en"){?>selected="selected" <?php }?>>英 文</option>
	                 -->
	            </select>
            </div>
        </div>
        <div class="container">
            <div class="yinyan">
                <h4>
                    &nbsp;</h4>
                <h1>
                   <font color="#FFFF00">华星积分矿机管理中心</font></h1>
                <h4>
                    <br>
                    <br>
                    <br>
                   </h4>
            </div>
            <div class="clearfix">
            </div>
            <div class="conter" style="display: none;">
                <div class="youshi">
                    <dl class="col-md-6">
                        <dt><i class="icon-cogs"></i></dt>
                        <dd>
                            <h1>
                                前言</h1>
                            <p>
                                自2015年3月互助模式登陆中国以来，深受玩家青睐！<br>
                                但经过一年多的时间，随着市场上五花八门的项目频繁开网关网，很多问题也暴露出来，归根结底，我们对互助这种形式还是缺乏经验，难判断，只能任其发展。</p>
                        </dd>
                    </dl>
                    <dl class="col-md-6">
                        <dt><i class="icon-line-chart"></i></dt>
                        <dd>
                            <h1>
                                愿景</h1>
                            <p>
                                欢迎登入-华星积分矿机管理中心本着 “给予及舍得”这样一个理念、原理运转,从而打造一条我为人人，人人为我的全新金融生态链.参与必须为：自愿、博爱有梦想的人，欢迎登入-华星积分（中国）运营中心帮助有梦想的人们--梦想成真！<br>
                            </p>
                        </dd>
                    </dl>
                </div>
                <div class="csr">
                    <span class="col-md-6 csr_user">
                        <br>
                        <br>
                        <img src="member/image/Ken_Moelis.png"></span> <span class="col-md-6 csr_info">
                            <h1>
                                欢迎登入-华星积分矿机管理中心</h1>
                            <p>
                                Happy e raise money game</p>
                            <p class="DivH15">
                            </p>
                            <p>
                                自2015年3月互助模式登陆中国以来，深受玩家青睐！但经过一年多的时间，随着市场上五花八门的项目频繁开网关网，很多问题也暴露出来，归根结底，我们对互助这种形式还是缺乏经验，难判断，只能任其发展。<br>
                                2016年，经过一年多的洗礼，玩家们的心态和经验日趋成熟！其实互助项目不求高息回报，求的是一个稳字！只有稳才能长久，长久自然意收入丰厚！如何做到稳是很多互助项目想解决的！说到底就是2个字“控盘”。越严谨的控盘制度漏洞越少、泡沫越小，只有严格的控盘才能稳定长久！<br>
                                任何一个引领时代潮流的经济模式变革和伟大发明都是在旧的时代思想阻挠中诞生的！都是众口难调，要做到稳定长久并合理能让大家认可，我们经过长达半年的严谨思考不断改进测试，开创出我们的模式！我们撕掉了华丽的国际包装，摘掉面具、坦诚相见。只为让玩家可以通过互帮互助的形式改变人生，为自己家人创造更优越的生活。<br>
                                所以我们融合优势精华，摒弃不足，优化创新，尤其在控盘上做的非常合理严谨、到位。去伪存真，开心、放心、游戏中轻松理财是欢迎登入-华星积分（中国）运营中心唯一的诉求！我们开创属于我们的时代--欢迎登入-华星积分（中国）运营中心<br>
                                <br>
                            </p>
                            <p>
                                &nbsp;</p>
                            <p>
                                <br>
                            </p>
                        </span>
                </div>
                <div class="that_all">
                    <p>
                        That's all.</p>
                </div>
                <div class="footer">
                    <p>
                        Copyright ? 2016 华星积分 Inc.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mySmModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
                    <h2 class="modal-title">
                        矿机登录</h2>
                </div>
                <form class="form-horizontal" role="form" method="post" action="login.php" id="form" name="form" onSubmit="return CheckForm()">
                <INPUT type=hidden value=loginnow name=loginnow>
                <div class=" col-md-1">
                </div>
                <div class="clear DivH20">
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label required">
                        用 户 名：</label>
                    <div class="col-md-8">
                        <input type="text" name="username" id="username" value="" placeholder="" class="form-control">
                        <input type="hidden" name="language" id="language">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label required">
                        密  码：</label>
                    <div class="col-md-8">
                        <input type="password" name="password" id="password" value="" placeholder="" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label required">
                        验 证 码：</label>
                    <div class="col-md-5">
                        <input type="text" name="login_yzm" id="login_yzm" value="" placeholder="" class="form-control">
                    </div>
                    <label class="col-md-4 control-label" style="text-align: left;">
                        <div id="yzm" class="yzm">
                            <img id="checkpic" onclick="changing();" src='checkcode.php' />
                            <?php //echo $_SESSION["verification"];?>
                        </div>
                    </label>
                </div>
                <div class="modal-footer">
                    <a style="display: none;" href="wjmb.php" class="btn btn-default">忘记密码</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取 消</button>
                    <button type="submit" name="login_submit" class="btn btn-primary">
                        登 录</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="mySmModal2">
        <div class="modal-dialog">
            <div class="modal-content" style="overflow:scroll;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
                    <h2 class="modal-title">
                        运营中心</h2>
                </div>
				<div class="myaccound_list">
			     <table width="100%" border="0">
				  <tr>
				    <td valign="top" align="center"><strong>运营中心</strong><br><hr></td>
				  </tr>
				  <tr>
				    <td valign="top" ><?=$information2['introduced']?><p></p></td>
				  </tr>
				  <tr>
				    <td valign="top" ><hr></td>
				  </tr>
				</table>

		<div class="pager"></div>
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        返 回</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="mySmModal3">
        <div class="modal-dialog">
            <div class="modal-content" style="overflow:scroll;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
                    <h2 class="modal-title">
                        积分资讯</h2>
                </div>
				<div class="myaccound_list">
			     <table width="100%" border="0">
				  <tr>
				    <td valign="top" align="center"><strong>积分资讯</strong><br><hr></td>
				  </tr>
				  <tr>
				    <td valign="top" ><?=$information3['introduced']?><p></p></td>
				  </tr>
				  <tr>
				    <td valign="top" ><hr></td>
				  </tr>
				</table>

		<div class="pager"></div>
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        返 回</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="mySmModal4">
        <div class="modal-dialog">
            <div class="modal-content" style="overflow:scroll;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
                    <h2 class="modal-title">
                        华星积分</h2>
                </div>
				<div class="myaccound_list">
			     <table width="100%" border="0">
				  <tr>
				    <td valign="top" align="center"><strong>华星积分</strong><br><hr></td>
				  </tr>
				  <tr>
				    <td valign="top" ><?=$information4['introduced']?><p></p></td>
				  </tr>
				  <tr>
				    <td valign="top" ><hr></td>
				  </tr>
				</table>

		<div class="pager"></div>
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        返 回</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="mySmModal5">
        <div class="modal-dialog">
            <div class="modal-content" style="overflow:scroll;">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
                    <h2 class="modal-title">
                        新手指南</h2>
                </div>
				<div class="myaccound_list">
			     <table width="100%" border="0">
				  <tr>
				    <td valign="top" align="center"><strong>新手指南</strong><br><hr></td>
				  </tr>
				  <tr>
				    <td valign="top" ><?=$information5['introduced']?><p></p></td>
				  </tr>
				  <tr>
				    <td valign="top" ><hr></td>
				  </tr>
				</table>

		<div class="pager"></div>
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        返 回</button>
                </div>
            </div>
        </div>
    </div>


</body></html>