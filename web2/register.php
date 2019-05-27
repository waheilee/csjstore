<!DOCTYPE html>
<?php
include_once("../class/ulevel_class.php");
include_once("../class/system_class.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
$member=getMemberbyID($_SESSION['ID']);
$isbd=$member['isbd'];
$sys= getsys();
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
<?php //echo 'code2:'.$_SESSION['code2'],'code_time2:'.$_SESSION['code_time2'];?>
    <script type="text/javascript">
        /*-------------------------------------------*/
        var InterValObj; //timer变量，控制时间
        var count = 600; //间隔函数，1秒执行
        var curCount;//当前剩余秒数
        var code = ""; //验证码
        var codeLength = 6;//验证码长度
        function sendMessage() {
            curCount = count;
            var dealType; //验证方式
            var UserID=$("#userid").val();//用户uid
// 			    var jbPhoneTip = $("#jbPhoneTip").text();
            var UserTel=$("#phone").val();	//alert(UserTel);
            //产生验证码
            for (var i = 0; i < codeLength; i++) {
                code += parseInt(Math.random() * 9).toString();
            }
            //设置button效果，开始计时
            $("#btnSendCode").attr("disabled", "true");
            $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
            InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
            //向后台发送处理数据
            $.ajax({
                type: "POST", //用POST方式传输
                dataType: "text", //数据格式:JSON
                url: 'send2.php', //目标地址
                data:  "&UserTel=" + UserTel + "&sb=1",
                error: function (XMLHttpRequest, textStatus, errorThrown) { },
                success: function (msg){//msg:返回值
//                         alert( "Data Saved: " + msg );
                    alert( "发送成功，请注意查收");
                }
            });
        }
        //timer处理函数
        function SetRemainTime() {
            if (curCount == 0) {
                window.clearInterval(InterValObj);//停止计时器
                $("#btnSendCode").removeAttr("disabled");//启用按钮
                $("#btnSendCode").val("重新发送验证码");
                code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效

            }
            else {
                curCount--;
                $("#btnSendCode").val("请在" + curCount + "秒内输入验证码");
            }
        }

function CheckForm(){
    rname=document.form.rname.value;//推荐编号
    username=document.form.username.value;//会员姓名
    ulevel=document.form.ulevel.value;//会员等级
    

    
    useraddress=document.form.useraddress.value;//详细地址
    //rusername=document.form.rusername.value;//邀请人
    //province=document.form.province.value;//省市县
    
    
    password1=document.form.password1.value;
    password12=document.form.password12.value;
    password2=document.form.password2.value;
    password22=document.form.password22.value;
    //prov=document.form.prov.value;
    //city=document.form.city.value;
    //area=document.form.area.value;

    if(rname.length == 0){
        alert("温馨提示:\n请输入推荐编号");
        document.form.rname.focus();
        return false;
    }
    if(username.length == 0){
        alert("温馨提示:\n请输入会员姓名");
        document.form.username.focus();
        return false;
    }
    
    if(ulevel == 0){
        alert("温馨提示:\n请选择会员等级");
        document.form.ulevel.focus();
        return false;
    }

    if(useraddress.length == 0){
        alert("温馨提示:\n请输入收货地址");
        document.form.useraddress.focus();
        return false;
    }
    if(password1.length == 0){
        alert("温馨提示:\n请输入登录密码");
        document.form.password1.focus();
        return false;
    }
    if(password1.length <= 5){
        alert("温馨提示:\n登录密码不能小于6位");
        document.form.password1.focus();
        return false;
    }
    if(password12.length == 0){
        alert("温馨提示:\n请确认登录密码");
        document.form.password12.focus();
        return false;
    }
    if(password12 != password1){
        alert("温馨提示:\n两次登录密码输入不一致");
        document.form.password12.focus();
        return false;
    }
    if(password2.length == 0){
        alert("温馨提示:\n请输入安全密码");
        document.form.password2.focus();
        return false;
    }
    if(password2.length <= 5){
        alert("温馨提示:\n安全密码不能小于6位");
        document.form.password2.focus();
        return false;
    }
    if(password22.length == 0){
        alert("温馨提示:\n请确认安全密码");
        document.form.password22.focus();
        return false;
    }
    if(password22 != password2){
        alert("温馨提示:\n两次安全密码输入不一致");
        document.form.password22.focus();
        return false;
    }
    
   if(province == ""){
        alert("温馨提示:\n请选择身份");
        document.form.province.focus();
        return false;
    }
//    var match =/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/;
//    if(!match.test(usercard)){
//        alert("温馨提示:\n请输入有效的身份证号码");
//        document.form.usercard.focus();
//        return false;
//    }
    
//    if(rusername.length == 0){
//        alert("温馨提示:\n邀请码不存在，请检查邀请码.");
//        document.form.rname.focus();
//        return false;
//    }
//    if(province == ""){
//        alert("温馨提示:\n请选择户籍地区.");
//        document.form.province.focus();
//        return false;
//    }
//    
//    
    
    return true;
}
    </script>

</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	  <?php include 'header.php';?>
    
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
            <form id="form" name="form" action="zhuce.php" method="post" onSubmit="return CheckForm();">
                <div class="table3">
                    <table>
                    	<?php
                            $sql="SELECT id,isbd,bdname,nickname FROM member where nickname='".$_SESSION['nickname']."'";
                            $uss = getOne($sql);
//                            if ($_GET['nickname']!=null){$fathername=$_GET['nickname'];}else {$fathername=$uss['nickname'];}
                            if ($_GET['rname']!=null){$rname=$_GET['rname'];}else {$rname=$uss['nickname'];}
//                            if ($_GET['bdname']!=null){$bdname=$_GET['bdname'];}else { if($uss['isbd']==2){$bdname=$_SESSION['nickname'];}else {$bdname=$uss['bdname'];}}	
                        ?>
                        <tr>
                            <td><strong>推荐编号</strong></td>
                        </tr>
                        <tr>
                            <td>
                               <input type="text" id="rname" name="rname" placeholder="请输入推荐编号" value="<?=$rname?>" onBlur="Check('rname');"  >
                            </td>
                        </tr>
                        <tr>
                            <?php
                            if ($_GET['userid']==null){
                                $userid=$sys['qq4']. rand(10000000,99999999);//编号
                            }else {
                                $userid=$_GET['userid'];
                            }
                            ?>
                            <td><strong>会员编号</strong></td>
                        </tr>
                        <tr>
                            <td>
                                 <input type="text" id="userid" name="userid" placeholder="请输入会员编号" value="<?=$userid?>"   onKeypress="javascript:if(event.keyCode == 32)event.returnValue = false;"/>
                            </td>
                        </tr>
                          <tr>
                            <td><strong>服务中心</strong></td>
                        </tr> 
                         <tr>
                            <td>
                                <input type="text" id="bdname" name="bdname" placeholder="请输入服务中心" value="admin" onBlur="Check('bdname');">
                            </td>
                        </tr> 
                        <tr>
                            <td><strong>真实姓名</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" id="username" placeholder="请输入真实姓名" value="<?=$_GET['username']?>" onBlur="Check('username');" name="username" />
                            </td>
                        </tr>
<!--  
          				 <tr>
                            <td><strong>联系地址</strong></td>
                        </tr>
                        <tr>
                            <td>
                             <script type="text/javascript" src="js/jquery.citys.js"></script>
                             <div id="demo1" class="citys" >
                               <p>
                				<select style=" width: 250px;" name="province" ></select>
                				<select style=" width: 250px;" name="city"></select>
                				<select style=" width: 250px;" name="area" ></select>
                			    </p>
                			    </div>
                			    	<script type="text/javascript">
            					$('#demo1').citys({valueType:'name',province:'0',city:'0',area:'0'});
        					</script>
                            </td>
                        </tr>
               -->       
                        
                        <tr style="display:none">
                            <td><strong>会员等级</strong></td>
                        </tr>
                        <tr style="display:none">
                            <td>
                            	<select  id="ulevel" name="ulevel" >
<!--                                    <option value="0">=请选择会员等级=</option>-->
                                    <?php
                                    $_ulevel=new ulevel_class();
                                    $arr=getAll("select id,ulevel,lvname,lsk from ulevel where ulevel>0 and isbd=1");
                                    foreach ($arr as $key =>$row){
                                        ?>
                                        <option value="<?=$row['ulevel']?>"><?=$row['lvname']?> ￥<?=$row['lsk']?></option>
                                        <?php 
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                        	<td><strong>手机号码 <label id="usertellabel" style="color: red;" /></label></strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="text" id="usertel" placeholder="请输入手机号码" value="<?=$_GET['usertel']?>" onkeyup="this.value=this.value.replace(/[^0-9]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9]/g,'')" onBlur="Check('usertel');" name="usertel" onblur="isPhoneNum(this);"/>
                                
                            </td>
                        </tr>
                         <tr>
                        	<td><strong>身份证号码 <label id="usercardlabel" style="color: red;" /></label></strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="text"  id="usercard" placeholder="请输入身份证号码" value="<?=$_GET['usercard']?>" onBlur="Check('usercard');" name="usercard"/>
                            </td>
                        </tr>
                        <tr>
                        	<td><strong>收货地区</strong></td>
                        </tr>
                        <tr>
                    	<td>
                        	
                            
                            <div id="demo1" class="citys">
                
                    <script type="text/javascript" src="js/jsAddress.js"></script>
                    <select style=" width: 100px;" id="province" name="province" ></select>
                    <select style=" width: 100px;" id="city" name="city"></select>
                    <select style=" width: 100px;" id="area" name="area" ></select>


                    <script type="text/javascript">
                        addressInit('province', 'city', 'area','','','');
                    </script>
              
            </div>
                        </td>
                       
                    </tr>
                        <tr>
                        	<td><strong>收货地址</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="text"  id="useraddress" placeholder="请输入收货地址" value="<?=$_GET['useraddress']?>" onBlur="Check('useraddress');" name="useraddress" />
                            </td>
                        </tr>
                                               <tr>
                            <td><strong>开户银行</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="bankname" id="bankname">
                                    <option value="中国银行">中国银行</option>
                                    <option value="中国农业银行">中国农业银行</option>
                                    <option value="中国建设银行">中国建设银行</option>
                                    <option value="中国工商银行">中国工商银行</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>开户卡号</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text"  id="bankcard" placeholder="请输入开户卡号" value="<?=$_GET['bankcard']?>" onBlur="Check('bankcard');" name="bankcard" />
                            </td>
                        </tr>
                        <tr>
                            <td><strong>开户姓名</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text"  id="bankusername" placeholder="请输入开户姓名" value="<?=$_GET['bankusername']?>" onBlur="Check('bankusername');" name="bankusername" />
                            </td>
                        </tr>
                        <tr>
                            <td><strong>开户地址</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text"  id="bankaddress" placeholder="请输入开户地址" value="<?=$_GET['bankaddress']?>" onBlur="Check('bankaddress');" name="bankaddress" />
                            </td>
                        </tr>
                        <tr>
                            <td><strong>登录密码（默认：111111）</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password" id="password1" placeholder="请输入登录密码" onBlur="Check('password1');" name="password1" value="<?=$sys['password1']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>确认登录密码（默认：111111）</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password" id="password12" placeholder="请确认登录密码" onBlur="Check('password12');" name="password12" value="<?=$sys['password1']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>安全密码（默认：222222）</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password"  placeholder="请输入安全密码" id="password2" onBlur="Check('password2');" name="password2" value="<?=$sys['password2']?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>确认安全密码（默认：222222）</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password" placeholder="请确认安全密码" id="password22" onBlur="Check('password22');" name="password22" value="<?=$sys['password2']?>"/>
                            </td>
                        </tr>
                        
<!--                        <table   width="100%" height="100%" cellpadding="3" cellspacing="1" border="0" align="center" class="form-horizontal">
                        <tr>
                            <td align="center">选择</td>
                            <td align="center">商品名称</td>
                            <td align="center">金额</td>
                            <td align="center">数量</td>
                            <td align="center">详细信息</td>
                        </tr>
                        <?php 
                           $sql = "select * from goods where lx=1 order by id desc";
                           $result = mysql_query($sql);
                           while ($goods = mysql_fetch_assoc($result)){
                        ?>
                        <tr>
                            <td align="center" ><input type="checkbox"  name="UID[]" id="UID" value="<?=$goods['id']?>"></td>
                            <td align="center"><?=$goods['goodsname']?></td>
                            <td align="center"><?=$goods['shichangjia']?></td>
                            <td align="center" ><input type="text" name="<?=$goods['id']?>num" value="1" readonly size="5" maxlength="4"></td>
                            <td align="center" ><a href='goodscontent.php?id=<?=$goods['id']?>'>查看</a></td>
                        </tr>
                        <?php }?>
                   
                         </table>-->
                    </table>
                    
                    <ul class="clearfix">
                    	<li>
                        	<input type="submit" value="注   册" id="submit" name="submit" onClick="{if(confirm('您确认注册吗？请确认信息填写完整正确?')){this.document.selform.submit();return true;}return false;}"/>
                        </li>
                    	<li>
                        	<a href="javascript:history.back(-1);">返回</a>
                        </li>
                    </ul>
                    
                </div>
            </form>
        </div>
    </section>
    <?php include 'footer.php';?>
</body>
</html>