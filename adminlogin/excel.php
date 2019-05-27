<?php
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=table.xls");
include_once "../function.php";
//include_once("../class/member_class.php");
session_start();
if($_GET['table']=='bonus'){//奖金总表
    
	$str="会员编号\t会员姓名\t分红\t实际发放\t\n";
	echo $str;
	$sql="select * from member m left join bonus b on m.id=b.uid where did={$_GET['time']} order by bdate desc";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_assoc($rs)){
		echo $row['nickname']."\t";
		echo $row['username']."\t";
		echo $row['b1']."\t";		
// 		echo $row['b2']."\t";
// 		echo $row['b3']."\t";
// 	 
// 		echo $row['b5']."\t";
// 		echo $row['b6']."\t";
// 		echo $row['b7']."\t";
// 		echo $row['b9']."\t";
// 		echo $row['b8']."\t";
		echo $row['b0']."\t\n";
	}
}elseif($_GET['table']=='jiesuan'){//
		$str="会员编号\t会员姓名\t红利\t人民币\t联系电话\t开户银行\t开户姓名\t开户帐号\t开户地址\t时间\t\n";
		echo $str;
		$sql="select * from jingtai where did={$_GET['time']} order by date asc";
		$rs=mysql_query($sql);
		while($row=mysql_fetch_assoc($rs)){
			$you=getOne("SELECT * FROM `member` where id=".$row['uid']."");
			echo $row['nickname']."\t";
			echo $you['username']."\t";
			echo $row['jine']."\t";
			echo $row['rmb']."\t";
			echo $you['usertel']."\t";
			echo $you['bankname']."\t";
			echo $you['bankusername']."\t";
			echo $you['bankcard']."\t";
			echo $you['bankaddress']."\t";
			
	        echo $row['date']."\t\n";
			
	
		}
}elseif($_GET['table']=='tixian'){//提现表 未发
		    $str="会员编号\t会员姓名\t提现金额\t实发金额\t开户银行\t开户账号\t开户姓名\t开户地址\t提现时间\t状态\t\n";
		    echo $str;
		    $sql="select * from tixian where isgrant=0 order by tdate desc";
		
		    $rs=mysql_query($sql);
		    while($row=mysql_fetch_assoc($rs)){
		        echo $row['nickname']."\t";
		        echo $row['username']."\t";
		        // echo $row['usertel']."\t";
		        echo $row['num']."\t";
		        // echo $row['shui']."\t";
		        // echo $row['shui1']."\t";
		       
		        echo ($row['num']-$row['shui']-$row['shui1']-$row['shui2'])."\t";
		
		       
		        echo $row['bankname']."\t";
		
		        echo $row['bankcard']."\t";
		        echo $row['bankusername']."\t";
		        echo $row['bankaddress']."\t";
		        echo $row['tdate']."\t";
		
		            echo "未发放\t\n";
		      
              }

}elseif($_GET['table']=='tixian1'){//提现表 已发
	$str="会员编号\t会员姓名\t提现金额\t实发金额\t开户银行\t开户姓名\t开户帐号\t开户地址\t提现时间\t审核状态\t\n";
	echo $str;
	$sql="select * from tixian where isgrant=1 order by tdate desc";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_assoc($rs)){
		echo $row['nickname']."\t";
		echo $row['username']."\t";
		// echo $row['usertel']."\t";
		echo $row['num']."\t";
		// echo $row['shui']."\t";
		// echo $row['shui1']."\t";
		 
		echo ($row['num']-$row['shui']-$row['shui1']-$row['shui2'])."\t";
		
		echo $row['bankname']."\t";
		echo $row['bankusername']."\t";
		echo $row['bankcard']."\t";
		echo $row['bankaddress']."\t";
		echo $row['tdate']."\t";

			echo "已发放\t\n";
	
		
	}
}elseif($_GET['table']=='tixian2'){//提现表 已发
	$str="会员编号\t会员姓名\t提现金额\t实发金额\t开户银行\t开户姓名\t开户帐号\t开户地址\t提现时间\t审核状态\t\n";
	echo $str;
	$sql="select * from tixian where isgrant=2 order by tdate desc";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_assoc($rs)){
		echo $row['nickname']."\t";
		echo $row['username']."\t";
		// echo $row['usertel']."\t";
		echo $row['num']."\t";
		// echo $row['shui']."\t";
		// echo $row['shui1']."\t";
		 
		echo ($row['num']-$row['shui']-$row['shui1']-$row['shui2'])."\t";
		
		echo $row['bankname']."\t";
		echo $row['bankusername']."\t";
		echo $row['bankcard']."\t";
		echo $row['bankaddress']."\t";
		echo $row['tdate']."\t";

			echo "已退回\t\n";
	
		
	}
}elseif($_GET['table']=='chongzhi'){//充值表
	$str="会员编号\t会员姓名\t申请金额\t充值时间\t申请类型\t审核状态\t\n";
	echo $str;
	$sql="select * from chongzhi where  isgrant=0 order by cdate desc";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_assoc($rs)){
		echo $row['nickname']."\t";
		echo $row['username']."\t";
		echo $row['jine']."\t";
		echo $row['cdate']."\t";

		// echo $row['tel']."\t";
	    if ($row['lx']==1){
			echo "A积分\t";
		}elseif ($row['lx']==3){
			echo "现金\t";
		}elseif ($row['lx']==4){
			echo "激活币\t";
		}
		 
		// if ($row['hklx']==1){
		//     echo "微信\t";
		// }elseif ($row['hklx']==2){
		//     echo "支付宝\t";
		// }elseif ($row['hklx']==3){
		//     echo "银行卡\t";
		// }
		
		
		// echo $row['beizhu']."\t";
		if ($row['isgrant']==1){
			echo "已发放\t\n";
		}else{
			echo "未发放\t\n";
		}
	
	}
}elseif($_GET['table']=='chongzhi2'){//充值表
	    $str="会员编号\t会员姓名\t申请金额\t充值时间\t申请类型\t审核状态\t\n";
	    echo $str;
	    $sql="select * from chongzhi where isgrant=1 order by cdate desc";
	    $rs=mysql_query($sql);
	    while($row=mysql_fetch_assoc($rs)){
			echo $row['nickname']."\t";
			echo $row['username']."\t";
			echo $row['jine']."\t";
			echo $row['cdate']."\t";
	
			// echo $row['tel']."\t";
			if ($row['lx']==1){
				echo "A积分\t";
			}elseif ($row['lx']==3){
				echo "现金\t";
			}elseif ($row['lx']==4){
				echo "激活币\t";
			}
			 
			// if ($row['hklx']==1){
			// 	echo "微信\t";
			// }elseif ($row['hklx']==2){
			// 	echo "支付宝\t";
			// }elseif ($row['hklx']==3){
			// 	echo "银行卡\t";
			// }
	        if ($row['isgrant']==1){
	            echo "已发放\t\n";
	        }else{
	            echo "未发放\t\n";
	        }
	
	    }
}elseif($_GET['table']=='chongzhi22'){//汇款表
		$str="会员编号\t会员姓名\t联系电话\t汇款金额\t人民币\t汇款时间\t备注\t审核状态\t\n";
		echo $str;
		$sql="select * from chongzhi where  lx=2";
		$rs=mysql_query($sql);
		while($row=mysql_fetch_assoc($rs)){
			echo $row['nickname']."\t";
			echo $row['username']."\t";
			echo $row['tel']."\t";
			echo $row['jine']."\t";
			echo $row['mey']."\t";
			echo $row['cdate']."\t";
			echo $row['beizhu']."\t";
			if ($row['isgrant']==1){
				echo "已确认\t\n";
			}else{
				echo "未确认\t\n";
			}
	
		}
}elseif($_GET['table']=='gqdh'){//原始股权兑换
		$str="会员编号\t会员姓名\t兑换数量\t兑换时间\t审核状态\t\n";
		echo $str;
		$sql="select * from gqdh";
		$rs=mysql_query($sql);
		while($row=mysql_fetch_assoc($rs)){
			echo $row['nickname']."\t";
			echo $row['username']."\t";
			
			echo $row['jine']."\t";
			echo $row['tdate']."\t";
			
			if ($row['lx']==1){
				echo "已确认\t\n";
			}else{
				echo "未确认\t\n";
			}
	
		}
}elseif($_GET['table']=='huikuan'){//汇款
$str="会员编号\t会员姓名\t汇款银行\t账户姓名\t汇款账户\t汇款金额\t汇款时间\t汇款说明\t记录时间\t服务中心\t汇款确认\t\n";
	echo $str;
	$sql="select * from huikuan";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_assoc($rs)){
		echo $row['nickname']."\t";
		echo $row['username']."\t";
		echo $row['bankname']."\t";
		echo $row['bankusername']."\t";
		echo $row['bankcard']."\t";
		echo $row['jine']."\t";
		echo $row['sdate']."\t";
		echo $row['shuoming']."\t";
		echo $row['hdate']."\t";
		echo $row['snickname']."\t";
		if ($row['isgrant']==1){
			echo $row['bankaddress']."已确认\t\n";
		}else{ 
			echo "未确认\t\n";
		}
		
	}
}elseif($_GET['table']=='zhuanzhang'){
	$str="转出会员编号\t转出会员姓名\t转入会员编号\t转入会员姓名\t转账金额\t转账类型\t转账时间\t\n";
	echo $str;
	$sql="select * from zhuanzhang order by zdate desc";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_assoc($rs)){
		echo $row['nickname']."\t";
		echo $row['username']."\t";
		echo $row['snickname']."\t";
		echo $row['susername']."\t";
		echo $row['jine']."\t";
		if($row['lx']==0){
			echo "现金\t";
		}elseif($row['lx']==1){
			echo "积分\t";
		}elseif($row['lx']==2){
			echo "库存\t";
		}
		echo $row['zdate']."\t\n";
	}
}elseif($_GET['table']=='zhuanhuan'){
	$str="会员编号\t会员姓名\t转换金额\t申请类型\t转换时间\t\n";
	echo $str;
	$sql="select * from zhuanhuan";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_assoc($rs)){
		echo $row['nickname']."\t";
		echo $row['username']."\t";
		echo $row['jine']."\t";
	if($row['lx']==1){
			echo "奖金转现金\t";
		}elseif($row['lx']==2){
			echo "奖金转积分\t";
		}elseif($row['lx']==3){
			echo "现金转复投积分\t";
		}
		echo $row['zdate']."\t\n";
		
		
	}
}elseif($_GET['table']=="member"){
	$str="会员编号\t会员姓名\t会员级别\t职称级别\t注册金额\t推荐人\t身份证号\t电话\t累计业绩\t经销商考核业绩\t职称考核业绩\t累计C积分\t剩余A积分\t剩余B积分\t剩余C积分\t激活时间\t是否锁定\t\n";
	echo $str;
    $sql="select * from member where ispay=1";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_assoc($rs)){
	    $ul=ulevel($row['ulevel']);
            $zj=zjulevel($row['zjulevel']);
		echo $row['userid']."\t";
		echo $row['username']."\t";
		echo $ul['lvname']."\t";
                echo $zj['zjname']."\t";
                echo $row['lsk']."\t";
                echo $row['rname']."\t";
		echo $row['usercard']."\t";
                echo $row['usertel']."\t";
                echo $row['area1']."\t";
		echo $row['yarea1']."\t";
                echo $row['yarea2']."\t";
		echo $row['maxmey']."\t";
		echo $row['zsq']."\t";
		echo $row['cfxf']."\t";
		echo $row['mey']."\t";
		echo $row['pdt']."\t";
		
		if($row['islock']==1){
		    echo "已锁定\t\n";
		}else{
		    echo "未锁定\t\n";
		
		}
		
	}
}elseif($_GET['table']=="member1"){//发货清单  未发货
	$str="未发货\t\n";
	echo $str;
	$str="会员编号\t会员姓名\t会员资格\t注册金额\t联系电话\t身份证\t详细收货地址\t注册时间\t激活时间\t是否锁定\t\n";
	echo $str;
	$sql="select * from member where ispay>0 and cy=0";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_assoc($rs)){
	    $ul=ulevel($row['ulevel']);
		echo $row['userid']."\t";
		echo $row['username']."\t";
		echo $ul['lvname']."\t";
		echo $row['lsk']."\t";
		echo $row['usertel']."\t";
	    echo $row['usercard']."\t";
	    echo $row['useraddress']."\t";
		
		echo $row['rdt']."\t";
		echo $row['pdt']."\t";
		if($row['islock']==1){
		    echo "已锁定\t\n";
		}else{
		    echo "未锁定\t\n";
		
		}
		
	}
}elseif($_GET['table']=="member2"){//发货清单 未发货
		$str="已发货\t\n";
		echo $str;
		$str="会员编号\t会员姓名\t会员资格\t注册金额\t联系电话\t身份证\t详细收货地址\t注册时间\t激活时间\t是否锁定\t\n";
		echo $str;
		$sql="select * from member where ispay>0 and cy=1";
		$rs=mysql_query($sql);
		while($row=mysql_fetch_assoc($rs)){
			$ul=ulevel($row['ulevel']);
			echo $row['userid']."\t";
			echo $row['username']."\t";
			echo $ul['lvname']."\t";
			echo $row['lsk']."\t";
			echo $row['usertel']."\t";
			echo $row['usercard']."\t";
			echo $row['useraddress']."\t";
	
			echo $row['rdt']."\t";
			echo $row['pdt']."\t";
			if($row['islock']==1){
				echo "已锁定\t\n";
			}else{
				echo "未锁定\t\n";
	
			}
	
		}
}elseif($_GET['table']=="orders"){
		        $str="订单编号\t订单类型\t付款方式\t物流公司\t物流编号\t会员编号\t收货人姓名\t联系电话\t联系地址\t商品名称\t单价\t总价\t数量\t订单时间\t发货时间\t提售\t状态\t\n";
		        echo $str;
		        $sql="select * from orders2 where issend=0 and bid=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." ";
//and date>='".$_SESSION['TimeStart']."' and date<='".$_SESSION['TimeEnd']."'
		        $rs=mysql_query($sql);
		        while($row=mysql_fetch_assoc($rs)){
		            echo $row['ordersnumber']."\t";
                                if($row['lx']==1){
                                        echo "报单商品\t";
                                }elseif($row['lx']==2){
                                        echo "重消商品\t";
                                }
                                if($row['ljlc']==1){
                                        echo "奖金\t";
                                }elseif($row['ljlc']==2){
                                        echo "积分\t";
                                }elseif($row['ljlc']==3){
                                        echo "报单\t";
                                }        

		            echo $row['logistics']."\t";
		            echo $row['logisticsno']."\t";

		           
		            echo $row['userid']."\t";
		            echo $row['username']."\t";
		            echo $row['usertel']."\t";
		            echo $row['useraddress']."\t";
                            echo $row['goodname']."\t";				
		            echo $row['price']."\t";					
		            echo $row['jine']."\t";
		            echo $row['num']."\t";
		            echo $row['date']."\t";
		            echo $row['sdate']."\t";
                            if($row['gs']==0){
                                    echo "自提\t";
                            }elseif($row['gs']==1){
                                    echo "待挂售\t";
                            }elseif($row['gs']==3){
                                    echo "已售出\t";
                            }elseif($row['gs']==4){
                                    echo "待选售\t";
                            }     
		            echo "未发货\t\n";
		            



		        }
}elseif($_GET['table']=="orders2"){
    $str="订单编号\t订单类型\t付款方式\t物流公司\t物流编号\t会员编号\t收货人姓名\t联系电话\t联系地址\t商品名称\t单价\t总价\t数量\t订单时间\t发货时间\t提售\t状态\t\n";
    echo $str;
    $sql="select * from orders2 where issend=1 and bid=0 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
    //and date>='".$_SESSION['TimeStart']."' and date<='".$_SESSION['TimeEnd']."'
    $rs=mysql_query($sql);
    while($row=mysql_fetch_assoc($rs)){
		echo $row['ordersnumber']."\t";
		if($row['lx']==1){
                        echo "报单商品\t";
                }elseif($row['lx']==2){
                        echo "重消商品\t";
                }
                if($row['ljlc']==1){
                        echo "奖金\t";
                }elseif($row['ljlc']==2){
                        echo "积分\t";
                }elseif($row['ljlc']==3){
                        echo "报单\t";
                }        

            echo $row['logistics']."\t";
            echo $row['logisticsno']."\t";


            echo $row['userid']."\t";
            echo $row['username']."\t";
            echo $row['usertel']."\t";
            echo $row['useraddress']."\t";
            echo $row['goodname']."\t";				
            echo $row['price']."\t";					
            echo $row['jine']."\t";
            echo $row['num']."\t";
            echo $row['date']."\t";
            echo $row['sdate']."\t";
            if($row['gs']==0){
                    echo "自提\t";
            }elseif($row['gs']==1){
                    echo "待挂售\t";
            }elseif($row['gs']==3){
                    echo "已售出\t";
            }elseif($row['gs']==4){
                    echo "待选售\t";
            }         
            echo "已发货\t\n";




    }
 
}elseif($_GET['table']=="daoru"){
    $str="订单编号\t订单类型\t物流公司\t物流编号\t会员编号\t会员姓名\t联系电话\t联系地址\t订单金额\t订单时间\t状态\t商品详情\t\n";
    echo $str;
    $sql="SELECT * from inorders ORDER BY id";
    $rs=mysql_query($sql);
    while($row=mysql_fetch_assoc($rs)){
        echo $row['ordersnumber']."\t";
        echo $row['lx']."\t";
        echo $row['logistics']."\t";
        echo $row['logisticsno']."\t";
        echo "\t";
        echo "\t";
        echo "\t";
        echo "\t";
        echo "\t";
        echo "\t";
        echo "未发货\t";
        echo "\t\n";
    }
}elseif($_GET['table']=="sellbuy"){
	$str="订单号\t卖家编号\t买家编号\t出售数量\t预售价格\t手续费\t卖出时间\t交易时间\t状态\t\n";
	echo $str;
	$sql="SELECT * from sellbuy ORDER BY id ASC";
	$rs=mysql_query($sql);
	while($row=mysql_fetch_assoc($rs)){
		echo $row['ordersnumber']."\t";
		echo $row['sellnickname']."\t";
		echo $row['buynickname']."\t";
		echo $row['price1']."\t";
		echo $row['price2']."\t";
		echo $row['shouxu']."\t";
		echo $row['bdate']."\t";
		echo $row['sdate']."\t";
		if($row['lx']==3){
			echo "交易完成\t\n";
		}else{
			echo "未交易完成\t\n";
		}
	}
}elseif($_GET['table']=="week"){
	$str="会员编号\t会员姓名\t层碰奖\t量碰奖\t报单费\t区域绑定\t推荐代理奖\t重复消费\t实际发放\t\n";
	echo $str;
	$sql = "SELECT * FROM `member` as m right join (select sum(b1) as b1, sum(b2) as b2, sum(b3) as b3, sum(b4) as b4, sum(b5) as b5,sum(b6) as b6,sum(b0) as b0, uid ,bdate from bonus where date_format(bdate,'%Y-%v')='{$_GET['time']}' group by uid) as b on m.id=b.uid WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
	$rs=getAll($sql);
	foreach($rs as $row){
		echo $row['nickname']."\t";
		echo $row['username']."\t";
		echo $row['b1']."\t";
		echo $row['b2']."\t";
		echo $row['b3']."\t";
		echo $row['b4']."\t";
		echo $row['b5']."\t";
		echo $row['b6']."\t";
		echo $row['b0']."\t\n";
	}
}





?>