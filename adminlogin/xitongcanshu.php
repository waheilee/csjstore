<?php
include("admin_check.php");
include_once("../class/system_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");


//checkqx(6,27);
	$_system=new system_class();
	$systemparameters=$_system->system_information(1);
    $time=unserialize($systemparameters['txtime']);
    $tx= getOne("select * from tx where id=1");
    $x1=$tx['x1'];
    $x2=$tx['x2'];
    $x3=$tx['x3'];
    $x4=$tx['x4'];
    $x5=$tx['x5'];
    $x6=$tx['x6'];
    $x0=$tx['x0'];
    
	$tupian=$_POST['goodsimg3'];
if($_POST['button']){
		$_system=new system_class();
		$systemparameters['id']=1;
		$systemparameters['txbs']=$_POST['txbs'];
		$systemparameters['url']=$_POST['url'];
		$systemparameters['txmix']=$_POST['txmix'];
		$systemparameters['txmax']=$_POST['txmax'];
		$systemparameters['txsl']=$_POST['txsl'];
		$systemparameters['txks']=$_POST['txks'];
		$systemparameters['wlf']=$_POST['wlf'];
		$systemparameters['xtkg']=$_POST['xtkg'];
		$systemparameters['azkg']=$_POST['azkg'];
		$systemparameters['tjkg']=$_POST['tjkg'];
		$systemparameters['ziliao']=$_POST['ziliao'];
		$systemparameters['ff']=$_POST['ff'];
		$systemparameters['ms']=$_POST['ms'];
		$systemparameters['bdbonus']=$_POST['bdbonus'];
		$systemparameters['isb2']=$_POST['cqu'];
		$systemparameters['isb3']=$_POST['isb3'];
		$systemparameters['shichangjia']=$_POST['shichangjia'];
		
		
		$systemparameters['qq1']=$_POST['qq1'];
		$systemparameters['qq2']=$_POST['qq2'];
		$systemparameters['qq3']=$_POST['qq3'];
		$systemparameters['qq4']=$_POST['qq4'];
		$systemparameters['qckai']=$_POST['qckai'];
		$systemparameters['password1']=$_POST['password1'];
		$systemparameters['password2']=$_POST['password2'];
		$systemparameters['sl']=$_POST['sl'];
		$systemparameters['zuo']=$_POST['zuo'];
		$systemparameters['zhong']=$_POST['zhong'];
		
		$systemparameters['num']=$_POST['num'];
		
	    $systemparameters['fwzx']=$_POST['fwzx'];
		$systemparameters['cardnum']=$_POST['cardnum'];
		$systemparameters['xianliang']=$_POST['xianliang'];
		$systemparameters['danwei']=$_POST['danwei'];
		$systemparameters['bli']=$_POST['bli'];
		$systemparameters['shui1']=$_POST['shui1'];
		$systemparameters['shui2']=$_POST['shui2'];
		if($_POST['goodsimg3']!=""){
		    $systemparameters['erwei']=$tupian;
		}
		if($_POST['tel']!=""){
		    $systemparameters['tel']=$_POST['tel'];
		}
		if($_POST['tel2']!=""){
		    $systemparameters['tel2']=$_POST['tel2'];
		}
		
//		$systemparameters['fhdw']=$_POST['fhdw'];
//		$systemparameters['shuishou']=$_POST['shuishou'];
//		$laoshi=array($_POST['time']);
		$systemparameters['txtime']=serialize($_POST['time']);
        $systemparameters['d1']=$_POST['d1'];
        if ($_POST['d2']>=1){
        $systemparameters['d2']=$_POST['d2'];
        }
        $systemparameters['d3']=$_POST['d3'];
        $systemparameters['bl']=$_POST['bl'];
        $systemparameters['pv']=$_POST['pv'];
        $systemparameters['dbl10']=$_POST['dbl10'];
//    $systemparameters['duanxinzhanghao']=$_POST['duanxinzhanghao'];
//    $systemparameters['duanxinmima']=$_POST['duanxinmima'];
//    $systemparameters['duanxinqianming']=$_POST['duanxinqianming'];
		$_system->system_update($systemparameters);
		$tx_update["x1"]=$_POST['x1'];
		$tx_update["x2"]=$_POST['x2'];
		$tx_update["x3"]=$_POST['x3'];
		$tx_update["x4"]=$_POST['x4'];
		$tx_update["x5"]=$_POST['x5'];
		$tx_update["x6"]=$_POST['x6'];
		$tx_update["x0"]=$_POST['x0'];
        // $_system->tx_update($tx_update);
        edit_update_cl('tx',$tx_update,1);
		alert('保存成功.','?');
}
if($_POST['button2']){
    if($_POST['url']){
        $URL=$_POST['url'];
        edit_sql("update systemparameters set url='{$URL}' where id=1");
        $ar0= getAll("select id,nickname,erweima from member where ispay>0");
        foreach ($ar0 as $key =>$row){
            //引入phpqrcode库文件
            include_once("../web2/phpqrcode.php");
            // 二维码数据
            $data = $URL.'/web2/register2.php.php?rname='.$row['nickname'];

            // 生成的文件名
            $filename = $row['id'].'.png';
            // 纠错级别：L、M、Q、H
            $errorCorrectionLevel = 'L';
            // 点的大小：1到10
            $matrixPointSize = 3;
            //创建一个二维码文件
            QRcode::png($data,'../upload2/'.$row['id'].'.png',$errorCorrectionLevel,$matrixPointSize,2);
            //输入二维码到浏览器
            //		QRcode::png($data);

            edit_sql("update member set erweima='".$row['id'].".png' where id='".$row['id']."'");
        }
    }
    alert('二维码更新成功.','?');
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
<title>系统参数</title>
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
<div class="mainBox"><form name="form1" method="post" action="?">
            	<h2>系统参数</h2>
               
                <div class="table1 table">
                    <table>
					
						<tr>
                        	<td>默认一级密码</td>
                            <td><input type="text"  name="password1" id="password1" value="<?=$systemparameters['password1']?>"/></td>
                        </tr>

						<tr>
                        	<td>默认二级密码</td>
                            <td><input type="text"  name="password2" id="password2" value="<?=$systemparameters['password2']?>"/></td>
                        </tr>
					<!-- 	<tr>
                            <td>转换特惠券比例(%)</td>
                            <td>
                                <input type="text"  name="bl" id="bl" value="<?=$systemparameters['bl']?>"/>%
                            </td>

                        </tr> -->
                        	<tr>
                        	<td>推广链接</td>
                            <td>
                                <input type="text"  name="url" id="url" value="<?=$systemparameters['url']?>"/>
                                <input name="button2" type="submit" id="button2" value="更新会员二维码" class="button"/>
                            </td>
                        </tr> 
                        <tr >
                            <td>编号前缀</td>
                            <td>
                                <input type="text"  name="qq4" id="qq4" value="<?=$systemparameters['qq4']?>"/>
                            </td>

                        </tr>
                        <tr >
                            <td>订单挂售时间</td>
                            <td>
                                <input type="text"  name="num" id="num" value="<?=$systemparameters['num']?>"/>天
                            </td>

                        </tr>
                     <tr >
                            <td>每天可买单数</td>
                            <td>
                                <input type="text"  name="d2" id="d2" value="<?=$systemparameters['d2']?>"/>单
                            </td>

                        </tr>   <!-- -->
                     <!--     <tr >
                            <td>服务中心报单(%)</td>
                            <td>
                                <input type="text"  name="d1" id="d1" value="<?=$systemparameters['d1']?>"/>%
                            </td>

                        </tr>
                      --> 
                        
                        <tr >
                            <td>每个手机号最大注册账户</td>
                            <td>
                                <input type="text"  name="ms" id="ms" value="<?=$systemparameters['ms']?>"/>个
                            </td>

                        </tr>
                         <tr >
                            <td>每个身份证最大注册账户</td>
                            <td>
                                <input type="text"  name="cardnum" id="cardnum" value="<?=$systemparameters['cardnum']?>"/>个
                            </td>

                        </tr> 
                        <tr >
                            <td>每天最多提现次数</td>
                            <td>
                                <input type="text"  name="xianliang" id="xianliang" value="<?=$systemparameters['xianliang']?>"/>次
                            </td>

                        </tr>
                        
                        <!-- <tr >
                            <td>客服电话</td>
                            <td>
                                <input type="text"  name="tel" id="tel" value="<?=$systemparameters['tel']?>"/>
                            </td>

                        </tr>
                        <tr >
                            <td>退货客服电话</td>
                            <td>
                                <input type="text"  name="tel2" id="tel2" value="<?=$systemparameters['tel2']?>"/>
                            </td>

                        </tr>
                        <tr>
   							<td>客服二维码</td>
                            <td class="even">
                            <iframe ID="UploadFiles3" src="UploadFiles3.php" frameborder=0 scrolling=no height="35" width="100%"></iframe></td>
                        </tr>
                         <script language="javascript">
                                function GetImgName3(){
                                    //根据iframe的id获取对象
                                    //var i1 = window.frames['UploadFiles'];
                                    //获取iframe中的元素值
                                    var i2=document.getElementById("UploadFiles3").contentWindow;

                                    var imgname=i2.document.getElementById("imgname3").value;


                                    document.getElementById("goodsimg3").value = imgname;
                                }

                        </script>
                        <tr>
                            <td>获取图片</td>
                            <td class="even">
                            <input name="goodsimg3" type="text" id="goodsimg3" style="width: 50%;" size="20" maxlength="50">
                                <input name="button" type="button" class="btn1" id="button" onClick="GetImgName3()" value="获取图片"></td>
                        </tr> -->
                        
                        
                         
                        <!--  <tr >
                            <td>复投单位</td>
                            <td>
                                <input type="text"  name="danwei" id="danwei" value="<?=$systemparameters['danwei']?>"/>元
                            </td>

                        </tr>
                         <tr >
                            <td>分红单位</td>
                            <td>
                                <input type="text"  name="fhdw" id="fhdw" value="<?=$systemparameters['fhdw']?>"/>元
                            </td>

                        </tr>--> 
<!--                        <tr>-->
<!--                            <td>短信账号</td>-->
<!--                            <td>-->
<!--                                <input type="text"  name="duanxinzhanghao" id="duanxinzhanghao" value="--><?//=$systemparameters['duanxinzhanghao']?><!--"/>-->
<!--                            </td>-->
<!---->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>短信密匙</td>-->
<!--                            <td>-->
<!--                                <input type="text"  name="duanxinmima" id="daunxinmima" value="--><?//=$systemparameters['duanxinmima']?><!--"/>-->
<!--                            </td>-->
<!---->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>短信签名</td>-->
<!--                            <td>-->
<!--                                <input type="text"  name="duanxinqianming" id="duanxinqianming" value="--><?//=$systemparameters['duanxinqianming']?><!--"/>-->
<!--                            </td>-->
<!---->
<!--                        </tr>-->
 <!--                       <tr>
                           <td>开第三区条件</td>
                           <td> 左区业绩<input type="text"  name="zuo" id="zuo" value="<?=$systemparameters['zuo']?>"/><br>中区业绩<input type="text"  name="zhong" id="zhong" value="<?=$systemparameters['zhong']?>"/>
                                                  
                             -->                      
                                                   
                            
                            </td>
                        </tr>
                        <tr>
                        	<td>提现最小金额</td>
                        	<td>
                            	<input type="text"  name="txmix" id="txmix" value="<?=$systemparameters['txmix']?>"/>
                            </td>
                        	
                        </tr>
                        <tr>
                            <td>提现倍数</td>
                            <td><input type="text"  name="txbs" id="txbs" value="<?=$systemparameters['txbs']?>"/></td>
                        </tr>
						 <tr>
                        	<td>提现最大金额</td>
                        	<td>
                            	<input type="text"  name="txmax" id="txmax" value="<?=$systemparameters['txmax']?>"/>
                            </td>
                        	
                        </tr>
						
<!--                        <tr>
                        	<td>手续费(%)</td>
                        	<td><input type="text" name="txsl" id="txsl" value="<?=$systemparameters['txsl']?>"/></td>
                        </tr>-->
                       <!--  <tr>
                        	<td>批发区产品售卖价格倍数</td>
                        	<td><input type="text" name="shui1" id="shui1" value="<?=$systemparameters['shui1']?>"/></td>
                        </tr>
                          <tr>
                        	<td>平台管理费(%)</td>
                        	<td><input type="text" name="shui2" id="shui2" value="<?=$systemparameters['shui2']?>"/></td>
                        </tr> -->
<!--                        <tr>-->
<!--                        	<td>转换手续费</td>-->
<!--                        	<td><input type="text"  name="txks" id="txks" value="--><?//=$systemparameters['txks']?><!--"/></td>-->
<!--                        </tr>

 -->
                        <tr>
                        	<td>系统开关</td>
                            <td>
                            	<div class="box">
                                	
                                    <input type="radio" name="xtkg" id="xtkg" value="1" <?php if($systemparameters['xtkg']==1){ ?> checked <?php }?>/>
                                    开
                                    <i></i>
                                </div>
<!--                            	<div class="box">
                                	
                                    <input type="radio" name="xtkg" value=""/>维护
                                    <i></i>
                                </div>-->
                            	
                            	<div class="box">
                                	
                                    <input type="radio" name="xtkg" value="0" id="xtkg" <?php if($systemparameters['xtkg']==0){ ?> checked <?php }?>/>
                                    关
                                    <i></i>
                                </div>
                            </td>
                        </tr>

<!-- 
                        <tr>
                            <td>短信开关</td>
                            <td>
                                <div class="box">

                                    <input type="radio" name="dbl10" id="dbl10" value="1" <?php if($systemparameters['dbl10']==1){ ?> checked <?php }?>/>开
                                    <i></i>
                                </div>
                                <div class="box">

                                    <input type="radio" name="dbl10" value="0" id="dbl10" <?php if($systemparameters['dbl10']==0){ ?> checked <?php }?>/>关闭
                                    <i></i>
                                </div>
                            </td>
                        </tr>
      <tr>
                        	<td>提现开关</td>
                            <td>
                            	<div class="box">
                                	
                            		<input type="radio" name="isb3" value="1" id="isb3" <?php if($systemparameters['isb3']==1){ ?> checked <?php }?>/>开
                                    <i></i>
                                </div>
                            	<div class="box">
                                	
                            		<input type="radio" name="isb3" id="isb3" value="0"  <?php if($systemparameters['isb3']==0){ ?> checked <?php }?>/>关闭
                                    <i></i>
                                </div>
                                
                            	
                            </td>
                        </tr>
                        -->
                   
                       
                       
                       
                        
                        
                        <tr>
                        	<td>推荐图开关</td>
                            <td>
                            <div class="box">
                            	
                            	<input type="radio" name="tjkg" id="tjkg" value="1" <?php if($systemparameters['tjkg']==1){ ?> checked <?php }?>>
开
                                <i></i>
                            </div>
                            <div class="box">
                            	
                            	<input type="radio" name="tjkg" id="tjkg" value="0" <?php if($systemparameters['tjkg']==0){ ?> checked <?php }?>>
    关
                                <i></i>
                            </div>
                            	
                                
                            	
                            </td>
                        </tr>
						 
 
                        <tr>
                        	<td>修改资料开关</td>
                            <td>
                            <div class="box">
                            	
                            	<input type="radio" name="ziliao" id="ziliao" value="1" <?php if($systemparameters['ziliao']==1){ ?> checked <?php }?>>
开
                                <i></i>
                            </div>
                            <div class="box">
                            	
                            	<input type="radio" name="ziliao" id="ziliao" value="0" <?php if($systemparameters['ziliao']==0){ ?> checked <?php }?>>
    关
                                <i></i>
                            </div>
                            </td>
                        </tr>
                      
                       <tr>
                        	<td>提现日</td>
                            <td>
                            	<input name="x1" type="checkbox" id="x1" value="1" <?=checked($x1)?>>
                                周一 /
                                <input name="x2" type="checkbox" id="x2" value="1" <?=checked($x2)?>>
                                周二 /
                              <input name="x3" type="checkbox" id="x3" value="1" <?=checked($x3)?>>
                               周三 /
                               <input name="x4" type="checkbox" id="x4" value="1" <?=checked($x4)?>>
                               周四 /
                               <input name="x5" type="checkbox" id="x5" value="1" <?=checked($x5)?>>
                               周五 /
                               <input name="x6" type="checkbox" id="x6" value="1" <?=checked($x6)?>>
                               周六 /
                               <input name="x0" type="checkbox" id="x0" value="1" <?=checked($x0)?>>
                               周日

                            </td>
                        </tr> 
                      
                    </table>
                
                </div>
                    <input name="button" type="submit" id="button" value="保存" class="button"/>
               
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