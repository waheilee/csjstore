<?php
include_once ("../../../function.php");
include_once ("../../../class/member_class.php");
include_once ("../../../class/ulevel_class.php");
include_once ("../../../class/system_class.php");
include_once ("../../../class/bonus_class.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);
$_bonus_cl=new bonus_class();
$member_cl = new member_class(); 
// $us=getMemberbyID($_SESSION['ID']);

if($_POST['zid']<>0){
    
//    $or= getOne("select id from orders where id={$_POST['zid']}");
    if($_POST['zf']==-1){
        echo "支付中！";
    }elseif($_POST['zf']==1){
        edit_sql("update orders2 set issend=0 where id={$_POST['zid']}");
        $rs=getOne("select * from orders2 where id={$_POST['zid']}");
        $num=$rs['num'];
        $lx=$rs['lx'];
        $zje=$rs['jine'];
        $FileID=$rs['ordersnumber'];
        $username=$rs['username'];
        $usertel=$rs['usertel'];
        $useraddress=$rs['useraddress'];
        $_ulevel=new ulevel_class();
        $_systemyeji=new system_class();
        $yanse1=$rs["yanse"];
        if($member['ispay']==0 && $lx<>6){
            $member_update['ispay']=1;
            $member_update['pdt']=now();
            $_systemyeji->yejitongji(1,0,0,0,0,0,0);//计算波比
        }
        if($lx<=5){
            $member_update['tao']=$member['tao']+$num;
            $member_update['re1']=$member['re1']+$num;
            $member_update['retao']=$member['retao']+$num;
            if($member['cishu']==0){
                $member_update['cishu']=1;
            }
        }
    
        if($lx==3){
            $member_update['jj']=1;
            // $t1=now();
            // if($sys['xianliang']==0){
            //     edit_sql("update `systemparameters` set xianliang=1,date2='".$t1."' where id=1");            
            // }
        }
        if($lx==4){
            $member_update['qdjf']=1;
            // $t2=now();
            // if($sys['fenhong']==0){
            //     edit_sql("update `systemparameters` set fenhong=1,date3='".$t2."' where id=1");            
            // }
        }
    
        edit_update_cl('member',$member_update,$member['id']);
        $lsk=$zje;
        store($FileID,$arr,$member['id'],$member['nickname'],$username,$usertel,$useraddress,$lr,$lsk,$lx,$yanse1['name']);  /////
        if($lx<>6){
            $_systemyeji->yejitongji(0,0,$zje,0,0,0,0);  //计算波比
        }
        if(($lx<=5) && ($member['cishu']==0)){
            $member_cl->addreyeji($member['id'],$zje,$lx);
            $member_cl->addtao($member['id'],$num);
            $_bonus_cl->b1bonus($member['id'],$lx,$num);
            // $_bonus_cl->b3bonus($zje);
            // $_bonus_cl->b6bonus($zje);
            $_bonus_cl->b4bonus($member['id'],$lx,$num);
            $_bonus_cl->b7bonus($member['id'],$zje);
            // $_bonus_cl->b8bonus($zje);
            $_bonus_cl->b0bonus();
            $_bonus_cl->shengji();
            $_bonus_cl->dongshi();
            // var_dump(111);die;
        }elseif(($lx<=5)&& ($member['cishu']==1)){
            $member_cl->addreyeji($member['id'],$zje,$lx);
            $member_cl->addtao($member['id'],$num);
            // $_bonus_cl->b1bonus($member['id'],$lx,$num);
            $_bonus_cl->b2bonus($member['id'],$lx,$num);
            // $_bonus_cl->b3bonus($zje);
            // $_bonus_cl->b6bonus($zje);
            // die;
            $_bonus_cl->b7bonus($member['id'],$zje);
            // $_bonus_cl->b8bonus($zje);
            $_bonus_cl->b0bonus();
            $_bonus_cl->shengji();
            $_bonus_cl->dongshi();
    
            // var_dump(222);die;
    
        }
        echo "支付成功！";
    }elseif($_POST['zf']==-1){
        echo "支付失败！";
    }
}