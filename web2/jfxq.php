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
    if(md5($_POST['password2'])==$member['password2']) {
        if ( $jine > 0 && isNum( $jine ) ) {
            
                $ze = 0;
                if ($_POST['lx'] == 1 || $_POST['lx'] == 2) {
                    $ze = $member['cfxf'];
                }else {
                    $ze = $member['zsq'];
                }
                if ($ze >= $jine) {
                    $addstate = 1;
                    $zhuanhuan['uid'] = $uid;
                    $zhuanhuan['nickname'] = $_SESSION['nickname'];
                    $zhuanhuan['username'] = $member['username'];
                    $zhuanhuan['jine'] = $jine;
                    $zhuanhuan['zdate'] = now();
                    $zhuanhuan['lx'] = $_POST['lx'];

                    if ($_POST['lx'] == 1) {
                        $us_update['cfxf'] = $member['cfxf'] - $jine;
                        $us_update['zsq'] = $member['zsq'] + $jine;
                    }elseif ($_POST['lx'] == 2){
                        
                        $us_update['mey'] = $member['mey'] - $jine;
                        $us_update['cfxf'] = $member['cfxf'] + $jine;
                    } 
                    
                        add_insert_cl('zhuanhuan', $zhuanhuan);
                        edit_update_cl('member', $us_update, $member['id']);
                        echo "<script language=javascript>alert('货币转换成功.\\n本次转换金额:" . $jine . "');window.location.href='?'</script>";
                    


                } else {
                    echo "<script language=javascript>alert('您的余额不足,无法转换.');window.location.href='?'</script>";
                }
            
        } else {
            echo "<script language=javascript>alert('转换金额不正确,请确认后重新转换');window.location.href='?'</script>";
        }
    }else {
        echo "<script language=javascript>alert('交易密码不正确,请确认后重新转换');window.location.href='?'</script>";
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
<title>积分详情</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/jbxx.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
  <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
        	<div class="table2">
            	<table>
                	<tr>
                    	<td>会员编号：<?php echo $member['userid'];?></td>
                    </tr>
                	<tr>
                    	<td>剩余A积分：<?php echo $member['zsq'];?></td>
                    </tr>
                	<tr>
                    	<td>剩余B积分：<?php echo $member['cfxf'];?></td>
                    </tr>
                <!-- 	<tr>
                    	<td>特惠券：<?php echo $member['sgb'];?></td>
                    </tr> -->
                </table>
                <form action="" method="post" class="form2">
                    <table>
                    	<tr>
                            <th>转换类型</th>
                        </tr>
                        <tr>
                            <th>
                                <select  name="lx" id="lx">
                                    <option value="1">B积分转A积分</option>
                                    
                                        <!-- <option value="2">奖金转积分</option> -->
<!--                                     <option value="2">奖金转特惠券</option> -->
<!--                                     <option value="3">现金转特惠券</option> -->
<!--                                    	<option value="4">特惠券转现金</option> -->
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>转换数量</th>
                        </tr>
                        <tr>
                            <th>
                                 <input type="text" value="" name="jine"/>
                            </th>
                        </tr>
                        <tr>
                            <th>二级密码</th>
                        </tr>
                        <tr>
                            <th>
                                <input type="password" value="" name="password2"/>
                            </th>
                        </tr>
                    </table>
                    <ul class="list4 list3">
                        <li class="on"><input type="submit" value="提交申请" name="submit" /></li>
                        <li><a href="javascript:history.go(-1);">返回</a></li>
                    </ul>
                </form>
            </div>
        </div>
        
        <br/><br/>
    </section><?php include 'footer.php';?>
</body>
</html>