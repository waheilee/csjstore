<!DOCTYPE html>
<?php
include("function.php");
header("Content-Type: text/html;charset=utf-8");
session_start();
unset($_SESSION['ID']); 
unset($_SESSION['NickName']); 
unset($_SESSION['UserID']); 
unset($_SESSION['isboss']);
unset($_SESSION['pass']);

if ($_POST['loginnow'] == "loginnow"){
    if($_POST['txtUserAccount'] == null){
        echo "<script language=javascript>alert('请填写用户名!.');window.location.href='copyindex.php'</script>";
        return;
    }
       if($_POST['txtValidCode'] == $_SESSION['code']){
          
    if(systemstatus()){
      
        if (checkLogin($_POST['txtUserAccount'],$_POST['txtPassword'])){
            
            $us=getMemberbyNickName($_POST['txtUserAccount']);
            
            if ($us['islock']==0){
                $_SESSION['ID']=$us['id'];
                $_SESSION['nickname']=$us['nickname'];
                $_SESSION['isboss']=$us['isboss'];
                $_SESSION['sclogin']=$us['sclogin'];
                $_SESSION['bclogin']=now();
                $member_update['sclogin']=now();
                edit_update_cl('member',$member_update,$us['id']);
                echo "<script language=javascript>window.location.href='./web2/index.php'</script>";
            }else{
                echo "<script language=javascript>alert('您已被管理员锁定,无法登陆,请联系管理员.');window.location.href='copyindex.php'</script>";
            }
        }else{
            $us2=getMemberbyNickName($_POST['txtUserAccount']);
            if($us2['slock']==5){
                edit_sql("update `member` set islock=1 where id=".$us2['id']."");   
                echo "<script language=javascript>alert('密码错误次数过多!您已经被锁定!请联系管理员解决!.');window.location.href='copyindex.php'</script>";
                return;
            }
            edit_sql("update `member` set slock=slock+1 where id=".$us2['id']."");   
           
            echo "<script language=javascript>alert('用户名或密码错误.');window.location.href='copyindex.php'</script>";
            return;
        }
    }else{
        echo "<script language=javascript>alert('系统维护,暂时关闭,给您带来不便我们感到万分抱歉.');window.location.href='copyindex.php'</script>";
    }
        }else{
            echo "<script language=javascript>alert('验证码错误.');window.location.href='copyindex.php'</script>";
        }
}else{
    $_SESSION['ID']=null;
    $_SESSION['nickname']=null;
    $_SESSION['userid']=null;
    $_SESSION['isboss']=null;
    $_SESSION['pass2']=null;
    $_SESSION['pass3']=null;
    $_SESSION['bdname']=null;
    $_SESSION['bdid']=null;
    
}
echo "<script language=javascript>window.location.href='copyindex.php'</script>";
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>首页</title>
<link rel="stylesheet" type="text/css" href="web2/css/swiper.min.css">
<link rel="stylesheet" href="web2/css/common.css">
<link rel="stylesheet" href="web2/css/content.css">
<script src="web2/js/jquery.js"></script>
<script src="web2/js/swiper.min.js"></script>
<script src="web2/js/heightLine.js"></script>
<script src="web2/js/index.js"></script>
<script>
	function CheckForm(){
		txtUserAccount=document.form.txtUserAccount.value;
		txtPassword=document.form.txtPassword.value;
		txtValidCode=document.form.txtValidCode.value;
		if(txtUserAccount.length == 0){
			 alert("温馨提示:\n请输入会员编号.");		
			document.form.txtUserAccount.focus();
			return false;
		}
		if(txtPassword.length == 0){
			 alert("温馨提示:\n请输入登录密码.");
			document.form.txtPassword.focus();
			return false;
		}
		if(txtValidCode.length == 0){
			alert("温馨提示:\n请输入验证码.");
			document.form.txtValidCode.focus();
			return false;
		}
		return true;
	}
	</script>
</head>
<body style="background:#eee;">
<div id="container"><!-- #BeginLibraryItem "/Library/header.lbi" --><header id="gHeader"> 
  <div class="logo">
