<?php
include_once("../function.php");
class ulevel_class{
	function getulevelbyulevel($ul){
		$sql = "SELECT * FROM `ulevel` where ulevel=".$ul."";
		$query = mysql_query($sql);
		return mysql_fetch_array($query);
	}
	function ulevel_update($_ulevel){
		edit_update_cl('ulevel',$_ulevel,$_ulevel['id']);
	}
	
	function Getulevelcount(){
		$sql = "SELECT * FROM `ulevel` where ulevel>0";
		$query = mysql_query($sql);
		return mysql_num_rows($query);
	}
	
	function getyanse($lx){
	    $sql = "SELECT * FROM `yanse` where lx=".$lx." and isdisplay=1";
	    $query = mysql_query($sql);
	    return mysql_fetch_array($query);
	}
	
	
	
}
?>