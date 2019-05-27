<!DOCTYPE html>
<?php

// include("check.php");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/system_class.php");
include_once("../class/ulevel_class.php");
include_once("../class/bonus_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
if($_SESSION['ID']==null){
    echo "<script language=javascript>alert('您尚未登陆,请登录后查看!.');window.location.href='../copyindex.php'</script>";
}
if(tx(date("w"))<>1){
    echo "<script language=javascript>alert('今天不是工作日！');window.location.href='zhanghu.php'</script>";

}
$member=getMemberbyID($_SESSION['ID']);
$_bonus_cl = new bonus_class();
$_member_cl = new member_class();
$_ulevel_cl = new ulevel_class();
$_systemyeji=new system_class();
$_sys=$_systemyeji->system_information(1);
$sys=getOne("select * from systemparameters where id=1 ");
date_default_timezone_set('PRC');
$rs=getOne("select * from goods where id=".$_GET['goodid']." ");
$us=getMemberbyID($_SESSION['ID']);
$ul=ulevel($us['ulevel']);

if ($_GET['goodid']!=NULL){
    $goods=que_select_cl('goods',$_GET['goodid']);
    $goods['cis'] = $goods['cis']+1;
    echo edit_update_cl('goods', $goods,$_GET['goodid']);
    $jiage=$goods['price'];
    $shichangjia=$goods['shichangjia'];
//    if($goods['lx']==1){
//        $jiage=$ul['yl1'];
//    }else{
//        switch ($us['ulevel']){
//            case 1:    $jiage=$goods['price'];      break;
//            case 2:    $jiage=$goods['price1'];      break;
//            case 3:    $jiage=$goods['price2'];      break;
//            case 4:    $jiage=$goods['price3'];      break;
//            case 5:    $jiage=$goods['price4'];      break;
//            case 6:    $jiage=$goods['price5'];      break;
//            case 7:    $jiage=$goods['price6'];      break;
//            case 8:    $jiage=$goods['price7'];      break;
//            case 9:    $jiage=$goods['price8'];      break;
//        } 
//    }
    
    if($goods['goodsimg']){
        $img="../upload/".$goods['goodsimg'];
    }else{
        $img="img/shop/pho1.jpg";
    }
}
 else{
     header("location:shopping.php");
}
#搜索商品
if ($_POST['Search']){
    $SearchContent=$_POST['SearchContent'];
    if ($SearchContent!=NULL){
        $SearchType=$_POST['SearchType'];
        if ($SearchType==1){
            #搜索商品名称
            $_SESSION['Search']=" and goodsname like '%".$SearchContent."%' ";
        }
    }else{
        $_SESSION['Search']=NULL;
    }
}else{
    if ($_GET['page']==NULL){
        $_SESSION['Search']=NULL;
        $_SESSION['SearchTime']=NULL;
    }
}
if($_POST['submit']){
    $username=$_POST['username'];
    $usertel=$_POST['usertel'];
    $useraddress=$_POST['useraddress'];
    
    $err['useraddress']=$_POST['useraddress'];
    $err['sheng']=$_POST['province'];
    $err['shi']=$_POST['city'];
    $err['xian']=$_POST['area'];
    edit_update_cl('member', $err, $member['id']);
    if($_GET['goodid']==""){
        alert("请选择商品","?goodid=".$_GET['goodid']."");
        return;
    }else{
        
        if(!$_POST['username'] || !$_POST['useraddress'] || !$_POST['usertel']){
            alert("请将收货信息补充完整后购买!","show.php?goodid={$rs['id']}");
            return;
        }
        $rs=getOne("select * from goods where id=".$_GET['goodid']." ");
        $num=0;
        $lx=$rs['lx'];
        if($rs) {
            
            $i=$price=$sum=0;
                $i++;
                if($_POST["goodnum"]<0){
                    alert("商品数量不能小于零,请重新输入!","show.php?goodid={$rs['id']}");
                    return;
                }else{
//                    if($_POST["goodnum"]<$rs['shumu2'] || $_POST["goodnum"]%$rs['shumu2']<>0){
//                        alert("该产品的最低订货数为{$rs['shumu2']}，且需是{$rs['shumu2']}的倍数,请重新选择数量!","show.php?goodid={$rs['id']}");
//                        return;
//                    }
//                    
//                    $jiage=0;
//                    $jiage=$ul['yl1'];
                   $num+=$_POST["goodnum"];
                   $sum+=$_POST["goodnum"]*$rs['shumu'];
                   $zjine+=$jiage*$_POST["goodnum"];
                }
                $arr[$rs['id']] = array("id" => $rs['id'], "goodsname" => $rs['goodsname'], "num" => $_POST["goodnum"], "price" =>$jiage);
                if($member['mey']<$zjine){
                    echo "<script language=javascript>alert('您的C积分余额不足，购买失败！');window.location.href='show.php?goodid={$rs['id']}'</script>";exit;
                }
        }else{
            echo "<script language=javascript>alert('您操作有误！');window.location.href='good-list.php'</script>";exit;
        }
    }

    $sheng=$_POST['province'];   
    $shi=$_POST['city'];
    $xian=$_POST['area'];
    if($shi=="市辖区" || $shi=="县" || $shi=="市"){
        $shi="";
    }
    if($xian=="市辖区"){
        $xian="";
    }
    
    $ssx=$sheng.$shi.$xian;
    $FileID=date("ymdHis").rand(1000,9999);//订单号
    // $s= getMemberbyNickName($_POST['rname']);
    // $rs=getOne("select * from goods where id=".$_GET['goodid']." ");
//    if($rs['kucun']<$_POST["goodnum"]){
//        alert("库存不足");
//        return;
//    }
//    $goods_update['kucun']=$rs['kucun']-$_POST["goodnum"];
//    $goods_update['sales']=$rs['sales']+$_POST["goodnum"];
//    edit_update_cl('goods',$goods_update,$rs['id']);
    $or['uid']=$member['id'];
    $or['userid']=$member['nickname'];
    $or['ordersnumber']=$FileID;
    $or['useraddress']=$ssx.$useraddress;
    $or['usertel']=$usertel;
    $or['username']=$username;
    $or['lx']=2;
   
    $or['goodid']=$rs['id'];
    $or['goodname']=$rs['goodsname'];
    $or['price']=$jiage;
    $or['num']=$num;
    $or['lunci']=4;
    $or['gs']=1;
    $or['jine']=$jiage*$num;
    $or['date']=now();
    
    if ($member['isbd']==2){
        $or['bid']=$member['id'];
        $or['bnickname']=$member['nickname'];
    }else {
        $or['bid']=$member['bdid'];
        $or['bnickname']=$member['bdname'];
    }
    
    add_insert_cl('orders2',$or);
    
    //$_member_cl->addAreacx($member['id'],$or['jine']);
    $member_update['mey']=$member['mey']-$zjine;
    edit_update_cl('member',$member_update,$member['id']);

    //store($FileID,$arr,$member['id'],$member['nickname'],$username,$usertel,$ssx.$useraddress,$zjine,0,$lxx,0,$sum);    
    
    echo "<script language=javascript>alert('购买成功,本次消费C积分:{$zjine}');window.location.href='show.php?goodid={$rs['id']}'</script>";exit;
}

if($_POST['submit1']){
    $username=$_POST['username'];
    $usertel=$_POST['usertel'];
    $useraddress=$_POST['useraddress'];
    
    $err['useraddress']=$_POST['useraddress'];
    $err['sheng']=$_POST['province'];
    $err['shi']=$_POST['city'];
    $err['xian']=$_POST['area'];
    edit_update_cl('member', $err, $member['id']);
    if($_GET['goodid']==""){
        alert("请选择商品","?goodid=".$_GET['goodid']."");
        return;
    }else{
        
        if(!$_POST['username'] || !$_POST['useraddress'] || !$_POST['usertel']){
            alert("请将收货信息补充完整后购买!","show.php?goodid={$rs['id']}");
            return;
        }
        $rs=getOne("select * from goods where id=".$_GET['goodid']." ");
        $num=0;
        $lx=$rs['lx'];
        if($rs) {
            
            $i=$price=$sum=0;
                $i++;
                if($_POST["goodnum"]<0){
                    alert("商品数量不能小于零,请重新输入!","show.php?goodid={$rs['id']}");
                    return;
                }else{
//                    if($_POST["goodnum"]<$rs['shumu2'] || $_POST["goodnum"]%$rs['shumu2']<>0){
//                        alert("该产品的最低订货数为{$rs['shumu2']}，且需是{$rs['shumu2']}的倍数,请重新选择数量!","show.php?goodid={$rs['id']}");
//                        return;
//                    }
//                    
//                    $jiage=0;
//                    $jiage=$ul['yl1'];
                   $num+=$_POST["goodnum"];
                   $sum+=$_POST["goodnum"]*$rs['shumu'];
                   $zjine+=$shichangjia*$_POST["goodnum"];
                   $dan+=$jiage*$_POST["goodnum"];
                }
                $arr[$rs['id']] = array("id" => $rs['id'], "goodsname" => $rs['goodsname'], "num" => $_POST["goodnum"], "price" =>$shichangjia);
                $now=now();
               
                $y=date("Y");
                $m=date("m");
                $d=date("d");
                $one=getOne("SELECT * FROM `buysell` WHERE isgrant=0 and lx=1 and buyid=".$member['id']." and year(cdate)=".$y." and month(cdate)=".$m." and day(cdate)=".$d."");//
                //echo "SELECT * FROM `buysell` WHERE isgrant=0 and lx=1 and buyid=".$member['id']." and year(cdate)=".$y." and month(cdate)=".$m." and day(cdate)=".$d."";die();
                
                if($one!=null){
                    echo "<script language=javascript>alert('A积分每天只能购买一单，购买失败！');window.location.href='show.php?goodid={$rs['id']}'</script>";exit;
                }
                if($member['zsq']<$zjine){
                    echo "<script language=javascript>alert('您的A积分余额不足，购买失败！');window.location.href='show.php?goodid={$rs['id']}'</script>";exit;
                }
        }else{
            echo "<script language=javascript>alert('您操作有误！');window.location.href='good-list.php'</script>";exit;
        }
    }

    $sheng=$_POST['province'];   
    $shi=$_POST['city'];
    $xian=$_POST['area'];
    if($shi=="市辖区" || $shi=="县" || $shi=="市"){
        $shi="";
    }
    if($xian=="市辖区"){
        $xian="";
    }
    
    $ssx=$sheng.$shi.$xian;
  
    // $s= getMemberbyNickName($_POST['rname']);
    // $rs=getOne("select * from goods where id=".$_GET['goodid']." ");
//    if($rs['kucun']<$_POST["goodnum"]){
//        alert("库存不足");
//        return;
//    }
//    $goods_update['kucun']=$rs['kucun']-$_POST["goodnum"];
//    $goods_update['sales']=$rs['sales']+$_POST["goodnum"];
//    edit_update_cl('goods',$goods_update,$rs['id']);

    $FUID=date("ymdHis").$member['id'];//订单号
    
    $FileID=date("ymdHis").rand(1000,9999);//订单号
    
    $or['uid']=$member['id'];
    $or['userid']=$member['nickname'];
    $or['ordersnumber']=$FileID;
    $or['onb']=$FUID;
    $or['useraddress']=$ssx.$useraddress;
    $or['usertel']=$usertel;
    $or['username']=$username;
    $or['lx']=$lx;
    $or['goodid']=$rs['id'];
    $or['goodname']=$rs['goodsname'];
    $or['price']=$jiage;
    $or['num']=$num;
    
    $or['lunci']=1;
    $or['isqr']=1;
    
    $or['jine']=$jiage*$num;
    $or['date']=now();
    
    
    if ($member['isbd']==2){
        $or['bid']=$member['id'];
        $or['bnickname']=$member['nickname'];
    }else {
        $or['bid']=$member['bdid'];
        $or['bnickname']=$member['bdname'];
    }
   
    add_insert_cl('orders2',$or);
    
    //第二订单
    $FileID2=date("ymdHis").rand(1000,9999)."2";//订单号
    $or['ordersnumber']=$FileID2;
    $or['onb']=$FUID;
    $or['lunci']=2;
    $or['isqr']=0;
    add_insert_cl('orders2',$or);
    
    //第三订单
    $FileID3=date("ymdHis").rand(1000,9999)."3";//订单号
    $or['ordersnumber']=$FileID3;
    $or['onb']=$FUID;
    $or['lunci']=3;
    $or['isqr']=0;
    add_insert_cl('orders2',$or);
    
    
    if($member['ispay']==0){
        $_member_cl->jihuomember($member['id'],$dan);
    }

    $member_update['zsq']=$member['zsq']-$zjine;
    $member_update['cy']=1;
    edit_update_cl('member',$member_update,$member['id']);
    
    
    
    $_bonus_cl->zjulevel($member['id']);  
    $_bonus_cl->ircbuy($member,$FUID,$rs['id'],$rs['goodsname'],$dan);
    $_bonus_cl->ppbuy();
    
    
    $_bonus_cl->b0bonus();
        
        
    

    //store($FileID,$arr,$member['id'],$member['nickname'],$username,$usertel,$ssx.$useraddress,$zjine,0,$lxx,0,$sum);    
    
    echo "<script language=javascript>alert('购买成功,本次消费A积分:{$zjine}');window.location.href='show.php?goodid={$rs['id']}'</script>";exit;
}
if($_POST['submit2']){
    $err['useraddress']=$_POST['useraddress'];
    $err['sheng']=$_POST['province'];
    $err['shi']=$_POST['city'];
    $err['xian']=$_POST['area'];
    edit_update_cl('member', $err, $member['id']);
    if($_GET['goodid']==""){
        alert("请选择商品","?goodid=".$_GET['goodid']."");
        return;
    }else{
        
        $rs=getOne("select * from goods where id=".$_GET['goodid']." ");
        if($rs) {
            
            if ($you=getOne("select * from buycar where goodid={$_GET['goodid']} and uid=".$_SESSION['ID']."")) {
                
                alert("已经加入购物车，请勿重复添加","?goodid=".$rs['id']."");
            }else {
                
                $buycar['uid']=$member['id'];
                $buycar['nickname']=$member['nickname'];
                $buycar['goodid']=$rs['id'];
                $buycar['goodsname']=$rs['goodsname'];
                $buycar['price']=$rs['price'];
                $buycar['lx']=$rs['lx'];
                $buycar['goodsimg']=$rs['goodsimg'];
                $buycar['num']=$_POST["goodnum"];
                $buycar['yanse']=0;
                
                //$buycar['gdate']= now();
                add_insert_cl('buycar',$buycar);
                alert("成功加入购物车","?goodid=".$rs['id']."");
            }
        } 
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
<title>产品展示</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/show.css">
<link rel="stylesheet" type="text/css" href="ssx/style/cssreset-min.css">
<link rel="stylesheet" type="text/css" href="ssx/style/common.css">
<style type="text/css">
	.citys{
		margin-bottom: 10px;
	}
	.citys p{
		line-height: 28px;
	}
	.warning{
		color: #c00;
	}
	.main a{
		margin-right: 8px;
		color: #369;
	}
</style>
<script type="text/javascript" src="ssx/script/jquery.min.js"></script>
<script type="text/javascript" src="ssx/script/jquery.citys.js"></script>
<script>
 function check(){
        username=document.form1.username.value;
        usertel=document.form1.usertel.value;
        sheng=document.form1.province.value;
        //city=document.form1.city.value;
        area=document.form1.area.value;
        useraddress=document.form1.useraddress.value;
        if(username.length==0){
            alert("请输入收货人！");
            document.form1.username.focus();
            return false;
        }
        if(usertel.length==0){
            alert("请输入联系电话！");
            document.form1.usertel.focus();
            return false;
        }
        if(sheng==""){
            alert("请选择省份！");
            
            return false;
        }
        if(area==""){
            alert("请选择区县！");
            return false;
        }
        if(useraddress.length==0){
            alert("请输入详细地址！");
            document.form1.useraddress.focus();
            return false;
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
   	   <form  name="form1" method="post" action="?goodid=<?=$goods['id']?>" onsubmit="return check();">
        	<div class="table1 table2" style="border:none">
            	<table class="tab">
            	
                	<tr>
                    	<td align="center">
                        	<img src="../upload/<?=$goods['goodsimg']?>" alt=""/>
                        </td>
                    </tr>
                    <tr>    
                        <td>
                        	 
                        	<h3><?=$goods['goodsname']?>
                                    <p class="clearfix"><span>销量：<?=$goods['sales']?></span></p>
                                    <p class="clearfix"><span>库存：<?=$goods['kucun']?></span></p>
                                </h3>
                                
                            
                            
<!--                            <p><strong>零售价:</strong><s>￥<?=$goods['shichangjia']?>  </s></p>-->
                            
                            <input type="hidden" name="price" value="<?=$jiage?>"/>
                            <p><strong>A积分价格:￥<?=$goods['shichangjia']?>  </strong></p>
                            <p><strong>C积分价格:￥<?=$jiage?>  </strong></p>
                            <p><strong>最低订货:<?=$goods['shumu2']?></strong></p>
                             	   
                            
                            <!-- <p class="clearfix"><span>库存：<?=$goods['kucun']?></span><span class="spa2">库存：<?=$goods['kucun']?></span></p> -->
                           
                          
                            <div class="add-plus-input">
                                购买数量：<a href="javascript:;" class="add btn" >+</a><input type="text" class="num" value="<?=$goods['shumu2']?>" readonly
                                 name="goodnum" onKeyUp="jiage(this,'<?=$jia?>');"/><a href="javascript:;" class="plus btn">-</a>
                             	</div>
<!--                            <p>C积分总价:<strong><label  style="color:red"id="xj" name="xj"><?=$jiage*$goods['shumu2']?></label></strong></p>-->
                            <p>A积分余额:<strong><label><?=$member['zsq']?></label></strong></p>
                            <p>C积分余额:<strong><label><?=$member['mey']?></label></strong></p>
                              <!-- 	
                             <p >购买数量:</p>
                            	<b></b>
                             <input type="text" name="goodnum" onKeyUp="jiage(this,'<?=$price?>');" value="1"/> 	   
                              -->	
                                
						
                        </td>
                    
                    	
                    </tr>
              
                       <tr>
                             <td>
                             	   姓名
                             	   <input type="text" name="username" value="<?php echo $member['username']?>" placeholder="输入姓名"/>
                             	    <input type="text" style="display:none" name="UID" id="UID" value="<?=$goods['id']?>"/>
                             </td>
                         </tr>
                         <tr>
                             <td>
                             	  电话
                             	  <input type="text" name="usertel" value="<?php echo $member['usertel']?>" placeholder="输入电话" />
                             </td>
                         </tr>
                         <tr>
                    	<td>
                        	
                            
                            <div id="demo1" class="citys">
                <label>地区</label>
                    <script type="text/javascript" src="js/jsAddress.js"></script>
                    <select style=" width: 100px;" id="province" name="province" ></select>
                    <select style=" width: 100px;" id="city" name="city"></select>
                    <select style=" width: 100px;" id="area" name="area" ></select>


                    <script type="text/javascript">
                        addressInit('province', 'city', 'area','<?=$sheng?>','<?=$shi?>','<?=$xian?>');
                    </script>
              
            </div>
                        </td>
                       
                    </tr>
                          <tr>
                             <td>
                             	   地址
                             	   <input type="text" name="useraddress" value="<?php echo $member['useraddress']?>" placeholder="输入地址"/>
                             </td>
                         </tr>
                          
<!--                          <tr>
                             <td>
                             	  支付方式
                                   <select id="pay" name="pay">
                                     <option value=1>积分</option>
                                     <option value=2>微信</option>
                                   </select>
                             </td>
                         </tr>-->
                        <tr>
                        	<td>
 <!--                            	<?php if($goods['lx']<>1){?>
                                <?php if(getOne("select id from buycar where goodid={$goods['id']} and uid=".$_SESSION['ID']."")==null){?>
                                           <input type="submit" value="加入购物车" name="submit2" class="butt2" onClick="{if(confirm('您确定要加入购物车吗?')){this.document.selform.submit();return true;}return false;}"/>
                                            <?php }else{?>
                                           <input type="button" class="butt2" style=" background-color: #009933" value="已加入购物车" />

                                <?php }?>
                                <?php }?>-->
                                           <input type="submit" value="A积分购买" name="submit1" class="butt1" onClick="{if(confirm('您确定要购买吗?')){this.document.selform.submit();return true;}return false;}"/>
                                           <input type="submit" value="C积分购买" name="submit" class="butt1" onClick="{if(confirm('您确定要购买吗?')){this.document.selform.submit();return true;}return false;}"/>
                            </td>
                            
                        </tr>
                        
                </table>
            </div>
            
            <div class="table2">
               
                    <!-- 
                        <tr>
                            <td>
                            
                            
                                颜色：
                                <div class="span">
                                        <input type="checkbox" value="" name="che1"/>
                                        <span>黑色</span>
                                </div>
                                <div class="span">
                                        <input type="checkbox" value="" name="che1"/>
                                        <span>白色</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                规格：
                                <div class="span">
                                        <input type="checkbox" value="" name="che1"/>
                                        <span>M</span>
                                </div>
                                <div class="span">
                                        <input type="checkbox" value="" name="che1"/>
                                        <span>L</span>
                                </div>
                                <div class="span">
                                        <input type="checkbox" value="" name="che1"/>
                                        <span>XL</span>
                                </div>
                            </td>
                        </tr>
                         -->
                          
                         <!-- 
                         <tr>
                             <td>
                             	特惠券账户 <label name="sgb" id="sgb"><?=$member['sgb']?></label>
                                <input type="hidden" name="goodid" value="<?=$goods['id']?>" />
                             </td>
                         </tr>
                         <tr>
                             <td>
                             	积分账户 <label name="zsq" id="zsq"><?=$member['zsq']?></label>
                                <input type="hidden" name="goodid" value="<?=$goods['id']?>" />
                             </td>
                         </tr>
                          -->
                          <!-- 
                         <tr>
                             <td>
                             	商品总价 <label name="zongjiage" id="zongjiage">积分:<?=$goods['price']?>&nbsp;特惠券:<?=$goods['price2']?></label>
                                
                             </td>
                         </tr>
                          -->
							<style type="text/css">
                            .add-plus-input{
                            white-space: nowrap;
							margin-top:6px;
                            }
                            .add-plus-input .btn,
                            .add-plus-input .num{
                            height: 30px;
                            line-height: 30px;
                            text-align: center;
                            vertical-align: middle;
                            }
                            .add-plus-input .num{
                            border-top: 1px solid #999;
                            border-bottom: 1px solid #999;
                            border-left: 0;
                            border-right: 0;
                            width: 50px;
							padding:0;
                            }
                            .add-plus-input .btn{
                            border: 1px solid #999;
                            display: inline-block;
                            text-decoration: none;
                            width: 30px;
							font-size:22px;
                            }
                            </style>

<!-- 
                            <script src="http://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
                            <script type="text/javascript">
                                 
                            $(function() {
                            $(".add-plus-input .add").click(function() {
                            var $num = $(this).next(".num");
                            var price=document.form1.price.value;//j1
                            var number = $num.attr("value");
                            $num.attr("value",parseInt(number) + <?=$goods['shumu2']?>);
                            document.getElementById("xj").innerHTML=(parseInt(number) + <?=$goods['shumu2']?>)*price+'.00';
                            });
                            $(".add-plus-input .plus").click(function() {
                            var $num = $(this).prev(".num");
                            var price=document.form1.price.value;//j1
                            var number = $num.attr("value");
                            if(parseInt(number)><?=$goods['shumu2']?>){
                            	$num.attr("value",parseInt(number) - <?=$goods['shumu2']?>);
                                document.getElementById("xj").innerHTML=(parseInt(number) - <?=$goods['shumu2']?>)*price+'.00'; 
                             }
                            });
                            })
                            </script>

                 -->        
                         
                        <!--  
                         <tr>
                             <td>
                             	   交易密码
                             	   <input type="password" value="" name="password2" placeholder="请输入交易密码"/>
                             </td>
                         </tr>
                           -->
                 </form>
            </div>
            
            
            <div class="table3">
            	<h2>商品详情</h2>
                <div class="pic00 box">
                	<img  src="<?=$img?>" alt=""/>
                	<p><?=$goods['goodscontent']?></p>
                </div>
            </div>
            
            
        </div>
    <br/><br/><br/><br/><br/>
    </section><?php include 'footer.php';?>
    
</body>
</html>