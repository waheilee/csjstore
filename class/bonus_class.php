<?php
ini_set("max_execution_time",3600);
include_once("../function.php");
include_once("member_class.php");
include_once("ulevel_class.php");
include_once("system_class.php");

class bonus_class{
    
    function guanwang(){
        edit_sql("update `systemparameters` set xtkg=0 where id=1 ");
    }
    function kaiwang(){
        edit_sql("update `systemparameters` set xtkg=1,pdt=now() where id=1 ");
    }
//b1  直推奖
//b3  报单费
//b4  经销奖
//b5  伞下业绩奖
//b6  静态
//b7  平台维护费
//b8  合格经销商经销奖
    
    
// 推荐奖
function b1bonus($id,$lsk){
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    
    $us=getOne("select nickname,reid from member where id=$id");
    
    if ($us['reid']!=0){
        $uss=getOne("select id,nickname from member where id={$us['reid']}");
        
        $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buyid=".$uss['id']." and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
        $con=count($arr);//单数
        
        if ($con>=1){
            $iul= getOne("select a1 from jiangjin where id=1");
            
            $b1=$iul['a1']*$lsk/100;
            if ($b1>0){
                edit_sql("update `member` set b1=b1+$b1 where id=".$uss['id']."");
                $this->bonus_laiyuan($uss['id'],$uss['nickname'],$id,$us['nickname'],1,$b1,$iul['a1']."% 直推奖");
            }
        }
    }
}
//平级奖
function b2bonus($id,$lsk){
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    $us=getOne("select id,nickname,reid,ulevel from member where id=$id");
    if($us['reid']<>0){
        $uss = getOne("SELECT id,nickname,reid,ulevel FROM member where id={$us['reid']}");
        if ($uss['ulevel']==$us['ulevel']) {
            $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buyid=".$uss['id']." and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
            $con=count($arr);//单数
            if ($con>=1){
                $iul= getOne("select a2 from jiangjin where id=1");
                $b2=$iul['a2']*$lsk/100;
                if ($b2>0){
                    edit_sql("update `member` set b2=b2+'$b2' where id=".$uss['id']."");
                    $this->bonus_laiyuan($uss['id'],$uss['nickname'],$id,$us['nickname'],2,$b2,$iul['a2']."% 平级奖");
                }
            }
        }
    }
}

//平级奖
function b9bonus($id,$lsk){
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    $us=getOne("select id,nickname,reid,zjulevel1 from member where id=$id");
    if($us['reid']<>0){
        $uss = getOne("SELECT id,nickname,reid,zjulevel1 FROM member where id={$us['reid']}");
        if ($uss['zjulevel1']==$us['zjulevel1']) {
            $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buyid=".$uss['id']." and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
            $con=count($arr);//单数
            if ($con>=1){
                $iul= getOne("select a2 from jiangjin where id=1");
                $b2=$iul['a2']*$lsk/100;
                if ($b2>0){
                    edit_sql("update `member` set b2=b2+'$b2' where id=".$uss['id']."");
                    $this->bonus_laiyuan($uss['id'],$uss['nickname'],$id,$us['nickname'],2,$b2,$iul['a2']."% 合格经销商平级奖");
                }
            }
        }
    }
}

//报单费
function b3bonus($id,$lsk){
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    $us=getOne("select id,nickname,bdid from member where id=$id");
    if($us['bdid']!=0){
            $uss = getOne("SELECT id,nickname,isbd,reid FROM member where id={$us['bdid']}");
            if ($uss['isbd']==2){
                $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buyid=".$uss['id']." and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
                $con=count($arr);//单数
                
                if ($con>=1){
                $iul= getOne("select a3 from jiangjin where id=1");
                $b3=$iul['a3']*$lsk/100;
                    if ($b3>0){
                        edit_sql("update `member` set b3=b3+'$b3' where id=".$uss['id']."");
                        $this->bonus_laiyuan($uss['id'],$uss['nickname'],$id,$us['nickname'],3,$b3,$iul['a3']."% 报单费"); 
                    }
                }
            }
    }        
}
//合格经销商经销奖
function b8bonus($id,$lsk){
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    
    $us=getOne("select id,nickname,reid from member where id=$id");
    $reid=$us['reid'];
    for ($i=1;$i;$i++){
        $b8=0;
        $uss=getOne("select id,nickname,zjulevel1,reid from member where id=$reid");
        if($i==2){
        if($uss['zjulevel1']==2){
            $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buyid=".$uss['id']." and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
            $con=count($arr);//单数
            if ($con>=1){
                $level=getOne("select a6 from jiangjin where id=1");
                $b8=$level['a6']*$lsk/100;
                if ($b8>0){
                    edit_sql("update member set b8=b8+{$b8} where id={$uss['id']}");
                    $this->bonus_laiyuan($uss['id'],$uss['nickname'],$us['id'],$us['nickname'],8,$b8,$level['a6']."%合格经销商经销奖");
                    $this->b9bonus($uss['id'],$b8);
                    break;
                }
            }
        }
        }
        if ($uss['reid']!=0) {
            $reid=$uss['reid'];
        }else{
            break;
        }
    }
}

//经销奖
function b4bonus($id,$lsk){
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    $us=getOne("select id,nickname,reid from member where id=$id");
    $reid=$us['reid'];
    $cha=0;$you=0;$ulevel=0;
    for ($i=1;$i;$i++){
        $b4=0;$cha=0;
        $uss=getOne("select id,nickname,ulevel,reid from member where id=$reid");
        if($uss['ulevel']>$ulevel){
            $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buyid=".$uss['id']." and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
            $con=count($arr);//单数
            if ($con>=1){
                $level=getOne("select * from ulevel where ulevel={$uss['ulevel']}");
                $cha=$level['yl3']-$you;
                $you=$level['yl3'];
                $b4=$cha*$lsk/100;
                $ulevel=$uss['ulevel'];
                if ($b4>0){
                    edit_sql("update member set b4=b4+{$b4} where id={$uss['id']}");
                    $this->bonus_laiyuan($uss['id'],$uss['nickname'],$us['id'],$us['nickname'],4,$b4,$cha."%经销奖");
                    $this->b2bonus($uss['id'],$b4);
                }
            }
        }
        if ($uss['reid']!=0) {
            $reid=$uss['reid'];
        }else{
            break;
        }
    }
}

//伞下业绩奖
function b5bonus($id,$lsk){
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    $us=getOne("select id,nickname,reid,lsk from member where id=$id");
    $reid=$us['reid'];
     $cha=0;$you=0;$zjulevel=0;
    for ($i=1;$i;$i++){
        $b5=0;$cha=0;
        $uss=getOne("select id,nickname,zjulevel,reid from member where id=$reid");
        if($uss['zjulevel']>$zjulevel){
            $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buyid=".$uss['id']." and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
            $con=count($arr);//单数
            if ($con>=1){
                $level=getOne("select z5 from zjulevel where ulevel={$uss['zjulevel']}");
                $cha=$level['z5']-$you;
                $you=$level['z5'];
                $b5=$cha*$lsk/100;
                $zjulevel=$uss['zjulevel'];
                if ($b5>0){
                    edit_sql("update member set b5=b5+{$b5} where id={$uss['id']}");
                    $this->bonus_laiyuan($uss['id'],$uss['nickname'],$us['id'],$us['nickname'],5,$b5,$cha."%伞下业绩奖");
                }
            }
        }
        if ($uss['reid']!=0) {
            $reid=$uss['reid'];
        }else{
            break;
        }
    }
}


//升级
function zjulevel($id){
    $us= getOne("SELECT id,nickname,reid FROM member where id=$id");
    $ul= getOne("SELECT a5 FROM jiangjin where id=1");
    $reid=$us['reid'];
    if($reid<>0){
        $uss=getOne("SELECT id,nickname,reid,zjulevel1 FROM member where id=$reid");
        if($uss['zjulevel1']<>2){
            $arr = getOne("SELECT count(id) from member where reid={$uss['id']} and cy=1");
//            var_dump($uss['id'],$arr['count(id)'],$ul['a5']);die;
            if($arr['count(id)']>=$ul['a5']){
                edit_sql("update `member` set zjulevel1=2 where id={$uss['id']}"); 
            }
        }
        if ($uss['reid']!=0) {
            $reid=$uss['reid']; 
        }
    }
}

function zjulevel1(){
    edit_sql("update `member` set ulevel=1");//降级
    $ul= getOne("SELECT yl2 FROM ulevel where ulevel=2");
    $ul1= getOne("SELECT yl2 FROM ulevel where ulevel=3");
    $ul2= getOne("SELECT yl2 FROM ulevel where ulevel=4");
    $arr = getAll("SELECT id,ulevel,reid,yarea1 FROM member");
    foreach ($arr as $key =>$row){
        if($row['yarea1']>=$ul['yl2'] && $row['yarea1']<$ul1['yl2']){
        edit_sql("update `member` set ulevel=2 where id={$row['id']}");
        }elseif($row['yarea1']>=$ul1['yl2'] && $row['yarea1']<$ul2['yl2']){
        edit_sql("update `member` set ulevel=3 where id={$row['id']}");    
        }elseif($row['yarea1']>=$ul2['yl2']){
        edit_sql("update `member` set ulevel=4 where id={$row['id']}");    
        }
    }
} 


//function sj(){
//    edit_sql("update `member` set zjulevel=0");//降级
//    $zjul1= getOne("SELECT z2 FROM zjulevel where ulevel=1");
//    $arr = getAll("SELECT id,zjulevel,reid FROM member where yarea2>={$zjul1['z2']}");
//    foreach ($arr as $key =>$row){
//        edit_sql("update `member` set zjulevel=1 where id={$row['id']}");
//    }
//} 
//
//function sj1(){
//    $zjul2= getOne("SELECT z2,z4 FROM zjulevel where ulevel=2");
//    $arr = getAll("SELECT id,zjulevel FROM member where zjulevel=1");
//    foreach ($arr as $key =>$row){
//        $arr1 = getOne("SELECT count(id) from member where reid={$row['id']} and zjulevel={$zjul2['z4']}");
//        if($arr1['count(id)']>=$zjul2['z2']){
//            edit_sql("update `member` set zjulevel=2 where id={$row['id']}");
//        }
//    }
//}
//
//function sj2(){
//    $zjul3= getOne("SELECT z2,z4 FROM zjulevel where ulevel=3");
//    $arr = getAll("SELECT id,zjulevel FROM member where zjulevel=2");
//    foreach ($arr as $key =>$row){
//        $arr1 = getOne("SELECT count(id) from member where reid={$row['id']} and zjulevel={$zjul3['z4']}");
//        if($arr1['count(id)']>=$zjul3['z2']){
//            edit_sql("update `member` set zjulevel=3 where id={$row['id']}");
//        }
//    }
//}

//卖出操作
function ircout($member,$FileID,$goodsid,$goodsname,$dan){
    
    $out['ordersnumber']=$FileID;
    $out['sellid']=$member['id'];
    $out['sellnickname']=$member['nickname'];
    
    $out['num']=1;//卖出数量
    
    $out['goodsid']=$goodsid;
    $out['goodsname']=$goodsname;
    
    $out['cdate']=now();//卖入时间
    
    $out['lx']=2;//卖出数量
    
    $out['lsk']=$dan;//卖出数量
    
    add_insert_cl('buysell',$out);
    
}
//买入操作
function ircbuy($member,$FileID,$goodsid,$goodsname,$dan){
    
    $buy['ordersnumber']=$FileID;
    $buy['buyid']=$member['id'];
    $buy['buynickname']=$member['nickname'];
    
    $buy['goodsid']=$goodsid;
    $buy['goodsname']=$goodsname;
    
    $buy['num']=1;//卖出数量
    
    $buy['cdate']=now();//卖入时间
    
    $buy['lx']=1;//卖出数量
    
    $buy['lsk']=$dan;//卖出数量
    
    add_insert_cl('buysell',$buy);
    
}


//以卖家为中心  找下买家
function ppsell(){
    
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    
    $now=now();
    $sys=getOne("select id,num,d2 from systemparameters where id=1");
    
    $uuu=getOne("select id,lsk from ulevel where id=1");
    //找出最早未匹配的卖家 同等价格的会员
    
    $sql = "SELECT * FROM `buysell` WHERE isgrant=0 and lx=2 order by id asc ";//买家信息 找出来
    $arr=getAll($sql);
    $con=count($arr);
    if($con>=1){
        foreach ($arr as $key =>$me){
        $id=0;
        for ($i=1;$i;$i++){
        
            $sql = "SELECT * FROM `buysell` WHERE isgrant=0 and lx=1 and buyid!=".$me['sellid']." and id>=$id order by id asc limit 0,1";//找出来买家
            $you=getOne($sql);//
            
            if ($you['id']!=null){
            
                //买家今天成交的单数  买入的单数
                $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buyid=".$you['buyid']." and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
                $con=count($arr);//单数
                
                //echo a;var_dump($sys['d2']);
                
                if ($con < $sys['d2']){//今天匹配少于1单，可以匹配
                    
                     //die();
                    
                    edit_sql("update `buysell` set uid={$you['id']},sdate='".$now."',isgrant=1 where id=".$me['id']."");//卖家信息修改
                 
                    edit_sql("update `buysell` set uid={$me['id']},sdate='".$now."',isgrant=1 where id=".$you['id']."");//买家信息修改
                    
                    //修改订单的信息   卖家
                    
                    edit_sql("update `orders2` set sdate='".$now."',gs=1 where ordersnumber=".$me['ordersnumber']."");
                    //修改订单的信息   买家
                    edit_sql("update `orders2` set date='".$now."',gs=1 where onb=".$you['ordersnumber']."");
                    
                  
                    //算奖金 销售奖
                    $this->b6bonus($me['ordersnumber']);
                    
                    // 结算奖金
                    $this->addArea($you['buyid'],$uuu['lsk']);//加业绩
                    $this->b1bonus($you['buyid'],$uuu['lsk']);//直推
                    $this->b3bonus($you['buyid'],$uuu['lsk']);//报单
                    $this->b4bonus($you['buyid'],$uuu['lsk']);
                    $this->b5bonus($you['buyid'],$uuu['lsk']);
                    $this->b8bonus($you['buyid'],$uuu['lsk']);
                    
                    break;
                    
                }else {//寻找下一个
                    $id=$you['id'];//下次跳过这个id
                }
        
            }else {
                break;
            }
        }
    }
    }
    
}



//以买家为中心  找下买家
function ppbuy(){
    
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    
    
    $now=now();
    $sys=getOne("select id,num,d2 from systemparameters where id=1");
    $uuu=getOne("select id,lsk from ulevel where id=1");
    //找出最早未匹配的卖家 同等价格的会员
    
    $sql = "SELECT * FROM `buysell` WHERE isgrant=0 and lx=1 order by id asc ";//买家信息 找出来
    $arr=getAll($sql);
    $con=count($arr);
    if($con>=1){
    
    foreach ($arr as $key =>$row){
    
        //买家今天成交的单数  买入的单数
        $arr=getAll("SELECT * FROM `buysell` WHERE isgrant=1 and lx=1 and buyid=".$row['buyid']." and year(sdate)=".$y." and month(sdate)=".$m." and day(sdate)=".$d."");//
        $con=count($arr);//单数
        
        //var_dump($con) ;die();
        if ($con < $sys['d2']){//今天买家每天只能买一单
            
            $sql = "SELECT * FROM `buysell` WHERE isgrant=0 and lx=2 and sellid!=".$row['buyid']." order by id asc limit 0,1";//找出来卖家
            $you=getOne($sql);//
            
            if ($you['id']!=null){
                
                edit_sql("update `buysell` set uid={$row['id']},sdate='".$now."',isgrant=1 where id=".$you['id']."");//卖家信息修改
                edit_sql("update `buysell` set uid={$you['id']},sdate='".$now."',isgrant=1 where id=".$row['id']."");//买家信息修改
                
                //修改订单的信息   卖家
                
                edit_sql("update `orders2` set sdate='".$now."',gs=1 where ordersnumber=".$you['ordersnumber']."");
                //修改订单的信息   买家
                edit_sql("update `orders2` set date='".$now."',gs=1 where onb=".$row['ordersnumber']."");
                
                //算奖金 销售奖
                $this->b6bonus($you['ordersnumber']);
                
                
                // 结算奖金
                $this->addArea($row['buyid'],$uuu['lsk']);//加业绩
                $this->b1bonus($row['buyid'],$uuu['lsk']);//直推
                $this->b3bonus($row['buyid'],$uuu['lsk']);//报单
                $this->b4bonus($row['buyid'],$uuu['lsk']);
                $this->b5bonus($row['buyid'],$uuu['lsk']);
                $this->b8bonus($row['buyid'],$uuu['lsk']);
            
            }  
        }
               
        }
    }
    
}


//后台指定匹配
function pphome($id){
    
    $now=now();
    $uuu=getOne("select id,lsk from ulevel where id=1");
    
    $sql = "SELECT * FROM `buysell` WHERE id=$id ";//后台指定的记录
    $row=getOne($sql);
    
    if($row['id']!=null){
        
       if ($row['lx']==1){//买入
           edit_sql("update `buysell` set sdate='".$now."',isgrant=1 where id=".$row['id']."");//买家信息修改
           edit_sql("update `orders2` set date='".$now."',gs=1 where onb=".$row['ordersnumber']."");
           
           
           // 结算奖金
           $this->addArea($row['buyid'],$uuu['lsk']);//加业绩
           $this->b1bonus($row['buyid'],$uuu['lsk']);//直推
           $this->b3bonus($row['buyid'],$uuu['lsk']);//报单
           $this->b4bonus($row['buyid'],$uuu['lsk']);
           $this->b5bonus($row['buyid'],$uuu['lsk']);
           $this->b8bonus($row['buyid'],$uuu['lsk']);
           
           
       }elseif ($row['lx']==2){//卖出
           
           edit_sql("update `buysell` set sdate='".$now."',isgrant=1 where id=".$row['id']."");//卖家信息修改
           edit_sql("update `orders2` set sdate='".$now."',gs=1 where ordersnumber=".$row['ordersnumber']."");
           
           //算奖金 销售奖
           $this->b6bonus($row['ordersnumber']);
       }
        
    }
    
}

//前台指定卖出个人
function ppweb($sell,$buy){
    
    
   // echo $sell;echo a ;echo $buy; die();
    
    $now=now();
    $uuu=getOne("select id,lsk from ulevel where id=1");
    
    $sql = "SELECT * FROM `buysell` WHERE id='".$buy."' and lx=1";//买家
    $buy=getOne($sql);
    
    $sql = "SELECT * FROM `buysell` WHERE ordersnumber='".$sell."' and lx=2";//卖家
    $sell=getOne($sql);
    
    if($buy['isgrant']==0 && $sell['isgrant']==0){
        
      
        edit_sql("update `buysell` set uid=".$buy['id'].",sdate='".$now."',isgrant=1 where id=".$sell['id']."");//卖家信息修改
       
       
        edit_sql("update `buysell` set uid=".$sell['id'].",sdate='".$now."',isgrant=1 where id=".$buy['id']."");//买家信息修改
        
        //修改订单的信息   卖家
        
        edit_sql("update `orders2` set sdate='".$now."',gs=1 where ordersnumber=".$sell['ordersnumber']."");
        //修改订单的信息   买家
    
        edit_sql("update `orders2` set date='".$now."',gs=1 where onb=".$buy['ordersnumber']."");
        
        //算奖金 销售奖
        $this->b6bonus($sell['ordersnumber']);
        
        // 结算奖金
        $this->addArea($buy['buyid'],$uuu['lsk']);//加业绩
        $this->b1bonus($buy['buyid'],$uuu['lsk']);//直推
        $this->b3bonus($buy['buyid'],$uuu['lsk']);//报单
        $this->b4bonus($buy['buyid'],$uuu['lsk']);
        $this->b5bonus($buy['buyid'],$uuu['lsk']);
        $this->b8bonus($buy['buyid'],$uuu['lsk']);
            
   }
}

function b6bonus($FileID){
    $sql = "SELECT * FROM `orders2` WHERE gs=1 and ordersnumber=".$FileID." ";//卖家信息
    $me=getOne($sql);//卖家
    if ($me){
        $iul= getOne("select a4 from jiangjin where id=1");
        $b6=$me['jine'];
        if ($b6>0){
            edit_sql("update `member` set b6=b6+$b6 where id=".$me['uid']."");
            $this->bonus_laiyuan($me['uid'],$me['userid'],"-","-",6,$b6,"销售奖");
            
            if ($me['lunci']!=4){
                
                $iul= getOne("select a4 from jiangjin where id=1");
                $b7=-$b6*$iul['a4']/100;
                if($b7<0){
                    edit_sql("update `member` set b7=b7+$b7 where id=".$me['uid']."");
                    $this->bonus_laiyuan($me['uid'],$me['nickname'],"-","-",7,$b7,"平台维护费");
                }
            }
        }
    }
}
    
function addArea($id,$dan){
    $sql="select id,userid,reid from member where id=$id";
    $us=getOne($sql);
    $reid=$us['reid'];
    if($reid!=0){
        for($i=1;$i;$i++){
            $fman_update=null;
            $fman=getOne("select id,userid,reid,area1,yarea1,yarea2,narea1 from member where id=".$reid."");
            $fman_update['area1']=$fman['area1']+$dan;
            $fman_update['yarea1']=$fman['yarea1']+$dan;
//             $fman_update['yarea2']=$fman['yarea2']+$dan;
//             $fman_update['narea1']=$fman['narea1']+1;
            edit_update_cl('member',$fman_update,$fman['id']);
            if ($fman['reid']!=0){
                $reid=$fman['reid'];
            }else {
                break;
            }
        }
    }
}
    /*
     *查询累计金额
     *$_jx=奖金类型b0,b1,b2……
     *$_uid=查询编号
     *$_lx=查询类型0总计,1月,2日,3周
     */
    function ljbonus($_jx,$_uid,$_lx){
        $y=date("Y",strtotime(now()));
        $m=date("m",strtotime(now()));
        $d=date("d",strtotime(now()));
        $sql="SELECT sum(".$_jx.") from `bonus` where uid=".$_uid."";
        if($_lx==1){
            $sql=$sql." and year(bdate)=".$y." and month(bdate)=".$m."";
        }else if($_lx==2){
            $sql=$sql." and year(bdate)=".$y." and month(bdate)=".$m." and day(bdate)=".$d."";
        }else if($_lx==3){
            $sql=$sql." and month(bdate) = month(curdate()) and week(bdate,1) = week(curdate(),1)";
        }
        
        if ($query=mysql_query($sql)){
            while ($row=mysql_fetch_array($query)){
                $fanhui=$row[0];
            }
        }else{
            $fanhui=0;
        }
        return $fanhui;
    }
    
