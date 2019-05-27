<?php
include_once("../function.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);

if($_POST['id']){ 
    $jine=0;
    $b=getOne("select id,goodid,yanse,num from buycar where id={$_POST['id']}");
    $o=getOne("select shumu2 from goods where id={$b['goodid']}");
    if($_POST['n']==1 && $b['yanse']==1){
        edit_sql("update buycar set yanse=0 where id={$_POST['id']}");
    }elseif($_POST['n']==1 && $b['yanse']==0){
        edit_sql("update buycar set yanse=1 where id={$_POST['id']}");
    }
    if($_POST['num']>0){
        edit_sql("update buycar set num=num+{$o['shumu2']} where id={$_POST['id']}");
    }elseif($_POST['num']<0){
        if($b['num']>$o['shumu2']){
            edit_sql("update buycar set num=num-{$o['shumu2']} where id={$_POST['id']}");
        }
    }
//    if($_POST['n']>0){
//        edit_sql("update buycar set num={$_POST['n']} where id={$_POST['gid']}");
//    }
    $buy=getOne("select uid from buycar where id={$_POST['id']}");
    $a= getAll("select id,price,num from buycar where yanse=1 and uid={$buy['uid']}");
    foreach ($a as $kk=>$rr){
        $jine+=$rr['price']*$rr['num'];
    }
    echo $jine;
}
if($_POST['gid']){ 
    $jine=0;
    $a= getOne("select id,price,num from buycar where id={$_POST['gid']}");
    $jine=$a['price']*$a['num'];
    echo $jine;
}
if($_POST['did']){ 
    
    $buy=getOne("select id,uid from buycar where id={$_POST['did']}");
    edit_delete_cl('buycar',$buy['id']);
    $jine=0;
    $a= getAll("select id,price,num from buycar where yanse=1 and uid={$buy['uid']}");
    foreach ($a as $kk=>$rr){
        $jine+=$rr['price']*$rr['num'];
    }
    echo $jine;
}
if($_POST['ulevel']){ 
    $cha=0;
    $ul=getOne("select lsk from ulevel where ulevel={$_POST['ulevel']}");
    $cha=$ul['lsk']-$member['lsk'];
    if($cha<0){
        $cha=0;
    }
    echo $cha;
}
if($_POST['gwc']){ 
        $rs=getOne("select * from goods where id=".$_POST['gwc']." ");
        if($rs) {
            
            if ($you=getOne("select * from buycar where goodid={$_POST['gwc']} and uid=".$_SESSION['ID']."")) {
                echo "已经加入购物车，请勿重复添加";
            }else {
                
                $buycar['uid']=$member['id'];
                $buycar['nickname']=$member['nickname'];
                $buycar['goodid']=$rs['id'];
                $buycar['goodsname']=$rs['goodsname'];
                $buycar['price']=$rs['price'];
                $buycar['lx']=$rs['lx'];
                $buycar['goodsimg']=$rs['goodsimg'];
                $buycar['num']=$rs['shumu2'];
                $buycar['yanse']=0;
                
                //$buycar['gdate']= now();
                add_insert_cl('buycar',$buycar);
                echo "成功加入购物车";
            }
        } 
}
?>
