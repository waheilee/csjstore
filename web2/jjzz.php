<!DOCTYPE html>
<?php
include("check.php");
include_once("../function.php");
include("check2.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);
header("Content-Type: text/html;charset=utf-8");
$sys=getOne("select * from systemparameters where id=1");
?>
<?php
if ($_POST['submit']){//买入
    if (isNum($_POST['jine'])==false){//正则表达式
        alert("转账金额必须大于0","?");exit();
    }
    if ($_POST['jine']<=0){//正则表达式
        alert("转账金额必须大于0","?");exit();
    }
    //短信验证
//    if ($sys['zzkg']==1){//短信验证开关
//        $duanxin=$_POST['duanxin'];
//        if($duanxin!=$_SESSION['code2'] || empty($_SESSION['code2'])){
//
//            echo "<script language=javascript>alert('验证码错误,请刷新后再试.');window.location.href='?'</script>";
//            return ;
//        }
//    }
    $uid=$_SESSION['ID'];
    if ($sus=getMemberbyNickName($_POST['snickname'])){
        if (isNum($_POST['jine'])==false){//正则表达式
            alert("必须大于0","?");exit();
        }
        if ($_POST['lx']!=1){//正则表达式
            alert("你操作有误，请重新输入！","?");exit();
        }
        if (md5($_POST['password2'])!=$member['password2']){
            alert("二级密码不正确,请重新输入","?");exit();
        }
        $sql="select * from member where (ppath like '%".$sus['id']."%' and id=".$member['id'].") or  (ppath like '%".$member['id']."%' and id=".$sus['id'].")";
        // 			echo $sql;
        // 			return ;
        //$sql="select * from member where ppath like '%".$member['id']."%' and id=".$sus['id']." ";
        $query=mysql_query($sql);
        

            if($sus['id']==$member['id'] ){
                echo "<script language=javascript>alert('不能给自己转账.');window.location.href='?'</script>";exit();
            }else{

                $jine=$_POST['jine'];
                $lx=$_POST['lx'];
                //if ($jine%$zzbs==0){

                if ($member['mey']>=$jine && isNum($_POST['jine'])==true){
                    $member_update['mey']=$member['mey']-$jine;
                    $sus_update['mey']=$sus['mey']+$jine;
                }else{
                    echo "<script language=javascript>alert('您的C积分余额不足,无法转账.');window.location.href='?'</script>";exit();
                }


                edit_update_cl('member',$member_update,$member['id']);
                edit_update_cl('member',$sus_update,$sus['id']);

                $zhuanzhang['uid']=$member['id'];
                $zhuanzhang['nickname']=$member['nickname'];
                $zhuanzhang['username']=$member['username'];
                $zhuanzhang['sid']=$sus['id'];
                $zhuanzhang['snickname']=$sus['nickname'];
                $zhuanzhang['susername']=$sus['username'];
                $zhuanzhang['jine']=$jine;
                $zhuanzhang['zdate']=now();
                $zhuanzhang['lx']=$lx;
                echo add_insert_cl('zhuanzhang',$zhuanzhang);
                echo "<script language=javascript>alert('转账成功.\\n转入会员:".$sus['nickname']."\\n转账金额:".$jine."');window.location.href='?'</script>";

//                }else{
//                    echo "<script language=javascript>alert('转账是必须".$zzbs."的整数倍,请确认后重新转账');window.location.href='?'</script>";
//                }
            }
        }

    else{
        echo "<script language=javascript>alert('该会员不存在,请确认后重新转账');window.location.href='?'</script>";
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
<title>会员转账</title>
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
                    	<td>C积分余额：<?php echo $member['mey'];?></td>
                    </tr>
                	
                </table>
                <form action="" method="post" class="form2">
                    <table>
                    	<tr>
                            <th>转账类型</th>
                        </tr>
                        <tr>
                            <th>
                                <select  name="lx" id="lx">
                                    <option value="1">C积分</option>
<!--                                     <option value="2">奖金转特惠券</option> -->
<!--                                     <option value="3">现金转特惠券</option> -->
<!--                                    	<option value="4">特惠券转现金</option> -->
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>转账金额</th>
                        </tr>
                        <tr>
                            <th>
                                 <input type="text" value="" name="jine"/>
                            </th>
                        </tr>
                        <tr>
                            <th>接受用户编号</th>
                        </tr>
                        <tr>
                            	<th>
                                <input type="text" value="" id="snickname" name="snickname"/>
                                </th>
                         </tr>
                         <tr>
                            	<th>
                               <input type="button" value="姓名验证" name="yanzheng"  onclick='checknickname(5);' />
                                <iframe name="iframe" id="iframe" width="0" height="0" src="about:blank" style="display:none"></iframe>
                                </th>
                         </tr>
                            <script language="javascript">
                                function checknickname(lx)
                                {
                                    var iframe = document.getElementById("iframe");
                                    var user =  document.getElementById("snickname");
                                    iframe.src= "checknickname.php?lx="+lx+"&nickname="+user.value;
                                }
                            </script>
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