<a href="#">
<img src="web2/images/logo.png" alt=""/>98剪纸商城
</a>
</div>
<span class="return">
<a href="copyindex.php">
<img src="web2/images/icon1.png" alt=""/>
</a>
</span>
    </header><!-- #EndLibraryItem --><section id="main">
	  <div class="swiper-container">
          <div class="swiper-wrapper">
            	<?php
              	$sql = "SELECT * FROM `lunbotu` WHERE 1=1 and isfb=1";
              	$sql = "SELECT * FROM `lunbotu` WHERE 1=1 and isfb=1";
            	if($query = mysql_query($sql)){
            	while ($row=mysql_fetch_array($query)){
	            ?>
                <div class="swiper-slide">
                    <img src="upload/<?=$row['d2']?>" alt=""/>
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
        	<li>
            	<a href="shopping.php?lx=1">
                	<span>
                    	<img src="../upload/<?php xx(1,0)?>" height="512" width="512" alt=""/>
                    </span>
       <?php xx(1,1)?>
                </a>
            </li>
            
        	<li>
            	<a href="shopping.php?lx=2">
                	<span>
                    	<img src="../upload/<?php xx(2,0)?>" alt=""/>
                    </span>
       <?php xx(2,1)?>
                </a>
            </li>
        	<li>
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
            </li>
        </ul>
    </div>
    <div class="sBox">
    <div class="sec1">
    		<h2 style="
                font-size:30px;
                color:#FFA500;
                background-color : blue;
                text-shadow : rgba(255,255,255,0.5) 0 5px 6px, rgba(255,255,255,0.2) 1px 3px 3px;
                -webkit-background-clip : text;"><?=$name = leiname(1);  ?>
            </h2>
        <div class="secBox">
        	<ul class="clearfix">
            
            	
     <?php 
    // $shou=getOne("select * from goods where lx=1 order by gdate desc limit 1");
    $arr=getAll("select * from goods where lx=1 and isdisplay=1 order by gdate desc");
    // $shou2=getOne("select * from goods where lx=1 order by gdate desc limit 1,1");
    if($arr){
        foreach($arr as $key=>$shou){
            $jiage=0;
            switch ($member['ulevel']){
                case 0:   $jiage=$shou['shichangjia']; break;
                case 1:   $jiage=$shou['price']; break;
                case 2:   $jiage=$shou['price2']; break;
                case 3:   $jiage=$shou['price3']; break;
                case 4:   $jiage=$shou['price4']; break;
                case 5:   $jiage=$shou['price5']; break;
                case 6:   $jiage=$shou['price6']; break;
                case 7:   $jiage=$shou['price7']; break;  
            }
            ?>

                <li>
                	<a href="shopping.php?lx=1">
                        <div class="heightLine-1">
                            <img src="../upload/<?=$shou['goodsimg']?>" alt=""/>
                        </div> 
                        <div class="text">
                        	<h3><?=$shou['goodsname']?></h3>
                 
					        <?php if($sys['shichangjia']==1){?>   
					            <p class="unde">市场价:<span>￥<?=$shou['shichangjia']*1.00?></span></p>
					        <?php }?>
                            

                            <p>会员价:<span>￥<?=$jiage?></span></p>
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
    
    <div class="sec1">
            <h2 style="
                font-size:30px;
                text-align:center;
                color:#FFA500;
                background-color : blue;
                text-shadow : rgba(255,255,255,0.5) 0 5px 6px, rgba(255,255,255,0.2) 1px 3px 3px;
                -webkit-background-clip : text;">
                <?=$name = leiname(2);  ?>
            </h2>
            <div class="secBox">
                <ul class="clearfix">
    
    <?php 
    $arr1=getAll("select * from goods where lx=2 and isdisplay=1 order by gdate desc");
    // $nan2=getOne("select * from goods where lx=2 order by gdate desc limit 1,1");
    if($arr1){
        foreach($arr1 as $key=>$nan){
            $jiage=0;
            switch ($member['ulevel']){
                case 0:   $jiage=$nan['shichangjia']; break;
                case 1:    $jiage=$nan['price'];           break;
                case 2:    $jiage=$nan['price2'];          break;
                case 3:   $jiage=$nan['price3'];           break;
                case 4:    $jiage=$nan['price4'];          break;
                case 5:  $jiage=$nan['price5'];           break;
                case 6:   $jiage=$nan['price6'];          break;
                case 7:   $jiage=$nan['price7'];           break;  
            }
    ?>
           
                    <li class="heightLine-2">
                        <a href="shopping.php?lx=2">
                        
                            <img src="../upload/<?=$nan['goodsimg']?>" alt=""/>
                            <div class="text">
                          
                                <h3><?=$nan['goodsname']?></h3>
                        <?php if($sys['shichangjia']==1){?>
                                <p class="unde">市场价:<span>￥<?=$nan['shichangjia']*1?></span></p>
                                <?php }?>
                                <p>会员价:<span>￥<?=$jiage?></span></p>
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

   
    
    <div class="sec1">
    	 
    <h2 style="
                text-align:center;
                font-size:30px;
                color:#FFA500;
                background-color : blue;
                text-shadow : rgba(255,255,255,0.5) 0 5px 6px, rgba(255,255,255,0.2) 1px 3px 3px;
                -webkit-background-clip : text;"><?=$name = leiname(3); ?>
            </h2>	
            <div class="secBox">
                <ul class="clearfix">

    <?php 
        $arr2=getAll("select * from goods where lx=3 and isdisplay=1 order by gdate desc");
        // $nv2=getOne("select * from goods where lx=3 order by gdate desc limit 1,1");
        if($arr2){
            foreach($arr2 as $key => $nv){
                $jiage=0;
                switch ($member['ulevel']){
                    case 0:   $jiage=$nv['shichangjia'];  break;
                    case 1:  $jiage=$nv['price'];            break;
                    case 2:   $jiage=$nv['price2'];           break;
                    case 3:   $jiage=$nv['price3'];           break;
                    case 4:  $jiage=$nv['price4'];           break;
                    case 5:   $jiage=$nv['price5'];           break;
                    case 6:   $jiage=$nv['price6'];           break;
                    case 7:   $jiage=$nv['price7'];            break;  
                }

    ?>

            	<li class="heightLine-3">
                	<a href="shopping.php?lx=3">
                    	<img src="../upload/<?=$nv['goodsimg']?>" alt=""/>
                        <div class="text">
                      
                         	<h3><?=$nv['goodsname']?></h3>
                        	<?php if($sys['shichangjia']==1){?>   
                        	    <p class="unde">市场价:<span>￥<?=$nv['shichangjia']*1?></span></p>
                        	    <?php }?>
                            <p>会员价:<span>￥<?=$jiage?></span></p>
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
    $arr3=getAll("select * from goods where lx=4 and isdisplay=1 order by gdate desc");
    // $ss42=getOne("select * from goods where lx=4 order by gdate desc limit 1,1");
    if($arr3){
        foreach($arr3 as $key => $ss4){
            $jiage=0;
            switch ($member['ulevel']){
                case 0:   $jiage=$ss4['shichangjia'];  break;
                case 1:   $jiage=$ss4['price'];              break;
                case 2:   $jiage=$ss4['price2'];           break;
                case 3:   $jiage=$ss4['price3'];            break;
                case 4:   $jiage=$ss4['price4'];         break;
                case 5:   $jiage=$ss4['price5'];          break;
                case 6:   $jiage=$ss4['price6'];           break;
                case 7:   $jiage=$ss4['price7'];           break;  
            }

    ?>

            <li class="heightLine-4">
                <a href="shopping.php?lx=4">
                    <img src="../upload/<?=$ss4['goodsimg']?>" alt=""/>
                    <div class="text">
                
                        <h3><?=$ss4['goodsname']?></h3>
                    
                    
                        <?php if($sys['shichangjia']==1){?>   
                            <p class="unde">市场价:<span>￥<?=$ss4['shichangjia']*1?></span></p>
                            <?php }?>
                    
                    
                        <p>会员价:<span>￥<?=$jiage?></span></p>
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
    $arr4=getAll("select * from goods where lx=5 and isdisplay=1 order by gdate desc");
    // $ss52=getOne("select * from goods where lx=5 order by gdate desc limit 1,1");
    if($arr4){
        foreach($arr4 as $key=>$ss5){
            $jiage=0;
            switch ($member['ulevel']){
                case 0:   $jiage=$ss5['shichangjia'];   break;
                case 1:   $jiage=$ss5['price'];           break;
                case 2:   $jiage=$ss5['price2'];          break;
                case 3:   $jiage=$ss5['price3'];          break;
                case 4:   $jiage=$ss5['price4'];          break;
                case 5:   $jiage=$ss5['price5'];          break;
                case 6:   $jiage=$ss5['price6'];          break;
                case 7:   $jiage=$ss5['price7'];          break;  
            }

    ?>

            <li class="heightLine-5">
                <a href="shopping.php?lx=5">
                    <img src="../upload/<?=$ss5['goodsimg']?>" alt=""/>
                    <div class="text">
                
                        <h3><?=$ss5['goodsname']?></h3>
                    
                    
                        <?php if($sys['shichangjia']==1){?>   
                            <p class="unde">市场价:<span>￥<?=$ss5['shichangjia']*1?></span></p>
                            <?php }?>
                    
                    
                        <p>会员价:<span>￥<?=$jiage?></span></p>
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
        <ul class="clearfix">  

  
  <?php 
    $arr5=getAll("select * from goods where lx=6 and isdisplay=1 order by gdate desc");
    // $ss62=getOne("select * from goods where lx=6 order by gdate desc limit 1,1");
    if($arr5){
        foreach($arr5 as $key=>$ss6){
            $jiage=0;
            switch ($member['ulevel']){
                case 0:   $jiage=$ss6['shichangjia'];   break;
                case 1:   $jiage=$ss6['price'];         break;
                case 2:   $jiage=$ss6['price2'];        break;
                case 3:   $jiage=$ss6['price3'];        break;
                case 4:   $jiage=$ss6['price4'];        break;
                case 5:   $jiage=$ss6['price5'];        break;
                case 6:   $jiage=$ss6['price6'];        break;
                case 7:   $jiage=$ss6['price7'];        break;  
            }
    ?>

            <li class="heightLine-6">
                <a href="shopping.php?lx=6">
                    <img src="../upload/<?=$ss6['goodsimg']?>" alt=""/>
                    <div class="text">
                
                        <h3><?=$ss6['goodsname']?></h3>
                    
                    
                        <?php if($sys['shichangjia']==1){?>   
                            <p class="unde">市场价:<span>￥<?=$ss6['shichangjia']*1?></span></p>
                            <?php }?>
                    
                    
                        <p>会员价:<span>￥<?=$jiage?></span></p>
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
     
    


    
    
    
    
    
  

    </div>

    

    
	</section>
    
    <p  class="bq">乐佰佳优品购</p><!-- #BeginLibraryItem "/Library/footer.lbi" -->
   <footer id="gFooter">
<ul class="clearfix">

<li>
<a href="web2/index.php">
<b><img src="web2/images/icon17.png" alt=""/></b>
商城
</a>
</li>
<li>
<a href="web2/shopping1.php?kg=1">
<b><img src="web2/images/icon16.png" alt=""/></b>
分类
</a>
</li>

<li>
<a href="web2/shopcart.php">
<b><img src="web2/images/icon19.png" alt=""/></b>
购物车
</a>
</li>
<li>
<a href="web2/zhanghu.php">
<b><img src="web2/images/icon18.png" alt=""/></b>
账户
</a>
</li>
</ul>
</footer>
    	
    <script>
		$(function(){
    		$("#gFooter li:nth-child(1)").addClass("on")
			
		})
    </script>
    </div>
</body>
</html>