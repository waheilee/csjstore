<!DOCTYPE html>
<?php
include_once("../function.php");
include_once("../class/ulevel_class.php");
include_once("../class/member_class.php");
include_once("../class/system_class.php");
include_once("../class/email_class.php");

header("Content-Type: text/html;charset=utf-8");
$_member_cl=new member_class();

if($_POST['submit']){
    $sj=(int)date("H");
    $duanxin=$_POST['duanxin'];
    $bdname=$_POST['bdname'];
    $rname=$_POST['rname'];
    $uu=getOne("select id,nickname,recount from member where nickname='{$rname}'");
    //判断是否存在第一单
  //  $tui=getOne("select id,nickname,recount from member where rname='{$rname}' order by rdt desc limit 1");
  //  if(!$tui){
 //       $tui['id']=$uu['id'];
 //       $tui['nickname']=$uu['nickname'];//不存在就找推荐人
 //   }
 //   $meng=getOne("SELECT * FROM `member` WHERE fatherid=".$tui['id']." AND ispay>0");
 //   $treeplace=2;
 //   if($uu['recount']>0){
 //       $treeplace=1;
 //   }
    $username=$_POST['username'];
    $fathername=$_POST['rname'];

    $userid=$_POST['userid'];
    $nickname=$_POST['userid'];
    $password1=$_POST['password1'];
    $password2=$_POST['password2'];
    $passquestion=$_POST['passquestion'];
    $passanswer=$_POST['passanswer'];
    $usercard=$_POST['usercard'];
    $useraddress=$_POST['useraddress'];
    $bankname=$_POST['bankname'];
    $bankcard=$_POST['bankcard'];
    $bankusername=$_POST['bankusername'];
    $bankaddress=$_POST['bankaddress'];
    $useremail=$_POST['useremail'];
    $sex=$_POST['sex'];
    $zhifubao=$_POST['zhifubao'];
    $weixin=$_POST['weixin'];
    $usertel=$_POST['usertel'];

    $ulevel=$_POST['ulevel'];
    $sheng=$_POST['province'];
    $shi=$_POST['city'];
//    if($_POST['city']==null){
//        $shi=$_POST['province'];
//    }
    $xian=$_POST['area'];
    $_ulevel=new ulevel_class();
    $ulj=$_ulevel->getulevelbyulevel($ulevel);
    $lsk=$ulj['lsk'];   
    $dan=$ulj['dan'];   
    $zhuce=true;
    $sys=getsys();
    if($userid==null)
    {
        $zhuce=false;
        echo "<script language=javascript>alert('请填写会员编号.');window.location.href='register2.php?rname=".$rname."'</script>";
    }
    if($username==null)
    {
        $zhuce=false;
        echo "<script language=javascript>alert('请填写真实姓名.');window.location.href='register2.php?rname=".$rname."'</script>";
    }
    if($usertel==null)
    {
        $zhuce=false;
        echo "<script language=javascript>alert('请填写手机号.');window.location.href='register2.php?rname=".$rname."'</script>";
    }else {
//        if(preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,1,6,7,8]{1}\d{8}$|^18[\d]{9}$#',$usertel)){
//
//        }else{
////            $zhuce=false;
////            echo "<script language=javascript>alert('请填写正确的手机号.');window.location.href='register2.php?rname=".$rname."'</script>";
//        }
    }
      
    //    $date=date("Y-m-d");
        $sk=getOne("select count(*) from member where usertel='".$usertel."'");
        if ($sk['count(*)']>=$sys['ms']) {
            $zhuce=false;
            echo "<script language=javascript>alert('每个手机号只能注册".$sys['ms']."次.');window.location.href='register2.php?rname=".$rname."'</script>";
            
    }
    // if($usercard==null)
    // {
    //     $zhuce=false;
    //     echo "<script language=javascript>alert('请填写身份证号.');window.location.href='register2.php?rname=".$rname."'</script>";
    // }
    // if(preg_match('/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/',$usercard)){
    // }else {
    //     $zhuce=false;
    //     echo "<script language=javascript>alert('请输入正确的身份证号码.');window.location.href='register2.php?rname=".$rname."'</script>";

    // }
    if(checkUserID($userid) == true)
    {
        $zhuce=false;
        echo "<script language=javascript>alert('会员编号已存在,请刷新后再试.');window.location.href='register2.php?rname=".$rname."'</script>";
    }
    if(checkNickName($nickname) == true)
    {
        $zhuce=false;
        echo "<script language=javascript>alert('会员编号已存在,请更换后再试.');window.location.href='register2.php?rname=".$rname."'</script>";
    }
    // if(checkIsbd($bdname) == true){
    //     $zhuce=false;
    //     echo "<script language=javascript>alert('服务中心不存在,请检查后再试.');window.location.href='register2.php?rname=".$rname."'</script>";
    // }else{
    //     $array=getMemberbyNickName($bdname);
    //     $bdid=$array['id'];
    // }
    if(checkNickNamebyispay($rname) == false){
        $zhuce=false;
        echo "<script language=javascript>alert('推荐编号不存在,或尚未激活,请检查后再试.');window.location.href='register2.php?rname=".$rname."'</script>";
    }else{
        $array=getMemberbyNickName($rname);
        $reid=$array['id'];
        $recount=$array['recount'];
        $relevel=$array[relevel]+1;
        $repath="".$array[repath].$array[id].",";
    }
//    if(checkNickNamebyispay($fathername) == false){
//        $zhuce=false;
//        echo "<script language=javascript>alert('安置编号不存在,或尚未激活,请检查后再试.');window.location.href='register2.php?rname=".$rname."'</script>";
//    }else{
//        $array=getMemberbyNickName($fathername);
//        $FatherID=$array['id'];
//        $plevel=$array[plevel]+1;
//        $fplevel=$array[plevel];
//        $ppath="".$array[ppath].$array[id].",";
//    }

    //验证左右区
//     if($treeplace==2){
//         $sql = "SELECT * FROM `member` WHERE fatherid=".$FatherID." AND ispay>0";
//         $you=getOne($sql);
//         if($you['id']==null){

//             $zhuce=false;
//             echo "<script language=javascript>alert('安置人必须先激活左区,才能在右区注册.');window.location.href='register2.php?rname=".$rname."'</script>";
//         }
//     }
    $sql = "SELECT * FROM `member` WHERE id=$reid";
    $tj=getOne($sql);//推荐人信息
//     if(checkFatherMan($FatherID,$treeplace) == true){
//         $zhuce=false;
//         echo "<script language=javascript>alert('该位置已有会员注册,请更换区域再试.');window.location.href='register2.php?rname=".$rname."'</script>";
//     }
    if($zhuce){
        $member['userid']=$userid;
        $member['nickname']=$nickname;
        $member['password1']=md5($password1);
        $member['password2']=md5($password2);
        $member['pass1']=$password1;
        $member['pass2']=$password2;
        $member['passquestion']=$passquestion;
        $member['passanswer']=$passanswer;
        $member['username']=$username;
        $member['usercard']=$usercard;
        $member['usertel']=$usertel;
        $member['useraddress']=$useraddress;
        $member['bankname']=$bankname;
        $member['bankcard']=$bankcard;
        $member['bankusername']=$bankusername;
        $member['sheng']=$sheng;
        $member['shi']=$shi;
        $member['xian']=$xian;
        $member['bankaddress']=$bankaddress;
        $member['ulevel']=$ulevel;
        $member['lsk']=$lsk; 
        $member['dan']=$dan;
        $member['reid']=$reid;
        $member['rname']=$rname;
        $member['relevel']=$relevel;
        $member['repath']=$repath;
        $member['treeplace']=$treeplace;
        $member['fatherid']=$FatherID;
        $member['fathername']=$fathername;
        $member['plevel']=$plevel;
        $member['ppath']=$ppath;
        $member['bdid']=$bdid;
        $member['bdname']=$bdname;
        $member['useremail']=$useremail;
        $member['rdt']=now();
        $member['pv']=$sex;
        $member['zhifubao']=$zhifubao;
        $member['weixin']=$weixin;
        add_insert_cl('member',$member);
    /*  
        $new=getOne("select id from member where nickname='{$nickname}'");
        $FileID=date("ymdH").rand(100,999);//订单号
        $or['uid']=$new['id'];
        $or['userid']=$nickname;
        $or['ordersnumber']=$FileID;
        $or['useraddress']=$useraddress;
        $or['usertel']=$usertel;
        $or['username']=$username;
        $or['issend']=4;
        $or['lx']=9;
        $or['goodid']=$member['id'];
        $gg=getOne("select yl15 from ulevel where ulevel={$ulevel}");
        $or['goodname']=$gg;
        $or['price']=$lsk;

        $or['num']=1;
        $or['jine']=$lsk;
        $or['date']=now();
        add_insert_cl('orders2',$or);
      */  
      $url=$sys['url'];
        $nik=getMemberbyNickName($nickname);
        $isnews['uid']=$nik['id'];
        add_insert_cl('isnews',$isnews);
        //自动生成二维码
        //引入phpqrcode库文件
        include_once("phpqrcode.php");
        // 二维码数据
        $data = $url.'/web2/register2.php?rname='.$nik['nickname'];
        
        // 生成的文件名
        $filename = $nik['id'].'.png';
        // 纠错级别：L、M、Q、H
        $errorCorrectionLevel = 'L';
        // 点的大小：1到10
        $matrixPointSize = 3;
        //创建一个二维码文件
        QRcode::png($data,'../upload2/'.$nik['id'].'.png',$errorCorrectionLevel,$matrixPointSize,2);
        //输入二维码到浏览器
        //		QRcode::png($data);
        
        edit_sql("update member set erweima='".$nik['id'].".png' where id='".$nik['id']."'");
    }
    if($nik['lsk']==0){
        $_member_cl->jihuomember($nik['id']);
        $_member_cl->addbdrecord($nik,$array,$nik['lsk']);//激活记录
    }
}else{
    echo "<script language=javascript>alert('不可重复提交，返回首页.');window.location.href='index.php'</script>";
}
?>
<?php
include_once("../class/ulevel_class.php");
include_once("../class/system_class.php");
session_start();
$us=getMemberbyID($_SESSION['ID']);
$isbd=$us['isbd'];

