<!DOCTYPE HTML>
<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(4,12);
 
$zhanghu=getOne("select * from zhanghu where id=1");
if ($_POST['button']){
    
      $zhanghu['weixin']=$_POST['goodsimg'];
      $zhanghu['zhifubao']=$_POST['goodsimg2'];
      $zhanghu['khyinhang']=$_POST['khyinhang'];
      $zhanghu['khdizhi']=$_POST['khdizhi'];
      $zhanghu['khxingming']=$_POST['khxingming'];
      $zhanghu['khkahao']=$_POST['khkahao'];
		
      echo edit_update_cl('zhanghu', $zhanghu,1);
		echo "<script language=javascript>alert('修改成功.');window.location.href='zhanghu.php'</script>";	

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
 
function GetImgName(){
	//根据iframe的id获取对象  
	//var i1 = window.frames['UploadFiles'];   
	//获取iframe中的元素值  
	var i2=document.getElementById("UploadFiles").contentWindow;
	
	var imgname=i2.document.getElementById("imgname").value;
	
	//var imgname=i1.document.getElementById("imgname").value;
	
	document.getElementById("goodsimg").value = imgname;
}
function GetImgName2(){
	//根据iframe的id获取对象  
	//var i1 = window.frames['UploadFiles2'];   
	//获取iframe中的元素值  
	var i2=document.getElementById("UploadFiles2").contentWindow;
	
	var imgname=i2.document.getElementById("imgname2").value;
	
	//var imgname=i1.document.getElementById("imgname2").value;
	
	document.getElementById("goodsimg2").value = imgname;
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
                        	<td>上传微信图片</td>
                        	<td>
                            	<iframe ID="UploadFiles" src="UploadFiles5.php" frameborder=0 scrolling=no height="35"></iframe>
                              
                            </td>
                        </tr>
                    	<tr>
                        	<td>微信图片</td>
                        	<td>
                            	<input type="text"  value="<?=$zhanghu['weixin']?>" name="goodsimg" id="goodsimg"/>
                                <input type="button" value="保存" name="button" id="button" onClick="GetImgName()"	/>
                            </td>
                        </tr>
                        
                       <tr>
                        	<td>上传支付宝图片</td>
                        	<td>
                            	<iframe ID="UploadFiles2" src="UploadFiles6.php" frameborder=0 scrolling=no height="35"></iframe>
                              
                            </td>
                        </tr>
                        
                    	<tr>
                        	<td>支付宝图片</td>
                        	<td>
                            	<input type="text"  value="<?=$zhanghu['zhifubao']?>" name="goodsimg2" id="goodsimg2"/>
                                <input type="button" value="保存" name="button" id="button" onClick="GetImgName2()"	/>
                            </td>
                        </tr>
                    	
                    	
                    	
                    	
                    	
                    	
                    	
                    	
                    	
                    	<tr>
                        	<td>开户银行</td>
                        	<td>
                            	<input type="text" value="<?=$zhanghu['khyinhang']?>" name="khyinhang" id="khyinhang"/>
                            </td>
                        </tr>
						<tr>
                        	<td>开户地址</td>
                        	<td>
                            	<input type="text" value="<?=$zhanghu['khdizhi']?>" name="khdizhi" id="khdizhi"/>
                            </td>
                        </tr>
                       
                   
                      <tr>
                        	<td>开户姓名</td> 
                        	<td>
                            	<input type="text" value="<?=$zhanghu['khxingming']?>" name="khxingming" id="khxingming"/>
                            </td>
                        </tr>
                    	 
                    	<tr>
                        	<td>开户账号</td>
                        	<td>
                            	<input type="text" value="<?=$zhanghu['khkahao']?>" name="khkahao" id="khkahao"/>
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