<!DOCTYPE html>
<?php
include_once("../function.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);
if ($_GET['id']!=NULL){
	$goods=que_select_cl('goods',$_GET['id']);
}

if ($_POST['button']){
	$num=$_POST['num'];
	//$shopingcart_arr=$_SESSION['shoppingcart'];
	$sql="SELECT * FROM `buycar` WHERE uid=".$goods['id']." and bid=".$member['id']."";
	if ($you=getOne($sql)){
		
		echo "<script language=javascript>alert('该商品已在您的购物车中.');window.location.href='?id=".$_GET['id']."'</script>";
		
	}else{
		$arr=array("uid"=>$goods['id'],"goodsname"=>$goods['goodsname'],"num"=>$num,"price"=>$goods['price'],"lx"=>$goods['lx'],"bid"=>$member['id'],"bnickname"=>$member['nickname']);
		
		//var_dump($arr);
		add_insert_cl('buycar',$arr);
		echo "<script language=javascript>alert('商品已加入购物车.');window.location.href='?id=".$_GET['id']."'</script>";
	}
	
}

if ($_POST['checkout']){
	echo "<script language=javascript>window.location.href='shoppingcheckout.php'</script>";	
}
?>
<!-- saved from url=(0047)http://hengxingbi.cn/index.php/Index/mine_index -->
<html lang="zh"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">

<link rel="stylesheet" href="css/style2.css">
<link rel="stylesheet" href="css/jquery.jqplot.min.css">

<link href="css/table.css" rel="stylesheet" type="text/css">
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
<SCRIPT LANGUAGE=javascript>
function SelectAll() {
	for (var i=0;i<document.form.UID.length;i++) {
		var e=document.form1.UID[i];
		e.checked=!e.checked;
	}
}
function jiage(numname,pic){
	var price=document.getElementById(pic).value
	var zong=numname.value*price;
	document.getElementById(pic+"zong").innerText=zong;
	zongjiage=0;
	for (var i=0;i<document.form.UID.length;i++) {
		var e=document.form.UID[i];
		if (e.checked==true){
			var jiage=document.getElementById(e.value).value;
			var shuangliang=document.getElementById(e.value+"num").value;
			zongjiage=zongjiage+jiage*shuangliang;
		}
	}
	document.getElementById("zongjiage").innerText=zongjiage;
}
function check(objName){ 
	 var o=document.getElementsByName(objName) 
	 for(i=0;i<o.length;i++)if(o[i].checked)return; 
	 alert("请选择一种商品");
	 } 

function zjiage(){
	zongjiage=0;
	for (var i=0;i<document.form.UID.length;i++) {
		var e=document.form.UID[i];
		if (e.checked==true){
			var jiage=document.getElementById(e.value).value;
			var shuangliang=document.getElementById(e.value+"num").value;
			zongjiage=zongjiage+jiage*shuangliang;
		}
	}
	document.getElementById("zongjiage").innerText=zongjiage;
}
</script>
</head>
<body>

<!--<script language="javascript" src="http://chat32.live800.com/live800/chatClient/monitor.js?jid=5174244489&companyID=668654&configID=93284&codeType=custom"></script>

<style>#gg{display:block;position:fixed;top:155px;right:65px;z-index:10000;width:80px;}

#gg span{width:25px;height:25px;display:block;position:absolute;top:0px;right:0px;}
</style>
<a id="gg" href="http://chat32.live800.com/live800/chatClient/chatbox.jsp?companyID=668654&configID=93285&jid=5174244489"><img id="ewm" src="/Public/images/111.png"/><span id="close" onclick="gghide();"></span></a>
-->
<?php include 'header_small.php';?>
<div id="beijing" >

	<!----------------------pop---------------------->
	<!----------------------pop---------------------->


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
<script type="text/javascript" src="./矿机购买_files/slideData.js"></script>
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
<!----------------------leftbar end----------------------> 

<!----------------------right----------------------> 
<div id="right">
         <!-----------titile------------>
    <div class="right_top">
      <div class="top_title welfare">购物商城</div>
    </div>
    <!-----------titile end------------>
    <div id="lend" class="right_box">
    	
        <div class="myaccound_list">
        	<div class="m_b_title_2">产品明细</div>
        	<div >
	
<form name="form" method="post" action="?id=<?=$goods['id']?>">
<table width="100%" border="0" >
  <tr>
    <td rowspan="9" align="center" valign="top" style="width:5cm; height:5cm;">
    <img src="../upload/<?=$goods['goodsimg']?>" style="width:5cm; height:5cm;" align="top"></td>
    <td align="center" valign="top">
      <h3><?=$goods['goodsname']?></h3></td>
    <td colspan="2" align="center" valign="top"><h3>库存：
      <?=$goods['kucun']?></h3></td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">
                                       商品类型：<? switch($goods['lx']){
        	                         case 1:echo "无极商城";break;
        	                         case 2:echo "积分商城";break;
        	                         case 3:echo "重消商品";break;
        	                      case 4:echo "二次购物商品";break;
                             }?>
                    <BR><BR>
    				价格：<?=$goods['price']?>
    	            <BR><BR>
      
      购买数量
      <input name="num" type="text" id="num" value="1" size="5" maxlength="5"   onKeyUp="numChange(this);">
      <!--  
      总计金额：
      <label name="zj" id="zj"><?=$goods['price']?>
      </td>
      -->
    </tr>
    
  <tr>
    <td colspan="3" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top"><input name="button" type="submit" class="button_green" id="button" value="加入购物车">    <input name="checkout" type="submit" class="button_green" id="checkout" value="去结算">      <input name="input" type="button" class="account_button_blue" value="返  回" onClick="history.back(-1)"></td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  
  <tr >
    <td colspan="10" valign="top"  ><h3 >产品介绍</h3><?=$goods['goodscontent']?></td>
  </tr>
  
  <tr>
    <td colspan="4" valign="top" ></td>
  </tr>
  <tr>
    <td colspan="4" align="center" >&nbsp;</td>
  </tr>
</table>
</form>			 		 
			 <div class="clearfix"></div>
			</div>
                <div class="line"></div>
        </div>
    </div>    
	 </div>
	 
    </div>

</div></div>
</body></html>