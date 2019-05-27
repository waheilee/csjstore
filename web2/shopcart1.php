<!DOCTYPE html>
<?php 
session_start();
header("Content-Type: text/html;charset=utf-8");
// include("check.php");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");
include_once("../class/system_class.php");
$member=getMemberbyID($_SESSION['ID']);
$ulevel_cl=new ulevel_class();
$_member_cl=new member_class();
$_bonus_cl=new bonus_class();
$iul=$ulevel_cl->getulevelbyulevel($member['ulevel']);
$sys=getOne("select * from systemparameters where id=1 ");
if($_POST['button2']){
    if($_POST['UID']==""){
        
        alert("请选择商品","?");
        return;
    }
    foreach($_POST['UID'] as $v){
        
        
        $sql="select * from buycar where goodid=".$v." and uid=".$_SESSION['ID']."";
        $rows=getOne($sql);
        edit_delete_cl('buycar',$rows['id']);
        
    }
    
    echo "<script language=javascript>alert('删除成功.');window.location.href='?'</script>";
}
if($_POST['button3']){
        
        $sql="select * from buycar where uid=".$_SESSION['ID']."";
        $arr=getall($sql);
        foreach($arr as $v){
        	edit_delete_cl('buycar',$v['id']);
        } 
    echo "<script language=javascript>alert('清空购物车成功.');window.location.href='?'</script>";
}
if($_POST['button']){  
    $username=$_POST['username'];
    $usertel=$_POST['usertel'];
    $useraddress=$_POST['useraddress'];   
    if ($username==null || $usertel==null || $useraddress==null){
        alert("请填写收货人、收货地址、联系电话","?");
        return;
    } 
//     if ($_POST['lx']==-1){
//         alert("请选择支付方式","?");
//         return;
//     } 
    if($_POST['UID']==""){
        alert("请选择商品","?");
        return;
    }else{
        $i=$price=$price1=$price2=$daijin=$daijin1=$daijin2=0;
        foreach($_POST['UID'] as $v){
            $i++;
            $rs=getOne("select * from goods where id={$v}");
            if ($i==1){
                $lx=$rs['lx'];
            }else {
                if ($rs['lx']!=$lx){
                    alert("每次只能购买一种类型的商品","?");
                    return;
                }
            }                                                                  
            $arr[$rs['id']]=array("id"=>$rs['id'],"goodsname"=>$rs['goodsname'],"num"=>$_POST[$rs['id']."num"],"price"=>$rs['price']);
            if($_POST[$rs['id']."num"]==0){    //是否输入商品数量
                alert("请输入商品数量","?");
                return;
            }
            else{
//              if($member['zjulevel']>0){
//	                $price=$rs['price']*$sys['zhe']/10*$_POST[$rs['id']."num"];//商品数量的总价格
//              }elseif($member['ulevel']==1){
//	                $price=$rs['price']*$iul['yl1']/10*$_POST[$rs['id']."num"];//商品数量的总价格
//              }elseif($member['ulevel']==2){
//	                $price=$rs['price']*$iul['yl1']/10*$_POST[$rs['id']."num"];//商品数量的总价格
//              }
	        $price=$rs['price']*$_POST[$rs['id']."num"];
                $price1=$rs['price']*$_POST[$rs['id']."num"];
                $price2+=$rs['price2']*$_POST[$rs['id']."num"];
                $daijin+=$price;//积分
		        $daijin2+=$price2;//金额
                if ($member['zsq'] < $daijin){
                    alert("您的现金不足","?goodid=".$_POST['goodid']."");
                    return;
                }if ($member['sgb'] < $daijin2){
                    alert("您的特惠券不足","?goodid=".$_POST['goodid']."");
                    return;
                }
                
//                if ($rs['lx']==1){
//                    if ($member['cfxf'] < $daijin) {
//                        alert("您的商城积分余额不足", "?goodid=".$_POST['goodid']."");
//                        return;
//                    }
//                    if ($member['zsq'] < $daijin1) {
//                        alert("您的现金余额不足", "?goodid=".$_POST['goodid']."");
//                        return;
//                    }
//                }elseif ($rs['lx']==4){
//                    if ($member['zsq'] < $daijin1) {
//                        alert("您的现金余额不足", "?goodid=".$_POST['goodid']."");
//                        return;
//                    }
//                }else{
//                    alert("商品类型有误", "?goodid=".$_POST['goodid']."");
//                    return;
//                }
                
            }
        } 
//      if ($daijin<$sys['d1']){
//          $fy=$sys['d2'];
//      }else {
//          $fy=0;
//      }
       
    }
    $FileID=date("ymdH").rand(100,999);//订单号
    foreach($_POST['UID'] as $vf){
        $rs=getOne("select * from goods where id={$vf}");
        $goods_update['kucun']=$rs['kucun']-$_POST[$rs['id']."num"];
        $goods_update['sales']=$rs['sales']+$_POST[$rs['id']."num"];
//		$goods_update['kucun']=$rs['kucun']-$v['num'];
//      $goods_update['sales']=$rs['sales']+$v['num'];
		if($goods_update['kucun']<0){
            alert("库存不足,请减少购买数量","?");
            return;
        }
        edit_update_cl('goods',$goods_update,$rs['id']);	
	$or['uid']=$member['id'];
        $or['userid']=$member['nickname'];
        $or['ordersnumber']=$FileID;
        $or['useraddress']=$useraddress;
        $or['usertel']=$usertel;
        $or['username']=$username;
        $or['lx']=$lx;
        $or['goodid']=$rs['id'];
        $or['goodname']=$rs['goodsname'];
//		if($member['zjulevel']>0){
//          $or['price']=$rs['price']*$sys['zhe']/10;
//		}elseif($member['ulevel']==1){
//          $or['price']=$rs['price']*$iul['yl1']/10;
//		}elseif($member['ulevel']==2){
//          $or['price']=$rs['price']*$iul['yl1']/10;
//		}
        $or['price']=($rs['price']*$sys['d1'])/10;
        $or['price2']=($rs['price2']*$sys['d1'])/10;
        $num=$_POST[$rs['id']."num"];
        $or['num']=$num;
        $or['jine']=($num*$rs['price']*$sys['d1'])/10;
        $or['jine2']=($num*$rs['price2']*$sys['d1'])/10;
       
        $or['date']=now();
        add_insert_cl('orders2',$or);
       
    }
    $zje=$daijin+$daijin2;
    $member_update['zsq']=$member['zsq']-$daijin;
    $member_update['sgb']=$member['sgb']-$daijin2;
    edit_update_cl('member',$member_update,$member['id']);
    
    
    
//    $level= getOne("select j1 from jiandian where id=1");
//    $a= getMemberbyID($member['id']);
//    if(($a['fanli']+$a['dan2'])>=$level['j1']){
//        $member_up['iscx']=1;
//        edit_update_cl('member',$member_up,$a['id']);
//    }

    $FileID0=store($FileID,$arr,$member['id'],$member['nickname'],$username,$usertel,$useraddress,$daijin,$lsk,$lx);  /////
    $us=getMemberbyID($_SESSION['ID']);
    //$_member_cl->addAreacx($us['id'],$daijin);//加业绩，  重消
    $_systemyeji=new system_class();
    $_systemyeji->yejitongji(0,0,$zje,0,0,0,0);  //计算波比
    $_sys=$_systemyeji->system_information(1);
    $_update_system['yeji']=$_sys['yeji']+$zje;
    $_update_system['fanli']=$_sys['fanli']+$zje;
    $_systemyeji->system_update($_update_system);

    //清空购物车
    foreach($_POST['UID'] as $vv){
        
        $rs=getOne("select * from buycar where goodid={$vv} and uid=".$_SESSION['ID']."");
        
       if ($rs){
       
        edit_delete_cl('buycar',$rs['id']);
       }
    }
    
   
    // $_bonus_cl->b0bonus();

        alert("购买成功,花费现金:".$daijin." 花费特惠券:".$daijin2."","?goodid=".$rs['id']."");
}
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>购物车</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/cart.css">
<script src="js/jquery.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	<?php include 'header.php';?>
    
    </header><!-- #EndLibraryItem --><section id="main">
	  <div class="mainBox">
        <form action="" method="post">
        	  
              <div class="caBox">
              	<table class="tabl1">
                	<tr>
                    	<td>
                        	<div class="check">
                            	<input type="checkbox" value="" name="chd"/>
                                <span></span>
                            </div>
                        </td>
                        <td style="text-align:center; width:80px;"><img src="images/pho4.jpg" alt=""/></td>
                        <td>
                        	<h3>名称名称名称名</h3>
                            <strong>特惠券100</strong>
                            <strong>现金100</strong>
                            <div class="add-plus-input">
                                <a href="javascript:;" class="add btn">+</a><input type="text" class="num" value="0" 
                                 name="goodnum" onKeyUp="jiage(this,'<?=($goods['price']+$goods['price2'])?>');"
                                /><a href="javascript:;" class="plus btn">-</a>
                             	</div>
                        </td>
                    </tr>
                </table>
               	<table class="tabl2">
                	<tr>
                    	<td class="td1 td">销量：1000</td>
                    	<td class="td2 td">库存：1</td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<label>收货人</label>
                            <input type="text" value="" name="name"/>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<label>联系电话</label>
                            <input type="text" value="" name="name"/>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<label>收获地址</label>
                            <input type="text" value="" name="name"/>
                        </td>
                    </tr>
                    <tr class="last">
                    	<td colspan="2">
                        	<input type="button" value="清空购物车" name="btn" class="butt1"/>
                        	<input type="button" value="立即购买" name="btn" class="butt2"/>
                        </td>
                    </tr>
                </table>
              
              
              </div>
              <br/> <br/> <br/> <br/>
              <script src="http://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
                            <script type="text/javascript">
                            $(function() {
                            $(".add-plus-input .add").click(function() {
                            var $num = $(this).next(".num");
                            
                            var number = $num.attr("value");
                            $num.attr("value",parseInt(number) + 1);
                            });
                            $(".add-plus-input .plus").click(function() {
                            var $num = $(this).prev(".num");
                            var number = $num.attr("value");
                            $num.attr("value",parseInt(number) - 1);
                            });
                            })
                         </script>
           
            
        </form>      
    </div>
        
  
    <!-- 
                          
     -->
    
  </section>
<?php include 'footer.php';?>
    
    
    <script>
		$(function(){
    		$("#gFooter li:nth-child(3)").addClass("on")
			
		})
    </script>
    </div>
</body>
</html>