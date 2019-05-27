<?php
include("admin_check.php");
include_once("../function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
#发布新闻
//
if ($_POST['Search']){
    $Searchlx=$_POST['Searchlx'];
    $SearchContent=$_POST['SearchContent'];
    $SearchType=$_POST['SearchType'];
    if($Searchlx<>-1){
        $_SESSION['Searchlx']=" and lx = $Searchlx "; 
    }else{
        $_SESSION['Searchlx']=NULL;
    }
    if($SearchType==1){
        if ($SearchContent!=NULL){
            #搜索
            $_SESSION['Search']="and goodsname like '%$SearchContent%' "; 
        }else{
            $_SESSION['Search']=NULL;
        }
    }else{
        $_SESSION['Search']=NULL;
    }
    
}else{
    $Searchlx=-1;
    $SearchContent=NULL;
    $SearchType=NULL;
    $_SESSION['Search']=NULL;
    $_SESSION['Searchlx']=NULL; 
}
    
    
if ($_POST['button']){
    //$cheuid_arr = $_POST['UID'];
    $zid = 0;
    $n=0;
    foreach($_POST['UID'] as $v0){
        $rs0=getOne("select * from goods where id={$v0}");
        if($_POST[$rs0['id']."num"]<>0){//是否输入商品数量
            $n=$n+1;
        }
    }
    if($n<>0){
        $FileID=null;
        $date=now();
        $FileID=date("ymdH").rand(100,999);//订单号
        $orders['ordersnumber']=$FileID;
        $orders['lx']=0;
        $orders['uid']=$zid;
        $orders['goods']=serialize($_SESSION['shoppingcart']);
        $orders['cdate']=$date;
        $orders['sdate']=$date;
        add_insert_cl('orders11',$orders);
        
        foreach($_POST['UID'] as $v){
            $n2=0;
            $rs=getOne("select * from goods where id={$v}");
            $arr[$rs['id']]=array("id"=>$rs['id'],"goodsname"=>$rs['goodsname'],"num"=>$_POST[$rs['id']."num"],"lx"=>5);
            $n2=$_POST[$rs['id']."num"];
            $shopingcart_arr[$rs['id']]=$arr;
            $_SESSION['shoppingcart']=$shopingcart_arr;
            if($n2<>0){//是否输入商品数量 
//                if($zid<>0){
//                    $num= getOne("select id from kucun where id={g{$v}}");
//                    if($num==null){
//                        mysql_query("alter table kucun add g{$row['id']} int(11) NOT NULL default '0'");
//                    }
//                    edit_sql("update `kucun` set g{$v}=g{$v}+{$n2} where uid={$zid}");
//                }else{
                    $goods['kucun'] = $rs['kucun']+$n2;
                    edit_update_cl('goods',$goods,$v);
                //}
                $goods_update=NULL;
                $or['lx']=$rs['lx'];
                $or['ordersnumber']=$FileID;
                $or['uid']=$zid;
                $or['goodid']=$v;
                $or['goodname']=$rs['goodsname'];
                $or['num']=$n2;
                $or['date']=$date;
                $or['sdate']=$date;
                add_insert_cl('orders22',$or);
            }
        } 
        $_SESSION['shoppingcart']=null;
        if($zid){
            echo "<script language=javascript>alert('库存修改成功！');window.location.href='?'</script>";
        }else{
            echo "<script language=javascript>alert('库存修改成功！');window.location.href='?'</script>";
        }
           
    }else{
        if($zid){
            echo "<script language=javascript>alert('请填写数量！');window.location.href='?'</script>";
        }else{
            echo "<script language=javascript>alert('请填写数量！');window.location.href='?'</script>";
        }
    } 
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>入库登记</title>
<SCRIPT LANGUAGE=javascript>
<!--
function SelectAll() {
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		e.checked=!e.checked;
	}
}
-->
</script>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/jihuohuiyuan.css">
<script src="js/jquery.js"></script>
<script src="js/lanrenzhijia.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}                                         
</script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="container">
	
   <!-- #BeginLibraryItem "/Library/header.lbi" -->
    <?php include 'header.php';?>
   <!-- #EndLibraryItem -->
<section id="main" class="clearfix">
		<!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
		<?php include 'left.php';?>
		<!-- #EndLibraryItem -->
<div id="conts" cl ass="heightLine-1">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	 <?php include 'title.php';?>
        	<!-- #EndLibraryItem -->
			<form name="form1" method="post" action="?">
<div class="mainBox">
            	<div class="title clearfix">
                	
                    	<div class="left1">
                            
                            <select name="Searchlx" id="Searchlx">
                                <option value="-1">全部</option>
                                <?php $lrr= getAll("select id,lx,name from leibie where lx order by lx");
                                    foreach ($lrr as $k=>$r){
                                    ?>
                                <option <?php if($r['lx']==$Searchlx){?>selected<?php }?> value="<?=$r['lx']?>"><?=$r['name']?></option>
                               <?php }?>
                            	
                                
                            </select>

                    		<select name="SearchType" id="SearchType">
                            	<option value="1">商品名称</option>
                                
                            </select>
                            <input type="text" value="<?=$SearchContent?>" name="SearchContent" id="SearchContent"/>
                            
                             <input type="submit" value="搜索" name="Search" id="Search"/>
                             <input type="submit" value="清空" />
                    	</div>
<!--                        <div class="right1">
                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                           
                		</div>-->
            		
             	</div>
                
                <div class="table">
                	<h3>入库登记</h3>
                    <div class="table1">
                        <table >
                                <tr>
                                    <td hidden>#</td>
                                    <td style="color: #000000">商品名称</td>
                                    <td style="color: #000000">商品类型</td>
                                    <td style="color: #000000">余存数量</td>
                                    <td style="color: #000000">本次入库数量</td>
                                </tr>
                                <?php
                                
                                $pagesize = 20; //设置每页记录数
                                $sql = "SELECT * FROM `goods` where 1=1 ".$_SESSION['Search']." ".$_SESSION['Searchlx']." ";

                                if($query = mysql_query($sql)){
                                    $sum = mysql_num_rows($query); //计算总记录数
                                }else{
                                    $sum=0;
                                }
                                if($sum % $pagesize == 0) //计算总页数
                                    $total = (int)($sum/$pagesize);
                                else
                                    $total = (int)($sum/$pagesize) + 1;
                                if (isset($_GET['page'])) //获得页码
                                {
                                    $p = (int)$_GET['page'];
                                }
                                else
                                {
                                    $p = 1;
                                }
                                if ($p>$total){
                                    $p=$total;
                                }
                                $start = $pagesize * ($p - 1); //计算起始记录
                                $sql = "SELECT * FROM `goods` where 1=1 ".$_SESSION['Search']." ".$_SESSION['Searchlx']." ";
                               
                                $arr=getAll($sql);
                                foreach ($arr as $key =>$row){
                                    $lb= getOne("select name from leibie where lx={$row['lx']}");
//                                    $kucun= getOne("select * from kucun where 1=1 ".$_SESSION['Search']."");
//                                    $kucun2= getOne("select * from kucun2 where 1=1 ".$_SESSION['Search']."");
                                    ?>
				<tr>
                                    <td hidden><input checked="checked" type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
                                        <td><span><?=$row['goodsname']?></span></td>
                                        <td><span><?=$lb['name']?></span></td>
                                        <td><?=$row['kucun']?></td>
                                        <td><input name="<?=$row['id']?>num" type="text" id="<?=$row['id']?>num" value=""/></td>
                                    </tr>
                                <?php }?>
                                
                                
                                <tr>
                                  
                                    <th class="last" colspan="8"><input  name="button" type="submit" id="button" value="确认" onClick=" if(confirm('您确认入库?')){this.document.selform.submit();return true;}return false;"/>  条数：<?=$sum?> </th>
                                
                                </tr>
                                <tr>
                                    <th colspan="8" class="last">
                                        <div class="pagination clearfix">
                                            <ul class="page clearfix">
                                                <?php
                                                $prev=$p-1;
                                                $next=$p+1;
                                                if($total>1){
                                                    if($p>1){
                                                        ?>
                                                        <li>
                                                            <a href="?page=1">第一页</a>
                                                        </li>
                                                        <li>
                                                            <a href="?page=<?=$prev?>">上一页</a>
                                                        </li>
                                                        <?php
                                                    }
                                                    if($p<$total){
                                                        ?>
                                                        <li>
                                                            <a href="?page=<?=$next?>">下一页</a>
                                                        </li>
                                                        <li>
                                                            <a href="?page=<?=$total?>">最后一页</a>
                                                        </li>
                                                        <?php
                                                   }
                                                }
                                                ?>



                                            </ul>
<!--                                            <div class="text1">
                                                条数<?=$sum?> 
                                                显示第<?=$p?>页，共<?=$total?>页
                                            </div>-->

                                        </div>
                                    </th>
                                </tr>
                            </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div>     
                        </form>       
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
<script type="text/javascript">

var mDD = document.getElementById("tablit").getElementsByTagName("dd");
var mDIV= document.getElementById("tablit").getElementsByTagName("div");


for (var i=0;i<mDD.length;i++){
 (function(index) {
  mDD[index].onmouseover = function() {
   if (mDD[index].className == 'out') {
    for (var j = 0; j < mDD.length; j++) {
     mDD[j].className = 'out';
     mDIV[j].style.display = 'none';
    }
    mDD[index].className = 'on';
    mDIV[index].style.display = 'block';
   }
  }

 })(i);
}

</script>
</html>