<!DOCTYPE html>
<?php
session_start();
date_default_timezone_set('PRC');
header("Content-Type: text/html;charset=utf-8");
include_once("../function.php");
include_once("../bonus.php");
include_once("../class/system_class.php");
// if($_SESSION['ID']==null){
//     echo "<script language=javascript>alert('您尚未登陆,请登陆后查看!.');window.location.href='../copyindex.php'</script>";
// }
$manager_id = $_GET['Manager_ID'];
if($manager_id != null){
	if($_SESSION['to_admin'] == null){
		alert("请勿非法操作!!!");
		return ;
	}
	if(checkID($manager_id)){alert("请勿非法操作!!!");return ;}
	$us=getMemberbyID($manager_id);
	$_SESSION['ID']=$us['id'];
	$_SESSION['nickname']=$us['nickname'];
	$_SESSION['username']=$us['username'];
	$_SESSION['userid']=$us['userid'];
	$_SESSION['isboss']=$us['isboss'];
	$_SESSION['sclogin']=$us['sclogin'];
	$_SESSION['bdid']=$us['bdid'];
	$_SESSION['isbd']=$us['isbd'];
	$_SESSION['bdlevel']=$us['bdlevel'];
}

$sys=getOne("select * from systemparameters where id=1");
$information=que_select_cl('information',1);
$_system=new system_class();

$member = getMemberbyID($_SESSION['ID']);
 if($member==null){
     echo "<script language=javascript>alert('您尚未登陆,请登陆后查看!.');window.location.href='../copyindex.php'</script>";
 }

//var_dump($_SESSION['ID']);
$ul = ulevel($member['ulevel']);
$zjul = zjulevel($member['zjulevel']);
if ($zjul==null){
    $zjname='无';
}else {
    $zjname=$zjul['zjname'];
}

$all=getall("select id from member where reid={$member['id']} and ispay>0 and islock=0");//会员资料
$nk=count($all);


?>
<?php
//获取当前ip
$us=getMemberbyID($_SESSION['ID']);
function ip(){
    
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {  
		$ip = getenv('HTTP_CLIENT_IP');
	 } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {  $ip = getenv('HTTP_X_FORWARDED_FOR');
	  } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {  $ip = getenv('REMOTE_ADDR'); 
	  } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {  $ip = $_SERVER['REMOTE_ADDR']; 
	  } return preg_match("/[\d\.]{7,15}/", $ip, $matches) ? $matches[0] : 'unknown';}
	  $ip=ip();
	  $us_update['ip']=$ip;
	  if($us['id']){
	      edit_update_cl('member',$us_update,$us['id']);
      }

      
	  ?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>首页</title>
<link rel="stylesheet" type="text/css" href="css/swiper.min.css">
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/content.css">
<script src="js/jquery.js"></script>
<script src="js/swiper.min.js"></script>
<script src="js/heightLine.js"></script>
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
<body style="background:#eee;">
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
  <?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
	  <div class="swiper-container">
            <div class="swiper-wrapper">
            	<?php
              	// $sql = "SELECT * FROM `lunbotu` WHERE 1=1 and isfb=1";
              	$sql = "SELECT * FROM `lunbotu` WHERE 1=1 and isfb=1";
            	if($query = mysql_query($sql)){
            	while ($row=mysql_fetch_array($query)){
                    $g= getOne("select id from goods where id={$row['goodid']}");
	            ?>
                <div class="swiper-slide">
                    <?php if($g){?>
                    <a href="show.php?goodid=<?=$row['goodid']?>"><img src="../upload/<?=$row['d2']?>" alt=""/></a>
                    <?php }else{?>
                    <img src="../upload/<?=$row['d2']?>" alt=""/>
                        <?php
                    }?>
                    
                </div>
                <?php 
            	}}
                ?>
            </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
    <script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true
    });
    </script>
    <?php 
    function xx($x,$y){
        switch ($x){
            case 1: $a=1;break;
            case 2: $a=2;break;
            case 3: $a=3;break;
            case 4: $a=4;break;
            case 5: $a=5;break;
            case 6: $a=6;break;
            case 7: $a=7;break;
            case 8: $a=8;break;
        }
        $a1=getOne("select name,img from leibie where lx={$a} and isdisplay=1 order by date desc limit 1");
        if($y==1){
            echo $a1['name'];
        }else{
            echo $a1['img'];
        }   
    }

    ?>
    <div id="gNavi">
    	<ul class="clearfix">
