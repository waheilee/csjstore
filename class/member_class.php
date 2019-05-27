<?php
include_once("../function.php");
include_once("member_class.php");
include_once("bonus_class.php");
include_once("system_class.php");
set_time_limit(0);
class member_class{
	//激活会员
	function jihuomember($id,$lsk){
		$_bonus_cl=new bonus_class();
		$us=getMemberbyID($id);
		if ($us['ispay']==0){
			$us_update['ispay']=1;
			$us_update['pdt']=now();
			edit_update_cl('member',$us_update,$us['id']);
			
                        if($us['reid']!=0){
                            $reman=getMemberbyID($us['reid']);
                            $reman_update['recount']=$reman['recount']+1;
                            $reman_update['reyeji']=$reman['reyeji']+$lsk;
                            edit_update_cl('member',$reman_update,$reman['id']);  
                        }
                        $this->addArea($us['id'],$lsk);//加业绩
            			$_systemyeji=new system_class();
            			$_systemyeji->yejitongji(1,0,$lsk,0,0,0,0);  //计算波比
            			$_sys=$_systemyeji->system_information(1);
            			$_update_system['yeji']=$_sys['yeji']+$lsk;
            			$_update_system['fanli']=$_sys['fanli']+$lsk;//总业绩
                        $_update_system['fanli1']=$_sys['fanli1']+$lsk;//报单产品业绩
            			$_systemyeji->system_update($_update_system);
                        
//                         $_bonus_cl->fx();
//                         $_bonus_cl->b1bonus($us['id'],$lsk);//直推
//                         $_bonus_cl->b3bonus($us['id'],$lsk);//报单
//                         $_bonus_cl->b4bonus($us['id'],$lsk);
//                         $_bonus_cl->b5bonus($us['id'],$lsk);
//                        $_bonus_cl->zjulevel($us['id']);//升级
// 			$_bonus_cl->b0bonus();//结算
                        
			
            //发送短信
//		    if(preg_match("/^1[3|4|5|7|8][0-9]\d{4,8}$/",$us['usertel'])){
//                $this->sendmessage($us['userid'],$us['pass1'],$us['pass2'],$us['usertel']);
//            }

		}
	}
        function jihuomember2($id){
            $this->csdagongpai($id);
		$_bonus_cl=new bonus_class();
		$us=getMemberbyID($id);
		if ($us['ispay']==0){
			$lsk=$us['lsk'];
			$us_update['ispay']=1;
			$us_update['pdt']=now();
                        $level=ulevel2($us['ulevel']);
                        $cfxf=$level['yl1'];
                        $us_update['cfxf']=$cfxf;
			edit_update_cl('member',$us_update,$us['id']);
                        if($us['reid']!=0){
                            $reman=getMemberbyID($us['reid']);
                            $reman_update['recount']=$reman['recount']+1;
                            $reman_update['reyeji']=$reman['reyeji']+$lsk;
                            edit_update_cl('member',$reman_update,$reman['id']);  
                        }
			$this->addArea3($id,$lsk);//加业绩
			
			$_systemyeji=new system_class();
			$_systemyeji->yejitongji(1,0,$lsk,0,0,0,0);  //计算波比
			$_sys=$_systemyeji->system_information(1);
			$_update_system['yeji']=$_sys['yeji']+$lsk;
			$_update_system['fanli']=$_sys['fanli']+$lsk;//总业绩
                        
			$_systemyeji->system_update($_update_system);
			$_bonus_cl->b1bonus($id,$lsk,0);//直推奖
			$_bonus_cl->b2bonus();//对碰奖
			$_bonus_cl->b3bonus($id,$lsk,0);//见点奖
                        $_bonus_cl->b5bonus($id);//报单费
			$_bonus_cl->b0bonus();//结算
			
            //发送短信
//		    if(preg_match("/^1[3|4|5|7|8][0-9]\d{4,8}$/",$us['usertel'])){
//                $this->sendmessage($us['userid'],$us['pass1'],$us['pass2'],$us['usertel']);
//            }

		}
	}
//	function jihuomember2($id){
//	    $this->csdagongpai($id);
//	    $_bonus_cl=new bonus_class();
//	    $sys=getOne("select * from systemparameters where id=1 ");
//	    $us=getMemberbyID($id);
//	    if ($us['ispay']==0){
//	        	
//	        $sql2="select * from ulevel where ulevel=".$us['ulevel']."";
//	        $level=getOne($sql2);
//	        	
//	        $us_update['ispay']=1;
//	        $us_update['dan']=$level['dan'];
//	        $us_update['pdt']=now();
//	        edit_update_cl('member',$us_update,$us['id']);
//	        	
//	        $reman=getMemberbyID($us['reid']);
//	        $reman_update['recount']=$reman['recount']+1;
//	        $reman_update['reyeji']=$reman['reyeji']+$us['lsk'];
//	        	
//	        edit_update_cl('member',$reman_update,$reman['id']);
//	
//	        $this->addArea($us['id'],$level['dan']);//加业绩，按单计算
//	        //$this->addAreacx($us['id']);//加业绩，按单计算  重消
//	        	
//	        $_systemyeji=new system_class();
//	        $_systemyeji->yejitongji(1,0,$us['lsk'],0,0,0,0);  //计算波比
//	        $_sys=$_systemyeji->system_information(1);
//	        $_update_system['yeji']=$_sys['yeji']+$us['lsk'];
//	        $_update_system['fanli']=$_sys['fanli']+$us['lsk'];
//	        $_systemyeji->system_update($_update_system);
//	
//	        $_bonus_cl->cengpeng($us['id']);//层碰
//	        $_bonus_cl->b2bonus();//对碰
//	        	
//	        $_bonus_cl->zjulevel($us['id']);//职称升级
//	        	
//	        $_bonus_cl->dianbu($us['id'], $level['dan']);
//	        $_bonus_cl->b0bonus();
//	        //发送短信
//	        //		    if(preg_match("/^1[3|4|5|7|8][0-9]\d{4,8}$/",$us['usertel'])){
//	        //                $this->sendmessage($us['userid'],$us['pass1'],$us['pass2'],$us['usertel']);
//	        //            }
//	
//	    }
//	}
	function csdagongpai($uid){
	    //$sql="select * from `member` where  (chl=0 or chr=0 or chy=0) and ispay>0 order by plevel,pdt limit 0,1";
	    $sql="select * from `member` where  (chl=0 or chr=0) and ispay>0 order by plevel,id limit 0,1";
	    if($query = mysql_query($sql)){
	        while ($row=mysql_fetch_array($query)){
	            $member_update=NULL;
	            if($row['chl']==0){
	                $treeplace=1;
	                edit_sql("update `member` set chl=".$uid." where id=".$row['id']."");
	            }elseif($row['chr']==0){
	                $treeplace=2;
	                edit_sql("update `member` set chr=".$uid." where id=".$row['id']."");
	            }
	            // 	            }elseif($row['chy']==0){
	            // 	                $treeplace=3;
	            // 	                edit_sql("update `member` set chy=".$uid." where id=".$row['id']."");
	            // 	            }
	            $member_update['treeplace']=$treeplace;
	            $member_update['fatherid']=$row['id'];
	            $member_update['reid']=$row['id'];
	            $member_update['rname']=$row['nickname'];
	            $member_update['fathername']=$row['nickname'];
	            $member_update['plevel']=$row['plevel']+1;
	            $member_update['ppath']="".$row['ppath'].$row['id'].",";
	            edit_update_cl("member",$member_update,$uid);
	        }
	    }
	}
	//短信接口
	function sendmessage($useranme,$pass1,$pass2,$phone){
	
	    $system_cl=new system_class();
	    $_system=$system_cl->system_information(1);
	    if($_system['dbl10']>0){
	        //$url='http://sms.webchinese.cn/web_api/?Uid=rongzong&Key=d8c9979dcd819ff84c90&smsMob=13188831233&smsText=验证码：8888';
	        $url="http://utf8.api.smschinese.cn/?Uid=".$_system['duanxinzhanghao']."&Key=".$_system['duanxinmima']."&smsMob=$phone&smsText=恭喜您成为鸿德国际VIP，会员编号$useranme,初始密码$pass1,交易密码$pass2,www.hdjkcy.com,请尽快修改密码完善资料";
	        //                    http://utf8.api.smschinese.cn/?Uid=本站用户名&Key=接口安全秘钥&smsMob=手机号码&smsText=验证码:8888【".$_system['duanxinqianming']."】
	
	        //
	        //                        if(function_exists('file_get_contents'))
	            //                        {
	            //                            $file_contents = file_get_contents($url);
	            //                        }
	        //                        else
	            //                        {
	        $ch = curl_init();
	        $timeout = 5;
	        curl_setopt ($ch, CURLOPT_URL, $url);
	        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	        $file_contents = curl_exec($ch);
	        curl_close($ch);
	        //                        }
	        //            var_dump($file_contents);exit;
	        return $file_contents;
	    }
	}
	function dongjie($id){
		edit_sql("update `member` set islock=1 where id=".$id."");
	}
	function jiedong($id){
		edit_sql("update `member` set islock=0 where id=".$id."");
	}
	function disfh($id){
	    edit_sql("update `member` set isfh=1 where id=".$id."");
	}
	function isfh($id){
	    edit_sql("update `member` set isfh=0 where id=".$id."");
	}
	//检查会员编号是否存在
function checkUserID($UserID){
	$sql="select * from `member` where userid='".$UserID."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//检查会员编号是否存在
function checkNickName($NickName){
	$sql = "SELECT * FROM `member` WHERE nickname='".$NickName."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//检查会员编号是否存在并激活
function checkNickNameispay($NickName){
	$sql = "SELECT * FROM `member` WHERE nickname='".$NickName."' and isPay>0";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//会员登录验证
function checkLogin($NickName,$PassWord){
	$sql="select * from `Member` where nickname='".$NickName."' AND password1='".$PassWord."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//会员交易密码验证
function checkPassword2($NickName,$PassWord2){
	$sql="select * from `Member` where nickname='".$NickName."' AND password2='".$PassWord2."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//会员三级密码验证
function checkPassword3($NickName,$PassWord3){
	$sql="select * from `Member` where nickname='".$NickName."' AND password3='".$PassWord3."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//密码问题验证
function checkQuestion($NickName,$passanswer){
	$sql="select * from `Member` where nickname='".$NickName."' AND passanswer='".$passanswer."'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;	
	}
}
//根据ID获取会员信息
function getMemberbyID($_id){
	$sql = "SELECT * FROM `member` WHERE id=".$_id;
	$query=mysql_query($sql);
	return mysql_fetch_array($query);
}
//根据昵称获取会员信息
function getMemberbyUserId($UserId){
	$sql = "SELECT * FROM `member` where userid='".$UserId."'";
	$query=mysql_query($sql);
	return mysql_fetch_array($query);
}
//根据昵称获取会员信息
function getMemberbyNickName($NickName){
	$sql = "SELECT * FROM `member` where nickname='".$NickName."'";
	$query=mysql_query($sql);
	return mysql_fetch_array($query);
}
//检查该位置是否有人
function checkFatherMan($FatherID,$TreePlace){
	$sql = "SELECT * FROM `member` WHERE fatherid=".$FatherID." AND treeplace=".$TreePlace."";
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;
	}
}
//获得安置位置的人的信息
function getFatherManbyFidAndTreeplace($FatherID,$TreePlace){
	$sql = "SELECT * FROM `member` WHERE fatherid=".$FatherID." AND treeplace=".$TreePlace."";
	$query = mysql_query($sql);
	return mysql_fetch_array($query);
}

//查询该编号推荐的人的集合
function getMemberListByreid($reid){
	$sql = "SELECT * FROM `member` WHERE reid=".$reid."";
	$query = mysql_query($sql);
	return mysql_fetch_array($query);
}

/*判断id的团队中是否有uid
*return true在团队中,false不在
*/
function checkisppath($id,$uid){
	$re=getMemberbyID($uid);
	return ereg(",".$id.",",$re['ppath']);
}
/*判断id的团队中是否有nickname
*return true在团队中,false不在
*/
function checkisrepath($id,$nickname){
	$re=getMemberbyNickName($nickname);
	return ereg(",".$id.",",$re['repath']);
}

//判断是否有新邮件
function checknewmail($_id){
	$sql = "SELECT * FROM `mail` WHERE isread=0 and sid=".$_id;
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return true;
	}else{
		return false;
	}
}

function checkfman($_id){
	$sql = "SELECT * FROM `member` WHERE fatherid=".$_id."";
	$query = mysql_query($sql);
	if(mysql_num_rows($query) >= 1){
		return false;
	}else{
		return true;
	}	
}

function getMaxPid(){
	$sql="select id from `member` where pcount<10 and ispay>0 order by pdt,id limit 0,1";
	$query = mysql_query($sql);
	$pid=mysql_fetch_array($query);
	return $pid[0];
}

//写入激活记录
function addbdrecord($us,$lsk){
	$bdrecord=NULL;
	$bdrecord['uid']=$us['id'];
	$bdrecord['nickname']=$us['nickname'];
	$bdrecord['lsk']=$lsk;
	$bdrecord['bdid']=$us['reid'];
	$bdrecord['bdname']=$us['rname'];
	$bdrecord['bddate']=now();
	add_insert_cl('bdrecord',$bdrecord);
}

function addbwang(){
	$_bonus_cl=new bonus_class();
	$sql="select * from `member` where maxmey>=26000 and isb=0";
	if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$sql2="select * from `member` where (chl2=0 or chr2=0) and isb=1 order by plevel,pdt limit 0,1";
			if($query2 = mysql_query($sql2)){
				while ($row2=mysql_fetch_array($query2)){
					if($row2['chl2']==0){
						$treeplace2=1;
						edit_sql("update `member` set chl2=".$row['id']." where id=".$row2['id']."");
					}elseif($row2['chr2']==0){
						$treeplace2=2;
						edit_sql("update `member` set chr2=".$row['id']." where id=".$row2['id']."");	
					}
					$member_update['treeplace2']=$treeplace2;
					$member_update['fatherid2']=$row2['id'];
					$member_update['fathername2']=$row2['nickname'];
					$member_update['plevel2']=$row2['plevel2']+1;
					$member_update['ppath2']="".$row2['ppath2'].$row2['id'].",";
//					$member_update['cfxf']=$row['cfxf']-1000;
					$member_update['isb']=1;
					$member_update['pdt2']=now();
					edit_update_cl("member",$member_update,$row['id']);
					$_bonus_cl->b4bonus($row['id'], $row['nickname'], $row['lsk']);
				}
			}
		}
	}
}

function dagongpai($uid){
	$sql="select * from `member` where (ppath like '%,".$reid.",%' or id=".$reid.") and (chl=0 or chr=0) and ispay>0 order by plevel,pdt limit 0,1";
	if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
			$member_update=NULL;
			if($row['chl']==0){
				$treeplace=1;
				edit_sql("update `member` set chl=".$uid." where id=".$row['id']."");
			}elseif($row['chr']==0){
				$treeplace=2;
				edit_sql("update `member` set chr=".$uid." where id=".$row['id']."");	
			}
			$member_update['treeplace']=$treeplace;
			$member_update['fatherid']=$row['id'];
			$member_update['fathername']=$row['nickname'];
			$member_update['plevel']=$row['plevel']+1;
			$member_update['ppath']="".$row['ppath'].$row['id'].",";
			edit_update_cl("member",$member_update,$uid);
		}
	}
}

