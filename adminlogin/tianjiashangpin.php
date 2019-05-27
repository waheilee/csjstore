<!DOCTYPE HTML>
<?php
include("admin_check.php");
include_once("../class/ulevel_class.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
$lx=$_GET['lx'];
if ($_POST['button']){
        for($i=1;$i;$i++){
            $n="g".rand(1000,9999);
            $xg= getOne("select id from goods where nickname='$n'");
            if($xg==null){
                break;
            }
        }
   		$goods['goodsname']=$_POST['goodsname'];
        $goods['nickname']=$n;
		$goods['lx']=$_POST['lx'];
        $goods['price']=$_POST['price'];
        $goods['shumu']=1;
        $goods['shumu2']=$_POST['shumu2'];
//        if($_POST['lx']==1){
//            $goods['shumu2']=1;
//            $goods['price1']=$_POST['price'];
//            $goods['price2']=$_POST['price'];
//            $goods['price3']=$_POST['price'];
//            $goods['price4']=$_POST['price'];
//            $goods['price5']=$_POST['price'];
//            $goods['price6']=$_POST['price'];
//            $goods['price7']=$_POST['price'];
//        }else{
            $goods['price1']=$_POST['price1'];
            $goods['price2']=$_POST['price2'];
            $goods['price3']=$_POST['price3'];
            $goods['price4']=$_POST['price4'];
            $goods['price5']=$_POST['price5'];
            $goods['price6']=$_POST['price6'];
            $goods['price7']=$_POST['price7'];
//        }
   		
//		$yanse= serialize($_POST['yanse']);
//		
//		//	unserialize 反
		
		//$goods['yanse']=$yanse;
	 
	 
		$goods['goodsimg']=$_POST['goodsimg'];
		
		$goods['gdate']=now();
		$goods['goodscontent']=$_POST['content1'];
		$goods['kucun']=$_POST['kucun'];
		$goods['shunxu']=$_POST['shunxu'];
		
		$goods['shichangjia']=$_POST['shichangjia'];
	 
	 
		
		echo add_insert_cl('goods',$goods);
//        $o= getOne("select id from goods where nickname='$n'");
//        mysql_query("alter table kucun add g{$o['id']} int(11) NOT NULL default '0'");
//        mysql_query("alter table kucun2 add g{$o['id']} int(11) NOT NULL default '0'");
		echo "<script language=javascript>alert('添加商品成功.');window.location.href='tianjiashangpin.php?lx=$lx'</script>";	

}
?>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="../kindeditor-4.1.9/themes/default/default.css" />
<link rel="stylesheet" href="../kindeditor-4.1.9/plugins/code/prettify.css" />
<script charset="utf-8" src="../kindeditor-4.1.9/kindeditor.js"></script>
<script charset="utf-8" src="../kindeditor-4.1.9/lang/zh_CN.js"></script>
<script charset="utf-8" src="../kindeditor-4.1.9/plugins/code/prettify.js"></script>
<script>
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="content1"]', {
			cssPath : '../kindeditor-4.1.9/plugins/code/prettify.css',
			uploadJson : '../kindeditor-4.1.9/php/upload_json.php',
			fileManagerJson : '../kindeditor-4.1.9/php/file_manager_json.php',
			allowFileManager : true,
			afterCreate : function() {
				var self = this;
				K.ctrl(document, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
				K.ctrl(self.edit.doc, 13, function() {
					self.sync();
					K('form[name=example]')[0].submit();
				});
			}
		});
		prettyPrint();
	});
</script>
<title>添加商品</title>

<script language="javascript">

