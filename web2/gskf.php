<!DOCTYPE html>
<?php 
include_once("../class/system_class.php");
$_system=new system_class();
$sys=$_system->system_information(1);
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>公司客服</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/show.css">
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
<?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
            
            <div class="table2">
                
            </div>
           
            
            <div class="table3">
            	<h2>公司客服</h2>
                <div class="box">
                	<table>
                    	<tr>
                        	<td>微信客服：</td>
                            <td><img src="../upload2/<?=$sys['erwei']?>" alt="" style="width:150px"/></td>
                        </tr>
                        
                        <tr>
                        	<td colspan='2'><a href='tel:<?=$sys['tel']?>' class='tel'>客服电话</a></td>
                        </tr>
                        <tr>
                        	<td colspan='2'>&nbsp;</td>
                        </tr>
                          <tr>
                        	<td colspan='2'><a href='tel:<?=$sys['tel2']?>' class='tel2'>退货客服电话</a></td>
                        </tr>
                    </table>
                </div>
            </div>
                
            
            
        </div>
    <br/><br/><br/><br/><br/>
    </section>
    <?php include 'footer.php';?>
</body>
</html>