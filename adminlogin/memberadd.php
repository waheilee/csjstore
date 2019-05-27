<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
include_once("../class/member_class.php");
include_once("../class/system_class.php");
include_once("action.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
$sys=getOne("select id,rnum,rsum,rid,k from systemparameters where id=1");
if ($_POST['button']){
    $m = $_POST['jine'];
    $lx=$_POST['ulevel'];
    $dd=$_POST['dd'];
    $ulevel = $_POST['ulevel'];
    $bonus_cl=new bonus_class();
    if ($m>0){
        if($m>300){
            $m=300;
        }
        for ($i=1;$i<=$m;$i++){
            
            
            $one=getOne("select id,nickname from member where ispay>0 order by id desc");//最后的会员
            if ($one['id']==1){
                $nickname=1;
            }else {
                $nickname=$one['nickname']+1;
            }
            //添加会员
            $member=null;
            $member['userid']=$nickname;
            $member['nickname']=$nickname;
            $member['username']=$nickname;
            $member['password1']=md5(111111);
            $member['pass1']=111111;
            $member['password2']=md5(222222);
            $member['pass2']=222222;
            
            $_ulevel=new ulevel_class();
            $ul=$_ulevel->getulevelbyulevel($ulevel);
            $member['ulevel']=$ulevel;
            $member['lsk']=$ul['lsk'];
            $member['dan']=$ul['dan'];
            
            $member['reid']=1;
            $member['rname']=admin;
            $member['bdid']=1;
            $member['bdname']=admin;
            $member['rdt']=now();
            add_insert_cl('member',$member);
            
            $_member=new member_class();
            $tw=getOne("select id,nickname from member where nickname='".$nickname."'");//最后的会员
            $re=getOne("select id,rnum,rsum,rid from systemparameters where id=1");
            $r= getOne("select id from member where id={$re['rid']}");
            if($r){
                $reid=$r['id'];
            }else{
                $reid=1;
            }
            $_member->jihuomember2($tw['id'],$reid);
            if($dd==1){
                $u=getOne("select * from member where nickname='".$nickname."'");//最后的会员
                $_member->orders(0,$u,0,0,0,$tw['id']);//订单
            }
            if($sys['k']){
                edit_sql("update systemparameters set rsum=rsum+1 where id=1");
                $re2=getOne("select id,rnum,rsum,rid from systemparameters where id=1");
                if($re2['rsum']>=$re2['rnum']){
                    edit_sql("update systemparameters set rsum=0,rid=rid+1 where id=1");
                }
            }
            //结算奖金-大公排
            
        }
        //$bonus_cl->fh();
        //$bonus_cl->fh2();
        //$bonus_cl->b0bonus();
        
        action::record("数据添加","1",$_SESSION['adminid'],"$m");
        
        
        echo "<script language=javascript>alert('数据添加完成.');window.location.href='?lx=$lx&dd=$dd'</script>";
        
    }else{
        echo "<script language=javascript>alert('数量有误有误，请从新填写.');window.location.href='?lx=$lx&dd=$dd'</script>";
    }
}

if($_POST['button4']){
    if($_POST['rid']){
        $rr= getOne("select id from member where id={$_POST['rid']}");
        if($rr){
            $bank_update['rnum']=$_POST['rnum'];
            $bank_update['rid']=$_POST['rid'];
            $bank_update['k']=$_POST['k'];
            edit_update_cl('systemparameters',$bank_update,1);     
            echo "<script language=javascript>alert('修改成功');window.location.href='?lx=$lx&dd=$dd'</script>";
        }else{
            echo "<script language=javascript>alert('修改失败');window.location.href='?lx=$lx&dd=$dd'</script>";
        }      
	}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>虚拟数据</title>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/caiwuguanli.css">
<script src="js/jquery.js"></script>
<script src="js/lanrenzhijia.js"></script>
<script src="js/heightLine.js"></script>
<script src="js/index.js"></script>
<script>
if(((navigator.userAgent.indexOf('iPhone') > 0) || (navigator.userAgent.indexOf('Android') > 0) && (navigator.userAgent.indexOf('Mobile') > 0) && (navigator.userAgent.indexOf('SC-01C') == -1))){
document.write('<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">');
}                                         
</script>
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>
<div id="container">
	<!-- #BeginLibraryItem "/Library/header.lbi" -->
	<?php include 'header.php';?>
	<!-- #EndLibraryItem -->
<section id="main" class="clearfix">
		<!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
		<?php include 'left.php';?>
		<!-- #EndLibraryItem -->
<div id="conts">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	<?php include 'title.php';?>
        	<!-- #EndLibraryItem -->
<div class="mainBox">
            	<form method="post" action="">
            
            	<div class="list">
                    功能：<input type="radio" name="k" id="k" value="1" <?php if($sys['k']==1){ ?> checked <?php }?>>开
                       <input type="radio" name="k" id="k" value="0" <?php if($sys['k']<>1){ ?> checked <?php }?>>关
                    
                   <span class="span">推荐数量：<input type="text" value="<?=$sys['rnum']?>" name="rnum" id="rnum"/> 
                       &nbsp;推荐人ID：<input type="text" value="<?=$sys['rid']?>" name="rid" id="rid"/></span>  
                    <input type="submit" value="修改" name="button4" id="button4"/>
                   
                
                </div>
            <br>
                <h2>虚拟数据</h2>
                
                <div class="table">
                	<table>
                	
                    	<tr>
                        	
                        	<td align="center" >总人数</td>
                        	
                          
                            <td align="center" >添加人数</td>
                            <td align="center" >会员等级</td>
                            <td align="center" >虚拟订单</td>
                             <td align="center" >操作</td>
                        </tr>
                        <?php
                      	$ul = new ulevel_class();
                      	$ulevel_cl=new ulevel_class();
                      
                      		$sql="select  count(*)  from member ";
                      		$result = mysql_query($sql);
                      		$array = mysql_fetch_assoc($result);
                      		
                      		
                    	    
                    		
                    		
                      ?>
                    	<tr>
                         
                	  	 <td align="center" ><?=$array['count(*)'];?></td>
                	     
                	  	 
                	  	 
                	  
                	  	 <td align="center"><input type="text" name="jine" value="0" size="10"/></td>
                	  	 <td align="center"><select  id="ulevel" name="ulevel" >
                                    <?php
                                    $_ulevel=new ulevel_class();

                                    for($i=1;$i<=8;$i++){
                                        $ul=$_ulevel->getulevelbyulevel($i);
                                       


                                            ?>
                                 <option <?php if($_GET['lx']==$i){?>selected<?php } ?> value="<?=$i?>"><?=$ul['lvname']?> ￥<?=$ul['lsk']?></option>
                                            <?php
                                       
                                    }

                                    ?>
                                </select></td>
                	  	  
                	  	<td align="center">
                            <select  id="dd" name="dd" >
                                <option <?php if($_GET['dd']==0){?>selected<?php } ?> value="0">不生成</option>
                                <option <?php if($_GET['dd']==1){?>selected<?php } ?> value="1">生成</option>
                            </select>
                        </td>
                	     <td align="center" colspan="3"  >
                	    
                	     <input type="submit" class="button" id="button" name="button" value="添加" style="width:100px" />
                	     
                	     </td>
                        </tr>
                    </table>
                   
                </div>
                </form>
                 
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>