<!DOCTYPE html>
<?php
include("../member/check.php");
include_once("../function.php");
$information=que_select_cl('information',1);
session_start();

//var_dump($_POST);exit;
#搜索条件
if ($_POST['Search']){
    $SearchContent=$_POST['SearchContent'];
    $SearchType=$_POST['SearchType'];
    if ($SearchType==1){
        $_SESSION['SearchType']=" and isread=1 ";
    }elseif ($SearchType==2){
        $_SESSION['SearchType']=" and isread=0 ";
    }else{
        $_SESSION['SearchType']=NULL;
    }
    if ($SearchContent!=NULL){
            #搜索会员编号
            $_SESSION['Search']="and nickname='".$SearchContent."'";
    }else{
        $_SESSION['Search']=NULL;
    }
}else{
    if ($_GET['page']==NULL){
        $_SESSION['Search']=NULL;
        $_SESSION['SearchType']=NULL;
    }
}

#删除记录
if ($_POST['deleteall']){
    $cheuid_arr = $_POST['UID'];
    //var_dump($_POST);exit;
    foreach ((array)$cheuid_arr as $id)
    {
        $mail['issdelete']=1;
        edit_update_cl('mail',$mail,$id);
    }
    echo "<script language=javascript>alert('删除完成.');window.location.href='?'</script>";
}
#标记为已读记录
if ($_POST['readall']){
    $cheuid_arr = $_POST['UID'];
    //var_dump($_POST);exit;
    foreach ((array)$cheuid_arr as $id)
    {
        $mail['isread']=1;
        edit_update_cl('mail',$mail,$id);
    }
    echo "<script language=javascript>alert('标记完成.');window.location.href='?'</script>";
}
$member = getMemberbyID($_SESSION['ID']);
//var_dump($_SESSION['ID']);
$ul = ulevel($member['ulevel']);
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>收件箱</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/send.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container">
	  <header id="gHeader"> 
  <?php include 'header.php';?>
    </header>
    <section id="main">
    	<div class="mainBox">
        	<ul class="list6 clearfix">
            	<li class="on">
                	<a href="wdxx.php">收件箱</a>
                </li>
            	<li>
                	<a href="fajianxiang.php">发件箱</a>
                </li>
            	<li>
                	<a href="send.php">发送邮件</a>
                </li>
            </ul>
            <form action="" method="post">
            	<div class="table">
                	<table>
                    	<tr>
                        	<td class="two">状态</td>
                                	<td class="three">标题</td>
                                	<td class="three">发件人</td>
                                	<td class="two">操作</td>
                        </tr>
                        <?php
                                    $pagesize = 10; //设置每页记录数
                                    $sql = "SELECT * FROM `mail` WHERE sid=".$_SESSION['ID']." and issdelete=0 ".$_SESSION['Search']." ".$_SESSION['SearchType']."";
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
                                    $sql = "SELECT * FROM `mail` WHERE sid=".$_SESSION['ID']." and issdelete=0 ".$_SESSION['Search']." ".$_SESSION['SearchType']." order by fdate desc limit ".$start.",".$pagesize;
                                    if($query = mysql_query($sql)){
                                    while ($row=mysql_fetch_array($query)){
                                    ?>
                                <tr>
                                 
                                    <td class="two"><?php if ($row['isread']==0){?><font color="#FF0000">未读</font><?php }elseif($row['isread']==1){?>已读<?php }?></td>
                                    <td class="three"><?=$row['title']?></td>
                                    <td class="three"><?=$row['nickname']?></td>
                                    <td class="two"><input name="" type="button" class="btn" value="查  看" onClick="window.location.href='wdxx2.php?mid=<?=$row['id']?>&hf=1'"></td>
                                </tr>
                                        <?php
                                    }
                                    }else{
                                    ?>
                                <tr>
                                	<td colspan="5">暂无内容</td>
                                </tr>
                                    <?php } ?>
                    </table>
                </div>
            
            
            </form>
           
        </div>
    <br/> <br/> <br/>
    </section>
	<?php include 'footer.php';?>

</div>
</body>
</html>