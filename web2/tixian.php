<!DOCTYPE html>
<?php
include("check.php");
include_once("../function.php");
include("check2.php");

session_start();
$member=getMemberbyID($_SESSION['ID']);
if($_SESSION['ID']==null){
    echo "<script language=javascript>alert('您尚未登陆,请登陆后查看!.');window.location.href='../copyindex.php'</script>";
}
header("Content-Type: text/html;charset=utf-8");
$sys=getOne("select * from systemparameters where id=1");
// var_dump(date("w"));die;
if(tx(date("w"))<>1){
    echo "<script language=javascript>alert('今天不是提现日！');window.location.href='zhanghu.php'</script>";

}
//$hour = date('H',time());//获取当前小时 
//// var_dump($hour);die;
//if ($hour<9 || $hour>18) {
//    echo "<script language=javascript>alert('当前时间不是提现时间！');window.location.href='zhanghu.php'</script>";
//}
$date=date("Y-m-d",strtotime("-6 day"));
$oo=getOne("SELECT sum(b0) from `bonus` where date_format(bdate,'%Y-%m-%d')>=date_format('{$date}','%Y-%m-%d') and uid=".$_SESSION['ID']." ");
$lsk=$oo['sum(b0)'];//团队业绩
if (empty($lsk)){
    $lsk=0;
}
if ($_POST['submit']){
    $uid=$_SESSION['ID'];
    $num=$_POST['jine'];
    $cishu=getOne("select count(*) from tixian where year(tdate)=year(now()) and month(tdate)=month(now()) and day(tdate)=day(now()) and uid={$uid}");
    // var_dump($cishu['count(*)']);
    if($cishu['count(*)']>=$sys['xianliang']){
        alert("提现次数超限");
        return;
    }
    $lx=1;
    if (md5($_POST['password2'])==$member['password2']){
        if(!$member['bankcard'] || !$member['bankaddress'] || !$member['bankusername']){
            alert("请将银行信息补充完整后提现!","tixian.php");
            return;
        }
        //        if (isNum($_POST['jine'])==false){//正则表达式
        //            alert("必须大于0","?");
        //        }
        //$sj=(int)date("H");
//        $member=getMemberbyID($_SESSION['ID']);
//        $date=date("Y-m-d",strtotime("-6 day"));
//        $oo=getOne("SELECT sum(b0) from `bonus` where date_format(bdate,'%Y-%m-%d')>=date_format('{$date}','%Y-%m-%d') and uid=".$_SESSION['ID']." ");
//        $lsk=$oo['sum(b0)'];//团队业绩
//        if (empty($lsk)){
//            $lsk=0;
//        }
//        $txjine=$member['cfxf']-$lsk;
//        if ($txjine<0){$txjine=0;}
        
        if ($num>0 && isNum($num)){
            // if ($txjine>=$num){
            if ($lx==1) {
                $ce = $member['cfxf'];
                
                if ($num % $sys['txbs'] == 0) {
                    if ($num >= $sys['txmix']) {
                        if ($num <= $sys['txmax']) {
                            
                            if ($num <= $ce) {
                                $tixian['uid'] = $uid;
                                $tixian['nickname'] = $member['nickname'];
                                $tixian['username'] = $member['username'];
                                $tixian['usertel'] = $member['usertel'];
                                $tixian['bankname'] = $member['bankname'];
                                $tixian['bankcard'] = $member['bankcard'];
                                $tixian['bankaddress'] = $member['bankaddress'];
                                $tixian['bankusername'] = $member['bankusername'];
                                $tixian['lx'] = $lx;
                                $tixian['num'] = $num;
                                
                                $tixian['tdate']=now();
                                if ($lx == 1) {
                                    $memberf['cfxf']=$member['cfxf']-$num;
                                    // $shui =$sys['txsl']*$num/100;
                                   
                                    // $tixian['shui']=$shui;//税
                                    $tixian['mey']=$num;
                                }

                                add_insert_cl('tixian', $tixian);

                                edit_update_cl('member', $memberf, $uid);
                                                                
                                echo "<script language=javascript>alert('您的提现申请已经提交,请耐心等待审核.\\n本次提现金额:$" . $num . "');window.location.href='?'</script>";
                                
                            } else {
                                echo "<script language=javascript>alert('您的余额不足,申请提交失败');window.location.href='?'</script>";
                            }
                        } else {
                            echo "<script language=javascript>alert('温馨提示：最大提现金额只能为" . $sys['txmax'] . "');window.location.href='?'</script>";
                        }
                    } else {
                        echo "<script language=javascript>alert('温馨提示：最小提现金额只能为" . $sys['txmix'] . "');window.location.href='?'</script>";
                    }
                } else {
                    echo "<script language=javascript>alert('温馨提示：提现金额只能为" . $sys['txbs'] . "倍数');window.location.href='?'</script>";
                }
            }else{
                echo "<script language=javascript>alert('温馨提示：您操作有误，请重新申请！');window.location.href='?'</script>";
            }
            //    }else {
            //       echo "<script language=javascript>alert('温馨提示：提现金额超过可提现金额，请重新申请！');window.location.href='?'</script>";
            //   }
        }else{
            echo "<script language=javascript>alert('温馨提示：您输入的金额不正确，请重新申请！');window.location.href='?'</script>";
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
<title>提取积分</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/register.css">
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
          <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
    	<div class="mainBox">
            <form action="" method="post">
                <div class="table3">
                    <table>
                     <!-- 
                        <tr>
                            <td><strong>收款银行</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	<table>
                                	<tr>
                                    	<td>开户银行</td>
                                    	<td>开户支行</td>
                                    	<td>开户姓名</td>
                                    	<td>卡号</td>
                                    </tr>
                                	<tr>
                                    	<td>微信转账</td>
                                    	<td>QQ客服1221212</td>
                                    	<td>公司财务微信号</td>
                                    	<td>3のqeqeeqeqe</td>
                                    </tr>
                                	<tr>
                                    	<td>建设银行</td>
                                    	<td>浙江嘉兴秀洲区支行</td>
                                    	<td>卢江萍</td>
                                    	<td>3424141413112312</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                          <tr>
                            <td><strong>特惠券余额</strong></td>
                        </tr>
                        <tr>
                            <td>
                               	￥<?php echo $member['sgb'];?> 
                            </td>
                        </tr>
                        <tr>
                            <td><strong>申请类型</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <select  name="lx" id="lx">
                                    <option value="1">现金</option>
                                    <option value="2">特惠券</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>上传汇款图片</strong></td>
                        </tr>
                        <tr>
                            <td>
                              <iframe ID="UploadFiles2" src="UploadFiles2.php" frameborder=0 scrolling=no height="35" width="100%"></iframe>
                            </td>
                             <script language="javascript">
                                function GetImgName2(){
                                    //根据iframe的id获取对象
                                    //var i1 = window.frames['UploadFiles'];
                                    //获取iframe中的元素值
                                    var i2=document.getElementById("UploadFiles2").contentWindow;

                                    var imgname=i2.document.getElementById("imgname2").value;


                                    document.getElementById("goodsimg2").value = imgname;
                                }

                        </script>
                        </tr>
                       <tr>
                    		<td><strong>获取图片</strong></td>
                        </tr>
                        <tr>
                            <td>
                               <input name="goodsimg2" type="text" id="goodsimg2" style="width: 50%;" size="20" maxlength="50">
                                <input name="button" type="button" class="btn1" id="button" onClick="GetImgName2()" value="获取图片">
                            </td>
                        </tr>
                         -->
                         
                        <tr>
                           	 <td><strong>B积分余额</strong></td>
                        </tr>
                        <tr>
                            <td>
                            	￥<?php echo $member['cfxf'];?>
                            </td>
                        </tr>
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
                       
                       
                      
                        <tr>
                            <td><strong>提现金额</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" value="" name="jine" onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="请输入提现金额"/>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><strong>二级密码</strong></td>
                        </tr>
                        <tr>
                        	<td>
                            	<input type="password" id="password2" name="password2" placeholder="请输入二级密码"/>
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