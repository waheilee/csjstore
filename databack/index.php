<?php
/*
** ����汾:������ݱ���ϵͳv1.0
** ���Ի���:php+mysql
** ��������:2009-07-15
** �������:�Y�ěi��| (��ַ:http://www.he-qi.com  ����:ye3312#163.com  QQ:280708784)
** ����ʹ�ñ������뱣��������Ϣ��
*/
error_reporting(E_ERROR | E_PARSE);
define('D_P',__FILE__ ? getdirname(__FILE__).'/' : './');
define('R_P',D_P."include/");
require_once("inc.config.php");
include("../adminlogin/admin_check.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
//checkqx(7,24);
$admin_file = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
 
require_once(R_P."/admin.php");
require_once(R_P."/bakup.php");
 
function SafeFunc(){
	//Safe The Admin
}
function getdirname($path){
	if(strpos($path,'\\')!==false){
		return substr($path,0,strrpos($path,'\\'));
	}elseif(strpos($path,'/')!==false){
		return substr($path,0,strrpos($path,'/'));
	}else{
		return '/';
	}
}
?>