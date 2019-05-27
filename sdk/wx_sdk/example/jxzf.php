<?php 
/**
*
* example目录下为简单的支付样例，仅能用于搭建快速体验微信支付使用
* 样例的作用仅限于指导如何使用sdk，在安全上面仅做了简单处理， 复制使用样例代码时请慎重
* 请勿直接直接使用样例对外提供服务
* 
**/
include_once ("../../../function.php");
include_once ("../../../class/ulevel_class.php");
include_once ("../../../class/system_class.php");
require_once ("../lib/WxPay.Api.php");
require_once "WxPay.JsApiPay.php";
require_once "WxPay.Config.php";
require_once 'log.php';
header("Content-Type: text/html;charset=utf-8");
session_start();
$sys= getOne("select * from systemparameters where id=1");
$yf=$sys['yunfei'];
$myf=$sys['myunfei'];
$member=getMemberbyID($_SESSION['ID']);
if(isset($_SESSION['code_time'])){
    $time1=strtotime($_SESSION['code_time'])+180;
    $time2=time();
    if($time1<$time2){
        unset($_SESSION['code']);
        unset($_SESSION['code_time']);
    }
}
//初始化日志
if($_GET['jxzf']){

    $logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
    $log = Log::Init($logHandler, 15);
    
    //打印输出数组信息
    function printf_info($data)
    {
        foreach($data as $key=>$value){
            echo "<font color='#00ff55;'>$key</font> :  ".htmlspecialchars($value, ENT_QUOTES)." <br/>";
        }
    }
    $mm= getOne("select * from orders2 where id='{$_GET['jxzf']}'");
    if($mm['issend']>=0){
        echo "订单已支付！";
        header('Location:../../../web2/order.php');
    }
    $r= getMemberbyID($mm['uid']);
    $lx=$mm['lx'];
    $rname=$r['nickname'];
    $rusername=$r['username'];
    $zjine=$mm['jine'];
    $goodname=$mm['goodname'];
    $FileID=$mm['ordersnumber'];
    //①、获取用户openid
    try{
    
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();
    
        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody($goodname);
        $input->SetOut_trade_no($FileID);
        $input->SetTotal_fee($zjine*100);
        $input->SetTime_start(date("YmdHis"),$mm['date']);
        $input->SetNotify_url("http://www.lmygf.com/sdk/wx_sdk/example/notify.php");
        // $input->SetNotify_url($sys['url']."/sdk/wx_sdk/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $config = new WxPayConfig();
        $order = WxPayApi::unifiedOrder($config, $input);
        // echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
        // printf_info($order);
        $jsApiParameters = $tools->GetJsApiParameters($order);
    
        //获取共享收货地址js函数参数
        $editAddress = $tools->GetEditAddressParameters();
    } catch(Exception $e) {
        Log::ERROR(json_encode($e));
    }
}
//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>订单支付</title>
	<script src="../../../web2/js/common.js"></script>
	<script src="../../../web2/js/jquery.js"></script>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				if(res.err_msg == "get_brand_wcpay_request:ok"){
					// zfzt(1,<?=$mm['id']?>);
					alert("支付成功");
					window.location.href="<?=$sys['url']?>/web2/order.php";
				}else{
					//返回跳转到订单页面
					// zfzt(-1,<?=$mm['id']?>);
					alert("支付失败");

					window.location.href="<?=$sys['url']?>/web2/order.php";
				}
				// alert(res.err_code+res.err_desc+res.err_msg);
			}
		);
	}
	function zfzt(zf,zid){
            $.ajax({
              type: "POST",
              url : "php.php",
              datatype : 'json',
              data: {'zf':zf,'zid':zid},
              success :function (data) {
     //           document.getElementById("rusername").innerHTML=data;
                document.getElementById("zfzt").value=data;
                //document.getElementById("pay").value="返回";
              }
            });
        }
	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
	<!-- <script type="text/javascript">
	//获取共享地址
	function editAddress()
	{
		WeixinJSBridge.invoke(
			'editAddress', -->
			<!-- <?php echo $editAddress; ?>, -->
			<!-- function(res){
				var value1 = res.proviceFirstStageName;
				var value2 = res.addressCitySecondStageName;
				var value3 = res.addressCountiesThirdStageName;
				var value4 = res.addressDetailInfo;
				var tel = res.telNumber;
				
				alert(value1 + value2 + value3 + value4 + ":" + tel);
			}
		);
	}
	
	window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', editAddress, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', editAddress); 
		        document.attachEvent('onWeixinJSBridgeReady', editAddress);
		    }
		}else{
			editAddress();
		}
	};
	
	</script> -->
</head>
<body>
<header id="gHeader">
        <a href="../../../web2/order.php" class="icon1"><img src="../../../web/img/jt1.png" alt=""/></a>
        <h2>订单支付</h2>
</header>
		<form id="form" name="form" action="?jxzf=<?=$mm['id']?>" method="post" onSubmit="return CheckForm();">

			<?php
				$sql="SELECT id,isbd,bdname,nickname FROM member where nickname='".$_SESSION['nickname']."'";
				$uss = getOne($sql);
				if($_GET['rn']!=null){$rname=$_GET['rn'];}else {$rname=$uss['nickname'];}
			?>
			
			<ul class="box4 box1">
				<p style="visibility: hidden;"><input type="password" id="0"  disabled style="display:none"/></p>
				<p style="visibility: hidden;"><input type="text" id="0"  disabled style="display:none"/></p>
				<li>
					<label>订单号：</label>
					<?=$FileID?>
					<input hidden type="text" name="number" value="<?=$FileID?>">
				</li>
				<li>
					<label>订购人编号：</label>
					<?=$rname?>
				</li>
				<li>
					<label>订购人姓名：</label>
					<?=$rusername?>
				</li>
				<br>
				<br>
					<br>
				<li>
					<label>支付总金额：</label>
						<?=$zjine?>元
				</li>

				<li>
					<label>支付方式：</label>
					<select id="zf" name="zf" >                      
						<option value="1">微信支付</option>
					</select>
					</li>
				<li>
					
					<label>本次支付：<?=$zjine?>元</label>
						
				</li>

				<li>
					<label>付款状态:</label>
					<input type="text" readonly name="zfzt" id="zfzt" value="待支付"/>
				</li>
					<!-- <input type="submit" name="pay" value="继续付款"  class="tj0" onclick="callpay()"/> -->
			</ul>
	</form>
    <br/>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px"><?=$zjine?></span></b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
	</div>
</body>
</html>