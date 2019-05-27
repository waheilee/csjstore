<?php
include("admin_check.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");
include_once("action.php");
session_start();
header("Content-Type: text/html;charset=utf-8");
$zsq=$_POST['zsq'];

//checkqx(1,3);
if ($_POST['Search']){
	$SearchContent=$_POST['SearchContent'];
	if ($SearchContent!=NULL){
		$SearchType=$_POST['SearchType'];
		if ($SearchType==1){
			#搜索会员编号
			$_SESSION['Search']="and nickname='".$SearchContent."'";
		}elseif($SearchType==2){
			#搜索姓名
			$_SESSION['Search']="and username='".$SearchContent."'";
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

if($_POST['button']){

if($_POST['id']==1){
    alert('设置失败,管理员服务中心禁止设置！','?');exit;
}

	if($_POST['id']){
		$_bonus_cl=new bonus_class();
		$_member=new member_class();
		$us=$_member->getMemberbyID($_POST['id']);
		$reid=$us['reid'];

		if($us['bdlevel']==1){
		    $member['isbd']=2;
		}
		
		edit_update_cl('member',$member,$us['id']);
            action::record("审核服务中心", $us['id'], $_SESSION['adminid'], 0);          
            alert('确认成功.','?');

	}else{
		alert('设置出错,确认失败.','?');	
	}
}

if($_POST['button2']){
	if($_POST['id']){
		if ($_POST['id']>1){
			$member['isbd']=0;
			$member['bdlevel']=0;
            $member['bdfname']='';
			$sql="SELECT * FROM `member` WHERE id=".$_POST['id']."";

			if ($query=mysql_query($sql)){
				while($row=mysql_fetch_array($query)){
                    $iffname=getOne("SELECT * FROM `member` WHERE bdfname='".$row['userid']."' ");
                    if(!$iffname){
                        if($row['isbd']<=2){
                            //$_member['bdid']=1;
                            //$_member['bdname']="admin";
// 					edit_update_cl('member',$_member,$row['id']);
                            //($member['zsq']=$row['zsq']+60000) ;
                            edit_update_cl('member',$member,$_POST['id']);
                            alert('删除成功.','?');
                        }else{
                            alert('无法删除','?');
                        }
                    }else{
                        alert('删除失败,该服务中心拥有下级服务中心.','?');
                    }
					
				}
			}
			
		}else{
			alert('删除失败,管理员服务中心禁止删除.','?');
		}
	}else{
		alert('设置出错,删除失败.','?');	
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
<title>服务中心</title>
<link rel="stylesheet" type="text/css" href="css/lanrenzhijia.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/jihuohuiyuan.css">
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
<body style="margin-top:-19px">
<div id="container">
	
   <!-- #BeginLibraryItem "/Library/header.lbi" -->
   <?php include 'header.php';?>
   <!-- #EndLibraryItem -->
<section id="main" class="clearfix">
		<!-- #BeginLibraryItem "/Library/sideBar.lbi" -->
		<?php include 'left.php';?>
		<!-- #EndLibraryItem -->
<div id="conts" cl ass="heightLine-1">
        	<!-- #BeginLibraryItem "/Library/title.lbi" -->
        	<?php include 'title.php';?>
        	<!-- #EndLibraryItem -->
<div class="mainBox">
            	<div class="title clearfix">
                	<form action="" method="post">
                    	<div class="left">
                    		<select name="SearchType" id="SearchType">
            <option value="1">会员编号</option>
            <option value="2">会员姓名</option>
          </select>
               <input type="text" name="SearchContent" id="SearchContent">
             <input type="submit" name="Search" id="Search" class="btn1" value="搜索">
                            
                    	</div>
                       <!-- <div class="right">
                        	<span>搜索时间范围：</span><input type="text" name="date" class="tcal" value="" />至
                            <input type="text" name="date" class="tcal1 tcal" value="" />
                		</div>-->
            		</form>
             	</div>
                
                <div class="table">
                	<h3>服务中心</h3>
                    <div class="table1">
                	<table>
                    	 <tr>
                            	<td>会员编号</td>
                            	
                            	<td>服务类别</td>
                            	<td>级别</td>
                            	<td>联系电话</td>
                            <!-- 	<td>现金增减</td>
                            	
                            	<td>上级编号</td>
                            	<td>修改上级</td>
                            	 -->
                            	<td>操作</td>
                        </tr>
                       
<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `member` WHERE isbd>0  ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `member` WHERE isbd>0  ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by isbd,id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
	  <form name="form1" method="post" action="?">
      
      <?php
      	if ($row['isbd']==1){
			$_color="#D9D9F3";	
		}else{
			$_color="";	
		}
	  ?>
      <tr>
        <td style="background:<?=$_color?>" align="center"><input name="id" type="hidden" value="<?=$row['id']?>"><?=$row['nickname']?></td>
        <td align="center" style="background:<?=$_color?>">
        <?php if ($row['bdlevel']==4){?>服务站
        <?php }elseif ($row['bdlevel']==1){?>服务中心
        <?php }elseif ($row['bdlevel']==5){?>分公司
        <?php }?>
           
      </td>
        <td align="center" style="background:<?=$_color?>">
            <?php $memberul=ulevel($row['ulevel']); ?><?=$memberul['lvname']?>
        </td>
          <td align="center"style="background:<?=$_color?>"><?=$row['usertel']?></td>
        <!--   <td align="center"style="background:<?=$_color?>"><?=$row['zsq'];?><input name="zsq" id="zsq" type="text" value="" size="5" maxlength="20"></td>
       
       
        <td align="center"><?=$row['bdfname']?></td>
        <td align="center"><input name="sqbdje" type="text" value="" size="5" maxlength="20"></td>
        -->
        <td align="center" class="tab3"style="background:<?=$_color?>">
        <input name="button" style="background: #3598dc;
color: #fff;
padding: 4px 10px;
border: none;
border-radius: 5px;
cursor: pointer;" type="submit" class="tab3" id="button" value="保存">&nbsp;&nbsp;
        <input name="button2" style="background: #e74f5b;
color: #fff;
padding: 4px 10px;
border: none;
border-radius: 5px;
cursor: pointer;" type="submit" class="tab3" id="button" value="删除" onClick="{if(confirm('您确定要删除该记录吗?')){this.document.selform.submit();return true;}return false;}">
        </td>
      </tr>
      </form>
	  
      <?php
			}
		}
	  ?>

                    	<tr>
                        	<th colspan="10">
                            
                            <a href="#"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                        
                    
                    </table>
                    </div>
                    
                    
                
                </div>
                
                
            </div>            
        </div>
	</section>
	<footer id="gFooter">
		
	</footer>
</div>
</body>
</html>