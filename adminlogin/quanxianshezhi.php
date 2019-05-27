<?php
include("admin_check.php");
include_once("../class/admin_class.php");
session_start();
header("Content-Type: text/html;charset=utf-8");

if ($_POST['Search']){
    $SearchContent=$_POST['SearchContent'];
    if ($SearchContent!=NULL){
        $SearchType=$_POST['SearchType'];
        if ($SearchType==1){
            #搜索会员编号
            $_SESSION['Search']="and loginname='".$SearchContent."'";
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

if($_POST['button1']){
    if($_POST['id']){
        if($_POST['loginpass']){
            $_admin=new admin_class();
            $admin_update['loginpass']=md5($_POST['loginpass']);
            $_admin->admin_update($admin_update,$_POST['id']);
            alert('修改成功.','?');
        }else{
            alert('请输入管理员密码.','?');
        }
    }else{
        alert('设置出错,提交失败.','?');
    }
}

if($_POST['button2']){
    if($_POST['id']){
        if($_POST['id']==1){
            alert('删除失败,超级管理员不能删除.','?');
        }else{
            $_admin=new admin_class();
            $_admin->admin_delete($_POST['id']);
            alert('删除成功.','?');
        }
    }else{
        alert('设置出错,提交失败.','?');
    }
}

if($_POST['button3']){
    if($_POST['id']){
        if($_POST['id']==1){
            alert('超级管理员拥有最高权限,无需设置.','?');
        }else{
            $_SESSION['admin_id']=$_POST['id'];
            $str = "<script type='text/javascript'>";
            $str.="window.location.href='xiugaiquanxina.php';";
            echo $str.='</script>';
        }
    }else{
        alert('设置出错,提交失败.','?');
    }
}

if($_POST['button4']){
    if($_POST['loginname'] and $_POST['loginpass']){
        $_admin=new admin_class();
        if($_admin->getadminbyname($_POST['loginname'])){
            alert('管理员帐号已存在.','?');
        }else{
            $insert['loginname']=$_POST['loginname'];
            $insert['loginpass']=md5($_POST['loginpass']);
            $_admin->admin_insert($insert);
            alert('添加成功.','?');
        }
    }else{
        alert('请输入管理员帐号密码.','?');
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
<title>权限设置</title>
<link rel="stylesheet" type="text/css" href="css/default.css">
<link rel="stylesheet" type="text/css" href="css/common/layout.css">
<link rel="stylesheet" type="text/css" href="css/common/general.css">
<link rel="stylesheet" type="text/css" href="css/content.css">
<link rel="stylesheet" type="text/css" href="css/xitongshezhi.css">
<script src="js/jquery.js"></script>
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
<div id="conts" cl ass="heightLine-1">
            <!-- #BeginLibraryItem "/Library/title.lbi" -->
             <?php include 'title.php';?>
            <!-- #EndLibraryItem -->
<div class="mainBox">
            	<div class="top">
                	<form name="form1" method="post" action="?">
                    	<select name="SearchType" id="SearchType">
            <option value="1">管理员帐号</option>
          </select>
                        <input type="text" value="" name="SearchContent" id="SearchContent"/>
                        <input type="submit" value="搜索" name="Search" id="Search"/>
                    
                    
                    <div class="text">
                    	<p>管理员列表</p>
                    </div>
                </div>
                
                <div class="list">
                	<span>新增管理员</span>
                   <span class="span">管理员账号：<input type="text" value="" name="loginname" id="loginname"/></span> 
                    <span class="span">管理员密码：<input type="password" value="" name="loginpass"/></span>
                    <input type="submit" value="添加" name="button4" id="button4"/>
                    </form>
                
                </div>
                
                <div class="table2">
                	<table>
                    	<tr>
        <td align="center">管理员帐号</td>
        <td align="center">管理员密码</td>
        <td align="center">最近登录</td>
        <td colspan="2" align="center">操作</td>
    </tr>
	<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `to_admin` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `to_admin` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by id desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
	  <form name="form1" method="post" action="?">
                    	<tr>
        <td align="center"><input name="id" type="hidden" value="<?=$row['id']?>"><?=$row['loginname']?></td>
        <td  align="center"><input name="loginpass" type="password" value="" size="10" maxlength="20"></td>
        <td align="center"><?=$row['logindate']?></td>
        <td colspan="2" align="center"><input name="button1" type="submit" class="btn2" id="button1" value="修改">           
        <input name="button2" type="submit" class="btn3" id="button2" value="删除">
        <input name="button3" type="submit" class="btn1" id="button3" value="权限设置"> 
        </td>
        </tr></form>
		<?php
			}
		}
	  ?>
                    	<tr>
                        	<th colspan="4"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></th>
                        </tr>
                    </table>
                </div>
                
            </div>
        </div>
    </section>
</div>
</body>
</html>