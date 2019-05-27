<?php
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");
include_once("action.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
$sys= getOne("select * from systemparameters where id=1");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>注册会员</title>
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
<script language="javascript">
    
//function GetNickName()
//{
//		var rnd="";
//		var aaa="";
//		for(var i=0;i<8;i++)
//		rnd+=Math.floor(Math.random()*10);
//		aaa="CN"+rnd;
//		//document.form1.NickName.value=aaa;
//		document.form1.userid.value=aaa;
//}

function checknickname(lx)
                    {
                        var iframe = document.getElementById("frame");
                        if(lx==1){
                            var user =  document.getElementById("bdname");
                            iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
                        }else if(lx==2){
                            var user =  document.getElementById("rname");
                            iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
                        }else if(lx==3){
                            var user =  document.getElementById("fathername");
                            iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
                        }else if(lx==4){
                            var user =  document.getElementById("userid");
                            iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
                        }
                    }

//校验手机号是否合法
// function isPhoneNum(usertel){
//     var phonenum =usertel.value;
//     var myreg =/^1[3|4|5|8][0-9]\d{4,8}$/;
//     if(!myreg.test(phonenum)){
//         alert('请输入有效的手机号码！');
//         return false;
//     }else{
//         return true;
//     }
// }


function Check(formName){
//    var n=document.getElementById('username').value; 
//    document.getElementById("bankusername").value=n; 
    //bdname=document.form.bdname.value;
    //
    
    
    rname=document.form.rname.value;//推荐编号
    //fathername=document.form.fathername.value;
    
    //userid=document.form.userid.value;
    //ulevel=document.form.ulevel.value;//会员级别
    username=document.form.username.value;//会员姓名
    sex=document.form.sex.value;//会员性别
    usertel=document.form.usertel.value;//手机号
    usercard=document.form.usercard.value;//身份证号
    //useraddress=document.form.useraddress.value;//地址
    
    password1=document.form.password1.value;
    password12=document.form.password12.value;
    password2=document.form.password2.value;
    password22=document.form.password22.value;
   
    //passquestion=document.form.passquestion.value;
    //passanswer=document.form.passanswer.value;
 
    
    
    
    
    //lsk=document.form.lsk.value;
    //bankcard=document.form.bankcard.value;
    //bankusername=document.form.bankusername.value;
    //bankaddress=document.form.bankaddress.value;
    //useremail=document.form.useremail.value;
   
//     if(formName=="bdname"){    	
// 		if(bdname.length == 0){
// 			document.getElementById('bdnamelabel').innerText="请输入DME分行编号";
// 		}else{
// 			document.getElementById('bdnamelabel').innerText="";
// 		}
// 	}
    if(formName=="rname"){
        if(rname.length == 0){
            document.getElementById('rname0label').innerText="";
            document.getElementById('rnamelabel').innerText="请输入推荐编号";
        }else{
            document.getElementById('rnamelabel').innerText="";
        }
    }
//    if(formName=="fathername"){
//        if(fathername.length == 0){
//            document.getElementById('fathername0label').innerText="";
//            document.getElementById('fathernamelabel').innerText="请输入接点编号";
//        }else{
//            document.getElementById('fathernamelabel').innerText="";
//        }
//    }
//    if(formName=="userid"){
//        if(userid.length == 0){
//            document.getElementById('userid0label').innerText="";
//            document.getElementById('useridlabel').innerText="请输入会员编号";
//        }else{
//            document.getElementById('useridlabel').innerText="";
//        }
//    }
//    if(formName=="ulevel"){
//        if(ulevel=-1){
//            document.getElementById('ulevel0label').innerText=""
//            document.getElementById('ulevellabel').innerText="*";
//        }else{
//            document.getElementById('ulevellabel').innerText="";
//        }
//    }
    if(formName=="username"){
        if(username.length == 0){
            document.getElementById('username0label').innerText="";
            document.getElementById('usernamelabel').innerText="请输入会员姓名";
            
        }else{
            document.getElementById('usernamelabel').innerText="";
        }
    }
//    if(formName=="sex"){
//        if(sex == ""){
//            document.getElementById('sex0label').innerText=""
//            document.getElementById('sexlabel').innerText="请选择会员性别";
//        }else{
//            document.getElementById('sexlabel').innerText="";
//        }
//    }
    if(formName=="usertel"){
        if(usertel.length == 0){
            document.getElementById('usertel0label').innerText=""
            document.getElementById('usertellabel').innerText="请输入手机号码";
        }else if(!(/^1[34578]\d{9}$/).test(usertel)){  
            document.getElementById('usertel0label').innerText="";
            document.getElementById('usertellabel').innerText="请输入有效的手机号码";
        }else{
            document.getElementById('usertellabel').innerText="";
        }
        
    }
    if(formName=="usercard"){
        if(usercard.length == 0){
            document.getElementById('usercard0label').innerText=""
            document.getElementById('usercardlabel').innerText="请输入身份证号码";
        }else if(!(/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/).test(usercard)){  
            document.getElementById('usercard0label').innerText=""
            document.getElementById('usercardlabel').innerText="请输入有效的身份证号码";
        }else{
            document.getElementById('usercardlabel').innerText="";
        }
        
    }
    
    
//   if(formName=="useraddress"){
//       if(useraddress.length == 0){
//           document.getElementById('useraddress0label').innerText="";
//           document.getElementById('useraddresslabel').innerText="请输入推荐编号";
//       }else{
//           document.getElementById('useraddresslabel').innerText="";
//       }
//   }
    
    if(formName=="password1"){
        if(password1.length == 0){
            document.getElementById('password10label').innerText="";
            document.getElementById('password1label').innerText="请输入登录密码";
        }else{
            if(password1.length <= 5){
                document.getElementById('password110label').innerText="";
                document.getElementById('password1label').innerText="登录密码不能小于6位";
            }else{
                document.getElementById('password1label').innerText="";
            }
        }

    }
    if(formName=="password12"){
        if(password12.length == 0){
            document.getElementById('password120label').innerText="";
            document.getElementById('password12label').innerText="请确认登录密码";
        }else{
            if(password12.length <= 5){
                document.getElementById('password120label').innerText="";
                document.getElementById('password12label').innerText="确认登录密码不能小于6位";
            }else{
                if(password1 != password12){
                    document.getElementById('password120label').innerText="";
                    document.getElementById('password12label').innerText="两次登录密码输入不一致";
                }else{
                    document.getElementById('password12label').innerText="";
                }
            }
        }
    }
    if(formName=="password2"){
        if(password2.length == 0){
            document.getElementById('password20label').innerText="";
            document.getElementById('password2label').innerText="请输入交易密码";
        }else{
            if(password2.length <= 5){
                document.getElementById('password20label').innerText="";
                document.getElementById('password2label').innerText="交易密码不能小于6位";
            }else{
                document.getElementById('password2label').innerText="";
            }
        }
    }
    if(formName=="password22"){
        if(password22.length == 0){
            document.getElementById('password220label').innerText="";
            document.getElementById('password22label').innerText="请确认交易密码";
        }else{
            if(password22.length <= 5){
                document.getElementById('password220label').innerText="";
                document.getElementById('password22label').innerText="确认交易密码不能小于6位";
            }else{
                if(password2 != password22){
                    document.getElementById('password220label').innerText="";
                    document.getElementById('password22label').innerText="两次交易密码输入不一致";
                }else{
                    document.getElementById('password22label').innerText="";
                }
            }
        }
    }

}


function CheckForm(){
	
            rname=document.form.rname.value;//推荐编号
            //fathername=document.form.fathername.value;//接点编号
            //tid=document.form.tid.value;//
            //userid=document.form.userid.value;//编号
            //ulevel=document.form.ulevel.value;//级别
            username=document.form.username.value;//会员姓名
            sex=document.form.sex.value;//会员性别
            usertel=document.form.usertel.value;//手机号
            usercard=document.form.usercard.value;//身份证号
            //useraddress=document.form.useraddress.value;//地址

            password1=document.form.password1.value;
            password12=document.form.password12.value;
            password2=document.form.password2.value;
            password22=document.form.password22.value;
//            treeplace=document.form.treeplace.value;
//             bankcard=document.form.bankcard.value;
//             bankusername=document.form.bankusername.value;
//             bankaddress=document.form.bankaddress.value;
//             useremail=document.form.useremail.value;
//             prov=document.form.prov.value;
//             city=document.form.city.value;
//             area=document.form.area.value;
           
//         	if(bdname.length == 0){
//         		alert("温馨提示:\n请输入DME分行编号.");
//         		document.form.bdname.focus();
//         		return false;
//         	}
            if(rname.length == 0){
                alert("温馨提示:\n请输入推荐编号");
                document.form.rname.focus();
                return false;
            }
//            if(fathername.length == 0){
//                alert("温馨提示:\n请输入接点编号");
//                document.form.fathername.focus();
//                return false;
//            }
//            if(tid == 0){
//                alert("温馨提示:\n请选择安置区域");
//                //document.form.treeplace.focus();
//                return false;
//            }
//            if(userid.length == 0){
//                alert("温馨提示:\n请输入会员编号.");
//                document.form.userid.focus();
//                return false;
//            }
//            if(ulevel == -1){
//                alert("温馨提示:\n请选择注册级别.");
//                document.form.ulevel.focus();
//                return false;
//            }
            
            if(username.length == 0){
                alert("温馨提示:\n请输入会员姓名");
                document.form.username.focus();
                return false;
            }
            if(sex == ""){
                alert("温馨提示:\n请选择会员性别");
                
                return false;
            }
            if(usertel.length == 0){
                alert("温馨提示:\n请输入手机号码");
                document.form.usertel.focus();
                return false;
            }
            if(!(/^1[34578]\d{9}$/.test(usertel))){ 
                alert("温馨提示:\n请输入有效的手机号码");
                document.form.usertel.focus();
                return false;
            }
            if(usercard.length == 0){
                alert("温馨提示:\n请输入身份证号");
                document.form.usercard.focus();
                return false;
            }
            var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;  
            if(reg.test(usercard) === false)  
            {  
                alert("温馨提示:\n请输入有效的身份证号码");  
                document.form.usercard.focus();
                return false;
            }  
            
//           if(useraddress.length == 0){
//               alert("温馨提示:\n请输入地址.");
//               document.form.useraddress.focus();
//               return false;
//           }
//             if(fathername.length == 0){
//                 alert("温馨提示:\n请输入接点人编号.");
//                 document.form.fathername.focus();
//                 return false;
//             }
//            
//          if(lsk%1 != 0){
//               alert("温馨提示:\n注册积分请填写整数.");
//               document.form.lsk.focus();
//               return false;
//           }
            if(password1.length == 0){
                alert("温馨提示:\n请输入一级密码");
                document.form.password1.focus();
                return false;
            }
            if(password1.length <= 5){
                alert("温馨提示:\n密码不能小于6位");
                document.form.password1.focus();
                return false;
            }
            if(password12.length == 0){
                alert("温馨提示:\n请确认一级密码");
                document.form.password12.focus();
                return false;
            }
            if(password12.length <= 5){
                alert("温馨提示:\n密码不能小于6位");
                document.form.password12.focus();
                return false;
            }
            if(password12 != password1){
                alert("温馨提示:\n一级密码输入不一致");
                document.form.password12.focus();
                return false;
            }
            if(password2.length == 0){
                alert("温馨提示:\n请输入交易密码");
                document.form.password2.focus();
                return false;
            }
            if(password2.length <= 5){
                alert("温馨提示:\n密码不能小于6位");
                document.form.password2.focus();
                return false;
            }
            if(password22.length == 0){
                alert("温馨提示:\n请确认交易密码");
                document.form.password22.focus();
                return false;
            }
            if(password22.length <= 5){
                alert("温馨提示:\n密码不能小于6位");
                document.form.password22.focus();
                return false;
            }
            if(password22 != password2){
                alert("温馨提示:\n交易密码输入不一致");
                document.form.password22.focus();
                return false;
            }
//            if(passquestion.length == 0){
//                alert("温馨提示:\n请输入密码安全问题.");
//                document.form.passquestion.focus();
//                return false;
//            }
//            if(passanswer.length == 0){
//                alert("温馨提示:\n请输入密码安全答案.");
//                document.form.passanswer.focus();
//                return false;
//            }
            
           
//             if(bankname.length == 0){
//                 alert("温馨提示:\n请选择开户银行.");
//                 document.form.bankname.focus();
//                 return false;
//             }
//             if(bankcard.length == 0){
//                 alert("温馨提示:\n请输入开户帐号.");
//                 document.form.bankcard.focus();
//                 return false;
//             }
//             if(bankusername.length == 0){
//                 alert("温馨提示:\n请输入开户姓名.");
//                 document.form.bankusername.focus();
//                 return false;
//             }
//             if(bankaddress.length == 0){
//                 alert("温馨提示:\n请输入开户地址.");
//                 document.form.bankaddress.focus();
//                 return false;
//             }
//             if(useremail.length == 0){
//                 alert("温馨提示:\n请输入电子信箱.");
//                 document.form.useremail.focus();
//                 return false;
//             }
//            if(prov.value = -1){
//                alert("温馨提示:\n请选择所在省份.");
//                return false;
//            }
//            if(city.value = -1){
//                alert("温馨提示:\n请选择所在城市.");
//                return false;
//            }
//            if(area.value = -1){
//                alert("温馨提示:\n请选择所在县区.");
//                return false;
//            }
            return true;
        }

    </script>
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
                    <p style="visibility: hidden;"><input type="password" id="0"  disabled style="display:none"/></p>
                        <p style="visibility: hidden;"><input type="text" id="0"  disabled style="display:none"/></p>
                	<tr>
                    	<th colspan="2">注册会员</th>
                    </tr>
                	<tr>
                    	<th colspan="2"><!--
                        	<input type="button" class="button" id="button" name="button" value="查看推荐图" onClick="window.location.href='tuijiantu.php?ID=<?=$uid?>&action=admin'" />
                        	
                       	<input  type="button" class="button" id="button" name="button" value="查看网络图" onClick="window.location.href='wangluotu.php?ID=1&action=admin'" />
                        	
                        	<input type="button" class="button" id="button2" name="button2" value="查看电子币明细" onClick="window.location.href='chakanjjmx.php?ID=<?=$uid?>&action=admin'" />
-->                        </th>
                    </tr>
                    <tr >
    <td width="41%" align="right">注册级别：</td>
    <td width="59%" align="left">
        <select id="ulevel" name="ulevel">
            <?php $ul9=ulevel(9);?>
            <option value="9"><?=$ul9['lvname']?></option>
        </select>
     </td>
  </tr>
   <tr>
    <td width="41%" align="right">推荐编号：</td>
    <td width="59%" align="left"><input type="text" id="rname" name="rname" placeholder="请输入推荐编号" onBlur="Check('rname');" value="<?=$_GET['rn']?>" onkeyup="this.value=this.value.replace(/[^\u4e00-\u9fa5a-zA-Z0-9\w]/g,'')"  >
            
            <input style="width:100px;padding:5px 0;color:#fff;background:#1ab394;border:none;" type="button" onclick='checknickname(2);' value="检测推荐编号"/>
            <iframe name="frame" id="frame" width="0" height="0" src="about:blank" style="display:none"></iframe>
            <span id="rname0label">*</span><label id="rnamelabel" style="color: red;"></label>
    </td>
  </tr> 
<!--  <tr>
    <td width="41%" align="right">接点编号：</td>
    <td width="59%" align="left"><input type="text" id="fathername" name="fathername" placeholder="请输入接点编号" onBlur="Check('fathername');" value="<?=$_GET['nickname']?>" onkeyup="this.value=this.value.replace(/[^\u4e00-\u9fa5a-zA-Z0-9\w]/g,'')"  >
            
            <input style="width:100px;padding:5px 0;color:#fff;background:#1ab394;border:none;" type="button" onclick='checknickname(3);' value="检测接点编号"/>
            <iframe name="frame" id="frame" width="0" height="0" src="about:blank" style="display:none"></iframe>
            <span id="fathername0label">*</span><label id="fathernamelabel" style="color: red;"></label>
    </td>
  </tr> 
  <tr>
    <td width="41%" align="right">安置区域：</td>
    <td width="59%" align="left">
        <input type="radio" hidden checked id="tid" name="tid" value="0">
        <input type="radio" <?php if($_GET['tid']==1){?>checked<?php } ?> id="tid" name="tid" value="1">左区
        <input type="radio" <?php if($_GET['tid']==2){?>checked<?php } ?> id="tid" name="tid" value="2">右区 
    </td>
  </tr> -->
  <?php
            if ($_GET['userid']==null){
                $userid=$sys['qq4']. rand(10000000,99999999);//编号
            }else {
                $userid=$_GET['userid'];
            }
            ?>
  <tr>
    <td width="41%" align="right">会员编号：</td>
    <td width="59%" align="left"><input type="text" id="userid" name="userid" placeholder="请输入会员编号" onBlur="Check('userid');" value="<?=$userid?>" >
            
            <input style="width:100px;padding:5px 0;color:#fff;background:#1ab394;border:none;" type="button" onclick='checknickname(4);' value="检测会员编号"/>
            <iframe name="frame" id="frame" width="0" height="0" src="about:blank" style="display:none"></iframe>
    </td>
  </tr>

  <tr>
    <td width="41%" align="right">会员姓名：</td>
    <td width="59%" align="left">
        <input type="text" id="username" placeholder="请输入姓名" onBlur="Check('username');" name="username"/>
                                <span id="username0label">*</span><label id="usernamelabel" style="color: red;"></label></td>
  </tr>
   <tr >
    <td width="41%" align="right">会员性别：</td>
    <td width="59%" align="left">
        <input name="sex" type="radio" checked id="sex" value="1">男
        <input name="sex" type="radio" id="sex" value="0">女
         <span id="sex0label">*</span><label id="sexlabel" style="color: red;"></label>
     </td>
  </tr>
  <tr >
    <td align="right">手机号码：</td>
    <td align="left">
        <input type="text" id="usertel" placeholder="请输入手机号码" onBlur="Check('usertel');" name="usertel" oninput = "value=value.replace(/[^\d]/g,'')"/>
        <span id="usertel0label">*</span><label id="usertellabel" style="color: red;" />
    </td>
  </tr>
  <tr>
    <td width="41%" align="right">身份证号码：</td>
    <td width="59%" align="left">
        <input type="text"  id="usercard" name="usercard" onBlur="Check('usercard');" placeholder="请输入身份证号"/>
        <span id="usercard0label">*</span><label id="usercardlabel" style="color: red;" />
    </td>
  </tr>
  <tr >
    <td width="41%" align="right">登录密码：</td>
    <td width="59%" align="left">
        <input type="password" id="password1" placeholder="请输入登录密码" onBlur="Check('password1');" name="password1" value="<?=$sys['password1']?>"/>           
        <span id="password10label">*</span><label id="password1label" style="color: red;"></label>
    </td>
  </tr>
  <tr >
    <td width="41%" align="right">确认登录密码：</td>
    <td width="59%" align="left">
        <input type="password" id="password12" placeholder="请确认登录密码" onBlur="Check('password12');" name="password12" value="<?=$sys['password1']?>"/>
        <span id="password120label">*</span><label id="password12label" style="color: red;"></label>
    </td>
  </tr>
   
  <tr >
    <td width="41%" align="right">交易密码：</td>
    <td width="59%" align="left"> 
        <input type="password" id="password2" placeholder="请输入交易密码" onBlur="Check('password2');" name="password2" value="<?=$sys['password2']?>"/>           
        <span id="password20label">*</span><label id="password2label" style="color: red;"></label>
    </td>
  </tr>
  
  <tr >
    <td width="41%" align="right">确认交易密码：</td>
    <td width="59%" align="left">
        <input type="password" id="password22" placeholder="请确认交易密码" onBlur="Check('password22');" name="password22" value="<?=$sys['password2']?>"/>
        <span id="password220label">*</span><label id="password22label" style="color: red;"></label>
    </td>
  </tr>
<!--  <tr >
    <td align="right">开户银行：</td>
    <td align="left">
        <select id="bankname" name="bankname" style="padding:2px 10px 2px 10px;">
            <option value="-1">选择开户银行</option>
            <?php
                $arr= getAll("select bankname from bankname order by shunxu desc");
                foreach ($arr as $key =>$row){ 
            ?>
            <option value="<?=$row['bankname']?>" <?php if($bankname==$row['bankname']){?>selected<?php } ?>><?=$row['bankname']?></option>
             <?php
                }
            ?>
        </select>
    </td>
  </tr>
  <tr >
    <td align="right">开户帐号：</td>
    <td align="left"><input type="text" name="bankcard" id="bankcard" value="<?=$bankcard?>"></td>
  </tr>
  <tr >
    <td align="right">开户姓名：</td>
    <td align="left"><input type="text" name="bankusername" id="bankusername" value="<?=$bankusername?>"></td>
  </tr>
  <tr >
    <td align="right">开户地址：</td>
    <td align="left"><input type="text" name="bankaddress" id="bankaddress" value="<?=$bankaddress?>"></td>
  </tr>-->
                	<tr>
                    	<th colspan="2">
                        	<input style="width:100px;padding:5px 0;color:#fff;background:#1ab394;border:none;" type="submit" value="注   册"  class="tj0" id="submit" name="submit" onClick="{if(confirm('您确认注册吗? 请确认信息填写完整正确?')){this.document.selform.submit();return true;}return false;}"/>
                                <input style="width:100px;padding:5px 0;color:#fff;background: #666666;border:none;" name="" type="reset" value="重   置" />
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