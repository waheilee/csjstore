<!DOCTYPE html>
<?php
include_once("../function.php");
session_start();
$member=getMemberbyID($_SESSION['ID']);
if ($_GET['nid']!=NULL){
    $news=que_select_cl('news',$_GET['nid']);
    if($news){
        edit_sql("update isnews set n{$news['id']}=1 where uid={$member['id']}");
    }
}else{
    echo"<script>alert('您输入有误，正在返回列表');history.go(-1);</script>";
    //echo "<script language=javascript>alert('您输入有误，正在返回列表');window.location.href='message.php?".$page."'</script>";
    exit;
}
if(!$news){
    echo"<script>alert('您输入有误，正在返回列表');history.go(-1);</script>";
    //echo "<script language=javascript>alert('您输入有误，正在返回列表');window.location.href='message.php?".$page."'</script>";
    exit;
}


?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>公告详情</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/show.css">
<link rel="stylesheet" href="css/tuijian.css">
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
    	<?php include 'header.php';?>
    
    </header><!-- #EndLibraryItem --><section id="main">
   	  <div class="mainBox">
            
            <!-- <div class="table2">
                <form action="" method="post">
                    <table>
                    	<tr>
                        	<td>
                            	<strong>平台操作流程</strong>
                            </td>
                        </tr>
                        <tr>
                            <td>时间： </td>
                        </tr>
                    </table>
                 </form>
            </div>
             -->
            
            <div class="table3">
            	<h2><?=$news['newstitle']?></h2>
                <div class="box">
       				<?=$news['newstime']?>
       				<?=$news['newscontent']?>
                </div>
                  <div  style="display: inline-block;padding: 2px;color: #fff;background: #4bbdf2;border-radius: 3px;">
                    <a href="scgg.php">返回列表</a>
                 </div>
            </div>
            
            
        </div>
    <br/><br/><br/><br/><br/>
    </section><?php include 'footer.php';?>
</body>
</html>