    function b0bonus(){
        $_ulevel_cl=new ulevel_class();
        $system_cl=new system_class();
        $_system=$system_cl->system_information(1);
        $lj=0;
        $lx=1; //产生数据条数,0产生N条,1每日产生1条
        $did=$this->bonustime_insert($lx);
        $sql="SELECT b1,b2,b3,b4,b5,b6,b7,b8,b9,id,userid,nickname,mey,maxmey,pdt,ulevel,ispay,zsq,cfxf,rejine FROM `member` WHERE (b1>0 or b2>0 or b3>0 or b4>0 or b5>0 or b6>0 or b7<0 or b8<0) and ispay>0 order by id asc";
        $arr=getAll($sql);
        $sql="select * from systemparameters where id=1";
        $sys=getOne($sql);
        
        foreach ($arr as $key => $row){
            
            //echo $row['nickname'];
            $member_update=NULL;
            $b1=$row['b1'];//直推奖
            $b2=$row['b2'];//平级奖
            $b3=$row['b3'];//报单费
            $b4=$row['b4'];//经销奖
            $b5=$row['b5'];
            $b6=$row['b6'];
            $b7=$row['b7'];
            $b8=$row['b8'];
            $b9=0;
            
            
            $b0=$b1+$b2+$b3+$b4+$b8;
           
            $member_update['b0']=0;
            $member_update['b1']=0;
            $member_update['b2']=0;
            $member_update['b3']=0;
            $member_update['b4']=0;
            $member_update['b5']=0;
            $member_update['b6']=0;
            $member_update['b7']=0;
            $member_update['b8']=0;
            $member_update['b9']=0;
            $member_update['b10']=0;
            $member_update['b11']=0;
            $member_update['b12']=0;

            $member_update['mey']=$row['mey']+$b0;
            $member_update['cfxf']=$row['cfxf']+$b5+$b6+$b7;
            $member_update['maxmey']=$row['maxmey']+$b0;	
            
            
            $b0=$b0+$b5+$b6+$b7;
           
            edit_update_cl('member',$member_update,$row['id']);
            $bonus_update['did']=$did;
            $bonus_update['uid']=$row['id'];
            $bonus_update['b0']=$b0;
            $bonus_update['b1']=$b1;
            $bonus_update['b2']=$b2;
            $bonus_update['b3']=$b3;
            $bonus_update['b4']=$b4;
            $bonus_update['b5']=$b5;
            $bonus_update['b6']=$b6;
            $bonus_update['b7']=$b7;
            $bonus_update['b8']=$b8;
            $bonus_update['b9']=$b9;
            $bonus_update['b10']=$b10;
            $bonus_update['b11']=$b11;
            $bonus_update['b12']=$b12;
            $lj=$lj+$b0;
            if($b0>0){
            $this->bonus_insert($lx,$bonus_update);
            }
        }
        
        
        $_systemyeji=new system_class();
        $_systemyeji->yejitongji(0,0,0,$lj,0,0,0);
    }
    
