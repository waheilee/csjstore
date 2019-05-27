<!DOCTYPE html>
<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
include_once("../function.php");
include_once("../class/member_class.php");
include_once("../class/bonus_class.php");

// include("check.php");
date_default_timezone_set('PRC');
$cc=$_GET['cc'];
$kg=$_GET['kg'];
$member=getMemberbyID($_SESSION['ID']);

if($member==null){
    echo "<script language=javascript>alert('您尚未登陆,请登陆后查看!.');window.location.href='../copyindex.php'</script>";
}
$ul=ulevel($member['ulevel']);
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
<title>购物商城</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/shopping.css">
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
<script>
    function gwc(id){
//        alert(id);
        $.ajax({
            type: "POST",
            url : "ajax.php",
            datatype : 'json',
            data: {'gwc':id} ,
            success :function (data) {
                document.getElementById('xs'+id).style.display="block";
                document.getElementById('yc'+id).style.display="none";
         }
       });
    }
</script> 
</head>
<body>
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
	<?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
    	<div class="mainBox">
        	<ul class="list1 clearfix">
        	
        	<?php 
        	if($kg==1){
        	    $kaiguan1='on';
        	}elseif($kg==2){
        	    $kaiguan2='on';
        	}elseif($kg==3){
        	    $kaiguan3='on';
        	}elseif($kg==4){
        	    $kaiguan4='on';
        	}elseif($kg==5){
        	    $kaiguan5='on';
        	} 
        	?>
            	<li class="<?=$kaiguan1?>"><a href="shopping1.php?cc=9&kg=1">默认</a></li>
            	<li class="<?=$kaiguan2?>"><a href="shopping1.php?cc=2&kg=2">价格</a></li>
            	<li class="<?=$kaiguan3?>"><a href="shopping1.php?cc=1&kg=3">人气</a></li>
           <!-- <li class="<?=$kaiguan4?>"><a href="shopping1.php?cc=3&kg=4">库存</a></li>
               	  --> 	
            </ul>
            
            <div class="table">
            	<table>
                	
                    		<?php 
                    		if($cc==1){
                    		    $xx='order by cis desc';
                    		}elseif($cc==2){
                    		    $xx='order by price desc';
                    		}elseif($cc==3){
                    		    $xx=' order by sales desc';
                    		}else{
                    		    $xx=' ';
                    		}
                    		$pagesize = 20; //设置每页记录数
                    		$sql = "SELECT * FROM `goods` where isdisplay=1 and lx>0 $xx" ;
                    		
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
                    		        $sql = "SELECT * FROM `goods` where isdisplay=1 and lx>0 $xx";
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
                                       elseif($member['ulevel']==9){$jia=$row['price8'];}
                                       
                                       if($row['lx']==1){
                                           $jia=$ul['yl1'];
                                       }
                    		  ?>
                  <!-- 
                                                    <h3><?=$row['goodsname']?></h3>
                                    <p><strong style="color:#0084EB; font-size:20px;">
                                    特惠券<?=$row['price2']?>&nbsp;  现金<?=$row['price']?></strong> 
                                    <span style="display:inline-block">购物券<?=$row['price2']?></span> <br> 
                                   		 支付方式:特惠券/现金                                </p>                                    
                                 -->
         			 <tr>
                    	<td>
                        	<a href="show.php?goodid=<?=$row['id']?>">
                                <img src="<?=$img?>" alt=""/>
								<h3><?=$row['goodsname']?></h3>
                                    <p>零售价<s>￥<?=$row['shichangjia']?></s><br><strong style="color:#0084EB; font-size:18px;">
									
                                   	现价:￥<?=$jia?> 
                                    </strong>
                                    <span style="display:inline-block"></span> </p>
                                     <!-- <p class="p1">支付：现金 -->
                           
                                     
                                     
                                     <!-- </p> -->
                            </a>
                            <input type="button" id="xs<?=$row['id']?>"  class="butt2" style=" display: none;  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                            <?php if($row['lx']<>1){?>
                                <?php if(getOne("select id from buycar where goodid={$row['id']} and uid=".$_SESSION['ID']."")==null){?>
                                           <input type="button" id="yc<?=$row['id']?>" value="加入购物车" style=" border: 0;background-color: #ff6633;color: #ffffff" onClick="gwc('<?=$row['id']?>');"/>
                                            <?php }else{?>
                                           <input type="button" class="butt2" style="  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                                <?php }?>
                                <?php }?>
                          <?php }?>
                         
                        </td>
                    </tr>
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