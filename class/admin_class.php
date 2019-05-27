<?php
include_once("../function.php");
class admin_class{
	var $_tab="to_admin";
	function getadminbynamepass($_loginname,$_loginpass){
	    $_loginpass = md5($_loginpass);
		$sql="select * from `".$this->_tab."` where loginname='".$_loginname."' ";
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query);
		if ($row['loginpass']==$_loginpass){
			return $row;
		}
	}
	
	function getadminbyname($_loginname){
		$sql="select * from `".$this->_tab."` where loginname='".$_loginname."'";
		$query=mysql_query($sql);
		return mysql_fetch_array($query);
	}
	
	function getadminbyid($_id){
		$sql="select * from `".$this->_tab."` where id=".$_id."";
		$query=mysql_query($sql);
		return mysql_fetch_array($query);
	}
	
	function admin_update($err,$id){
		edit_update_cl($this->_tab,$err,$id);
	}
	function admin_denglu($nickname){
		//获取当前IP
		$ip['ip'] = $_SERVER["REMOTE_ADDR"];
		$ip['date']=now();
		$ip['nickname']=$nickname;
		add_insert_cl('ipdz',$ip);
	}
	
	function admin_insert($err){
		add_insert_cl($this->_tab,$err);
	}
	
	function admin_delete($id){
		edit_delete_cl($this->_tab,$id);
	}
	
}
?>