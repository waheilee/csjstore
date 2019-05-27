<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>服务补贴</title>
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
<div class="mainBox">
            	<div class="title clearfix">
                	<form action="" method="post">
                    	<div class="left">
                    		<select>
                            	<option>会员编号</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                            <input type="button" value="搜索" name="name"/>
                            <input type="button" value="导出表格" name="name"/>
                    	</div>
                        <div class="right">
                        	<span>搜索时间范围：</span><input type="text" name="date" class="tcal" value="" />至
                            <input type="text" name="date" class="tcal1 tcal" value="" />
                		</div>
            		</form>
             	</div>
                
                <div class="table">
                	<h3>服务补贴</h3>
                    <div class="table1">
                	<table>
                    	<tr>
                            	<td><input type="checkbox" value="" name="name"/>会员编号</td>
                            	<td>会员姓名</td>
                            	<td>提现金额</td>
                            	<td>手续费</td>
                            	<td>实发金额</td>
                            	<td>开户银行</td>
                            	<td>开户账号</td>
                            	<td>开户姓名</td>
                            	<td>开户地址</td>
                            	<td>提现时间</td>
                            	<td>服务中心</td>
                            	<td>审核状态</td>
                        </tr>
                    	<tr>
                            	<td>&nbsp;</td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                            	<td></td>
                        </tr>
                        
                    	<tr>
                        	<th colspan="12">
                            <input type="button" value="提现确认" name="name"/>
                            	<input type="button" value="删除记录" name="name"/>
                            <a href="#"><<</a>0<a href="#">>></a>每页20条，总共0条，当前显示第0页，总共0页</th>
                        </tr>
                        
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>