function CheckForm(){
	goodsname=document.form1.goodsname.value;
    lx=document.form1.lx.value;
	//price=document.form1.price.value;
    //shumu=document.form1.shumu.value;
	//goodscontent=document.form1.content1.value;
	if(goodsname.length == 0){
		alert("温馨提示:\n请输入商品名称");
		document.form1.goodsname.focus();
		return false;
	}
    if(lx == -1){
		alert("温馨提示:\n请选择商品类型");
		document.form1.lx.focus();
		return false;
	}
//	if(price <= 0){
//		alert("温馨提示:\n商品价格必须大于0");
//		document.form1.price.focus();
//		return false;
//	}
//    if(shumu <= 0){
//		alert("温馨提示:\n商品数量必须大于0");
//		document.form1.shumu.focus();
//		return false;
//	}
	//if(goodscontent == ''){
	//	alert("温馨提示:\n请输入商品信息.");
	//	return false;
	//}
	return true;
}
function GetImgName(){
	//根据iframe的id获取对象  
	//var i1 = window.frames['UploadFiles'];   
	//获取iframe中的元素值  
	var i2=document.getElementById("UploadFiles").contentWindow;
	
	var imgname=i2.document.getElementById("imgname").value;
	
	//var imgname=i1.document.getElementById("imgname").value;
	
	document.getElementById("goodsimg").value = imgname;
}
</script>
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/shangpinguanli.css">
<script src="js/jquery.js"></script>
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
<div class="mainBox">
               	<h2>添加商品</h2>
                <div class="table">
<form name="form1" method="post" action="?" onSubmit="return CheckForm();" >
                    <table>
                    	<tr>
                        	<td>上传图片</td>
                        	<td>
                            	<iframe ID="UploadFiles" src="UploadFiles.php" frameborder=0 scrolling=no height="35"></iframe>
                              
                            </td>
                        </tr>
                    	<tr>
                        	<td>商品图片</td>
                        	<td>
                            	<input type="text"  value="" name="goodsimg" id="goodsimg"/>
                                <input type="button" value="保存" name="button" id="button" onClick="GetImgName()"	/>
                            </td>
                        </tr>

                       <tr>
                        	<td>商品类型</td>
                        	<td>
                            	<select name="lx" id="lx">
                                <?php $l= getOne("select * from leibie where lx=$lx");
                                    ?>
                                    <option value="<?=$l['lx']?>"><?=$l['name']?></option> 
                                </select>
      						
                            </td>
                        </tr>
                
				
                        
                        
                    	<tr>
                        	<td>商品名称</td>
                        	<td>
                            	<input type="text" value="" name="goodsname" id="goodsname"/>
                            </td>
                        </tr>
                        <tr>
                                <td>A积分价格</td>
                                <td> <input type="text" value="" name="shichangjia" id="shichangjia"/> </td>
                        </tr>
                    	<tr>
                                <td>C积分价格</td>
                                <td> <input type="text" value="" name="price" id="price"/> </td>
                        </tr>
                        <?php 
                        if($lx>10){ 
                            for($i=1;$i<=1;$i++){
                                $ul=ulevel($i+1);
                        ?>
                            <tr>
                                <td><?=$ul['lvname']?>价格</td>
                                <td> <input type="text" value="" name="price<?=$i?>" id="price<?=$i?>"/> </td>
                            </tr>
                        <?php 
                            }
                            ?>
                        <tr>
                        	<td>最低订货</td>
                        	<td> <input type="text" value="" name="shumu2" id="shumu2"/> </td>
                        </tr>
                       
                        <tr>
                        	<td>配货数量</td>
                        	<td> <input type="text" value="" name="shumu" id="shumu"/> </td>
                        </tr>
                        <?php }?>
                        
                        <tr>
                        	<td>最低订货</td>
                        	<td> <input type="text" value="" name="shumu2" id="shumu2"/> </td>
                        </tr>
                      <tr hidden>
                          <td >商品库存</td> 
                        	<td>
                            	<input type="text" value="0" name="kucun" id="kucun"/>
                            </td>
                        </tr>
                    	 
                    	<tr>
                        	<td>显示顺序</td>
                        	<td>
                            	<input type="text" value="0" name="shunxu" id="shunxu"/>
                            </td>
                        </tr>
                    	<tr>
                        	<td>商品信息</td>
                        	<td>
                           <textarea name="content1" style="width:80%;height:400px;visibility:hidden;"></textarea>
                           </td>
                        </tr>
                        
                    	<tr>
                        	<th colspan="2">
                            	<input type="submit" value="添加" name="button" id="button"/>
                                <input type="button" value="返回" onClick="javascript:history.back();"/>
                            </th>
                        </tr>
                    
                    
                    </table>
                </form>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>