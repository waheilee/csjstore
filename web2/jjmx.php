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
<title>奖励明细</title>
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
                        	<td align="center" class="two">结算时间</td>
                            	<!-- <td >类型</td> -->
                            	<td  align="center" >会员</td>
                            	<td  align="center" >相关会员</td>
                            	<td  align="center" class="two">摘要</td>
                            	<td align="center" >积分</td>
                        </tr>
                        <?php
                            $pagesize = 20; //设置每页记录数
                            $sql = "SELECT id FROM `bonuslaiyuan` WHERE uid=".$ID."";
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
                            $sql = "SELECT * FROM `bonuslaiyuan` WHERE uid=".$ID." order by id desc limit ".$start.",".$pagesize;
                            if($query = mysql_query($sql)){
                                while ($row=mysql_fetch_array($query)){
                                    ?>
                                    <tr>
                                        <?php
                                        switch ($row['lx']){
                                            case 1:
                                                $lx=$bonus1name;
                                                break;
                                            case 2:
                                                $lx=$bonus2name;
                                                break;
                                            case 3:
                                                $lx=$bonus3name;
                                                break;
                                            case 4:
                                                $lx=$bonus4name;
                                                break;
                                            case 5:
                                                $lx=$bonus5name;
                                                break;
                                            case 6:
                                                $lx=$bonus6name;
                                                break;
                                            case 7:
                                                $lx=$bonus7name;
                                                break;
                                            case 8:
                                                $lx=$bonus8name;
                                                break;
                                            case 9:
                                                $lx=$bonus9name;
                                                break;
                                            case 10:
                                                $lx=$bonus10name;
                                                break;
                                            case 11:
                                                $lx=$bonus11name;
                                                break;
                                            case 12:
                                                $lx=$bonus12name;
                                                break;
                                            case 13:
                                                $lx=$bonus13name;
                                                break;
                                        }
                                        ?>
                                        <td  align="center" class="two"><?=$row['bdate']?></td>
                                        <!-- <td ><?=$lx?></td> -->
                                        <td  align="center" ><?=$row['nickname']?></td>
                                        <td  align="center" ><?=$row['ynickname']?></td>
                                        <td  align="center" class="two"><?=$row['beizhu']?></td>
                                        <td align="center" ><?=$row['jine']?></td>

                                    </tr>
                                    <?php
                                }
                            }else{
                            ?>
                            <tr>
                            	<td  align="center" colspan="9">暂无内容</td>
                            </tr>
                           <?php } ?>
                            <tr>
                                    <td  align="center" colspan="5"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
                                </tr>
                    </table>
                </div>
            
            
            </form>
           
        </div>
    <br/> <br/> <br/>
    </section><?php include 'footer.php';?>
</body>
</html>