<!DOCTYPE html>
<?php
include("check.php");
include_once("../function.php");
include("check2.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);
header("Content-Type: text/html;charset=utf-8");
if ($_POST['submit']){
    $uid=$_SESSION['ID'];
    $jine=$_POST['jine'];
    $lx=1;
    $hklx=$_POST['hklx'];
   
    if (md5($_POST['password2'])==$member['password2']){
        if ($lx!=null) {
            if ($jine>0&&isNum($jine)){
                // if ($hklx!=0){
                $file = $_FILES['goodsimg'];//得到传输的数据
                
                
                //得到文件名称
                $name = $file['name'];
                if($name){
                    $type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
                    $allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
                    //判断文件类型是否被允许上传
                    if(!in_array($type, $allow_type)){
                        //如果不被允许，则直接停止程序运行
                        return ;
                    }
                    //判断是否是通过HTTP POST上传的
                    if(!is_uploaded_file($file['tmp_name'])){
                        //如果不是通过HTTP POST上传的
                        return ;
                    }
                    $upload_path = "../upload/"; //上传文件的存放路径
                    
                    
                    $pinfo=pathinfo($name);
                    $ftype=$pinfo[extension];
                    $name=time();
                    $destination = $upload_path.$name.".".$ftype;
                    //开始移动文件到相应的文件夹
                    if(move_uploaded_file($file['tmp_name'],$destination)){
                        $chongzhi['goodsimg']=$name.".".$ftype;
                        //echo $chongzhi['goodsimg'];die();
                        
                    }
                } 
                $chongzhi['uid']=$uid;
                $chongzhi['nickname']=$_SESSION['nickname'];
                $chongzhi['username']=$member['username'];
                $chongzhi['jine']=$jine;
                //$chongzhi['zsq']=$jine;
                $chongzhi['cdate']=now();
                //$chongzhi['sdate']=now();
                $chongzhi['lx']=$lx;
                
                //$chongzhi['hklx']=$hklx;
                $chongzhi['tel']=$member['usertel'];
                $chongzhi['beizhu']=$_POST['beizhu'];
                //$chongzhi['goodsimg']=$_POST['goodsimg2'];
                echo add_insert_cl('chongzhi',$chongzhi);
                echo "<script language=javascript>alert('您的申请已经提交,请耐心等待审核.\\n本次申请金额:".$jine."');window.location.href='?'</script>";
                // }else{
                //     echo "<script language=javascript>alert('请选择汇款类型');window.location.href='?'</script>";
                // }
            }else{
                echo "<script language=javascript>alert('金额不正确,请确认后重新申请');window.location.href='?'</script>";
            }
        }else{
            echo "<script language=javascript>alert('您操作有误！请重新申请');window.location.href='?'</script>";
        }
    }else{
        echo "<script language=javascript>alert('二级密码不正确.');window.location.href='?id=".$ID."'</script>";
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
<title>积分充值</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/register.css">
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
          <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
    	<div class="mainBox">
           <form name="form1" method="post" action="?" onSubmit="return CheckForm();" enctype="multipart/form-data">
                <div class="table3">
                    <table>
                    <!-- <?php $zhanghu=getOne("select * from zhanghu where id=1");?> -->
                
                        <!-- <tr>
                           	 <td><strong>微信充值二维码</strong></td>
                         </tr>
                        <tr> 
                             <td>   <img style="height:250px;weight:250p;" src="../upload/zhanghu/<?=$zhanghu['weixin']?>" alt=""/> </td>
                   
                           </tr>
                        
                        
                         <tr>
                           	 <td><strong>支付宝充值二维码</strong> </td>
                         </tr>
                            <tr>
                                 <td>	 <img style="height:250px;weight:250px;" src="../upload/zhanghu/<?=$zhanghu['zhifubao']?>" alt=""/></td>
                   
                           </tr>
                         
                               <tr>
                            <td><strong>银行卡充值</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	<table>
                                	<tr>
                                		
                                    	<td>开户银行</td> <td><?=$zhanghu['khyinhang']?></td> </tr>
                                    <tr>	<td>开户支行</td><td><?=$zhanghu['khdizhi']?></td></tr>
                                   <tr> 	<td>开户名称</td><td><?=$zhanghu['khxingming']?></td></tr>
                                   <tr> 	<td>开户账号</td><td><?=$zhanghu['khkahao']?></td></tr>
                                  
                                
                                	
                                	<tr>
                                    	
                                    	
                                    	
                                    	
                                    </tr>
                                	 
                                   
                                </table>
                            </td>
                        </tr> -->
                         
                        <tr>
                           	 <td><strong>A积分余额</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	￥<?php echo $member['zsq'];?>
                            </td>
                        </tr>
                     <!--     <tr>
                            <td><strong>特惠券余额</strong></td>
                        </tr>
                        <tr>
                            <td>
                               	￥<?php echo $member['sgb'];?> 
                            </td>
                        </tr>-->
                        <tr>
                            <td><strong>充值金额</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" value="" name="jine" onkeyup="value=value.replace(/[^\d]/g,'')"/>
                            </td>
                        </tr>
<!--                        <tr>
                            <td><strong>申请类型</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <select  name="lx" id="lx">
                                    <option value="1">现金</option>
                                      <option value="2">特惠券</option>
                                </select>
                            </td>
                        </tr>-->
                           <!-- <tr>
                            <td><strong>汇款类型</strong></td>
                        </tr>
                        <tr >
                            <td style="center;">
                           
            	 <div class="box">
                                	
                          微&nbsp;&nbsp;信<input type="radio" name="hklx" id="hklx" style="width:20px;" value="1"  checked >  
                                    
                                </div>                	
   	<div class="box">
                                	
                           支付宝<input type="radio" name="hklx" id="hklx" style="width:20px;" value="2" checked >
                                     
                                </div>   	
                                
                            <div class="box">
                                	
                     银行卡<input type="radio" name="hklx" id="hklx" style="width:20px;" value="3" checked >   
                                 
                                </div>    -->
 
    
                        <tr>
                            <td><strong>上传汇款图片</strong></td>
                        </tr>
                        <tr>
                            <td>
                               <input type="file" name="goodsimg">
                            </td>
                        </tr>
                        <tr>
                            <td><strong>二级密码（默认：222222）</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password" id="password2" name="password2" placeholder="二级密码"/>
                            </td>
                        </tr>
                       
                    </table>
                    
                    <ul class="clearfix">
                    	<li>
                        	<input type="submit" value="提交申请" name="submit" />
                        </li>
                    	<li>
                        	<a href="javascript:history.back(-1);">返回</a>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
        
    
    </section>  <?php include 'footer.php';?>
    </div>
</body>
</html>