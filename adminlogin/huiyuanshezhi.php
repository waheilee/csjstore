<?php
include("admin_check.php");
include_once("../class/ulevel_class.php");
include_once("../class/system_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(6,21);
$_system=new system_class();
$sys=$_system->system_information(1);
$sql="select id from ulevel where ulevel>0";
$rs=getAll($sql);
if($_POST['button']){
	$ulevel=new ulevel_class();
	$lvid="lvid";
        $isbd="isbd";
	$lvname="lvname";
	$dan="dan";
	$lsk="lsk";
	$yl1="yl1";
	$yl2="yl2";
	$yl3="yl3";
	$yl4="yl4";
	$yl5="yl5";
	$yl6="yl6";
	$yl7="yl7";
	$yl8="yl8";
	$yl9="yl9";
	$yl10="yl10";
	$yl11="yl11";
	$yl12="yl12";
	$yl13="yl13";
	$yl14="yl14";
	$yl15="yl15";
	$yl16="yl16";
	$yl17="yl17";
	$yl18="yl18";
	$yl19="yl19";
	$yl20="yl20";
	for($i=1;$i<=$ulevel->Getulevelcount();$i++){
		$up_ulevel=NULL;
		$up_ulevel['id']=$_POST[$lvid.$i];
		$up_ulevel['lvname']=$_POST[$lvname.$i];
		//$up_ulevel['dan']=$_POST[$dan.$i];
        $up_ulevel['dan']=$_POST[$yl2.$i]+$_POST[$yl3.$i];
		$up_ulevel['lsk']=$_POST[$lsk.$i];
		$up_ulevel['isbd']=$_POST[$isbd.$i];
		$up_ulevel['yl1']=$_POST[$yl1.$i];
		$up_ulevel['yl2']=$_POST[$yl2.$i];
		$up_ulevel['yl3']=$_POST[$yl3.$i];
		$up_ulevel['yl4']=$_POST[$yl4.$i];
		$up_ulevel['yl5']=$_POST[$yl5.$i];
		$up_ulevel['yl6']=$_POST[$yl6.$i];
		$up_ulevel['yl7']=$_POST[$yl7.$i];
		$up_ulevel['yl8']=$_POST[$yl8.$i];
		$up_ulevel['yl9']=$_POST[$yl9.$i];
		$up_ulevel['yl10']=$_POST[$yl10.$i];
		$up_ulevel['yl11']=$_POST[$yl11.$i];
		$up_ulevel['yl12']=$_POST[$yl12.$i];
		$up_ulevel['yl13']=$_POST[$yl13.$i];
		$up_ulevel['yl14']=$_POST[$yl14.$i];
		$up_ulevel['yl15']=$_POST[$yl15.$i];
		$up_ulevel['yl16']=$_POST[$yl16.$i];
		$up_ulevel['yl17']=$_POST[$yl17.$i];
        $up_ulevel['yl18']=$_POST[$yl18.$i];
        $up_ulevel['yl19']=$_POST[$yl19.$i];
        $up_ulevel['yl20']=$_POST[$yl20.$i];
		$ulevel->ulevel_update($up_ulevel);	
	}
        
	// for($i=1;$i<=count($rs);$i++){
	// 	$sql="update zjulevel set zjarea={$_POST['zjarea'.$i]} where id={$i}";
	// 	mysql_query($sql);
	// }
	
	/* $sys_update['d1']=$_POST['d1'];
	$sys_update['d2']=$_POST['d2'];
	$sys_update['d3']=$_POST['d3'];
	$sys_update['d4']=$_POST['d4'];
	$sys_update['d5']=$_POST['d5'];
	$sys_update['d6']=$_POST['d6'];
	$sys_update['d7']=$_POST['d7'];
	$sys_update['d8']=$_POST['d8'];
	$sys_update['d9']=$_POST['d9'];
	$sys_update['d10']=$_POST['d10'];
	
	$sys_update['ds1']=$_POST['ds1'];
	$sys_update['ds2']=$_POST['ds2'];
	$sys_update['ds3']=$_POST['ds3'];
	$sys_update['ds4']=$_POST['ds4'];
	$sys_update['ds5']=$_POST['ds5'];
	$sys_update['ds6']=$_POST['ds6'];
	$sys_update['ds7']=$_POST['ds7'];
	$sys_update['ds8']=$_POST['ds8'];
	$sys_update['ds9']=$_POST['ds9'];
	$sys_update['ds10']=$_POST['ds10'];
	
	$sys_update['dbl1']=$_POST['dbl1'];
	$sys_update['dbl2']=$_POST['dbl2'];
	$sys_update['dbl3']=$_POST['dbl3'];
	$sys_update['dbl4']=$_POST['dbl4'];
	$sys_update['dbl5']=$_POST['dbl5'];
	$sys_update['dbl6']=$_POST['dbl6'];
	$sys_update['dbl7']=$_POST['dbl7'];
	$sys_update['dbl8']=$_POST['dbl8'];
	$sys_update['dbl9']=$_POST['dbl9'];
	$sys_update['dbl10']=$_POST['dbl10'];
	
	$sys_update['lsbl']=$_POST['lsbl'];
	$sys_update['fxkc']=$_POST['fxkc'];
	$sys_update['fxlj']=$_POST['fxlj'];
	$sys_update['fxtzbl']=$_POST['fxtzbl'];
	$sys_update['jybl']=$_POST['jybl'];
	
	
	$sys_update['id']=1;
	$_system->system_update($sys_update);
	 */
        for($i=1;$i<=count($rs);$i++){
	    $sql2="update jiangjin set a1='".$_POST['a1'.$i]."',a2={$_POST['a2'.$i]},a3={$_POST['a3'.$i]},a4={$_POST['a4'.$i]},a5={$_POST['a5'.$i]},a6={$_POST['a6'.$i]} where id={$i}";

	    mysql_query($sql2);
	}
	for($j=1;$j<=3;$j++){
	    $sql="update zjulevel set zjname='".$_POST['zjname'.$j]."',z1='".$_POST['z1'.$j]."',z2='".$_POST['z2'.$j]."',z3='".$_POST['z3'.$j]."',z4='".$_POST['z4'.$j]."',z5='".$_POST['z5'.$j]."' where id={$j}";
	    mysql_query($sql);
	}
	alert('保存成功','?');
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>会员设置</title>
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/xitongshezhi.css">
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
<form name="form1" method="post" action="?" >
            	<!-- <h3> <a href="huiyuanshezhi.php?k=111">级别参数</a></h3> -->
               	<h3>级别参数</h3>
               
                <div class="table">
                    <table>
                    	<tr>
        <td  align="center">等级</td>
        <td  align="center">开关</td>
        <td  align="center">名称</td>
        <td  align="center">注册金额</td>
        <td  colspan="2" align="center">升级条件</td>
        <td  align="center">经销奖(%)</td>

    </tr>
	<?php
      	$sql = "SELECT * FROM `ulevel` where ulevel>0 order by ulevel ";
		if($query = mysql_query($sql)){
			$i=1;
			while ($row=mysql_fetch_array($query)){
	  ?>
                       <tr>
        <td  align="center"><input name="lvid<?=$i?>" type="hidden" value="<?=$row['id']?>"><?=$row['ulevel']?></td>
        <td  align="center">
        <input type="radio" name="isbd<?=$i?>" id="isbd" value="1" <?php if($row['isbd']==1){ ?> checked <?php }?>>开
        <input type="radio" name="isbd<?=$i?>" id="isbd" value="0" <?php if($row['isbd']==0){ ?> checked <?php }?>>关
        </td>
        <td  align="center"><input name="lvname<?=$i?>" type="text" value="<?=$row['lvname']?>" size="8" maxlength="20"></td>
        <td  align="center"><input name="lsk<?=$i?>" type="text" value="<?=$row['lsk']?>" size="5" maxlength="10"></td>
        <td  align="center"><input name="yl1<?=$i?>" type="hidden" value="<?=$row['yl1']?>" size="5" maxlength="20"><?=$row['yl1']?></td>
        <td  align="center"><input name="yl2<?=$i?>" type="text" value="<?=$row['yl2']?>" size="5" maxlength="20"></td>
	<td  align="center"><input name="yl3<?=$i?>" type="text" value="<?=$row['yl3']?>" size="5" maxlength="20"></td>
      </tr>
      <?php
	  			$i++;
			}
		}
	  ?>
    <tr><td colspan="25">职称设置</td></tr>
                <tr>
                    <td  align="center">类别</td>
                    <td  align="center">职称</td>
<!--                    <td colspan="4" align="center">升级条件</td>-->
                    <td  align="center">伞下业绩奖(%)</td>
                </tr>	
	<?php
      	$sql = "SELECT * FROM `zjulevel` where ulevel>0 order by ulevel";
		if($query = mysql_query($sql)){
			$i=1;
			while ($row=mysql_fetch_array($query)){
                            
	  ?>
    <tr>
        <td  align="center"><input name="zjid<?=$i?>" type="hidden" value="<?=$row['id']?>"><?=$row['ulevel']?></td>
        <td  align="center"><input name="zjname<?=$i?>" type="text" value="<?=$row['zjname']?>"size="5" maxlength="20"></td> 
<!--        <td  align="center"><input name="z1<?=$i?>" type="hidden" value="<?=$row['z1']?>" size="5" maxlength="20"><?=$row['z1']?></td>
        <td  align="center"><input name="z2<?=$i?>" type="text" value="<?=$row['z2']?>" size="5" maxlength="20"></td>
        <td  align="center"><input name="z3<?=$i?>" type="hidden" value="<?=$row['z3']?>" size="5" maxlength="20">考核等级</td>
        <td  align="center"><input name="z4<?=$i?>" type="text" value="<?=$row['z4']?>" size="5" maxlength="20"></td>-->
        <td  align="center"><input name="z5<?=$i?>" type="text" value="<?=$row['z5']?>" size="5" maxlength="20"></td>
    </tr>
      <?php
	  			$i++;
			}
		}
	  ?>
     <tr> <td  colspan="13">其他奖金</td></tr>               
                    	<tr>
	<td   align="center">类别</td>
	<td   align="center">直推奖(%)</td>
        <td   align="center">平级奖(%)</td>
        <td   align="center">报单费(%)</td>
        <td   align="center">平台服务费(%)</td>
        <td   align="center">升级合格经销商(人)</td>
        <td   align="center">合格经销商经销奖(%)</td>
    </tr>
	<?php
      	$sql = "SELECT * FROM `jiangjin` where id=1";
		if($query = mysql_query($sql)){
			$i=1;
			while ($row=mysql_fetch_array($query)){
	  ?>
                       <tr>
	<td  align="center"><input name="lvid<?=$i?>" type="hidden" value="<?=$row['id']?>">参数</td>
       <td  align="center"><input name="a1<?=$i?>" type="text" value="<?=$row['a1']?>" size="5" maxlength="20"></td>
        <td  align="center"><input name="a2<?=$i?>" type="text" value="<?=$row['a2']?>" size="5" maxlength="20"></td>
	<td  align="center"><input name="a3<?=$i?>" type="text" value="<?=$row['a3']?>" size="5" maxlength="20"></td>
        <td  align="center"><input name="a4<?=$i?>" type="text" value="<?=$row['a4']?>" size="5" maxlength="20"></td>
        <td  align="center"><input name="a5<?=$i?>" type="text" value="<?=$row['a5']?>" size="5" maxlength="20"></td>
        <td  align="center"><input name="a6<?=$i?>" type="text" value="<?=$row['a6']?>" size="5" maxlength="20"></td>
      </tr>
      <?php
	  			$i++;
			}
		}
	  ?>
    <tr><td colspan="25"></td></tr>
       </table>
                
               
                    <input type="submit" value="保存" name="button" id="button" class="button"/>
                
            </div>
            </form>
        </div>
    </section>
</div>
</body>
</html>