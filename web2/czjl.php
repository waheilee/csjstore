<!DOCTYPE html>
<?php
include_once ("check.php");
include("check2.php");
include_once("../function.php");
include_once("../bonus.php");
header("Content-Type: text/html;charset=utf-8");
session_start();

// $ID=$_GET['ID'];
// if ($ID=="")
$ID=$_SESSION['ID'];
$member = getMemberbyID($_SESSION['ID']);
// $cx="&ID=".$ID."";
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>充值记录</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/send.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
 <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
    	<div class="mainBox">
            <form action="" method="post">
            	<div class="table">
                	<table>
                    	<tr>
                        	  <td align="center" class="two">时间</td>
                                <td align="center">类型</td>
                                <td align="center">会员</td>
                                <td align="center">金额</td>
                                <td align="center" class="two">审核状态</td>

                        </tr>
                        <?php
                            $pagesize = 20; //设置每页记录数
                            $sql = "SELECT id FROM `chongzhi` WHERE uid=".$_SESSION['ID']."";
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
                            $sql = "SELECT * FROM `chongzhi` WHERE uid=".$_SESSION['ID']." order by id desc limit ".$start.",".$pagesize;
                            if($query = mysql_query($sql)){
                                while ($row=mysql_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <?php
                                        switch ($row['lx']){
                                            case 1:
                                                $lx="A积分";
                                                break;
                                        }
                                        switch ($row['isgrant']){
                                            case 1:
                                                $isgrant="已处理";
                                                break;
                                            case 0:
                                                $isgrant="<font color='#FF0000'>未处理</font>";
                                                break;
                                        }
                                        ?>
                                        <td align="center" class="two"><?=$row['cdate']?></td>
                                        <td align="center"><?=$lx?></td>
                                        <td align="center"><?=$row['nickname']?></td>
                                        <td align="center" ><?=$row['jine']?></td>
                                        <td align="center" class="two"><?=$isgrant?></td>

                                    </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                <tr>
                                    <td align="center" colspan="5">暂无内容</td>
                                </tr>
                            <?php } ?>
                                 <tr>
                                    <td align="center" colspan="5"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
                                </tr>
                    </table>
                </div>
            
            
            </form>
           
        </div>
    <br/> <br/> <br/>
    </section><?php include 'footer.php';?>
</body>
</html>