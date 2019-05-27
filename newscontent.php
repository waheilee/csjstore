<!DOCTYPE html>
<?php
include_once("../function.php");
session_start();
if ($_GET['nid']!=NULL){
	$news=que_select_cl('news',$_GET['nid']);
}
?>
<!-- saved from url=(0044)http://hengxingbi.cn/index.php/Index/finance -->
<html lang="zh"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">

<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/style2.css">
<link rel="stylesheet" href="css/jquery.jqplot.min.css">
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="images/excanvas.js"></script><![endif]-->
<script src="js/jquery-1.9.1.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.jqplot.min.js"></script> 
<script class="include" type="text/javascript" src="js/jqplot.dateAxisRenderer.min.js"></script>
<script class="include" type="text/javascript" src="js/jqplot.cursor.min.js"></script>
<script class="include" type="text/javascript" src="js/jqplot.highlighter.min.js"></script>
<!-- ---------------------------------------中英文切换start------------------------------------------------------------ -->
<!--      <script src="../js/jquery-1.6.js" type="text/javascript"></script>  -->
    <script src="../js/cookiesHelper.js" type="text/javascript"></script>
    <script src="../js/dict.js" type="text/javascript"></script>
    <script type="text/javascript">
	  function sb() {
	      //根據cookie切換語言種類
	      var language=<?php if($_SESSION['language']=='en'){echo '"en"';}else{echo '"ch"';}?>;
	      //alert(language);
	      if (language == "en") {
	          var result = setEnglish($("body").html());
	          $("body").html(result);
	       }
	  }
	  window.onload=sb;//页面加载(刷新)时调用
    </script>  
<!-- ---------------------------------------中英文切换end------------------------------------------------------------ --> 
<title>会员管理系统</title>
</head>
<body>

<!--<script language="javascript" src="http://chat32.live800.com/live800/chatClient/monitor.js?jid=5174244489&companyID=668654&configID=93284&codeType=custom"></script>

<style>#gg{display:block;position:fixed;top:155px;right:65px;z-index:10000;width:80px;}

#gg span{width:25px;height:25px;display:block;position:absolute;top:0px;right:0px;}
</style>
<a id="gg" href="http://chat32.live800.com/live800/chatClient/chatbox.jsp?companyID=668654&configID=93285&jid=5174244489"><img id="ewm" src="/Public/images/111.png"/><span id="close" onclick="gghide();"></span></a>
-->

<!----------------------header_small---------------------->
<?php include 'header_small.php';?>
<!----------------------header_small end---------------------->
<div id="beijing" >
<!----------------------account_top---------------------->
<?php include 'account_top.php';?>
<!----------------------account_top end---------------------->


