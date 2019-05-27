<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="format-detection" content="telephone=no">
<meta name="keywords" content="">
<meta name="description" content="">
<title>会员夺宝</title>
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/shopping.css">
<script src="js/jquery.js"></script>
<script src="js/jquery.myProgress.js"></script>
<script src="js/index.js"></script>
</head>
<body>
<div id="container">
	
  <section id="main">
  <header id="gHeader"> 
    		<?php include 'header.php';?>
    </header><!-- #EndLibraryItem --><section id="main">
    	<div class="mainBox">
        	<ul class="list2 list1 clearfix">
            	<li class="on"><a href="hydb.html">会员夺宝</a></li>
            	<li><a href="zjgg.html">中奖公告</a></li>
            </ul>
			<div class="tab">
            	<ul class="clearfix">
                	<li>
                    	<div class="box">
                            <a href="#">
                                <img src="images/pho2.jpg" alt=""/>
                                <h4>苹果 iPhone 7 Plus  10元夺宝</h4>
                                <div class="progress-out" id="div1">
                                    <div class="percent-show"><span>0</span>%</div>
                                    <div class="progress-in"></div>
                                </div>
                                <p>1213<span>1213</span></p>
                            </a>
                            <a href="#" class="qg">立即抢购</a>
                        </div>
                    </li>
                	<li>
                    	<div class="box">
                            <a href="#">
                                <img src="images/pho2.jpg" alt=""/>
                                <h4>苹果 iPhone 7 Plus  10元夺宝</h4>
                                <div class="progress-out" id="div2">
                                    <div class="percent-show"><span>0</span>%</div>
                                    <div class="progress-in"></div>
                                </div>
                                <p>1213<span>1213</span></p>
                            </a>
                            <a href="#" class="qg">立即抢购</a>
                        </div>
                    </li>
                	<li>
                    	<div class="box">
                            <a href="#">
                                <img src="images/pho2.jpg" alt=""/>
                                <h4>苹果 iPhone 7 Plus  10元夺宝</h4>
                                <div class="progress-out" id="div3">
                                    <div class="percent-show"><span>0</span>%</div>
                                    <div class="progress-in"></div>
                                </div>
                                <p>1213<span>1213</span></p>
                            </a>
                            <a href="#" class="qg">立即抢购</a>
                        </div>
                    </li>
                
                	<li>
                    	<div class="box">
                            <a href="#">
                                <img src="images/pho2.jpg" alt=""/>
                                <h4>苹果 iPhone 7 Plus  10元夺宝</h4>
                                <div class="progress-out" id="div4">
                                    <div class="percent-show"><span>0</span>%</div>
                                    <div class="progress-in"></div>
                                </div>
                                <p>1213<span>1213</span></p>
                            </a>
                            <a href="#" class="qg">立即抢购</a>
                        </div>
                    </li>
                </ul>
<script>
    $(function () {
        $("#div1").myProgress({speed: 1000, percent: 30,});
        $("#div2").myProgress({speed: 1000, percent: 50, });
        $("#div3").myProgress({speed: 1000, percent: 5, });
        $("#div4").myProgress({speed: 1000, percent: 80, });
    })
</script>               	
            </div>
         
        </div>
    <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>
    </section><?php include 'footer.php';?>
</body>
</html>