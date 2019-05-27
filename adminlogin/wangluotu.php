<?php
include("../member/check.php");
include("../member/check2.php");
include_once("../function.php");
include_once("../class/system_class.php");

if ($_GET['action']=="admin"){
    $ID=$_GET['ID'];
}else{
    $_system=new system_class();
    if ($_system->system_wlt()!=1){
        echo "<script language=javascript>alert('您没有查看网络结构的权限.');window.location.href='../member/member.php'</script>";
    }
    
    if ($_POST['submin']){
        if ($chaus=getMemberbyNickName($_POST['nickname'])){
            if(checkisppath($_SESSION['ID'],$chaus['id'])){
                $ID=$chaus['id'];
            }else{
                echo "<script language=javascript>alert('您的网络中不存在该成员.');window.location.href='?'</script>";
            }
        }else{
            echo "<script language=javascript>alert('您的网络中不存在该成员.');window.location.href='?'</script>";
        }
    }else{
        if ($_GET['ID'] == null){
            $ID=$_SESSION['ID'];
        }else if($_GET['ID'] == $_SESSION['ID']){
            $ID=$_SESSION['ID'];
        }else{
            if(checkisppath($_SESSION['ID'],$_GET['ID'])){
                $ID=$_GET['ID'];
            }else{
                echo "<script language=javascript>alert('您的网络中不存在该成员.');window.location.href='?'</script>";
            }
        }
    }
}


$nopay="#FFB6C1";
$nore="#A3CDF8";
$ispay1="#A9A9A9";
$ispay2="#98FB98";
$ispay3="#FFD700";
$ispay4="#8FBC8F";
$ispay5="#00CD00";
$ispay6="#B8860B";

$ispay="#A9A9A9";
$nopay="#FFFF00";
$nore="#A3CDF8";

$us=getMemberbyID($ID);
$UserID=$us['userid'];
$NickName=$us['nickname'];
//	$NickName="<a style='color:white;'>"$us['nickname']."</a>";
$UserName=$us['username'];
$uLevel=$us['ulevel'];
$area1=$us['area1'];

$area3=$us['area3'];
$yarea1=$us['yarea1'];

$yarea3=$us['yarea3'];
$rname=$us['rname'];
$pdt=$us['pdt'];
$ul=ulevel($uLevel);
$jibie=$ul['lvname'];

if ($us['ispay']==0){
    $usispaycolor=$nopay;
}else{
    $usispaycolor=$ispay;
}
//A区
if ($p1=getFatherManbyFidAndTreeplace($ID,1)){
    
}

//C区
if ($p3=getFatherManbyFidAndTreeplace($ID,3)){
    
}
function getwlttable($id,$fathername,$tp){
    $ispay="#1B6DA2";
    $nopay="#FFFF00";
    if ($p=getFatherManbyFidAndTreeplace($id,$tp)){
        $pNickName="<a href='?ID=".$p['id']."' style='color:black;'>".$p['nickname']."</a>";
        $ul=ulevel($p['ulevel']);
        if ($ul['lvname']){
            $pjibie=$ul['lvname'];
        }else{
            $pjibie="零级会员";
        }
        $prname=$p['rname'];
        $parea1=$p['area1'];

        $parea3=$p['area3'];
        $yparea1=$p['yarea1'];

        $yparea3=$p['yarea3'];
        $ppdt=$p['pdt'];
        if ($p['ispay']==0){
            $pispaycolor=$nopay;
        }else{
            $pispaycolor=$ispay;
        }
    }else{
        if ($fathername!=""){
            $rs=getMemberbyID($id);
            if ($rs['ispay']==1){
                //$pNickName="<a href='register.php?nickname=".$fathername."&tid=".$tp."'>注册</a>";
                $pNickName=注册;
            }else {
                $pNickName="<a >注册</a>";
            }
        }else{
            $pNickName="空位";
        }
        $pjibie="空位";
        $parea1=0;

        $parea3=0;
        $yparea1=0;
     
        $yparea3=0;
    }
    $tab="<table width='150' cellpadding='3' cellspacing='1' border='0' align='center' class='table1'>";
    $tab=$tab."<tr>";
    $tab=$tab."<td style='background:".$pispaycolor."' colspan='3' align='center'>".$pNickName."</td>";
    $tab=$tab."</tr>";
    $tab=$tab."<tr>";
    $tab=$tab."<td colspan='3' align='center'>".$pjibie."</td>";
    $tab=$tab."</tr>";
    $tab=$tab."<tr>";
    $tab=$tab."<td align='center'>A区</td>";

    $tab=$tab."<td align='center'>C区</td>";
    $tab=$tab."</tr>";
    $tab=$tab."<tr>";
    $tab=$tab."<td align='center'>".$parea1."</td>";
    
    $tab=$tab."<td align='center'>".$parea3."</td>";
    $tab=$tab."</tr>";
    $tab=$tab."<td align='center'>".$yparea1."</td>";

    $tab=$tab."<td align='center'>".$yparea3."</td>";
    $tab=$tab."</tr>";
    $tab=$tab."</table>";
    return $tab;
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>查看网络图</title>
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/chakan.css">
<script src="js/jquery.js"></script>
<script src="js/lanrenzhijia.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}                                         
</script>
<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}