<div class="mycontainer mtb30" style="overflow: hidden"><!-- nav -->
<style>
.tab_bg{ position:relative; width:674px; height:48px;}
.tab_bg img{ position:absolute; left:0; top:24px;height:0px; display:none; width:674px; }
.overdiv{position:fixed; display:none;  z-index:10; left:0; top:0; width:100%; height:100%; background:#000;-moz-opacity:0.4;-webkit-opacity:0.4; filter:alpha(opacity=40); opacity:0.4;  z-index:998;}
.dialogbox{ display:none; width:0px; height:0px; position:fixed; left:50%; top:50%; margin-left:0px; margin-top:0px; z-index:999; line-height:40px; color:#fff; text-align:center; font-size:24px;}
.dialogbox img{ width:100%; height:100%;}
.ad{position:absolute; left:50%; top:50%; margin-left:-490px; margin-top:-265px;}
.dialogbox a{background:url(Public/images/newYear/dialog_closebtn.png) no-repeat; height:36px; width:35px; position:absolute; top:15px; right:15px; z-index:1000;}
.detailLong{ position:relative; overflow:visible;}
.detailLong div{ position:absolute; left:-45px; top:0px; width:150px;}
</style>

<div class="path_account"><!-- 您的位置: <a href="/">首页</a> > <a href="/Account">我的账户</a> --></div>

<!-- nav end-->
<script type="text/javascript" src="./财务明细_files/slideData.js"></script>
<div class="mycontainer" style="overflow: hidden">
	<!---------------轮播广告------------------> 
	<?php include 'pop_1.php';?>
	<!---------------轮播广告------------------> 
	<script>
	$(function(){
		var activity_vip = [{"id":"{}29","cb_title":"公告"},{"id":"{}28","cb_title":"关于规范交易通报"},{"id":"{}27","cb_title":"交易平台公告"},{"id":"{}26","cb_title":"重大通知"},{"id":"{}25","cb_title":"封号处理公告"},{"id":"{}24","cb_title":"争议订单处理公告"},{"id":"{}23","cb_title":"信息修改截止公告"},{"id":"{}22","cb_title":" 关于系统公告"},{"id":"{}21","cb_title":" 交易平台更新公告"},{"id":"{}20","cb_title":"致歉书"},{"id":"{}19","cb_title":"520恒星控股送豪车！！！"},{"id":"{}18","cb_title":"大盘交易平台更新公告"},{"id":"{}17","cb_title":"关于交易规则修改的公告"},{"id":"{}16","cb_title":"关于短信验证码通知"},{"id":"{}15","cb_title":"关于平台交易启用短信验证码公告"},{"id":"{}14","cb_title":" 通告"},{"id":"{}13","cb_title":"恶意注册账号查封公告"},{"id":"{}12","cb_title":"交易提示"},{"id":"{}11","cb_title":"活动内容更正公告"},{"id":"{}10","cb_title":"市场喜讯"},{"id":"{}9","cb_title":" 紧急申明"},{"id":"{}8","cb_title":"关于激活码公告"},{"id":"{}7","cb_title":"市场启示"},{"id":"{}6","cb_title":" 赠送矿机即将结束声明"},{"id":"{}5","cb_title":" 推广链接变更公告"},{"id":"{}4","cb_title":"关于会员升级公告"},{"id":"{}3","cb_title":"紧急通知"},{"id":"{}2","cb_title":"通知"},{"id":"{}1","cb_title":"喜报"},];
		if(activity_vip.length>0){
			$("#pop_1").show();
			var data = new Array(); 
			$.each(activity_vip,function(key,value){
			    value.id=value.id.substr(2);
				data.push("<a href='/index.php/Index/radio/id/"+value.id+"'>"+value.cb_title+"</a>");
			});
			$("#pop_dataSlide").slideData({
				"dataline":1,//显示条数
				"slideTime":2,//几秒刷新
				"data": data// 数据
			});
		}
		})
	function closePop(){
		$("#pop_1").remove();
		}
</script>	
<!----------------------leftbar---------------------->
	<?php include 'leftbar.php';?>
<!----------------------leftbar end----------------------> 

<!----------------------right----------------------> 
<div id="right">
	<!-----------titile------------> 
	<div class="right_top">
    	<div class="top_title bandspokesman">平台公告
    		<div class="myaccound_banner"></div>
    	</div>
              
    </div>
    <!-----------titile end------------> 
	<div id="lostlendbids">
    <div class="right_box">
      
<table width="100%" border="0">
  <tr>
    <td valign="top" align="center"><strong><?=$news['newstitle']?></strong><br><hr></td>
  </tr>
  <tr>
    <td valign="top" ><?=$news['newscontent']?><p></p></td>
  </tr>
  <tr>
    <td valign="top" ><hr></td>
  </tr>
  <tr>
    <td align="center" > <input name="" type="button" class="button_blue" value="返  回" onClick="history.back(-1)"></td>
  </tr>
 
</table>
		<div class="pager"></div>
        </div>
    <!-----------box end------------>  
</div>
</div>
</div>

</div></div>
</body></html>