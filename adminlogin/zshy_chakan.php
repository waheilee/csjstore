<?php
include_once("../function.php");
include_once("../class/member_class.php");
include_once("action.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
	$us=getMemberbyID($_GET['ID']);
	$uid=$us['id'];
	$userid=$us['userid'];
	$nickname=$us['nickname'];
	$rname=$us['rname'];
	$reid=$us['reid'];
	$fathername=$us['fathername'];
	$bdname=$us['bdname'];
	$password1=$us['password1'];
	$password2=$us['password2'];
 	$passQuestion=$us['passquestion'];
	$passAnswer=$us['passanswer'];
	$UserCard=$us['usercard'];
	$UserName=$us['username'];
	$UserTel=$us['usertel'];
	$UserAddress=$us['useraddress'];
	$UserQQ=$us['userqq'];
	$BankName=$us['bankname'];
	$BankCard=$us['bankcard'];
    $BankUserName=$us['bankusername'];
    $lsk=$us['lsk'];
	$BankAddress=$us['bankaddress'];
	$useremail=$us['useremail'];
	$rdt=$us['rdt'];
	$pdt=$us['pdt'];
	$ulevel=$us['ulevel'];
	$zjulevel=$us['zjulevel'];
	$area1=$us['area1'];
	$area2=$us['area2'];
 	$area3=$us['area3'];
 	// $qckai=$us['qckai'];
	$yarea1=$us['yarea1'];
	$yarea2=$us['yarea2'];
 	$yarea3=$us['yarea3'];
	$maxmey=$us['maxmey'];
	$sheng=$us['sheng'];
	$shi=$us['shi'];
	$xian=$us['xian'];
	$mey=$us['mey'];
	$zsq=$us['zsq'];
	$sgb=$us['sgb'];
	$maxsgb=$us['maxsgb'];
	$djsgb=$us['djsgb'];
	$gwb=$us['gwb'];
	$jihuo=$us['jihuo'];
	$cfxf=$us['cfxf'];
    $cy=$us['cy'];
	$wlf=$us['wlf'];
	$fanli=$us['fanli'];
	$zjulevel1=$us['zjulevel1'];

	$zhifubao=$us['zhifubao'];
	$weixin=$us['weixin'];
	
	//服务中心
	$isbd=$us['isbd'];

// 	$caifutong=$us['caifutong'];
	$rus=getMemberbyID($us['reid']);
	$fus=getMemberbyID($us['fatherid']);
	$rusername=$rus['username'];
    $fatherusername=$fus['username'];
 	$isfh=$us['isfh'];
 	$kai=$us['kai'];
// 	$tixian=$us['tixian'];
// 	$fhb=$us['fhb'];
if ($_POST['submit']){
    if($_POST['password1']!=null){
        action::record("修改一级密码", $us['id'], $_SESSION['adminid'], $_POST['password1']);
		$us_update['password1']=md5($_POST['password1']);
		$us_update['pass1']=$_POST['password1'];
	}
	if($_POST['password2']!=null){
	    action::record("修改二级密码", $us['id'], $_SESSION['adminid'], $_POST['password2']);
		$us_update['password2']=md5($_POST['password2']);
		$us_update['pass2']=$_POST['password2'];
	}
 	if($us['passquestion']!=$_POST['passQuestion']){
 		    action::record("修改密保问题", $us['id'], $_SESSION['adminid'], $_POST['passQuestion']);
 			$us_update['passquestion']=$_POST['passQuestion'];
 	}
 	if($us['passanswer']!=$_POST['passAnswer']){
 		action::record("修改密保答案", $us['id'], $_SESSION['adminid'], $_POST['passAnswer']);
 		$us_update['passanswer']=$_POST['passAnswer'];
 	}
	if($us['usercard']!=$_POST['UserCard']){
	    action::record("修改身份证", $us['id'], $_SESSION['adminid'], $_POST['UserCard']);
	    $us_update['usercard']=$_POST['UserCard'];
	}
	if($us['username']!=$_POST['UserName']){
	    action::record("修改姓名", $us['id'], $_SESSION['adminid'], $_POST['UserName']);
	    $us_update['username']=$_POST['UserName'];
	}
	
	$us_update['usertel']=$_POST['UserTel'];
	if($us['useraddress']!=$_POST['UserAddress']){
	    action::record("修改收货地址", $us['id'], $_SESSION['adminid'], $_POST['UserAddress']);
	    $us_update['useraddress']=$_POST['UserAddress'];
	}
	if($_POST['lsk']!=0){
	$us_update['lsk']=$_POST['lsk'];
	if($us['lsk']!=$_POST['lsk']){
	    action::record("修改注册金额", $us['id'], $_SESSION['adminid'], $_POST['lsk']);
	    $us_update['lsk']=$_POST['lsk'];
	}
	}
	$us_update['userqq']=$_POST['UserQQ'];
	if($us['bankname']!=$_POST['BankName']){
	    action::record("修改开户银行", $us['id'], $_SESSION['adminid'], $_POST['BankName']);
	    $us_update['bankname']=$_POST['BankName'];
	}
	
	if($us['bankcard']!=$_POST['BankCard']){
	    action::record("修改开户账号", $us['id'], $_SESSION['adminid'], $_POST['BankCard']);
	    $us_update['bankcard']=$_POST['BankCard'];
	}
	
	if($us['bankusername']!=$_POST['BankUserName']){
	    action::record("修改开户姓名", $us['id'], $_SESSION['adminid'], $_POST['BankUserName']);
	    $us_update['bankusername']=$_POST['BankUserName'];
	}
	
	if($us['bankaddress']!=$_POST['BankAddress']){
	    action::record("修改开户地址", $us['id'], $_SESSION['adminid'], $_POST['BankAddress']);
	    $us_update['bankaddress']=$_POST['BankAddress'];
	}
	


// 	     //统计业绩
// 	    $member_cl=new member_class();
	    
// 	    $_yul=ulevel($us['ulevel']);//原级别
// 	    $_uul=ulevel($_POST['ulevel']);//升级级别
// 	    $cha1=$_uul['lsk']-$_yul['lsk'];
// 	    $member_cl->addArea2($us['id'], $us['treeplace'], $cha1,$us['ulevel']);//先减去原来在团队的位置
// 	    $member_cl->addArea($us['id'], $us['treeplace'], $cha1,$_POST['ulevel']);//升级后加上
	    
	    

 	    //实际金额
 	    //$us_update['lsk']=$_uul['lsk'];
	    
	
	// if($us['zjulevel']!=$_POST['zjulevel'] && $_POST['zjulevel']>0){
	// 	action::record("修改会员职称", $us['id'], $_SESSION['adminid'], $_POST['zjulevel']);

	// 	 $us_update['zjulevel']=$_POST['zjulevel'];
	// }
	
	if($_POST['area1']!=0){
	    action::record("修改总业绩", $us['id'], $_SESSION['adminid'], $_POST['area1']);
	    $us_update['area1']=$us['area1']+$_POST['area1'];
	}
	
	// if($_POST['area2']!=0){
	//     action::record("修改右区总业绩", $us['id'], $_SESSION['adminid'], $_POST['area2']);
	//     $us_update['area2']=$us['area2']+$_POST['area2'];
	// }
	// if($_POST['area3']!=0){
	//     action::record("修改右区总业绩", $us['id'], $_SESSION['adminid'], $_POST['area3']);
	//     $us_update['area3']=$us['area3']+$_POST['area3'];
	// }
	if($_POST['yarea1']!=0){
	    action::record("经销商考核业绩", $us['id'], $_SESSION['adminid'], $_POST['yarea1']);
	    $us_update['yarea1']=$us['yarea1']+$_POST['yarea1'];
	}
//        if($_POST['yarea2']!=0){
//	    action::record("职称考核业绩", $us['id'], $_SESSION['adminid'], $_POST['yarea2']);
//            $us_update['yarea2']=$us['yarea2']+$_POST['yarea2'];
//	}
	// if($_POST['yarea2']!=0){
	//     action::record("修改中区考核业绩", $us['id'], $_SESSION['adminid'], $_POST['yarea2']);
	//     $us_update['yarea2']=$us['yarea2']+$_POST['yarea2'];
	// }
	// if($_POST['yarea3']!=0){
	//     action::record("修改右区考核业绩", $us['id'], $_SESSION['adminid'], $_POST['yarea3']);
	//     $us_update['yarea3']=$us['yarea3']+$_POST['yarea3'];
	// }
	
	
// 	$us_update['area3']=$_POST['area3'];
// 	$us_update['tixian']=$_POST['tixian'];
	
//	$us_update['yarea3']=$_POST['yarea3'];s
 	if($us['sheng']!=$_POST['province']){
 		action::record("修改省份", $us['id'], $_SESSION['adminid'], $_POST['province']);
 		$us_update['sheng']=$_POST['province'];
    }	
 	if($us['shi']!=$_POST['city']){
        if($_POST['city']<>"市辖区" && $_POST['city']<>"县"){
            action::record("修改城市", $us['id'], $_SESSION['adminid'], $_POST['city']);
           
        }
 		 $us_update['shi']=$_POST['city'];
    }	
 	if($us['xian']!=$_POST['area']){
 		action::record("修改所在县区", $us['id'], $_SESSION['adminid'],$_POST['area']);
 		$us_update['xian']=$_POST['area'];
 	}
	
//    if($us['useremail']!=$_POST['useremail']){
//		action::record("修改邮箱", $us['id'], $_SESSION['adminid'],$_POST['county']);
//		$us_update['useremail']=$_POST['useremail'];
//	}
//	if($_POST['kai']!=$us['kai']){
//	    action::record("第三区状态", $us['id'], $_SESSION['adminid'],$_POST['kai']);
	
//	    $us_update['kai']=$_POST['kai'];
//	}
	// if(1==1){
	//     action::record("静态返利发放", $us['id'], $_SESSION['adminid'],$_POST['isfh']);
	
	//     $us_update['isfh']=$_POST['isfh'];
	// }
	/*
	if(1==1){
	    action::record("差额全额开关", $us['id'], $_SESSION['adminid'],$_POST['qckai']);
	    
	    $us_update['qckai']=$_POST['qckai'];
	}
	*/
//	$us_update['useremail']=$_POST['useremail'];
//	$us_update['isfh']=$_POST['isfh'];
	if($_POST['maxmey']!=0){
	    action::record("累计C积分", $us['id'], $_SESSION['adminid'], (int)$_POST['maxmey']);
		$us_update['maxmey']=$us['maxmey']+$_POST['maxmey'];
	}
// 	if($_POST['fhb']!=0){
// 		action::record("分红币", $us['id'], $_SESSION['adminid'], (int)$_POST['fhb']);
	
// 		$us_update['fhb']=$us['fhb']+$_POST['fhb'];
// 	}
	if($_POST['mey']!=0){
	    action::record("剩余C积分", $us['id'], $_SESSION['adminid'],$_POST['mey']);
		$us_update['mey']=$us['mey']+$_POST['mey'];
	}
	 if($_POST['zsq']!=0){
	     action::record("增减A积分", $us['id'], $_SESSION['adminid'], (int)$_POST['zsq']);
	 	$us_update['zsq']=$us['zsq']+$_POST['zsq'];
	 }
//	if($_POST['gwb']!=0){
//	    action::record("特惠券", $us['id'], $_SESSION['adminid'], (int)$_POST['gwb']);
//	    $us_update['gwb']=$us['gwb']+$_POST['gwb'];
//	}
	// if($_POST['province']!=null){
	//     if($us['sheng']!=$_POST['province']){
	//         action::record("修改省份", $us['id'], $_SESSION['adminid'], $_POST['province']);
	//         $us_update['sheng']=$_POST['province'];
	//     }
	    
	//     if($us['shi']!=$_POST['city']){
	//         action::record("修改城市", $us['id'], $_SESSION['adminid'], $_POST['city']);
	//         $us_update['shi']=$_POST['city'];
	        
	//     }
	//     if($_POST['city']==null && $us['city']==null){
	//         $us_update['shi']=$_POST['province'];
	//     }
	//     if($us['xian']!=$_POST['area']){
	//         action::record("修改所在县区", $us['id'], $_SESSION['adminid'],$_POST['county']);
	//         $us_update['xian']=$_POST['area'];
	//     }
	// }
	/*
	 *   $ul=ulevel($us['ulevel']);
	   
	    $uss1=getOne("select daili from member where daili='{$_POST['city']}'");
	    $daili1=$uss1['daili'];
	    $uss2=getOne("select daili from member where daili='{$_POST['province']}'");
	    $daili2=$uss2['daili'];
	  
	    if($_POST['ulevel']==6){
	        if($uss1){
	            echo "<script language=javascript>alert('已存在{$daili1}代理,修改失败!!.');window.location.href='?ID={$_GET['ID']}'</script>";
	            return;
	        }
	        $us_update['daili']=$_POST['city'];
	    }elseif($_POST['ulevel']==7){
	        if($uss2){
	            echo "<script language=javascript>alert('已存在{$daili2}代理,修改失败!!.');window.location.href='?ID={$_GET['ID']}'</script>";
	            return;
	        }
	        $us_update['daili']=$_POST['province'];
	    }
	    //代理名称
	if($us['ulevel']==$_POST['ulevel'] && $_POST['ulevel']>=5){
	    edit_update_cl('member',$us_update,$us['id']);
	    $us1=getMemberbyID($_GET['ID']);
	    if($_POST['ulevel']==6 && $us1['daili']!=$_POST['city'] && $_POST['province']!=null){
	        $us_update['daili']=$us1['shi'];
	    }elseif($_POST['ulevel']==7 && $us1['daili']!=$_POST['province'] && $_POST['province']!=null){
	        $us_update['daili']=$us1['sheng'];
	    }
	    action::record("修改代理名称", $us['id'], $_SESSION['adminid'], $_POST['ulevel']);
	}
	 */
	if($us['ulevel']!=$_POST['ulevel']){
	    $us_update['ulevel']=$_POST['ulevel'];
// 	    $ul2=ulevel($_POST['ulevel']);
// 	    $us_update['slsk']=$ul2['yl1'];
	    action::record("修改会员等级", $us['id'], $_SESSION['adminid'], $_POST['ulevel']);
	}
        
        if($us['zjulevel']!=$_POST['zjulevel']){
	    $us_update['zjulevel']=$_POST['zjulevel'];
	    action::record("修改职称等级", $us['id'], $_SESSION['adminid'], $_POST['zjulevel']);
	}
	
	if($_POST['isbd']!=$us['isbd']){
	    action::record("报单中心状态", $us['id'], $_SESSION['adminid'],$_POST['isbd']);
	    
	    $us_update['isbd']=$_POST['isbd'];
	    $us_update['bdlevel']=$_POST['isbd'];

	}
        if($_POST['zjulevel1']!=$us['zjulevel1']){
	    action::record("合格经销商状态", $us['id'], $_SESSION['adminid'],$_POST['zjulevel1']);
	    $us_update['zjulevel1']=$_POST['zjulevel1'];
	}
	//服务中心
//	if($_POST['sfff']==2){
//	    action::record("升级为服务中心", $us['id'], $_SESSION['adminid'], "升级");
//		$us_update['isbd']=2;
//	}
//	if($_POST['sfff']==1){
//	    action::record("撤除服务中心", $us['id'], $_SESSION['adminid'], "降职");
//		$us_update['isbd']=0;
//	}
	
	
//	if($_POST['gwb']!=0){
//		action::record("激活币", $us['id'], $_SESSION['adminid'], (int)$_POST['gwb']);
//		$us_update['gwb']=$us['gwb']+$_POST['gwb'];
//	}
//
//	if($_POST['sgb']!=0){
//	    action::record("股权", $us['id'], $_SESSION['adminid'], (int)$_POST['sgb']);
//		$us_update['sgb']=$us['sgb']+$_POST['sgb'];
//
//
//	}
// 	if($_POST['djsgb']!=0){
// 		action::record("冻结华星积分", $us['id'], $_SESSION['adminid'], (int)$_POST['djsgb']);
// 		$us_update['djsgb']=$us['djsgb']+$_POST['djsgb'];
// 	}
// 	if($_POST['gwb']!=0){
// 		action::record("特惠券", $us['id'], $_SESSION['adminid'], (int)$_POST['gwb']);
// 		$us_update['gwb']=$us['gwb']+$_POST['gwb'];
// 	}
//	if($_POST['wlf']!=0){
//		action::record("车房基金", $us['id'], $_SESSION['adminid'], (int)$_POST['wlf']);
//		$us_update['wlf']=$us['wlf']+$_POST['wlf'];
//	}
//	if($_POST['fanli']!=0){
//		action::record("红利包", $us['id'], $_SESSION['adminid'], $_POST['fanli']);
//		$us_update['fanli']=$us['fanli']+$_POST['fanli'];
//	}
	if($_POST['cfxf']!=0){
		action::record("增减B积分", $us['id'], $_SESSION['adminid'], $_POST['cfxf']);
 		$us_update['cfxf']=$us['cfxf']+$_POST['cfxf'];
 	}
//    if($_POST['cy']!=0){
//        action::record("慈爱基金", $us['id'], $_SESSION['adminid'], (int)$_POST['cy']);
//        $us_update['cy']=$us['cy']+$_POST['cy'];
//    }
	
// 	if($_POST['y4']!=0){
// 		action::record("见店奖", $us['id'], $_SESSION['adminid'], (int)$_POST['y4']);
// 		$us_update['y4']=$us['y4']+$_POST['y4'];
// 	}
// 		$us_update['zhifubao']=$_POST['zhifubao'];
// 		$us_update['qianbao']=$_POST['qianbao'];
// 	$us_update['caifutong']=$_POST['caifutong'];
	
	$upreman=$_POST['upreman'];
	if($upreman!=""){
		if($upreman!=$nickname){
			$member_cl=new member_class();
			if($member_cl->checkNickNameispay($upreman)){
				if($member_cl->checkisrepath($us['id'],$upreman)){
					echo "<script language=javascript>alert('会员".$upreman."已在您的团队中,无法将其作为推荐人.');window.location.href='?ID=".$us['id']."'</script>";
				}else{
				    $us_update['rname']=$upreman;
				  
				    if($us['rname']!=$upreman){
				        action::record("修改推荐人", $us['id'], $_SESSION['adminid'], $upreman);
				        
				    }
					
					edit_update_cl('member',$us_update,$us['id']);	
					$member_cl->update_reman($upreman);	
				}
			}else{
				echo "<script language=javascript>alert('推荐人不存在或没有激活.');window.location.href='?ID=".$us['id']."'</script>";	
			}
			
		}else{
			echo "<script language=javascript>alert('推荐人不能填写自己.');window.location.href='?ID=".$us['id']."'</script>";		
		}
	}else{
		echo edit_update_cl('member',$us_update,$us['id']);	
	}
	echo "<script language=javascript>alert('资料修改成功.');window.location.href='?ID=".$us['id']."'</script>";	
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>正式会员——查看</title>
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
            <form name="form1" method="post" action="?ID=<?=$us['id']?>" onSubmit="return CheckForm();">
            	<div class="table">
                <table>
                	<tr>
                    	<th colspan="2">详细资料</th>
                    </tr>
                	<tr>
                    	<th colspan="2">
                        	<input type="button" class="button" id="button" name="button" value="查看推荐图" onClick="window.location.href='tuijiantu.php?ID=<?=$uid?>&action=admin'" />
                        
                        	<input type="button" class="button" id="button2" name="button2" value="查看奖金明细" onClick="window.location.href='chakanjjmx.php?ID=<?=$uid?>&action=admin'" />
                       
                       
                        </th>
                    </tr>
                    
                    <tr>
    <td width="41%" align="right">会员编号：</td>
    <td width="59%" align="left"><?=$nickname?></td>
  </tr>
  <!-- <tr >
    <td width="41%" align="right">服务中心：</td>
    <td width="59%" align="left"><?=$bdname?></td>
  </tr> -->
  <tr >
    <td width="41%" align="right">推荐人编号：</td>
    <td width="59%" align="left"><?=$rname?></td>
  </tr>
  <?php
  if($reid){
    $rr=getOne("select id,username from member where id={$reid}");
    $tui=$rr['username'];
  }else{
    $tui="顶层会员";
  }
  ?>
  <tr>
    <td width="41%" align="right">推荐人姓名：</td>
    <td width="59%" align="left"><?=$tui?></td>
  </tr>
   <!-- 
  <tr >
    <td width="41%" align="right">修改推荐人：</td>
    <td width="59%" align="left"><input name="upreman" id="upreman" type="text"></td>
  </tr>
   -->
   <!-- <tr >
    <td width="41%" align="right">修改注册金额：</td>
    <td width="59%" align="left"><?= $lsk ?><input name="lsk" id="lsk" type="text"></td>
  </tr> -->

  	<?php 

	if($us['ulevel']>=5){
	    $daili=$us['daili'].代理;
	}else{
	    $daili="暂无资格";
	}
	?>
	<!--  
    <tr>
    <td width="41%" align="right">代理名称：</td>
    <td width="59%" align="left"><?=$daili?></td>
  </tr>
 -->
   <tr >
    <td width="41%" align="right">会员级别：</td>
    <td width="59%" align="left">
      <select name="ulevel" id="ulevel">
      
      <?php 
	  	$sql="SELECT * FROM `ulevel`where ulevel>0 order by id asc ";
		if ($query=mysql_query($sql)){
			while($row=mysql_fetch_array($query)){
	  ?>
        	<option value="<?=$row['ulevel']?>" <?php if($row['ulevel']==$ulevel){?> selected <?php }?>><?=$row['lvname']?></option>
        <?php
			}
		}
		?>
      </select></td>
  </tr>
  
<tr  >
    <td width="41%" align="right">职称级别：</td>
    <td width="59%" align="left">
      <select name="zjulevel" id="zjulevel">
      <?php 
	  	$sql="SELECT * FROM `zjulevel` order by id";
		if ($query=mysql_query($sql)){
			while($row=mysql_fetch_array($query)){
	  ?>
        	<option value="<?=$row['ulevel']?>" <?php if($row['ulevel']==$zjulevel){?> selected <?php }?>><?=$row['zjname']?></option>
        <?php
			}
		}
		?>
      </select></td>
  </tr>
  
  
  
  <!-- <tr >
    <td width="41%" align="right">接点人编号：</td>
    <td width="59%" align="left"><?=$fathername?></td>
  </tr>
  <tr >
    <td width="41%" align="right">接点人姓名：</td>
    <td width="59%" align="left"><?=$fatherusername?></td>
  </tr> -->
   <?php 
  if($sheng==$shi){
      $dz=$sheng.$xian;
  }else{
      $dz=$sheng.$shi.$xian;
  }
  ?>
    <!-- <tr>
    <td width="41%" align="right">当前地址：</td>
    <td width="59%" align="left"><?=$dz?></td>
  </tr>
 <tr>
    <td align="right">修改地址：</td>
     <script type="text/javascript" src="js/jquery.citys.js"></script>
      <td align="left">
      <div id="demo1" class="citys" align="left">
         <select class="prov" id="province" name="province"></select>
         <select class="city" id="city" name="city" ></select>
         <select class="dist" id="area" name="area"> </select>
      </div>
     <script>
     $('#demo1').citys
     
     ({valueType:'name',prov:'0',city:'0',area:'0'});
     </script>
      </td>
   </tr> -->
    <tr >
    <td width="41%" align="right">是否报单中心：</td>
    <td width="59%" align="left">
        <input name="isbd" type="radio" id="isbd" value="2" <?php if ($us['isbd']==2){?> checked <?php }?>>是
        <input name="isbd" type="radio" id="isbd" value="0" <?php if ($us['isbd']==0){?> checked <?php }?>> 否
     </td>
  </tr>
    <tr >
    <td width="41%" align="right">是否合格经销商：</td>
    <td width="59%" align="left">
        <input name="zjulevel1" type="radio" id="zjulevel1" value="2" <?php if ($us['zjulevel1']==2){?> checked <?php }?>>是	
        <input name="zjulevel1" type="radio" id="zjulevel1" value="0" <?php if ($us['zjulevel1']==0){?> checked <?php }?>> 否
     </td>
  </tr>
  <tr>
    <td width="41%" align="right">注册时间：</td>
    <td width="59%" align="left"><?=$rdt?></td>
  </tr>
  <tr >
    <td width="41%" align="right">激活时间：</td>
    <td width="59%" align="left"><?=$pdt?></td>
  </tr>
  <tr >
    <td width="41%" align="right">增减累计C积分：</td>
    <td width="59%" align="left"><?=$maxmey?><input name="maxmey" type="text" value="0"></td>
  </tr>  
  <tr>
    <td width="41%" align="right">增减A积分：</td>
    <td width="59%" align="left"><?=$zsq?><input name="zsq" type="text" value="0"></td>
  </tr>
   <tr>
    <td width="41%" align="right">增减B积分：</td>
    <td width="59%" align="left"><?=$cfxf?><input name="cfxf" type="text" value="0"></td>
  </tr>
    <tr>
    <td width="41%" align="right">增减剩余C积分：</td>
    <td width="59%" align="left"><?=$mey?><input name="mey" type="text" value="0"></td>
  </tr>
<!--  <tr style="display: none;">
    <td width="41%" align="right">店铺资格：</td>
      <?php
      if($us['bdlevel']==1){
          $dpzg='服务中心';
      }else if($us['bdlevel']==2){
          $dpzg='养生会所';
      }else if($us['bdlevel']==3){
          $dpzg='分公司';
      }else{
          $dpzg='非店铺';
      }
      ?>
    <td><?=$dpzg?></td>
  </tr>-->
 
 <!-- <tr>
      <td width="41%" align="right">增减现金：</td>
    <td width="59%" align="left"><?=$zsq?><input name="zsq" type="text" value="0"></td>
  </tr> -->
<!--  <tr>
      <td width="41%" align="right">增减特惠券：</td>
    <td width="59%" align="left"><?=$gwb?><input name="gwb" type="text" value="0"></td>
  </tr>
  
  
  <tr >
    <td width="41%" align="right">差额全额开关：</td>
    <td width="59%" align="left"><input name="qckai" type="radio" id="qckai" value="1" <?php if ($qckai==1){?> checked <?php }?>>
      差额升级
        <input name="qckai" type="radio" id="qckai" value="0" <?php if ($qckai==0){?> checked <?php }?>>
      全额升级</td>
  </tr>
 <tr>
    <td width="41%" align="right">增减激活币：</td>
    <td width="59%" align="left"><?=$gwb?><input name="gwb" type="text" value="0"></td>
  </tr>-->
  <!-- <tr >
    <td width="41%" align="right">增减积分：</td>
    <td width="59%" align="left"><?=$cfxf?><input name="cfxf" type="text" value="0"></td>
  </tr> -->
<!--  
   
  <tr >
    <td width="41%" align="right">增减股权：</td>
    <td width="59%" align="left"><?=$sgb?><input name="sgb" type="text" value="0"></td>
  </tr>
  -->
  
    <tr style="display: none;" >
        <td width="41%" align="right">增减慈善基金：</td>
        <td width="59%" align="left"><?=$cy?><input name="cy" type="text" value="0"></td>
    </tr>
    
  <!--
  
  <tr >
    <td width="41%" align="right">增减车房积分：</td>
    <td width="59%" align="left"><?=$wlf?><input name="wlf" type="text" value="0"></td>
  </tr>
-->   
<!--<tr >
    <td width="41%" align="right">增减红利包：</td>
    <td width="59%" align="left"><?=$fanli?><input name="fanli" type="text" value="0"></td>
  </tr>
  -->
  
  <tr  >
    <td width="41%" align="right">总业绩：</td>
    <td width="59%" align="left">
      <?=$area1?><input name="area1" type="text" id="area1" value="0" size="5" maxlength="50"><br>
      <!--  中区:<?=$area2?><input name="area2" type="text" id="area2" value="0" size="5" maxlength="50"><br>  
      右区:<?=$area2?><input name="area2" type="text" id="area2" value="0" size="5" maxlength="50">-->
      
      
        
      <!--  中区:<?=$yarea2?><input name="yarea2" type="text" id="yarea2" value="0" size="5" maxlength="50"><br>  -->
  </tr>
  <!-- <tr  >
    <td width="41%" align="right">正在考核业绩：</td>
    <td width="59%" align="left">
      左区:<?=$yarea1?><input name="yarea1" type="text" id="yarea1" value="0" size="5" maxlength="50"><br>
      
      右区:<?=$yarea3?><input name="yarea3" type="text" id="yarea3" value="0" size="5" maxlength="50">
      
  </tr> -->
  
  <tr >
    <td width="41%" align="right">经销商考核业绩：</td>
    <td width="59%" align="left"><?=$yarea1?>
      <input name="yarea1" type="text" id="yarea1" value="0" size="5" maxlength="50">
      <!-- B区:<?=$yarea2?>
      <input name="yarea2" type="text" id="yarea2" value="0" size="5" maxlength="50">
      
      C区:<?=$yarea3?>
      <input name="yarea3" type="text" id="yarea3" value="0" size="5" maxlength="50" style="display:none"> -->
      
      </td>
  </tr>
<!-- <tr >
    <td width="41%" align="right">职称考核业绩：</td>
    <td width="59%" align="left"><?=$yarea2?>
      <input name="yarea2" type="text" id="yarea2" value="0" size="5" maxlength="50">
       B区:<?=$yarea2?>
      <input name="yarea2" type="text" id="yarea2" value="0" size="5" maxlength="50">
      
      C区:<?=$yarea3?>
      <input name="yarea3" type="text" id="yarea3" value="0" size="5" maxlength="50" style="display:none"> 
      
      </td>
  </tr>-->
   <!--  
 
  <tr style="display: none;" >
    <td width="41%" align="right">会员资格：</td>
    <td width="59%" align="left">
      <select name="ulevel" id="ulevel">
      <?php 
	  	$sql="SELECT * FROM `ulevel` order by id asc";
		if ($query=mysql_query($sql)){
			while($row=mysql_fetch_array($query)){
	  ?>
        	<option value="<?=$row['ulevel']?>" <?php if($row['ulevel']==$ulevel){?> selected <?php }?>><?=$row['lvname']?>￥<?=$row['lsk']?></option>
        <?php
			}
		}
		?>
      </select></td>
  </tr>
  -->
  <!-- 
  <?php if ($us['zjulevel']>0){?>
  	 <tr  >
    <td width="41%" align="right">会员职称：</td>
    <td width="59%" align="left">
      <select name="zjulevel" id="zjulevel">
      <?php 
	  	$sql="SELECT * FROM `zjulevel` order by id";
		if ($query=mysql_query($sql)){
			while($row=mysql_fetch_array($query)){
	  ?>
        	<option value="<?=$row['ulevel']?>" <?php if($row['ulevel']==$zjulevel){?> selected <?php }?>><?=$row['zjname']?></option>
        <?php
			}
		}
		?>
      </select></td>
  </tr>
  <?php }?>
   -->
  

 <!-- <tr >
    <td width="41%" align="right">静态返利发放：</td>
    <td width="59%" align="left"><input name="isfh" type="radio" id="isfh" value="1" <?php if ($isfh==1){?> checked <?php }?>>
        停止
        <input name="isfh" type="radio" id="isfh" value="0" <?php if ($isfh==0){?> checked <?php }?>>
      发放</td>
  </tr> -->
 
  <!-- <tr >
    <td width="41%" align="right">第三区情况：</td>
    <td width="59%" align="left"><input name="kai" type="radio" id="kai" value="1" <?php if ($kai==1){?> checked <?php }?>>
        开放
        <input name="kai" type="radio" id="kai" value="0" <?php if ($kai==0){?> checked <?php }?>>
      关闭</td>
  </tr> --> 
<!--  <tr style="display:none">-->
<!--    <td width="41%" align="right">提现开关：</td>-->
<!--    <td width="59%" align="left"><input name="tixian" type="radio" id="tixian" value="1" <?php if ($tixian==1){?> checked <?php }?>>-->
<!--      关-->
<!--        <input name="tixian" type="radio" id="tixian" value="0" <?php if ($tixian==0){?> checked <?php }?>>-->
<!--      开</td>-->
<!--  </tr>-->

  <tr>
    <td width="41%" align="right">一级密码：</td>
    <td width="59%" align="left">
      <input type="text" name="password1" id="password1" value="" placeholder="请输入新的一级密码">原密码:<?=$us['pass1']?>
    </td>
  </tr>
  <tr>
    <td width="41%" align="right">二级密码：</td>
    <td width="59%" align="left">
      <input type="text" name="password2" id="password2" value="" placeholder="请输入新的二级密码">原密码:<?=$us['pass2']?>
    </td>
  </tr>
     <tr>
    <td width="41%" align="right">密码安全问题：</td>
    <td width="59%" align="left">
      <input type="text" name="passQuestion" id="passQuestion" value="<?=$passQuestion?>">
    </td>
  </tr>
  <tr >
    <td width="41%" align="right">密码安全答案：</td>
    <td width="59%" align="left">
      <input type="text" name="passAnswer" id="passAnswer" value="<?=$passAnswer?>">
    </td>
  </tr>
  
  <tr>
    <td width="41%" align="right">会员姓名：</td>
    <td width="59%" align="left">
      <input type="text" name="UserName" id="UserName" value="<?=$UserName?>">
    </td>
  </tr>
  <tr>
    <td width="41%" align="right">身份证号码：</td>
    <td width="59%" align="left">
      <input type="text" name="UserCard" id="UserCard" value="<?=$UserCard?>">
    </td>
  </tr>
  <tr >
    <td align="right">联系电话：</td>
    <td align="left"><input type="text" name="UserTel" id="UserTel" value="<?=$UserTel?>"></td>
  </tr>
  <tr >
    <td align="right">收货地区：</td>
    <td align="left"><div id="demo1" class="citys">
               
                    <script type="text/javascript" src="js/jsAddress.js"></script>
                    <select style=" width: 100px;" id="province" name="province" ></select>
                    <select style=" width: 100px;" id="city" name="city"></select>
                    <select style=" width: 100px;" id="area" name="area" ></select>


                    <script type="text/javascript">
                        addressInit('province', 'city', 'area','<?=$sheng?>','<?=$shi?>','<?=$xian?>');
                    </script>
                
            </div></td>
  </tr>
  <tr>
    <td align="right">收货详细地址：</td>
    <td align="left"><input name="UserAddress" type="text" id="UserAddress" value="<?=$UserAddress?>" size="30" maxlength="100"></td>
  </tr>
  <!-- <tr>
    <td align="right">联系地址：</td>
    <td align="left"><input type="text" name="UserAddress" id="UserAddress" value="<?=$UserAddress?>"></td>
  </tr> -->
 
  <tr style="display:none">
    <td align="right">QQ号码：</td>
    <td align="left"><input type="text" name="UserQQ" id="UserQQ" value="<?=$UserQQ?>"></td>
  </tr>
<!--  <tr >
    <td align="right">电子邮箱：</td>
    <td align="left"><input name="useremail" type="text" id="useremail" value="<?=$useremail?>" size="30" maxlength="50"></td>
  </tr>-->
<!--  <tr >
    <td align="right">开户银行：</td>
    <td align="left">
   
              <select name="BankName" id="BankName">
                                    
				 <option value="中国银行" <?php if($us['bankname']=='中国银行'){?>selected<?php }?>>中国银行</option>
				 <option value="中国农业银行" <?php if($us['bankname']=='中国农业银行'){?>selected<?php }?>>中国农业银行</option>
				 <option value="中国工商银行" <?php if($us['bankname']=='中国工商银行'){?>selected<?php }?>>中国工商银行</option>
				 <option value="中国建设银行" <?php if($us['bankname']=='中国建设银行'){?>selected<?php }?>>中国建设银行</option>
				</select> 
    </td>
  </tr>-->
    <tr>
    <td align="right">开户银行：</td>
    <td align="left">
   
    <select name="BankName" id="BankName">
        <option value="中国银行" <?php if($BankName=='中国银行'){?>selected<?php }?>>中国银行</option>
        <option value="中国农业银行" <?php if($BankName=='中国农业银行'){?>selected<?php }?>>中国农业银行</option>
        <option value="中国建设银行" <?php if($BankName=='中国建设银行'){?>selected<?php }?>>中国建设银行</option>
        <option value="中国工商银行" <?php if($BankName=='中国工商银行'){?>selected<?php }?>>中国工商银行</option> 
      </select></td>
    
    </td>
  </tr>
  <tr >
    <td align="right">开户帐号：</td>
    <td align="left"><input type="text" name="BankCard" id="BankCard" value="<?=$BankCard?>"></td>
  </tr>
  <tr >
    <td align="right">开户姓名：</td>
    <td align="left"><input type="text" name="BankUserName" id="BankUserName" value="<?=$BankUserName?>"></td>
  </tr>
  <tr >
    <td align="right">开户地址：</td>
    <td align="left"><input type="text" name="BankAddress" id="BankAddress" value="<?=$BankAddress?>"></td>
  </tr>
  <tr style="display:none">
    <td align="right">支付宝：</td>
    <td align="left"><input type="text" name="zhifubao" id="zhifubao" value="<?=$zhifubao?>"></td>
  </tr>
   
  <tr style="display:none">
    <td align="right">微信：</td>
    <td align="left"><input type="text" name="weixin" id="weixin" value="<?=weixin?>"></td>
  </tr>
  <tr style="display:none">
    <td align="right">财付通帐号：</td>
    <td align="left"><input type="text" name="caifutong" id="caifutong" value="<?=$caifutong?>"></td>
  </tr>
  
<!--  <tr >-->
<!--  	<td align="right">所属地区：</td>-->
<!--    <td align="left">-->
<!--     <div id="demo1" class="citys">-->
<!--                <p>-->
<!--			<input type="text" id="sheng" value="<?=$sheng?>" style="display:none">-->
<!--			<input type="text" id="shi" value="<?=$shi?>" style="display:none">-->
<!--			<input type="text" id="xian" value="<?=$xian?>" style="display:none">-->
<!--                    <select name="province"></select>-->
<!--                    <select name="city"></select>-->
<!--                    <select name="area"></select>-->
<!--                </p>-->
<!--            </div>-->
<!--            <script type="text/javascript">-->
<!--			var sheng=$('#sheng').val();-->
<!--			var shi=$('#shi').val();-->
<!--			var xian=$('#xian').val();-->
<!--                $('#demo1').citys({valueType:'name',province:sheng,city:shi,area:xian});-->
<!--            </script>-->
<!--    </td>-->
<!--    </tr>-->

                	<tr>
                    	<th colspan="2">
                        	<input type="submit" value="修改" name="submit" id="submit"/>
                        	<input name="" type="reset" value="重置" />
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