function xiaogongpai($nickname,$reid){
	$us=getOne("select id from member where nickname='".$nickname."'");
	
	$uid=$us['id'];
	//zuo代表节点人的人数（防止下面有未激活的会员，重复方点
	$sql="select * from `member` where (ppath like '%,".$reid.",%' or id=".$reid.") and (chl=0 or chr=0) and ispay>0 and zuo<2 order by plevel,pdt limit 0,1";
// 	echo $sql;
	if($query = mysql_query($sql)){
		if ($row=mysql_fetch_array($query)){
			$member_update=NULL;
			if($row['chl']==0){
				$treeplace=1;
				edit_sql("update `member` set chl=".$uid.",zuo=zuo+1 where id=".$row['id']."");
			}elseif($row['chr']==0){
				$treeplace=2;
				edit_sql("update `member` set chr=".$uid.",zuo=zuo+1 where id=".$row['id']."");	
			}
			$member_update['treeplace']=$treeplace;
			$member_update['fatherid']=$row['id'];
			$member_update['fathername']=$row['nickname'];
			$member_update['plevel']=$row['plevel']+1;
			$member_update['ppath']="".$row['ppath'].$row['id'].",";
			edit_update_cl("member",$member_update,$uid);
		}else {
			edit_sql("delete from `member`  where id=".$uid."");
		alert("维护中，请稍后注册！");
	}
	}
}

