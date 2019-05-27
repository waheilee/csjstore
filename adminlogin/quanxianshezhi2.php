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
			$_SESSION['Search']="and bankname like '%".$SearchContent."%'";
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
            $bank_update['bankname']=$_POST['bankname'];
            $bank_update['shunxu']=$_POST['shunxu'];
            $bank_update['date']=now();
            edit_update_cl('bankname',$bank_update,$_POST['id']);     
            alert('修改成功.','?');
	}else{
		alert('设置出错,修改失败.','?');	
	}
}

if($_POST['button2']){
	if($_POST['id']){
            edit_delete_cl('bankname',$_POST['id']);
            alert('删除成功.','?');
	}else{
		alert('设置出错,提交失败.','?');	
	}
}



if($_POST['button4']){
	if($_POST['bankname']){
		$_admin=new admin_class();
		if($_admin->getbankname($_POST['bankname'])){
			alert('该银行已存在.','?');
		}else{
			$bank_update['bankname']=$_POST['bankname'];
                        $bank_update['date']=now();
                        $bank_update['shunxu']=$_POST['shunxu'];
                        add_insert_cl('bankname',$bank_update);
			alert('添加成功.','?');
		}
	}else{
		alert('请输入银行名称.','?');	
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
<title>银行列表</title>
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
            <option value="1">关键字</option>
          </select>
                        <input type="text" value="" name="SearchContent" id="SearchContent"/>
                        <input type="submit" value="搜索" name="Search" id="Search"/>
                    
                   
                </div>
                
                <div class="list">
                	<span>新增银行</span>
                   <span class="span">新增银行名称：<input type="text" value="" name="bankname" id="bankname"/> 
                  显示顺序：<input type="text" value="" name="shunxu" id="shunxu"/></span>  
                    <input type="submit" value="添加" name="button4" id="button4"/>
                    </form>
                
                </div>
                
                <div class="table2">
                	<table>
                    	<tr>
       <td ></td>
        <td align="center">银行名称</td>
        <td align="center">显示顺序</td>
        <td align="center">操作</td>
    </tr>
	<?php
	  	$pagesize = 20; //设置每页记录数 
	  	$sql = "SELECT * FROM `bankname` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
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
      	$sql = "SELECT * FROM `bankname` WHERE 1=1 ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by shunxu desc limit ".$start.",".$pagesize;
		if($query = mysql_query($sql)){
		while ($row=mysql_fetch_array($query)){
	  ?>
	  <form name="form1" method="post" action="?">
                    	<tr>
        <td align="center"><input name="id" type="hidden" value="<?=$row['id']?>"></td>
        <td  align="center"><input name="bankname" type="text" value="<?=$row['bankname']?>"></td>
        <td align="center"><input name="shunxu" type="text" value="<?=$row['shunxu']?>"></td>
        
        <td align="center"><input name="button1" type="submit" class="btn2" id="button1" value="修改">
        <input name="button2" type="submit" class="btn3" id="button2" value="删除">
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