<?php
session_start();
if ($_SESSION['to_admin'] == null){
   
	echo "<script language=javascript>alert('您尚未登录,请您重新登录.');top.location='index.php'</script>";	
}

//function checkqx($zq,$q){
//	$_zq="zq".$zq;
//	$_q="q".$q;

//}

?>
