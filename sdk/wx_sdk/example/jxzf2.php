<!DOCTYPE HTML>
<?php
include_once("../../../function.php");
include_once("../../../class/ulevel_class.php");
include_once("../../../class/system_class.php");
require_once "../lib/WxPay.Api.php";
require_once "WxPay.JsApiPay.php";
require_once "WxPay.Config.php";
require_once "notify.php";
require_once 'log.php';
//初始化日志
header("Content-Type: text/html;charset=utf-8");
session_start();
$sys= getOne("select * from systemparameters where id=1");
$yf=$sys['yunfei'];
$myf=$sys['myunfei'];
$member=getMemberbyID($_SESSION['ID']);
// $lx=$_GET['lx'];
//if($lx==null){
//    $lx=1;
//}
if(isset($_SESSION['code_time'])){
    $time1=strtotime($_SESSION['code_time'])+180;
    $time2=time();
    if($time1<$time2){
        unset($_SESSION['code']);
        unset($_SESSION['code_time']);
    }
}
//if($_POST['submit1']){
//    $dd= getOne("select * from orders where ordersnumber='{$_POST['number']}'");
//    if($dd['bid']==-1){
//        edit_sql("update orders set bid=0 where id={$dd['id']}");
//        echo "<script language=javascript>alert('支付成功！');window.location.href='../../../web2/order.php'</script>";
//    }else{
//        echo "<script language=javascript>alert('该订单已支付！');window.location.href='../../../web2/order.php'</script>";
//    }
//}
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
    
    try{

            $tools = new JsApiPay();
            $openId = $tools->GetOpenid();
            //②、统一下单
            $input = new WxPayUnifiedOrder();
            $input->SetBody($goodname);
            $input->SetOut_trade_no($FileID);
            $input->SetTotal_fee($zjine*100);
            $input->SetTime_start(date("YmdHis"),$mm['date']);
            $input->SetNotify_url("http://20190213.yldwf.com/sdk/wx_sdk/example/notify.php");
            // $input->SetNotify_url($sys['url']."/sdk/wx_sdk/example/notify.php");
            $input->SetTrade_type("JSAPI");
            $input->SetOpenid($openId);
            $config = new WxPayConfig();
            $order = WxPayApi::unifiedOrder($config,$input);
            
                      // var_dump($input);

            if($order['err_code_des']=="该订单已支付"){
                if($mm['issend']==-1){
                    edit_sql("update orders2 set issend=0 where ordersnumber='{$FileID}'");
                }
                echo "<script language=javascript>alert('该订单已支付.');</script>";
                header('Location:../../../web2/order.php');
            }        
            
            //echo "<script language=javascript>alert('正在唤起微信支付...');</script>";
//           echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
            $jsApiParameters = $tools->GetJsApiParameters($order);

            // var_dump($jsApiParameters);die;
            

            //获取共享收货地址js函数参数
            //$editAddress = $tools->GetEditAddressParameters();
    } catch(Exception $e) {
            Log::ERROR(json_encode($e));
    }
    
}
// else{
//     $mm= getOne("select * from orders2 where ordersnumber='{$_POST['number']}'");
//     if($mm['issend']>=0){
//         header('Location:../../../web2/order.php');
//     }
//  }

?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>订单支付</title>
<link rel='icon' href='../../../assets/img/logo.ico' type="image/x-ico"/> 
<link rel="stylesheet" href="../../../web/css/common.css">
<link rel="stylesheet" href="../../../web/css/my.css">
<script src="../../../web/js/common.js"></script>
<script src="../../../web/js/jquery.js"></script>
<style>
#main .myBox .box4 li {
        border-bottom:1px solid #ffffff;
        
}
#main .myBox .box4 li input{
        border:0px;
}
#main .myBox .box2 input {
	float:right;
	width:12rem;
	font-size:0.8rem;
	height:3rem;
	border:none
}
</style>
<style type="text/css">
	.citys{
		margin-bottom: 10px;
	}
	.citys p{
		line-height: 28px;
	}
	.warning{
		color: #c00;
	}
	.main a{
		margin-right: 8px;
		color: #369;
	}
</style>
<!--<script language="javascript">


function CheckForm(){
    zf=document.form.zf.value;//
    if(zf == -1){
        alert("温馨提示:\n请选择支付方式.");
        document.form.zf.focus();
        return false;
    }
    return true;
}

    </script>-->
      
<!--  <script>
//用jquery实现
     function showResult(str){
       $.ajax({
         type: "POST",
         url : "php.php",
         datatype : 'json',
         data: {'q':str} ,
         success :function (data) {
//           document.getElementById("rusername").innerHTML=data;
           document.getElementById("rusername").value=data;
         }
       })
     }
  </script>-->
<script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{

		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
            // alert(1111);
			function(res){

				WeixinJSBridge.log(res.err_msg);
                                //alert(res.err_code+res.err_desc+res.err_msg);
				//alert(res.err_msg);
                //  var_dump(55555566);
                // alert("xxxx");
                                if(res.err_msg == "get_brand_wcpay_request:ok"){
                                    zfzt(1,<?=$mm['id']?>);
                                    alert("支付成功");
                                    window.location.href="<?=$sys['url']?>/web2/order.php";
                                 //alert(<?=$mm['id']?>);
                                    
                                //alert(res.err_code+res.err_desc+res.err_msg);
                                   
                                }else{
                                    //返回跳转到订单页面
                                    //alert(000);
                                    zfzt(-1,<?=$mm['id']?>);
                                    window.location.href="<?=$sys['url']?>/web2/order.php";
                                    //alert("支付失败");
                                    //alert(<?=$mm['id']?>);
                                    // alert("456");
                                    

                                }
			}
                                
		);
        // die;
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
<!--	<script type="text/javascript">
	//获取共享地址
	function editAddress()
	{
		WeixinJSBridge.invoke(
			'editAddress',
			<?php echo $editAddress; ?>,
//			function(res){
//				var value1 = res.proviceFirstStageName;
//				var value2 = res.addressCitySecondStageName;
//				var value3 = res.addressCountiesThirdStageName;
//				var value4 = res.addressDetailInfo;
//				var tel = res.telNumber;
////				alert(12345);
////				alert(value1 + value2 + value3 + value4 + ":" + tel);
//			}
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
	
	</script>-->
</head>
<body style=" background-color: #ffffff;">
<div id="container">
	<header id="gHeader">
            <a href="../../../web2/order.php" class="icon1"><img src="../../../web/img/jt1.png" alt=""/></a>
        <h2>订单支付</h2>
    </header>
	<div id="main" style="padding-top:2.5rem">
    	<div class="myBox">
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
<!--                                <option value="-1">选择支付方式</option>-->
                                <!-- <?php if($lx==1){?> -->
                                <option value="1">微信支付</option>
                                <!-- <?php } ?> -->
                                <!-- <?php if($lx==3){?><option value="2">电子货币 余额：<?=$member['cfxf']?></option><?php } ?> -->
                                
                             </select>
                            </li>
                        <li>
                            
                            <label>本次支付：<?=$zjine?>元</label>
                                
                        </li>

                        <li>
                        	<label>付款状态:</label>
                            <input type="text" readonly name="zfzt" id="zfzt" value="待支付"/>
                        </li>
                            <input type="submit" name="pay" value="继续付款"  class="tj0" onclick="callpay()"/>
                    </ul>
            </form>
        </div>	
    </div>

</div>

	

</body>
</html>