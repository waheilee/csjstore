 <?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(4,12);
$id=$_GET['id'];
$goodsimg4 = $_POST['goodsimg4'];
$biaoti = $_POST['biaoti'];
if ($_POST['button']){
    if($biaoti==null){
        echo "<script language=javascript>alert('请输入视频标题,上传失败!.');window.location.href='shangchuanshipin.php?id=1'</script>";
        return;
    }
    if($goodsimg4!=null && $biaoti!=null){
        $shipin['name'] = $_POST['goodsimg4'];
        $shipin['date'] = now();
        $shipin['isfb'] = 0;
        $shipin['biao'] = $biaoti;
    }
    echo add_insert_cl('shipin', $shipin);
    echo "<script language=javascript>alert('上传成功.');window.location.href='shangchuanshipin.php?id=1'</script>";
}
?>
<!DOCTYPE HTML>
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
<title>上传视频</title>
<script language="javascript">
<!--
function CheckForm(){
//	erweima1=document.form1.erweima1.value;
	price=document.form1.price.value;
	goodscontent=document.form1.content1.value;
	if(erweima1.length == 0){
		alert("温馨提示:\n请输入视频名称.");
		document.form1.erweima1.focus();
		return false;
	}
//	if(price <= 0){
//		alert("温馨提示:\n商品价格必须大于0.");
//		document.form1.price.focus();
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
-->
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
               	<h2>上传视频</h2>
                <div class="table">
<form name="form1" enctype="multipart/form-data" method="POST" action="?" onSubmit="return CheckForm();" >
                    <table>
                    	<tr>
                        	<td >上传视频</td>
                        	<td>
                            	<iframe ID="UploadFiles4" src="UploadFiles4.php" frameborder=0 scrolling=no height="35"></iframe>
                            </td>
                        </tr>
                        <script language="javascript">
                                function GetImgName4(){
                                    //根据iframe的id获取对象
                                    //var i1 = window.frames['UploadFiles'];
                                    //获取iframe中的元素值
                                    var i2=document.getElementById("UploadFiles4").contentWindow;

                                    var imgname=i2.document.getElementById("imgname4").value;


                                    document.getElementById("goodsimg4").value = imgname;
                                }

                        </script>
                    	<tr>
                        	<td style="display:none">商品图片</td>
                        	<td>
                            	<input name="goodsimg4" type="text"style="display:none" id="goodsimg4" size="20"  maxlength="50">
                                <input name="button" type="button" style="display:none" onClick="GetImgName4()" value="获取图片">
                            </td>
                        </tr>
                      	<tr>
                        	<td >视频标题</td>
                        	<td>
                            	<input name="biaoti" type="text" id="biaoti" size="20"  maxlength="50">
                            </td>
                        </tr>
                
                    	<tr>
                        	<th colspan="2">
                        	      
                            		<input name="button" id="button" type="submit" onClick="GetImgName4();submit;" value="上传"/>
                                <input type="button" value="返回" onClick="javascript:history.back();"/>
                            </th>
                        </tr>
                    
                    </table>
                </form>
                
               <!--<form action="UploadFiles.php" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input type="submit" name="submit" value="Submit" />
</form> -->
                
                
                
                
                
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>