if(isset($_SESSION['code_time'])){
    $time1=strtotime($_SESSION['code_time'])+180;
    $time2=time();
    if($time1<$time2){
        unset($_SESSION['code']);
        unset($_SESSION['code_time']);
    }

}
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>会员注册</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/register.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	<div class="logo">
        	<a href="#">
            	<img src="images/logo.png" alt=""/>会员注册
            </a>
        </div>
        <span class="return">
        	<a href="../index.php">
        		<img src="images/icon1.png" alt=""/>
        	</a>
        </span>
    
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
            <form action="" method="post">
                <div class="table3">
                    <table>
                        <tr>
                            <td><strong>会员编号</strong></td>
                        </tr>
                        <tr>
                            <td><?=$userid?></td>
                        </tr>
                        <tr>
                            <td><strong>真实姓名</strong></td>
                        </tr>
                        <tr>
                            <td><?=$username?></td>
                        </tr>
                        <tr>
                            <td><strong>推荐人编号</strong></td>
                        </tr>
                        <tr>
                            <td><?=$rname?></td>
                        </tr>
                         <!-- <tr>
                            <td><strong>服务中心</strong></td>
                        </tr>
                        <tr>
                            <td><?=$bdname?></td>
                        </tr>
                         <tr>
                            <td><strong>联系地址</strong></td>
                        </tr>
                        <tr>
                            <td><?=$sheng.$shi.$xian?></td>
                        </tr> -->
                     
                        <tr>
                            <td><strong>会员等级</strong></td>
                        </tr>
                        <tr>
                            <td><?=$ulj['lvname']?></td>
                        </tr>
                        <tr>
                            <td><strong>登录密码（默认：111111）</strong></td>
                        </tr>
                        <tr>
                            	<td><?=$password1?></td> 
                        </tr>
                        <tr>
                            <td><strong>确认登录密码（默认：111111）</strong></td>
                        </tr>
                        <tr>
                            	<td><?=$password1?></td> 
                        </tr>
                        <tr>
                            <td><strong>安全密码（默认：222222）</strong></td>
                        </tr>
                        <tr>
                            	<td><?=$password2?></td> 
                        </tr>
                        <tr>
                            <td><strong>确认安全密码（默认：222222）</strong></td>
                        </tr>
                        <tr>
                            	<td><?=$password2?></td> 
                        </tr>
                   <!--       <tr>
                        	<td><strong>收货地址</strong></td>
                        </tr>
                        <tr>
                        	 <td><?=$useraddress?></td>
                        </tr>-->
                    </table>
                    
                    <ul class="clearfix">
                    	<li>
                        	<input type="button" onclick="window.location.href='register.php?rname=<?=$rname?>';"  value="继续注册" />
                        </li>
                    	<li>
                            <a href="../copyindex.php?n=<?=$userid?>">前往登录</a>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
        
    
    </section><?php include 'footer.php';?>
</body>
</html>