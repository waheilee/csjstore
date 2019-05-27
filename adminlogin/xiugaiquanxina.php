<?php
include_once("../class/admin_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
	if($_SESSION['admin_id']){
		if($_SESSION['admin_id']==1){
			alert('超级管理员禁止修改权限.','');
		}else{
			$_admin=new admin_class();
			if($admin_us=$_admin->getadminbyid($_SESSION['admin_id'])){
				$zq1=$admin_us['zq1'];
				$zq2=$admin_us['zq2'];
				$zq3=$admin_us['zq3'];
				$zq4=$admin_us['zq4'];
				$zq5=$admin_us['zq5'];
				$zq6=$admin_us['zq6'];
				$zq7=$admin_us['zq7'];
				$zq8=$admin_us['zq8'];
				$zq9=$admin_us['zq9'];
				$zq10=$admin_us['zq10'];
				$q1=$admin_us['q1'];
				$q2=$admin_us['q2'];
 				$q3=$admin_us['q3'];
				$q4=$admin_us['q4'];
				$q5=$admin_us['q5'];
				$q6=$admin_us['q6'];
				$q7=$admin_us['q7'];
				$q8=$admin_us['q8'];
				$q9=$admin_us['q9'];
				$q10=$admin_us['q10'];
				$q11=$admin_us['q11'];
				$q12=$admin_us['q12'];
				$q13=$admin_us['q13'];
				$q14=$admin_us['q14'];
				$q15=$admin_us['q15'];
				$q16=$admin_us['q16'];
				$q17=$admin_us['q17'];
				$q18=$admin_us['q18'];
				$q19=$admin_us['q19'];
				$q20=$admin_us['q20'];
				$q21=$admin_us['q21'];
				$q22=$admin_us['q22'];
				$q23=$admin_us['q23'];
				$q24=$admin_us['q24'];
				$q25=$admin_us['q25'];
				$q26=$admin_us['q26'];
				$q27=$admin_us['q27'];
				$q28=$admin_us['q28'];
				$q29=$admin_us['q29'];
				$q30=$admin_us['q30'];
				$q31=$admin_us['q31'];
				$q32=$admin_us['q32'];
				$q33=$admin_us['q33'];
				$q34=$admin_us['q34'];
				$q35=$admin_us['q35'];
			}else{
				alert('访问出错,该管理员不存在.','');		
			}	
		}
	}else{
		alert('访问出错,请从权限管理页面进入.','');	
	}


	
if ($_POST['submit']){
	if($_POST['admin_id']){
		$admin_update["zq1"]=$_POST['zq1'];
		$admin_update["zq2"]=$_POST['zq2'];
		$admin_update["zq3"]=$_POST['zq3'];
		$admin_update["zq4"]=$_POST['zq4'];
		$admin_update["zq5"]=$_POST['zq5'];
		$admin_update["zq6"]=$_POST['zq6'];
		$admin_update["zq7"]=$_POST['zq7'];
		$admin_update["zq8"]=$_POST['zq8'];
		$admin_update["zq9"]=$_POST['zq9'];
		$admin_update["zq10"]=$_POST['zq10'];
		$admin_update["q1"]=intval($_POST['q1']);
		$admin_update["q2"]=intval($_POST['q2']);
		$admin_update["q3"]=intval($_POST['q3']);
		$admin_update["q4"]=intval($_POST['q4']);
		$admin_update["q5"]=intval($_POST['q5']);
		$admin_update["q6"]=intval($_POST['q6']);
		$admin_update["q7"]=intval($_POST['q7']);
		$admin_update["q8"]=intval($_POST['q8']);
		$admin_update["q9"]=intval($_POST['q9']);
		$admin_update["q10"]=intval($_POST['q10']);
		$admin_update["q11"]=intval($_POST['q11']);
		$admin_update["q12"]=intval($_POST['q12']);
		$admin_update["q13"]=intval($_POST['q13']);
		$admin_update["q14"]=intval($_POST['q14']);
		$admin_update["q15"]=intval($_POST['q15']);
		$admin_update["q16"]=intval($_POST['q16']);
		$admin_update["q17"]=intval($_POST['q17']);
		$admin_update["q18"]=intval($_POST['q18']);
		$admin_update["q19"]=intval($_POST['q19']);
		$admin_update["q20"]=intval($_POST['q20']);
		$admin_update["q21"]=intval($_POST['q21']);
		$admin_update["q22"]=intval($_POST['q22']);
		$admin_update["q23"]=intval($_POST['q23']);
		$admin_update["q24"]=intval($_POST['q24']);
		$admin_update["q25"]=intval($_POST['q25']);
		$admin_update["q26"]=intval($_POST['q26']);
		$admin_update["q27"]=intval($_POST['q27']);
		$admin_update["q28"]=intval($_POST['q28']);
		$admin_update["q29"]=intval($_POST['q29']);
		$admin_update["q30"]=intval($_POST['q30']);
		$admin_update["q31"]=intval($_POST['q31']);
		$admin_update["q32"]=intval($_POST['q32']);
		$admin_update["q33"]=intval($_POST['q33']);
		$admin_update["q34"]=intval($_POST['q34']);
		$admin_update["q35"]=intval($_POST['q35']);
		$_admin->admin_update($admin_update,$_POST['admin_id']);
		alert("权限修改成功.","?");
	}else{
		alert("提交错误,请重新再试.","admin_Administrator.php");	
	}
}
function display($qx){
	$sx="style='display:none'";
	if($qx==1){
		$sx="";
	}
	return $sx;
}

function checked($qx){
	if($qx==1){
		return "checked";
	}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>设置权限</title>
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/xitongshezhi.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
<script>
$(function(){
		$("input[class=hour]").blur(function(){
			var reg=/^([0-9]|1[0-9]|2[0-4]){1}(:[0-5][0-9]){0,1}$/;
			if(reg.test(this.value)){
				
			}else{
				this.value="";
				
			}
		})
	


})


</script>
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
<div id="container">
    <!-- #BeginLibraryItem "/Library/header.lbi" -->
   <?php include 'header.php';?>
    <!-- #EndLibraryItem -->
<section id="main" class="clearfix">
        <!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
        <?php include 'left.php';?>
        <!-- #EndLibraryItem -->
<div id="conts" cl ass="heightLine-1">
            <!-- #BeginLibraryItem "/Library/title.lbi" -->
           <?php include 'title.php';?>
            <!-- #EndLibraryItem -->
<div class="mainBox"><form name="form1" method="post" action="?" >
            	<h2>权限设置</h2>
               
                <div class="table1 table">
                    <table>
                    	<tr>
    <td colspan="4" align="center">管理员<?=$admin_us['loginname']?>权限设置<input name="admin_id" type="hidden" value="<?=$admin_us['id']?>"></td>
    </tr>
    <tr>
    <td width="50%" align="right">会员管理：</td>
    <td width="50%" align="left">
    <input name="zq1" type="radio" id="zq1" value="1"  <?=checked($zq1)?>>
    开
    <input type="radio" name="zq1" id="zq1" value="0" checked>
    关
    
     </td>
      <td colspan="2" align="center">
  		<input name="q1" type="checkbox" id="q1" value="1" <?=checked($q1)?>>
                激活会员
        <input name="q2" type="checkbox" id="q2" value="1" <?=checked($q2)?>>
                正式会员
<!--        <input name="q3" type="checkbox" id="q3" value="1" <?=checked($q3)?>>
                升级申请-->
        <input name="q4" type="checkbox" id="q4" value="1" <?=checked($q4)?>>
                激活记录
<!--        <input  name="q5" type="checkbox" id="q5" value="1" <?=checked($q5)?>>
                升级记录-->
        <input  name="q6" type="checkbox" id="q6" value="1" <?=checked($q6)?>>
                操作记录
    </td>
  </tr>
  
    <tr>
    <td width="50%" align="right">财务管理：</td>
    <td width="50%" align="left">
    <input name="zq2" type="radio" id="zq2" value="1"  <?=checked($zq2)?>>
开
    <input type="radio" name="zq2" id="zq2" value="0" checked>
关
   </td>
     <td colspan="2" align="center">
        <input  name="q9" type="checkbox" id="q9" value="1" <?=checked($q9)?>>
        会员升级
        <input  name="q10" type="checkbox" id="q10" value="1" <?=checked($q10)?>>
       充值管理
       <input name="q11" type="checkbox" id="q11" value="1" <?=checked($q11)?>>
       提现管理
       <input name="q12" type="checkbox" id="q12" value="1" <?=checked($q12)?>>
       转账记录
<!--       
<input  name="q31" type="checkbox" id="q31" value="1" <?=checked($q31)?>>
股东分红结算 


   
      董事分红
   <input  name="q31" type="checkbox" id="q31" value="1" <?=checked($q5)?>>
      精品分红
   <input  name="q32" type="checkbox" id="q32" value="1" <?=checked($q5)?>>
      收藏分红
   <!-- <input  name="q33" type="checkbox" id="q33" value="1" <?=checked($q5)?>>
      展厅分红 
  <!-- <input  name="q6" type="checkbox" id="q6" value="1" <?=checked($q6)?>>
         借款申请 
   	<input  name="q7" type="checkbox" id="q7" value="1" <?=checked($q7)?>>
         
    <input  name="q8" type="checkbox" id="q8" value="1" <?=checked($q8)?>>
       充值管理
    
       
        -->
	 
    
	</td>
  </tr>
  
    <tr>
    <td width="50%" align="right">数据统计：</td>
    
    <td width="50%" align="left">
    <input name="zq3" type="radio" id="zq3" value="1"  <?=checked($zq3)?>>
    开
    <input type="radio" name="zq3" id="zq3" value="0" checked>
    关
   </td>
      <td colspan="2" align="center">
    <input name="q14" type="checkbox" id="q14" value="1" <?=checked($q14)?>>
	积分总表
    <input name="q15" type="checkbox" id="q15" value="1" <?=checked($q15)?>>
	积分明细
	<input name="q16" type="checkbox" id="q16" value="1" <?=checked($q16)?>>
	会员统计
    <input name="q17" type="checkbox" id="q17" value="1" <?=checked($q17)?>>
   	 收支统计
    <input name="q18" type="checkbox" id="q18" value="1" <?=checked($q18)?>>
    业绩统计
<!--    <input name="q13" type="checkbox" id="q13" value="1" <?=checked($q13)?>>
    本月排名-->
    <input name="q19" type="checkbox" id="q19" value="1" <?=checked($q19)?>>
   	数据排行
   	</td>
  </tr>
  
    <tr  >
    <td width="50%" align="right">商城管理：</td>
    <td width="50%" align="left">
    <input name="zq4" type="radio" id="zq4" value="1"  <?=checked($zq4)?>>
开
    <input type="radio" name="zq4" id="zq4" value="0" checked>
关
  </td>
    <td colspan="2" align="center">
    <input name="q20" type="checkbox" id="q20" value="1" <?=checked($q20)?>>
	添加商品
	 <input name="q21" type="checkbox" id="q21" value="1" <?=checked($q21)?>>
  	商品管理
  	<!--  <input name="q22" type="checkbox" id="q22" value="1" <?=checked($q22)?>>
  	类别管理-->
    <input name="q23" type="checkbox" id="q23" value="1" <?=checked($q23)?>>
   	订单管理
   	<input name="q24" type="checkbox" id="q24" value="1" <?=checked($q24)?>>
   	匹配管理
    </td>
  </tr>
<!--   <tr>
    <td width="50%" align="right">库存管理：</td>
    <td width="50%" align="left">
    <input name="zq9" type="radio" id="zq9" value="1"  <?=checked($zq9)?>>
开
    <input type="radio" name="zq9" id="zq9" value="0" checked>
关
   </td>
    <td colspan="2" align="center">
    <input name="q25" type="checkbox" id="q25" value="1" <?=checked($q25)?>>
    入库登记、进销记录

</td>
  </tr>-->
   
    <tr>
    <td width="50%" align="right">信息管理：</td>
    <td width="50%" align="left">
    <input name="zq5" type="radio" id="zq5" value="1"  <?=checked($zq5)?>>
开 
    <input type="radio" name="zq5" id="zq5" value="0" checked>
关
  </td>
  <td colspan="2" align="center">
    <input name="q26" type="checkbox" id="q26" value="1" <?=checked($q26)?>>
    添加新闻
    <input name="q27" type="checkbox" id="q27" value="1" <?=checked($q27)?>>
  	新闻管理
 	<!-- 
 	公司账户 -->
 	<input name="q28" type="checkbox" id="q28" value="1" <?=checked($q28)?>>
 	添加轮播图
 	<input name="q29" type="checkbox" id="q29" value="1" <?=checked($q29)?>>
 	轮播管理
 
 	

</td>
  </tr>
  
    <tr>
    <td width="50%" align="right">系统设置：</td>
    <td width="50%" align="left">
    <input name="zq6" type="radio" id="zq6" value="1"  <?=checked($zq6)?>>
开
    <input type="radio" name="zq6" id="zq6" value="0" checked>
关
   </td>
    <td colspan="2" align="center">
    <input name="q30" type="checkbox" id="q30" value="1" <?=checked($q30)?>>
	会员设置
    <input name="q31" type="checkbox" id="q31" value="1" <?=checked($q31)?>>
    银行列表
    <input name="q32" type="checkbox" id="q32" value="1" <?=checked($q32)?>>
    系统参数
    <input name="q33" type="checkbox" id="q33" value="1" <?=checked($q33)?>>
    权限管理
	 
    
	
    
    </td>
  </tr>
  
    <tr>
    <td width="50%" align="right">数据管理：</td>
    <td width="50%" align="left">
    <input name="zq7" type="radio" id="zq7" value="1"  <?=checked($zq7)?>>
开
    <input type="radio" name="zq7" id="zq7" value="0" checked>
关
   </td>
    <td colspan="2" align="center">
        <input name="q24" type="checkbox" id="q24" value="1" <?=checked($q24)?>>
	导入数据
    <input name="q34" type="checkbox" id="q34" value="1" <?=checked($q34)?>>
	数据备份
  <input name="q35" type="checkbox" id="q35" value="1" <?=checked($q35)?>>
  清空数据
    </td>
  </tr>
 
<!--  	<tr id="qx1" <?=display($zq1)?>>
    <td colspan="2" align="center">
  		<input name="q1" type="checkbox" id="q1" value="1" <?=checked($q1)?>>
                激活会员
        <input name="q2" type="checkbox" id="q2" value="1" <?=checked($q2)?>>
                正式会员
        <input name="q3" type="checkbox" id="q3" value="1" <?=checked($q3)?>>
                升级申请
        <input name="q4" type="checkbox" id="q4" value="1" <?=checked($q4)?>>
                激活记录
        <input  name="q5" type="checkbox" id="q5" value="1" <?=checked($q5)?>>
                升级记录
        <input  name="q6" type="checkbox" id="q6" value="1" <?=checked($q6)?>>
                操作记录
    </td>
       
  </tr>-->
<!--  <tr id="qx2" <?=display($zq2)?>>
    <td colspan="2" align="center">
        <input  name="q9" type="checkbox" id="q9" value="1" <?=checked($q9)?>>
        奖金结算
        <input  name="q10" type="checkbox" id="q10" value="1" <?=checked($q10)?>>
       充值管理
       <input name="q11" type="checkbox" id="q11" value="1" <?=checked($q11)?>>
       提现管理
       <input name="q12" type="checkbox" id="q12" value="1" <?=checked($q12)?>>
       转账记录

    
	</td>
    </tr>-->
<!--    <tr id="qx3" <?=display($zq3)?>>
    <td colspan="2" align="center">
    <input name="q14" type="checkbox" id="q14" value="1" <?=checked($q14)?>>
	积分总表
    <input name="q15" type="checkbox" id="q15" value="1" <?=checked($q15)?>>
	积分明细
	<input name="q16" type="checkbox" id="q16" value="1" <?=checked($q16)?>>
	会员统计
    <input name="q17" type="checkbox" id="q17" value="1" <?=checked($q17)?>>
   	 收支统计
    <input name="q18" type="checkbox" id="q18" value="1" <?=checked($q18)?>>
    业绩统计
    <input name="q13" type="checkbox" id="q13" value="1" <?=checked($q13)?>>
    本月排名
    <input name="q19" type="checkbox" id="q19" value="1" <?=checked($q19)?>>
   	数据排行
   	</td>
    </tr>-->

<!--    <tr id="qx4" <?=display($zq4)?>  >
    <td colspan="2" align="center">
    <input name="q20" type="checkbox" id="q20" value="1" <?=checked($q20)?>>
	添加商品
	 <input name="q21" type="checkbox" id="q21" value="1" <?=checked($q21)?>>
  	商品管理
  	<input name="q22" type="checkbox" id="q22" value="1" <?=checked($q22)?>>
  	类别管理
    <input name="q23" type="checkbox" id="q23" value="1" <?=checked($q23)?>>
   	订单管理
    </td>
    </tr>-->
<!--<tr id="qx9" <?=display($zq9)?>>
    <td colspan="2" align="center">
    <input name="q25" type="checkbox" id="q25" value="1" <?=checked($q25)?>>
    入库登记、进销记录

</td>
   </tr>-->
  <!--   <tr id="qx5" <?=display($zq5)?>>
    <td colspan="2" align="center">
    <input name="q26" type="checkbox" id="q26" value="1" <?=checked($q26)?>>
    添加新闻
    <input name="q27" type="checkbox" id="q27" value="1" <?=checked($q27)?>>
  	新闻管理
 	 
 	公司账户 
 	<input name="q28" type="checkbox" id="q28" value="1" <?=checked($q28)?>>
 	添加轮播图
 	<input name="q29" type="checkbox" id="q29" value="1" <?=checked($q29)?>>
 	轮播管理
 
 	

</td>
    </tr>-->
<!--    <tr id="qx6" <?=display($zq6)?>>
    <td colspan="2" align="center">
    <input name="q30" type="checkbox" id="q30" value="1" <?=checked($q30)?>>
	会员设置
    <input name="q31" type="checkbox" id="q31" value="1" <?=checked($q31)?>>
    银行列表
    <input name="q32" type="checkbox" id="q32" value="1" <?=checked($q32)?>>
    系统参数
    <input name="q33" type="checkbox" id="q33" value="1" <?=checked($q33)?>>
    权限管理
	 
    
	
    
    </td>
    </tr>-->
<!--  <tr id="qx7" <?=display($zq7)?>>
    <td colspan="2" align="center">
        <input name="q24" type="checkbox" id="q24" value="1" <?=checked($q24)?>>
	导入数据
    <input name="q34" type="checkbox" id="q34" value="1" <?=checked($q34)?>>
	数据备份
  <input name="q35" type="checkbox" id="q35" value="1" <?=checked($q35)?>>
  清空数据
    </td>
    </tr>-->
                    </table>
                
                </div>
                  <input name="submit" id="submit" type="submit" class="btn2" value="修改">
            <input name="" type="reset" class="btn3" value="重置">
               
            </div>
        </div> </form>
    </section>
</div>
</body>
<script language="javascript">

<!--

function affirm(t)

{  

var ipt = document.getElementsByTagName("input");    

var i = 0;    

var allownum = 4;//定义最多能选择的个数   

for(var j = 0; j < ipt.length; j++)  

{       

if(ipt[j].type == "checkbox" && ipt[j].checked)       

i++;   

}    

if(i > allownum)    

{        

alert("你最多只能选择"+ allownum +"项！");        

t.checked = false;    

}


}

function sss()

{  

var ipt = document.getElementsByTagName("input");    

var i = 0;    


for(var j = 0; j < ipt.length; j++)  

{       

if(ipt[j].type == "checkbox" && ipt[j].checked)       

i++;   

}  


if(i === 0)    

{        

alert("请选择提现星期");        
return false;    

}

return true;
}

function lua(){
	var hh=document.getElementsByClassName("hour");
	var reg=/^([0-9]|1[0-9]|2[0-4]){1}(:[0-5][0-9]){0,1}$/;
	var jk;
	
	for(var c=0;c<=hh.length;c++){
	
		if(reg.test(hh[c].value)){
			jk++;
		}else{
			alert("请填写提现时间");
			hh[c].focus();
			return false;
		}
	}
	
	if(jk ==2){
		return true;
	}
}


//-->

</script>
</html>