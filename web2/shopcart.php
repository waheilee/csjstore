<!DOCTYPE html>
<?php 
session_start();
header("Content-Type: text/html;charset=utf-8");
//include("check.php");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/ulevel_class.php");
include_once("../class/bonus_class.php");
include_once("../class/system_class.php");
$member=getMemberbyID($_SESSION['ID']);
$ulevel_cl=new ulevel_class();
$_member_cl=new member_class();
$_bonus_cl=new bonus_class();
$iul=$ulevel_cl->getulevelbyulevel($member['ulevel']);
$sys=getOne("select * from systemparameters where id=1 ");
if($member==null){
    echo "<script language=javascript>alert('您尚未登陆,请登陆后查看!.');window.location.href='../copyindex.php'</script>";
}
$zong= getOne("select sum(price*num) from buycar where yanse=1 and uid=".$_SESSION['ID']."");
$zongjiage=$zong['sum(price*num)']>0 ? $zong['sum(price*num)']:0;
//删除商品
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
//清空购物车
if($_POST['button3']){
        $sql="select * from buycar where uid=".$_SESSION['ID']."";
        $arr=getall($sql);
        foreach($arr as $v){
        	edit_delete_cl('buycar',$v['id']);
        } 
    echo "<script language=javascript>alert('清空购物车成功.');window.location.href='?'</script>";
}
//购买
if($_POST['button']){  
    $username=$_POST['username'];
    $usertel=$_POST['usertel'];
    $useraddress=$_POST['useraddress'];   
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
    
    $err['useraddress']=$_POST['useraddress'];
    $err['sheng']=$_POST['province'];
    $err['shi']=$_POST['city'];
    $err['xian']=$_POST['area'];
    edit_update_cl('member', $err, $member['id']);
    if ($username==null || $usertel==null || $useraddress==null){
        alert("请填写收货人、详细地址、联系电话","?");
        return;
    } 
    //var_dump($_POST['UID']);die;
    if($_POST['UID']==""){
        alert("请选择商品","?");
        return;
        
    }else{
        $i=$daijin=$shumu=0;
        foreach($_POST['UID'] as $v){
            $buy=getOne("select * from buycar where id={$v}");
            $i++;
            $rs=getOne("select * from goods where id={$buy['goodid']}");    
            if($buy["goodnum"]%$rs['shumu2']<>0 || $buy["goodnum"]<$rs['shumu2']){
                edit_delete_cl('buycar',$buy['id']);
                alert("产品{$rs['goodsname']}的最低订货数为{$rs['shumu2']}，且需是{$rs['shumu2']}的倍数,请重新加入购物车!","?");
                return;
            }
            $arr[$rs['id']]=array("id"=>$rs['id'],"goodsname"=>$rs['goodsname'],"num"=>$buy['num'],"lx"=>$buy['lx'],"price"=>$buy['price']);
            $shumu+=$buy['shumu']*$buy['num'];
            $jf=$buy['price']*$buy['num'];
            $daijin+=$jf; 
//            if($_POST[$rs['id']."num"]==0){    //是否输入商品数量
//                alert("请输入商品数量","?");
//                return;
//            }
//            if($_POST[$rs['id']."num"]<0){    //是否输入商品数量
//                alert("商品数量不能小于零,请重新输入!","?");
//                return;
//            }
            if ($member['mey'] < $daijin){
                alert("您的积分余额不足","?");
                return;
            }    
        }
    }   
   
    $FileID=date("ymdH").rand(100,999);//订单号
    foreach($_POST['UID'] as $vf){
        $v=getOne("select * from buycar where id={$vf}");
        $rs=getOne("select * from goods where id={$v['goodid']}");
        $or['uid']=$member['id'];
        $or['userid']=$member['nickname'];
        $or['ordersnumber']=$FileID;
        $or['useraddress']=$ssx.$useraddress;
        $or['usertel']=$usertel;
        $or['username']=$username;
        $or['lx']=$rs['lx'];
        $or['goodid']=$rs['id'];
        $or['goodname']=$rs['goodsname'];
        $or['price']=$v['price'];
        $or['goodid']=$rs['id'];
        $or['goodname']=$rs['goodsname'];

        $or['num']=$v['num'];
        $or['jine']=$v['price']*$v['num'];
        $or['date']=now();
        add_insert_cl('orders2',$or);
    } 
    $member_update['mey']=$member['mey']-$daijin;
    edit_update_cl('member',$member_update,$member['id']);
    store($FileID,$arr,$member['id'],$member['nickname'],$username,$usertel,$ssx.$useraddress,$daijin,0,2,0,$shumu);    
//    $_bonus_cl->yeji_leiji($member['id'],$member['nickname'], $daijin, 1);
    //清空购物车
    foreach($_POST['UID'] as $vv){
        $rs=getOne("select id from buycar where id={$vv} and uid=".$_SESSION['ID'].""); 
        if ($rs){
            edit_delete_cl('buycar',$rs['id']);
        }
    }
    alert("购买成功,花费积分:{$daijin}","?");
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
    function num(id,num,n){
        $.ajax({
         type: "POST",
         url : "ajax.php",
         datatype : 'json',
         data: {'id':id,'num':num,'n':n} ,
         success :function (data) {
//           document.getElementById("rusername").innerHTML=data;

           document.getElementById("zongjiage").innerHTML=data+".00";
         }
       });
       $.ajax({
         type: "POST",
         url : "ajax.php",
         datatype : 'json',
         data: {'gid':id} ,
         success :function (data) {
//           document.getElementById("rusername").innerHTML=data;

           document.getElementById(id+"jiage").innerHTML=data+".00";
         }
       })
    }
    function del(did){
        document.getElementById("l"+did).style.display="none";
        $.ajax({
         type: "POST",
         url : "ajax.php",
         datatype : 'json',
         data: {'did':did} ,
         success :function (data) {
            
//           document.getElementById("rusername").innerHTML=data;
           document.getElementById("zongjiage").innerHTML=data+".00";
         }
       });
    }
    function check(){
        username=document.form.username.value;
        usertel=document.form.usertel.value;
        sheng=document.form.province.value;
        //city=document.form.city.value;
        area=document.form.area.value;
        useraddress=document.form.useraddress.value;
        if(username.length==0){
            alert("请输入收货人！");
            document.form.username.focus();
            return false;
        }
        if(usertel.length==0){
            alert("请输入联系电话！");
            document.form.usertel.focus();
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
            document.form.useraddress.focus();
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
        <form action="" name="form" method="post" onsubmit="return check();">
        	  
              <div class="caBox">
              	<table class="tabl1">
                    <tr>
                        <td align="center">选择</td>
                        <td align="center">商品图片</td>
                        <td align="center">商品详情</td>
                        <td align="center">商品数量</td>
<!--                        <td align="center">商品小计</td>-->
                        <td align="center">删除</td>
                    </tr>
              		<?php
				  	$pagesize = 100; //设置每页记录数 
					$sql = "SELECT * FROM `buycar` WHERE 1=1 and uid=".$_SESSION['ID']."";
					$arr=getall($sql);
			      	$i=0;
                    if($arr){
					foreach ($arr as $key =>$r){
			        $i++;
			        $sql="select * from goods where id=".$r['goodid']." ";
			        $row=getOne($sql);
			        
			        ?>
                    <tr name="l<?=$r['id']?>" id="l<?=$r['id']?>">
                    	<td>
                        	<div class="check">
                        	 
       
                                <input type="checkbox" name="UID[]" id="UID" <?php if($r['yanse']==1){?>checked<?php }?> value="<?=$r['id']?>"onclick="affirm(this);num('<?=$r['id']?>',0,1);" class="check"/>
                                	     <span></span>
                            </div>
                        </td>
                          <script>  
    $(function(){  
        $(".pimg").click(function(){  
            var _this = $(this);//将当前的pimg元素作为_this传入函数  
            imgShow("#outerdiv", "#innerdiv", "#bigimg", _this);  
        });  
    });  

    function imgShow(outerdiv, innerdiv, bigimg, _this){  
        var src = _this.attr("src");//获取当前点击的pimg元素中的src属性  
        $(bigimg).attr("src", src);//设置#bigimg元素的src属性  
      
            /*获取当前点击图片的真实大小，并显示弹出层及大图*/  
        $("<img/>").attr("src", src).load(function(){  
            var windowW = $(window).width();//获取当前窗口宽度  
            var windowH = $(window).height();//获取当前窗口高度  
            var realWidth = this.width;//获取图片真实宽度  
            var realHeight = this.height;//获取图片真实高度  
            var imgWidth, imgHeight;  
            var scale = 0.8;//缩放尺寸，当图片真实宽度和高度大于窗口宽度和高度时进行缩放  
              
            if(realHeight>windowH*scale) {//判断图片高度  
                imgHeight = windowH*scale;//如大于窗口高度，图片高度进行缩放  
                imgWidth = imgHeight/realHeight*realWidth;//等比例缩放宽度  
                if(imgWidth>windowW*scale) {//如宽度扔大于窗口宽度  
                    imgWidth = windowW*scale;//再对宽度进行缩放  
                }  
            } else if(realWidth>windowW*scale) {//如图片高度合适，判断图片宽度  
                imgWidth = windowW*scale;//如大于窗口宽度，图片宽度进行缩放  
                            imgHeight = imgWidth/realWidth*realHeight;//等比例缩放高度  
            } else {//如果图片真实高度和宽度都符合要求，高宽不变  
                imgWidth = realWidth;  
                imgHeight = realHeight;  
            }  
                    $(bigimg).css("width",imgWidth);//以最终的宽度对图片缩放  
              
            var w = (windowW-imgWidth)/2;//计算图片与窗口左边距  
            var h = (windowH-imgHeight)/2;//计算图片与窗口上边距  
            $(innerdiv).css({"top":h, "left":w});//设置#innerdiv的top和left属性  
            $(outerdiv).fadeIn("fast");//淡入显示#outerdiv及.pimg  
        });  
          
        $(outerdiv).click(function(){//再次点击淡出消失弹出层  
            $(this).fadeOut("fast");  
        });  
    }  
		</script> 
		<div id="outerdiv" style="position:fixed;top:0;left:0;background:rgba(0,0,0,0.7);z-index:2;width:100%;height:100%;display:none;">
    	<div id="innerdiv" style="position:absolute;">
        <img id="bigimg" style="border:5px solid #fff;" src="" />
    	</div>
		</div>  
	
                        <td style="text-align:center; width:80px;"><?php if($row['goodsimg']){?><img height="70"  class="pimg" width="70" style="cursor:pointer;" src="../upload/<?=$row['goodsimg']?>" /><?php }else{?>暂无<?php }?></td>
                       
                        
                        <td>
                        	 <?php 
                            $lxx='价格';
                            $jia=$r['price'];
                            

                                 
                                 
                                 ?>
                        	<h3><?=$row['goodsname']?></h3>
                         
                            <strong>    
                          <?=$lxx?>￥<?=$jia?> 
                             </strong>
<!--                            <strong>    
                          库存： 
                             </strong>-->
                             
                   
                           <?php
                                  
                                          ?>
                                       
                                          
                             
                          
                        </td>
                        <td align="center" style="text-align:center; width:80px;">
                              <div class="add-plus-input">
                                <a href="javascript:;" class="add btn" onclick="num('<?=$r['id']?>',1,0);">+</a>
                               <input type="text" class="num" value="<?=$r['num']?>" readonly="readonly" name="<?=$row['id']?>num" id="<?=$row['id']?>num"/><a onclick="num('<?=$r['id']?>',-1,0);" href="javascript:;" class="plus btn">-</a>
                             	</div>
                            
                        </td>
                        <script src="http://cdn.bootcss.com/jquery/1.11.0/jquery.min.js"></script>
                            <script type="text/javascript">
                            $(function() {
                            $(".add-plus-input .add").click(function() {
                            var $num = $(this).next(".num");
                            
                            var number = $num.attr("value");
                            $num.attr("value",parseInt(number) + <?=$row['shumu2']?>);
                            });
                            $(".add-plus-input .plus").click(function() {
                            var $num = $(this).prev(".num");
                            var number = $num.attr("value");
                            if(parseInt(number)><?=$row['shumu2']?>){
                            	$num.attr("value",parseInt(number) - <?=$row['shumu2']?>);
                             }
                            
                            });
                            
                            })
                         </script>
                        <td  style=" display: none;text-align:center; width:80px;"><label name="<?=$r['id']?>jiage" id="<?=$r['id']?>jiage"><?=$jia*$r['num']?></label></td>  
                     <td style="text-align:center; "><a onclick="del('<?=$r['id']?>');" href="javascript:;">X</a></td>  
                     
                    </tr>
                    <?php }}else{?>	
                    <tr><td align="center" colspan="15">购物车内暂无商品 , <a style="color:blue" href="shopping1.php">前往商城</a></td></tr>  
                     <?php }?>
                </table>
               	<table class="tabl2">
                    	<tr>
                            <td colspan="2">
                        	<label>总价格</label>
                            <label name="zongjiage" id="zongjiage"><?=$zongjiage?></label>
                        </td>
                    </tr>
                    <tr>
                            <td colspan="2">
                        	<label>积分余额</label>
                            <label name="yue" id="yue"><?=$member['mey']?></label>
                        </td>
                    </tr><!--
                     
                     <tr>
                     	<td >
                     		<label>支付方式:</label>
                     		<select name="fs" id="fs">
                     				<option value="1">现金</option>
                     				<option value="2">特惠券</option>
                     		</select>
                     	</td>
                     </tr>
                     -->
                   <tr>
                    	<td colspan="2">
                        	<label>收货人</label>
                            <input type="text" value="<?=$member['username']?>" placeholder="请输入收货人" name="username"/>
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<label>联系电话</label>
                            <input name="usertel" type="text" placeholder="请输入联系电话" value="<?=$member['usertel']?>"/>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	
                            
                            <div id="demo1" class="citys">
                <label>收货地区</label>
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
                    	<td colspan="2">
                        	<label>详细地址</label>
                            <input name="useraddress" type="text" placeholder="请输入详细地址" value="<?=$member['useraddress']?>"/>
                        </td>
                    </tr>
                    <tr id="x" class="last">
                    	<td colspan="2">
                        	<input type="submit" value="清空购物车" name="button3" class="butt1" onClick="{if(confirm('您确定要清空购物车吗?')){this.document.selform.submit();return true;}return false;}"/>       	   
                        	<input type="submit" value="结算购物车" name="button" class="butt2"onClick="{if(confirm('您确定要结算购物车吗?')){this.document.selform.submit();return true;}return false;}"/>
                        </td>
                    </tr>
                </table>
              
              
              </div>
              <br/> <br/> <br/> <br/>
              
           
            
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
<script language="javascript">
function affirm(t)
{  
var ipt = document.getElementsByTagName("input");    
var i = 0;    
var allownum = 2;//定义最多能选择的个数   
for(var j = 0; j < ipt.length; j++)  
{       
if(ipt[j].type == "checkbox" && ipt[j].checked) 
i++;   
}    
//if(i > allownum)    
//{        
//alert("每次最多消费"+ allownum +"单！");        
//t.checked = false;    
//}
} 
</script>
    </div>
</body>
</html>