<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('PRC');
header("Content-Type: text/html;charset=utf-8");
include_once("../function.php");
include_once("../bonus.php");
include_once("../class/system_class.php");

$manager_id = $_GET['Manager_ID'];

if($manager_id != null){
    if($_SESSION['to_admin'] == null){
        alert("请勿非法操作!!!");
        return ;
    }
    if(checkID($manager_id)){alert("请勿非法操作!!!");return ;}
    $us=getMemberbyID($manager_id);
   
    $_SESSION['ID']=$us['id'];
    $_SESSION['nickname']=$us['nickname'];
    $_SESSION['username']=$us['username'];
    $_SESSION['userid']=$us['userid'];
    $_SESSION['isboss']=$us['isboss'];
    $_SESSION['sclogin']=$us['sclogin'];
    $_SESSION['bdid']=$us['bdid'];
    $_SESSION['isbd']=$us['isbd'];
    $_SESSION['bdlevel']=$us['bdlevel'];
}
$member = getMemberbyID($_SESSION['ID']);
if($member==null){
    echo "<script language=javascript>alert('您尚未登陆,请登陆后查看!.');window.location.href='../copyindex.php'</script>";
}
$sys=getOne("select * from systemparameters where id=1");
$information=que_select_cl('information',1);
$_system=new system_class();



$ul=ulevel($member['ulevel']);
$zjul = zjulevel($member['zjulevel']);
if ($zjul==null){
    $zjname='无';
}else {
    $zjname=$zjul['zjname'];
}
if ($ul==null){
    $uu='免费会员';
}else{
    $uu=$ul['lvname'];
}
$all=getall("select id from member where reid={$member['id']} and ispay>0 and islock=0");//会员资料
$nk=count($all);

//获取当前ip
$us=getMemberbyID();

function ip(){
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {  
		$ip = getenv('HTTP_CLIENT_IP');
	 } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {  $ip = getenv('HTTP_X_FORWARDED_FOR');
	  } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {  $ip = getenv('REMOTE_ADDR'); 
	  } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {  $ip = $_SERVER['REMOTE_ADDR']; 
	  } return preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : 'unknown';}
	  $ip=ip();

	  $us_update['ip']=$ip;

// 	  var_dump($us['id']);
	  edit_update_cl('member',$us_update,$_SESSION['ID']);
	  
	 
	
	  ?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>首页</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/sy.css">
<script src="js/jquery.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
  <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
	  <section class="heaBox">

        	<table>
            	<tr>
                	<td>
                    	<b><img src="images/userhead.jpg" alt=""/></b>
                    </td>
                	<td>
                    	<p>姓名：<?php echo $member['username'];?></p>
                    	<p>编号：<?php echo $member['userid'];?></p>
                    	<p>等级：<?php echo $ul['lvname'];?></p>
                        <p>职称：<?php echo $zjul['zjname'];?></p>
                    </td>
                </tr>
            </table>
            <ul class="clearfix">
            	<li>
                	<span><?php echo $member['zsq'];?></span>
                    <b>A积分余额</b>
                </li>
                <li>
                	<span><?php echo $member['cfxf'];?></span>
                    <b>B积分余额</b>
                </li>
                <?php
                    $y=date("Y",strtotime(now()));
                    $m=date("m",strtotime(now()));
                    $d=date("d",strtotime(now()));
                    $x=getOne("select sum(jine) from bonuslaiyuan where uid={$member['id']} and year(bdate)={$y} and month(bdate)={$m} and day(bdate)={$d}");
                ?>

                <li>
                <span><?php echo $member['mey'];?></span>
                    <b>C积分余额</b>
                </li>      
            </ul>
        </section>
        <section class="mainBox">
        	<ul class="clearfix">
        	<!-- 
            	<li>
                	<a href="hydb.php">
                    	<b>
                        	<img src="images/sy/icon1.png" alt=""/>
                        </b>
                        会员夺宝
                    </a>
                </li>
               -->

                  
                <!--	    <li>
                	<a href="fulijiang.php">
                    	<b>
                        	<img src="images/sy/icon1.png" alt=""/>
                        </b>
                        福利奖申请
                    </a>
                </li>
               <li>
                	<a href="video.php">
                    	<b>
                        	<img src="images/sy/icon7.png" alt=""/>
                        </b>
                       个人中心视频
                    </a>
                </li> -->
            	
            	<li>
                	<a href="register.php">
                    	<b>
                        	<img src="images/sy/icon4.png" alt=""/>
                        </b>
                        注册会员
                    </a>
                </li>
