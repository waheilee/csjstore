<!DOCTYPE html>
<?php
include_once("../class/ulevel_class.php");
include_once("../class/system_class.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");
include_once("../function.php");
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('PRC');
session_start();
$member=getMemberbyID($_SESSION['ID']);
$sys=getOne("select id,num from systemparameters where id=1 ");
$num=$sys['num'];


if($_GET['del']){
    $o= getOne("select * from orders2 where uid={$member['id']} and id={$_GET['del']}");
    if($o['issend']==-1){
        // dingdandel($o['ordersnumber']);
        edit_delete_cl('orders2',$_GET['del']);  
        echo "<script language=javascript>alert('订单删除成功！');window.location.href='?'</script>";
    }else{
        echo "<script language=javascript>alert('该订单不可删除！');window.location.href='?'</script>";
    } 
}
#搜索商品
if ($_POST['Search']){
    $SearchContent=$_POST['SearchContent'];
    $TimeStart=$_POST['TimeStart'];
    $TimeEnd=$_POST['TimeEnd'];
    if ($TimeStart!=NULL){
        if ($TimeEnd==NULL){
            $TimeEnd=now();
        }
        $_SESSION['SearchTime']="and date>='".$TimeStart."' and date<='".$TimeEnd."'";
    }else{
        $_SESSION['SearchTime']=NULL;
    }
    if ($SearchContent!=NULL){
        $SearchType=$_POST['SearchType'];
        $SearchType=1;
        if ($SearchType==1){
            #搜索订单编号
            $_SESSION['Search']="and ordersnumber like '%".$SearchContent."%'";
        }else if($SearchType==2){
            $_SESSION['Search']="and userid like '%".$SearchContent."%'";
        }else if($SearchType==2){
            $_SESSION['Search']="and username like '%".$SearchContent."%'";
        }
    }else{
        $_SESSION['Search']=NULL;
    }
}else{
    if ($_GET['page']==NULL){
        $_SESSION['Search']=NULL;
        $_SESSION['SearchTime']=NULL;
    }
}
if ($_POST['sub']){//买入
    
    if(tx(date("w"))<>1){
        echo "<script language=javascript>alert('今天不是工作日！');window.location.href='?'</script>";
    }
    
    $id=$_POST['id'];
    
    $dd = getOne("SELECT * FROM orders2 where id=".$id."");
    
    
    if ($dd['isqr']==0 && $dd['gs']==1) {//会员提货
        
        $cc_xiugai['date']=now();
        $cc_xiugai['isqr']=1;
        edit_update_cl('orders2',$cc_xiugai,$dd['id']);
        
        
        
        echo "<script language=javascript>alert('会员提货完成.');window.location.href='?'</script>";
        
    }else {
        echo "<script language=javascript>alert('订单未匹配或已经提货，请刷新后重试.');window.location.href='?'</script>";
    }
}

if ($_POST['sub2']){//挂售
    
    $id=$_POST['id'];
    
    $dd = getOne("SELECT * FROM orders2 where id=".$id."");
    
    if(tx(date("w"))<>1){
        echo "<script language=javascript>alert('今天不是工作日！');window.location.href='?'</script>";
        
    }
    
    if ($dd['isqr']==0 && $dd['gs']==1) {//会员提货
        
        $date=$dd['date'];
        $num=$sys['num'];
        $last = date('Y-m-d H:i:s',strtotime("$date +$num day"));
        $now=now();
        //echo $last;die();
        
        if ($now>=$last || $dd['lunci']==4){
            
                $_bonus_cl = new bonus_class();
                //$_member_cl = new member_class();
                
                //$cc_xiugai['date']=now();
                $cc_xiugai['isqr']=2;
                $cc_xiugai['gs']=0;
                edit_update_cl('orders2',$cc_xiugai,$dd['id']);
                
                $_bonus_cl->ircout($member,$dd['ordersnumber'],$dd['goodid'],$dd['goodname'],$dd['jine']);
                $_bonus_cl->ppsell();
                
                
                $_bonus_cl->b0bonus();
                
                echo "<script language=javascript>alert('挂售成功，请刷新后重试.');window.location.href='?'</script>";
        }else {
         
            echo "<script language=javascript>alert('订单".$sys['num']."天后才可以挂售，请刷新后重试.');window.location.href='?'</script>";
        }
        
    }else {
        echo "<script language=javascript>alert('订单未匹配或已经挂售，请刷新后重试.');window.location.href='?'</script>";
    }
}
if ($_POST['sub4']){//挂售
    
    $id=$_POST['id'];
    
    $dd = getOne("SELECT * FROM orders2 where id=".$id."");
    
    
    
    if(tx(date("w"))<>1){
        echo "<script language=javascript>alert('今天不是工作日！');window.location.href='?'</script>";
        
    }
    if ($dd['isqr']==2 && $dd['gs']==0 && $dd['lunci']==4) {//挂卖的  未匹配的  c积分购买的
        
        
        $sql = "SELECT * FROM `buysell` WHERE isgrant=0 and lx=2 and ordersnumber='".$dd['ordersnumber']."' order by id asc ";//买家信息 找出来
        $one=getOne($sql);
        
        if ($one['id']!=null){
            
            $cc_xiugai['isqr']=0;
            $cc_xiugai['gs']=1;
            
            edit_update_cl('orders2',$cc_xiugai,$dd['id']);
            
            edit_delete_cl('buysell',$one['id']);
            
            
            echo "<script language=javascript>alert('取消成功，请刷新后重试.');window.location.href='?'</script>";
        }else {
            echo "<script language=javascript>alert('2订单已匹配或已经挂售，请刷新后重试.');window.location.href='?'</script>";
        }
    }else {
        echo "<script language=javascript>alert('1订单已匹配或已经挂售，请刷新后重试.');window.location.href='?'</script>";
    }
}
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>我的订单</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/tuijian.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>

