<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('PRC');
header("Content-Type: text/html;charset=utf-8");
include_once("../function.php");
include_once("../bonus.php");
include_once("../class/system_class.php");

$manager_id = $_GET['Manager_ID'];
if($manager_id != null){
    if($_SESSION['to_admin'] == null){
        alert("请勿非法操作!!!");
        return ;
    }
    if(checkID($manager_id)){alert("请勿非法操作!!!");return ;}
    $us=getMemberbyID($manager_id);
    $_SESSION['ID']=$us['id'];
    $_SESSION['nickname']=$us['nickname'];
    $_SESSION['username']=$us['username'];
    $_SESSION['userid']=$us['userid'];
    $_SESSION['isboss']=$us['isboss'];
    $_SESSION['sclogin']=$us['sclogin'];
    $_SESSION['bdid']=$us['bdid'];
    $_SESSION['isbd']=$us['isbd'];
    $_SESSION['bdlevel']=$us['bdlevel'];
}
$sys=getOne("select * from systemparameters where id=1");
$url=$sys['url'];
$information=que_select_cl('information',1);
$_system=new system_class();
$member = getMemberbyID($_SESSION['ID']);

//var_dump($_SESSION['ID']);
$ul = ulevel($member['ulevel']);
$zjul = zjulevel($member['zjulevel']);
if ($zjul==null){
    $zjname='无';
}else {
    $zjname=$zjul['zjname'];
}
$all=getall("select id from member where reid={$member['id']} and ispay>0 and islock=0");//会员资料
$nk=count($all);

//获取当前ip
$us=getMemberbyID($_SESSION['ID']);
function ip(){
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {  
		$ip = getenv('HTTP_CLIENT_IP');
	 } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {  $ip = getenv('HTTP_X_FORWARDED_FOR');
	  } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {  $ip = getenv('REMOTE_ADDR'); 
	  } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {  $ip = $_SERVER['REMOTE_ADDR']; 
	  } return preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : 'unknown';}
	  $ip=ip();
	  $us_update['ip']=$ip;
	  edit_update_cl('member',$us_update,$us['id']);
//	  $nik=getMemberbyNickName($us['nickname']);
//	  //自动生成二维码
//	  //引入phpqrcode库文件
//	  include_once("phpqrcode.php");
//	  // 二维码数据
//	  $data = $url.'/web2/register3.php?rname='.$nik['nickname'];
//	  
//	  // 生成的文件名
//	  $filename = $nik['id'].'.png';
//	  // 纠错级别：L、M、Q、H
//	  $errorCorrectionLevel = 'L';
//	  // 点的大小：1到10
//	  $matrixPointSize = 3;
//	  //创建一个二维码文件
//	  QRcode::png($data,'../upload2/'.$nik['id'].'.png',$errorCorrectionLevel,$matrixPointSize,2);
//	  //输入二维码到浏览器
//	  //		QRcode::png($data);
//	  
//	  edit_sql("update member set erweima='".$nik['id'].".png' where id='".$nik['id']."'");
	  ?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>消息详情</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/show.css">
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
            
            <div class="table2">
                
            </div>
          <div style="text-align:center" class="table3">
            	<h2>我的推广二维码</h2>
            	<?php
//if($us['erweima']!=null){
//    $nik=getMemberbyNickName($us['nickname']);
//            //自动生成二维码
//            //引入phpqrcode库文件
//            include_once("phpqrcode.php");
//            // 二维码数据
//            $data = $url.'/web2/register.php?rname='.$us['nickname'].'';
//            
//            // 生成的文件名
//            $filename = $nik['id'].'.png';
//            // 纠错级别：L、M、Q、H
//            $errorCorrectionLevel = 'L';
//            // 点的大小：1到10
//            $matrixPointSize = 3;
//            //创建一个二维码文件
//            QRcode::png($data,'../upload2/'.$nik['id'].'.png',$errorCorrectionLevel,$matrixPointSize,2);
//            //输入二维码到浏览器
//            //		QRcode::png($data);
//            
//            edit_sql("update member set erweima='".$nik['id'].".png' where id='".$nik['id']."'");
//            }
            ?>
                <div class="box">
                	<img src="../upload2/<?=$us['erweima']?>" width="100px">
                </div>
            </div> 
        </div>
    <br/><br/><br/><br/><br/>
    </section>
    <?php include 'footer.php';?>
    
</body>
</html>