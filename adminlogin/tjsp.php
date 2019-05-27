<!DOCTYPE HTML>
<?php
include("admin_check.php");
include_once("../function.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(4,12);
 
      
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
               	<h2>选择类型商品</h2>
                 
 
                    <table>
        <tr>
          <td>  
          <?php $arr= getAll("select id,lx from leibie where lx>0 order by lx");
                foreach ($arr as $k=>$r){?>
              
              <input type="button" class="button" id="button" name="button"  
          value="<?=$name = leiname($r['lx']);?>"  
          onClick="window.location.href='tianjiashangpin.php?lx=<?=$r['lx']?>'" />  
                <?php } ?>
        	
 </td>
    </tr> 
<!--     <tr>
          <td>  
          <?php  for($i=4;$i<7;$i++){ ?>
           <input type="button" class="button" id="button" name="button"  
          value="<?=$name = leiname($i); ?>"  
          onClick="window.location.href='tianjiashangpin.php?lx=<?=$i?>'" />  
        	<?php }  ?>
        	
 </td>
    </tr> -->
    
    
     <!--  <tr>
          <td>  
            <input type="button" class="button" id="button" name="button" value="<?php   $name = leiname(1); echo $name; ?>" onClick="window.location.href='tianjiashangpin.php?lx=1'" />  
        	<input type="button" class="button" id="button2" name="button2" value="<?php   $name = leiname(2); echo $name; ?>" onClick="window.location.href='tianjiashangpin.php?lx=2'" />  
         	<input type="button" class="button" id="button3" name="button3" value="<?php   $name = leiname(3); echo $name; ?>" onClick="window.location.href='tianjiashangpin.php?lx=3'" />  
          </td>
    </tr> 
      
       <tr>
             <td>  
            <input type="button" class="button" id="button4" name="button4" value="<?php   $name = leiname(4); echo $name; ?>" onClick="window.location.href='tianjiashangpin.php?lx=4'" />  
        	<input type="button" class="button" id="button5" name="button5" value="<?php   $name = leiname(5); echo $name; ?>" onClick="window.location.href='tianjiashangpin.php?lx=5'" />  
         	<input type="button" class="button" id="button6" name="button6" value="<?php   $name = leiname(6); echo $name; ?>" onClick="window.location.href='tianjiashangpin.php?lx=6'" />  
            <input type="button" class="button" id="button7" name="button7" value="<?php   $name = leiname(7); echo $name; ?>" onClick="window.location.href='tianjiashangpin.php?lx=7'" />  
          
          
            </td>
      </tr>      
            
             -->
          
         
                    
                    </table>
                
               
            </div>
        </div>
    </section>
</div>
</body>
</html>