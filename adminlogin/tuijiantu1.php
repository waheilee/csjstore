<?php

include_once("../function.php");
include_once("../class/system_class.php");

if ($_SESSION['to_admin']){
    include("../member/check.php");
    include("../member/check2.php");
}

$_system=new system_class();
if ($_system->system_tjt()!=1){
    echo "<script language=javascript>alert('您没有查看推荐结构的权限.');window.location.href='member.php'</script>";
}
session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>查看推荐图</title>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/chakan.css">


<link rel="stylesheet" href="../web2/treeview/jquery.treeview.css" />
<link rel="stylesheet" href="../web2/treeview/red-treeview.css" />
<link rel="stylesheet" href="../web2/treeview/screen.css" />
<link rel="stylesheet" type="text/css" href="../web2/css/button.css" />


<script src="js/jquery.js"></script>
<script src="js/lanrenzhijia.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
<script src="../member/treeview/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
		$(function() {
			$("#tree").treeview({
				collapsed: true,
				animated: "medium",
				control:"#sidetreecontrol",
				persist: "location"
			});
		})
		
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
<?php

if($_POST['submit']){
	$_nickname=$_POST['nickname'];
	if ($_nickname==""){ $_nickname=$_SESSION['nickname']; }
	if(checkisrepath($_SESSION['ID'],$_nickname)){
		$us=getMemberbyNickName($_nickname);
	}else{
		echo "<script language=javascript>alert('您的团队中不存在该成员.');window.location.href='?'</script>";	
	}
}else{
	if ($_GET['ID'] != ""){
		$us=getMemberbyID($_GET['ID']);	
	}else{
		$us=getMemberbyID($_SESSION['ID']);		
	}
}
?>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><?php include 'header.php';?><!-- #EndLibraryItem --><section id="main" class="clearfix"><!-- #BeginLibraryItem "/Library/sideBar.lbi" --><?php include 'left.php';?><!-- #EndLibraryItem --><div id="conts" cl ass="heightLine-1"><!-- #BeginLibraryItem "/Library/title.lbi" --><?php include 'title.php';?><!-- #EndLibraryItem --><div class="mainBox">
           <form id="form1" method="post" action="?">
            	<div class="chaxun">
                	查询会员：<input type="text" value="" name="nickname" id="nickname"/>
                    <input type="submit" value="查询" name="submit" id="submit"/>
                </div>
		 </form> 
               <div id="sidetreecontrol"><a href="?#"><br />
  全部关闭</a> | <a href="?#">全部展开</a><br />
  <br />
</div>
<ul id="tree">
	<li><strong><?=$us['nickname']?></strong>
		
    	<?php
			echo tree($us['id']);
		?>
	</li>
</ul>
                
              
                
                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>