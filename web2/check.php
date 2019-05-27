<?php
include_once("../class/system_class.php");
include_once("../function.php");

header("Content-Type: text/html;charset=utf-8");
session_start();
if($_SESSION['to_admin'] != null){
	return ;
}
if ($_SESSION['ID'] == null){
    echo "<script language=javascript>alert('您尚未登录,请您重新登录.');window.location.href='../index.php?'</script>";
	
}
if ($_SESSION['ID'] != 1){
	$_system=new system_class();
	$sys=$_system->system_information(1);
	if ($sys['xtkg']==0){
	    echo "<script language=javascript>alert('系统当前正在维护,暂时无法登录.');window.location.href='../index.php?'</script>";
	
	}
}
?>
