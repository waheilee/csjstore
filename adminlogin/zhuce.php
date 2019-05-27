<!DOCTYPE HTML>
<?php
include_once("../function.php");
include_once("../class/ulevel_class.php");
include_once("../class/member_class.php");
include_once("../class/system_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
$sys= getOne("select * from systemparameters where id=1");
$_member=new member_class();
if($_POST['submit']){
        $sj=(int)date("H");
        //if ($sj>=8 && $sj<24){
        $duanxin=$_POST['duanxin'];
        $bdname=$_POST['bdname'];

        $rname=$_POST['rname'];
        $username=$_POST['username'];
        $fathername=$_POST['fathername'];
        $treeplace=$_POST['tid'];
        
        $userid=$_POST['userid'];
        $nickname=$userid;
        $password1=$_POST['password1'];
        $password2=$_POST['password2'];
        $passquestion=$_POST['passquestion'];
        $passanswer=$_POST['passanswer'];
        $usercard=$_POST['usercard'];

        $usertel=$_POST['usertel'];
        $useraddress=$_POST['useraddress'];
        //$userqq=$_POST['userqq'];
        $bankname=$_POST['bankname'];
        $bankcard=$_POST['bankcard'];
        $bankusername=$_POST['bankusername'];
        $bankaddress=$_POST['bankaddress'];
        $useremail=$_POST['useremail'];
        $sex=$_POST['sex'];

        //$xueli=$_POST['xueli'];
        $zhifubao=$_POST['zhifubao'];
        //$caifutong=$_POST['caifutong'];
        $weixin=$_POST['weixin'];
        //$lsk=$_POST['lsk'];
        $ulevel=$_POST['ulevel'];
        //$ulevel=lsk($lsk);
        $_ulevel=new ulevel_class();
        $ul=$_ulevel->getulevelbyulevel($ulevel);
        $lsk=$ul['lsk'];
        //$lsk=0;
        //$dan=$ul['yl1'];
        //$sheng=$_POST['prov'];
        // $shi=$_POST['city'];
        //$xian=$_POST['area'];

         $zhuce=true;
//        $sys=getsys();

//        $_SESSION['shoppingcart']=NULL;
//        $cheuid_arr = $_POST['UID'];
//        $sum = 0;
//        foreach ((array)$cheuid_arr as $id){
//            $goods=que_select_cl('goods',$id);
//            $num=$_POST[$goods['id']."num"];
//            if(is_numeric($num) && $num>0){
//                $sum += $goods['price']*$num;
//            }
//        }
      
//        if($sum != $lsk){
//            $zhuce=false;
//            echo "<script language=javascript>alert('套餐总价不符合注册价格.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//        }

//        $gwb = 0;
//        foreach ((array)$cheuid_arr as $id){
//            $goods=que_select_cl('goods',$id);
//            $num=$_POST[$goods['id']."num"];
//            if(is_numeric($num) && $num>0){
//                $arr=array("id"=>$goods['id'],"goodsname"=>$goods['goodsname'],"num"=>$num,"price"=>$goods['price'],"lx"=>$goods['lx'] );
//                $shopingcart_arr[$goods['id']]=$arr;
//                $_SESSION['shoppingcart']=$shopingcart_arr;
//                $gwb=$gwb+$goods['price']*$num;
//            }
//        v

//      var_dump($lsk%100);break;
//     if ($lsk<100){
//                
//                 $zhuce=false;
//                 echo "<script language=javascript>alert('最低注册金额为100.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//     }
//     $lsk1=(int)(floor(($lsk/100))*100);
//     
//     if($lsk!=$lsk1)
//     {
//         $zhuce=false;
//         echo "<script language=javascript>alert('注册金额为100的倍数.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//     }
//     if( $sheng==-1 || $username==-1 || $usercard==-1)
//     {
//         $zhuce=false;
//         echo "<script language=javascript>alert('请填写省市县.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//     }

//     if( empty($usertel) ||empty($username) || empty($usercard))
//     {
//         $zhuce=false;
//         echo "<script language=javascript>alert('资料不完整,请刷新后再试.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//     }
        //短信验证
//         if ($sys['zzkg']==1){

//             if($duanxin!=$_SESSION['code'] || empty($_SESSION['code'])){
//                 $zhuce=false;
//                 echo "<script language=javascript>alert('验证码错误,请刷新后再试.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//             }

//             /* if(checkPhone($usertel) == false )
//             {
//                 $zhuce=false;
//                 echo "<script language=javascript>alert('同一个手机号最多只能注册1个,请刷新后再试.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//             } */
//         }

//        if($userid==null)
//        {
//            $zhuce=false;
//            echo "<script language=javascript>alert('请填写会员编号.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//        }
         if(checkNickNamebyispay($rname) == false){
            $zhuce=false;
            echo "<script language=javascript>alert('推荐编号不存在,或尚未激活,请检查后再试.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
        }else{
            $array=getMemberbyNickName($rname);
//            if ($array['islock']==1 || ($array['ulevel']>1 && $array['f']==0)){
//                $zhuce=false;
//                echo "<script language=javascript>alert('推荐编号已失效,请检查后再试.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//            }
            $reid=$array['id'];
            $recount=$array['recount'];
            $relevel=$array[relevel]+1;
            $repath="".$array[repath].$array[id].",";
        }
        if($username==null)
        {
            $zhuce=false;
            echo "<script language=javascript>alert('请填写会员姓名.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
        }
        if($usertel==null)
        {
            $zhuce=false;
            echo "<script language=javascript>alert('请填写手机号码.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
        }else {
//             if(preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,1,6,7,8]{1}\d{8}$|^18[\d]{9}$#',$usertel)){
                 
//             }else{
//                 $zhuce=false;
//                 echo "<script language=javascript>alert('请填写正确的手机号.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//             }
        }
//        if($usercard==null){
//        
// 			$zhuce=false;
// 			echo "<script language=javascript>alert('请输入身份证号.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
// 			
//        }
//        else {
//            
////             if(preg_match('/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/',$usercard)){
////             }else {
////                 $zhuce=false;
////                 echo "<script language=javascript>alert('请输入正确的身份证号码.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//                
////             }
//            $sys=getOne("select * from systemparameters where id=1");
//            $date=date("Y-m-d");
// 			$sk=getOne("select count(*) from member where usercard='".$usercard."' and date_format(rdt,'%Y-%m')=date_format('{$date}','%Y-%m')");
// 			if ($sk['count(*)']>=$sys['cardnum']) {
// 			    $zhuce=false;
// 			    echo "<script language=javascript>alert('每月每个身份证只能注册".$sys['cardnum']."次.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
// 			    
// 			}
//        }
//        $sk=getOne("select count(*) from member where usercard='".$usercard."'");
//        if ($sk['count(*)']>0) {
//            $zhuce=false;
//            echo "<script language=javascript>alert('已注册成功并处于使用期的身份证不可重复申请会员.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//
//        }
//        $date=date("Y-m-d");
//        $dj=getOne("select count(*) from dongjie where usercard='".$usercard."' and zdate>'$date'");
//        if ($dj['count(*)']>0) {
//            $zhuce=false;
//            echo "<script language=javascript>alert('此身份证号已被限制注册.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//
//        }
        if(checkNickName($nickname) == true)
        {
            $zhuce=false;
            echo "<script language=javascript>alert('会员编号已存在,请更换后再试.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
        }
        
//        if(checkIsbd($bdname) == true){
//            $zhuce=false;
//            echo "<script language=javascript>alert('报单中心不存在,请检查后再试.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//        }else{
//            $array=getMemberbyNickName($bdname);
//            $bdid=$array['id'];
//        }
//        if($treeplace == 0){
//            $zhuce=false;
//            echo "<script language=javascript>alert('请选择安置区域');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&userid=".$userid."'</script>";
//         
//        }
//         if(checkNickNamebyispay($fathername) == false){
//             $zhuce=false;
//             echo "<script language=javascript>alert('接点编号不存在,或尚未激活,请检查后再试.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//         }else{
//             $array=getMemberbyNickName($fathername);
//             $fatherid=$array['id'];
//             $plevel=$array[plevel]+1;
//             $fplevel=$array[plevel];
//             $ppath="".$array[ppath].$array[id].",";
//         }
        //验证第三区
//         if($treeplace==3){
//             $sql = "SELECT * FROM `member` WHERE id=".$FatherID." AND kai>0";
//             $you=getOne($sql);
//             if($you['id']==null){

//                 $zhuce=false;
//                 echo "<script language=javascript>alert('接点人第三区未开启，不能注册.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//             }
//         }
        //验证左右区
//         if($treeplace>=2){
//             $sql = "SELECT * FROM `member` WHERE fatherid=".$FatherID." AND ispay>0";
//             $you=getOne($sql);
//             if($you['id']==null){

//                 $zhuce=false;
//                 echo "<script language=javascript>alert('接点人必须先激活左区,才能注册.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//             }
//         }
//         $sql = "SELECT * FROM `member` WHERE id=$reid";
//         $tj=getOne($sql);//推荐人信息
//    if ($tj['recount']==0) {//无推荐人
//
//        $sql = "SELECT id,nickname FROM `member` WHERE fatherid=".$tj['id']." and treeplace=1 and ispay>0 ";//推荐人左区会员
//        $one=getOne($sql);
//        if ($one['id']==null) {//推荐人左区没有会员
//            if ($treeplace==2 ){
//                $zhuce=false;
//                echo "<script language=javascript>alert('推荐人第一单必须放自己左区.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//
//            }
//            if ($FatherID!=$tj['id']){
//                $zhuce=false;
//                echo "<script language=javascript>alert('推荐人第一单必须放自己左区.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//
//            }
//        }else {//左区有会员
//
//            if ($FatherID==$tj['id'] && $treeplace==2) {//第一层推荐人及时接点人
//                $zhuce=false;
//                echo "<script language=javascript>alert('推荐人第一单必须放自己左区.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//
//            }else {
//
//                $fhid=$FatherID;
//                for ($i=1;$i;$i++){
//
//
//                    $sd=0;
//                    $sql = "SELECT id,fatherid,treeplace FROM `member` WHERE id=".$fhid." ";//接点人的接点人是不是在推荐人左区
//                    $o=getOne($sql);
//                    if ($o['fatherid']==$one['id']) {
//
//                        $sd=1;
//                        break;
//                    }
//                    if ($o['fatherid']==$reid) {
//                        if ($o['treeplace']==1) {
//                            $sd=1;
//                        }else {
//                            $sd=0;
//                        }
//
//                        break;
//                    }
//                    if ($o['fatherid']!=0) {
//                        $fhid=$o['fatherid'];
//                    }else {
//                        $sd=0;
//                        break;
//                    }
//                }
//                if ($sd==0){
//                    $zhuce=false;
//                    echo "<script language=javascript>alert('推荐人第一单必须放自己左区.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//
//                }
//            }
//        }
//    }










//
//         if(checkFatherMan($fatherid,$treeplace) == true){
//             $zhuce=false;
//             echo "<script language=javascript>alert('该位置已有会员注册,请更换区域再试.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
//         }
// 	if($recount==0 and $treeplace==2){
// 		$zhuce=false;
// 		echo "<script language=javascript>alert('直推第一人必须放左区,才能在右区注册.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
// 	}
// 	if($treeplace==2){
// 	$sql = "SELECT * FROM `member` WHERE fatherid=".$FatherID." AND ispay>0";
// 	$query = mysql_query($sql);
// 	if(mysql_num_rows($query)==0){

// 		  $zhuce=false;
// 		  echo "<script language=javascript>alert('接点必须先激活左区,才能在右区注册.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
// 	}
// 	}
        
//        if($user){
//            $userid=$sys['qz'].$user;
//        }else{
//            for($i=1;$i;$i++){
//                $n=user();
//                $userid=$sys['qz'].$n;
//                if(checkUserID($userid) == false && checkUserID2($userid)== false){
//                    break;
//                }
//            }
//        }
        if(checkUserID($userid) == true)
        {
            $zhuce=false;
            echo "<script language=javascript>alert('会员编号已存在,请刷新后再试.');window.location.href='zhucehuiyuan.php?rn=".$rname."&nickname=".$fathername."&tid=".$treeplace."&userid=".$userid."'</script>";
        }
        
        if($zhuce){
            $nickname=$nickname;
            $newmember['userid']=$userid;
            $newmember['nickname']=$nickname;
            $newmember['password1']=md5($password1);
            $newmember['password2']=md5($password2);
            $newmember['pass1']=$password1;
            $newmember['pass2']=$password2;
            $newmember['passquestion']=$passquestion;
            $newmember['passanswer']=$passanswer;
            $newmember['username']=$username;
            $newmember['usercard']=$usercard;
            $newmember['usertel']=$usertel;
            $newmember['useraddress']=$useraddress;
// 		$newmember['userqq']=$userqq;
            $newmember['bankname']=$bankname;
            $newmember['bankcard']=$bankcard;
            $newmember['bankusername']=$bankusername;
            $newmember['sheng']=$sheng;
            $newmember['shi']=$shi;
            $newmember['xian']=$xian;
            $newmember['bankaddress']=$bankaddress;
            $newmember['ulevel']=$ulevel;
            $newmember['lsk']=$lsk;
// 		$newmember['dan']=$dan;
// 		$newmember['pv']=$pv;
            $newmember['reid']=$reid;
            $newmember['rname']=$rname;
            $newmember['relevel']=$relevel;
            $newmember['repath']=$repath;
            $newmember['treeplace']=$treeplace;
            $newmember['fatherid']=$fatherid;//
            $newmember['fathername']=$fathername;//
            $newmember['plevel']=$plevel;//
            $newmember['ppath']=$ppath;//
            $newmember['bdid']=$bdid;
            $newmember['bdname']=$bdname;
            $newmember['useremail']=$useremail;
            $newmember['rdt']=now();
            $newmember['pv']=$sex;
           // $newmember['zuo']=$us['id'];
            //$newmember['you']=$us['nickname'];
// 		$newmember['xueli']=$xueli;
            $newmember['zhifubao']=$zhifubao;
// 		$newmember['caifutong']=$caifutong;
            $newmember['weixin']=$weixin;
//		$us=getMemberbyID($newmember['reid']);
            add_insert_cl('member',$newmember);
            
            $nik=getMemberbyNickName($nickname);
            $isnews['uid']=$nik['id'];
            add_insert_cl('isnews',$isnews);
            //自动生成二维码
            //引入phpqrcode库文件
            include_once("phpqrcode.php");
            // 二维码数据
            $data = $sys['url'].'/web2/register2.php?rname='.$nik['nickname'];
            
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
//            $a= getOne("select id from yuliu where nickname='{$user}'");
//            $date= now();
//            if($a){
//                edit_sql("update yuliu set admin='{$_SESSION['to_admin']}',isqr=1,zdate='{$date}' where id={$a['id']}");
//            }
//            $ul= ulevel($ulevel);  
//            $_member->jihuomember($nik['id']);
//            $_member->addbdrecord($nik,0);
            $uss= getMemberbyID($nik['reid']);
            $_member->jihuomember($nik['id']);
            $_member->addbdrecord($nik,$uss,$nik['lsk']);//激活记录
            $_member->orders(0,$nik,0,0,0);//订单
    }
}else{
    echo "<script language=javascript>alert('系统错误请重新注册.');window.location.href='zhucehuiyuan.php'</script>";
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>开通成功</title>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/chakan.css">
<script src="js/jquery.js"></script>
<script src="js/lanrenzhijia.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
<!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
<script type="text/javascript" src="js/jquery.citys.js"></script>
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}                                         
</script>
<SCRIPT type="text/javascript">
	function manage(id){
		window.open("../web/index.php?Manager_ID="+id);
	}

</SCRIPT>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader" class="clearfix">
    <?php include 'header.php';?>
	</header><!-- #EndLibraryItem --><section id="main" class="clearfix"><!-- #BeginLibraryItem "/Library/sideBar.lbi" --> <?php include 'left.php';?>
	<!-- #EndLibraryItem -->
	<div id="conts" cl ass="heightLine-1"><!-- #BeginLibraryItem "/Library/title.lbi" --> <?php include 'title.php';?><!-- #EndLibraryItem --><div class="mainBox">
            <form id="form" name="form" action="zhuce.php" method="post" onSubmit="return CheckForm();">
            	<div class="table">
                <table>
                	<tr>
                    	<th colspan="2">开通成功</th>
                    </tr>
   <tr>
    <td width="41%" align="right">推荐编号：</td>
    <td width="59%" align="left"><?=$rname?></td>
    
  </tr>  
<!--  <tr>
    <td width="41%" align="right">接点编号：</td>
    <td width="59%" align="left"><?=$fathername?></td>
    
  </tr>  -->
<!--  <tr>
    <td width="41%" align="right">安置区域：</td>
    <td width="59%" align="left"><?php if($treeplace==1){    echo '左区';}else{ echo '右区';}?></td>
    
  </tr>  -->
  <tr>
    <td width="41%" align="right">会员编号：</td>
    <td width="59%" align="left"><?=$nickname?></td>
  </tr>

  <tr>
    <td width="41%" align="right">会员姓名：</td>
    <td width="59%" align="left"><?=$username?></td>
  </tr>
  <tr>
    <td width="41%" align="right">会员级别：</td>
    <td width="59%" align="left"><?=$ul['lvname']?></td>
  </tr>
   <tr >
    <td width="41%" align="right">性别：</td>
    <td width="59%" align="left">
        <?php if($sex==1){echo '男';}else{echo '女';}?>
       </td>
  </tr>
  <tr >
    <td align="right">手机号码：</td>
    <td align="left">
      <?=$usertel?>  
    </td>
  </tr>
  <tr>
    <td width="41%" align="right">身份证号码：</td>
    <td width="59%" align="left">
       <?=$usercard?>
    </td>
  </tr>
  <!--
  <?php if($bankname<>-1){
      ?>
  <tr >
    <td align="right">开户银行：</td>
    <td align="left">
        <?=$bankname?>
    </td>
  </tr>
  <tr >
    <td align="right">开户帐号：</td>
    <td align="left"><?=$bankcard?></td>
  </tr>
  <tr >
    <td align="right">开户姓名：</td>
    <td align="left"><?=$bankusername?></td>
  </tr>
  <tr >
    <td align="right">开户地址：</td>
    <td align="left"><?=$bankaddress?></td>
  </tr>
  
  <?php } ?>-->
  
                	<tr>
                    	<th colspan="2">
                    <input style="width:100px;padding:5px 0;color:#fff;background:#1ab394;border:none;"  type="button" class="button" id="button" name="button" value="继续注册" onClick="window.location.href='zhucehuiyuan.php?rn=<?=$rname?>&nickname=<?=$fathername?>'" />  
                    <input style="width:100px;padding:5px 0;color:#fff;background:#1ab394;border:none;"  type="button" class="button" id="button" name="button" value="管理" onClick="manage(<?=$nik['id']?>)" />
                    
                        </th>
                    </tr>
                </table>
                </div>
                
               </form> 
                
                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>