    /*
     *@lx 0产生多条数据，1每天产生1条
     */
    function bonustime_insert($lx){
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        if($lx==1){
            $sql="SELECT * FROM `bonustime` WHERE year(jsdate)=".$y." and month(jsdate)=".$m." and day(jsdate)=".$d."";
            $query=mysql_query($sql);
            if ($_bonustime=mysql_fetch_array($query)){
                $did=$_bonustime['id'];
            }else{
                $sql1="INSERT INTO bonustime(jsdate,jslx) VALUES('".now()."',1)";
                $reult=mysql_query($sql1);
                $did=mysql_insert_id();
            }
        }else if($lx==0){
            $sql1="INSERT INTO bonustime(jsdate,jslx) VALUES('".now()."',1)";
            $reult=mysql_query($sql1);
            $did=mysql_insert_id();
        }
        return $did;
    }
    
    /*
     *@lx 0产生多条数据，1每天产生1条,必须与bonustime的lx同步
     */
    function bonus_insert($lx,$_bonus){
        $y=date("Y");
        $m=date("m");
        $d=date("d");
        if($lx==1){
            $sql="SELECT * FROM `bonus` WHERE year(bdate)=".$y." and month(bdate)=".$m." and day(bdate)=".$d." and uid=".$_bonus['uid']."";
            $query=mysql_query($sql);
            if ($bonus=mysql_fetch_array($query)){
                $bonus_update=NULL;
                $bonus_update['b0']=$bonus['b0']+$_bonus['b0'];
                $bonus_update['b1']=$bonus['b1']+$_bonus['b1'];
                $bonus_update['b2']=$bonus['b2']+$_bonus['b2'];
                $bonus_update['b3']=$bonus['b3']+$_bonus['b3'];
                $bonus_update['b4']=$bonus['b4']+$_bonus['b4'];
                $bonus_update['b5']=$bonus['b5']+$_bonus['b5'];
                $bonus_update['b6']=$bonus['b6']+$_bonus['b6'];
                $bonus_update['b7']=$bonus['b7']+$_bonus['b7'];
                $bonus_update['b8']=$bonus['b8']+$_bonus['b8'];
                $bonus_update['b9']=$bonus['b9']+$_bonus['b9'];
                $bonus_update['b10']=$bonus['b10']+$_bonus['b10'];
                $bonus_update['b11']=$bonus['b11']+$_bonus['b11'];
                $bonus_update['b12']=$bonus['b12']+$_bonus['b12'];
                edit_update_cl('bonus',$bonus_update,$bonus['id']);
            }else{
                $bonus_update=NULL;
                $bonus_update['bdate']=now();
                $bonus_update['did']=$_bonus['did'];
                $bonus_update['uid']=$_bonus['uid'];
                $bonus_update['b0']=$_bonus['b0'];
                $bonus_update['b1']=$_bonus['b1'];
                $bonus_update['b2']=$_bonus['b2'];
                $bonus_update['b3']=$_bonus['b3'];
                $bonus_update['b4']=$_bonus['b4'];
                $bonus_update['b5']=$_bonus['b5'];
                $bonus_update['b6']=$_bonus['b6'];
                $bonus_update['b7']=$_bonus['b7'];
                $bonus_update['b8']=$_bonus['b8'];
                $bonus_update['b9']=$_bonus['b9'];
                $bonus_update['b10']=$_bonus['b10'];
                $bonus_update['b11']=$_bonus['b11'];
                $bonus_update['b12']=$_bonus['b12'];
                add_insert_cl('bonus',$bonus_update);
            }
        }else if($lx==0){
            $bonus_update=NULL;
            $bonus_update['bdate']=now();
            $bonus_update['did']=$_bonus['did'];
            $bonus_update['uid']=$_bonus['uid'];
            $bonus_update['b0']=$_bonus['b0'];
            $bonus_update['b1']=$_bonus['b1'];
            $bonus_update['b2']=$_bonus['b2'];
            $bonus_update['b3']=$_bonus['b3'];
            $bonus_update['b4']=$_bonus['b4'];
            $bonus_update['b5']=$_bonus['b5'];
            $bonus_update['b6']=$_bonus['b6'];
            $bonus_update['b7']=$_bonus['b7'];
            $bonus_update['b8']=$_bonus['b8'];
            $bonus_update['b9']=$_bonus['b9'];
            $bonus_update['b10']=$_bonus['b10'];
            $bonus_update['b11']=$_bonus['b11'];
            $bonus_update['b12']=$_bonus['b12'];
            add_insert_cl('bonus',$bonus_update);
        }
    }
    
