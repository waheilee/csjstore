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
<title>奖励总表</title>
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
                            	<td align="center">结算时间</td>
                            	<td align="center"><?=$bonus1name?></td>
                                <td><?=$bonus2name?></td>
                               	<td><?=$bonus3name?></td>
                                <td><?=$bonus4name?></td>
                                <td><?=$bonus5name?></td>
                                <td><?=$bonus6name?></td>
                                <td><?=$bonus7name?></td>
                                <td><?=$bonus8name?></td>
                          <!--      <td><?=$bonus9name?></td>-->
                                <td><?=$bonus0name?></td>
                            </tr>
                            <?php
                            $pagesize = 15; //设置每页记录数
                            $sql = "SELECT id FROM `bonus` WHERE uid=".$_SESSION['ID']."";
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
                            $sql = "SELECT * FROM `bonus` WHERE uid=".$_SESSION['ID']." order by bdate desc limit ".$start.",".$pagesize;
                            if($query = mysql_query($sql)){
                            while ($row=mysql_fetch_array($query)){
                            ?>
                                <tr>
                                    <td   align="center"><?=date("Y-m-d H:i:s",strtotime($row['bdate']))?></td>

                                    <td  align="center"><?=$row['b1']?></td>
                                    <td  ><?=$row['b2']?></td> 
                                    <td  ><?=$row['b3']?></td>
                                    <td  ><?=$row['b4']?></td>
                                    <td  ><?=$row['b5']?></td>
                                    <td  ><?=$row['b6']?></td>
                            	    <td  ><?=$row['b7']?></td>
                                    <td  ><?=$row['b8']?></td>
<!--                               	    <td  ><?=$row['b9']?></td>-->
                                    <td  ><?=$row['b0']?></td>
                                </tr>
                                <?php
                            }
                            }
                            $sql1="SELECT sum(b0),sum(b1),sum(b2),sum(b3),sum(b4),sum(b5),sum(b6),sum(b7),sum(b8),sum(b9),sum(b10),sum(b11) FROM `bonus` WHERE uid=".$_SESSION['ID']."";
                            if($query=mysql_query($sql1)){
                                $zj=mysql_fetch_array($query);
                            }
                            //                    /var_dump($zj);exit;
                            ?>
                            <tr>
                                <td  align="center" class="two">总  计</td>

                                <td align="center" ><?=$zj[1]?></td>
                                <td  ><?=$zj[2]?></td>
                                <td  ><?=$zj[3]?></td>
                                <td  ><?=$zj[4]?></td>
                                <td  ><?=$zj[5]?></td>
                                <td  ><?=$zj[6]?></td>
                                <td  ><?=$zj[7]?></td>
                                <td  ><?=$zj[8]?></td>
           <!--                     <td  ><?=$zj[9]?></td>-->
                                
                                <td  ><?=$zj[0]?></td>
                            </tr>
                           <tr>
                                    <td align="center" colspan="11"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
                                </tr>
                        
                        </table>
                </div>
            
            
            </form>
           
        </div>
    <br/> <br/> <br/>
    </section><?php include 'footer.php';?>
</body>
</html>