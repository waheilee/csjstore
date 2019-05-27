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
<title>我的推荐</title>
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
                    	<td>会员编号</td>
                    	<td>会员姓名</td>
                        <td>会员级别</td>
                        <td>职称级别</td>
                    	<td>激活时间</td>
<!--                        <td>累计销量</td>
                    	<td>季度销量</td>
                        <td>累计业绩</td>
                        <td>季度业绩</td>-->

<!--                    	<td>操作</td>-->
                    </tr>
                     <?php
                            
                            $pagesize = 20; //设置每页记录数
                            $sql = "SELECT id FROM `member` WHERE reid=".$ID." and ispay=1 ";
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
                            $sql = "SELECT * FROM `member` WHERE reid=".$ID." and ispay=1 order by pdt";
                            if(getOne($sql)){
                            if($query = mysql_query($sql)){
                               
                                   
                              
                                while ($row=mysql_fetch_array($query)){
                                    
                                    
                                
                                    $ul= getOne("select lvname from ulevel where ulevel={$row['ulevel']}");
                                    $zj= getOne("select zjname from zjulevel where ulevel={$row['zjulevel']}");
                                    ?>
                    <tr>
                    	<td><?=$row['nickname']?></td>
                    	<td><?=$row['username']?></td>
                    	<td><?=$ul['lvname']?></td>
                        <td><?=$zj['zjname']?></td>
                        <td><?=$row['pdt']?></td>
<!--                        <td><?=$row['dan2']?></td>
                        <td><?=$row['ydan2']?></td>
                        <td><?=$row['area2']?></td>
                        <td><?=$row['yarea2']?></td>-->
<!--                    	<td><a href="hyxq.php?id=<?=$row['id']?>">会员详情</a></td>-->
                    </tr>
                    <?php }
                     
                    }}else{?>
                            <tr>
                                    <td colspan="10">暂无内容</td>
                                </tr>
                            <?php } ?>
                                <tr>
                                <td align="center" colspan="10"><?php echo fenye($p,$pagesize,$sum,$total,$cx)?></td>
                            </tr>
                </table>
            </div>
        </div>
        <br/><br/><br/>
        <br/><br/><br/>
    
    </section>
            <?php include 'footer.php';?>
    
</body>
</html>