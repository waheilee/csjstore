<!DOCTYPE html>
<?php
include("check.php");
include_once("../function.php");

session_start();
$member=getMemberbyID($_SESSION['ID']);
if($member==null){
     echo "<script language=javascript>alert('您尚未登陆,请登陆后查看!.');window.location.href='../copyindex.php'</script>";
 }
if ($_POST['Search']){
    $SearchContent=$_POST['SearchContent'];
    if ($SearchContent!=NULL){
        #搜索新闻标题
        $_SESSION['Search']=" and newstitle like '%".$SearchContent."%' ";
    }else{
        $_SESSION['Search']=NULL;
    }
}else{
    if ($_GET['page']==NULL){
        $_SESSION['Search']=NULL;
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
<title>新闻公告</title>
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
                	
                    	<td>标题</td>
                    	<td>时间</td>
                        <td>状态</td>
                    	<td>操作</td>
                    </tr>
                     <?php
                                $pagesize = 15; //设置每页记录数
                                $sql = "SELECT * FROM `news` WHERE isedit=1 ".$_SESSION['Search']." ";
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
                                $_SESSION['messagepage']=$p;
                                $start = $pagesize * ($p - 1); //计算起始记录
                                $sql = "SELECT * FROM `news` WHERE isedit=1 ".$_SESSION['Search']." order by id desc limit ".$start.",".$pagesize;
                                if($query = mysql_query($sql)){
                                    $ne= getOne("select * from isnews where uid={$member['id']}");
                                    while ($row=mysql_fetch_array($query)){
                                ?>
                    <tr>
                    	<td><?=$row['newstitle']?></td>
                    	<td><?=$row['newstime']?></td>
                        <td><?php if($ne["n".$row['id']]==1){?><p style="color:green">已读</p><?php }else{?><p style="color:red">未读</p><?php }?></td>
                    	<td><a href="ggxq.php?nid=<?=$row['id']?>">详情</a></td>
                    </tr>
                    <?php }}?>
                </table>
            </div>
        </div>
        <br/><br/><br/>
        <br/><br/><br/>
    
    </section>
    <?php include 'footer.php';?>
    <script>
		$(function(){
    		$("#gFooter li:nth-child(3)").addClass("on")
			
		})
    </script>
</body>
</html>