function paixiaoqu($uid,$reid){
	$reus=getMemberbyID($reid);
	if ($reus['ispay']==1){
		if($reus['area1']>$reus['area2']){
			if (checkFatherMan($reid,2)){
				$rus=getFatherManbyFidAndTreeplace($reid,2);
				$sql="select * from `member` where (ppath like '%,".$rus['id'].",%' or id=".$rus['id'].") and (chl=0 or chr=0) and ispay>0 order by plevel desc limit 0,1";
				if($query = mysql_query($sql)){
					while ($row=mysql_fetch_array($query)){
						$member_update=NULL;
						if($row['chl']==0){
							$treeplace=1;
							edit_sql("update `member` set chl=".$uid." where id=".$row['id']."");
						}elseif($row['chr']==0){
							$treeplace=2;
							edit_sql("update `member` set chr=".$uid." where id=".$row['id']."");	
						}
						$member_update['treeplace']=$treeplace;
						$member_update['fatherid']=$row['id'];
						$member_update['fathername']=$row['nickname'];
						$member_update['plevel']=$row['plevel']+1;
						$member_update['ppath']="".$row['ppath'].$row['id'].",";
						edit_update_cl("member",$member_update,$uid);
					}
				}
			}else{
				$member_update['treeplace']=2;
				$member_update['fatherid']=$reus['id'];
				$member_update['fathername']=$reus['nickname'];
				$member_update['plevel']=$reus['plevel']+1;
				$member_update['ppath']="".$reus['ppath'].$reus['id'].",";
				edit_update_cl("member",$member_update,$uid);
			}
		}else{
			if (checkFatherMan($reid,1)){
				$lus=getFatherManbyFidAndTreeplace($reid,1);
				$sql="select * from `member` where (ppath like '%,".$lus['id'].",%' or id=".$lus['id'].") and (chl=0 or chr=0) and ispay>0 order by plevel desc limit 0,1";
				if($query = mysql_query($sql)){
					while ($row=mysql_fetch_array($query)){
						$member_update=NULL;
						if($row['chl']==0){
							$treeplace=1;
							edit_sql("update `member` set chl=".$uid." where id=".$row['id']."");
						}elseif($row['chr']==0){
							$treeplace=2;
							edit_sql("update `member` set chr=".$uid." where id=".$row['id']."");	
						}
						$member_update['treeplace']=$treeplace;
						$member_update['fatherid']=$row['id'];
						$member_update['fathername']=$row['nickname'];
						$member_update['plevel']=$row['plevel']+1;
						$member_update['ppath']="".$row['ppath'].$row['id'].",";
						edit_update_cl("member",$member_update,$uid);
					}
				}
			}else{
				$member_update['treeplace']=1;
				$member_update['fatherid']=$reus['id'];
				$member_update['fathername']=$reus['nickname'];
				$member_update['plevel']=$reus['plevel']+1;
				$member_update['ppath']="".$reus['ppath'].$reus['id'].",";
				edit_update_cl("member",$member_update,$uid);
			}	
		}
	}else{
		$sql="select * from `member` where id in(0".$reus['repath']."0) and ispay=1 order by relevel desc limit 0,1";
		if($query = mysql_query($sql)){
			while ($row=mysql_fetch_array($query)){
				$reus=NULL;
				$reus=$row;		
			}
		}
		if($reus['area1']>$reus['area2']){
			if (checkFatherMan($reid,2)){
				$rus=getFatherManbyFidAndTreeplace($reid,2);
				$sql="select * from `member` where (ppath like '%,".$rus['id'].",%' or id=".$rus['id'].") and (chl=0 or chr=0) and ispay>0 order by plevel desc limit 0,1";
				if($query = mysql_query($sql)){
					while ($row=mysql_fetch_array($query)){
						$member_update=NULL;
						if($row['chl']==0){
							$treeplace=1;
							edit_sql("update `member` set chl=".$uid." where id=".$row['id']."");
						}elseif($row['chr']==0){
							$treeplace=2;
							edit_sql("update `member` set chr=".$uid." where id=".$row['id']."");	
						}
						$member_update['treeplace']=$treeplace;
						$member_update['fatherid']=$row['id'];
						$member_update['fathername']=$row['nickname'];
						$member_update['plevel']=$row['plevel']+1;
						$member_update['ppath']="".$row['ppath'].$row['id'].",";
						edit_update_cl("member",$member_update,$uid);
					}
				}
			}else{
				$member_update['treeplace']=2;
				$member_update['fatherid']=$reus['id'];
				$member_update['fathername']=$reus['nickname'];
				$member_update['plevel']=$reus['plevel']+1;
				$member_update['ppath']="".$reus['ppath'].$reus['id'].",";
				edit_update_cl("member",$member_update,$uid);
			}
		}else{
			if (checkFatherMan($reid,1)){
				$lus=getFatherManbyFidAndTreeplace($reid,1);
				$sql="select * from `member` where (ppath like '%,".$lus['id'].",%' or id=".$lus['id'].") and (chl=0 or chr=0) and ispay>0 order by plevel desc limit 0,1";
				if($query = mysql_query($sql)){
					while ($row=mysql_fetch_array($query)){
						$member_update=NULL;
						if($row['chl']==0){
							$treeplace=1;
							edit_sql("update `member` set chl=".$uid." where id=".$row['id']."");
						}elseif($row['chr']==0){
							$treeplace=2;
							edit_sql("update `member` set chr=".$uid." where id=".$row['id']."");	
						}
						$member_update['treeplace']=$treeplace;
						$member_update['fatherid']=$row['id'];
						$member_update['fathername']=$row['nickname'];
						$member_update['plevel']=$row['plevel']+1;
						$member_update['ppath']="".$row['ppath'].$row['id'].",";
						edit_update_cl("member",$member_update,$uid);
					}
				}
			}else{
				$member_update['treeplace']=1;
				$member_update['fatherid']=$reus['id'];
				$member_update['fathername']=$reus['nickname'];
				$member_update['plevel']=$reus['plevel']+1;
				$member_update['ppath']="".$reus['ppath'].$reus['id'].",";
				edit_update_cl("member",$member_update,$uid);
			}	
		}
	}
}



