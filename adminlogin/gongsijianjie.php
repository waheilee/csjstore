
<?php
include_once("action.php");
include("admin_check.php");
include_once("../function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
//checkqx(5,18);
$information=que_select_cl('information',1);
if ($_POST['save']){
		
		if($information['introduced']!=$_POST['content1']){
			action::record("修改公司简介", 1, $_SESSION['adminid'], "修改公司简介");
		}
		$information['introduced']=$_POST['content1'];
		
		edit_update_cl("information",$information,1);
		alert('公司简介修改成功','?');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>公司简介</title>
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
               	<h2>公司简介</h2>
                <div class="table">
                    <table><form name="form1" method="post" action="?" >
                    	<tr>
                        	<td>内容</td>
                            <td><textarea  id="introduced" name="content1"> <?=$information['introduced']?></textarea></td>
                        </tr>
                        <tr>
                        	<th colspan="2">
                            	<input type="submit" value="修改" name="save"/>
                                <input type="reset" value="重置" name="reset"/>
                            </th>
                        </tr></form>
                    </table>
                
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>