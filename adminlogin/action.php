<?php
include_once "../function.php";
class action
{
	public static function record($lx,$uid,$operation,$jine){
			$ip=$_SERVER["REMOTE_ADDR"];
		$sql="insert action(time,lxx,uid,jine,operationid,ip) values(now(),'{$lx}',{$uid},'{$jine}','{$operation}','{$ip}')";
		mysql_query($sql);
	}
}