</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	<?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
        
   	  <div class="mainBox">
        	<div class="table">
            	<table>
                	<tr>
<!--      	<td height="21" align="center">全选
      	  <input type="checkbox" name="checkbox" onclick="SelectAll() "></td>-->
  <!--      <td align="center">订单编号</td>
        <td align="center">供应商</td>
        <td align="center">订单类型</td>-->
        <td align="center">付款方式</td>
        <!-- <td align="center">付款状态</td>
        <td align="center">物流公司</td>
        <td align="center">物流编号</td>
       
        <td align="center">会员编号</td>
        <td align="center">会员姓名</td>
       
        <td align="center">联系电话</td>
        <td align="center">联系地址</td> -->
        <td align="center">商品名称</td>
<!--        <td align="center">订单颜色</td>-->
        <!--  <td align="center">单价</td>
        <td align="center">总价</td>
        <td align="center">数量</td>
        -->
        <!-- <td align="center">总计</td> -->
        <td align="center">订单金额</td>
        <td align="center">订单时间</td>
        <!--  <td align="center">发货时间</td>-->
        <!--  <td align="center">提售</td>  -->
        <!--  <td align="center">状态</td>
        <td align="center">操作</td>
        -->
        </tr>
   <?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `orders2` WHERE uid='".$_SESSION['ID']."'"." ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
	  	
		if($query = mysql_query($sql)){
	  		$sum = mysql_num_rows($query); //计算总记录数 
		}else{
			$sum=0;	
		}
		if($sum % $pagesize == 0) //计算总页数 
			$total = (int)($sum/$pagesize); 
		else 
			$total = (int)($sum/$pagesize) + 1; 
			if (isset($_GET['page'])) //获得页码 
			{ 
				$p = (int)$_GET['page'];
			} 
			else 
			{ 
				$p = 1;
			}
			if ($p>$total){
				$p=$total;	
			}
		$start = $pagesize * ($p - 1); //计算起始记录 
		
		
		
      	$sql = "SELECT * FROM `orders2` WHERE  uid='".$_SESSION['ID']."'"." ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
