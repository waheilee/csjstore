<!DOCTYPE html>
<?php
include("check.php");
include("check2.php");
include_once("../function.php");
include_once("../class/system_class.php");

if ($_GET['action']=="admin"){
	$ID=$_GET['ID'];
}else{
	$_system=new system_class();
	
	
	if ($_POST['submin']){
		if ($chaus=getMemberbyNickName($_POST['nickname'])){
			if(checkisppath($_SESSION['ID'],$chaus['id'])){
				$ID=$chaus['id'];
			}else{
				echo "<script language=javascript>alert('您的网络中不存在该成员.');window.location.href='?'</script>";		
			}
		}else{
			echo "<script language=javascript>alert('您的网络中不存在该成员.');window.location.href='?'</script>";	
		}
	}else{
		if ($_GET['ID'] == null){
			$ID=$_SESSION['ID'];
		}else if($_GET['ID'] == $_SESSION['ID']){ 
			$ID=$_SESSION['ID'];
		}else{
			if(checkisppath($_SESSION['ID'],$_GET['ID'])){
				$ID=$_GET['ID'];
			}else{
				echo "<script language=javascript>alert('您的网络中不存在该成员.');window.location.href='?'</script>";		
			}
		}	
	}
}

$us=getMemberbyID($ID);
if ($us['ulevel']==0) {
	$ispay="#BFEFFF";
	$nopay="#CFCFCF";
	$nore="#A3CDF8";
		
}elseif ($us['ulevel']==1){
	$ispay="#D15FEE";
	$nopay="#CFCFCF";
	$nore="#A3CDF8";
}elseif ($us['ulevel']==2){
	$ispay="#9AFF9A";
	$nopay="#CFCFCF";
	$nore="#A3CDF8";
}elseif ($us['ulevel']==3){
	$ispay="#7A67EE";
	$nopay="#CFCFCF";
	$nore="#A3CDF8";
}elseif ($us['ulevel']==4){
    $ispay="#00BFFF";
    $nopay="#CFCFCF";
    $nore="#A3CDF8";
}

	
	session_start();
	
	$UserID=$us['userid'];
	$NickName=$us['nickname'];
	$UserName=$us['username'];
	$uLevel=$us['ulevel'];
	$area1=$us['area1'];
	$area2=$us['area2'];
	$yarea1=$us['yarea1'];
	$yarea2=$us['yarea2'];
	
	$username=$us['username'];
	$ul=ulevel($uLevel);
	$jibie=$ul['lvname'];
	if ($us['ispay']==0){
		$usispaycolor=$nopay;	
	}else{
		$usispaycolor=$ispay;		
	}
	//A区
	if ($p1=getFatherManbyFidAndTreeplace($ID,1)){
		$p1NickName="<a href='?ID=".$p1['id']."'>"."<font color=black>".$p1['nickname']."</font>"."</a>";
		$ul=ulevel($p1['ulevel']);
		$p1jibie=$ul['lvname'];
		
		$p1username=$p1['username'];
		$p1area1=$p1['area1'];
		$p1area2=$p1['area2'];
		$p1yarea1=$p1['yarea1'];
		$p1yarea2=$p1['yarea2'];
		if ($p1['ispay']==0){
			$p1ispaycolor=$nopay;	
		}else{
			if ($p1['ulevel']==0) {
				$ispay="#BFEFFF";
			}elseif ($p1['ulevel']==1){
				$ispay="#D15FEE";
			}elseif ($p1['ulevel']==2){
				$ispay="#9AFF9A";
			}elseif ($p1['ulevel']==3){
				$ispay="#7A67EE";
			}elseif ($p1['ulevel']==4){
			    $ispay="#00BFFF";
			}
			$p1ispaycolor=$ispay;		
		}
	}else{
		$p1NickName="<font color=black>注册</font>";
		$p1jibie="空位";
		$p1area1=0;
		$p1area2=0;
		$p1yarea1=0;
		$p1yarea2=0;
	}
	//AA区
	if ($p11=getFatherManbyFidAndTreeplace($p1['id'],1)){
		$p11NickName="<a href='?ID=".$p11['id']."'>"."<font color=black>".$p11['nickname']."</font>"."</a>";
		$ul=ulevel($p11['ulevel']);
		$p11jibie=$ul['lvname'];	
		$p11username=$p11['username'];
		$p11area1=$p11['area1'];
		$p11area2=$p11['area2'];
		$p11yarea1=$p11['yarea1'];
		$p11yarea2=$p11['yarea2'];
		if ($p11['ispay']==0){
			$p11ispaycolor=$nopay;	
		}else{
			if ($p11['ulevel']==0) {
				$ispay="#BFEFFF";
			}elseif ($p11['ulevel']==1){
			    $ispay="#D15FEE";
			}elseif ($p11['ulevel']==2){
			    $ispay="#9AFF9A";
			}elseif ($p11['ulevel']==3){
			    $ispay="#7A67EE";
			}elseif ($p11['ulevel']==4){
			    $ispay="#00BFFF";
			}
			$p11ispaycolor=$ispay;		
		}
	}else{
		if ($p1['id']==null){
			$p11NickName="注册";	
		}
		$p11jibie="空位";
		$p11area1=0;
		$p11area2=0;
		$p11yarea1=0;
		$p11yarea2=0;
	}
	//AB区
	if ($p12=getFatherManbyFidAndTreeplace($p1['id'],2)){
		$p12NickName="<a href='?ID=".$p12['id']."'>"."<font color=black>".$p12['nickname']."</font>"."</a>";
		$ul=ulevel($p12['ulevel']);
		$p12jibie=$ul['lvname'];
		
		$p12username=$p12['username'];
		$p12area1=$p12['area1'];
		$p12area2=$p12['area2'];
		$p12yarea1=$p12['yarea1'];
		$p12yarea2=$p12['yarea2'];
		if ($p12['ispay']==0){
			$p12ispaycolor=$nopay;	
		}else{
		    if ($p12['ulevel']==0) {
		        $ispay="#BFEFFF";
		    }elseif ($p12['ulevel']==1){
		        $ispay="#D15FEE";
		    }elseif ($p12['ulevel']==2){
		        $ispay="#9AFF9A";
		    }elseif ($p12['ulevel']==3){
		        $ispay="#7A67EE";
		    }elseif ($p12['ulevel']==4){
		        $ispay="#00BFFF";
		    }
			$p12ispaycolor=$ispay;		
		}
	}else{
		if ($p1['id']==null){
			$p12NickName="注册";	
		}	
		$p12jibie="空位";
		$p12area1=0;
		$p12area2=0;
		$p12yarea1=0;
		$p12yarea2=0;
	}
	//B区
	if ($p2=getFatherManbyFidAndTreeplace($ID,2)){
		$p2NickName="<a href='?ID=".$p2['id']."'>"."<font color=black>".$p2['nickname']."</font>"."</a>";
		$ul=ulevel($p2['ulevel']);
		$p2jibie=$ul['lvname'];
	
		$p2username=$p2['username'];
		$p2area1=$p2['area1'];
		$p2area2=$p2['area2'];
		$p2yarea1=$p2['yarea1'];
		$p2yarea2=$p2['yarea2'];
		if ($p2['ispay']==0){
			$p2ispaycolor=$nopay;	
		}else{
		    if ($p2['ulevel']==0) {
		        $ispay="#BFEFFF";
		    }elseif ($p2['ulevel']==1){
		        $ispay="#D15FEE";
		    }elseif ($p2['ulevel']==2){
		        $ispay="#9AFF9A";
		    }elseif ($p2['ulevel']==3){
		        $ispay="#7A67EE";
		    }elseif ($p2['ulevel']==4){
		        $ispay="#00BFFF";
		    }
			$p2ispaycolor=$ispay;		
		}
	}else{
		$p2NickName="<font color=black>注册</font>";
		$p2jibie="空位";
		$p2area1=0;
		$p2area2=0;
		$p2yarea1=0;
		$p2yarea2=0;
	}
	//BA区
	if ($p21=getFatherManbyFidAndTreeplace($p2['id'],1)){
		$p21NickName="<a href='?ID=".$p21['id']."'>"."<font color=black>".$p21['nickname']."</font>"."</a>";
		$ul=ulevel($p21['ulevel']);
		$p21jibie=$ul['lvname'];
		
		$p21username=$p21['username'];
		$p21area1=$p21['area1'];
		$p21area2=$p21['area2'];
		$p21yarea1=$p21['yarea1'];
		$p21yarea2=$p21['yarea2'];
		if ($p21['ispay']==0){
			$p21ispaycolor=$nopay;	
		}else{
		    if ($p21['ulevel']==0) {
		        $ispay="#BFEFFF";
		    }elseif ($p21['ulevel']==1){
		        $ispay="#D15FEE";
		    }elseif ($p21['ulevel']==2){
		        $ispay="#9AFF9A";
		    }elseif ($p21['ulevel']==3){
		        $ispay="#7A67EE";
		    }elseif ($p21['ulevel']==4){
		        $ispay="#00BFFF";
		    }
			$p21ispaycolor=$ispay;		
		}
	}else{
		if ($p2['id']==null){
			$p21NickName="注册";	
		}
		$p21jibie="空位";
		$p21area1=0;
		$p21area2=0;
		$p21yarea1=0;
		$p21yarea2=0;
	}
	//BB区
	if ($p22=getFatherManbyFidAndTreeplace($p2['id'],2)){
		$p22NickName="<a href='?ID=".$p22['id']."'>"."<font color=black>".$p22['nickname']."</font>"."</a>";
		$ul=ulevel($p22['ulevel']);
		$p22jibie=$ul['lvname'];
	
		$p22username=$p22['username'];
		$p22area1=$p22['area1'];
		$p22area2=$p22['area2'];
		$p22yarea1=$p22['yarea1'];
		$p22yarea2=$p22['yarea2'];
		if ($p22['ispay']==0){
			$p22ispaycolor=$nopay;	
		}else{
		    if ($p22['ulevel']==0) {
		        $ispay="#BFEFFF";
		    }elseif ($p22['ulevel']==1){
		        $ispay="#D15FEE";
		    }elseif ($p22['ulevel']==2){
		        $ispay="#9AFF9A";
		    }elseif ($p22['ulevel']==3){
		        $ispay="#7A67EE";
		    }elseif ($p22['ulevel']==4){
		        $ispay="#00BFFF";
		    }
			$p22ispaycolor=$ispay;		
		}
	}else{
		if ($p2['id']==null){
			$p22NickName="注册";	
		}
		$p22jibie="空位";
		$p22area1=0;
		$p22area2=0;
		$p22yarea1=0;
		$p22yarea2=0;
	}
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>会员详情</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/jbxx.css">
<link rel="stylesheet" href="css/wlt.css">
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	<?php include 'header.php';?>
    </header><!-- #EndLibraryItem -->
    
    
    <section id="main">
   		<div class="mainbox">
            <form action="" method="post" class="form1 clearfix">
            	<select>
                	<option>会员编号</option>
                </select>
                <input type="text" value="搜索相关数据" name="sou"/>
                <input type="submit" value="搜索" name="suo"/>
            
            </form>
            <table class="table2">
            <?php if($_POST['dingbu']){
                                echo "<script>location.href='xpt.php'</script>"; }?>
                                <?php if($_POST['sahngyic']){
                                echo "<script>history.go(-1);</script>";}?>
								<form method="post">
								<?php if ($ID != $_SESSION['ID']){?><input type="submit"
								name="dingbu" style="background-color: #449d44;border-radius: 9px;color: #fff;width:80px;height:38px;" value="返回顶层">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button"
								 value="返回上一层" style="background-color: #e7175d;border-radius: 9px;width:100px;height:38px;color: #fff;"onclick="javascript:history.back(-1);">

	    <?php } ?></form>
            <!-- 
            	<tr>
                	<td>未激活</td>
                	<td>金卡会员</td>
                	<td>钻卡会员</td>
                </tr>
                 -->
            </table>
            <div class="pic">
            	<div class="pic_box">
            	<ul class="floor1">
                	<li>
                    	<table>
                        	<tr><td><b><?=$NickName?></b></td></tr>
                            <tr><td><?=$jibie?></td></tr>
                            <tr><td><?=$username?></td></tr>
                            <tr>
                            	<td>
                                	<table>
                                    	<tr>
                                        	<td></td>
                                        	<td>A区</td>
                                        	<td>B区</td>
                                        </tr>
                                    	<tr>
                                        	<td>总计</td>
                                        	<td><?=$area1?></td>
                                        	<td><?=$area2?></td>
                                        </tr>
                                    	<tr>
                                        	<td>结余</td>
                                        	<td><?=$yarea1?></td>
                                        	<td><?=$yarea2?></td>
                                        </tr>
                                        <!-- 
                                    	<tr>
                                        	<td>碰量</td>
                                        	<td>0.00</td>
                                        	<td>0.00</td>
                                        </tr>
                                    	<tr>
                                        	<td colspan="3" class="last">2017-10-31 12:49:35</td>
                                        </tr>
                                         -->
                                    </table>
                                </td>
                            </tr>
                        
                        </table>
                    </li>
                </ul>
                <ul class="floor2 floor1 clearfix">
                	<li>
                    	<table>
                        	<tr><td><b><?=$p1NickName ?></b></td></tr>
                            <tr><td><?=$p1jibie?></td></tr>
                            <tr><td><?=$p1username?></td></tr>
                            <tr>
                            	<td>
                                	<table>
                                    	<tr>
                                        	<td></td>
                                        	<td>A区</td>
                                        	<td>B区</td>
                                        </tr>
                                    	<tr>
                                        	<td>总计</td>
                                        	<td><?=$p1area1?></td>
                                        	<td><?=$p1area2?></td>
                                        </tr>
                                    	<tr>
                                        	<td>结余</td>
                                        	<td><?=$p1yarea1?></td>
                                        	<td><?=$p1yarea2?></td>
                                        </tr>
                                    	
                                    </table>
                                </td>
                            </tr>
                        
                        </table>
                    </li>
                	<li>
                    	<table>
                        	<tr><td><b><?=$p2NickName?></b></td></tr>
                            <tr><td><?=$p2jibie?></td></tr>
                            <tr><td><?=$p2username?></td></tr>
                            <tr>
                            	<td>
                                	<table>
                                    	<tr>
                                        	<td></td>
                                        	<td>A区</td>
                                        	<td>B区</td>
                                        </tr>
                                    	<tr>
                                        	<td>总计</td>
                                        	<td><?=$p2area1?></td>
                                        	<td><?=$p2area2?></td>
                                        </tr>
                                    	<tr>
                                        	<td>结余</td>
                                        	<td><?=$p2yarea1?></td>
                                        	<td><?=$p2yarea2?></td>
                                        </tr>
                                    	
                                    </table>
                                </td>
                            </tr>
                        
                        </table>
                    </li>
                
                </ul>
                <div class="floor clearfix">
                    <ul class="floor3 floor2 floor1 clearfix">
                        <li>
                            <table>
                                <tr><td><b><?=$p11NickName?></b></td></tr>
                                <tr><td><?=$p11jibie?></td></tr>
                                <tr><td><?=$p11username?></td></tr>
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td>A区</td>
                                                <td>B区</td>
                                            </tr>
                                            <tr>
                                                <td>总计</td>
                                                <td><?=$p11area1?></td>
                                                <td><?=$p11area2?></td>
                                            </tr>
                                            <tr>
                                                <td>结余</td>
                                                <td><?=$p11yarea1?></td>
                                                <td><?=$p11yarea2?></td>
                                            </tr>
                                            
                                        </table>
                                    </td>
                                </tr>
                            
                            </table>
                        </li>
                        <li>
                            <table>
                                <tr><td><b><?=$p12NickName?></b></td></tr>
                                <tr><td><?=$p12jibie?></td></tr>
                                <tr><td><?=$p12username?></td></tr>
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td>A区</td>
                                                <td>B区</td>
                                            </tr>
                                            <tr>
                                                <td>总计</td>
                                                <td><?=$p12area1?></td>
                                                <td><?=$p12area2?></td>
                                            </tr>
                                            <tr>
                                                <td>结余</td>
                                                <td><?=$p12yarea1?></td>
                                                <td><?=$p12yarea2?></td>
                                            </tr>
                                            
                                        </table>
                                    </td>
                                </tr>
                            
                            </table>
                        </li>
                    
                    </ul>
                    <ul class="floor3 floor2 floor1 clearfix">
                        <li>
                            <table>
                                <tr><td><b><?=$p21NickName?></b></td></tr>
                                <tr><td><?=$p21jibie?></td></tr>
                                <tr><td><?=$p21username?></td></tr>
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td>A区</td>
                                                <td>B区</td>
                                            </tr>
                                            <tr>
                                                <td>总计</td>
                                                <td><?=$p21area1?></td>
                                                <td><?=$p21area2?></td>
                                            </tr>
                                            <tr>
                                                <td>结余</td>
                                                <td><?=$p21yarea1?></td>
                                                <td><?=$p21yarea2?></td>
                                            </tr>
                                          
                                        </table>
                                    </td>
                                </tr>
                            
                            </table>
                        </li>
                        <li>
                        	
                        
                            <table>
                                <tr><td><b><?=$p22NickName?></b></td></tr>
                                <tr><td><?=$p22NickName?></td></tr>

                                <tr><td><?=$p22username?></td></tr>
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td>A区</td>
                                                <td>B区</td>
                                            </tr>
                                            <tr>
                                                <td>总计</td>
                                                <td><?=$p22area1?></td>
                                                <td><?=$p22area2?></td>
                                            </tr>
                                            <tr>
                                                <td>结余</td>
                                                <td><?=$p22yarea1?></td>
                                                <td><?=$p22yarea1?></td>
                                            </tr>
                                           
                                        </table>
                                    </td>
                                </tr>
                            
                            </table>
                        </li>
                    
                    </ul>
                </div>
                </div>
            </div>
        
        </div>  
      
      
        
        <br/><br/>
    </section><?php include 'footer.php';?>
</body>
</html>