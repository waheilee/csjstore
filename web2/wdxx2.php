<!DOCTYPE html>
<?php
include_once("../function.php");
session_start();
if ($_GET['mid']!=NULL){
    $news=que_select_cl('mail',$_GET['mid']);
}else{
    echo"<script>alert('您输入有误，返回列表');history.go(-1);</script>";
    //echo "<script language=javascript>alert('您输入有误，正在返回列表');window.location.href='message.php?".$page."'</script>";
    exit;
}
if(!$news){
    echo"<script>alert('您输入有误，返回列表');history.go(-1);</script>";
    //echo "<script language=javascript>alert('您输入有误，正在返回列表');window.location.href='message.php?".$page."'</script>";
    exit;
}else{
    $mail['isread']=1;
    edit_update_cl('mail',$mail,$_GET['mid']);
}
// var_dump($news);exit;
$member=getMemberbyID($_SESSION['ID']);
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
       
            <form action="" method="post">
            	<div class="table">
                	<table>
                    	 <h2><?=$news['title']?></h2>
                    <div class="comBox">
                        <form>
                            <div  class="left">
                                发件编号：<?=$news['nickname']?>
                            </div>
                        </form><br/>
                            <form>
                            <div  class="left">
                                发件时间：<?=$news['fdate']?>
                            </div>
                            </form>
                        <br/>
                            <form>
                            <div  class="left">
                                发件标题：<?=$news['title']?>
                            </div>
                            </form><br/>
                        <div class="table1">
                            发件内容：<?=$news['mailcontent']?>
                        </div>
                        <div class="table1">
                            回复内容：<?=$news['huifu']?>
                        </div>
                        <form>
                            <div  class="right">
                                <input  onClick="history.back(-1)" type="button" value="返回列表" />
                            </div>
                        </form>
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