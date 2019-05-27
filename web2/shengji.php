<!DOCTYPE html>
<?php
include("check.php");
include_once("../function.php");
include_once("../class/member_class.php");
include("check2.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
$member=getMemberbyID($_SESSION['ID']);
$member_cl= new member_class();
if($_SESSION['ID']==null){
    echo "<script language=javascript>alert('您尚未登陆,请登陆后查看!');window.location.href='../copyindex.php'</script>";
    return;
}
if($member['ulevel']==2){
    echo "<script language=javascript>window.location.href='index.php'</script>";
    return;
}
$ul=ulevel($member['ulevel']);

if ($_POST['submit']){
    if (md5($_POST['password2'])==$member['password2']){
        if($member['zju']<>0){
            echo "<script language=javascript>alert('升级申请中，请耐心等待审核！');window.location.href='?'</script>";
            return;
        }
        $fahuo=$_POST['fa'];
        $ylevel=$_POST['ulevel'];
        $yy= getOne("select lsk,yl2,yl3,yl4 from ulevel where ulevel={$ylevel}");
        $cha=$yy['lsk']-$member['lsk'];
        $num=$yy['yl2']-$ul['yl2'];
        if($yy){
            if($member['lsk']<$yy['lsk']){
                //$rn=getOne("select zsq from member where id={$member['reid']}");
                if ($member['mey'] < $cha){
                    alert("您的账户余额不足升级失败","?");
                    return;
                } 
                $member_update['mey']=$member['mey']-$cha;
                edit_update_cl('member',$member_update,$member['id']);
                
                $FileID=date("ymdH").rand(1000,9999);//订单号
                $j= getOne("select a1 from jiangjin where id=1");
                $rs= getOne("select * from goods where id={$j['a1']}");
                if($rs && $num>0){
                    $or['uid']=$member['id'];
                    $or['userid']=$member['nickname'];
                    $or['ordersnumber']=$FileID;
                    $or['useraddress']=$member['useraddress'];
                    $or['usertel']=$member['usertel'];
                    $or['username']=$member['username'];
                    $or['lx']=-1;
                    $or['goodid']=$rs['id'];
                    $or['goodname']=$rs['goodsname'];
                    $or['price']=$rs['price'];
                    $or['goodid']=$rs['id'];
                    $or['goodname']=$rs['goodsname'];
                    $or['num']=$num;
                    $or['jine']=$rs['price']*$num;
                    $or['date']=now();
                    add_insert_cl('orders2',$or);
                    if($fahuo==1){
                        $bid=$member['reid'];
                    }else{
                        $bid=0;
                    }
                    $sheng=$member['province'];   
                    $shi=$member['city'];
                    $xian=$member['area'];
                    if($shi=="市辖区" || $shi=="县" || $shi=="市"){
                        $shi="";
                    }
                    if($xian=="市辖区"){
                        $xian="";
                    }

                    $ssx=$sheng.$shi.$xian;
                    $oid=store($FileID,$arr,$member['id'],$member['nickname'],$member['username'],$member['usertel'],$ssx.$ssx.$member['useraddress'],$rs['price']*$num,0,-1,$bid,$num);    
                    $z= getOne("select id from goods where id={$yy['yl4']}");
                    if($z){
                        $member_cl->zengpin($oid,$z['id'],$yy['yl3']);//Zeng
                    } 
                }
            }
            
            $shengji['uid'] = $_SESSION['ID'];   
            $shengji['nickname'] = $member['nickname'];
            $shengji['username'] = $member['username'];
            $shengji['ylevel'] = $member['ulevel'];
            $shengji['uplevel'] = $ylevel;
            $shengji['issh'] = 0;
            $shengji['udate']=now();
            add_insert_cl('ulevelup', $shengji);
            edit_sql("update member set zju=$ylevel where id={$member['id']}");//
            echo "<script language=javascript>alert('升级申请成功，请耐心等待审核！');window.location.href='?'</script>";
        }else{
           echo "<script language=javascript>alert('级别错误，请刷新后重试！');window.location.href='?'</script>";
           return;
        }
    }else{
        echo "<script language=javascript>alert('二级密码不正确.');window.location.href='?'</script>";
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
<title>升级申请</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/register.css">
<script src="js/jquery.js"></script>
<script>
function checkn(){
    document.getElementById("n").value="1";
}
function check(){
    password2=document.form.password2.value;//
    fa=document.form.fa.value;//
    display=document.getElementById("good").style.display;
    conditions=document.getElementById("n").value;
    if(fa==0){
        alert("温馨提示:\n请选择发货方式");
        document.form.fa.focus();
        return false;
    }
    if(password2.length==0){
        alert("温馨提示:\n请输入二级密码");
        document.form.password2.focus();
        return false;
    }

    if(display!="none"){
        if(conditions==0){
            alert("温馨提示:\n请选择商品");
            //document.form.UID.focus();
            return false;
        }
    }
    return true;
}
</script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
          <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
    	<div class="mainBox">
            <form action="" id="form" name="form" method="post" onsubmit="return check();">
                <div class="table3">
                    <table>
                     
                         
                        <tr>
                           	 <td><strong>当前级别</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	<?php echo $ul['lvname'];?>
                            </td>
                        </tr>
                        <tr>
                           	 <td><strong>投资金额累计</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	￥<?php echo $member['lsk'];?>
                            </td>
                        </tr>
                        <tr>
                           	 <td><strong>账户余额</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	￥<?php echo $member['mey'];?>
                            </td>
                        </tr>
                        <?php if($member['zju']<>0){
                            $s= getOne("select lvname from ulevel where ulevel={$member['zju']}");
                            ?>
                         <tr>
                           	 <td><strong>申请等级</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	<?=$s['lvname']?>
                            </td>
                        </tr>
                        <tr>
                           	 <td><strong>申请状态</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	审核中
                            </td>
                        </tr>
                        <tr>
                            <td>
                            	<br>
                            </td>
                        </tr>
                        
                        <?php }else{?>
                         <tr>
                              <td><strong>升级级别</strong>
                                    <select id="ulevel" name="ulevel" onchange="gradeChange()">
                        <?php 
                            $you= getAll("select ulevel,lsk,lvname from ulevel where ulevel<>2 and ulevel<=9 and ulevel>{$member['ulevel']}");
                            if($you){
                                $i=1;
                                $c=0;
                            foreach ($you as $key => $value) {
                                $cha=$value['lsk']-$member['lsk'];
                                if($cha<0){
                                   $cha=0; 
                                }
                                if($i==1){
                                    $c=$cha;
                                }
                        ?>
                            <option value="<?=$value['ulevel']?>"><?=$value['lvname']?> 差额：￥<?=$cha?></option>
                        
                        <?php 
                        $i++;
                            }
                            }else{
                                ?>
                            <option value="-1">你当前已为最大级别，无法升级</option>
                           <?php       
                            }
                        ?>
                         </select>
<!--                                  <script>
                                    function gradeChange(){
                                        var objS = document.getElementById("ulevel");
                                        var ulevel = objS.options[objS.selectedIndex].value;
                                        $.ajax({
                                            type: "POST",
                                            url : "ajax.php",
                                            datatype : 'json',
                                            data: {'ulevel':ulevel},
                                            success :function (data) {
                                                //alert(data);
                                   //           document.getElementById("rusername").innerHTML=data;
                                                //document.getElementById("rusername").value=data;
                                                if(data==0){
                                                    document.getElementById("good").style.display="none";
                                                }else{
                                                    document.getElementById("good").style.display="block";
                                                }
                                            }
                                          });
                                    }
//                                    $("#ulevel").change(function(){
//                                        var opt=$("#ulevel").val();
//                                      alert(opt);
//                                      });  
                                  </script>-->
                        
                              </td>
                        </tr>
                        <?php if($you){?>
                        <tr>
                            <td><strong>发货方式</strong></td>
                        </tr>
                        <tr>
                        	<td>
                                <select name="fa" id="fa">
<!--                                    <option value="0">= 点击选择发货方式 =</option>-->
                                    <option value="1">上级发货</option>
<!--                                    <option value="2">系统发货</option>-->
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>二级密码</strong></td>
                        </tr>
                        <input type="hidden" id="n" name="n" value="0"/>
                        <tr>
                        	<td>
                            	<input type="password" id="password2" name="password2" placeholder="请输入二级密码"/>
                            </td>
                        </tr>
                         <?php }?>
                        <?php       
                            }
                        ?>
                        
<!--                        <tr>
                           	 <td><strong>提示</strong></td>
                        </tr>
                        <tr>
                            <td>
                                周一至周五为提现日,提现时间为9:00-18:00.
                            </td>
                        </tr>-->
                      	<!-- <tr>
                           	 <td><strong>提现手续费</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	<?php echo $sys['txsl'];?>%
                            </td>
                        </tr> -->
                       
                       
                      
<!--                        <tr>
                            <td><strong>提现金额</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" value="" name="jine" onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="请输入提现金额"/>
                            </td>
                        </tr>-->
                         
                    </table>
<!--                    <div <?php  if($c==0) {?>style="display: none" <?php }?>  name="good" id="good" >
                        
                        
                    <table border="0" style="width:80%;">
	                      <tr>
	                      	<td align="center"></td>
	                      	<td align="center">商品</td>
                                <td align="center">介绍</td>
	                      	<td align="center">金额</td>
	                      	<td align="center">数量</td>
	                      	<td align="center">详细</td>
	                      </tr>
	                     <?php 
	                        $sql = "select * from goods where lx=1 order by id desc";
	                        $result = mysql_query($sql);
	                     	while ($goods = mysql_fetch_assoc($result)){
	                     ?>
	                     <tr>
	                     	<td align="center"><input type="checkbox" onClick="checkn()" name="UID[]" id="UID" value="<?=$goods['id']?>"></td>
                                <td align="center"><?=$goods['goodsname']?></td>
                                <td align="center"><?=$goods['goodscontent']?></td>
	                        <td align="center"><?=$goods['price']?></td>
                            <td align="center" ><input type="button" readonly name="<?=$goods['id']?>num" value="1" size="5" maxlength="4"></td>
	                        <td align="center" ><a href='goodscontent.php?id=<?=$goods['id']?>'>查看</a></td>

	                     </tr>
	                     <?php }?>
                 
                    
                	
<tr>
	                     	<td align="center" style="left: 0px;"></td>
                                <td align="center"></td>
	                        <td align="center"></td>


	                     </tr>
                
                    
                    </table>
                        
                   </div>-->
                    <ul class="clearfix">
                        <?php if($you){?>
                    	<li>
                        	<input type="submit" value="提交申请" name="submit" />
                        </li>
                            <?php }?>
                        <li <?php if($you==null){?>style="width: 100%" <?php }?>>
                            <a style="background-color: #cccccc" href="javascript:history.back(-1);">返回</a>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
        
    
    </section>  <?php include 'footer.php';?>
    </div>
</body>
</html>