<?php
include("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");

$UserTel = $_POST['UserTel'];
$sb = $_POST['sb'];
$code .= rand(100000,999999);
$content = '【TSC】您本次的验证码为'.":$code";//内容
if($sb==1){
	$_SESSION['code']=$code;
	$_SESSION['code_time']=now();
}elseif($sb==2){
	$_SESSION['code2']=$code;
	$_SESSION['code_time2']=now();
}


$post_data = array();//创建数组
$post_data['userid'] = '11809';
$post_data['account'] = 'xiaoshuanggui';
$post_data['password'] = 'xiaoshuanggui';
$post_data['content'] = $content;//urlencode("$content") //短信内容需要用urlencode编码下
$post_data['mobile'] = $UserTel;//'18396837963';
$post_data['sendtime'] = ''; //不定时发送，值为0，定时发送，输入格式YYYYMMDDHHmmss的日期值
$url='http://www.lcqxt.com/sms.aspx?action=send';
$o='';
foreach ($post_data as $k=>$v)
{
	$o.="$k=".urlencode($v).'&';
}
$post_data=substr($o,0,-1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果需要将结果直接返回到变量里，那加上这句。
$result = curl_exec($ch);

?>
