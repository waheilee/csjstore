<!DOCTYPE html>
<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");

//include("check.php");
date_default_timezone_set('PRC');
$lx=$_GET['lx'];

$member=getMemberbyID($_SESSION['ID']);
#搜索商品
if ($_POST['Search']){

    $SearchContent=$_POST['SearchContent'];
    //var_dump($_POST);exit;
    if ($SearchContent!=NULL){
//        $SearchType=$_POST['SearchType'];
//        if ($SearchType==1){
        #搜索商品名称
        $_SESSION['Search']=" and goodsname like '%".$SearchContent."%' ";
        //}
    }else{
        $_SESSION['Search']=NULL;
    }
}else{
    if ($_GET['page']==NULL){
        $_SESSION['Search']=NULL;
        $_SESSION['SearchTime']=NULL;
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
<title>继续购物</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/shopping.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
	<?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
    	<div class="mainBox">
        	<ul class="list1 clearfix">
            	<li class="on"><a href="#">默认</a></li>

   
            </ul>
            
            <div class="table">
            	<table>
                	
                    		<?php 
                    		$pagesize = 20; //设置每页记录数
                    		$sql = "SELECT id FROM `goods` WHERE isdisplay=1 and lx=$lx ".$_SESSION['Search']." ".$_SESSION['SearchTime']."";
                    		
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
                    		        $sql = "SELECT * FROM `goods` WHERE isdisplay=1 and lx=$lx ".$_SESSION['Search']." ".$_SESSION['SearchTime']." order by shunxu,id limit ".$start.",".$pagesize;
                    		        $arr=getAll($sql);
                    		        foreach ($arr as $key =>$row){
                    		            if($row['goodsimg']){
                    		                $img="../upload/".$row['goodsimg'];
                    		            }else{
                    		                $img="img/shop/pho.jpg";
                    		            }
                    		           
                    		            if($member['ulevel']==null){$jia=$row['price'];}
                    		           elseif($member['ulevel']==1){$jia=$row['price'];}
                    		           elseif($member['ulevel']==2){$jia=$row['price1'];}
                    		           elseif($member['ulevel']==3){$jia=$row['price5'];}
                    		           elseif($member['ulevel']==4){$jia=$row['price3'];}
                    		           elseif($member['ulevel']==5){$jia=$row['price4'];}
                    		           elseif($member['ulevel']==6){$jia=$row['price5'];}
                    		           elseif($member['ulevel']==7){$jia=$row['price6'];}
                                       elseif($member['ulevel']==8){$jia=$row['price7'];}
                    		            ?>
                  <tr>
                    	<td>
                        	<a href="show.php?goodid=<?=$row['id']?>">
                                <img src="<?=$img?>" alt=""/>
                                <div class="text">
                                
                                    <h3><?=$row['goodsname']?></h3>
                                    <p>零售价:<s>￥<?=$row['shichangjia']?></s></p>
									<p>   价格:¥<?=$jia?>  <br> 

                                       </p>
                                </div>
                            </a>
                            </td>
                    </tr>
                             <?php }?>
                        
                </table>
            
            </div>
            
            
            <div class="page">
            	<a href="#" class="pre">←上一页</a>
            	<a href="#" class="next">→下一页</a>
            </div>
            
            
        </div>
    <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>
    </section>
    <?php include 'footer.php';?>
    
    <script>
		$(function(){
    		$("#gFooter li:nth-child(2)").addClass("on")
			
		})
    </script>
    </div>
</body>
</html>