//      $member=getOne("SELECT useraddress FROM `member` WHERE id={$row['uid']}")

		    $Date_b=$row['date'];
		   // echo a;echo $num;die();
		    $shs=date("Y-m-d H:i:s",strtotime("$Date_b +$num day"));
		    
	  ?>
	
                    	
                <form name="form2" method="post" action="?id=<?=$row['id']?>">     	
              <tr>
				<td align="center"><?php if($row['lx']==1){?>A积分<?php }elseif($row['lx']==2){ ?>C积分<?php } ?>
				
				 <input type="text" value="<?=$row['id']?>" name="id" style="display:none"/></td>
                <td align="center"><?=$row['goodname']?></td>
                <td align="center"><?=$row['jine']?></td>
                <td align="center"><?=$row['date']?></td>
      
        
             </tr>
             <tr>
      <?php //购买的 
      
      if ($row['lunci']==1){
            if ($row['gs']==0){ ?>
          <td colspan="4" align="center">排队中 <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="button" class="button" id="button4" name="button4" value="查看" onClick="window.location.href='order2.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" /></td>
          <?php }else {?>
          <td colspan="4" align="center">
          <?php if($row['issend']==0){?>未发货<?php }else if($row['issend']==1){ ?>已发货<?php }else if($row['issend']==2){?>已退款<?php }?> <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="button" class="button" id="button4" name="button4" value="查看" onClick="window.location.href='order2.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" /></td>
          
          <?php }?>
       
       <?php }else {?>
             
                 <?php if ($row['isqr']==0){//匹配中?>
                        <?php if ($row['gs']==0){?>
                        
                         <td colspan="4" align="center">排队中<input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="button" class="button" id="button4" name="button4" value="查看" onClick="window.location.href='order2.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" /></td>
                        <?php }elseif ($row['gs']==1){?>
                        
                        <td  colspan="2" align="center" id="timer_<?=$row['id']?>" data-pp_time="<?=$row['date']?>"></td>
                        <td  colspan="2" align="center" >
                       
                        <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="submit" value="提货"  name="sub" onClick="{if(confirm('您确定要提货吗?')){this.document.selform.submit();return true;}return false;}"/>
                        <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="submit" value="挂售" name="sub2" onClick="{if(confirm('您确定要挂售吗?')){this.document.selform.submit();return true;}return false;}"/>
                        <?php if ($row['lunci']==4){?>
                        <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="button" class="button" id="button4" name="button4" value="定向" onClick="window.location.href='gsdt2.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" />
                       <?php }?>
                       <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="button" class="button" id="button4" name="button4" value="查看" onClick="window.location.href='order2.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" />
                        </td>
                        <?php }?>
             
                 <?php }elseif ($row['isqr']==1){////提货?>
                 <td colspan="4" align="center"><?php if($row['issend']==0){?>未发货<?php }else if($row['issend']==1){ ?>已发货<?php }else if($row['issend']==2){?>已退款<?php }?>
                   <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="button" class="button" id="button4" name="button4" value="查看" onClick="window.location.href='order2.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" />
                   <td>
                
                 <?php }elseif ($row['isqr']==2){////挂售?>
                 
                         <?php if ($row['gs']==0){?>
                          <td colspan="4" align="center">排队中 <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="button" class="button" id="button4" name="button4" value="查看" onClick="window.location.href='order2.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" />
                         <?php if ($row['lunci']==4){?>
                          <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="submit" value="取消" name="sub4" onClick="{if(confirm('您确定要取消吗?')){this.document.selform.submit();return true;}return false;}"/>
                         <?php }?>
                         </td>
                         <?php }else{ ?>
                          <td colspan="4" align="center">已匹配 <input style="background: #3598dc;color: #fff;padding: 4px 10px;border: none;border-radius: 5px;cursor: pointer;"type="button" class="button" id="button4" name="button4" value="查看" onClick="window.location.href='order2.php?oid=<?=$row['id']?>&page=<?=$p?>&lx=<?=$row['lx']?>'" /></td>
                         <?php }?>
                 <?php }?>
            
                
                         
      </tr>
      <?php }?>
      </form>
   
      <?php
			
		}
		}
	  ?>
	
                            <tr>
                                <td align="center" colspan="10"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
                            </tr>
          
                </table>
                
              <script language="javascript">
//$(function(){
	setTimeout("add_time()",1000); 
//}); 
function add_time(){
    
	$.each($('[id^="timer_"]'),function(){
     	var td_id = this.id;
     	var pp_td = $(this).data('pp_time');
     	var time_start = new Date(pp_td).getTime(); 
     	//var yj_end = time_start+(1000*60*60*6);
    	 var yj_end= new Date('<?=$shs?>'); 
        var time_end =  new Date().getTime(); 
        // 计算时间差 
        if(yj_end <=time_end){//超过6小时
            int_day=0;
            int_hour=0;
            int_minute=0;
            int_second=0;
        }else{
       	 	var time_distance = yj_end - time_end; 
        	var int_day = Math.floor(time_distance/86400000) //天
        	time_distance -= int_day * 86400000;
        	var int_hour = Math.floor(time_distance/3600000) // 时
        	time_distance -= int_hour * 3600000;
        	var int_minute = Math.floor(time_distance/60000)  // 分
        	time_distance -= int_minute * 60000; 
        	var int_second = Math.floor(time_distance/1000) // 秒 
        // 时分秒为单数时、前面加零 
            if(int_day < 10){ 
                int_day = "0" + int_day; 
            } 
            if(int_hour < 10){ 
                int_hour = "0" + int_hour; 
            } 
            if(int_minute < 10){ 
                int_minute = "0" + int_minute; 
            } 
            if(int_second < 10){
                int_second = "0" + int_second; 
            } 
        }
		var sy_time = int_day+'天'+int_hour + '时' + int_minute + '分' + int_second + '秒';
		$("#"+td_id).html(sy_time); 
    }); 
		setTimeout("add_time()",1000); 
    }
</script>

            </div>
        </div>
        <br/><br/><br/>
        <br/><br/><br/>
    
    </section>
        <?php include 'footer.php';?>
    
</body>
</html>