//顶层会员
function dingcengmember($id){
	$us=getMemberbyID($id);
	$us_update['ispay']=1;
	$us_update['pdt']=now();
	$us_update['fatherid']=0;
	$us_update['fathername']="顶层会员";
	$us_update['plevel']=0;
	$us_update['ppath']=",";
	$us_update['treeplace']=1;
	$pid=$this->getMaxPid();
	$us_update['pid']=$pid;
	edit_sql("update `member` set pcount=pcount+1 where id=".$pid."");
	$reman=getMemberbyID($us['reid']);
	$reman_update['recount']=$reman['recount']+1;
	$reman_update['reyeji']=$reman['reyeji']+$us['dan'];
	edit_update_cl('member',$us_update,$us['id']);
	edit_update_cl('member',$reman_update,$us['reid']);
	$_systemyeji=new system_class();
	$_systemyeji->yejitongji(1,$us['dan'],$us['lsk'],0,0,0,0);
}

//空单会员
function kongdanmember($id){
	$us=getMemberbyID($id);
	$us_update['ispay']=2;
	$us_update['pdt']=now();
        $us_update['isfh']=0;
        $a=0;
        $level= getOne("select a5 from jiangjin where id=1");
        $a=$level['a5'];
        if($a>=0){
            $us_update['date']=strtotime(date('Y-m-d')."+$a day");//7天后
        }
	$reman=getMemberbyID($us['reid']);
	$reman_update['recount']=$reman['recount']+1;
	edit_update_cl('member',$us_update,$us['id']);
	edit_update_cl('member',$reman_update,$us['reid']);
	$_systemyeji=new system_class();
	$_systemyeji->yejitongji(1,0,0,0,0,0,0);
}
//空单回填会员
function kongdanhtmember($id){
	$us=getMemberbyID($id);
	$us_update['ispay']=3;
	$us_update['lx']=1;
	$us_update['pdt']=now();
	$pid=$this->getMaxPid();
	$us_update['pid']=$pid;
	edit_sql("update `member` set pcount=pcount+1 where id=".$pid."");
	$reman=getMemberbyID($us['reid']);
	$reman_update['recount']=$reman['recount']+1;
	edit_update_cl('member',$us_update,$us['id']);
	edit_update_cl('member',$reman_update,$us['reid']);
	$this->addArea($us['id'],$us['treeplace'],$us['lsk'],$us['ulevel']);
	
	        $_systemyeji=new system_class();
	
			$_systemyeji->yejitongji(1,$us['dan'],$us['lsk'],0,0,0,0);
			$_sys=$_systemyeji->system_information(1);
			$_update_system['yeji']=$_sys['yeji']+$us['lsk'];
			$_systemyeji->system_update($_update_system);
}

