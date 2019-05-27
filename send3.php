<?php
include("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");


$UserTel = $_POST['UserTel'];
$tos = $UserTel;
$sb = $_POST['sb'];
$code .= rand(100000,999999);
$content ='您本次的转账验证码为'.":$code";//内容

if($sb==1){
	$_SESSION['code']=$code;
	$_SESSION['code_time']=now();
}elseif($sb==2){
	$_SESSION['code2']=$code;
	$_SESSION['code_time2']=now();
}
//$rs=sendSMS($tos,$content);
//这个是HTTP接口(需要转为GB2312编码)
//function sendSMS($tos,$content){
	$url="http://service.winic.org:8009/sys_port/gateway/?";
	$data = "id=%s&pwd=%s&to=%s&content=%s&time=";
	$id = iconv('UTF-8','GB2312','3355');
	$pwd = '38572911';
	$to = $tos;
	
	$content = urlencode(iconv("UTF-8","GB2312",$content));
	$rdata = sprintf($data, $id, $pwd, $to, $content);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$rdata);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	//打印一下参数 可以看到 在GB2312编码模式的浏览器下 显示字符是正常的
	$result = curl_exec($ch);
	curl_close($ch);
	$result = substr($result,0,3);
	
// 	if($result=="000")
// 	{
// 		return 'true';
// 	}
// 	else
// 	{
// 		return 'false';
// 	}
//}
//echo sendSMS('13580305095',"this's\x0dTestMessage --- 这是一条用来检验编码的短信");


// $post_data = array();//创建数组
// $post_data['userid'] = '11809';
// $post_data['account'] = 'xiaoshuanggui';
// $post_data['password'] = 'xiaoshuanggui';
// $post_data['content'] = $content;//urlencode("$content") //短信内容需要用urlencode编码下
// $post_data['mobile'] = $UserTel;//'18396837963';
// $post_data['sendtime'] = ''; //不定时发送，值为0，定时发送，输入格式YYYYMMDDHHmmss的日期值
// $url='http://www.lcqxt.com/sms.aspx?action=send';
// $o='';
// foreach ($post_data as $k=>$v)
// {
// 	$o.="$k=".urlencode($v).'&';
// }
// $post_data=substr($o,0,-1);
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_HEADER, 0);
// curl_setopt($ch, CURLOPT_URL,$url);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
// //curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
// $result = curl_exec($ch);

?>
