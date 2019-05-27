<?php
include("admin_check.php");
include_once("action.php");
session_start();
header("Content-Type: text/html;charset=utf-8");


?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>数据导入</title>
    <link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
    <link rel="stylesheet" type="text/css" href="css/common/layout.css">
    <link rel="stylesheet" type="text/css" href="css/common/general.css">
    <link rel="stylesheet" type="text/css" href="css/content.css">
    <link rel="stylesheet" type="text/css" href="css/caiwuguanli.css">
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
        <div id="conts">
            <!-- #BeginLibraryItem "/Library/title.lbi" -->
            <?php include 'title.php';?>
            <!-- #EndLibraryItem -->
            <div class="mainBox">

               

                <h2>数据导入（请选择xlsx后缀表格上传）</h2>
                <div class="table">
             
                <form name="form2" method="post" enctype="multipart/form-data" action="PHPExcelImport/upload_excel.php">
                <input type="hidden" name="leadExcel" value="true">
                <table align="center" width="90%" border="0">
                <tr>
                   <td>
                    <input type="file"  name="file" >
                    <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;" type="submit" name="import" value="导入数据">
                    
                    &nbsp;&nbsp;&nbsp;<a href="chakanshuju.php?">查看数据</a>  
<!--                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="PHPExcelImport/导入.xlsx">模板下载</a>-->
                   </td>
                </tr>
                
                </table>
                </form>
               
                </div>
               

            </div>
        </div>
    </section>
    <footer id="gFooter">

    </footer>
</div>
</body>
</html>