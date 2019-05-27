<?php
include_once("../function.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);

if($_POST['id']){ 
    
    $lb=getOne("select id,goodid from lunbotu where id={$_POST['id']}");
    $goods=getOne("select id from goods where id={$_POST['gid']}");
    if($lb && $goods){
        $lb_up['goodid']=$goods['id'];
        edit_update_cl('lunbotu', $lb_up, $lb['id']); 
        echo 1;
    }else{
        echo 0;
    }
}
?>