</style>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" -->
<?php include 'header.php';?><!-- #EndLibraryItem -->
<section id="main" class="clearfix"><!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
<?php include 'left.php';?><!-- #EndLibraryItem -->
<div id="conts" cl ass="heightLine-1"><!-- #BeginLibraryItem "/Library/title.lbi" -->
<?php include 'title.php';?><!-- #EndLibraryItem -->
<div class="mainBox">
       <form name="form1" method="post" action="?" >
	<tr>
    <td height="22" colspan="3" class="ziti">查询会员：
      
        <input type="text" name="nickname" id="nickname">
      <input name="submin" type="submit" class="account_button_blue" id="submin" value="查  询"> 
      &nbsp;&nbsp;&nbsp;&nbsp;<a href="?ID=1">返回顶层</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.back(-1)">返回上一层</a>
    
     </td>
     <!-- 
    <td style="background:<?=$ispay?>" align="center" class="ziti" >已激活</td>
    <td style="background:<?=$nopay?>" align="center" class="ziti">未激活</td>
    </tr>
     -->
  </form>

<!-- START -->


<link href="../member/css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../member/css/style2.css">
  
  
    <!--[if lt IE 9]><script language="javascript" type="text/javascript" src="../member/Public/image/excanvas.js"></script><![endif]-->
    <!--<script class="include" type="text/javascript" src="../member/js/jquery-1.9.1.min.js"></script>-->
	
<!-- End example scripts -->

<!-- Don't touch this! -->


    
<!-- End Don't touch this! -->

<!-- Additional plugins go here -->
 
<!-- End additional plugins -->

<!-- ---------------------------------------中英文切换start------------------------------------------------------------ -->

    
<div id="right" style="position: absolute;left:220px;width:860px;" >
<table align="center" style="overflow:scroll;width:1024px;" >

	   <tr>
	  <td height="120" colspan="9" align="center"><br>
	    <br>
	    <br>
	    <br>
	    <br>
	    <table width="150" cellpadding="3" cellspacing="1" border="0" align="center" class="table1" >
	    <tr>
	      <td style="background:<?=$usispaycolor?>"   colspan="3" align="center"><?=$NickName?></td>
        </tr>
        <tr style="display:none">
	      <td  colspan="3" align="center"><?=$rname?></td>
        </tr>
	    <tr>
	    <?php if ($jibie){?>
	      <td  colspan="3" align="center"><?=$jibie?></td>
	      <?php }else {?>
	      <td  colspan="3" align="center">零级会员</td>
	      <?php }?>
        </tr>
	    <tr >
	      <td align="center" >A区</td>
	   
	      <td align="center" >C区</td>
        </tr>
	    <tr >
	      <td  align="center"><?=$area1?></td>
	      
	      <td  align="center"><?=$area3?></td>
        </tr>
	    <tr >
	      <td  align="center"><?=$yarea1?></td>
	
	      <td  align="center"><?=$yarea3?></td>
        </tr>
        <tr style="display:none">
	      <td colspan="3" align="center" ><?=$pdt?></td>
        </tr>
      </table></td>
    </tr>
	<tr>
    <td height="36" colspan="3" align="center"><img src="../member/image/t_tree_bottom_l.gif"  height="30"><img src="../member/image/t_tree_line.gif" alt=""  width="180" height="30"><img src="../member/image/t_tree_line.gif" alt=""  width="180" height="30"><img src="../member/image/t_tree_top.gif"  height="30"><img src="../member/image/t_tree_line.gif" alt=""  width="180" height="30"><img src="../member/image/t_tree_line.gif" alt=""  width="180" height="30"><img src="../member/image/t_tree_bottom_r.gif" height="30"></td>
  </tr>
  <tr>
    <td height="103" colspan="4" align="center"><table width="100%" border="6">
      <tr>
        <td colspan="2" align="center"><?=getwlttable($ID,$NickName,1)?></td> 
            
        <td colspan="5" align="center"><?=getwlttable($ID,$NickName,3)?></td>
      </tr>
      <tr>
   <td height="36" colspan="2" align="center"><img src="../member/image/t_tree_bottom_l.gif" alt=""  height="30" style="height:30px;"><img src="../member/image/t_tree_line.gif" alt=""  width="120" height="30" style="height:30px;"><img src="../member/image/t_tree_top.gif" alt=""  height="30" style="height:30px;"><img src="../member/image/t_tree_line.gif" alt=""  width="120" height="30" style="height:30px;"><img src="../member/image/t_tree_bottom_r.gif" alt="" height="30" style="height:30px;"></td>
    <td colspan="4" align="center"><img src="../member/image/t_tree_bottom_l.gif" alt=""  height="30" style="height:30px;"><img src="../member/image/t_tree_line.gif" alt=""  width="120" height="30" style="height:30px;"><img src="../member/image/t_tree_top.gif" alt=""  height="30" style="height:30px;"><img src="../member/image/t_tree_line.gif" alt=""  width="120" height="30" style="height:30px;"><img src="../member/image/t_tree_bottom_r.gif" alt="" height="30" style="height:30px;"></td>
         </tr>
      <tr>
    <td align="center"><?=getwlttable($p1['id'],$p1['nickname'],1)?></td>
   
    <td align="center"><?=getwlttable($p1['id'],$p1['nickname'],3)?></td>
    
    <td align="center"><?=getwlttable($p3['id'],$p3['nickname'],1)?></td>

    <td align="center"><?=getwlttable($p3['id'],$p3['nickname'],3)?></td>
      </tr>
    </table></td>
  </tr>
 
</table>
</div>



               


<!-- /START -->

                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>