<!--            	<li>
                	<a href="jihuo.php">
                    	<b>
                        	<img src="images/sy/icon5.png" alt=""/>
                        </b>
                        激活会员
                    </a>
                </li>
                <li>
                	<a href="wdtj.php">
                    	<b>
                        	<img src="images/sy/icon5.png" alt=""/>
                        </b>
                        我的推荐
                    </a>
                </li>-->
<!--             	<li>
                	<a href="scgg.php">
                    	<b>
                        	<img src="images/sy/icon21.png" alt=""/>
                        </b>
                        <?php     $num=0;
                        $arr= getAll("select id from news where isedit=1");
                        foreach ($arr as $k=>$r){
                            $ne= getOne("select * from isnews where uid={$member['id']}");
                            if($ne["n".$r['id']]==0){
                                $num++;
                            }
                        }
                        if($num>0){?><h1 style="color:red">新闻公告 ( <?=$num?> )</h1><?php }else{?>
                        新闻公告
                        <?php }?>
                    </a>
                </li> -->
              
              
              
              
              
              
              
            	 <li>
                	<a href="huikuan.php">
                    	<b>
                        	<img src="images/sy/icon19.png" alt=""/>
                        </b>
                        积分充值
                    </a>
                </li>
                  	<li>
                	<a href="czjl.php">
                    	<b>
                        	<img src="images/sy/icon22.png" alt=""/>
                        </b>
                        充值记录
                    </a>
                </li>
                <?php
                if($member['isbd']==2)
                {?>
<!--                <li>
                	<a href="up.php">
                    	<b>
                        	<img src="images/sy/icon11.png" alt=""/>
                        </b>
                        发货列表
                    </a>
                </li> -->
                <?php
                }
                ?>
<!--                <li>
                	<a href="shengji.php">
                    	<b>
                        	<img src="images/sy/icon11.png" alt=""/>
                        </b>
                        升级申请
                    </a>
                </li> 
                <li>
                	<a href="sjjl.php">
                    	<b>
                        	<img src="images/sy/icon22.png" alt=""/>
                        </b>
                        升级记录
                    </a>
                </li>-->
                
             <!--       <li>
                	<a href="jiekuan.php">
                    	<b>
                        	<img src="images/sy/icon7.png" alt=""/>
                        </b>
                     借款申请
                    </a>
                </li> 
                
                 <li>
                	<a href="wytuiguang.php">
                    	<b>
                        	<img src="images/sy/icon7.png" alt=""/>
                        </b>
                     我要推广
                    </a>
                </li> 
             -->   
               <li>
                	<a href="jfxq.php">
                    	<b>
                        	<img src="images/sy/icon8.png" alt=""/>
                        </b>
                        积分转换
                    </a>
                </li>
              <li>
                	<a href="zhjl.php">
                    	<b>
                        	<img src="images/sy/icon22.png" alt=""/>
                        </b>
                        转换记录
                    </a>
                </li>
                <li>
                	<a href="jjzz.php">
                    	<b>
                        	<img src="images/sy/icon8.png" alt=""/>
                        </b>
                        会员转账
                    </a>
                </li>
                <li>
                	<a href="zhuanzhang.php">
                    	<b>
                        	<img src="images/sy/icon15.png" alt=""/>
                        </b>
                      转账记录
                    </a>
                </li> 
              
              
              
              
                <li>
                	<a href="tixian.php">
                    	<b>
                        	<img src="images/sy/icon11.png" alt=""/>
                        </b>
                        提取积分
                    </a>
                </li>
                <li>
                	<a href="txjl.php">
                    	<b>
                        	<img src="images/sy/icon22.png" alt=""/>
                        </b>
                        提取记录
                    </a>
                </li>
            <!--    <li>
                	<a href="fuli.php">
                    	<b>
                        	<img src="images/sy/icon15.png" alt=""/>
                        </b>
                       福利奖记录
                    </a>
                </li> --> 
                
                	<li>
                	<a href="jjzb.php">
                    	<b>
                        	<img src="images/sy/icon6.png" alt=""/>
                        </b>
                        奖励总表
                    </a>
            	
            	
            	
            	
            	<li>
                	<a href="jjmx.php">
                    	<b>
                        	<img src="images/sy/icon6.png" alt=""/>
                        </b>
                        奖励明细
                    </a>
                </li> 
                <?php
                if($member['zjulevel']>0){
                ?>
                <li>
                	<a href="yjtj.php">
                    	<b>
                        	<img src="images/sy/icon6.png" alt=""/>
                        </b>
                        业绩统计
                    </a>
                </li> 
                <?php }?>
                
