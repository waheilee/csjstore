<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(4,12);
$id=$_GET['id'];
$good=getOne("select * from leibie where id=$id ");
if ($_POST['button']){
    $id=$_POST['gid'];
    $goods['name'] = $_POST['goodsname'];
    if($_POST['goodsimg2']!=null){
        $goods['img'] = $_POST['goodsimg2'];
    }
    $goods['lx'] = $_POST['lx'];
    $goods['shun'] = $_POST['shunxu'];
    // var_dump($id);
    echo edit_update_cl('leibie', $goods,$_POST['gid']);
    echo "<script language=javascript>alert('修改类别成功.');window.location.href='leibiexiugai.php?id=$id'</script>";
    
}else{
    if (!$goods=que_select_cl('leibie',$_GET['id'])){
        echo "<script language=javascript>alert('类别不存在.');window.location.href='admin_goodsList.php'</script>";
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
<title>类别管理——修改</title>

<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/shangpinguanli.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
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
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}                                         
</script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><?php include 'header.php';?><!-- #EndLibraryItem --><section id="main" class="clearfix"><!-- #BeginLibraryItem "/Library/sideBar.lbi" --><?php include 'left.php';?><!-- #EndLibraryItem --><div id="conts" cl ass="heightLine-1"><!-- #BeginLibraryItem "/Library/title.lbi" --><?php include 'title.php';?><!-- #EndLibraryItem --><div class="mainBox">
<form name="form1" method="post" action="?" onSubmit="return CheckForm();" > 
               	<h2>修改类别<input name="gid" type="hidden" value="<?=$_GET['id']?>"></h2>
                <div class="table">
                    <table>
                    	<tr>
                        	<td>上传图片</td>
                        	<td>
                            	<iframe ID="UploadFiles2" src="UploadFiles2.php" frameborder=0 scrolling=no height="35"></iframe>
                            </td>
                        </tr>
                    	<tr>
                        	<td>类别图片</td>
                        	<td>
                            	<input name="goodsimg2" type="text" id="goodsimg2" size="20" value="<?=$good['goodsimg']?>" maxlength="50">
                                <input name="button" type="button" class="btn1" id="button" onClick="GetImgName2()" value="获取图片">
                            </td>
                        </tr>
                          <script language="javascript">
                                function GetImgName2(){
                                    //根据iframe的id获取对象
                                    //var i1 = window.frames['UploadFiles'];
                                    //获取iframe中的元素值
                                    var i2=document.getElementById("UploadFiles2").contentWindow;

                                    var imgname=i2.document.getElementById("imgname2").value;


                                    document.getElementById("goodsimg2").value = imgname;
                                }

                        </script>
                    	<tr>
                        	<td>类型序列</td>
                        	<td>
                            	<input type="text"  value="<?=$good['lx']?>" name="lx" id="lx"
                            	onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"
                            	/>
                            </td>
                        </tr>
<!--                        	<tr>
                        	<td>显示顺序</td>
                        	<td>
                            	<input type="number" min="1" max="8" name="shunxu" id="shunxu"/>
                            </td>
                        </tr>-->
                    	<tr>
                        	<td>类别名称</td>
                        	<td>
                     <input name="goodsname" type="text" id="goodsname" size="20" maxlength="50" value="<?=$good['name']?>">
                            </td>
                        </tr>
                    	
                    	<tr>
                        	<th colspan="2">
                            	<input name="button" id="button" type="submit" value="修改"/>
                                <input type="button" value="返回" onClick="javascript:history.back();"/>
                            </th>
                        </tr>
                    
                    
                    </table>
                
                </div></form>
            </div>
        </div>
    </section>
</div>
</body>
</html>