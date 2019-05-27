<!DOCTYPE html>
<?php
include("check.php");
include_once("../function.php");
include_once("../class/system_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
	if($_SESSION['isbd']==2){
		$ID=$_GET['id'];
	}
	if($ID==""){
		$ID=$_SESSION['ID'];
	}
	$member=getMemberbyID($ID);
	$nickname=$member['nickname'];
	$passQuestion=$member['passquestion'];
	$passAnswer=$member['passanswer'];
	$UserCard=$member['usercard'];
	$UserName=$member['username'];
	$UserTel=$member['usertel'];
	$UserAddress=$member['useraddress'];
	$UserQQ=$member['userqq'];
	$useremail=$member['useremail'];
	$BankName=$member['bankname'];
	$BankCard=$member['bankcard'];
	$BankUserName=$member['bankusername'];
	$BankAddress=$member['bankaddress'];
	$sheng=$member['sheng'];
	$shi=$member['shi'];
	$xian=$member['xian'];
	$sex=$member['sex'];
	$nian=$member['nian'];
	$yue=$member['yue'];
	$ri=$member['ri'];
	$sex=$member['sex'];
	$xueli=$member['xueli'];
$zhifubao=$member['zhifubao'];
$caifutong=$member['caifutong'];

$shopid=$member['shopid'];
$areaid=$member['areaid'];
	
if ($_POST['submit']){
	$_system=new system_class();
	$sys=$_system->system_information(1);
	if($sys['ziliao']==1){
		$ID=$_SESSION['ID'];
		$_us['nickname']=$_POST['nickname'];
		$_us['usercard']=$_POST['UserCard'];
		$_us['username']=$_POST['UserName'];
        
        $_us['sheng']=$_POST['province'];
        $_us['shi']=$_POST['city'];
        $_us['xian']=$_POST['area'];
        
		$_us['usertel']=$_POST['UserTel'];
        $_us['useremail']=$_POST['useremail'];
		$_us['useraddress']=$_POST['UserAddress'];
		$_us['bankname']=$_POST['BankName'];
		$_us['bankcard']=$_POST['BankCard'];
		$_us['bankusername']=$_POST['BankUserName'];
		$_us['bankaddress']=$_POST['BankAddress'];
		edit_update_cl('member',$_us,$ID);
		echo "<script language=javascript>alert('资料修改成功.');window.location.href='?id=".$ID."'</script>";	
	}else{
		echo "<script language=javascript>alert('系统暂时关闭修改资料功能,如需修改请联系管理员.');window.location.href='?id=".$ID."'</script>";		
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
<title>基本信息</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/jbxx.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
<link rel="stylesheet" type="text/css" href="ssx/style/cssreset-min.css">
<link rel="stylesheet" type="text/css" href="ssx/style/common.css">
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
<script type="text/javascript" src="ssx/script/jquery.min.js"></script>
<script type="text/javascript" src="ssx/script/jquery.citys.js"></script>
	<script>
		function CheckForm(){
            UserTel=document.form1.UserTel.value;
            sheng=document.form1.province.value;
            area=document.form1.area.value;
            UserAddress=document.form1.UserAddress.value;
			BankName=document.form1.BankName.value;
			BankCard=document.form1.BankCard.value;
			BankUserName=document.form1.BankUserName.value;
			BankAddress=document.form1.BankAddress.value;
			if(UserTel.length == 0){
				alert("温馨提示:\n请输入联系电话.");
				document.form1.UserTel.focus();
				return false;
			}
            if(sheng==""){
                alert("请选择收货地区！");

                return false;
            }
//            if(sheng==""){
//                alert("请选择区县！");
//                return false;
//            }
			if(UserAddress.length == 0){
				alert("温馨提示:\n请输入联系地址.");
				document.form1.UserAddress.focus();
				return false;
			}
            if(BankName==-1){
				alert("温馨提示:\n请输入开户银行.");
				document.form1.BankName.focus();
				return false;
			}
			if(BankCard.length == 0){
				alert("温馨提示:\n请输入开户帐号.");
				document.form1.BankCard.focus();
				return false;
			}
			if(BankUserName.length == 0){
				alert("温馨提示:\n请输入开户姓名.");
				document.form1.BankUserName.focus();
				return false;
			}
			if(BankAddress.length == 0){
				alert("温馨提示:\n请输入开户地址.");
				document.form1.BankAddress.focus();
				return false;
			}
			
			return true;
		}
</script>
<script language='JavaScript'> 
function get() 
{ 
   var n=document.getElementById('UserName').value; 
   document.getElementById("BankUserName").value=n; 
}
</script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	  <?php include 'header.php';?>
    
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
        	<div class="table2">
                <form method="post" name="form1" action="?" onsubmit="return CheckForm();">
            	<table>
                	<tr>
                        <td>编号：<?=$nickname?> <input type="hidden" name="nickname" id="nickname" value="<?=$nickname?>" readonly></td>
                    </tr>
                	<tr>
                		<?php $ul = ulevel($member['ulevel']);?>
                    	<td>等级：<?php echo $ul['lvname'];?></td>
                    </tr>
                	
                	<tr>
                    	<td>注册时间：<?php echo $member['rdt'];?></td>
                    </tr>
                    <tr>
                    	<td>激活时间：<?php echo $member['pdt'];?></td>
                    </tr>
                    <tr>
                        <td>姓名：<?=$UserName?> <input type="hidden" name="UserName" id="UserName" value="<?=$UserName?>" ></td>
                    </tr>
                	<tr>
                        <td>身份证：<?=$UserCard?> <input type="hidden" name="UserCard" id="UserCard" readonly value="<?=$UserCard?>"></td>
                    </tr>
                	<tr>
                    	<td>推荐人：<?php echo $member['rname'];?></td>
                    </tr>
                </table>
<!--                <table>
                	<tr>
                    	<td>剩余收入：<?php echo $member['mey'];?></td>
                    </tr>
                	<tr>
                    	<td>累计收入：<?php echo $member['maxmey'];?></td>
                    </tr>
                	<tr>
                    	<td>注册金额：<?php echo $member['lsk'];?></td>
                    </tr>
                	<tr>
                    	<td>团队业绩：<?php echo $member['area1']+$member['area2'];?></td>
                    </tr>
                </table>-->
                <table>
                    <tr>
                    	<td>手机号码：<input type="text"  name="UserTel" id="UserTel" value="<?=$UserTel?>"></td>
                    </tr>
                    <tr>
                    	<td>
                        	
                           
                            <div id="demo1" class="citys">
                收货地区：
                    <script type="text/javascript" src="js/jsAddress.js"></script>
                    <select style=" width: 100px;" id="province" name="province" ></select>
                    <select style=" width: 100px;" id="city" name="city"></select>
                    <select style=" width: 100px;" id="area" name="area" ></select>


                    <script type="text/javascript">
                        addressInit('province', 'city', 'area','<?=$sheng?>','<?=$shi?>','<?=$xian?>');
                    </script>
              
            </div>
                        </td>
                       
                    </tr>
                    <tr>
                    	<td>收货地址：<input type="text"  name="UserAddress" id="UserAddress" value="<?=$UserAddress?>"></td>
                    </tr>
                    </table>
                <table>
                	<tr>
                    	<td>开户银行：<select name="BankName" id="BankName">
									<option value="-1">选择开户银行</option>
                                    <?php
                                        $arr= getAll("select bankname from bankname order by shunxu");
                                        foreach ($arr as $key =>$row){ 
                                    ?>
                                    <option value="<?=$row['bankname']?>" <?php if($BankName==$row['bankname']){?>selected<?php } ?>><?=$row['bankname']?></option>
                                     <?php
                                        }
                                    ?>
									</select></td>
                    </tr>
                	<tr>
                    	<td>开户卡号：<input type="text"  name="BankCard" id="BankCard" value="<?=$BankCard?>"></td>
                    </tr>
                	<tr>
                    	<td>开户地址：<input type="text"  name="BankAddress" id="BankAddress" value="<?=$BankAddress?>"></td>
                    </tr>
                	<tr>
                    	<td>开户姓名：<input type="text"  name="BankUserName" id="BankUserName" value="<?=$BankUserName?>"></td>
                    </tr>
                	
                	
                </table>
                 <ul class="list3">
                	
                	<li class="on"><input type="submit" id="submit" name="submit" class="button_green" value="修  改"></li>
                    <li><a href="javascript:history.go(-1);">返回</a></li>
                </ul>
                </form>
            </div>
               
        </div>
        
        <br/><br/>
    </section><!-- #BeginLibraryItem "/Library/footer.lbi" -->
    <?php include 'footer.php';?>
</body>
</html>