<!--        	<li>
            	<a href="shopping.php?lx=1">
                	<span>
                    	<img src="../upload/<?php xx(1,0)?>" height="512" width="512" alt=""/>
                    </span>
       <?php xx(1,1)?>
                </a>
            </li>-->
            
<?php $lxx=getAll("select lx from leibie where isdisplay=1 order by lx");    
foreach ($lxx as $k =>$r){
    $g=getAll("select id from goods where lx={$r['lx']} and isdisplay=1 ");
    if($g){?>
<!--<li>
            	<a href="shopping.php?lx=<?=$r['lx']?>">
                	<span>
                    	<img src="../upload/<?php xx($r['lx'],0)?>" alt=""/>
                    </span>
       <?php xx($r['lx'],1)?>
                </a>
            </li>-->
  <?php  
}}?>
        	
<!--        	<li>
            	<a href="shopping.php?lx=3">
                	<span>
                		<img src="../upload/<?php xx(3,0)?>" alt=""/>
                    </span>
       <?php xx(3,1)?>
                </a>
            </li>
         	<li>
            	<a href="shopping.php?lx=4">
                	<span>
                		<img src="../upload/<?php xx(4,0)?>" alt=""/>
                    </span>
 	  <?php xx(4,1)?>
                </a>
            </li>

        	<li>
            	<a href="shopping.php?lx=5">
                	<span>
                		<img src="../upload/<?php xx(5,0)?>" alt=""/>
                    </span>
	  <?php xx(5,1)?>
                </a>
            </li>
        	<li>
            	<a href="shopping.php?lx=6">
                	<span>
                		<img src="../upload/<?php xx(6,0)?>" alt=""/>
                    </span>
	 <?php xx(6,1)?>
                </a>
            </li>-->
        </ul>
    </div>
    <div class="sBox">
    <div class="sec1">
<!--    		<h2 style="
                font-size:30px;
                color:#FFA500;
