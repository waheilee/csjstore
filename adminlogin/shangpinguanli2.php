<?php
include("admin_check.php");
include_once("../function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
$n= getOne("select id,lx,name from leibie where lx=1");
//checkqx(4,13);
#搜索商品
if ($_POST['Search']){
    
    $lxType=$_POST['lxType'];
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and gdate>='".$TimeStart."' and gdate<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
    	
	
    if ($lxType!=-1){
			$_SESSION['Search2']="and lx=$lxType ";
    }else{
        $_SESSION['Search2']=NULL;
    }
    if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索商品名称
			$_SESSION['Search'].="and goodsname like '%".$SearchContent."%'";
		}
	}else{
        $_SESSION['Search']=NULL;
    }
}else{
	if ($_GET['page']==NULL){
		$_SESSION['Search']=NULL;	
        $_SESSION['Search2']=NULL;	
		$_SESSION['SearchTime']=NULL;
	}
}

#发布新闻
if ($_POST['button']){
$cheuid_arr = $_POST['UID'];
	$goods['isdisplay']=1;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('goods',$goods,$id);
	}
	echo "<script language=javascript>alert('商品发布完成.');window.location.href='?'</script>";
}

#停止发布
if ($_POST['button2']){
$cheuid_arr = $_POST['UID'];
	$goods['isdisplay']=0;
	foreach ((array)$cheuid_arr as $id)
	{
    	edit_update_cl('goods',$goods,$id);
	}
	echo "<script language=javascript>alert('商品已停止发布.');window.location.href='?'</script>";
}

#删除新闻
if ($_POST['button4']){
	
$cheuid_arr = $_POST['UID'];
	foreach ((array)$cheuid_arr as $id)
	{
	
    	edit_delete_cl('goods',$id);
		
		
	}
	echo "<script language=javascript>alert('删除商品完成.');window.location.href='?'</script>";
}


?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title><?=$n['name']?>管理</title>
<SCRIPT LANGUAGE=javascript>

function SelectAll() {
	for (var i=0;i<document.form1.UID.length;i++) {
		var e=document.form1.UID[i];
		e.checked=!e.checked;
	}
}

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
                           
                    		<select name="SearchType" id="SearchType">
                            	<option value="1">商品名称</option>
                                
                            </select>
                            <input type="text" value="" name="SearchContent" id="SearchContent"/>
                            
                            
                    	</div>
                        <div class="right1">
                        	<span>搜索时间范围：</span><input type="text" name="TimeStart" id="TimeStart" class="tcal" value="" onFocus="HS_setDate(this)"/>至
                            <input type="text" name="TimeEnd" id="TimeEnd" class="tcal1 tcal" value="" onFocus="HS_setDate(this)"/>
                            <input type="submit" value="搜索" name="Search" id="Search"/>
                		</div>
            		
             	</div>
                
                <div class="table">
                	<h3><?=$n['name']?>管理</h3>
                    <ul class="clearfix">
                    </ul>
                    <div class="table1">
                	<table>
                    	<tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        
        <td align="center">商品编号</td>
		<td align="center">商品名称</td>
        <td align="center">商品图片</td>
        <td align="center">商品类型</td>
        
        
		<td align="center">A积分价格</td>
                <td align="center">C积分价格</td>
       <!-- <td align="center">配货数量</td>
-->        <td align="center">最低订货</td>
        <td align="center">库存</td>
        <td align="center">销量</td>
        <td align="center">发布时间</td>
        <td align="center">是否发布</td>
        <td align="center">操作</td>
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT id FROM `goods` WHERE lx>1 ".$_SESSION['Search2']." ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `goods` WHERE lx>1 ".$_SESSION['Search2']." ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by gdate desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
            $lb= getOne("select name from leibie where lx={$row['lx']}");
	  ?>
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['id']?></td>
        <td align="center"><?=$row['goodsname']?></td>
        
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
        <td hidden align="center"></td>
		<td width="200">
            <?php if($row['goodsimg']){?><img height="70"  class="pimg" width="70" style="cursor:pointer;" src="../upload/<?=$row['goodsimg']?>" /><?php }else{?>暂无<?php }?>
      	
        </td>
        <td align="center"><?=$lb['name']?></td>
        <td align="center"><?=$row['shichangjia']?></td>
        <td align="center"><?=$row['price']?></td>
      <!--  <td align="center"><?=$row['shumu']?></td>
-->        <td align="center"><?=$row['shumu2']?></td>
        <td align="center"><?=$row['kucun']?></td>
        <td align="center"><?=$row['sales']?></td>
        <td align="center"><?=$row['gdate']?></td>
        <td align="center"><?php if ($row['isdisplay']==1){?>已发布<?php }else{?><font color="#FF0000">未发布</font><?php }?></td>
        <td align="center"><input hidden type="button" class="button" id="button3" name="button3" value="查看" onClick="window.location.href='../member/goodscontent.php?id=<?=$row['id']?>'" />&nbsp;
          <input type="button" class="button" id="button5" name="button5" value="查看修改" onClick="window.location.href='shangpinxiugai.php?id=<?=$row['id']?>'" /></td>
      </tr>
      <?php
            }
		}else{
         ?> 
         <tr>
             <td colspan="22" align="center">该类型暂无商品</td>
         </tr>
        <?php      
        }
	  ?>
                        
                    	<tr>
                        	<th colspan="22">
                            <input type="submit" id="button" value="发布商品" name="button" onClick="{if(confirm('您确定要发布商品吗?')){this.document.selform.submit();return true;}return false;}"/>
                            
                            <input type="submit" id="button2" value="停止发布" name="button2" onClick="{if(confirm('您确定要停止发布商品吗?')){this.document.selform.submit();return true;}return false;}"/>
                            	<input type="submit" id="button4" value="删除商品" name="button4" onClick="{if(confirm('您确定要删除商品吗?')){this.document.selform.submit();return true;}return false;}"/>
                            <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div></form>
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