    //写入奖金来源
    function bonus_laiyuan($uid,$nickname,$yid,$ynickname,$lx,$jine,$beizhu){
        $bonuslaiyuan=NULL;
        $bonuslaiyuan['uid']=$uid;
        $bonuslaiyuan['nickname']=$nickname;
        $bonuslaiyuan['yid']=$yid;
        $bonuslaiyuan['ynickname']=$ynickname;
        $bonuslaiyuan['lx']=$lx;
        $bonuslaiyuan['jine']=$jine;
        $bonuslaiyuan['bdate']=now();
        $bonuslaiyuan['beizhu']=$beizhu;
        add_insert_cl('bonuslaiyuan',$bonuslaiyuan);
    }
    
    //写入
    function hlb_laiyuan($uid,$nickname,$jine){
        $bonuslaiyuan=NULL;
        $bonuslaiyuan['uid']=$uid;
        $bonuslaiyuan['nickname']=$nickname;
        $bonuslaiyuan['jine']=$jine;
        $bonuslaiyuan['bdate']=now();
        add_insert_cl('honglibao',$bonuslaiyuan);
    }
    
    //写入库存
    function orders12($orders,$lx){
        $orders11=NULL;
        $orders11['ordersnumber']=$orders['ordersnumber'];
        $orders11['lx']=$lx;
        $orders11['uid']=$orders['uid'];
        $orders11['goods']=$orders['goods'];
        $orders11['cdate']= now();
        $orders11['sdate']= now();
        add_insert_cl('orders11',$orders11);
        
        $arr= getAll("select id,goodid,ordersnumber,num from orders2 where ordersnumber='{$orders['ordersnumber']}'");
        foreach ($arr as $k=>$row){
            $rs=getOne("select id,lx,goodsname from goods where id=".$row['goodid']." ");

            $or['lx']=$rs['lx'];
            $or['ordersnumber']=$row['ordersnumber'];
            $or['uid']=$orders['uid'];
            $or['goodid']=$rs['id'];
            $or['goodname']=$rs['goodsname'];
            $or['num']=$row['num'];
            $or['date']=now();
            $or['sdate']=now();
            add_insert_cl('orders22',$or);
        }
    }
    
    //写入业绩来源
    function yeji_leiji($uid,$nickname,$jine,$lx){
        $bonuslaiyuan=NULL;
        $bonuslaiyuan['uid']=$uid;
        $bonuslaiyuan['nickname']=$nickname;
        $bonuslaiyuan['jine']=$jine;
        $bonuslaiyuan['lx']=$lx;
        $bonuslaiyuan['gdate']=now();
        add_insert_cl('ljyeji',$bonuslaiyuan);
    }
}
?>