/*
*修改推荐人
*/
function update_reman($_upreman){
	$upreman=getMemberbyNickName($_upreman);
	$sql="select * from `member` where rname='".$_upreman."'";
	if($query = mysql_query($sql)){
		while($row=mysql_fetch_array($query)){
			
			$up_member['reid']=$upreman['id'];
			$up_member['rname']=$upreman['nickname'];
			$up_member['repath']=$upreman['repath'].$upreman['id'].",";
			$up_member['relevel']=$upreman['relevel']+1;
			edit_update_cl('member',$up_member,$row['id']);
			$this->update_reman($row['nickname']);
		}
	}
}
function update_reman_num($rname,$_upreman){//原推荐人   现在推荐人
    $yl=getMemberbyNickName($rname);
    $xz=getMemberbyNickName($_upreman);
    if ($yl){
        $yl_member['recount']=$yl['recount']-1;
        edit_update_cl('member',$yl_member,$yl['id']);
    }
    if ($xz){
        $xz_member['recount']=$xz['recount']+1;
        edit_update_cl('member',$xz_member,$xz['id']);
    }

}
function update_reman_yeji($username,$rname,$_upreman){//自己 原推荐人   现在推荐人
    $zj=getMemberbyNickName($username);
    $yl=getMemberbyNickName($rname);
    $xz=getMemberbyNickName($_upreman);
    $yj=$zj['reyeji'];
    if($yl){
        $yl_member['reyeji']=$yl['reyeji']-$yj;
        edit_update_cl('member',$yl_member,$yl['id']);
    }
    if($xz){
        $xz_member['reyeji']=$xz['reyeji']+$yj;
        edit_update_cl('member',$xz_member,$xz['id']);
    }

}
/*
给上级新增业绩
* $id给上级新增业绩的会员
* $dan 业绩
*/
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
//            $fman_update['yarea2']=$fman['yarea2']+$dan;
            $fman_update['narea1']=$fman['narea1']+1;
            edit_update_cl('member',$fman_update,$fman['id']);
            if ($fman['reid']!=0){
                    $reid=$fman['reid'];
            }else {
                    break;
            }
        }
    }
}
function addAreacx($id,$dan){
    $sql="select id,userid,reid from member where id=$id";
    $us=getOne($sql);
    $reid=$us['reid'];
    if($reid!=0){
        for($i=1;$i;$i++){
            $fman_update=null;
            $fman=getOne("select id,userid,reid,area1,yarea1,yarea2,narea1 from member where id=".$reid."");
            $fman_update['area1']=$fman['area1']+$dan;
            $fman_update['yarea1']=$fman['yarea1']+$dan;
            $fman_update['yarea2']=$fman['yarea2']+$dan;
            edit_update_cl('member',$fman_update,$fman['id']);
            if ($fman['reid']!=0){
                    $reid=$fman['reid'];
            }else {
                    break;
            }
        }
    }
}
//重消购物上返业绩
function addAreacx2($id,$dan){
    $sql="select id,userid,treeplace,fatherid,plevel from member where id=$id";
    $us=getOne($sql);
    $fatherid=$us['fatherid'];
    $treeplace=$us['treeplace'];

    if($fatherid!=0){
        for($i=1;$i;$i++){
            $fman_update=null;
            $sql2="select id,userid,treeplace,fatherid,area1,yarea1,narea1,area2,yarea2,narea2,area3,yarea3,narea3 from member where id=".$fatherid."";
            	
            $fman=getOne($sql2);
            switch($treeplace){
                //业绩按单数计算
                case 1:
                    $fman_update['area1']=$fman['area1']+$dan;
                    $fman_update['yarea1']=$fman['yarea1']+$dan;
                    //$fman_update['narea1']=$fman['narea1']+1;
                    break;
                case 2:
                    $fman_update['area2']=$fman['area2']+$dan;
                    $fman_update['yarea2']=$fman['yarea2']+$dan;
                   // $fman_update['narea2']=$fman['narea2']+1;
                    break;
                case 3:
                    $fman_update['area3']=$fman['area3']+$dan;
                    $fman_update['yarea3']=$fman['yarea3']+$dan;
                  //  $fman_update['narea3']=$fman['narea3']+1;
                    break;

            }
            edit_update_cl('member',$fman_update,$fman['id']);
            	
            if ($fman['fatherid']!=0){
                $fatherid=$fman['fatherid'];
                $treeplace=$fman['treeplace'];
            }else {
                break;
            }

        }
    }

}
function sgaddArea3($id,$dan){
	$sql="select id,userid,treeplace,fatherid,plevel from member where id=$id";
	$us=getOne($sql);
	$fatherid=$us['fatherid'];
	$treeplace=$us['treeplace'];
	
	if($fatherid!=0){
		for($i=1;$i;$i++){
			$fman_update=null;
			$sql2="select id,userid,treeplace,fatherid,area1,area2,yarea1,yarea2,narea1,narea2 from member where id=".$fatherid."";
			
			$fman=getOne($sql2);
			switch($treeplace){
				 
                            case 1:
                                    $fman_update['area1']=$fman['area1']+$dan;
                                    
                                    $fman_update['yarea1']=$fman['yarea1']+$dan;

                                    break;
                            case 2:
                                    $fman_update['area2']=$fman['area2']+$dan;
                                    
                                    $fman_update['yarea2']=$fman['yarea2']+$dan;

                                    break;

			}
			edit_update_cl('member',$fman_update,$fman['id']);
			
			if ($fman['fatherid']!=0){
				$fatherid=$fman['fatherid'];
				$treeplace=$fman['treeplace'];
			}else {
				break;
			}
				
		}
	}

}
function addArea3($id,$dan){
	$sql="select id,userid,treeplace,fatherid,plevel from member where id=$id";
	$us=getOne($sql);
	$fatherid=$us['fatherid'];
	$treeplace=$us['treeplace'];
	
	if($fatherid!=0){
		for($i=1;$i;$i++){
			$fman_update=null;
			$sql2="select id,userid,treeplace,fatherid,area1,area2,yarea1,yarea2,narea1,narea2 from member where id=".$fatherid."";
			
			$fman=getOne($sql2);
			switch($treeplace){
				 
                            case 1:
                                    $fman_update['area1']=$fman['area1']+$dan;
                                    $fman_update['narea1']=$fman['narea1']+1;
                                    $fman_update['yarea1']=$fman['yarea1']+$dan;

                                    break;
                            case 2:
                                    $fman_update['area2']=$fman['area2']+$dan;
                                    $fman_update['narea2']=$fman['narea2']+1;
                                    $fman_update['yarea2']=$fman['yarea2']+$dan;

                                    break;

			}
			edit_update_cl('member',$fman_update,$fman['id']);
			
			if ($fman['fatherid']!=0){
				$fatherid=$fman['fatherid'];
				$treeplace=$fman['treeplace'];
			}else {
				break;
			}
				
		}
	}

}
function gwaddArea($id,$dan){
	$sql="select id,userid,treeplace,fatherid,plevel from member where id=$id";
	$us=getOne($sql);
	$fatherid=$us['fatherid'];
	$treeplace=$us['treeplace'];
	if($fatherid!=0){
            for($i=1;$i;$i++){
		$fman_update=null;
		$sql2="select id,userid,treeplace,fatherid,area1,area2,yarea1,yarea2 from member where id=".$fatherid."";
		$fman=getOne($sql2);
                switch($treeplace){
                    case 1:
                        $fman_update['area1']=$fman['area1']+$dan; 
                        $fman_update['yarea1']=$fman['yarea1']+$dan;

                        break;
                    case 2:
                        $fman_update['area2']=$fman['area2']+$dan;
                        $fman_update['yarea2']=$fman['yarea2']+$dan;

                        break;
                }
                edit_update_cl('member',$fman_update,$fman['id']);

                if ($fman['fatherid']!=0){
                    $fatherid=$fman['fatherid'];
                    $treeplace=$fman['treeplace'];
                }else {
                        break;
                }
				
            }
	}

}
function addArea2($id,$dan){//专卖店进货id,进货金额
	$sql="select id,userid,treeplace,fatherid,plevel,area1,area2 from member where id=$id";
	$us=getOne($sql);
	$fatherid=$us['fatherid'];
	$treeplace=$us['treeplace'];
	
	//业绩增加到专卖店id 的小区
	if ($us['area1']>$us['area2']){//左区大区，业绩加右区
	    
	    $us_update['area2']=$us['area2']+$dan;
	    $us_update['yarea2']=$us['yarea2']+$dan;
	    edit_update_cl('member',$us_update,$us['id']);
	   
	}else {//右区大区或者相等，加左区
	    
	    $us_update['area1']=$us['area1']+$dan;
	    $us_update['yarea1']=$us['yarea1']+$dan;
	    edit_update_cl('member',$us_update,$us['id']);
	}
	//上级增加业绩
	if($fatherid!=0){
		for($i=1;$i;$i++){
			$fman_update=null;
			$sql2="select id,userid,treeplace,fatherid,area1,yarea1,area2,yarea2 from member where id=".$fatherid."";
				
			$fman=getOne($sql2);
			switch($treeplace){
					
				case 1:
					$fman_update['area1']=$fman['area1']+$dan;
					//$fman_update['area4']=$fman['area4']+$dan;
					
					$fman_update['yarea1']=$fman['yarea1']+$dan;
					
						
					//$fman_update['narea1']=$fman['narea1']+1;
					break;
				case 2:
					$fman_update['area2']=$fman['area2']+$dan;
					//$fman_update['area5']=$fman['area5']+$dan;
					$fman_update['yarea2']=$fman['yarea2']+$dan;
				
						
					//$fman_update['narea2']=$fman['narea2']+1;
					break;
				case 3:
					$fman_update['area3']=$fman['area3']+$dan;
					$fman_update['yarea3']=$fman['yarea3']+$dan;
					//$fman_update['narea3']=$fman['narea3']+1;
					break;


			}
			edit_update_cl('member',$fman_update,$fman['id']);
				
			if ($fman['fatherid']!=0){
				$fatherid=$fman['fatherid'];
				$treeplace=$fman['treeplace'];
			}else {
				break;
			}

		}
	}

}
function addAreaggg($id,$dan){
	$sql="select id,userid,treeplace,fatherid,plevel from member where id=$id";
	$us=getOne($sql);
	$fatherid=$us['fatherid'];
	$treeplace=$us['treeplace'];
	$plevel=$us['plevel'];
	if($fatherid!=0){
		for($i=1;$i;$i++){
			$fman_update=null;
			$sql2="select id,userid,treeplace,fatherid,area1,yarea1,narea1,area2,yarea2,narea2,area4,area5,zuo,you from member where id=".$fatherid."";
				
			$fman=getOne($sql2);
			switch($treeplace){
					
				case 1:
					$fman_update['area1']=$fman['area1']+$dan;
					$fman_update['area4']=$fman['area4']+$dan;
					if ($plevel>$fman['zuo']) {
						$fman_update['zuo']=$plevel;
					}else {
						$fman_update['yarea1']=$fman['yarea1']+$dan;
					}
						
					$fman_update['narea1']=$fman['narea1']+1;
					break;
				case 2:
					$fman_update['area2']=$fman['area2']+$dan;
					$fman_update['area5']=$fman['area5']+$dan;
					if ($plevel>$fman['you']) {

						$fman_update['you']=$plevel;
					}else {
						$fman_update['yarea2']=$fman['yarea2']+$dan;
					}
						
					$fman_update['narea2']=$fman['narea2']+1;
					break;
				case 3:
					$fman_update['area3']=$fman['area3']+$dan;
					$fman_update['yarea3']=$fman['yarea3']+$dan;
					$fman_update['narea3']=$fman['narea3']+1;
					break;


			}
			edit_update_cl('member',$fman_update,$fman['id']);
				
			if ($fman['fatherid']!=0){
				$fatherid=$fman['fatherid'];
				$treeplace=$fman['treeplace'];
			}else {
				break;
			}

		}
	}

}
//减去原级别在团队中的人数
function addArea222($id,$treeplace,$dan,$ulevel){
	$sql="SELECT fatherid,treeplace FROM member WHERE id=".$id."";
	if ($us=getOne($sql)){
		$sql="SELECT narea1,narea2,lit_s1,lit_s2,lit_m1,lit_m2,lit_l1,lit_l2,lit_xl1,lit_xl2,area1,area2,id FROM member WHERE id=".$us['fatherid']."";
		if ($fman=getOne($sql)){
			switch($us['treeplace']){
				case 1:
					$fman_update['narea1']=$fman['narea1']-1; #总人数
					switch ($ulevel) {
						case 1:
							$fman_update['lit_s1']=$fman['lit_s1']-1; #小
							break;
						case 2:
							$fman_update['lit_m1']=$fman['lit_m1']-1; #中
							break;
						case 3:
							$fman_update['lit_l1']=$fman['lit_l1']-1; #大
							break;
						case 4:
							$fman_update['lit_xl1']=$fman['lit_xl1']-1; #超大
							break;
						default:
							break;
					}
					break;
				case 2:
					$fman_update['narea1']=$fman['narea1']-1; #总人数
					switch ($ulevel) {
						case 1:
							$fman_update['lit_s2']=$fman['lit_s2']-1; #小
							break;
						case 2:
							$fman_update['lit_m2']=$fman['lit_m2']-1; #中
							break;
						case 3:
							$fman_update['lit_l2']=$fman['lit_l2']-1; #大
							break;
						case 4:
							$fman_update['lit_xl2']=$fman['lit_xl2']-1; #超大
							break;
						default:
							break;
					}
					break;
			}
			edit_update_cl('member',$fman_update,$fman['id']);
			$this->addArea2($fman['id'],$fman['treeplace'],$dan,$ulevel);
		}
	}
}
/* //删除会员后，减去业绩
function addArea1($id,$treeplace,$dan){
	$sql="SELECT fatherid,treeplace FROM member WHERE id=".$id."";
	if ($us=getOne($sql)){
		$sql="SELECT id,treeplace,area1,area2 FROM member WHERE id=".$us['fatherid']."";
		if ($fman=getOne($sql)){
			switch($us['treeplace']){
				case 0:
					$fman_update['area1']=$fman['area1']+$dan; #总业绩
					break;
				case 1:
					$fman_update['area1']=$fman['area1']+$dan; #总业绩
					break;
				case 2:
					$fman_update['area2']=$fman['area2']+$dan; #总业绩
					break;
			}
			edit_update_cl('member',$fman_update,$fman['id']);
			$this->addArea1($fman['id'],$fman['treeplace'],$dan);
		}
	}
} */