/*                background-color : blue;*/
                text-shadow : rgba(255,255,255,0.5) 0 5px 6px, rgba(255,255,255,0.2) 1px 3px 3px;
                -webkit-background-clip : text;"><?=$name = leiname(1);  ?>
            </h2>-->
        <div class="secBox">
        	<ul class="clearfix">
            
            	
     <?php 
    // $shou=getOne("select * from goods where lx=1 order by gdate desc limit 1");
    $arr=getAll("select * from goods where lx=1 and isdisplay=1 order by gdate desc");
    // $shou2=getOne("select * from goods where lx=1 order by gdate desc limit 1,1");
    if($arr){
        foreach($arr as $key=>$shou){
            $jiage=0;
            $jiage=$ul['yl1'];
//            switch ($member['ulevel']){
//                case 1:    $jiage=$shou['price'];      break;
//                case 2:    $jiage=$shou['price1'];      break;
//                case 3:    $jiage=$shou['price2'];      break;
//                case 4:    $jiage=$shou['price3'];      break;
//                case 5:    $jiage=$shou['price4'];      break;
//                case 6:    $jiage=$shou['price5'];      break;
//                case 7:    $jiage=$shou['price6'];      break;
//                case 8:    $jiage=$shou['price7'];      break;
//            }
            ?>
                <li>
                	<a href="show.php?goodid=<?=$shou['id']?>">
                        <div class="heightLine-1">
                            <img src="../upload/<?=$shou['goodsimg']?>" alt=""/>
                        </div> 
                        <div class="text">
                            <br>
                        	<h3><?=$shou['goodsname']?></h3>
                            <p>A积分价格:<span>￥<?=$shou['shichangjia']?></span></p>
                            <p>C积分价格:<span>￥<?=$shou['price']?></span></p>
                        </div>
                    </a>
                </li>
            
    <?php
        }
    }
    ?>
    </ul>
        </div>
    </div>
    
   
    
    <?php 
    $arr1=getAll("select * from goods where lx=2 and isdisplay=1 order by gdate desc");
    // $nan2=getOne("select * from goods where lx=2 order by gdate desc limit 1,1");
    if($arr1){ ?>
            <div class="sec1">
            <h2 style="
                font-size:30px;
                text-align:center;
                color:#FFA500;
/*                background-color : blue;*/
                text-shadow : rgba(255,255,255,0.5) 0 5px 6px, rgba(255,255,255,0.2) 1px 3px 3px;
                -webkit-background-clip : text;">
                <?=$name = leiname(2);  ?>
            </h2>
            <div class="secBox">
                <ul class="clearfix">         
        <?php foreach($arr1 as $key=>$nan){
            $jiage=0;
            switch ($member['ulevel']){
                case 1:    $jiage=$nan['price'];      break;
                case 2:    $jiage=$nan['price1'];      break;
                case 3:    $jiage=$nan['price2'];      break;
                case 4:    $jiage=$nan['price3'];      break;
                case 5:    $jiage=$nan['price4'];      break;
                case 6:    $jiage=$nan['price5'];      break;
                case 7:    $jiage=$nan['price6'];      break;
                case 8:    $jiage=$nan['price7'];      break;
                case 9:    $jiage=$nan['price8'];      break;
            }
//            if($member==null){
//                $jiage=$nan['price'];
//            }
    ?>
           
                    <li>
                        <a href="show.php?goodid=<?=$nan['id']?>">
                        <div class='heightLine-28'>
                    <img src="../upload/<?=$nan['goodsimg']?>" alt=""/>
                  </div>
                            <div class="text">
                                <br>
                                <h3><?=$nan['goodsname']?></h3>
                                <p>A积分价格:<span>￥<?=$nan['shichangjia']?></span></p>
                               <p>C积分价格:<span>￥<?=$shou['price']?></span></p>
                              </div>
                        </a>
                        <input type="button" id="xs<?=$nan['id']?>"  class="butt2" style=" display: none;  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                   <!--<?php if($nan['lx']<>1){?>
                                <?php if(getOne("select id from buycar where goodid={$nan['id']} and uid=".$_SESSION['ID']."")==null){?>
                                           <input type="button" id="yc<?=$nan['id']?>" value="加入购物车" style=" border: 0;background-color: #ff6633;color: #ffffff" onClick="gwc('<?=$nan['id']?>');"/>
                                            <?php }else{?>
                                           <input type="button" class="butt2" style="  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                                <?php }?>
                                <?php }?>-->
                    </li>
    <?php 
            } ?>  
             
                </ul>
            </div>
        </div>       
      <?php    }
    ?>  

   
    
    

    <?php 
        $arr2=getAll("select * from goods where lx=3 and isdisplay=1 order by gdate desc");
        // $nv2=getOne("select * from goods where lx=3 order by gdate desc limit 1,1");
        if($arr2){ ?>
               <div class="sec1">
    	 
    <h2 style="
                text-align:center;
                font-size:30px;
                color:#FFA500;
/*                background-color : blue;*/
                text-shadow : rgba(255,255,255,0.5) 0 5px 6px, rgba(255,255,255,0.2) 1px 3px 3px;
                -webkit-background-clip : text;"><?=$name = leiname(3); ?>
            </h2>	
            <div class="secBox">
                <ul class="clearfix">     
            <?php  foreach($arr2 as $key => $nv){
              $jiage=0;
            switch ($member['ulevel']){
                case 1:    $jiage=$nv['price'];      break;
                case 2:    $jiage=$nv['price1'];      break;
                case 3:    $jiage=$nv['price2'];      break;
                case 4:    $jiage=$nv['price3'];      break;
                case 5:    $jiage=$nv['price4'];      break;
                case 6:    $jiage=$nv['price5'];      break;
                case 7:    $jiage=$nv['price6'];      break;
                case 8:    $jiage=$nv['price7'];      break;
                case 9:    $jiage=$nv['price8'];      break;
            }
            if($member==null){
                $jiage=$nv['price'];
            }

    ?>

            	<li>
                	<a href="show.php?goodid=<?=$nv['id']?>">
                    <div class='heightLine-19'>
                    <img src="../upload/<?=$nv['goodsimg']?>" alt=""/>
                  </div>
                        <div class="text">
                            <br>
                         	<h3><?=$nv['goodsname']?></h3>
                            <p>A积分价格:<span><s>￥<?=$nv['shichangjia']?></s></span></p>
                            <p>C积分价格:<span>￥<?=$jiage?></span></p>
                        </div>
                    </a>
                    <input type="button" id="xs<?=$nv['id']?>"  class="butt2" style=" display: none;  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                   <!--<?php if($nv['lx']<>1){?>
                                <?php if(getOne("select id from buycar where goodid={$nv['id']} and uid=".$_SESSION['ID']."")==null){?>
                                           <input type="button" id="yc<?=$nv['id']?>" value="加入购物车" style=" border: 0;background-color: #ff6633;color: #ffffff" onClick="gwc('<?=$nv['id']?>');"/>
                                            <?php }else{?>
                                           <input type="button" class="butt2" style="  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                                <?php }?>
                                <?php }?>-->
                </li>
    <?php 
            }?>
               </ul>
        </div>

    </div>  
     <?php    }
    ?>  
           

    
 
   
  <?php 
    $arr3=getAll("select * from goods where lx=4 and isdisplay=1 order by gdate desc");
    // $ss42=getOne("select * from goods where lx=4 order by gdate desc limit 1,1");
    if($arr3){?>
        <div class="sec1">
 <h2 style="
        font-size:30px;
        text-align:center;
        color:#FFA500;
        background-color : blue;
        text-shadow : rgba(255,255,255,0.5) 0 5px 6px, rgba(255,255,255,0.2) 1px 3px 3px;
        -webkit-background-clip : text;">
        <?=$name = leiname(4); ?>
    </h2>
<div class="secBox">
    <ul class="clearfix">
          <?php 
        foreach($arr3 as $key => $ss4){
           $jiage=0;
            switch ($member['ulevel']){
                case 1:    $jiage=$ss4['price'];      break;
                case 2:    $jiage=$ss4['price1'];      break;
                case 3:    $jiage=$ss4['price2'];      break;
                case 4:    $jiage=$ss4['price3'];      break;
                case 5:    $jiage=$ss4['price4'];      break;
                case 6:    $jiage=$ss4['price5'];      break;
                case 7:    $jiage=$ss4['price6'];      break;
                case 8:    $jiage=$ss4['price7'];      break;
                case 9:    $jiage=$ss4['price8'];      break;
            }
            if($member==null){
                $jiage=$ss4['price'];
            }

    ?>

            <li>
                <a href="show.php?goodid=<?=$ss4['id']?>">
                <div class='heightLine-20'>
                    <img src="../upload/<?=$ss4['goodsimg']?>" alt=""/>
                  </div>
                    <div class="text">
                        <br>
                        <h3><?=$ss4['goodsname']?></h3>
                    
                        <p>A积分价格:<span><s>￥<?=$ss4['shichangjia']?></s></span></p>
                            <p>C积分价格:<span>￥<?=$jiage?></span></p>
                
                    </div>
                </a>
                <input type="button" id="xs<?=$ss4['id']?>"  class="butt2" style=" display: none;  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                   <!--<?php if($ss4['lx']<>1){?>
                                <?php if(getOne("select id from buycar where goodid={$ss4['id']} and uid=".$_SESSION['ID']."")==null){?>
                                           <input type="button" id="yc<?=$ss4['id']?>" value="加入购物车" style=" border: 0;background-color: #ff6633;color: #ffffff" onClick="gwc('<?=$ss4['id']?>');"/>
                                            <?php }else{?>
                                           <input type="button" class="butt2" style="  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                                <?php }?>
                                <?php }?>-->
            </li>
    <?php 
            } ?> 
            
        </ul>
    </div>

</div>
      <?php   }
    ?>  

    

  
  <?php 
    $arr4=getAll("select * from goods where lx=5 and isdisplay=1 order by gdate desc");
    // $ss52=getOne("select * from goods where lx=5 order by gdate desc limit 1,1");
    if($arr4){
        ?>
         <div class="sec1">
<h2 style="
        font-size:30px;
        text-align:center;
        color:#FFA500;
        background-color : blue;
        text-shadow : rgba(255,255,255,0.5) 0 5px 6px, rgba(255,255,255,0.2) 1px 3px 3px;
        -webkit-background-clip : text;">
        <?=$name = leiname(5); ?>
    </h2>
<div class="secBox">
    <ul class="clearfix">
       
            <?php
        foreach($arr4 as $key=>$ss5){
            $jiage=0;
            switch ($member['ulevel']){
                case 1:    $jiage=$ss5['price'];      break;
                case 2:    $jiage=$ss5['price1'];      break;
                case 3:    $jiage=$ss5['price2'];      break;
                case 4:    $jiage=$ss5['price3'];      break;
                case 5:    $jiage=$ss5['price4'];      break;
                case 6:    $jiage=$ss5['price5'];      break;
                case 7:    $jiage=$ss5['price6'];      break;
                case 8:    $jiage=$ss5['price7'];      break;
                case 9:    $jiage=$ss5['price8'];      break;
            }
//            if($member==null){
//                $jiage=$ss5['price'];
//            }

    ?>

            <li>
                <form method="post" action="?">
                <a href="show.php?goodid=<?=$ss5['id']?>">
                  <div class='heightLine-21'>
                      
                    <img src="../upload/<?=$ss5['goodsimg']?>" alt=""/>
                     
                  </div>
                    
                    <div class="text">
                        <br>
                        <h3><?=$ss5['goodsname']?></h3>
                    
                    
                            <p>A积分价格:<span><s>￥<?=$ss5['shichangjia']?></s></span></p>
                            <p>C积分价格:<span>￥<?=$jiage?></span></p>
                    </div>
                 </a>
                    <input type="button" id="xs<?=$ss5['id']?>"  class="butt2" style=" display: none;  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                 <!--  <?php if($ss5['lx']<>1){?>
                                <?php if(getOne("select id from buycar where goodid={$ss5['id']} and uid=".$_SESSION['ID']."")==null){?>
                                           <input type="button" id="yc<?=$ss5['id']?>" value="加入购物车" style=" border: 0;background-color: #ff6633;color: #ffffff" onClick="gwc('<?=$ss5['id']?>');"/>
                                            <?php }else{?>
                                           <input type="button" class="butt2" style="  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                                <?php }?>
                                <?php }?>-->
                </form>
            </li>
    <?php 
            }?>
             </ul>
    </div>

</div>
       <?php }
    ?>  

       
    


  
  <?php 
    $arr5=getAll("select * from goods where lx=6 and isdisplay=1 order by gdate desc");
    // $ss62=getOne("select * from goods where lx=6 order by gdate desc limit 1,1");
    if($arr5){ ?>
        <div class="sec1">
<h2 style="
    font-size:30px;
    text-align:center;
    color:#FFA500;
    background-color : blue;
    text-shadow : rgba(255,255,255,0.5) 0 5px 6px, rgba(255,255,255,0.2) 1px 3px 3px;
    -webkit-background-clip : text;">
    <?=$name = leiname(6); ?>
</h2>  
    <div class="secBox">
        <ul class="clearfix">  <?php
        foreach($arr5 as $key=>$ss6){
            $jiage=0;
            switch ($member['ulevel']){
                case 1:    $jiage=$ss6['price'];      break;
                case 2:    $jiage=$ss6['price1'];      break;
                case 3:    $jiage=$ss6['price2'];      break;
                case 4:    $jiage=$ss6['price3'];      break;
                case 5:    $jiage=$ss6['price4'];      break;
                case 6:    $jiage=$ss6['price5'];      break;
                case 7:    $jiage=$ss6['price6'];      break;
                case 8:    $jiage=$ss6['price7'];      break;
                case 9:    $jiage=$ss6['price8'];      break;
            }
            if($member==null){
                $jiage=$ss6['price'];
            }
    ?>

            <li>
                <a href="show.php?goodid=<?=$ss6['id']?>">
                <div class='heightLine-22'>
                    <img src="../upload/<?=$ss6['goodsimg']?>" alt=""/>
                  </div>
                    <div class="text">
                        <br>
                        <h3><?=$ss6['goodsname']?></h3>
                    
                    
                            <p>A积分价格:<span><s>￥<?=$ss6['shichangjia']?></s></span></p>
                            <p>C积分价格:<span>￥<?=$jiage?></span></p>
                    </div>
                </a>
                <input type="button" id="xs<?=$ss6['id']?>"  class="butt2" style=" display: none;  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

            <!--       <?php if($ss6['lx']<>1){?>
                                <?php if(getOne("select id from buycar where goodid={$ss6['id']} and uid=".$_SESSION['ID']."")==null){?>
                                           <input type="button" id="yc<?=$ss6['id']?>" value="加入购物车" style=" border: 0;background-color: #ff6633;color: #ffffff" onClick="gwc('<?=$ss6['id']?>');"/>
                                            <?php }else{?>
                                           <input type="button" class="butt2" style="  border: 0;background-color: #009933;color: #ffffff" value="已加入购物车" />

                                <?php }?>
                                <?php }?>-->
            </li>
            <?php 
        }?>
              </ul>
    </div>

</div>
            <?php 
    }
    ?> 
      
     
    


    
    
    
    
    
  

    </div>
    
	</section>
    
    <!-- #BeginLibraryItem "/Library/footer.lbi" -->
    <?php include 'footer.php';?>
    	<p  class="bq">商城</p>
    <script>
		$(function(){
    		$("#gFooter li:nth-child(1)").addClass("on")
			
		})
    </script>
    </div>
</body>
</html>