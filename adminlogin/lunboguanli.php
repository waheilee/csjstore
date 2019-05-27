<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(5,16);
#搜索新闻
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	$TimeStart=$_POST['TimeStart'];
	$TimeEnd=$_POST['TimeEnd'];
	if ($TimeStart!=NULL){
		if ($TimeEnd==NULL){
			$TimeEnd=now();	
		}
		$_SESSION['SearchTime']="and newstime>='".$TimeStart."' and newstime<='".$TimeEnd."'";	
	}else{
		$_SESSION['SearchTime']=NULL;		
	}
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索新闻标题
			$_SESSION['Search']="and newstitle like '%".$SearchContent."%'";
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

#发布新闻
if ($_POST['button']){
    $cheuid_arr = $_POST['UID'];
    if($cheuid_arr){
        $news['isfb']=1;
        foreach ((array)$cheuid_arr as $id)
        {
            edit_update_cl('lunbotu',$news,$id);
        }
        echo "<script language=javascript>alert('图片前台显示设置完成');window.location.href='?'</script>";
    }else{
        echo "<script language=javascript>alert('请选择要显示的图片');window.location.href='?'</script>";
    }
	
}

#停止发布
if ($_POST['button2']){
    $cheuid_arr = $_POST['UID'];
    if($cheuid_arr){
        $news['isfb']=0;
        foreach ((array)$cheuid_arr as $id)
        {
            edit_update_cl('lunbotu',$news,$id);
        }
        echo "<script language=javascript>alert('图片已停止显示');window.location.href='?'</script>";
    }else{
        echo "<script language=javascript>alert('请选择要停止显示的图片');window.location.href='?'</script>";
    }
}

#删除新闻
if ($_POST['button4']){
    $cheuid_arr = $_POST['UID'];
    if($cheuid_arr){
        foreach ((array)$cheuid_arr as $id)
        {

            $t=getOne("select d2 from lunbotu where id={$id}");
            $tu=$t['d2'];
            $path='../upload/'.$tu;
            delDirAndFile($path,$delDir = FALSE);
            edit_delete_cl('lunbotu',$id);
            echo "<script language=javascript>alert('清空图片完成');window.location.href='?'</script>";

        }

        echo "<script language=javascript>alert('删除图片完成');window.location.href='?'</script>";
    }else{
        echo "<script language=javascript>alert('请选择要删除的图片');window.location.href='?'</script>";
    }
}
//删除文件
function delDirAndFile($path,$delDir = FALSE) {
    $handle = opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}
//if($_POST['xg']){
//    $l= getOne("select id from lunbotu where id={$_POST['uid']}");
//    if($l){
//        $news['goodid']=$_POST['goodid'];
//        edit_update_cl('lunbotu',$news,$l['id']);  
//    }
//    echo "<script language=javascript>alert('绑定商品成功');window.location.href='?'</script>";
//}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>轮播管理</title>

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

function bd(id){
    gid=document.getElementById("goodid"+id).value;
    $.ajax({
      type: "POST",
      url : "ajax.php",
      datatype : 'json',
      data: {'gid':gid,'id':id},
      success :function (data) {
          if(data == 0){
              alert("绑定失败,请刷新后重试！");
          }else{
              alert("绑定成功！");
          }
            
//              document.getElementById("rusername").innerHTML=data;
//              document.getElementById("rusername").value=data;
      }
    });
}
    
</script>
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
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="container">
	<?php include 'header.php';?>
   
    
    
	<section id="main" class="clearfix">
		<!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
		<?php include 'left.php';?>
		<!-- #EndLibraryItem -->
<div id="conts" cl ass="heightLine-1">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	 <?php include 'title.php';?>
        	<!-- #EndLibraryItem --><form name="form1" method="post" action="?">
<div class="mainBox">
            
                
                <div class="table">
                	<h3>轮播管理</h3>
                    <div class="table1">
                	<table>
                    	<tr>
      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:SelectAll()"></td>
        <td align="center">序号</td>
        <td align="center">图片</td>
        <td align="center">商品ID</td>
        <td align="center">上传时间</td>
        <td align="center">是否显示</td>
       
        </tr>
		<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `lunbotu` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `lunbotu` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
<!--        <form name="form1" method="post" action="?">-->
                    	<tr>
      	<td height="21" align="center"><input type="checkbox" name="UID[]" id="UID" value="<?=$row['id']?>"></td>
        <td align="center"><?=$row['id']?></td>
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
    <td hidden>
      	
        </td>
		<td width="200">
      	<img height="70"  class="pimg" width="70" style="cursor:pointer;" src="../upload/<?=$row['d2']?>" />
        </td>
        <td align="center"><input type="text" placeholder="请输入商品编号" id="goodid<?=$row['id']?>" name="goodid<?=$row['id']?>" value="<?=$row['goodid']?>"><input type="button" value="修改" onclick="bd('<?=$row['id']?>')" /></td>
        <td align="center"><?=$row['date']?></td>
        <td align="center"><?php if ($row['isfb']==1){?>已显示<?php }else{?><font color="#FF0000">已隐藏</font><?php }?></td>
        
        </td>
      </tr>
<!--      </form>-->
      <?php
			}
		}
	  ?>
                        
                    	<tr>
                        	<th colspan="7">
                            <input type="submit" name="button" id="button" value="前台显示" onClick="{if(confirm('您确定要前台显示该图片吗?')){this.document.selform.submit();return true;}return false;}"/>
                            	<input type="submit" value="停止显示" name="button2" id="button2" onClick="{if(confirm('您确定要停止显示图片吗?')){this.document.selform.submit();return true;}return false;}"/>
                                <input type="submit" value="删除图片" name="button4" id="button4" onClick="{if(confirm('您确定要删除图片吗?')){this.document.selform.submit();return true;}return false;}"/>
                           <?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div>            
        </div></form>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>