//正式会员删除
function shanchu($id,$treeplace,$dan,$ulevel){
	$sql="SELECT fatherid,treeplace FROM member WHERE id=".$id."";
	if ($us=getOne($sql)){
		$sql="SELECT narea1,narea2,lit_s1,lit_s2,lit_m1,lit_m2,lit_l1,lit_l2,lit_xl1,lit_xl2,area1,area2,id FROM member WHERE id=".$us['fatherid']."";
		if ($fman=getOne($sql)){
			switch($us['treeplace']){
				case 1:
					$fman_update['narea1']=$fman['narea1']-1; #总人数
					$fman_update['area1']=$fman['area1']-$dan; #总业绩
					switch ($ulevel) {
						case 1:
							$fman_update['lit_s1']=$fman['lit_s1']-1; #小
							break;
						case 2:
							$fman_update['lit_m1']=$fman['lit_m1']-1; #中
							break;
						case 3:
							$fman_update['lit_l1']=$fman['lit_l1']-1; #大
							break;
						case 4:
							$fman_update['lit_xl1']=$fman['lit_xl1']-1; #超大
							break;
						default:
							break;
					}
					break;
				case 2:
					$fman_update['narea2']=$fman['narea2']-1; #总人数
					$fman_update['area2']=$fman['area2']-$dan; #总业绩
					switch ($ulevel) {
						case 1:
							$fman_update['lit_s2']=$fman['lit_s2']-1; #小
							break;
						case 2:
							$fman_update['lit_m2']=$fman['lit_m2']-1; #中
							break;
						case 3:
							$fman_update['lit_l2']=$fman['lit_l2']-1; #大
							break;
						case 4:
							$fman_update['lit_xl2']=$fman['lit_xl2']-1; #超大
							break;
						default:
							break;
					}
					break;
			}
			edit_update_cl('member',$fman_update,$fman['id']);
			$this->shanchu($fman['id'],$fman['treeplace'],$dan,$ulevel);
		}
	}
}


}
?>