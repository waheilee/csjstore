<?php
include("admin_check.php");
include_once("../function.php");
include_once("../class/bonus_class.php");
include_once("../class/system_class.php");
include_once("action.php");
session_start();
header("Content-Type: text/html;charset=utf-8");

$us=que_select_cl('member',$_SESSION['ID']);
$_system=new system_class();
$system=$_system->system_right();
$sys=getOne("select * from systemparameters where id=1 ");
$bl=$_POST['bl'];
$jine=$_POST['jine'];

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="">
<meta name="keywords" content="">
<title>发放管理奖</title>
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
            	<?php 

            			//发放收益
            			if ($_POST['button5']){
            			    $a = $_POST['jine'];
            			    $bonus_cl=new bonus_class();
            			    $nowsj=now();
            			    $shijia=date('Y-m-d H:i:s',strtotime($sys['date2']."+7 day"));
            			    //确定人数
            			    $sql="select  count(*)  from member where rejine>0";
            			    $result = mysql_query($sql);
            			    $array = mysql_fetch_assoc($result);
            			    
            			    if($array['count(*)']==0){
            			        echo "<script language=javascript>alert('参与人数为零!.');window.location.href='?'</script>";
            			        break;
            			    }
            			   // if(strtotime($nowsj) > strtotime($shijia)){
            			        $bonus_cl->fafang();
            			        $bonus_cl->b0bonus();
            			        $sysup['date2']=now();
            			        edit_update_cl('systemparameters',$sysup,1);
            			        action::record("发放管理奖","1",$_SESSION['adminid'],"$a");
            			        echo "<script language=javascript>alert('发放完成.');window.location.href='?'</script>";
//               			    }
//               			   echo "<script language=javascript>alert('您本周已经发放.');window.location.href='?'</script>";
          			}
            	?>
            	
                <h2>发放管理奖</h2>
				   <div class="table"><form method="post" action="">
				   	<table>
                	 <tr>
	  				 </tr>
	  				 <!-- 冻结释放结算 -->
                
                <div class="table">
                	 <tr>
	  				 </tr>
  					 <tr>

                	 <td align="center" >参与人数</td>
                	 <td align="center" >业绩总数</td>
                     <td align="center" >上次执行时间</td>
                     <td align="center" >操作</td> 
  					 </tr>
  					<?php
                //查会员等级
              		$sql="select  count(*),sum(rejine)  from member where rejine>0 ";
              		$result = mysql_query($sql);
              		$array1 = mysql_fetch_assoc($result);
              		$sys=getOne("select * from systemparameters where id=1 ");
              		
                    ?>
    				<tr>

            	  	<td align="center" ><?=$array1['count(*)'];?></td>   	  
            	  	<td align="center" ><?=$array1['sum(rejine)']?><br></td>
            	  	
	  				<td align="center" ><?=$sys['date2']?><br></td>
	  				<td colspan="6"><input name="button5" type="submit" id="button5" value="发放" onClick=" if(confirm('您确定要结算吗?')){this.document.selform.submit();return true;}return false;"></td>
	  				</tr>
	  				<!-- 
	  				<script type="text/javascript">
                        $('#button8').click(function abc(){

                            	$('#button').click();
                            	$('#button2').click();
                            	$('#button3').click();
                            	$('#button4').click();

                        });
                        </script>
	  				 <tr>
                	<th colspan="5">
                    	<input name="button8" id="button8" type="submit" onClick='abc()' value="一键日结算"/>
                    </th>
               		</tr>
               		 -->
               		
               		
                    </table>
                    </form>
                </div>
                        
               
                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>