<!--                <li>
                	<a href="gsdt.php">
                    	<b>
                        	<img src="images/sy/icon10.png" alt=""/>
                        </b>
                        排单大厅
                    </a>
                </li> -->
                
                	<li>
                	<a href="order.php">
                    	<b>
                        	<img src="images/sy/icon10.png" alt=""/>
                        </b>
                        我的订单
                    </a>
                </li> 
                <li>
                	<a href="jbxx.php">
                    	<b>
                        	<img src="images/sy/icon20.png" alt=""/>
                        </b>
                        基本信息
                    </a>
                </li>
                   	<li>
                	<a href="zhaq.php">
                    	<b>
                        	<img src="images/sy/icon12.png" alt=""/>
                        </b>
                        账户安全
                    </a>
                </li>
                
<!--                <li>
                	<a href="hylc.php">
                    	<b>
                        	<img src="images/sy/icon2.png" alt=""/>
                        </b>
                        实体展厅申请
                    </a>
                </li>-->

           
               
            	<!--  <li>
                	<a href="lsjl.php">
                    	<b>
                        	<img src="images/sy/icon7.png" alt=""/>
                        </b>
                        历史纪录
                    </a>
                </li>
                 -->
            	

           <!--	<li>
                	<a href="xpt.php">
                    	<b>
                        	<img src="images/sy/icon9.png" alt=""/>
                        </b>
                        系谱图
                    </a>
                </li> -->
           
            
           
                
                
         
            
           <!--  	<li>
                	<a href="wdxx.php">
                    	<b>
                        	<img src="images/sy/icon14.png" alt=""/>
                        </b>
                        我的消息
                    </a>
                </li>
           
                
              -->  

             	<li>
                	<a href="erweima.php">
                    	<b>
                        	<img src="images/sy/icon16.png" alt=""/>
                        </b>
                        我的二维码
                    </a>
                </li>
                
            	<!-- <li>
                	<a href="gskf.php">
                    	<b>
                        	<img src="images/sy/icon23.png" alt=""/>
                        </b>
                        公司客服
                    </a>
                </li> -->
          
            	<li>
                	<a href="../copyindex.php">
                    	<b>
                        	<img src="images/sy/icon18.png" alt=""/>
                        </b>
                        注销登录
                    </a>
                </li>
            </ul>
        </section>
  <?php include 'footer.php';?>
    
    <script>
		$(function(){
    		$("#gFooter li:nth-child(4)").addClass("on")
			
		})
    </script>
    </div>
</body>
</html>