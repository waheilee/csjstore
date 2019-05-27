<?php
/**
*
* example目录下为简单的支付样例，仅能用于搭建快速体验微信支付使用
* 样例的作用仅限于指导如何使用sdk，在安全上面仅做了简单处理， 复制使用样例代码时请慎重
* 请勿直接直接使用样例对外提供服务
* 
**/
include_once ("../../../class/member_class.php");
include_once ("../../../class/ulevel_class.php");
include_once ("../../../function.php");
include_once ("../../../class/system_class.php");
include_once ("../../../class/bonus_class.php");

// require_once "../../../function.php";
include_once ("../lib/WxPay.Api.php");
include_once ("../lib/WxPay.Notify.php");
include_once ("WxPay.Config.php");
include_once ("log.php");
//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

class PayNotifyCallBack extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$config = new WxPayConfig();
		$result = WxPayApi::orderQuery($config, $input);
		Log::DEBUG("query:" . json_encode($result));
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			$rs=null;
			$rs= getOne("select * from orders2 where ordersnumber='{$result["out_trade_no"]}'");
			$member=getOne("select * from member where id={$rs['uid']}");
			if($rs['issend']==-1){
				edit_sql("update orders2 set issend=0 where id={$rs['id']}");
			}
			$member_cl = new member_class(); 
			$_bonus_cl = new bonus_class(); 
			$_systemyeji=new system_class();
			$_ulevel=new ulevel_class();
			$num=$rs['num'];
			$lx=$rs['lx'];
			$zje=$rs['jine'];
			$FileID=$rs['ordersnumber'];
			$username=$rs['username'];
			$usertel=$rs['usertel'];
			$useraddress=$rs['useraddress'];
			$yanse1=$rs["yanse"];
			if($member['ispay']==0 && $lx<>6){
				$member_update['ispay']=1;
				$member_update['pdt']=now();
				$_systemyeji->yejitongji(1,0,0,0,0,0,0);//计算波比
			}
			if($lx<=5){
				$member_update['tao']=$member['tao']+$num;
			// return sprintf("<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>");
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
				return sprintf("<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>");

			}
			if(($lx<=5) && ($member['cishu']==1)){
			// return sprintf("<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>");
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
			return sprintf("<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>");

			}
			return sprintf("<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>");
        	// return true;
		}
		return false;
	}

	/**
	*
	* 回包前的回调方法
	* 业务可以继承该方法，打印日志方便定位
	* @param string $xmlData 返回的xml参数
	*
	**/
	public function LogAfterProcess($xmlData)
	{
		Log::DEBUG("call back， return xml:" . $xmlData);
		return;
	}
	
	//重写回调处理函数
	/**
	 * @param WxPayNotifyResults $data 回调解释出的参数
	 * @param WxPayConfigInterface $config
	 * @param string $msg 如果回调处理失败，可以将错误信息输出到该方法
	 * @return true回调出来完成不需要继续回调，false回调处理未完成需要继续回调
	 */
	public function NotifyProcess($objData, $config, &$msg)
	{
		$data = $objData->GetValues();
		//TODO 1、进行参数校验
		if(!array_key_exists("return_code", $data) 
			||(array_key_exists("return_code", $data) && $data['return_code'] != "SUCCESS")) {
			//TODO失败,不是支付成功的通知
			//如果有需要可以做失败时候的一些清理处理，并且做一些监控
			$msg = "异常异常";
			return false;
		}
		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}

		//TODO 2、进行签名验证
		try {
			$checkResult = $objData->CheckSign($config);
			if($checkResult == false){
				//签名错误
				Log::ERROR("签名错误...");
				return false;
			}
		} catch(Exception $e) {
			Log::ERROR(json_encode($e));
		}

		//TODO 3、处理业务逻辑
		Log::DEBUG("call back:" . json_encode($data));
		$notfiyOutput = array();
		
		
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
		return true;
	}
}

$config = new WxPayConfig();
Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle($config, false);